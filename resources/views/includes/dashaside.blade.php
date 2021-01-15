 <!-- Left side column. contains the logo and sidebar -->
 <?php use \App\Http\Controllers\Admin; ?>

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

          @if(session('role') == "Super")

          <img src="/company_logo/vimfile.jpg" class="img-circle" alt="User Image">
          @else
          <img @if(count($getBussiness) > 0 && $getBussiness[0]->file2 != "") src="/company_logo/{{ $getBussiness[0]->file2 }}" @else src="{{ asset('company_logo/vimfile.jpg') }}" @endif  class="img-circle" alt="User Image">
          @endif





        </div>
        <div class="pull-left info">
          @if(session('role') != 'Agent')<p>{{ session('company') }}</p>@else <p>{{ session('name') }}</p> @endif
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form disp-0">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="active treeview-menu">
            <li data-step="1" data-intro="My Name is 'Wrench', Your Vimfile Tour Guide. Thanks for signing up on vimfile.com.
                I understand that you want to manage your Auto Repair Store more efficiently and i
                would be glad assist you to walk-through Vimfile for Auto Repair Centre.
                To proceed, click 'Next'" ><a href="{{ route('Admin') }}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            @if(session('role') == "Super")
              <li><a href="{{ route('Activitylog') }}"><i class="fa fa-circle-o"></i> Activity Log</a></li>
              <li><a href="{{ route('SupportActivitylog') }}"><i class="fa fa-circle-o"></i> Support Activity Log</a></li>
              <li onclick="createModal('agent')"><a href="#"><i class="fa fa-circle-o"></i> Create Support Agent</a></li>
              <li onclick="createModal('createusers')"><a href="#"><i class="fa fa-circle-o"></i> Create Mechanics by Adm..</a></li>
              
            @endif


            @if(session('role') == "Super" || session('role') == "Agent")

            <li><a href="{{ route('createdmechanics') }}"><i class="fa fa-circle-o"></i> Signed Up Mechanics</a></li>

            @endif

            @if(session('role') == 'Owner')

            <li data-step="2" data-intro="Create stations associated to your company." onclick="create('station')"><a href="#"><i class="fa fa-circle-o"></i> Create Stations</a></li>
            <li data-step="3" data-intro="Create staffs and assign them a station." onclick="create('staff')"><a href="#"><i class="fa fa-circle-o"></i> Create Staff</a></li>

            @else
                @if(session('role') == 'Super')
                    <li onclick="listOut('users')"><a href="#"><i class="fa fa-circle-o"></i> All Users List</a></li>
                    <li onclick="listOut('personal')"><a href="#"><i class="fa fa-circle-o"></i> Personal List</a></li>

                @endif
            @endif
          </ul>
        </li>

        @if(session('role') == "Super")

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Personal Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Users
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('adminnoncommercial') }}"><i class="fa fa-circle-o"></i> Non Commercial <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ $countnonCom }}</small></span></a></li>
                <li><a href="{{ route('admincommercial') }}"><i class="fa fa-circle-o"></i> Commercial<span class="pull-right-container">
              <small class="label pull-right bg-red">{{ $countCom }}</small></span></a></li>

              </ul>
            </li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Business Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Users
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admincorporate') }}"><i class="fa fa-circle-o"></i>Corporate<span class="pull-right-container">
              <small class="label pull-right bg-red">{{ $countCorp + $countstaffCorp }}</small></span></a></li>
                <li><a href="{{ route('adminautodeals') }}"><i class="fa fa-circle-o"></i> Auto Dealers<span class="pull-right-container">
              <small class="label pull-right bg-red">{{ $countautoDeal }}</small></span></a></li>

              </ul>
            </li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Professional Mechanics</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Users
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('adminautocare') }}"><i class="fa fa-circle-o"></i> Auto Care Stores<span class="pull-right-container">
              <small class="label pull-right bg-red">{{ count($autoStores) }}</small></span></a></li>
                <li><a href="{{ route('adminautocarestaff') }}"><i class="fa fa-circle-o"></i> Auto Care Staffs<span class="pull-right-container">
              <small class="label pull-right bg-red">{{ count($autoStaffs) }}</small></span></a></li>

              </ul>
            </li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Vimcare</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Users
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('adminmobilemechs') }}"><i class="fa fa-circle-o"></i> Mobile Mechanics<span class="pull-right-container">
              <small class="label pull-right bg-red">{{ $countcertProf }}</small></span></a></li>



              </ul>
            </li>

          </ul>
        </li>




        @endif



        {{-- Start Agent Menu --}}

        @if (session('role') == 'Agent')

        @if($agreement = \App\Admin::where('email', session('email'))->get())

        @if (count($agreement) > 0 && $agreement[0]->signed_agreement == 1)

        <li class="treeview">
          <a href="#" title="Generate Claim Business Letter">
            <i class="fa fa-files-o"></i> <span>Generate Claim Busin...</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('crawlsnoMail') }}"><i class="fa fa-circle-o"></i>Mechanics List</a></li>
            <li><a href="{{ route('crawlprint') }}"><i class="fa fa-circle-o"></i>Downloaded Letters</a></li>
            
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Mechanics Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li onclick="createModal('createusers')"><a href="#"><i class="fa fa-circle-o"></i>Create New</a></li>
            <li><a href="{{ route('crawlstoclaim') }}"><i class="fa fa-circle-o"></i>Update</a></li>
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>View</a></li>
            
          </ul>
        </li>



        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Your Account Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>30-Day Trial</a></li>
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Free Plan</a></li>
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Paid Service</a></li>
          </ul>
        </li>



        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Documents</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('agreementtemplate') }}"><i class="fa fa-circle-o"></i>Agreement Template</a></li>
            <li ><a href="{{ route('agreementtemplate') }}"><i class="fa fa-circle-o"></i>Signed Agreement</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Promotion Materials</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('promotionmaterial', 'video') }}"><i class="fa fa-circle-o"></i>Video</a></li>
            <li><a href="{{ route('promotionmaterial', 'mp4') }}"><i class="fa fa-circle-o"></i>MP4</a></li>
            <li><a href="{{ route('promotionmaterial', 'pdf') }}"><i class="fa fa-circle-o"></i>PDF</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Commission</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Earned</a></li>
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Paid</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Workflow (PDF)</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('workflowmaterials', 'Portal Resource') }}"><i class="fa fa-circle-o"></i>Portal Resource <small class="label pull-right bg-red">{{ $workflowcount['portal_res'] }}</small></span></a></li>
            <li><a href="{{ route('workflowmaterials', 'Engaging Mechanics') }}"><i class="fa fa-circle-o"></i>Engaging Mechanics <small class="label pull-right bg-red">{{ $workflowcount['engaging_mechs'] }}</small></span></a></li>
            <li><a href="{{ route('workflowmaterials', 'More Resource') }}"><i class="fa fa-circle-o"></i>More Resources <small class="label pull-right bg-red">{{ $workflowcount['more_res'] }}</small></span></a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-open"></i>
            <span>Mail</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="quickMail('compose')"><a href="#"><i class="fa fa-circle-o"></i> Compose Mail</a></li>
            {{-- <li><a href=""><i class="fa fa-circle-o"></i> Inbox</a></li> --}}
          </ul>
        </li>



        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Update Profile</a></li>
            <li><a href="#" onclick="$('#change_pass').click()"><i class="fa fa-circle-o"></i>Change Password</a></li>
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Banking information</a></li>
          </ul>
        </li>


        @else


        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Documents</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('agreementtemplate') }}"><i class="fa fa-circle-o"></i>Agreement Template</a></li>
            <li ><a href="{{ route('agreementtemplate') }}"><i class="fa fa-circle-o"></i>Signed Agreement</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-open"></i>
            <span>Mail</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="quickMail('compose')"><a href="#"><i class="fa fa-circle-o"></i> Compose Mail</a></li>
            {{-- <li><a href=""><i class="fa fa-circle-o"></i> Inbox</a></li> --}}
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Update Profile</a></li>
            <li><a href="#" onclick="$('#change_pass').click()"><i class="fa fa-circle-o"></i>Change Password</a></li>
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Banking information</a></li>
          </ul>
        </li>



        @endif


        @endif


            
        @endif


        {{-- End Agent Menu --}}

        
        @if(session('role') != 'Agent')

        <li data-step="4" data-intro="Get all reports as to station activities here" class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li data-step="5" data-intro="Station reports"><a href="{{ route('StationReport') }}"><i class="fa fa-circle-o"></i> Station Report</a></li>
            <li data-step="6" data-intro="Maintenance reports" class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Maintenance Report
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('MaintenanceServiceTypeReport') }}"><i class="fa fa-circle-o"></i> Service Type</a></li>
                <li><a href="{{ route('MaintenanceServiceOptionReport') }}"><i class="fa fa-circle-o"></i> Service Option</a></li>

              </ul>
            </li>

            <li data-step="7" data-intro="My customers information"><a href="{{ route('clientProfile') }}"><i class="fa fa-circle-o"></i> Client Profile</a></li>
            <li data-step="7" data-intro="Revenue Report"><a href="{{ route('RevenueReport') }}"><i class="fa fa-circle-o"></i> Revenue</a></li>
            <li class="disp-0"><a href="#"><i class="fa fa-circle-o"></i> Inventory</a></li>

          </ul>
        </li>

        @endif

        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Set Permissions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="comingSoon()"><a href="#"><i class="fa fa-circle-o"></i>Coming Soon</a></li>
          </ul>
        </li> --}}

        @if(session('role') == 'Owner')

        <li onclick="comingSoon()">
          <a href="#">
            <i class="fa fa-lock"></i>
            <span>Set Permission</span>
          </a>
        </li>

        <li onclick="comingSoon()">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>Settings</span>
          </a>
        </li>


        <li>
          <a href="{{ route('Profile') }}">
            <i class="fa fa-user"></i>
            <span>Update Profile</span>
          </a>
        </li>
        @endif

        @if(session('role') == 'Owner' || session('role') == 'Super')

        <li>
          <a href="#" onclick="$('#change_pass').click()">
            <i class="fa fa-lock"></i>
            <span>Change Password</span>
          </a>
        </li>

        @endif

        @if(session('role') == 'Super')

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>VIMFile Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('busywrench') }}"><i class="fa fa-circle-o"></i>Busy Wrench</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-open"></i>
            <span>Mail</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="quickMail('compose')"><a href="#"><i class="fa fa-circle-o"></i> Compose Mail</a></li>
            {{-- <li><a href=""><i class="fa fa-circle-o"></i> Inbox</a></li> --}}
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-question"></i>
            <span>Platform Operation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('Question') }}"><i class="fa fa-circle-o"></i>Monitor Questions</a></li>
            <li onclick="setMin()"><a href="javascript::void()"><i class="fa fa-circle-o"></i> Set Minimum</a></li>
          </ul>
        </li>



        <li class="treeview">
          <a href="#">
            <i class="fa fa-question"></i>
            <span>News and Happenings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li onclick="showNewshappening()"><a href="#"><i class="fa fa-circle-o"></i>Create Post</a></li>
            <li><a href="{{ route('Allnews') }}"><i class="fa fa-circle-o"></i>View all</a></li>
            <li><a href="{{ route('Feedback') }}"><i class="fa fa-circle-o"></i> Feedbacks</a></li>
          </ul>
        </li>

        <li class="treeview disp-0">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Commercial Menu</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li onclick="showRev()"><a href="#"><i class="fa fa-circle-o"></i>Add Revenue</a></li>
              {{-- <li><a href=""><i class="fa fa-circle-o"></i> Inbox</a></li> --}}
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-balance-scale"></i>
              <span>Payment History</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('Paymenthistory') }}"><i class="fa fa-circle-o"></i>View History</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-balance-scale"></i>
              <span>Opportunity Activities</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('Opportunity') }}"><i class="fa fa-circle-o"></i>Posted Opportunities</a></li>
              <li><a href="{{ route('Postedestimate') }}"><i class="fa fa-circle-o"></i>Posted Estimates</a></li>
              <li><a href="{{ route('Workinprogress') }}"><i class="fa fa-circle-o"></i>Work In Progress</a></li>
              <li><a href="{{ route('Jobdone') }}"><i class="fa fa-circle-o"></i>Job Done</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i>Rejected Works</a></li>
            </ul>
          </li>


        @endif



        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li> --}}

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
