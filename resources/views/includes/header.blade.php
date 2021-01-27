    <!--::header part start::-->
    
    <header class="main_menu home_menu">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">

                    <nav class="navbar navbar-expand-lg navbar-light">
                        @if(Auth::user())
                        @if(Auth::user()->userType == "Business" || Auth::user()->userType == "Auto Dealer" || Auth::user()->userType == "Auto Care")
                        @if($busInfo != "")

                        <a class="navbar-brand" title="Home" href="{{ route('Home') }}"> <img src="/company_logo/{{ $busInfo[0]->file2 }}"> </a>

                        @else
                        <a class="navbar-brand" title="Home" href="{{ route('Home') }}">
                             {{-- <h2 class="text-white" style="font-weight: bolder; margin-left: 40px;">VIM File</h2> --}}
                             <img class="my_logo" src="https://res.cloudinary.com/pilstech/image/upload/v1600186029/vimnewlogo_pndv6i.png" alt="VIMFile">
                             <img class="my_logo" src="https://res.cloudinary.com/pilstech/image/upload/v1600186031/bw_ncbz2n.png" alt="BW">

                        </a>
                        @endif

                        @else
                        <a class="navbar-brand" title="Home" href="{{ route('Home') }}">
                            {{-- <h2 class="text-white" style="font-weight: bolder; margin-left: 40px;">VIM File</h2> --}}
                            <img class="my_logo" src="https://res.cloudinary.com/pilstech/image/upload/v1600186029/vimnewlogo_pndv6i.png" alt="VIMFile">
                            <img class="my_logo" src="https://res.cloudinary.com/pilstech/image/upload/v1600186031/bw_ncbz2n.png" alt="BW">

                        </a>
                        @endif

                        @else
                        <a class="navbar-brand" title="Home" href="{{ route('Home') }}">
                            {{-- <h2 class="text-white" style="font-weight: bolder; margin-left: 40px;">VIM File</h2>  --}}

                            <img class="my_logo" src="https://res.cloudinary.com/pilstech/image/upload/v1600186029/vimnewlogo_pndv6i.png" alt="VIMFile">
                            <img class="my_logo" src="https://res.cloudinary.com/pilstech/image/upload/v1600186031/bw_ncbz2n.png" alt="BW">

                        </a>
                        @endif

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" title="Home" href="{{ route('Home') }}" style="font-size: 12.5px;">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" title="About" href="{{ route('About') }}" style="font-size: 12.5px;">About BusyWrench</a>
                                </li>

                                <li class="nav-item disp-0">
                                    @if(Auth::user())
                                    @if(Auth::user()->userType != "Business")
                                        <a class="nav-link" title="SmartDrivers" href="{{ route('SmartDrivers') }}" style="font-size: 12.5px;">Vimfile <span style="text-transform: lowercase;">for</span> SMART drivers</a>
                                    @endif
                                    @endif

                                </li>

                                @if (Auth::user())

                                @if($pages == 'Drivers')
                                <li class="nav-item">
                                    <a class="nav-link" title="Features" href="{{ route('Features') }}" style="font-size: 12.5px;">Features</a>
                                </li>

                                @else
                                <li class="nav-item disp-0">
                                    <a class="nav-link" title="Features" href="{{ route('Features') }}" style="font-size: 12.5px;">Features</a>
                                </li>
                                @endif



                                @else

                                @if($pages == 'Drivers')
                                <li class="nav-item">
                                    <a class="nav-link" title="Features" href="{{ route('Features') }}" style="font-size: 12.5px;">Features</a>
                                </li>
                                @else
                                <li class="nav-item disp-0">
                                    <a class="nav-link" title="Features" href="{{ route('Features') }}" style="font-size: 12.5px;">Features</a>
                                </li>
                                @endif




                                @endif

                                @if(Auth::user())
                                <li class="nav-item">
                                    <a class="nav-link" title="Pricing" style="font-size: 12.5px;" href="{{ route('Pricing') }}">Plan & Pricing</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" title="Ask Expert" style="font-size: 12.5px;" href="{{ route('AskExpert') }}">Ask Expert</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" title="Claim Business For FREE" style="font-size: 12.5px;" href="{{ route('claimbusiness') }}">Claim Business For FREE</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" title="Openticket" style="font-size: 12.5px;" href="{{ route('Openticket') }}">Open Ticket</a>
                                </li>

                                @else

                                <li class="nav-item">
                                    <a class="nav-link" title="Ask Expert" href="{{ route('register') }}" style="font-size: 12.5px;">Ask Expert</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" title="Claim Business For FREE" href="{{ route('claimbusiness') }}" style="font-size: 12.5px;">Claim Business For FREE</a>
                                </li>

                                @endif


                                {{-- <li class="nav-item">
                                    <a class="nav-link" title="Contact" href="{{ route('Contact') }}" style="font-size: 12.5px;">Contact Us</a>
                                </li> --}}

                                <li class="nav-item">
                                    <a class="nav-link" title="Web Form" href="{{ route('Webform') }}" style="font-size: 12.5px;">Contact Us</a>
                                </li>


                                    @if (Auth::user())

                                <li class="nav-item dropdown">
                                    @if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")
                                    <a style="font-size: 12.5px;" class="nav-link dropdown-toggle" href="#" title="{{ Auth::user()->name }}" id="navbarDropdown1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}

                                    </a>
                                    @else
                                    <a class="nav-link dropdown-toggle" href="#" title="{{ Auth::user()->station_name }}" id="navbarDropdown1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 12.5px;">
                                            {{ Auth::user()->station_name }}

                                    </a>
                                    @endif

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                        <a class="dropdown-item" href="{{ route('userDashboard') }}" title="User Dashboard">
                                        {{ __('My Dashboard') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('businesspage') }}" title="My Business Page">
                                        {{ __('My Business Page') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('Ranking') }}" title="User Ranking">
                                        {{ __('My Achievements') }}
                                    </a>

                                    <a class="dropdown-item" href="https://vimfile.com/blog" title="Blog">
                                        {{ __('Goto Blog') }}
                                    </a>
                                    {{-- {{ route('logout') }} --}}
                                    {{-- event.preventDefault();document.getElementById('logout-form').submit(); --}}
                                        <a class="dropdown-item" href="javascript::void()" title="Logout"
                                       onclick="logouts()">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </div>
                                </li>

                                    @else

                                    <li class="nav-item dropdown" style="background-color: #14485f;">
                                    <a style="font-size: 16.5px; font-weight: bolder;" class="nav-link dropdown-toggle" href="#" title="Get Started" id="navbarDropdown1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            GET <span style="color: red; font-weight: bolder; font-size: 16.5px;" class="animated infinite fadeIn">STARTED</span>

                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                        <a class="dropdown-item" title="Join us for free" href="{{ route('register') }}">
                                        {{ __('Join us for FREE') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('login') }}" title="Login">
                                        {{ __('Login') }}
                                    </a>

                                    <a class="dropdown-item" href="https://vimfile.com/blog" title="Blog">
                                        {{ __('Goto Blog') }}
                                    </a>
                                    </div>
                                </li>

                                    {{-- <li class="nav-item" style="background-color: #14485f;">
                                        <a class="nav-link" href="{{ route('Signupfree') }}" style="font-size: 12.5px;">Join us for <span style="color: red; font-weight: bolder; font-size: 16.5px;" class="animated infinite fadeIn">FREE</span></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}" style="font-size: 12.5px;">Login</a>
                                    </li> --}}

                                    @endif

                            </ul>

                            
                        </div>

                        @if(Auth::user())

                        @if(Auth::user()->userType == "Individual" || Auth::user()->userType == "Commercial")

                            <div class="dropdown cart">
                                <p style="background-color: darkorange; padding: 2px; position: relative; left: 30px;">
                            <span style="font-weight: 700; color: #0b1d27; font-size: 12px; text-align: center;">REF CODE - @if($ref_code != "") {{ $ref_code }} @else  @endif </span><br><span style="font-weight: 700; color: #fff; font-size: 12px; text-align: center;">POINTS - @if(Auth::user()->userType == "Commercial") {{ $getRefs * 1000 }}  @elseif(Auth::user()->userType == "Individual") {{ $getRefs * 1000 }} @endif </span><button class="btn btn-danger btn-sm" onclick="redeemPoint('{{ Auth::user()->ref_code }}', 'start')">Redeem Point <img class="spinredeem disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 8px; height: 8px;"></button></p>

                            </div>

                        @endif

                        <div class="dropdown cart">

                            <ul class="noti-icons">
                                <li>
                                    <a title="Prochatr Live Chat" class="dropdown-toggle" href="https://web.prochatr.com/?platform=48cff60d45be26b6c4982d7c416175a8&userid={{ Auth::user()->ref_code }}&key=true&level={{ Auth::user()->userType }}&userrole={{ Auth::user()->userType }}&username=NULL" id="navbarDropdown3" target="_blank">
                                        <i class="far fa-comment-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-toggle" href="{{ route('allQuestions') }}" id="navbarDropdown3" title="All questions">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-toggle" href="{{ route('Notifications') }}" id="navbarDropdown3" title="Notifications">
                                        <i class="far fa-bell"></i>
                                    </a>
                                </li>
                            </ul>


                            {{-- <div class="row">
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-4">
                                    
                                </div>
                            </div> --}}
                            
                            
                        </div>

                        @endif



                    </nav>

                    

                </div>


            </div>


        </div>
    </header>
    <!-- Header part end-->
