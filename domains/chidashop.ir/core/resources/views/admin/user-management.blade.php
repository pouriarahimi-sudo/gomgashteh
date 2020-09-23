@extends('admin.layouts.master')

@section('admin-title'){{'مدیریت کاربران'}}@endsection

@section('admin-content')

    <div class="col-md-12">

        @if (Session::has('delete_success'))
            <div class="notification success closeable">
                <p>{{Session::get('delete_success')}}</p>
                <a class="close" href=""></a>
            </div>
        @endif

        @if (Session::has('error'))
            <div class="notification success closeable">
                <p>{{Session::get('error')}}</p>
                <a class="close" href=""></a>
            </div>
        @endif

        <h4 class="headline margin-top-0 margin-bottom-30">مدیریت پرسنل</h4>
        <div class="style-2">
            <div class="text-right">
                <!-- Reply to review popup -->
                <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                    <div class="small-dialog-header">
                        <h3>افزودن کاربر</h3>
                        @if(count($errors))
                            <div class="alert alert-danger"style="direction: rtl;">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $('#add-user').modal('show');
                                });
                            </script>
                        @endif
                    </div>
                    <form action="add-user" method="post">
                        @csrf
                        <div class="message-reply margin-top-0">

                            <label >نام</label>
                            <input name="first_name" type="text" id="firstName2" placeholder="">

                            <label for="lastName2">نام خانوادگی</label>
                            <input name="last_name" type="text" id="lastName2" placeholder="">

                            <label for="firstName2">کدملی</label>
                            <input name="national_code" type="number" id="firstName2" placeholder="">

                            <label for="lastName2">شماره همراه</label>
                            <input name="phone_num" type="number" placeholder="">

                            <label for="inputEmail4" ><h4>نوع کاربر را مشخص کنید:</h4></label>

                            <label >
                                <input  type="radio" name="access_type" value="1">
                                <span ><h5>مدیر</h5></span>
                                <span ></span>
                            </label>
                            <label >
                                <input  type="radio" name="access_type" value="2">
                                <span ><h5>پشتیبان</h5></span>
                                <span ></span>
                            </label>
                            <label >
                                <input type="radio" name="access_type" value="3">
                                <span ><h5>اپراتور</h5></span>
                                <span ></span>
                            </label>
                            <label >
                                <input type="radio" name="access_type" value="3">
                                <span ><h5>دفترپیشخوان</h5></span>
                                <span ></span>
                            </label>
                            <button  class="button" type="submit"> ثبت </button>
                            {{--                                <button class="button" type="button">انصراف</button>--}}
                        </div>
                    </form>
                </div>

                <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-plus"></i>افزودن کاربر جدید</a>
            </div>
            <!-- Tabs Content -->
            <div class="tabs-container">

                <table class="basic-table">
                    <tr class="text-center">
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>عکس</th>
                        <th>کد ملی</th>
                        <th>شماره همراه</th>
                        <th>وضعیت</th>
                        <th>ابزار</th>
                    </tr>
                    @foreach($admin as $ad)
                        <tr class="text-center">
                            <td>{{$ad->id}}</td>
                            <td>{{$ad->first_name.' '.$ad->last_name}}</td>
                            <td>
                                <img class="rounded-circle m-0 avatar-sm-table" src="{{$ad->admin_pic}}" alt="">
                            </td>
                            <td>{{$ad->national_code}}</td>
                            <td>{{$ad->phone_num}}</td>
                            <td>
                                <span class="@if($ad->access_type=='1'){{'success'}}
                                @elseif($ad->access_type=='2'){{'primary'}}
                                @elseif($ad->access_type=='3'){{'warning'}}
                                @endif">
                                        @if($ad->access_type==1){{'مدیر'}}
                                    @elseif($ad->access_type==2){{'پشتیبان'}}
                                    @elseif($ad->access_type==3) {{'اپراتور'}}
                                    @endif
                                        </span>
                            </td>
                            <td>

                                <a href="" onclick="event.preventDefault();document.getElementById('edit_{{$ad->id}}').submit()" class="button"><i class="fa fa-pencil"></i></a>
                                <form id="edit_{{$ad->id}}" action="{{route('edit-personnel')}}" method="post" style="display: none">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$ad->id}}">
                                </form>

                                <a href="" onclick="event.preventDefault();document.getElementById('delete_{{$ad->id}}').submit()" class="button"><i class="fa fa-close"></i></a>
                                <form id="delete_{{$ad->id}}" action="{{route('delete-personnel')}}" method="post" style="display: none">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$ad->id}}">
                                </form>



{{--                                <a href="#delete_{{$ad->id}}" class="send-message-to-owner button popup-with-zoom-anim"><i class="fa fa-close"></i></a>--}}
                                {{--                                <div id="delete_{{$ad->id}}" class="zoom-anim-dialog mfp-hide">--}}
{{--                                    <div class="small-dialog-header">--}}
{{--                                        <h3>حذف پرسنل</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="message-reply margin-top-0">--}}
{{--                                    <form action="add-user" method="post">--}}
{{--                                        @csrf--}}
{{--                                        <div class="message-reply margin-top-0">--}}
{{--                                            <input name="first_name" type="text" id="firstName2" placeholder="">--}}
{{--                                            <button  class="button" type="submit"> ثبت </button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
