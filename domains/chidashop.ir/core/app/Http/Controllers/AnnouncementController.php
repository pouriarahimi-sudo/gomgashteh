<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Province;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function my_announce(){
        $announce = Announcement::where(['announcer_id'=>session('user_id'),'status'=>1])->get();
        return view('user.my-announce',compact('announce'));
    }

    public function edit_my_announce(Request $request){
//        $announce_id = decrypt($request->input('announce_id'));
        $announce = Announcement::find($request->announce_id);
        $categories = Category::all();
        $provinces = Province::all();
        return view('user.edit-my-announce',compact('announce','categories','provinces'));
    }

    public function update_announce(request $request){
        $this->validate($request, [
            'title' => 'required|max:50',
            'type' => 'required',
            'category' => 'required',
            'collection' => 'required',
            'province' => 'required',
            'city' => 'required',
        ], [
            'title.required' => 'عنوان آگهی وارد نشده است',
            'title.max' => 'عنوان آگهی نمی تواند بیشتر از 50 کاراکتر باشد',
            'type.required' => 'نوع آگهی را مشخص کنید',
            'category.required' => 'نوع دسته بندی انتخاب نشده است',
            'collection.required' => 'زیر مجموعه انتخاب نشده است',
            'province.required' => 'استان را مشخص کنید',
            'city.required' => 'شهر را مشخص کنید',
        ]);
        Announcement::where('id',request('id'))->update([
            'title'=>request('title'),
            'type'=>request('type'),
            'category_id'=>request('category'),
            'collection_id'=>request('collection'),
            'province_id'=>request('province'),
            'city_id'=>request('city'),
            'detail'=>request('detail'),
        ]);
        return redirect('my-announce')->with('success','ویرایش با موفقیت انجام شد');
    }

    public function delete_announce(request $request){
        Announcement::where('id', $request->announce_id)->update(['status'=>3,'result' => $request->result]);
//        Announcement::find($request->announce_id)->delete();
        return redirect('my-announce');
    }

    public function record_the_result(Request $request){
        $ticket_id = $request->input('ticket_id');
        $ticket = Ticket::find($ticket_id);
        Announcement::find($ticket->announcement->id)->update([
            'result' => $request->input('result')
        ]);
        return redirect(route('my-tickets'))->with('record-result','ok');
    }
}
