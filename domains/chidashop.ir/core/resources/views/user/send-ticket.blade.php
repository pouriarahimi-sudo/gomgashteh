@extends('user.layouts.master')

@section('user-title'){{'ارسال تیکت'}}@endsection
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('user-content')

    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>ارسال تیکت</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li>تیکت ها</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>

    <div class="container">

        @if (Session::has('success'))
            <div class="notification success closeable">
                <p>{{Session::get('success')}}</p>
                <a class="close" href=""></a>
            </div>
        @endif

        @if (Session::has('accept'))
            <div class="notification success closeable">
                <p>{{Session::get('accept')}}</p>
                <a class="close" href=""></a>
            </div>
        @endif

        <div class="notification notice large margin-bottom-40">
            @if($tickets[0]->sender_confirm == 1 && $tickets[0]->receiver_confirm == 1)
                @if($tickets[0]->user->id == session('user_id'))
                    <p>آگهی دهنده نمایش اطلاعات تماس خود به شما را تایید کرده است؛</p>
                    <p>شماره تماس: {{$tickets[0]->announcement->user->phone_num}}</p>
                @elseif($tickets[0]->user->id != session('user_id'))
                    <p>{{$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name}} نمایش اطلاعات تماس خود به شما را تایید کرده است؛</p>
                    <p class="margin-bottom-40">شماره تماس: {{$tickets[0]->user->phone_num}}</p>

                    <div class="notification error">
                        <h4>لطفا بعد از تماس نتیجه را با ما در میان بگذارید:</h4>
                        <form action="{{route('record-the-result')}}" method="post">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{$tickets[0]->id}}">
                            <label class="radio-inline">
                                <input type="radio" value="1" name="result" checked>
                                <span class="margin-right-30">مشکلم حل شد</span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="2" name="result">
                                <span class="margin-right-30">به نتیجه نرسیدم</span>
                            </label>
                            <button type="submit" class="button">ثبت نتیجه</button>
                        </form>
                    </div>

                @endif

            @elseif($tickets[0]->sender_confirm == 1 && $tickets[0]->receiver_confirm == 0)

                @if($tickets[0]->user->id == session('user_id'))
                    <p>هنوز آگهی دهنده نمایش اطلاعات تماس خود به شما را تایید نکرده؛</p>
                @elseif($tickets[0]->user->id != session('user_id'))
                    <p>{{$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name}} نمایش اطلاعات تماس خود به شما را تایید کرد در صورت تایید شما اطلاعات تماس طرفین جهت برقراری ارتباط در اختیار شما قرار داده می شود؛</p>
                    <div class="checkboxes in-row margin-bottom-20">
                        <input id="check-a" type="checkbox" name="check">
                        <label for="check-a">تایید نمایش اطلاعات تماس شما به
                            <span class="bg-danger">{{' '.$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name}}</span>
                        </label>
                        <button class="button" onclick="event.preventDefault();document.getElementById('confirm').submit()">ارسال</button>
                        <form id="confirm" action="{{route('confirmation')}}" method="post">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{$tickets[0]->id}}">
                        </form>
                    </div>
                @endif

            @elseif($tickets[0]->sender_confirm == 0 && $tickets[0]->receiver_confirm == 1)

                @if($tickets[0]->user->id == session('user_id'))
                    <p>آگهی دهنده نمایش اطلاعات تماس خود به شما را تایید کرد در صورت تایید شما اطلاعات تماس طرفین جهت برقراری ارتباط در اختیار شما قرار داده می شود؛</p>
                    <div class="checkboxes in-row margin-bottom-20">
                        <input id="check-a" type="checkbox" name="check">
                        <label for="check-a">تایید نمایش اطلاعات تماس شما به آگهی دهنده</label>
                        <button class="button" onclick="event.preventDefault();document.getElementById('confirm').submit()">ارسال</button>
                        <form id="confirm" action="{{route('confirmation')}}" method="post">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{$tickets[0]->id}}">
                        </form>
                    </div>
                @elseif($tickets[0]->user->id != session('user_id'))
                    <p>هنوز {{$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name}} نمایش اطلاعات تماس خود به شما را تایید نکرده است؛</p>
                @endif

            @else

                @if($tickets[0]->user->id == session('user_id'))
                    <p>{{$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name.' عزیز '}} در صورت تمایل به برقراری ارتباط با آگهی دهنده ورودی زیر را انتخاب کرده و دکمه ارسال را بزنید در صورت تایید هر دو طرف اطلاعات تماس طرفین جهت برقراری ارتباط در اختیار شما قرار داده می شود؛</p>
                    <div class="checkboxes in-row margin-bottom-20">
                        <input id="check-a" type="checkbox" name="check">
                        <label for="check-a">تایید نمایش اطلاعات تماس شما به آگهی دهنده</label>
                        <button class="button" onclick="event.preventDefault();document.getElementById('confirm').submit()">ارسال</button>
                        <form id="confirm" action="{{route('confirmation')}}" method="post">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{$tickets[0]->id}}">
                        </form>
                    </div>
                @elseif($tickets[0]->user->id != session('user_id'))
                    <p>آگهی دهنده گرامی در صورت تمایل به برقراری ارتباط با {{' '.$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name}} ورودی زیر را انتخاب کرده و دکمه ارسال را بزنید در صورت تایید هر دو طرف اطلاعات تماس طرفین جهت برقراری ارتباط در اختیار شما قرار داده می شود؛</p>
                    <div class="checkboxes in-row margin-bottom-20">
                        <input id="check-a" type="checkbox" name="check">
                        <label for="check-a">تایید نمایش اطلاعات تماس شما به
                            <span class="bg-danger">{{' '.$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name}}</span>
                        </label>
                        <button class="button" onclick="event.preventDefault();document.getElementById('confirm').submit()">ارسال</button>
                        <form id="confirm" action="{{route('confirmation')}}" method="post">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{$tickets[0]->id}}">
                        </form>
                    </div>
                @endif

            @endif
        </div>

        <div class="row margin-bottom-20">
            <div class="col-lg-12 col-md-12">

                @if(count($errors))
                    <div class="notification error closeable">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                        <a class="close" href=""></a>
                    </div>
                @endif

                <div class="dashboard-list-box margin-top-0">

                    <!-- Reply to review popup -->
                    <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                        <div class="small-dialog-header">
                            <h3>پاسخ به تیکت</h3>
                        </div>
                        <div class="message-reply margin-top-0">
                            <form action="{{route('insert-ticket-answer')}}" method="post">
                                @csrf
                                <textarea name="message" cols="40" rows="3" placeholder="متن تیکت"></textarea>
                                <input type="hidden" name="ticket_id" value="{{$tickets[0]->id}}">
                                <input type="hidden" name="announcement_id" value="{{$tickets[0]->announcement->id}}">
                                {{--                            @if($tickets[0]->sender_id == session('user_id'))--}}
                                {{--                                <input type="" name="receiver_id" value="{{$tickets[0]->announcement->user->id}}">--}}
                                {{--                            @else--}}
                                {{--                                <input type="" name="receiver_id" value="{{$tickets[0]->id}}">--}}
                                {{--                            @endif--}}
                                <button type="submit" class="button">ارسال</button>
                            </form>
                        </div>
                    </div>

                    <h4>مربوط به آگهی:
                        <span class="twitter-profile">
                            {{$tickets[0]->announcement->title}}
                        </span>

                    </h4>
                    <ul>

                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=120" alt=""></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3> {{$tickets[0]->user->first_name.' '.$tickets[0]->user->last_name}}<span class="text-danger">@if($tickets[0]->user->id == session('user_id')){{'(شما)'}}@endif</span>
                                            {{--                                            <span class="booking-status pending">در انتظار</span><span class="booking-status unpaid">بدون پرداخت هزینه</span></h3>--}}

                                            <div class="inner-booking-list">
                                                <h5>تاریخ ارسال:</h5>
                                                <ul class="booking-list">
                                                    <li class="highlighted">{{$tickets[0]->created_at}}</li>
                                                </ul>
                                            </div>

                                            <div class="inner-booking-list">
                                                <h5>متن تیکت:</h5>
                                                <ul class="booking-list">
                                                    <li class="highlighted" style="margin: 10px">{{$tickets[0]->message}}</li>
                                                </ul>
                                            </div>

                                            <a href="#small-dialog" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i>پاسخ به تیکت</a>

                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="buttons-to-right">--}}
                            {{--                                <a href="#" class="button gray reject"><i class="sl sl-icon-close"></i> رد کنید</a>--}}
                            {{--                                <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> تایید</a>--}}
                            {{--                            </div>--}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        @if($ticket_answer)
            <div class="row margin-bottom-35">
                <!-- Listings -->
                <div class="col-lg-12 col-md-12">

                    <div class="dashboard-list-box margin-top-0">
                        <ul>
                            @foreach($ticket_answer as $answer)
                                @if($answer->sender->id == session('user_id'))
                                    <li style="background-color: #f7f7f7">
                                @else
                                    <li>
                                        @endif
                                        <div class="comments listing-reviews">
                                            <ul>
                                                <li>
                                                    <div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="user" /></div>
                                                    <div class="comment-content"><div class="arrow-comment"></div>
                                                        <div class="comment-by">{{$answer->sender->first_name.' '.$answer->sender->last_name}}
                                                            <span class="text-danger">@if($answer->sender->id == session('user_id')){{'(شما)'}}@endif</span>
                                                            <span class="date">{{$answer->created_at}}</span>
                                                            {{--                                                        <div class="star-rating" data-rating="5"></div>--}}
                                                        </div>
                                                        <p>{{$answer->message}}</p>
                                                        {{--                                                    <div class="review-images mfp-gallery-container">--}}
                                                        {{--                                                        <a href="images/review-image-02.jpg" class="mfp-gallery"><img src="images/review-image-02.jpg" alt=""></a>--}}
                                                        {{--                                                        <a href="images/review-image-03.jpg" class="mfp-gallery"><img src="images/review-image-03.jpg" alt=""></a>--}}
                                                        {{--                                                    </div>--}}
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
