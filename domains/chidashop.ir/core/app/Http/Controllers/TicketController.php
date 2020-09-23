<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Ticket_answer;
use App\Models\Announcement;
use Illuminate\Support\Facades\Crypt;

class TicketController extends Controller
{

    public function specify_type_ticket(){
        $announce = Announcement::find(session('announce_id'));
        if($announce->user->id == session('user_id')):
            return redirect(route('index'))->with('announcer','آگهی دهنده نمی تواند به آگهی خود تیکت ارسال کند');
        else:
            $tickets = Ticket::where(['announcement_id'=>session('announce_id'),'sender_id'=>session('user_id')])->get();
            if(count($tickets) > 0) {
                return redirect(route('send-ticket'));
            }else {
                return redirect(route('send-new-ticket'));
            }
        endif;
    }

    public function send_new_ticket(){
        $announce = Announcement::find(session('announce_id'));
        return view('user.send-new-ticket', compact('announce'));
    }

	public function send_ticket(Request $request) {
        if(session('announce_id')){
            $tickets = Ticket::where(['announcement_id'=>session('announce_id'),'sender_id'=>session('user_id')])->get();
        }elseif(Request('announce_id')){
            $tickets = Ticket::where(['announcement_id'=>Request('announce_id'),'sender_id'=>session('user_id')])->get();
        }else{
            $tickets = Ticket::where('id',Request('ticket_id'))->get();
            session(['announce_id'=>$tickets[0]->announcement_id]);
        }

        if(count($tickets) > 0){
            $ticket_answer = Ticket_answer::where('ticket_id', $tickets[0]->id)->orderby('id','desc')->get();
            return view('user.send-ticket', compact('tickets', 'ticket_answer'));
        }else{
            $announce = Announcement::find(Request('announce_id'));
            return view('user.send-new-ticket', compact('announce'));
        }
	}

	public function insert_new_ticket(Request $request){
        $this->validate($request, [
            'message'=>'required'
        ],[
            'message'=>'متن تیکت نمیتواند خالی باشد'
        ]);
        $ticket = Ticket::create([
            'announcement_id'=>session('announce_id'),
            'sender_id'=>session('user_id'),
            'message'=>Request('message'),
        ]);

        $tickets = Ticket::where('id',$ticket->id)->get();
        $ticket_answer = Ticket_answer::where('ticket_id', $ticket->id)->orderby('id','desc')->get();
        return view('user.send-ticket', compact('tickets', 'ticket_answer'));
    }

    public function insert_ticket(Request $request) {
			$this->validate($request, [
				'message'=>'required'
			],[
				'message.required'=>'متن تیکت نمیتواند خالی باشد'
			]);
		Ticket_answer::create([
			'ticket_id' => Request('ticket_id'),
			'announcement_id' => session('announce_id'),
			'sender_id' => session('user_id'),
			'receiver_id' => Request('receiver_id'),
			'message' => Request('message'),
		]);
		return back()->with('success','ok');
    }

	public function my_tickets() {
		$tickets = Ticket::all()->sortDesc();
		return view('user.my-tickets',compact('tickets'));
	}

	public function show_ticket(Request $request){
        $ticket_id = decrypt($request->input('ticket_id'));
        $tickets = Ticket::where('id',$ticket_id)->get();
        $ticket_answer = Ticket_answer::where('ticket_id',$ticket_id)->orderby('id','desc')->get();
        return view('user.send-ticket', compact('tickets', 'ticket_answer'));
	}

	public function insert_ticket_answer(Request $request)
	{
    	$this->validate($request, [
    		'message'=>'required'],['message.required'=>'متن تیکت نمیتواند خالی باشد']);
        $ticket_id = Request('ticket_id');
    	Ticket_answer::create([
            'announcement_id' => Request('announcement_id'),
			'ticket_id' => $ticket_id,
			'sender_id' => session('user_id'),
//		    'receiver' => request('receiver'),
			'message' => Request('message'),
		]);
        return redirect('/show-ticket?ticket_id='.encrypt($ticket_id))->with('success','تیکت با موفقیت ارسال شد');
	}

	public function confirmation(Request $request)
    {
        $ticket_id = $request->input('ticket_id');
        $ticket = Ticket::find($ticket_id);
        $title = $ticket->announcement->title;
        if ($ticket->user->id == session('user_id')){
            Ticket::where('id', $ticket_id)->update(['sender_confirm' => 1]);
            if ($ticket->receiver_confirm == 1) {
                $sender_name = session('full_name');
                $sender_phone_num = session('session_id');
                $announcer_name = $ticket->announcement->user->first_name . ' ' . $ticket->announcement->user->last_name;
                $announcer_phone_num = $ticket->announcement->user->phone_num;
                $text1 = 'شماره تماس: '.$sender_phone_num;
                $text2 = 'شماره تماس: '.$announcer_phone_num;
                $this->sendConfirmationSMS($title, $sender_name, $announcer_phone_num, $text1);
                $this->sendConfirmationSMS($title, $announcer_name, $sender_phone_num, $text2);

//                $this->test($title, $sender_name, $announcer_phone_num, $text1);
//                $this->test($title, $announcer_name, $sender_phone_num, $text2);

            } else {
                $name = $ticket->user->first_name . ' ' . $ticket->user->last_name;
                $phone_num = $ticket->announcement->user->phone_num;
                $text = 'لطفا جهت تایید در قسمت تیکت ها اقدام کنید.';
                $this->sendConfirmationSMS($title, $name, $phone_num, $text);

//                $this->test($title, $name, $phone_num, $text);

            }
        }else {
            Ticket::where('id', $ticket_id)->update(['receiver_confirm' => 1]);
            if ($ticket->sender_confirm == 1) {
                $announcer_name = session('full_name');
                $announcer_phone_num = session('session_id');
                $sender_name = $ticket->user->first_name . ' ' . $ticket->user->last_name;
                $sender_phone_num = $ticket->user->phone_num;
                $text1 = 'شماره تماس: '.$sender_phone_num;
                $text2 = 'شماره تماس: '.$announcer_phone_num;
                $this->sendConfirmationSMS($title, $sender_name, $announcer_phone_num, $text1);
                $this->sendConfirmationSMS($title, $announcer_name, $sender_phone_num, $text2);

//                $this->test($title, $sender_name, $announcer_phone_num, $text1);
//                $this->test($title, $announcer_name, $sender_phone_num, $text2);

            } else {
                $name = $ticket->announcement->user->first_name . ' ' . $ticket->announcement->user->last_name.' (آگهی دهنده)';
                $phone_num = $ticket->user->phone_num;
                $text = 'لطفا جهت تایید در قسمت تیکت ها اقدام کنید.';
                $this->sendConfirmationSMS($title, $name, $phone_num, $text);

//                $this->test($title, $name, $phone_num, $text);
            }
        }
        return redirect('/show-ticket?ticket_id='.encrypt($ticket_id))->with('accept','تاییدیه شما ثبت شد در صورت تایید طرف مقابل اطلاعات تماس طرفین جهت برقراری ارتباط در اختیار شما قرار داده می شود.');
	}

//	private function test($title, $name, $phone_num1, $text){
//        echo $phone_num1.'<br>'.'آگهی: '.$title.'<br> نمایش اطلاعات تماس توسط '.$name.' تایید شد.<br>'.$text.'<br>';
//    }

    public function sendConfirmationSMS($title, $name, $phone_num1, $text){
        $username = "mehritc";
        $password = '@utabpars1219';
        $from = "+983000505";
        $pattern_code = "u3feiwwvbl";
        $to = array($phone_num1);
        $input_data = array(
            "title" => "$title",
            "name" => "$name",
            "user" => "$text",
        );
//        $url = "https://panel.mediana.ir/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $verify_code = curl_exec($handler);
        return true;
    }
    
}
