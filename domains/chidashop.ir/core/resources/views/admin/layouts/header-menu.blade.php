<header id="header-container" class="fixed fullwidth dashboard">

    <!-- Header -->
    <div id="header" class="not-sticky">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <!-- Logo -->
                <div id="logo">
{{--                    <a href="index.html"><img src="images/logo.png" width="300px" height="300px" alt=""></a>--}}
{{--                    <br>--}}
{{--                    <a href="" ><span style="color: white">GomGashTeh</span></a>--}}
                    <a href="admin" class="dashboard-logo"><img src="images/gomgashteh-icon.png" width="600px" height="600px" alt="logo"></a>
                </div>

                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
                    </button>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <li><a href="/admin">صفحه اصلی</a></li>

                        <li><a href="{{route('user-announce')}}">آگهی ها</a></li>

{{--                        <li><a href="" disabled>پرسنل</a></li>--}}

{{--                        <li><a class="current" href="#">پنل کاربری</a>--}}
{{--                            <ul>--}}
{{--                                <li><a href="dashboard.html">داشبورد</a></li>--}}
{{--                                <li><a href="dashboard-messages.html">پیام ها</a></li>--}}
{{--                                <li><a href="dashboard-bookings.html">رزرو ها</a></li>--}}
{{--                                <li><a href="dashboard-wallet.html">کیف پول</a></li>--}}
{{--                                <li><a href="dashboard-my-listings.html">آگهی های من</a></li>--}}
{{--                                <li><a href="dashboard-reviews.html">نظرات</a></li>--}}
{{--                                <li><a href="dashboard-bookmarks.html">نشانکها</a></li>--}}
{{--                                <li><a href="dashboard-add-listing.html">افزودن آگهی</a></li>--}}
{{--                                <li><a href="dashboard-my-profile.html">پروفایل من</a></li>--}}
{{--                                <li><a href="dashboard-invoice.html">صورتحساب</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li><a href="#">صفحات</a>--}}
{{--                            <div class="mega-menu mobile-styles three-columns">--}}

{{--                                <div class="mega-menu-section">--}}
{{--                                    <ul>--}}
{{--                                        <li class="mega-menu-headline">صفحات #1</li>--}}
{{--                                        <li><a href="pages-user-profile.html"><i class="sl sl-icon-user"></i> پروفایل کاربر</a></li>--}}
{{--                                        <li><a href="pages-booking.html"><i class="sl sl-icon-check"></i> صفحه رزرو</a></li>--}}
{{--                                        <li><a href="pages-add-listing.html"><i class="sl sl-icon-plus"></i> افزودن آگهی</a></li>--}}
{{--                                        <li><a href="pages-blog.html"><i class="sl sl-icon-docs"></i> بلاگ</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}

{{--                                <div class="mega-menu-section">--}}
{{--                                    <ul>--}}
{{--                                        <li class="mega-menu-headline">صفحات #2</li>--}}
{{--                                        <li><a href="pages-contact.html"><i class="sl sl-icon-envelope-open"></i> تماس</a></li>--}}
{{--                                        <li><a href="pages-coming-soon.html"><i class="sl sl-icon-hourglass"></i> به زودی</a></li>--}}
{{--                                        <li><a href="pages-404.html"><i class="sl sl-icon-close"></i> صفحه 404</a></li>--}}
{{--                                        <li><a href="pages-masonry-filtering.html"><i class="sl sl-icon-equalizer"></i> ساختار فیلتر</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{----}}
{{--                                <div class="mega-menu-section">--}}
{{--                                    <ul>--}}
{{--                                        <li class="mega-menu-headline">و دیگر</li>--}}
{{--                                        <li><a href="pages-elements.html"><i class="sl sl-icon-settings"></i> المنت ها</a></li>--}}
{{--                                        <li><a href="pages-pricing-tables.html"><i class="sl sl-icon-tag"></i> جداول قیمت</a></li>--}}
{{--                                        <li><a href="pages-typography.html"><i class="sl sl-icon-pencil"></i> تایپوگرافی</a></li>--}}
{{--                                        <li><a href="pages-icons.html"><i class="sl sl-icon-diamond"></i> آیکن ها</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{----}}
{{--                            </div>--}}
{{--                        </li>--}}

                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->

            <!-- Right Side Content / End -->
            <div class="right-side">
                <!-- Header Widget -->
                <div class="header-widget">

                    <!-- User Menu -->
                    <div class="user-menu">
                        <div class="user-name"><span><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt=""></span>{{Session('full_name')}}

                        </div>
                        <ul>
                            <li><a href=""><i class="sl sl-icon-settings"></i>
                                    @php $ff=Session::get('access_type');
                                    @endphp
                                    @if($ff==1){{'مدیر'}} @elseif($ff==2){{'پشتیبان'}} @elseif($ff==3){{'اپراتور'}} @endif
                                </a></li>
{{--                            <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> پیام ها</a></li>--}}
{{--                            <li><a href="dashboard-bookings.html"><i class="fa fa-calendar-check-o"></i> رزرو ها</a></li>--}}
                            <li><a href="{{route('admin-sign-out')}}"><i class="sl sl-icon-power"></i> خروج</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Widget / End -->
            </div>
            <!-- Right Side Content / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
