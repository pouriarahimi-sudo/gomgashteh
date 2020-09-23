@extends('user.layouts.master')

@section('user-title'){{'ثبت آگهی'}}@endsection

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


    @if(Session::has('notExist'))
        <!-- Container -->
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <div class="notification notice large margin-bottom-40 margin-top-40">
                        <p>لطفا فرم زیر که مربوط به اطلاعات شخصی شماست تکمیل کنید و دکمه ادامه را انتخاب کنید</p>
                        {{--                <p>اگر شما یک حساب کاربری ندارید، می توانید با وارد کردن آدرس ایمیل خود در قسمت جزئیات تماس، یکی را ایجاد کنید. رمز عبور به صورت خودکار به شما ایمیل خواهد شد.</p>--}}
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
                            <p>{{Session::get('success')}}</p>
                            <a class="close" href=""></a>
                        </div>
                    @endif

                    @if (Session::has('existNC'))
                        <div class="notification error closeable">
                            <p>{{Session::get('existNC')}}</p>
                            <a class="close" href=""></a>
                        </div>
                    @endif

                    <div id="add-listing" class="separated-form">

                        <form action="{{route('complete-info')}}" method="post">
                        @csrf

                        <!-- Section -->
                            <div class="add-listing-section">

                                <!-- Headline -->
                                <div class="add-listing-headline">
                                    <h3><i class="sl sl-icon-info"></i> تکمیل اطلاعات فردی</h3>
                                </div>
                                <!-- Row -->
                                <div class="row with-forms">


                                    <div class="col-md-3">
                                        <h5>کد ملی</h5>
                                        <input name="national_code" type="number" value="{{old('national_code')}}" >
                                    </div>

                                    <div class="col-md-3">
                                        <h5>تاریخ تولد</h5>
                                        <input name="birthday" type="text" value="{{old('birthday')}}">
                                    </div>

                                    <div class="col-md-3">
                                        <h5>استان</h5>
                                        <select name="province">
                                            <option value="" >لطفا انتخاب کنید</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <h5>شهر</h5>
                                        <select name="city">
                                            <option value="" >لطفا انتخاب کنید</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- Row / End -->
                            </div>
                            <!-- Section / End -->

                            <button type="submit" class="button preview">ادامه<i class="fa fa-arrow-circle-right"></i></button>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    @endif



    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    {{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}

    {{--    <div class="btn-group btn-group-toggle" data-toggle="buttons">--}}
    {{--        <label class="btn btn-warning active">--}}
    {{--            <input type="radio" name="options" id="option1" autocomplete="off" checked> Active--}}
    {{--        </label>--}}
    {{--        <label class="btn btn-warning">--}}
    {{--            <input type="radio" name="options" id="option2" autocomplete="off"> Radio--}}
    {{--        </label>--}}
    {{--        <label class="btn btn-warning">--}}
    {{--            <input type="radio" name="options" id="option3" autocomplete="off"> Radio--}}
    {{--        </label>--}}
    {{--    </div>--}}


    @if(!Session::has('notExist'))
        <!-- Titlebar
================================================== -->
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <h2><i class="sl sl-icon-plus"></i> ثبت آگهی</h2>

                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">صفحه اصلی</a></li>
                                <li>ثبت آگهی</li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>


        <!-- Content
        ================================================== -->

        <!-- Container -->
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <div class="notification notice large margin-bottom-40">
                        <h4>آیا حساب کاربری ندارید؟ 🙂</h4>
                        <p>اگر شما یک حساب کاربری ندارید، می توانید با وارد کردن آدرس ایمیل خود در قسمت جزئیات تماس، یکی را ایجاد کنید. رمز عبور به صورت خودکار به شما ایمیل خواهد شد.</p>
                    </div>

                    @if(count($errors))
                        <div class="notification error closeable">
                            @foreach($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                            <a class="close" href=""></a>
                        </div>
                    @endif

                    @if (Session::has('notOpload'))
                        <div class="notification error closeable">
                            <p>{{Session::get('notOpload')}}</p>
                            <a class="close" href=""></a>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="notification success closeable">
                            <p>{{Session::has('success')}}</p>
                            <a class="close" href=""></a>
                        </div>
                    @endif

                    <form action="{{route('insert-announce')}}" method="post" enctype="multipart/form-data">
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
                                        <input name="type" type="radio" value="1">
                                    </div>

                                    <div class="col-md-6">
                                        <h5>پیدا کرده ام</h5>
                                        <input name="type" type="radio" value="2">
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
                                        <input name="title" class="search-field" type="text" value="{{old('title')}}"/>
                                    </div>


                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <h5>دسته بندی</h5>
                                        <select name="category">
                                            <option value="" >لطفا انتخاب کنید</option>
                                            @foreach($categories as $category)
                                                <option  value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Collection -->
                                    <div class="col-md-6">
                                        <h5>زیر مجموعه</h5>
                                        <select name="collection">
                                            <option value="" >لطفا انتخاب کنید</option>
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
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- City -->
                                        <div class="col-md-6">
                                            <h5>شهر</h5>
                                            <select name="city">
                                                <option value="" >لطفا انتخاب کنید</option>
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
                                    <div >
                                        <input name="pictures[]" type="file" multiple >
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
                                    <textarea class="WYSIWYG" name="detail" cols="40" rows="3" id="summary" spellcheck="true"></textarea>
                                </div>
                                <!-- Section / End -->

                                <button type="submit" class="button preview">ثبت آگهی <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
        <!-- Content / End -->
        <!-- Container / End -->
    @endif

@endsection

<script src="{{asset('scripts/dropzone.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/insert-announce.js')}}"></script>



