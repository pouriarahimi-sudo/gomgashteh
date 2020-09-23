@extends('user.layouts.master')

@section('user-title'){{'صفحه اصلی'}}@endsection

@section('user-content')

    <!-- Titlebar
================================================== -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

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


    <!-- Content
    ================================================== -->
    <div class="container margin-bottom-60">

        @if (Session::has('announcer'))
            <div class="notification success closeable">
                <p>{{Session::get('announcer')}}</p>
                <a class="close" href=""></a>
            </div>
        @endif

            @if (Session::has('success'))
                <div class="notification success closeable">
                    <p>{{Session::get('success')}}</p>
                    <a class="close" href=""></a>
                </div>
            @endif

        <div class="row">

            <div class="col-lg-9 col-md-8 padding-right-30">

                <!-- Sorting / Layout Switcher -->
{{--                <div class="row margin-bottom-25">--}}

{{--                    <div class="col-md-6 col-xs-6">--}}
{{--                        <!-- Layout Switcher -->--}}
{{--                        <div class="layout-switcher">--}}
{{--                            <a href="" class="grid active"><i class="fa fa-th"></i></a>--}}
{{--                            <a href="" class="list"><i class="fa fa-align-justify"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6 col-xs-6">--}}
{{--                        <!-- Sort by -->--}}
{{--                        <div class="sort-by">--}}
{{--                            <div class="sort-by-select">--}}
{{--                                <select data-placeholder="سفارش پیش فرض" class="chosen-select-no-single">--}}
{{--                                    <option>سفارش پیش فرض</option>--}}
{{--                                    <option>بالاترین امتیاز</option>--}}
{{--                                    <option>بیشترین نظر دار</option>--}}
{{--                                    <option>آگهی های جدید</option>--}}
{{--                                    <option>آگهی ها قدیمی</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- Sorting / Layout Switcher / End -->


                <div class="row">

                    @foreach($announcements as $item)
                    <!-- Listing Item -->
                    <div class="col-lg-12 col-md-12">
                        <div class="listing-item-container list-layout">
                            <a href="" onclick="event.preventDefault(); document.getElementById('details_{{$item->id}}').submit();" class="listing-item">

                                <!-- Image -->
                                <div class="listing-item-image">
                                    <img src="images/listing-item-01.jpg" alt="announce">
{{--                                    <span class="tag">{{$notice->category->name.' - '.$notice->collection->name}}</span>--}}
                                </div>

                                <!-- Content -->
                                <div class="listing-item-content">
                                    <div class="listing-badge @if($item->type == 2){{'now-open'}}@elseif($item->type == 1){{'now-closed'}}@endif">
                                        @if($item->type == 1){{'گم شده'}}
                                        @elseif($item->type == 2){{'پیدا شده'}}
                                        @endif
                                    </div>

                                    <div class="listing-item-inner">
                                        <h3>{{$item->title}}<i class="verified-icon"></i></h3>
                                        <span>{{$item->province->name.' - '.$item->city->name}}</span>
                                        <div class="star-rating" data-rating="3.5">
                                            <div class="rating-counter">(12 نظر)</div>
                                        </div>
                                    </div>

                                    <span class="like-icon"></span>
                                </div>
                            </a>
                            <form id="details_{{$item->id}}" action="{{route('details-announcement')}}" method="post" style="display: none">
                                @csrf
                                <input type="hidden" name="announce_id" value="{{$item->id}}">
                            </form>
                        </div>
                    </div>
                    <!-- Listing Item / End -->
                        @endforeach


                </div>

                <!-- Pagination -->
                <div class="clearfix"></div>
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <!-- Pagination -->--}}
{{--                        <div class="pagination-container margin-top-20 margin-bottom-40">--}}
{{--                            <nav class="pagination">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#" class="current-page">1</a></li>--}}
{{--                                    <li><a href="#">2</a></li>--}}
{{--                                    <li><a href="#">3</a></li>--}}
{{--                                    <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </nav>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- Pagination / End -->

            </div>


            <!-- Sidebar
            ================================================== -->
            <div class="col-lg-3 col-md-4">
                <div class="sidebar">

                    <!-- Widget -->
                    <div class="widget margin-bottom-40">
                        <h3 class="margin-top-0 margin-bottom-30">فیلتر ها</h3>

                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Cities -->
                            <div class="col-md-12">
                                <input type="text" placeholder="دنبال چی میگردی؟" value=""/>
                            </div>
                        </div>
                        <!-- Row / End -->


                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Type -->
                            <div class="col-md-12">
                                <select class="chosen-select" >
                                    <option value="0">همه دسته ها</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Row / End -->


                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Cities -->
                            <div class="col-md-12">

                                <div class="input-with-icon location">
                                    <div id="autocomplete-container">
                                        <input id="autocomplete-input" type="text" placeholder="موقعیت">
                                    </div>
                                    <a href=""><i class="fa fa-map-marker"></i></a>
                                </div>

                            </div>
                        </div>
                        <!-- Row / End -->
                        <br>

                        <!-- Area Range -->
{{--                        <div class="range-slider">--}}
{{--                            <input class="distance-radius" type="range" min="1" max="100" step="1" value="50" data-title="شعاع اطراف مقصد انتخاب شده">--}}
{{--                        </div>--}}


                        <!-- More Search Options -->
{{--                        <a href="#" class="more-search-options-trigger margin-bottom-5 margin-top-20" data-open-title="فیلترهای بیشتر" data-close-title="فیلترهای بیشتر"></a>--}}

{{--                        <div class="more-search-options relative">--}}

{{--                            <!-- Checkboxes -->--}}
{{--                            <div class="checkboxes one-in-row margin-bottom-15">--}}

{{--                                <input id="check-a" type="checkbox" name="check">--}}
{{--                                <label for="check-a">آسانسور در ساختمان</label>--}}

{{--                                <input id="check-b" type="checkbox" name="check">--}}
{{--                                <label for="check-b">فضای کاری دوستانه</label>--}}

{{--                                <input id="check-c" type="checkbox" name="check">--}}
{{--                                <label for="check-c">رزرو فوری</label>--}}

{{--                                <input id="check-d" type="checkbox" name="check">--}}
{{--                                <label for="check-d">اینترنت بیسیم</label>--}}

{{--                                <input id="check-e" type="checkbox" name="check" >--}}
{{--                                <label for="check-e">پارکینگ رایگان در محل</label>--}}

{{--                                <input id="check-f" type="checkbox" name="check" >--}}
{{--                                <label for="check-f">پارکینگ رایگان در خیابان</label>--}}

{{--                                <input id="check-g" type="checkbox" name="check">--}}
{{--                                <label for="check-g">سیگار کشیدن مجاز است</label>--}}

{{--                                <input id="check-h" type="checkbox" name="check">--}}
{{--                                <label for="check-h">رویداد ها</label>--}}

{{--                            </div>--}}
                            <!-- Checkboxes / End -->

                        </div>
                        <!-- More Search Options / End -->

                        <button class="button fullwidth margin-top-25">به روز رسانی</button>

                    </div>
                    <!-- Widget / End -->

                </div>
            </div>
            <!-- Sidebar / End -->
        </div>
    </div>


@endsection

