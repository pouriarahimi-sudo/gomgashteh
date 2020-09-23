<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Ticket;
use App\Models\Ticket_answer;
use App\Models\User;
use App\Models\verifyCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
//   ---------------------------------------------------- اعتبارسنجی کاربر-----------------------
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_num' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['data' => $validator->errors()->all(), 'status' => 403], 403);
        }

        $phoneuser = User::wherePhone_num($request->input('phone_num'))->first();
        if ($phoneuser) {
            $phoneNum = verifyCode::wherePhone_num($request->input('phone_num'))->first();

            if ($phoneNum) {
                $phoneNum->update([
                    'code' => rand(1000, 9999)
                ]);
                return response(['data' => ['code' => $phoneNum->code], 'status' => 201, 'message' => 'code update'], 201);
            } else {
                verifyCode:: create([
                    'phone_num' => $request->input('phone_num'),
                    'code' => rand(1000, 9999)
                ]);
                $phone = verifyCode::wherePhone_num($request->input('phone_num'))->latest()->get();
                return response(['data' => ['code' => $phone[0]->code, 'phoneNum' => $phone[0]->phone_num], 'status' => 200, 'message' => 'insert phoneNum'], 200);

            }
        } else
            return response(['massage' => 'user not exist', 'status' => 403], 403);
    }
//----------اطلاعات  کاربر------------------------------------------------------------------------
    public function validateCode(Request $request)
    {

        $phone = verifyCode::wherePhone_num($request->input('phone_num'))->first();
        $user = User::wherePhone_num($request->input('phone_num'))->first();

        if ($phone->code == $request->input('code')) {
            return response(['data' => ['id' => $user->id, 'first_name' => $user->first_name, 'phone_num' => $user->phone_num, 'national_code' => $user->national_code,
                'gender' => $user->gender, 'birthday' => $user->birthday, 'tell' => $user->tell, 'email' => $user->email, 'province' => $user->province->name,
                'city' => $user->city->name, 'address' => $user->address, 'postal_code' => $user->postal_code, 'user_pic' => $user->user_pic, 'financial_situation' => $user->financial_situation
            ]]);
        } else {
            return response(['massage' => 'missing ', 'status' => 403], 403);
        }

    }
    //---------اطلاعات آگهی-------------------------------------------------------------------
    public function getAnnouncement()
    {
        $annoce = Announcement::where('Status', '1')->get();

        foreach ($annoce as $announc) {
            $announcement['id'] = $announc->id;
            $announcement['title'] = $announc->title;
            $announcement['province'] = $announc->province->name;
            $announcement['city'] = $announc->city->name;
            $announcement['category'] = $announc->category->name;
            $announcement['collection'] = $announc->collection->name;
            $announcement['detail'] = $announc->detail;
            $announcement['images'] = $announc->images;
            if ($announc->type == 1)
                $announcement['type'] = "پیدا شده";
            else
                $announcement['type'] = "گم شده";
            $announcement['user'] = $announc->user->first_name;
//           $date = CalendarUtils::strftime('Y/m/d H:i:s', strtotime($announc->created_at));
//            $announcement['create '] = $date;
            $data[' announcement'][] = $announcement;
        }
        return $result['data'] = $data;

    }
//-----------یک آگهی-------------------------------------------------------
    public function getOneAnnouncement(Request $request)
    {
        $announce=Announcement::whereId($request->input('id'))->first();
        //  $date = CalendarUtils::strftime('Y/m/d H:i:s', strtotime($announce->created_at));

        if ($announce->type == 1)
            $type= $announcement['type'] = "پیدا شده";
        else
            $type= $announcement['type'] = "گم شده";
        return response(['data'=>['id'=>$announce->id,'title'=>$announce->title,'province'=>$announce->province->name,'city'=>$announce->city->name,'category'=>$announce->category->name,'collection'=>$announce->collection->name,'type'=>$type,'user'=>$announce->user->first_name],'status'=>200],200);
    }
    public function saveTicket(Request $request)
    {
        $ticket = Ticket::where(['announcement_id' => $request->input('announcement_id'), 'sender_id' => $request->input('sender_id')])->first();

        if ($ticket->announcement->announcer_id != $ticket->sender_id) {
            if (!$ticket) {
                Ticket::create([
                    'announcement_id[0]' => $request->input('announcement_id'),
                    'sender_id' => $request->input('sender_id'),
                    'message' => $request->input('message'),
                    'picture' => $request->input('picture'),
                    'sender_confirm' => $request->input('sender_confirm'),
                    'receiver_confirm' => $request->input('receiver_confirm'),

                ]);
                return response(['massage' => 'save ticket ', 'status' => 200], 200);
            } else
                return response(['massage' => 'miss value ', 'status' => 403], 403);
        } else
            return response(['massage' => 'you can not  ', 'status' => 403], 403);
    }
    //--------ONE TICKET-------------------------------------
    public function  oneTicket(Request $request)
    {

        $ticket = Ticket_answer::orwhere(['sender_id' => $request->input('sender_id'), 'receiver_id' => $request->input('receiver_id')])->
        where( 'ticket_id' , $request->input('ticket_id'))->first();
        if($ticket)
        {
            return response(['data'=>['id'=>$ticket->ticket_id,'message'=>$ticket->message,'pictures'=>$ticket->pictures,'sender_id'=>$ticket->sender_id,'receiver_id'=>$ticket->receiver_id,
                'announcement'=>$ticket->ticket->announcement->title,'sender_id_ticket'=>$ticket->ticket->sender_id,'message_ticket'=>$ticket->ticket->message,'pictures_ticket'=>$ticket->ticket->pictures,],'status'=>200],200);

        }
        else
            return 0;
    }







}
