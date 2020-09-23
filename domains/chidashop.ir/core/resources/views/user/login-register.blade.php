@extends('user.layouts.master')

@section('user-title'){{'صفحه اصلی'}}@endsection

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

    @if(!Session::has('randomCode'))
        <!-- Container -->
        <div class="container">
            <div class="col-lg-12">
                <div class="row">
                    <div class="notification notice large margin-bottom-55">
                        <h4>آیا حساب کاربری ندارید؟ 🙂</h4>
                        <p>اگر شما یک حساب کاربری ندارید، می توانید با وارد کردن آدرس ایمیل خود در قسمت جزئیات تماس، یکی را ایجاد کنید. رمز عبور به صورت خودکار به شما ایمیل خواهد شد.</p>
                    </div>
                    <center>
                        @if(count($errors))
                            <div class="notification error closeable">
                                @foreach($errors->all() as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                                    <a class="close" href=""></a>
                            </div>
                        @endif
                            @if(Session::has('noExistence'))
                                <div class="notification error closeable">
                                        <p>کاربری با این شماره ثبت نشده است</p>
                                    <a class="close" href=""></a>
                                </div>
                                <div class="notification success closeable">
                                    <p>ابتدا در قسمت ایجاد حساب کاربری در همین صفحه ثبت نام کنید.</p>
                                    <a class="close" href=""></a>
                                </div>
                            @endif
                    </center>

                    <div class="col-lg-6 margin-bottom-50">
                        <div id="add-listing" class="separated-form">
                            <form action="{{route('authentication-login')}}" method="post">
                                @csrf
                            <!-- Section -->
                            <div class="add-listing-section">
                                <!-- Headline -->
                                <div class="add-listing-headline">
                                    <h3><i class="sl sl-icon-login"></i>ورود به حساب کاربری</h3>
                                </div>
                                <!-- Title -->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>شماره همراه <i class="tip" data-tip-content="شماره همراه خود را با صفر وارد کنید"></i></h5>
                                        <input class="search-field" type="number" name="phone_num"/>
                                    </div>
                                </div>

                                <div class="checkboxes in-row margin-bottom-20">

                                    <input id="check-a" type="checkbox" name="check">
                                    <label for="check-a">مرا به خاطر بسپار</label>

                                </div>
                                <!-- Checkboxes / End -->
                                <button type="submit" class="button preview">ورود <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                            <!-- Section / End -->
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 margin-bottom-50">
                        <div id="add-listing" class="separated-form">
                            <form action="{{route('user-validation')}}" method="post">
                                @csrf
                                @method('put')
                            <!-- Section -->
                            <div class="add-listing-section">
                                <!-- Headline -->
                                <div class="add-listing-headline">
                                    <h3><i class="im im-icon-Add-User"></i>فرم ایجاد حساب کاربری</h3>
                                </div>
                                <!-- Title -->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>نام <i class="tip" data-tip-content="نام خود را وارد کنید"></i></h5>
                                        <input class="search-field" type="text" name="first_name"/>
                                    </div>
                                </div>
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>نام خانوادگی <i class="tip" data-tip-content="نام خانوادگی خود را وارد کنید"></i></h5>
                                        <input class="search-field" type="text" name="last_name"/>
                                    </div>
                                </div>
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <h5>شماره همراه <i class="tip" data-tip-content="شماره همراه خود را با صفر اول وارد کنید"></i></h5>
                                        <input class="search-field" type="text" name="phone_num"/>
                                    </div>
                                </div>
                                <button type="submit" class="button preview">ثبت نام <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                            <!-- Section / End -->
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container / End -->
    @endif

    @if(Session::has('randomCode'))
            <!-- Container -->
            <div class="container">
                <div class="row margin-top-55">
                    <div class="col-lg-3 margin-bottom-55"></div>
                    <div class="col-lg-6 margin-bottom-55">
                        <center>
                            @if(count($errors))
                                <div class="notification error closeable">
                                    @foreach($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                        <a class="close" href="#"></a>
                                </div>
                            @endif
                        </center>
                        <div id="add-listing" class="separated-form">
                            <form action="{{route('user-compare-code')}}" method="post">
                                @csrf
                                @method('put')
                            <!-- Section -->
                            <div class="add-listing-section">
                                <!-- Headline -->
                                <div class="add-listing-headline">
                                    <h3><i class="sl sl-icon-login"></i>کد دریافت شده را وارد کنید</h3>
                                </div>
                                <!-- Title -->
                                <div class="row with-forms">
                                    <div class="col-md-12">
{{--                                        <input class="search-field" type="text" name="verify_code"/>--}}
                                        <input class="search-field" type="text" name="verify_code" value="{{session::get('rand')}}"/>
                                    </div>
                                </div>
                                <button type="submit" class="button preview">ورود <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                            <!-- Section / End -->
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 margin-bottom-55"></div>
                </div>
            </div>
            <!-- Container / End -->
    @endif

@endsection

