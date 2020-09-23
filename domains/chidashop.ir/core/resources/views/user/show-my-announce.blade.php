@extends('user.layouts.master')

@section('user-title'){{'تیکت من'}}@endsection

@section('user-content')



    <!-- Slider
================================================== -->
    {{--    <div class="listing-slider mfp-gallery-container margin-bottom-0">--}}
    {{--        <a href="images/single-listing-01.jpg" data-background-image="images/single-listing-01.jpg" class="item mfp-gallery" title="عکس 1"></a>--}}
    {{--        <a href="images/single-listing-02.jpg" data-background-image="images/single-listing-02.jpg" class="item mfp-gallery" title="عکس 3"></a>--}}
    {{--        <a href="images/single-listing-03.jpg" data-background-image="images/single-listing-03.jpg" class="item mfp-gallery" title="عکس 2"></a>--}}
    {{--        <a href="images/single-listing-04.jpg" data-background-image="images/single-listing-04.jpg" class="item mfp-gallery" title="عکس 4"></a>--}}
    {{--    </div>--}}

    <!-- Content
    ================================================== -->
    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-8 col-md-8 padding-right-30">

                <!-- Titlebar -->
                <div id="titlebar" class="listing-titlebar">
                    <div class="listing-titlebar-title">
                        <h2>{{$announce->title}}<span class="listing-tag">
                                 @if($announce->type == 1){{'پیدا شده'}}
                                @elseif($announce->type == 2){{'گم شده'}}
                                @endif
                            </span>
                        </h2>
                        <span>
						<a href="#listing-location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							{{$announce->province->name.' - '.$announce->city->name}}
						</a>
					</span>
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
                                <div class="listing-badge now-open">
                                    @if($announce->type == 1){{'پیدا شده'}}
                                    @elseif($announce->type == 2){{'گم شده'}}
                                    @endif
                                </div>
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

@endsection
