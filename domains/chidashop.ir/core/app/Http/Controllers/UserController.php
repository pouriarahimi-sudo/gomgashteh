<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Session;
use App\Models\User;
use App\Models\City;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Province;
use App\Models\Announcement;

use Illuminate\Support\Facades\Storage;
use function Sodium\compare;

class UserController extends AdminController
{

    public function user()
    {
        if (session('session_id')) {
            $user = user::where('id', session('user_id'))->get();
            if ($user[0]->national_code == '') {
                session(['notExist' => 'ok']);
                $categories = Category::all();
                $provinces = Province::all();
                return view('user/insert-announcement', compact('provinces', 'categories'));
            } else {
                return redirect(route('index'));
            }
        } else {
            return view('user/login-register');
        }
    }

    public function authentication_login(request $request)
    {
        $this->validate($request, [
            'phone_num' => 'required|max:11|min:11'],
            [
                'phone_num.required' => 'لطفا شماره همراه را وارد کنید',
                'phone_num.max' => 'شماره همراه نباید بیشتر از 11 کاراکتر باشد',
                'phone_num.min' => 'شماره همراه نباید کمتر از 11 کاراکتر باشد'
            ]);
        $user_phone = request('phone_num');
        $user = User::where('phone_num', $user_phone)->get();
        if (count($user)) {
            $rand = rand(1000, 9999);
            $this->sendVerifyCode($user_phone, $rand);
            session([
                'rand' => $rand,
                'user_phone' => $user[0]->phone_num,
            ]);
            session()->flash('randomCode', 'ok');
        } else {
            session()->flash('noExistence', 'ok');
        }
        return redirect(route('user'));
    }

    public function user_validation(request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:30',
            'phone_num' => 'required|max:11|min:11'],
            [
                'first_name.required' => 'لطفا نام را وارد کنید',
                'first_name.max' => 'نام نباید بیشتر از 20 کاراکتر باشد',
                'last_name.required' => 'لطفا نام خانوادگی را وارد کنید',
                'last_name.max' => 'نام خانوادگی نباید بیشتر از 30 کاراکتر باشد',
                'phone_num.required' => 'لطفا شماره همراه را وارد کنید',
                'phone_num.max' => 'شماره همراه نباید بیشتر از 11 کاراکتر باشد',
                'phone_num.min' => 'شماره همراه نباید کمتر از 11 کاراکتر باشد'
            ]);
        $user_phone = request('phone_num');
        $first_name = request('first_name');
        $last_name = request('last_name');
        $user = user::where('phone_num', $user_phone)->get();
        $rand = rand(1000, 9999);
        if (count($user)) {
            $this->sendVerifyCode($user_phone, $rand);
            session([
                'rand' => $rand,
                'user_phone' => $user[0]->phone_num,
            ]);
        } else {
//        $this->sendVerifyCode($user_phone, $rand);
            session([
                'rand' => $rand,
                'user_phone' => $user_phone,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
        }
        session()->flash('randomCode', 'ok');
        return redirect(route('user'));
    }

    public function user_compare_code(request $request)
    {
        $rand = session('rand');
        $user_phone = session('user_phone');
        $verify_code = request('verify_code');
        if ($rand == $verify_code) {
            $user = user::where('phone_num', $user_phone)->get();
            if (count($user) > 0) {
                session([
                    'user_id' => $user[0]->id,
                    'session_id' => $user[0]->phone_num,
                    'first_name' => $user[0]->first_name,
                    'last_name' => $user[0]->last_name,
                    'full_name' => $user[0]->first_name . ' ' . $user[0]->last_name
                ]);
            } else {
                $first_name = session('first_name');
                $last_name = session('last_name');
                $new_user = user::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone_num' => $user_phone
                ]);
                session([
                    'user_id' => $new_user->id,
                    'session_id' => $user_phone,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'full_name' => $first_name . ' ' . $last_name,
                    'notExist' => 'ok'
                ]);
            }
            session()->flash('randomCode', 'ok');
            if (session()->has('announce_id')) {
                return redirect(route('specify-type-ticket'));
            } else {
                return redirect(route('user'));
            }
        } else {
            session()->flash('randomCode', 'ok');
            session()->flash('error', 'کد وارد شده صحیح نیست');
            session()->flash('randomCode', 'ok');
            if (request('type') == "1") {
                $request_id = request('request_id');
                return view('user/authentication', compact('request_id'));
            } else {
                return redirect(route('user'));
            }
        }
    }

    public function add_announcement()
    {
        $user = user::where('id', session('user_id'))->get();
        if ($user[0]->national_code == '')
            session(['notExist' => 'ok']);
        $categories = Category::all();
        $provinces = Province::all();
        return view('user/insert-announcement', compact('provinces', 'categories'));
    }

    public function sign_out(request $request)
    {
        $request->session()->flush();
        return redirect(route('index'));
    }

    public function complete_info(request $request)
    {
        $this->validate($request, [
            'national_code' => 'required|max:10',
            'birthday' => 'required|max:10',
            'province' => 'required',
            'city' => 'required',
        ], [
            'national_code.required' => 'کد ملی را وارد کنید',
            'national_code.max' => 'کد ملی نباید بیشتر از 10 کاراکتر باشد',
            'birthday.required' => 'تاریخ تولد را وارد کنید',
            'birthday.max' => 'تاریخ تولد نباید بیشتر از 10 کاراکتر باشد',
            'province.required' => 'استان را مشخص کنید',
            'city.required' => 'شهر را مشخص کنید',
        ]);
        $user = user::where('national_code', request('national_code'))->get();
        if (!count($user)) {
            user::where('id', session('user_id'))
                ->update([
                    'national_code' => request('national_code'),
                    'birthday' => request('birthday'),
                    'province_id' => request('province'),
                    'city_id' => request('city')
                ]);
            if (session()->has('notExist'))
                session()->forget('notExist');
            return redirect(route('add-announce'));
        } else {
            session()->flash('existNC', 'کد ملی وارد شده تکراری است');
            return redirect(route('user'));
        }
    }

    public function insert_announcement(request $request)
    {
        $result = $this->uploadImage('announce/');
        if($result['response'] == '1') {
            $this->validate($request, [
                'title' => 'required|max:50',
                'type' => 'required',
                'category' => 'required',
                'collection' => 'required',
                'province' => 'required',
                'city' => 'required',
//                'pictures' => 'mimes:png,jpg,jpeg'
            ], [
                'title.required' => 'عنوان آگهی وارد نشده است',
                'title.max' => 'عنوان آگهی نمی تواند بیشتر از 50 کاراکتر باشد',
                'type.required' => 'نوع آگهی را مشخص کنید',
                'category.required' => 'نوع دسته بندی انتخاب نشده است',
                'collection.required' => 'زیر مجموعه انتخاب نشده است',
                'province.required' => 'استان را مشخص کنید',
                'city.required' => 'شهر را مشخص کنید',
            ]);
            Announcement::create([
                'title' => request('title'),
                'type' => request('type'),
                'category_id' => request('category'),
                'collection_id' => request('collection'),
                'province_id' => request('province'),
                'city_id' => request('city'),
                'pictures' => $result['pictures'],
                'detail' => request('detail'),
                'announcer_id' => session('user_id')
            ]);
            return redirect(route('index'))->with('success','آگهی شما با موفقیت ثبت شد و بعد از بررسی منتشر خواه شد.');
        }else{
            return redirect(route('insert-announce'))->with('notOpload','بارگزاری فایل با مشکل مواجه شد لطفا دوباره سعی کنید.');
        }
    }

    public function details_announcement(Request $request)
    {
        $announce = Announcement::find(request('announce_id'));
        return view('user.details-announce', compact('announce'));
    }

    public function sendVerifyCode($phone_num, $rand)
    {
        $username = "mehritc";
        $password = '@utabpars1219';
        $from = "+983000505";
        $pattern_code = "rjl8pkjgmp";
        $to = array($phone_num);
        $input_data = array(
            "code" => "$rand");
//        $url = "https://panel.mediana.ir/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $verify_code = curl_exec($handler);
        return true;
    }

    public function getCitiesList($id)
    {
        $states = City::where('province', $id)->get();
        echo json_encode($states);
    }

    public function getCollectionsList($id)
    {
        $states = Collection::where('category', $id)->get();
        echo json_encode($states);
    }

    public function is_auth(request $request)
    {
        $announce_id = request('announce_id');
        session(['announce_id' => $announce_id]);
        return view('user.login-register');
    }

    public function uploadImage($mypach)
    {
        if (request()->hasFile('pictures')) {
            $files = request()->file('pictures');
            foreach ($files as $file) {
                $filename = time() . rand(1000, 9999) . '.' . $file->extension();
                if (file_exists(realpath(base_path() . '/../public_html/uploads/' . $mypach) . $filename)) {
                    $filename = time() . rand(1000, 9999) . '.' . $file->extension();
                }
                $move = $file->move(realpath(base_path() . '/../public_html/uploads/announce'), $filename);
                if ($move) {
                    $pictures[] = $filename;
                    $result['response'] = '1';
                } else
                    $result['response'] = '0';
            }
            $result['pictures'] = json_encode($pictures);
        }else{
            $result['pictures'] = '';
            $result['response'] = '0';
        }
        return $result;
    }

}
