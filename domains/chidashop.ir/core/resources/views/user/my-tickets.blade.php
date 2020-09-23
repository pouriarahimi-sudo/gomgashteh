@extends('user.layouts.master')

@section('user-title'){{'ارسال تیکت'}}@endsection

@section('user-content')

    <!-- Titlebar -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>تیکت های من</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li>تیکت های من</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="container padding-bottom-60">
        <div class="row">
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">

                @if(count($tickets))
                <div class="messages-container margin-top-0">
                    <div class="messages-headline">
                        <h4>صندوق ورودی</h4>
                    </div>

                    <div class="messages-inbox">

                        <ul>
                                @foreach($tickets as $ticket)
                                    @if($ticket->user->id == session('user_id') || $ticket->announcement->announcer_id == session('user_id'))
                                        <li class="unread">
                                            <a href="" onclick="event.preventDefault(); document.getElementById('show_ticket_{{$ticket->id}}').submit();">
{{--                                            <a href="{{route('show-ticket',['id' => $ticket->id])}}">--}}
{{--                                                <a href="/show-ticket/{{$ticket->id}}">--}}
                                                <div class="message-avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>

                                                <div class="message-by">
                                                    <div class="message-by-headline">
                                                        <h5>{{$ticket->user->first_name.' '.$ticket->user->last_name}}@if($ticket->user->id == session('user_id')){{'(شما)'}}@endif
{{--                                                            <i class="margin-right-20">خوانده نشده</i>--}}
                                                        </h5>
                                                        <span>{{$ticket->created_at}}</span>
                                                    </div>
                                                    <p>{{$ticket->message}}</p>
                                                </div>
                                            </a>
                                            <form id="show_ticket_{{$ticket->id}}" action="{{route('show-ticket')}}" method="get" style="display: none">
                                                <input type="hidden" name="ticket_id" value="{{encrypt($ticket->id)}}">
                                            </form>
                                        </li>
                                    @endif
                                @endforeach

                    </div>
                </div>
                @else
                    <div class="notification error closeable">
                        <p>تیکتی برای شما ثبت نشده است</p>
                    </div>
            @endif

                <!-- Pagination -->
{{--                <div class="clearfix"></div>--}}
{{--                <div class="pagination-container margin-top-30 margin-bottom-0">--}}
{{--                    <nav class="pagination">--}}
{{--                        <ul>--}}
{{--                            <li><a href="#" class="current-page">1</a></li>--}}
{{--                            <li><a href="#">2</a></li>--}}
{{--                            <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>--}}
{{--                        </ul>--}}
{{--                    </nav>--}}
{{--                </div>--}}
                <!-- Pagination / End -->

            </div>

        </div>
    </div>

@endsection
