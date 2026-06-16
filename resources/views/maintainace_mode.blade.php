@php
    $maintainance = App\Models\MaintainanceText::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
        <title>{{__("Maintainance")}}</title>
        <link rel="icon" type="image/png" href="{{ asset($setting->favicon) }}">
        <!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500&display=swap" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
		<!-- Animate CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
		<!-- AOS CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/aos.min.css') }}">
		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome-all.min.css') }}">
		<!-- Swiper Slider CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/swiper-slider.min.css') }}">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/select2-min.css') }}">
		<!-- Video Popup -->
		<link rel="stylesheet" href="{{ asset('frontend/css/video-popup.min.css') }}">
		<!-- Jquery UI CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/theme-default.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

</head>

<body>



    <!--============================
        404 PAGE START
    ==============================-->
    <section id="wsus__404 m-auto">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-md-10 col-lg-8 col-xxl-6 m-auto">
                    <div class="wsus__404_text">
                        <img width="150px" src="{{ ($maintainance->image)? asset($maintainance->image) : asset($setting->default_placeholder)}}" alt="">
                        <p>{!! clean(nl2br($maintainance->description)) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        404 PAGE END
    ==============================-->


</body>

</html>
