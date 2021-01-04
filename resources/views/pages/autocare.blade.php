@extends('layouts.app')

@section('text/css')

<style>
    .bookings:hover{
        transition: all ease-in-out;
        background-color: #ec8e27 !important;
        color: #fff !important;
        -webkit-box-shadow: inset -8px -8px 28px 1px rgba(219,140,21,0.77);
-moz-box-shadow: inset -8px -8px 28px 1px rgba(219,140,21,0.77);
box-shadow: inset -8px -8px 28px 1px rgba(219,140,21,0.77);
    }
    .memo{
        font-size: 16px;
        background: #000;
        width: 450px;
        text-align: justify;
        position: relative;
        top: -30px;

    }
    .banner_part .banner_text p {
        padding: 20px !important;
    }
    #headz, #linkz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: 450px;
    }
    #linkz{
        height: auto;
        position: relative;
    }
    .defined{
        background: #fff;
        border-radius: 10px;
        position: relative;
        top: -30px;
    }
    .defined .banner_text_iner{
        padding: 20px 0px 0px;
    }
    .btnsDef{
        border: 1px solid grey;
        padding: 7px;
        font-size: 12px;
        width: 100%;
        text-align: center;
        font-weight: bold;
        background-color: #14485f;
        color: #fff; 
    }

    .defined img{
        height: 220px;
    }


    @media (max-width: 700px){
        .memo{
            width: 100% !important;
            padding-right: 20px !important;

        }
        #headz, #linkz{
        font-size: 33px; background-color: #394f75; padding: 10px; width: auto; margin-bottom: 50px;
    }
    #linkz{
        position: relative;
        top: -110px;
    }
    .btnsDef{
        margin-bottom: 3px;
    }
    .defined{
        position: relative;
        top: 0px;
    }
    
    }
    @media (max-width: 576px){
        .btn_2 {
    padding: 10px 30px !important;
    margin-top: 0px !important; 
}
    }

</style>

@show

@section('content')

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1 class="m-t-100" id="headz">Vimfile for Autocare Professional
                                </h1>
                            <p class="memo">Professional Autocare business is a highly rewarding career if properly managed.
                                Matching your professional skills with the right tools and software provides you with 
                                unending success in your career.
                                <br><br>

                                Vimfile for Autocare Professional is a broadbase, end to end Auto repair shop software that enable you to 
                                manage your auto repair shop more profitably.   
                                <br><br>

                                Either you are a freelance autocare professional or a professional with a store, vimfile for autocare professional 
                                does not only enable you to effectively manage your operations but also connect you with potential clients and get you closer to 
                                existing client. <br><br>

                                Starting from Diagnosis and preparing Estimates for Clients to when the work is completed, vimfile for Autocare centre allows you to be on top of all operations that delivers quality services to your clients while effectively managing the technicians and vendors.
                                <br><br>

                                Our multi-outlets feature allows you to manage more than one location from the comfort of your office, manage inventory, labour and the outlets 
                                cashflow and profitability.

                                <br><br>

                                With Vimfile for Autocare centre, you are able to provide quality services to existing and walk-in clients and through multiple outlets as
                                each outlet has access to maintenance history of all vehicles that are listed on vimfile.

                            </p>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 defined">
                    <div class="banner_text_iner">
                        <div class="row">
                            <div class="col-sm-6">
                                <button class="btnsDef" onclick='location.href="{{ route('register', 'c=autocare') }}"'>Join us NOW</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btnsDef" onclick='location.href="{{ route('Contact') }}"'>Contact Us</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <center><img class="animated slideInRight" src="https://pro2-bar-s3-cdn-cf.myportfolio.com/43c72d352c5fe6d2082b108e381d6ec0/b8b132ca-8b8a-418d-93e9-5750049ce22e_rw_600.gif?h=6d48bf788f960033c2e18113f5c668ec"></center>
                            </div>
                            <div class="col-sm-4">
                               <a href="{{ route('register', 'c=autocare') }}"> <img class="animated slideInRight" src="https://cdn.clipart.email/fdec85f2550eb868a0d791070573d3dc_discovery-bay-yacht-club-home_345-300.png" style="width: auto; height: 130px;">
                                <img class="animated slideInRight" src="https://www.freepngimg.com/thumb/free/8-2-free-png-clipart.png" style="width: auto; height: 90px; position: relative; top: -10px;"></a>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
        {{-- <center><img src="https://img.icons8.com/ios-filled/50/000000/circled-down-2.png" class="animated infinite bounce delay-1s" style="width: 50px; height: 50px; position: relative; top: 0px; cursor: pointer;" onclick="scrollTarget('indexs_target')"></center> --}}
    </section>
    <!-- banner part start-->



       <!-- feature_part start-->
    <section class="feature_part" >
        <div class="container">
            <div class="row">

                    <div class="col-lg-12" style="margin-top: 15px;" >
                        <h2 style="text-decoration: underline;">Vimfile for Autocare Professional</h2> <br>

                        <h1>Features:</h1> <hr>


                        <div class="row">
                            <div class="col-md-6">
                                <h2>Centre Management </h2> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Prepare Estimates (print/email).
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Generate Work Order (print/email).
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Work in Progress and close out.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Multi-Location Inventory Management.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Access to maintenance history of any vehicle.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Cash report and management for outlets.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Revenue Report on Parts and Outlets.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Generate periodic Common Size Financial Statement for your autocare.
                        </p> <br>
                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Tax deductions and claims.
                        </p> <br>
                         
                            </div>

                            <div class="col-md-6">
                                

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Online appointment booking.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Free Directory Listing.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Good system internal controls and checks.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Good for multi-locations autocare centres.
                        </p> <br>
                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Manage Business from any device, anywhere, anytime.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> 24/7 Support Services.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> No contract. Use for FREE for 30day. Cancel anytime.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Migrate from existing software with ease.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> No limit to number of computers to use.
                        </p>
                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-md-6">
                                <h2>Customers Management</h2> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Generate and Send invoice (email/Print).
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Receive payment -Cash, Credit card, Bank Transfer, checks.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Automatically update client’s maintenance records.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Set up maintenance reminders for clients.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Online/Real time responds to technical questions.
                        </p>
                            </div>

                            <div class="col-md-6">
                                <h2>Inventory Management</h2> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Generate Purchase order (print/email).
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Confirm Delivery (confirmation sent to Vendors).
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Purchase Order monitoring.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Transfer Parts from Purchase Order(PO) to Inventory.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Parts Consumed.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Profit/Margin on Parts consumed.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track inventory balance by category.
                        </p>
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            
                            <div class="col-md-6">
                                <h2>Vendors Management</h2> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Set up vendors & details.
                        </p> <br>
                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Purchase Order(PO) issues to vendors.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track delivery by Vendors.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Invoices paid and outstanding for vendors.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Generate Vendors balance and reconcile account.
                        </p>
                            </div>

                            <div class="col-md-6">
                                <h2>Technicians Management</h2> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Set Up technicians & Details.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Time sheet.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track hours work on work order.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Labour cost on Completed work.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Generate Labour cost report per category of work.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Review Labour Cost management schedule.
                        </p> <br>

                        <p>
                            <b style="font-size: 18px; color: black !important;">*</b> Track Work order assigned to technician.
                        </p> <br>
                            </div>

                        </div> 
                        <hr>                      

                        
                        <p>
                            There is no better software to successfully manage your Autocare centre than vimfile for Autocare centre
                        </p> <br>

                        <p>
                           <a href="{{ route('register', 'c=autocare') }}" style="color: darkblue !important; text-decoration: underline; font-weight: bold !important;">Join us NOW</a> and use for FREE for 30days. Cancel or Deactivate Account anytime
                        </p> <br>

                        <p>
                           Do you need support to migrate your data from existing software, click <a href="{{ route('Contact') }}" style="color: darkblue !important; text-decoration: underline; font-weight: bold !important;">CONTACT US</a> and one of our software specialists will assist you.
                        </p> <br>

                        <br> <br>


                </div>


                
            </div>
        </div>

    </section>
    <!-- upcoming_event part start-->


    <!-- cta part start-->
    <section class="cta_part section_padding disp-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="cta_text text-center">
                        <h2>Very useful Friendly</h2>
                        <p></p>
                        <a href="#" class="btn_2 banner_btn_1">Get Started </a>
                        <a href="#" class="btn_2 banner_btn_2">Join us for free </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta part end-->

@endsection