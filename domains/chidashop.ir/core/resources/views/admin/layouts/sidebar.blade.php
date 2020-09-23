<a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> منوی کناری</a>

<div class="dashboard-nav">
    <div class="dashboard-nav-inner">

        <ul data-submenu-title="اصلی">
            <li class="active"><a href="{{route('user-management')}}"><i class="sl sl-icon-settings"></i> مدیریت کاربران</a></li>
{{--            <li><a><i class="sl sl-icon-wallet"></i>درخواست ها</a></li>--}}
        </ul>

        <ul data-submenu-title="آگهی ها">
            <li><a  href="{{route('user-announce')}}"><i class="sl sl-icon-layers"></i> آگهی ها</a>
{{--                <ul>--}}
{{--                    <li><a href="dashboard-my-listings.html">فعال <span class="nav-tag green">6</span></a></li>--}}
{{--                    <li><a href="dashboard-my-listings.html">در انتظار <span class="nav-tag yellow">1</span></a></li>--}}
{{--                    <li><a href="dashboard-my-listings.html">منقضی شده <span class="nav-tag red">2</span></a></li>--}}
{{--                </ul>--}}
            </li>
{{--            <li><a href="dashboard-reviews.html"><i class="sl sl-icon-star"></i> نظرات</a></li>--}}
{{--            <li><a href="dashboard-bookmarks.html"><i class="sl sl-icon-heart"></i> نشانکها</a></li>--}}
{{--            <li><a href="dashboard-add-listing.html"><i class="sl sl-icon-plus"></i> افزودن آگهی</a></li>--}}
        </ul>

        <ul data-submenu-title="اکانت">
{{--            <li><a href="dashboard-my-profile.html"><i class="sl sl-icon-user"></i> پروفایل من</a></li>--}}
            <li><a href="{{route('admin-sign-out')}}"><i class="sl sl-icon-power"></i> خروج</a></li>
        </ul>

    </div>
</div>
