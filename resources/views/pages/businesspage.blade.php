<?php use \App\Http\Controllers\User; ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from rstill.netlify.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Sep 2020 11:51:55 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
		<!-- Meta -->
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Saveon Auto Repair - Business Profile">
        <meta name="keywords" content="cv, resume, portfolio, creative, modern">
        <meta name="author" content="Hamza Gourram">
		<!-- Page Title -->
		<title>VIMFile - Business Profile</title>
		<!-- Styles -->
		<link rel="stylesheet" href="{{ asset('business/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('business/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('business/css/tootik.css') }}">
		<link rel="stylesheet" href="{{ asset('business/css/magnific-popup.css') }}">
		<link rel="stylesheet" href="{{ asset('business/css/swiper.css') }}">
		<link rel="stylesheet" href="{{ asset('business/css/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('business/css/style.css') }}">
		<!-- Light & Dark Color -->
		<link rel="stylesheet" id="light-dark" href="{{ asset('business/css/colors/light.css') }}">
		<!-- Theme Color -->
		<link rel="stylesheet" id="colors" href="{{ asset('business/css/colors/color1-0487cc.css') }}">
		<!-- Responsive style -->
		<link rel="stylesheet" href="{{ asset('business/css/responsive.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/ico" href="https://upload.wikimedia.org/wikipedia/commons/a/a8/Ski_trail_rating_symbol_black_circle.png">
		<!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|PT+Sans+Narrow:400,700">
        <script src="https://kit.fontawesome.com/384ade21a6.js"></script>
        <style>
            .progress{
                margin-bottom: 0px !important;
            }
            .disp-0{
                display: none !important;
            }
            .comphotos{
                width: 100%;
                height: 200px;
            }
        </style>
	</head>
	<body>

		<div class="content">
			<!-- #LOADER# --> <!-- other loader : http://tobiasahlin.com/spinkit/ -->
			<div class="loading-overlay">
				<div class="spinner">
				  <div class="rect1"></div>
				  <div class="rect2"></div>
				  <div class="rect3"></div>
				  <div class="rect4"></div>
				  <div class="rect5"></div>
				</div>
			</div>

			<!-- #MENU# -->
			<div class="menu">
				<h2 class="logo">{{ Str::substr($profileDetails[0]['station_name'], 0, 2) }}</h2>
				<div class="menu-content">
					<ul>
						<li onclick="location.href='{{ route('userDashboard') }}'"><a href="{{ route('userDashboard') }}" data-value="about">DASHBOARD</a></li>
						<li><a class="active" href="#" data-value="about">ABOUT</a></li>
						{{-- <li><a href="#" data-value="skills">SKILLS</a></li> --}}
					</ul>
				</div>
				<div class="open-menu">
					<i class="fa fa-bars"></i>
				</div>
			</div>

			<!-- #SCROLL-TOP# -->
			<div class="scroll-top" data-tootik="TOP" data-tootik-conf="invert no-arrow no-fading">
				<i class="fa fa-arrow-up"></i>
			</div>
			<!-- #CONTAINER# -->
			<div class="container">
				<!-- #ABOUT# -->
				<section id="about" class="section section-about wow fadeInUp">
					<div class="profile">
						<div class="row">
							<div class="col-sm-4">
								<div class="photo-profile">
                                    
									<img id="my_image" @if($profileDetails[0]['businesslogo'] != "") src="/company_logo/{{ $profileDetails[0]['businesslogo'] }}" @elseif(count($busInfo) > 0 && $busInfo[0]->file2 != "") src="/company_logo/{{ $busInfo[0]->file2 }}" @else src="https://res.cloudinary.com/pilstech/image/upload/v1600186029/vimnewlogo_pndv6i.png" @endif alt="Business Image">
								</div>
								<a style="cursor: pointer;">
									<div class="download-resume" style="background-color: navy; color: #fff;">
										<i class="fa fa-cloud-download" aria-hidden="true"></i>
                                        <span class="text-download">UPDATE LOGO</span><br>
                                        <input type="hidden" name="email" id="email" value="{{ $profileDetails[0]['email'] }}">
                                        <input type="file" name="file" id="file" class="form-control" onchange="previewPicture()">
									</div>
                                </a>
								<a>
									<div class="download-resume">
										<i class="fa fa-eye" aria-hidden="true"></i>
										<span class="text-download">PROFILE VIEW - {{ $profileDetails[0]['profile_view'] }}</span>
									</div>
                                </a>





                                <div class="professional-skills">
								<div class="title-skills">
									<h3>SPECIALITIES</h3>
								</div>
								<!-- single skill -->
                                @if($profileDetails[0]['mechanical_skill'] == "Yes")
                                <div class="skill">
									<div class="title-progress">
										<span class="skill-name">Mechanical Skill: </span>
										<span class="skill-value">Yes</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress1" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
									    </div>
									</div>
                                </div>

                                @else

                                <div class="skill">
									<div class="title-progress">
										<span class="skill-name">Mechanical Skill: </span>
										<span class="skill-value">No</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress1" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    </div>
									</div>
                                </div>

                                @endif
								<!-- / single skill -->
                                <!-- single skill -->
                                @if($profileDetails[0]['electrical_skill'] == "Yes")
								<div class="skill">
									<div class="title-progress">
										<span class="skill-name">Electrical Skill: </span>
										<span class="skill-value">Yes</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress2" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
									    </div>
									</div>
                                </div>

                                @else

                                <div class="skill">
									<div class="title-progress">
										<span class="skill-name">Electrical Skill: </span>
										<span class="skill-value">No</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress2" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    </div>
									</div>
                                </div>

                                @endif
								<!-- / single skill -->
                                <!-- single skill -->

                                @if($profileDetails[0]['transmission_skill'] == "Yes")
								<div class="skill">
									<div class="title-progress">
										<span class="skill-name">Transmission Skill: </span>
										<span class="skill-value">Yes</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress3" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
									    </div>
									</div>
                                </div>

                                @else

                                <div class="skill">
									<div class="title-progress">
										<span class="skill-name">Transmission Skill: </span>
										<span class="skill-value">No</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress3" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    </div>
									</div>
                                </div>

                                @endif
								<!-- / single skill -->
                                <!-- single skill -->
                                @if($profileDetails[0]['body_work_skill'] == "Yes")
								<div class="skill">
									<div class="title-progress">
										<span class="skill-name">Body Work Skill: </span>
										<span class="skill-value">Yes</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress4" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
									    </div>
									</div>
                                </div>
                                @else

                                <div class="skill">
									<div class="title-progress">
										<span class="skill-name">Body Work Skill: </span>
										<span class="skill-value">No</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress4" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    </div>
									</div>
                                </div>

                                @endif
								<!-- / single skill -->
                                <!-- single skill -->
                                @if($profileDetails[0]['other_skills'] == "Yes")

								<div class="skill">
									<div class="title-progress">
										<span class="skill-name">Other Skills: </span>
										<span class="skill-value">Yes</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress5" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
									    </div>
									</div>
                                </div>

                                @else

                                <div class="skill">
									<div class="title-progress">
										<span class="skill-name">Other Skills: </span>
										<span class="skill-value">No</span>
									</div>
									<div class="progress">
									 	<div class="progress-bar progress5" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    </div>
									</div>
                                </div>

                                @endif
								<!-- / single skill -->
                            </div>
                                <br>
                                <div class="title-skills">
									<h3>SERVICE OFFERED</h3>
                                </div>
                                
                                <div class="skill">
									<b>{!! $profileDetails[0]['service_offered'] !!}</b>
                                </div>

                                <br>
                                <div class="title-skills">
									<h3>HOURS OF OPERATION</h3>
                                </div>
                                
                                <div class="skill">
									<b>{!! $profileDetails[0]['hours_of_operation'] !!}</b>
                                </div>
                                
                                <br>
                                <div class="title-skills">
									<h3>LOCATION</h3>
                                </div>
                                
                                <div class="skill">
                                    <iframe src="https://www.google.com/maps/embed?{{ $profileDetails[0]['address'] }}" width="100%" height="auto" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                    
                                    <a type="button" class="btn btn-primary btn-block" href="https://www.google.com/maps/place/{{ $profileDetails[0]['address'] }}" target="_blank">Visit Address</a>
                                </div>


                            </div>
                            

							<div class="col-sm-8">
								<div class="info-profile">
									<h2>{{ $profileDetails[0]['station_name'] }}</h2>
                                    <h3>{{ $profileDetails[0]['specialization'] }} <i class="fa fa-check-circle" aria-hidden="true" style="color: green; font-size: 15px;"></i> <span class="text-available" style="font-size: 15px; font-weight: bold;">Claimed</span> </h3>



									<p>
                                        @if($profileDetails[0]['background'] != "" || $profileDetails[0]['background'] != NULL)
                                        {!! $profileDetails[0]['background'] !!}
                                        @else
                                            No background history
                                        @endif
                                    </p>




                                    <hr>
                                    <h2>Value Added</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-percent"></i> Vimfile Discount</span>
                                        </div>
                                        <div class="col-md-6">
                                            @if($profileDetails[0]['vimfile_discount'] == "Yes")

                                            <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                            @else
                                            <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>

                                            @endif
                                        </div>
                                        <br><br>
                                        
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-toolbox"></i> Repair Guaranteed</span>
                                        </div>
                                        <div class="col-md-6">
                                            @if($profileDetails[0]['repair_guaranteed'] == "Yes")

                                            <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                            @else
                                            <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>

                                            @endif
                                        </div>
                                        
                                        <br><br>
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-file-word"></i> Free Estimates</span>
                                        </div>
                                        <div class="col-md-6">
                                            @if($profileDetails[0]['free_estimated'] == "Yes")

                                            <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                            @else
                                            <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>

                                            @endif
                                        </div>
                                        <br><br>
                                        
                                        
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-walking"></i> Walks-in Welcome</span>
                                        </div>
                                        <div class="col-md-6">
                                            @if($profileDetails[0]['walk_in_specified'] == "Yes")

                                            <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                            @else
                                            <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>

                                            @endif
                                        </div>
                                        <br><br>
                                        
                                        
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-heart"></i> Other Added Value</span>
                                        </div>
                                        <div class="col-md-6">
                                            {{ $profileDetails[0]['other_value_added'] }}
                                        </div>
                                        <br><br>
                                        
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-pause-circle"></i> Average Waiting Period</span>
                                        </div>
                                        <div class="col-md-6">
                                            {{ $profileDetails[0]['average_waiting'] }}
                                        </div>



									</div>
                                    <br><br>

                                    <hr>
                                    <h2>Amenities</h2>
                                    <hr>

									<div class="row">


										<div class="col-sm-6">
											<ul class="ul-info">
												<li class="li-info">
                                                    <span class="title-info"><i class="fa fa-wifi"></i> Wi-Fi</span>
                                                    @if($profileDetails[0]['wifi'] == "Yes")

                                                    <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                                    @else
                                                    <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>

                                                    @endif

												</li>
												<li class="li-info">
                                                    <span class="title-info"><i class="fas fa-restroom" style="font-size: 14px;"></i> Restroom</span>
                                                    @if($profileDetails[0]['restroom'] == "Yes")
                                                    <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                                    @else
                                                    <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>


                                                    @endif
												</li>
												
											</ul>
										</div>
										<div class="col-sm-6">
											<ul class="ul-info">
                                                <li class="li-info">
                                                    <span class="title-info"><i class="fa fa-bed"></i> Lounge</span>
                                                    @if($profileDetails[0]['lounge'] == "Yes")

                                                    <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                                    @else
                                                    <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>
                                                    @endif
                                                </li>
                                                
												<li class="li-info">
                                                    <span class="title-info"><i class="fas fa-parking" style="font-size: 12px"></i> Park space</span>
                                                    @if($profileDetails[0]['parking_space'] == "Yes")
                                                    <span class="info"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;"></i></span>
                                                    @else
                                                    <span class="info"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></span>
                                                    @endif
												</li>
												
											</ul>
                                        </div>


                                    </div>
                                    


                                    <hr>
                                    <h2>History</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-glass-cheers"></i> Year Established</span>
                                        </div>
                                        <div class="col-md-6">
                                            @if($profileDetails[0]['year_established'] == "Yes")

                                            @else
                                                <b>{{ date('F Y', strtotime($profileDetails[0]['year_established'])) }}</b>
                                            @endif
                                            
                                        </div>
                                        <br><br>
                                        
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-hourglass-start"></i> Year Started Since</span>
                                        </div>
                                        <div class="col-md-6">
                                            <b>{{ date('F Y', strtotime($profileDetails[0]['year_started_since'])) }}</b>
                                        </div>
                                        <br><br>
                                        
                                        
                                        <div class="col-md-6">
                                            <span class="title-infos"><i class="fas fa-graduation-cap"></i> Year(s) of practical experience</span>
                                        </div>
                                        <div class="col-md-6">
                                            <b>{{ $profileDetails[0]['year_of_practice'] }}</b>
                                        </div>
                                        <br><br>


                                    </div>

                                    <hr>
                                    <h2>Images & Photos</h2>
                                    <hr>
                                    <div class="row">
                                        @if($profileDetails[0]['photo_video'] != "")
                                        <?php $splitfile = explode(",", $profileDetails[0]['photo_video']);?>

                                            @foreach ($splitfile as $image)
                                                @if ($image != "")
                                                    <div class="col-md-4">
                                                        <a href="/uploads/{{ $image }}" target="_blank"><img class="comphotos" src="/uploads/{{ $image }}" alt="images"></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        
                                        
                                        @else

                                        <div class="col-md-12">
                                            <span class="title-infos" style="text-align: center; font-weight: bold;"><i class="fas fa-images"></i> No images and photos yet</span>
                                        </div>

                                        @endif

                                        <br><br>


                                    </div>
                                    


                                    <br><br>

                                    @if($profileDetails[0]['facebook'] != "" || $profileDetails[0]['twitter'] || $profileDetails[0]['instagram'])
                                    <div class="col-sm-12">
											<span class="title-links">Social Links</span>
											<ul class="ul-social-links">
                                                @if($profileDetails[0]['facebook'])

                                                <li class="li-social-links">
													<a href="{{ $profileDetails[0]['facebook'] }}" data-tootik="Facebook" data-tootik-conf="square" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                </li>
                                                
                                                @endif
                                                
                                                
                                                @if($profileDetails[0]['twitter'])

                                                <li class="li-social-links">
													<a href="{{ $profileDetails[0]['twitter'] }}" data-tootik="Twitter" data-tootik-conf="square" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                </li>
                                                
                                                @endif


                                                @if($profileDetails[0]['instagram'])

                                                <li class="li-social-links">
													<a href="{{ $profileDetails[0]['instagram'] }}" data-tootik="Instagram" data-tootik-conf="square" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                                </li>
                                                
                                                @endif

											</ul>
                                        </div>
                                        @endif








								</div>
							</div>
						</div>
					</div>
                </section>








			</div>
		</div>

		<!-- #JQUERY-PLUGINS# -->
        <script src="{{ asset('business/js/jquery.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="{{ asset('business/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('business/js/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('business/js/swiper.min.js') }}"></script>
		<script src="{{ asset('business/js/jquery.easypiechart.min.js') }}"></script>
		<script src="{{ asset('business/js/wow.min.js') }}"></script>
		<script src="{{ asset('business/js/validator.min.js') }}"></script>
    	<script src="{{ asset('business/js/form-scripts.js') }}"></script>
		<script src="{{ asset('business/js/script.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
		<script>
		/**** EasyPieChart Circle Progress ****/
		$(function() {
			//circle progress additional skills
		    $('.chart').easyPieChart({
		        barColor: '#757575',
		        trackColor: 'rgba(255,255,255,0)',
		        scaleColor: 'rgba(255,255,255,0)',
		        lineWidth: '10',
		        lineCap: 'square'
		    });
		});


        function comingSoon(){
            swal('Hey!', 'This feature is coming soon to your screen', 'info');
        }

        function previewPicture(){
            var formData = new FormData();
            var route = "{{ URL('Ajax/updatebusinessLogo') }}";
            var imageReader = new FileReader();
            imageReader.readAsDataURL(document.getElementById('file').files[0]);

            imageReader.onload = function(imageEvent){
                document.getElementById('my_image').src = imageEvent.target.result;
            };

            // Do Ajax Update Logo
            var fileSelect = document.getElementById("file");
            if(fileSelect.files && fileSelect.files.length == 1){
                var file = fileSelect.files[0]
                formData.set("file", file , file.name);
            }

            formData.append("email", $("#email").val());

                setHeaders();
                jQuery.ajax({
                url: route,
                method: 'post',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                
                success: function(result){
                    $("#file").val('');

                    if(result.message == "success"){
                        iziToast.success({
                            title: 'Good',
                            message: 'Successfully uploaded',
                        });
                    }
                    else{
                        iziToast.error({
                            title: 'Oops!',
                            message: 'Cannot upload',
                        });
                    }

                    
                }

            });

        };

            //Set CSRF HEADERS
            function setHeaders(){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
                });
            }
		</script>

	</body>

<!-- Mirrored from rstill.netlify.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Sep 2020 11:52:26 GMT -->
</html>
