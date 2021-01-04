    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">

                        @if(Auth::user())
                        @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care")
                        @if($busInfo != "")
                            <a href="{{ route('businesspage') }}" class="footer_logo_iner"> <img class="brand-logo" src="/company_logo/{{ $busInfo[0]->file2 }}" style="object-fit: contain;"> </a><br>
                        @else
                        {{-- <a href="{{ route('Home') }}" class="footer_logo_iner" style="font-weight: bold; font-size: 24px; color: honeydew;"> Vim File </a><br> --}}

                        <h4 style="color: honeydew;">About Busy Wrench</h4>
                        <p>
                            Vehicle owners are always looking for qualified, reliable and professional mechanics nearby. Our system has been designed to connect you with vehicle owners around you. Simply sign up for FREE, complete your Auto Repair Shop's profile and we share your information with vehicle owners near you. </p>
                            <p></p>
We also provide you with Shop Management Software (SMS) that enables you to receive appointments, respond to reviews with a direct message, reply to messages or quote requests, track Users' view and customer leads, and manage end-to-end operations of your business from anywhere on any devices.
                        </p>

                        @endif

                            @else

                            {{-- <a href="{{ route('Home') }}" class="footer_logo_iner" style="font-weight: bold; font-size: 24px; color: honeydew;"> Vim File </a><br> --}}

                            <h4 style="color: honeydew;">About Busy Wrench</h4>
                        <p>
                            Vehicle owners are always looking for qualified, reliable and professional mechanics nearby. Our system has been designed to connect you with vehicle owners around you. Simply sign up for FREE, complete your Auto Repair Shop's profile and we share your information with vehicle owners near you. </p>
                            <p>
We also provide you with Shop Management Software (SMS) that enables you to receive appointments, respond to reviews with a direct message, reply to messages or quote requests, track Users' view and customer leads, and manage end-to-end operations of your business from anywhere on any devices.
                        </p>

                        @endif

                        @else
                            {{-- <a href="{{ route('Home') }}" class="footer_logo_iner" style="font-weight: bold; font-size: 24px; color: honeydew;"> Vim File </a><br> --}}

                            <h4 style="color: honeydew;">About Busy Wrench</h4>
                        <p>
                            Vehicle owners are always looking for qualified, reliable and professional mechanics nearby. Our system has been designed to connect you with vehicle owners around you. Simply sign up for FREE, complete your Auto Repair Shop's profile and we share your information with vehicle owners near you. </p>
                            <p>
We also provide you with Shop Management Software (SMS) that enables you to receive appointments, respond to reviews with a direct message, reply to messages or quote requests, track Users' view and customer leads, and manage end-to-end operations of your business from anywhere on any devices.
                        </p>
                        @endif

                    </div>
                </div>

                @if(Auth::user())
                @if(Auth::user()->userType == "Business")
                @if($busInfo != "")
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Contact Info</h4>
                        <p>{{ $busInfo[0]->name_of_company }} <br> {{ $busInfo[0]->address }}, <br> {{ $busInfo[0]->state }}, <br> {{ $busInfo[0]->country }}</p>
                        <p>Email : {{ $busInfo[0]->email }}</p>
                    </div>
                </div>
                @else

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Contact Info</h4>
                        <p>Professionals' File Inc. <br> 10 George St. North, <br> Brampton ON L6X1R2, <br> Canada</p>
                        <p>Telephone : 1-800-526-7687</p>
                        <p>Email : info[a]vimfile.com</p>
                        
                    </div>

                     <div id="google_translate_element"></div>

                    <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                    }
                    </script>

                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                </div>

               

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Important Link</h4>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('About') }}"> About</a></li>
                            <li><a href="{{ route('Contact') }}">Contact</a></li>
                            <li><a href="{{ route('Privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('Terms') }}">Term of Use</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">News and Happenings</h4>
                        <p>
                        </p>
                        <div id="mc_embed_signup">
                            <form action="#" method="get" class="subscribe_form relative mail_part">
                                <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                    class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = ' Email Address '">
                        <button type="button" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm"><i
                                        class="far fa-paper-plane"></i> <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>

                @endif

                @else

                    <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Contact Info</h4>
                        <p>Professionals' File Inc. <br> 10 George St. North, <br> Brampton ON L6X1R2, <br> Canada</p>
                        <p>Telephone : 1-800-526-7687</p>
                        <p>Email : info[a]vimfile.com</p>
                    </div>

                    <div id="google_translate_element"></div>

                    <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                    }
                    </script>

                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Important Link</h4>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('About') }}"> About Busy Wrench</a></li>
                            <li><a href="{{ route('Webform') }}">Contact us</a></li>
                            @if(Auth::user()) <li><a href="{{ route('Openticket') }}">Open Ticket</a></li> @endif
                            <li><a href="{{ route('Privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('Terms') }}">Term of Use</a></li>


                        </ul>
                    </div>
                </div>

                @if($location['state_name'] == "Ontario")

                @if(Auth::user())

                    @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Care")

                        <div class="col-sm-6 col-lg-3">
                            <div class="single_footer_part">
                                <h4 style="color: honeydew;">Resources</h4>
                                <ul class="list-unstyled">
                                    <li><a href="/resources_download/managepractice.pdf" download=""> Management Practice</a></li>
                                    <li><a href="https://youtu.be/niOSDNdbTDY" target="_blank">Know Your Right</a></li>
                                    <li><a href="/resources_download/repairact.doc" download="">Motor Vehicle Repair Act</a></li>
                                </ul>
                            </div>
                        </div>

                        @else

                        <div class="col-sm-6 col-lg-3">
                            <div class="single_footer_part">
                                <h4 style="color: honeydew;">Resources</h4>
                                <ul class="list-unstyled">
                                    <li><a href="https://youtu.be/niOSDNdbTDY" target="_blank">Know Your Right</a></li>
                                    <li><a href="/resources_download/repairact.doc" download="">Motor Vehicle Repair Act</a></li>
                                </ul>
                            </div>
                        </div>

                    @endif
                @endif


                @else

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Newsletter</h4>
                        <p>
                        </p>
                        <div id="mc_embed_signup">
                            <form action="#" method="get" class="subscribe_form relative mail_part">
                                <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                    class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = ' Email Address '">
                                <button type="button" name="submit" id="newsletter-submit"
                                    class="email_icon newsletter-submit button-contactForm"><i
                                        class="far fa-paper-plane"></i></button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>

                @endif




                @endif


                @else

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Contact Info</h4>
                        <p>Professionals' File Inc. <br> 10 George St. North, <br> Brampton ON L6X1R2, <br> Canada</p>
                        <p>Telephone : 1-800-526-7687</p>
                        <p>Email : info[a]vimfile.com</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Important Link</h4>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('About') }}"> About Busy Wrench</a></li>
                            <li><a href="{{ route('Contact') }}">Contact us</a></li>
                            <li><a href="{{ route('Privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('Terms') }}">Term of Use</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4 style="color: honeydew;">Newsletter</h4>
                        <p>
                        </p>
                        <div id="mc_embed_signup">
                            <form action="#" method="get" class="subscribe_form relative mail_part">
                                <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                    class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = ' Email Address '">
                                <button type="button" name="submit" id="newsletter-submit"
                                    class="email_icon newsletter-submit button-contactForm"><i
                                        class="far fa-paper-plane"></i></button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>

                @endif

            </div>
            <hr>
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright_text disp-0">
                        <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer_icon social_icon">
                        <ul class="list-unstyled">
                            <li><a href="https://www.facebook.com/autoservicedatamanagement/" target="_blank" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://twitter.com/vimfile?s=17" target="_blank" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/vimfile/" target="_blank" class="single_social_icon"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/vimprofile" target="_blank" class="single_social_icon"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->
