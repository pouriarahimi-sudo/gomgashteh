@extends('admin.layouts.master')

@section('admin-title'){{'مدیریت کاربران'}}@endsection

@section('admin-content')

 <div class="container-fluid">
   <div class="row">
    <div class="col-md-pull-12">
        <h4 class="headline margin-top-0 margin-bottom-30">مدیریت آگهی ها</h4>

        <div class="style-2">
            @if (Session::has('error'))
                <div class=" mt-12 alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            @if (Session::has('successful'))
                <div class=" mt-12 alert alert-success">{{ Session::get('successful') }}</div>
            @endif
            @if (Session::has('successful-danger'))
                <div class=" mt-12 alert alert-danger">{{ Session::get('successful-danger') }}</div>
        @endif
            <!-- Tabs Navigation -->
            <ul class="tabs-nav">
                <li class="active">
                    <a href="#tab1a"><i class="sl sl-icon-pin" @if (Session::has('tab-all')) {{'active'}} @endif></i> همه آگهی ها</a>
                </li>
                <li>
                    <a href="#tab2a"><i class="sl sl-icon-badge" @if (Session::has('tab-lost')) {{'active'}} @endif></i>گم شده</a>
                </li>
                <li>
                    <a href="#tab3a"><i class="sl sl-icon-bubbles" @if (Session::has('tab-found')) {{'active'}} @endif></i>پیدا شده</a>
                </li>
                <li>
                    <a href="#tab4a"><i class="sl sl-icon-bubbles" @if (Session::has('tab-delete')) {{'active'}} @endif></i>حذف شده</a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tabs-container">
                <div class="tab-content" id="tab1a">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان آگهی</th>
                            <th>دسته بندی</th>
                            <th>زیرمجموعه</th>
                            <th>استان</th>
                            <th>شهر</th>
                            <th>تصویر</th>
                            <th>نوع آگهی</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        @foreach($requests as $req3)
                            <tr>
                                <th>{{$req3->id}}</th>
                                <td style="max-width: 50px">{{$req3->title}}</td>
                                <td>{{$req3->category['name']}}</td>
                                <td>{{$req3->collection['name']}}</td>
                                <td>{{$req3->province['name']}}</td>
                                <td>{{$req3->city['name']}}</td>
                                <td>
                                    <img src="{{$req3->admin_pic}}" alt="">
                                </td>
                                <td>
                                    @if($req3->type == 1)<span >{{'گمشده'}}</span>
                                    @else($req3->type == 2)<span >{{'پیدا شده'}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($req3->status == 0)<span>{{'جدید'}}</span>
                                    @elseif($req3->status == 1)<span >{{'تأیید شده'}}</span>
                                    @elseif($req3->status == 2)<span >{{'رد شده'}}</span>
                                    @elseif($req3->status == 3)<span >{{'حذف شده'}}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="button" onclick="event.preventDefault();document.getElementById('show-announce_{{$req3->id}}').submit()">مشاهده</button>
                                    <form id="show-announce_{{$req3->id}}" action="{{route('show-announce')}}" method="post" style="display: none">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$req3->id}}">
                                        <input type="hidden" name="value_tab" value="1">
                                    </form>


                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="tab-content" id="tab2a">
                    @if (Session::has('error'))
                        <div >{{ Session::get('error') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان آگهی</th>
                                <th>دسته بندی</th>
                                <th>زیرمجموعه</th>
                                <th>استان</th>
                                <th>شهر</th>
                                <th>تصویر</th>
                                <th>وضعیت</th>
                                <th>ابزار</th>
                            </tr>
                            </thead>
                            @foreach($requests as $req2)
                                @if($req2->type == 1)
                                    <tr>
                                        <th>{{$req2->id}}</th>
                                        <td style="max-width: 50px">{{$req2->title}}</td>
                                        <td>{{$req2->category['name']}}</td>
                                        <td>{{$req2->collection['name']}}</td>
                                        <td>{{$req2->province['name']}}</td>
                                        <td>{{$req2->city['name']}}</td>
                                        <td>
                                            <img src="{{$req2->admin_pic}}" alt="">
                                        </td>
                                        {{--                                <td><span class="badge badge-@if($req->type_user=='1'){{'success'}} @elseif($req->type_user=='2'){{'primary'}} @elseif($req->type_user=='3'){{'warning'}} @endif">--}}
                                        {{--                                @if($req->type_user==1){{'مدیر'}} @elseif($req->type_user==2){{'پشتیبان'}} @elseif($req->type_user==3) {{'اپراتور'}} @endif--}}
                                        {{--                            </span></td>--}}
                                        <td>
                                            @if($req2->status == 0)<span>{{'جدید'}}</span>
                                            @elseif($req2->status == 1)<span >{{'تأیید شده'}}</span>
                                            @elseif($req2->status == 2)<span >{{'رد شده'}}</span>
                                            @elseif($req2->status == 3)<span >{{'حذف شده'}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="button" onclick="event.preventDefault();document.getElementById('show-announce_{{$req2->id}}').submit()">مشاهده</button>
                                            <form id="show-announce_{{$req2->id}}" action="/show-announce" method="post" style="display: none">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{$req2->id}}">
                                                <input type="hidden" name="value_tab" value="2">
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="tab-content" id="tab3a">
                    @if (Session::has('error'))
                        <div >{{ Session::get('error') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان آگهی</th>
                                <th>دسته بندی</th>
                                <th>زیرمجموعه</th>
                                <th>استان</th>
                                <th>شهر</th>
                                <th>تصویر</th>
                                <th>وضعیت</th>
                                <th>ابزار</th>
                            </tr>
                            </thead>
                            @foreach($requests as $req1)
                                @if($req1->type == 2)
                                    <tr>
                                        <th>{{$req1->id}}</th>
                                        <td style="max-width: 50px">{{$req1->title}}</td>
                                        <td>{{$req1->category['name']}}</td>
                                        <td>{{$req1->collection['name']}}</td>
                                        <td>{{$req1->province['name']}}</td>
                                        <td>{{$req1->city['name']}}</td>
                                        <td>
                                            <img src="{{$req1->admin_pic}}" alt="">
                                        </td>
                                        {{--                                <td><span class="badge badge-@if($req->type_user=='1'){{'success'}} @elseif($req->type_user=='2'){{'primary'}} @elseif($req->type_user=='3'){{'warning'}} @endif">--}}
                                        {{--                                @if($req->type_user==1){{'مدیر'}} @elseif($req->type_user==2){{'پشتیبان'}} @elseif($req->type_user==3) {{'اپراتور'}} @endif--}}
                                        {{--                            </span></td>--}}
                                        <td>
                                            @if($req1->status == 0)<span>{{'جدید'}}</span>
                                            @elseif($req1->status == 1)<span >{{'تأیید شده'}}</span>
                                            @elseif($req1->status == 2)<span >{{'رد شده'}}</span>
                                            @elseif($req1->status == 3)<span >{{'حذف شده'}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="button" onclick="event.preventDefault();document.getElementById('show-announce_{{$req1->id}}').submit()">مشاهده</button>
                                            <form id="show-announce_{{$req1->id}}" action="/show-announce" method="post" style="display: none">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{$req1->id}}">
                                                <input type="hidden" name="value_tab" value="3">
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="tab-content" id="tab4a">
                    @if (Session::has('error'))
                        <div >{{ Session::get('error') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان آگهی</th>
                                <th>دسته بندی</th>
                                <th>زیرمجموعه</th>
                                <th>استان</th>
                                <th>شهر</th>
                                <th>تصویر</th>
                                <th>علت حذف</th>
                                <th>ابزار</th>
                            </tr>
                            </thead>
                            @foreach($requests as $req1)
                                @if($req1->status == 3)
                                    <tr>
                                        <th>{{$req1->id}}</th>
                                        <td style="max-width: 50px">{{$req1->title}}</td>
                                        <td>{{$req1->category['name']}}</td>
                                        <td>{{$req1->collection['name']}}</td>
                                        <td>{{$req1->province['name']}}</td>
                                        <td>{{$req1->city['name']}}</td>
                                        <td>
                                            @if($req1->pictures != null)
                                                @php($pictures = json_decode($req1->pictures))@endphp
                                                <img src="{{'uploads/announce/'.$pictures[0]}}" alt="announce">
                                            @else
                                                <img src="{{'images/camera-icon.png'}}" alt="announce">
                                            @endif
                                        </td>
                                        {{--                                <td><span class="badge badge-@if($req->type_user=='1'){{'success'}} @elseif($req->type_user=='2'){{'primary'}} @elseif($req->type_user=='3'){{'warning'}} @endif">--}}
                                        {{--                                @if($req->type_user==1){{'مدیر'}} @elseif($req->type_user==2){{'پشتیبان'}} @elseif($req->type_user==3) {{'اپراتور'}} @endif--}}
                                        {{--                            </span></td>--}}
                                        <td>
                                            @if($req1->result == 1)<span>{{'مشکلم حل شد'}}</span>
                                            @elseif($req1->result == 2)<span >{{'به نتیجه نرسدم'}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="button" onclick="event.preventDefault();document.getElementById('show-announce_{{$req1->id}}').submit()">مشاهده</button>
                                            <form id="show-announce_{{$req1->id}}" action="/show-announce" method="post" style="display: none">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{$req1->id}}">
                                                <input type="hidden" name="value_tab" value="3">
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
     </div>
   </div>
</div>



@endsection
