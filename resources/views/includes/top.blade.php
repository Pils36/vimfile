<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Author Meta -->
    <meta name="author" content="Vehicle Inspection & Maintenance File">
    <!-- Meta Description -->
    <meta name="description" content="Vehicle Inspection & Maintenance File is a simple and affordable Auto Service Data Management System designed to manage and keep the repairs of your vehicle.">
    <!-- Meta Keyword -->
    <meta name="keywords" content="vimfile.com, vehicle inspection, auto repair software, vehicle maintenance log, car record log, mechanics, mobile mechanics, auto dealer, car owners, car owners, auto care centers, vehicle inspection">

    <meta property="og:image" content="{{ asset('images/icons/vimblack.jpg') }}">
    <meta property="og:title" content="Vehicle Inspection & Maintenance File">
    <meta property="og:description" content="Vehicle Inspection & Maintenance File is a simple and affordable Auto Service Data Management System designed to manage and keep the repairs of your vehicle.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vehicle Inspection & Maintenance File">
    <meta property="og:url" content="https://www.vimfile.com">

    <title>{{ config('app.name', 'Vehicle Inspection & Maintenance File') }}</title>

    @laravelPWA

    <!-- Scripts -->

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/a/a8/Ski_trail_rating_symbol_black_circle.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">

    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('ext/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('ext/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('ext/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('ext/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('ext/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('ext/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ext/css/main.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('ext/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs-rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css">
    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.4/css/autoFill.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweet-modal@1.3.2/dist/min/jquery.sweet-modal.min.css">

    <script src="https://kit.fontawesome.com/384ade21a6.js"></script>

<!--===============================================================================================-->


<style>

.noti-icons{
  display: inline-flex;
}
.noti-icons li{
  margin-left: 10px;
}
.ticket-btn{
  background-color: #f2f2f2;
  border-radius: 10px;
  cursor: pointer;
}
.ticket-btn-span{
  font-weight: bolder; font-size: 16px;
}

  input[type="search"]{
    border: 1px solid !important;
    padding: 3px !important;
  }
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }

    .navbar-brand img{
        object-fit: contain;
        width: 64px; height: 64px;
    }

    /* line 124, ../../01 cl html template/03_jun 2019/184_SAAS_template/sass/_menu.scss */
.cart .fa-envelope:after {
  position: absolute;
  border-radius: 50%;
  background-color: #f13d80;
  width: 14px;
  height: 14px;
  right: -8px;
  top: -8px;
  content: "<?php if(Auth::user()) echo $countQuest; else 0;?>";
  text-align: center;
  line-height: 15px;
  font-size: 10px;
}

.cart .fa-bell:after {
  position: absolute;
  border-radius: 50%;
  background-color: #f13d80;
  width: 14px;
  height: 14px;
  right: -8px;
  top: -8px;
  content: "<?php if(Auth::user()) echo count($notify); else 0;?>";
  text-align: center;
  line-height: 15px;
  font-size: 10px;
}

.cart .fa-comment-alt:after {
  position: absolute;
  border-radius: 50%;
  background-color: darkorange;
  width: 14px;
  height: 14px;
  right: -8px;
  top: -8px;
  content: "*";
  text-align: center;
  line-height: 15px;
  font-size: 10px;
}

    @media (max-width: 991px){
        .navbar-brand img{
            position: absolute;
            top: -30px !important;
            left: -180px;
            right: 0;
            margin: 0 auto;
            max-width: 100px;
            display: inline-block;
        }
    }


    .white-popup {
  position: relative;
  background: #FFF;
  padding: 20px;
  width:auto;
  max-width: 500px;
  margin: 20px auto;
}

.navbar-brand > .my_logo{
    background-color: #fff !important;
    border-radius: 10px;
}

img.my_logo {
    width: 30%;
}

@media (max-width: 900px){

    .sweet-modal-overlay{
    top: 130px !important;
    }

}

</style>

{{-- Main OneSignal API --}}
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "fd30d3b9-c1a5-4807-97d9-6c6ec1639c31",
    });
  });
</script>


{{-- Local Onesignal API --}}

<!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>-->
<!--<script>-->
<!--  var OneSignal = window.OneSignal || [];-->
<!--  OneSignal.push(function() {-->
<!--    OneSignal.init({-->
<!--      appId: "74f2c616-ae4a-4052-808a-6435dfea4861",-->
<!--    });-->
<!--  });-->
<!--</script>-->


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153465261-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153465261-1');
</script>


</head>
<body>

