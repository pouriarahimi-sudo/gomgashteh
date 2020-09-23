@extends('user.layouts.master')

@section('user-title'){{'ارسال تیکت برای آگهی'}}@endsection

@section('user-content')

    <!-- Titlebar
================================================== -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>ارسال تیکت</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li>آگهی ها</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>

    <div class="container padding-bottom-20">
        <div class="row">
            <div class="col-lg-12">
                <div id="add-listing">
                    <form action="{{route('insert-new-ticket')}}" method="post">
                        @csrf
                        <!-- Section -->
                    <div class="add-listing-section margin-top-45">
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-docs"></i>عنوان آگهی: {{$announce->title}}</h3>
                        </div>
                        <!-- Description -->
                        <div class="form">
                            <h5>متن تیکت</h5>
                            <textarea class="WYSIWYG" name="message" cols="40" rows="3" id="summary" spellcheck="true"></textarea>
                        </div>
                    </div>
                    <!-- Section / End -->

                    <!-- Section -->
                    <div class="add-listing-section margin-top-45">
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-picture"></i> انتخاب عکس</h3>
                        </div>
                        <!-- Dropzone -->
                        <div class="submit-section">
                            <div action="http://www.vasterad.com/file-upload" class="dropzone" >
                                <input name="pictures[]" type="hidden">
                            </div>
                        </div>
                    </div>
                    <!-- Section / End -->
                    <button type="submit" class="button preview">ثبت تیکت <i class="fa fa-arrow-circle-right"></i></button>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection

<script src="{{asset('scripts/dropzone.js')}}"></script>
