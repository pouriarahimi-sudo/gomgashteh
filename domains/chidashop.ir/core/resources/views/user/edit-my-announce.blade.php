@extends('user.layouts.master')

@section('user-title'){{'ویرایش آگهی'}}@endsection
<style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance:textfield;
    }
</style>

@section('user-content')
    <!-- Titlebar
================================================== -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2><i class="sl sl-icon-plus"></i>مدیریت آگهی</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">

                        <!-- Reply to review popup -->
                        {{--                                            <a href="#small-dialog" class="button preview"><i class="sl sl-icon-close"></i> حذف آگهی</a>--}}
                        {{--                            <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> ارسال پیام</a>--}}
                        {{--                            <button type="submit" class="button preview">حذف آگهی <i class="fa fa-arrow-circle-right"></i></button>--}}
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="style-1">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1b">پیش نمایش آگهی</a></li>
                        <li><a href="#tab2b">ارتقاء</a></li>
                        <li><a href="#tab3b">ویرایش</a></li>
                        <li><a href="#tab4b">حذف آگهی</a></li>
                    </ul>
                    <!-- Tabs Content -->
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1b">
                            <div class="row sticky-wrapper">
                                <div class="col-lg-8 col-md-8 padding-right-30">
                                    <!-- Titlebar -->
                                    <div id="titlebar" class="listing-titlebar">
                                        <div class="listing-titlebar-title">
                                            <h2>{{$announce->title}}
                                                <span class="listing-tag">
                                                    @if($announce->type == 2){{'پیدا شده'}}
                                                    @elseif($announce->type == 1){{'گم شده'}}
                                                    @endif
                                                </span>
                                            </h2>
                                            <span>
                                                <a href="#listing-location" class="listing-address">
                                                    <i class="fa fa-map-marker"></i>
                                                    {{$announce->province->name.' - '.$announce->city->name}}
                                                </a>
					                        </span>
                                            <div>
                                                <div class="rating-counter">آگهی دهنده: {{$announce->user->first_name.' '.$announce->user->last_name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Listing Nav -->
                                    <div id="listing-nav" class="listing-nav-container">
                                        <ul class="listing-nav">
                                            <li><a href="#listing-overview" class="active">توضیحات</a></li>
                                        </ul>
                                    </div>
                                    <!-- Overview -->
                                    <div id="listing-overview" class="listing-section">
                                        <!-- Description -->
                                        <p>
                                            {{$announce->detail}}
                                        </p>
                                    </div>
                                </div>
                                <!-- Sidebar
                                ================================================== -->
                                    <div class="col-lg-4 col-md-4 margin-top-75 sticky">
                                        <div class="carousel-item">
                                                <a href="" class="listing-item-container compact">
                                                    <div class="listing-item">
                                                        @if($announce->pictures != [])
                                                            <img src="images/listing-item-01.jpg" alt="">
                                                            @if($announce->type == 2)
                                                                <div class="listing-badge now-open">{{'پیدا شده'}}</div>
                                                            @elseif($announce->type == 1){{'گم شده'}}
                                                            <div class="listing-badge now-closed">{{'گم شده'}}</div>
                                                            @endif
                                                        @else
                                                            <img src="images/camera-icon.png" alt="">
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- Share / Like -->
                                                <div class="listing-share margin-top-40 margin-bottom-40 no-border">
                                                    <span>* نفر این آگهی را نشانه گذاری کرده اند</span>
                                                    <div class="clearfix"></div>
                                                </div>
                                    </div>

                                <!-- Sidebar / End -->
                            </div>
                        </div>
                        <div class="tab-content" id="tab2b">
                            <h3>tab2</h3>
                        </div>
                        <div class="tab-content" id="tab3b">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="notification notice large margin-bottom-40">
                                        <h4>میتوانید آگهی خود را ویرایش کنید 🙂</h4>
                                        {{--                        <p>اگر شما یک حساب کاربری ندارید، می توانید با وارد کردن آدرس ایمیل خود در قسمت جزئیات تماس، یکی را ایجاد کنید. رمز عبور به صورت خودکار به شما ایمیل خواهد شد.</p>--}}
                                    </div>
                                    @if(count($errors))
                                        <div class="notification error closeable">
                                            @foreach($errors->all() as $error)
                                                <p>{{$error}}</p>
                                            @endforeach
                                            <a class="close" href=""></a>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="notification success closeable">
                                            <p>{{Session::has('success')}}</p>
                                            <a class="close" href=""></a>
                                        </div>
                                    @endif

                                    <form action="{{route('update-announce')}}" method="post">
                                        <input type="hidden" name="id" value="{{$announce->id}}">
                                        @csrf
                                        <div id="add-listing" class="separated-form">
                                            <!-- Section -->
                                            <div class="add-listing-section">
                                                <!-- Headline -->
                                                <div class="add-listing-headline">
                                                    <h3><i class="sl sl-icon-info"></i>نوع آگهی</h3>
                                                </div>
                                                <!-- Row -->
                                                <div class="row with-forms">
                                                    <div class="col-md-6">
                                                        <h5>گم کرده ام</h5>
                                                        <input name="type" type="radio" value="1" @if($announce['type'] == 1) {{'checked'}}@endif>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>پیدا کرده ام</h5>
                                                        <input name="type" type="radio" value="2" @if($announce['type'] == 2) {{'checked'}}@endif>
                                                    </div>
                                                </div>
                                                <!-- Row / End -->
                                            </div>
                                            <!-- Section / End -->
                                            <!-- Section -->
                                            <div class="add-listing-section">
                                                <!-- Headline -->
                                                <div class="add-listing-headline">
                                                    <h3><i class="sl sl-icon-doc"></i> اطلاعات پایه</h3>
                                                </div>
                                                <!-- Row -->
                                                <div class="row with-forms">
                                                    <!-- Title  -->
                                                    <div class="col-md-12">
                                                        <h5>عنوان آگهی <i class="tip" data-tip-content="عنوانی که در سایت به مخاطب نمایش داده می شود"></i></h5>
                                                        <input name="title" class="search-field" type="text" value="{{$announce['title']}}"/>
                                                    </div>
                                                    <!-- Category -->
                                                    <div class="col-md-6">
                                                        <h5>دسته بندی</h5>
                                                        <select name="category">
                                                            <option value="">لطفا انتخاب کنید</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}" @if($announce->category->id == $category->id ){{'selected'}}@endif >{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Collection -->
                                                    <div class="col-md-6">
                                                        <h5>زیر مجموعه</h5>
                                                        <select name="collection">
                                                            <option value="">لطفا انتخاب کنید</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Row / End -->
                                            </div>
                                            <!-- Section / End -->

                                            <!-- Section -->
                                            <div class="add-listing-section margin-top-45">
                                                <!-- Headline -->
                                                <div class="add-listing-headline">
                                                    <h3><i class="sl sl-icon-location"></i> موقعیت</h3>
                                                </div>
                                                <div class="submit-section">
                                                    <!-- Row -->
                                                    <div class="row with-forms">
                                                        <!-- Province -->
                                                        <div class="col-md-6">
                                                            <h5>استان</h5>
                                                            <select name="province">
                                                                <option value="" >لطفا انتخاب کنید</option>
                                                                @foreach($provinces as $pro)
                                                                    <option value="{{ $pro->id }}" @if($announce->province->id) {{'selected'}} @endif >{{ $pro->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- City -->
                                                        <div class="col-md-6">
                                                            <h5>شهر</h5>
                                                            <select name="city">
                                                                <option value="">لطفا انتخاب کنید</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- Row / End -->
                                                </div>
                                            </div>
                                            <!-- Section / End -->
                                            <!-- Section -->
                                            <div class="add-listing-section margin-top-45">
                                                <!-- Headline -->
                                                <div class="add-listing-headline">
                                                    <h3><i class="sl sl-icon-picture"></i>تصاویر مربوط</h3>
                                                </div>
                                                <!-- Dropzone -->
                                                <div class="submit-section">
                                                    <div action="http://www.vasterad.com/file-upload" class="dropzone" >
                                                        <input name="pictures[]" type="hidden">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Section / End -->
                                            <!-- Section -->
                                            <div class="add-listing-section margin-top-45">
                                                <!-- Headline -->
                                                <div class="add-listing-headline">
                                                    <h3><i class="sl sl-icon-docs"></i> جزئیات</h3>
                                                </div>
                                                <!-- Description -->
                                                <div class="form">
                                                    <h5>توضیحات</h5>
                                                    <textarea class="WYSIWYG" name="detail" cols="40" rows="3" id="summary" spellcheck="true">{{$announce->detail}}</textarea>
                                                </div>
                                                <!-- Section / End -->
                                                <button type="submit" class="button preview">ثبت ویرایش <i class="fa fa-arrow-circle-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            <div class="tab-content" id="tab4b">
                                <div class="row with-forms">
                                    <form action="{{route('delete-announce')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="announce_id" value="{{$announce->id}}">

                                        <div class="col-md-4">
                                        <h5>مشکلم حل شد</h5>
                                        <input name="result" type="radio" value="1">
                                        </div>

                                        <div class="col-md-4">
                                        <h5>به نتیجه نرسیدم</h5>
                                        <input name="result" type="radio" value="2">
                                        </div>
                                        <div class="col-md-4">
                                        <button id="show_check" type="submit" class="button" style="display: none">حذف آگهی</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{--        <div class="notification error">--}}
    {{--            <h4>لطفا بعد از تماس نتیجه را با ما در میان بگذارید:</h4>--}}
    {{--            <form action="{{route('record-the-result')}}" method="post">--}}
    {{--                @csrf--}}
    {{--                <input type="hidden" name="ticket_id" value="{{$announce->id}}">--}}
    {{--                <label class="radio-inline">--}}
    {{--                    <input type="radio" value="1" name="result" checked>--}}
    {{--                    <span class="margin-right-30">مشکلم حل شد</span>--}}
    {{--                </label>--}}
    {{--                <label class="radio-inline">--}}
    {{--                    <input type="radio" value="2" name="result">--}}
    {{--                    <span class="margin-right-30">به نتیجه نرسیدم</span>--}}
    {{--                </label>--}}
    {{--                <button type="submit" class="button">ثبت نتیجه</button>--}}
    {{--            </form>--}}
    {{--        </div>--}}


    <!-- Content
        ================================================== -->

    <!-- Container -->

    <!-- Content / End -->
    <!-- Container / End -->


@endsection

<script src="{{asset('scripts/dropzone.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/insert-announce.js')}}"></script>

<script>
    $(document).ready(function() {
        $("input[name='result']").change(function () {
            var checkbox=event.target;
            if(checkbox.checked){
                $("#show_check").show();
            }
        });
        // $("input[name='check']").click(function() {
        //     $("#show_check").show();
        // });
    });

</script>
