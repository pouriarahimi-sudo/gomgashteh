<header id="header-container">

    <!-- Header -->
    <div id="header">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <!-- Logo -->
                <div id="logo">
                    <a href="{{route('index')}}"><img src="images/gomgashteh-icon.png" alt="logo"></a>
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

                        <li><a href="{{route('index')}}">صفحه اصلی</a>
                        </li>
                        @if(Session::has('session_id'))
                            <li><a href="{{route('my-announce')}}">آگهی های من</a></li>
                            <li><a href="{{route('my-tickets')}}">تیکت های من</a></li>
                        @endif
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->


            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="header-widget">

{{--                    <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> ورود</a>--}}
                    @if(Session::has('session_id'))
                        <!-- User Menu -->
                            <div class="user-menu">
                                <div class="user-name"><span><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt=""></span>{{session('full_name')}}</div>
                                <ul>
                                    <li><a href="{{route('my-announce')}}"><i class="sl sl-icon-settings"></i> آگهی های من</a></li>
                                    <li><a href="{{route('my-tickets')}}"><i class="sl sl-icon-envelope-open"></i> تیکت های من</a></li>
                                    <li><a href="{{route('sign-out')}}"><i class="sl sl-icon-power"></i> خروج</a></li>
                                </ul>
                            </div>
                        <a href="{{route('add-announce')}}" class="button border with-icon">ثبت آگهی<i class="sl sl-icon-plus"></i></a>
                    @else
                        <a href="{{route('user')}}" class="button border with-icon">ثبت آگهی | ورود</a>
                    @endif
                </div>
            </div>
            <!-- Right Side Content / End -->

            <!-- Sign In Popup -->
            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3>ورود</h3>
                </div>

                <!--Tabs -->
                <div class="sign-in-form style-1">

                    <ul class="tabs-nav">
                        <li class=""><a href="#tab1">ورود</a></li>
                        <li><a href="#tab2">ثبت نام</a></li>
                    </ul>

                    <div class="tabs-container alt">

                        <!-- Login -->
                        <div class="tab-content" id="tab1" style="display: none;">
                            <form method="post" class="ورود">

                                <p class="form-row form-row-wide">
                                    <label for="username">نام کاربری:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password">رمز عبور:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password"/>
                                    </label>
                                    <span class="lost_password">
										<a href="#" >فراموشی رمز عبور؟</a>
									</span>
                                </p>

                                <div class="form-row">
                                    <input type="submit" class="button border margin-top-5" name="login" value="ورود" />
                                    <div class="checkboxes margin-top-10">
                                        <input id="remember-me" type="checkbox" name="check">
                                        <label for="remember-me">مرا به خاطر داشته باش</label>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <!-- Register -->
                        <div class="tab-content" id="tab2" style="display: none;">

                            <form method="post" class="register">

                                <p class="form-row form-row-wide">
                                    <label for="username2">نام کاربری:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username2" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="email2">آدرس ایمیل:
                                        <i class="im im-icon-Mail"></i>
                                        <input type="text" class="input-text" name="email" id="email2" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password1">رمز عبور:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password1" id="password1"/>
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password2">تایید رمز عبور:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password2" id="password2"/>
                                    </label>
                                </p>

                                <input type="submit" class="button border fw margin-top-10" name="register" value="ثبت نام" />

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Sign In Popup / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
