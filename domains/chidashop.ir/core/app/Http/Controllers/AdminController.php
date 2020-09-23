<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Admin;
use App\Models\Verify_code;
use App\Models\Logs;
use App\Models\Announcement;
class AdminController extends Controller
{

    public function admin_validation(){
        $user_phone = request('phone_num');
        $admin = Admin::where('phone_num',$user_phone)->get();
        if(!empty($admin[0])){
            $phone_num = $admin[0]->phone_num;
            $rand = rand(1000,9999);
            $this->sendVerifyCode($phone_num, $rand);
            session(['user_id'=>$admin[0]->id,'rand'=>$rand,'user_phone'=>$user_phone,'user_nc'=>$admin[0]->national_code]);
            session()->flash('randomCode','ok');
            return redirect('admin');
        }else{
            session()->flash('notFoundNC','این شماره در سیستم ثبت نشده است');
            return redirect('admin');
        }
    }

    public function sendVerifyCode($phone_num, $rand) {
        $username = "mehritc";
        $password = '@utabpars1219';
        $from = "+983000505";
        $pattern_code = "rjl8pkjgmp";
        $to = array($phone_num);
        $input_data = array(
            "code" => "$rand");
        $url = "https://panel.mediana.ir/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
//        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $verify_code = curl_exec($handler);
        return true;
    }
    public function compare_code(request $request)
    {
        $user_agent=$request->userAgent();
        $ip_address=$request->ip();
        $user_id = session('user_id');
        $access_type = session('access_type');
//        Logs::create([
//            'user_id' => $user_id,
//            'operation' => 'login',
//            'user_agent' => $request->userAgent(),
//            'ip_address' => $request->ip()
//        ]);
        $rand = session('rand');
        $user_phone = session('user_phone');
        $user_vc = request('verify_code');
        if ($rand == $user_vc) {
            $admin_info = Admin::where('phone_num', $user_phone)->get();
            session([
                'user_id'=> $admin_info[0]->id,
                'first_name' => $admin_info[0]->first_name,
                'last_name' => $admin_info[0]->last_name,
                'full_name' => $admin_info[0]->first_name.' '.$admin_info[0]->last_name,
                'national_code' => $admin_info[0]->national_code,
                'sessId' => $admin_info[0]->phone_num,
                'status' => $admin_info[0]->status,
                'father_name' => $admin_info[0]->father_name,
                'birthday' => $admin_info[0]->birthday,
                'gender' => $admin_info[0]->gender,
                'tell' => $admin_info[0]->tell,
                'marital_status' => $admin_info[0]->marital_status,
                'email' => $admin_info[0]->email,
                'province' => $admin_info[0]->province,
                'city' => $admin_info[0]->city,
                'address' => $admin_info[0]->address,
                'postal_code' => $admin_info[0]->postal_code,
                'admin_pic' => $admin_info[0]->admin_pic,
                'financial_situation' => $admin_info[0]->financial_situation,
                'access_type'=>$admin_info[0]->access_type,
            ]);
            return redirect('admin');
        } else {
            session()->flash('randomCode','ok');
            session()->flash('error','کد وارد شده صحیح نیست.');
            return redirect('admin');
        }
    }

    public function admin_sign_out(request $request){
        $request->session()->flush();
        return redirect('admin');
    }

    public function user_management(){
        $admin = Admin::all();
        return view('admin/user-management',compact('admin'));
    }

    public function add_user(request $request){
        $this->validate($request,[
            'first_name'=>'required|max:20',
            'last_name'=>'required|max:30',
            'national_code'=>'required|max:10',
            'phone_num'=>'required|max:11',
            'access_type'=>'required',
        ],[
            'first_name.required'=>'نام را وارد کنید',
            'last_name.required'=>'نام خانوادگی را وارد کنید',
            'national_code.required'=>'کد ملی را وارد کنید',
            'phone_num.required'=>'شماره همراه را وارد کنید ',
            'access_type.required'=>'نوع کاربر مشخص نشده است'
        ]);
        Admin::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'national_code' => request('national_code'),
            'phone_num' => request('phone_num'),
            'access_type' => request('access_type'),
        ]);

        return back()->with('successful','ثبت با موفقیت انجام شد');
    }

    public function status_change(request $request)
    {
        $value_tab = request('value_tab');
        $type = request('status');
        $id = request('id');
        if ($type == 1){
			Announcement::where('id', $id)->update(['status' => '1']);
            if($value_tab == '1')
                session()->flash('tab-all','ok');
            if($value_tab == '2')
                session()->flash('tab-lost', 'ok');
            if($value_tab == '3')
                session()->flash('tab-found','ok');
//            return back()->with('successful','تأیید آگهی با موفقیت انجام شد');
            return redirect('user-announce')->with('successful','تأیید آگهی با موفقیت انجام شد');
        }elseif($type == 2){
			Announcement::where('id', $id)->update(['status' => '2']);
            if($value_tab == '1')
                session()->flash('tab-all','ok');
            if($value_tab == '2')
                session()->flash('tab-lost','ok');
            if($value_tab == '3')
                session()->flash('tab-found','ok');
            return redirect('user-announce')->with('successful-danger','ردآگهی با موفقیت انجام شد');
        }
    }

    public function edit_personnel(request $request){
        $admin=Admin::find($request->id);
        return view('admin/edit-personnel',compact('admin'));
    }


    public function update_personnel(request $request){

        $this->validate($request ,[
            'first_name'=>'required|max:30',
            'last_name'=>'required|max:50',
            'national_code'=>'required|max:10',
            'phone_num'=>'required|max:11',
            'access_type'=>'required'
        ],[
            'first_name.required'=>'فیلد نام تکمیل نشده است!(مجاز به واردکردن بیشتر از ۳۰ کاراکتر نمی باشید)',
            'last_name.required'=>'فیلد نام خانوادگی تکمیل نشده است!(مجاز به واردکردن بیشتر از ۵۰ کاراکتر نمی باشید)',
            'national_code.required'=>'کد ملی وارد نشده است!(کد ملی ۱۰ رقم می باشد)',
            'phone_num.required'=>'شماره تلفن وارد نشده است!(شماره همراه ۱۱ کاراکتر میباشد) ',
            'access_type.required'=>'نوع کار بر مشخض نشده است!'
        ]);
        Admin::where('id',request('id'))->update([
            'first_name'=>request('first_name'),
            'last_name'=>request('last_name'),
            'national_code'=>request('national_code'),
            'phone_num'=>request('phone_num'),
            'access_type'=>request('access_type')
        ]);
        return redirect('user-management')->with('success','ویرایش با موفقیت انجام شد');
    }

    public function delete_personnel(request $request){
        Admin::find($request->id)->delete();
        return back()->with('delete_success','کاربر مورد نظر حذف گردید');
    }

    public function user_announce(){
        if(!session()->has('tab-lost') && !session()->has('tab-found'))
            session()->flash('tab-all','ok');
        $requests = Announcement::all();
        return view('admin/user_requests',compact('requests'));
    }

    public function show_announce(request $request){
        $value_tab = $request->value_tab;
      $announce=Announcement::find($request->id);
      return view('admin/show-announce',compact('announce','value_tab'));
    }
    
}
