@extends('admin.layouts.master')

@section('admin-title'){{'مدیریت کاربران'}}@endsection

@section('admin-content')
    <!-- Titlebar -->
    <div class="row">

        <!-- Listings -->
        <div class="col-lg-12 col-md-12">
            <div class="dashboard-list-box margin-top-0">

                <!-- Reply to review popup -->
{{--                <div id="small-dialog" class="zoom-anim-dialog mfp-hide">--}}
{{--                    <div class="small-dialog-header">--}}
{{--                        <h3>ارسال پیام</h3>--}}
{{--                    </div>--}}
{{--                    <div class="message-reply margin-top-0">--}}
{{--                        <textarea cols="40" rows="3" placeholder="پیام شما به طاهر"></textarea>--}}
{{--                        <button class="button">ارسال</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a href="#small-dialog" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> ارسال پیام</a>--}}

{{--                <h4>درخواست رزرو</h4>--}}

                <ul>

                    <li class="pending-booking">
                        <div class="list-box-listing bookings">
                            <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=120" alt=""></div>
                            <div class="list-box-listing-content">
                                <div class="inner">
                                    <h3>عنوان آکهی : </h3>{{$announce->title}}
                                    <div class="inner-booking-list">
                                        <h5>نوع:</h5>
                                        <ul class="booking-list">
                                            <li class="highlighted"><span class="booking-status pending">@if($announce->type == 1){{'پیدا شده'}}</span><span class="booking-status unpaid">@elseif($announce->type == 2){{'گم شده'}} @endif </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="inner-booking-list">
                                        <span class="fa fa-map-marker"> <h5> استان و شهر:</h5> </span>
                                        <ul class="booking-list">
                                            <li class="highlighted">{{$announce->province['name'].' - '.$announce->city['name']}}</li>
                                        </ul>
                                    </div>

                                    <div class="inner-booking-list">
                                        <h5>وضعیت:</h5>
                                        <ul class="booking-list">
                                            <li class="highlighted">@if($announce->status == 0)<span>{{'جدید'}}</span>
                                                @elseif($announce->status == 1)<span class="text-success">{{'تأیید شده'}}</span>
                                                @elseif($announce->status == 2)<span class="text-danger">{{'رد شده'}}</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-to-right">
                            @if($announce->status == 1)
                                <a class="button gray reject" onclick="event.preventDefault(); document.getElementById('fail-all_{{$announce->id}}').submit();" ><i class="sl sl-icon-close"></i>ردکنید</a>
                            @elseif($announce->status == 2)
                                <a class="button gray approve" onclick="event.preventDefault(); document.getElementById('accept-all_{{$announce->id}}').submit();" ><i class="sl sl-icon-check"></i> تایید </a>
                            @elseif($announce->status == 0)
                                <a class="button gray approve" onclick="event.preventDefault(); document.getElementById('accept-all_{{$announce->id}}').submit();" ><i class="sl sl-icon-check"></i> تایید </a>
                                <a class="button gray reject" onclick="event.preventDefault(); document.getElementById('fail-all_{{$announce->id}}').submit();" ><i class="sl sl-icon-close"></i>ردکنید</a>
                            @endif
                            <form action="{{route('status-change')}}" method="post" id="accept-all_{{$announce->id}}" style="display: none">
                                <input type="hidden" name="status" value="1">
                                <input type="hidden" name="id" value="{{$announce->id}}">
                                <input type="hidden" name="value_tab" value="{{$value_tab}}">
                                @csrf
                                @method('put')
                            </form>
                            <form action="{{route('status-change')}}" method="post" id="fail-all_{{$announce->id}}" style="display: none">
                                <input type="hidden" name="status" value="2">
                                <input type="hidden" name="id" value="{{$announce->id}}">
                                <input type="hidden" name="value_tab" value="{{$value_tab}}">
                                @csrf
                                @method('put')
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


@endsection

    <!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
        <script src="scripts/moment.min.js"></script>
        <script src="scripts/daterangepicker.js"></script>

{{--        <script>--}}
{{--            $(function() {--}}

{{--                var start = moment().subtract(29, 'days');--}}
{{--                var end = moment();--}}

{{--                function cb(start, end) {--}}
{{--                    $('#booking-date-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));--}}
{{--                }--}}
{{--                cb(start, end);--}}
{{--                $('#booking-date-range').daterangepicker({--}}
{{--                    "opens": "left",--}}
{{--                    "autoUpdateInput": false,--}}
{{--                    "alwaysShowCalendars": true,--}}
{{--                    startDate: start,--}}
{{--                    endDate: end,--}}
{{--                    ranges: {--}}
{{--                        'امروز': [moment(), moment()],--}}
{{--                        'دیروز': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],--}}
{{--                        '7 روز قبل': [moment().subtract(6, 'days'), moment()],--}}
{{--                        '30 روز قبل': [moment().subtract(29, 'days'), moment()],--}}
{{--                        'ماه اخیر': [moment().startOf('month'), moment().endOf('month')],--}}
{{--                        'ماه های اخیر': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]--}}
{{--                    }--}}
{{--                }, cb);--}}

{{--                cb(start, end);--}}

{{--            });--}}

{{--            // Calendar animation and visual settings--}}
{{--            $('#booking-date-range').on('show.daterangepicker', function(ev, picker) {--}}
{{--                $('.daterangepicker').addClass('calendar-visible calendar-animated bordered-style');--}}
{{--                $('.daterangepicker').removeClass('calendar-hidden');--}}
{{--            });--}}
{{--            $('#booking-date-range').on('hide.daterangepicker', function(ev, picker) {--}}
{{--                $('.daterangepicker').removeClass('calendar-visible');--}}
{{--                $('.daterangepicker').addClass('calendar-hidden');--}}
{{--            });--}}
{{--        </script>--}}
