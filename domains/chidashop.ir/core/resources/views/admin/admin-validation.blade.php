<html>
<!DOCTYPE html>

<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>احرازهویت مدیریت</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main-color.css" id="colors">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">


    <!-- Content
    ================================================== -->

    <!-- Coming Soon Page -->
    <div class="coming-soon-page" style="background-image: url(images/main-search-background-01.jpg)">
        <div class="container">
            <!-- Search -->
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    {{--                    <img src="images/logo2.png" alt="">--}}
{{--                    <a href="admin" class="dashboard-logo"><span style="color: white">GomGashTeh</span></a>--}}
                    <a href="admin" class="dashboard-logo"><img src="images/gomgashteh-icon.png" alt="logo"></a>
                    <h3>شماره همراه خود را وارد کنید</h3>

                    <form action="/admin_validation" method="post">
                        @csrf
                        @if (Session::has('notFoundNC'))
                            <div class="notification error closeable">
                                <p><span>{{ Session::get('notFoundNC') }}</span></p>
                                <a class="close" href="#"></a>
                            </div>
                        @endif
                        <div class="main-search-input gray-style margin-top-30 margin-bottom-10">
                            <div class="main-search-input-item">
                                <input name="phone_num" id="phone_num" type="number"placeholder="شماره شما"/>
                            </div>
                            <button type="submit" data-toggle="modal" data-target="#bd-example-modal-sm" class="button">دریافت کد تاییدیه</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Search Section / End -->
        </div>
    </div>
    <!-- Coming Soon Page / End -->

</div>
<!-- Wrapper / End -->

{{--11111111111111111111111111111111111111111111111111111111111111111111111111111111--}}
@if(Session::has('randomCode'))
    <script>
        $(document).ready(function(){
            $('#randomCode').modal('show');
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="randomCode" role="dialog">
        <div class="modal-dialog modal-sm">
            <form action="/compare-code" method="post">
                @csrf
                <div class="modal-content">
                    {{--                <div class="modal-header">--}}
                    {{--                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--                    <h4 class="modal-title">Modal Header</h4>--}}
                    {{--                </div>--}}
                    <div class="modal-body">
                        <b> کد دریافت شده راوارد کنید </b>
{{--                        <input name="verify_code" type="number">--}}
                        <input name="verify_code" value="{{Session::get('rand')}}" type="number">
                        @if (Session::has('error'))
                            <div class=" mt-12 alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="button">ثبت</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endif
{{--1111111111111111111111111111111111111111111111111111111111111111111111111111111111111--}}

<!-- Small Modal -->
{{--    <div  id="bd-example-modal-sm" class="modal zoom-anim-dialog mfp-hide">--}}
{{--        <div class="small-dialog-header">--}}
{{--            <h3>ارسال پیام</h3>--}}
{{--        </div>--}}
{{--        <div class="message-reply margin-top-0">--}}
{{--            <textarea cols="40" rows="3" placeholder="پیام شما به تام"></textarea>--}}
{{--            <button class="button">ارسال پیام</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--<div class="modal fade"style="padding-top: 7%" id="bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-1" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-sm">--}}
{{--        <form action="/compare-code" method="post">--}}
{{--            @csrf--}}
{{--            <div class="modal-content text-center">--}}
{{--                <div class="modal-body">--}}
{{--                    <b> کد دریافت شده راوارد کنید </b>--}}
{{--                    <input name="verify_code" value="{{Session::get('rand')}}" class="form-control form-control-rounded" type="number">--}}
{{--                    @if (Session::has('error'))--}}
{{--                        <div class=" mt-12 alert alert-danger">{{ Session::get('error') }}</div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" style="width: 50%" class="btn btn-danger" data-dismiss="modal">انصراف</button>--}}
{{--                    <button type="submit" style="width: 50%" class="btn btn-primary"> ارسال </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}



<!-- Scripts

================================================== -->
<script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/waypoints.min.js"></script>
<script type="text/javascript" src="scripts/counterup.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>

<!-- Countdown Script -->
<script type="text/javascript" src="scripts/jquery.countdown.min.js"></script>
<script type="text/javascript">
    $("#countdown")
        .countdown('2019/12/12', function(event) {
            var $this = $(this).html(event.strftime(''
                + '<div><span>%D</span>  <i>روز</i></div>'
                + '<div><span>%H</span> <i>ساعت</i></div> '
                + '<div><span>%M</span> <i>دقیقه</i></div> '
                + '<div><span>%S</span> <i>ثانیه</i></div>'
            ));
        });
</script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
