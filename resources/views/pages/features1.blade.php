@extends('layouts.app')

@section('text/css')

<style>
    .about_part{
        height: 45vh !important;
    }
</style>

@show

@section('content')


    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>featured</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!-- feature_part start-->
    <section class="feature_part padding_top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 ">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_feature">
                                <div class="single_feature_part">
                                    <img src="img/icon/feature_icon_1.png" alt="">
                                    <h4>A Volunteer</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_feature">
                                <div class="single_feature_part">
                                    <img src="img/icon/feature_icon_2.png" alt="">
                                    <h4>A Volunteer</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor</p>
                                </div>
                            </div>
                            <div class="single_feature">
                                <div class="single_feature_part single_feature_part_2">
                                    <img src="img/icon/feature_icon_3.png" alt="">
                                    <h4>A Volunteer</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="feature_part_text">
                        <h2>featured</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse
                            ultrices gravida Risus com odo viverra maecenas accumsan lacus vel facilisis
                            accumsan.</p>
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-5">
                                <div class="feature_part_text_iner">
                                    <h4>50k</h4>
                                    <p>Total Volunteer</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-5">
                                <div class="feature_part_text_iner">
                                    <h4>100k</h4>
                                    <p>Successed Mission</p>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn_4">learn more <img src="img/icon/right-arrow.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        
        <img src="img/animate_icon/Shape-1.png" alt="" class="feature_icon_1">
        <img src="img/animate_icon/Shape-14.png" alt="" class="feature_icon_2">
        <img src="img/animate_icon/Shape.png" alt="" class="feature_icon_3">
        <img src="img/animate_icon/shape-3.png" alt="" class="feature_icon_4">
    </section>
    <!-- upcoming_event part start-->

@endsection