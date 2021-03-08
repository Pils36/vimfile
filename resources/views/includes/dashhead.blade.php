<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('Admin') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>V</b>FILE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>VIM</b>FILE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li>
            <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          </li>

          {{-- This section is for Company Admin users to either upgrade or downgrade their payments.--}}
          <li>
            @if (date('Y-m-d') >= session('free_trial_expire'))

            @if (session('role') == "Owner" && session('payment') == "Paid")
              <a type="button" class="btn btn-danger" onclick="doDowngrade()">
                  <svg style="width: 20px; height:20px;" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                  width="48" height="48"
                  viewBox="0 0 172 172"
                  style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M86,157.66667l-41.925,-50.16667h83.85z"></path><path d="M71.66667,21.5h28.66667v96.75h-28.66667z"></path></g></g></svg> DOWNGRADE</a>
              
              @elseif(session('role') == "Owner" && session('payment') == "not paid")
              <a href="{{ route('Pricings') }}" class="btn btn-success animated infinite fadeIn delay-2s"><img src="https://img.icons8.com/dotty/80/000000/shopping-cart.png" style='width: 30px; height:30px;'> UPGRADE</a>

              @elseif(session('role') == "Owner")
              <a href="{{ route('Pricings') }}" class="btn btn-success animated infinite fadeIn delay-2s"><img src="https://img.icons8.com/dotty/80/000000/shopping-cart.png" style='width: 30px; height:30px;'> UPGRADE</a>
            @endif
                
            @endif

              
          </li>
          <!-- Messages: style can be found in dropdown.less-->

          @isset($agentNotification)
          

          <li class="dropdown messages-menu">
              
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{ count($agentNotification) }}</span>
            </a>
            <ul class="dropdown-menu appointMsg">

              @include('includes.newnotify')
            </ul>
          </li>
              
          @endisset

          


          <li class="dropdown messages-menu">
              
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{ count($getAppointment) }}</span>
            </a>
            <ul class="dropdown-menu appointMsg">

              @include('includes.appointmentInbox')
            </ul>
          </li>
          
          <!-- Notifications: style can be found in dropdown.less -->
          {{-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> --}}
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu" style="display:none !important;">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              @if(session('role') == "Super")

          <img src="/company_logo/vimfile.jpg" class="img-circle" alt="User Image" style="width: 30px; height: 30px;">
          @else
          <img @if(count($getBussiness) > 0 && $getBussiness[0]->file2 != "") src="/company_logo/{{ $getBussiness[0]->file2 }}" @else src="{{ asset('company_logo/vimfile.jpg') }}" @endif  class="img-circle" alt="User Image" style="width: 30px; height: 30px;">
          @endif

              {{-- <img @if(count($getBussiness) > 0 && $getBussiness[0]->file2 != "") src="/company_logo/{{ $getBussiness[0]->file2 }}" @else src="{{ asset('company_logo/vimfile.jpg') }}" @endif  class="user-image" alt="User Image"> --}}
              

              @if(session('role') != 'Agent')<span class="hidden-xs">{{ session('company') }}</span>@else <span class="hidden-xs">{{ session('name') }}</span> @endif

            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}

                @if(session('role') == "Super")

          <img src="/company_logo/vimfile.jpg" class="img-circle" alt="User Image" style="width: 100px; height: 100px;">
          @else
          <img @if(count($getBussiness) > 0 && $getBussiness[0]->file2 != "") src="/company_logo/{{ $getBussiness[0]->file2 }}" @else src="{{ asset('company_logo/vimfile.jpg') }}" @endif  class="img-circle" alt="User Image">
          @endif

                {{-- <img @if(count($getBussiness) > 0 && $getBussiness[0]->file2 != "") src="/company_logo/{{ $getBussiness[0]->file2 }}" @else src="{{ asset('company_logo/vimfile.jpg') }}" @endif  class="img-circle" alt="User Image"> --}}

                @if(session('role') != 'Agent')<p>{{ session('company') }}</p>@else <p>{{ session('name') }}</p> @endif
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div>
                  <a href="#" class="btn btn-danger" onclick="logout('{{ session('username') }}')" style="width: 100% !important;">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>