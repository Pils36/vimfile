@extends('layouts.dashboard')

@section('title', 'Dashboard')

@show


@section('dashContent')
<?php use \App\Http\Controllers\Business; ?>
<?php use \App\Http\Controllers\Admin; ?>
<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('Admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->

            <div class="nav-tabs-custom">
            <h4 class="bg-aqua" style="padding: 5px;">@if(session('role') == 'Super') All Business Staff(s) @else All Staff(s) @endif</h4>

            @if(session('role') == 'Super')
            <table id="example2" class="table table-bordered table-hover">
              @if (count($getBusinessStaffs) > 0)
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Position</th>
                  <th>Station</th>
                  <th>Company</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                  <?php $i = 1;?>
                  @foreach ($getBusinessStaffs as $busStaffs)
                     <tr style="font-size: 12px;">
                      <td>{{ $i++ }}</td>
                      <td>{{ $busStaffs->firstname.' '.$busStaffs->lastname }} </td>
                      <td>{{ $busStaffs->email }}</td>

                      @if($user = \App\User::where('email', $busStaffs->email)->get())
                        @if (count($user) > 0)
                          <td>{{ $user[0]->phone_number }}</td>
                        @else
                          <td> - </td>
                        @endif
                      @else

                      <td> - </td>

                      @endif



                      <td>{{ $busStaffs->position }}</td>
                      <td>{{ $busStaffs->station }}</td>
                      @if($coy = \App\Business::where('busID', $busStaffs->busID)->get())
                      @if(count($coy) > 0)
                      <td>{{ $coy[0]->name_of_company }}</td>

                      @else
                      <td>-</td>
                      @endif
                      @endif
                      {{-- <td><button onclick="crud('{{ $busStaffs->id }}','editstaff')"><span class="label label-primary pull-left">Edit</span></button><button onclick="crud('{{ $busStaffs->id }}','delstaff')"><span class="label label-danger pull-right">Del</span></button></td> --}}

                      <td>

                        <button onclick="crud('{{ $busStaffs->id }}','editstaff')" style="background: none;"><span class="label pull-left"><img src="https://img.icons8.com/color/48/000000/edit.png" style="width: 15px; height: 15px;"></span></button>

                        <button onclick="crud('{{ $busStaffs->id }}','delstaff')" style="background: none;"><span class="label pull-right"><img src="https://img.icons8.com/color/48/000000/delete-sign.png" style="width: 15px; height: 15px;"></span></button>

                        <button id="client_profile" title="View Profile" onclick="viewStaff('{{ $busStaffs->id }}', '{{ $busStaffs->email }}', '{{ session('busID') }}')" style="background: none;"><span class="label pull-right"><img src="https://img.icons8.com/cotton/64/000000/view-file.png" style="width: 15px; height: 15px;"></span> <img class="spinnersClient{{ $busStaffs->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>

                        

                        
                      
                      </td>
                    </tr>
                  @endforeach
               
                </tbody>

                @else

                <p class="text-center"><button onclick="create('staff')" class="btn btn-default">Create Staff</button></p>
              @endif
                
                
              </table>

              @else

              <table id="example2" class="table table-bordered table-hover">
              @if (count($getBusinessStaffs) > 0)
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Position</th>
                  <th>Station</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                  <?php $i = 1;?>
                  @foreach ($getBusinessStaffs as $busStaffs)
                     <tr style="font-size: 12px;">
                      <td>{{ $i++ }}</td>
                      <td>{{ $busStaffs->firstname.' '.$busStaffs->lastname }} </td>
                      <td>{{ $busStaffs->email }}</td>
                        @if($user = \App\User::where('email', $busStaffs->email)->get())
                          @if (count($user) > 0)
                            <td>{{ $user[0]->phone_number }}</td>
                          @else
                            <td> - </td>
                          @endif
                        @else
                        
                        <td> - </td>
                        
                        @endif
                      <td>{{ $busStaffs->position }}</td>
                      <td>{{ $busStaffs->station }}</td>
                      {{-- <td><button onclick="crud('{{ $busStaffs->id }}','editstaff')"><span class="label label-primary pull-left">Edit</span></button><button onclick="crud('{{ $busStaffs->id }}','delstaff')"><span class="label label-danger pull-right">Del</span></button></td> --}}

                      <td>
                        
                        <button onclick="crud('{{ $busStaffs->id }}','editstaff')" style="background: none;"><span class="label pull-left"><img src="https://img.icons8.com/color/48/000000/edit.png" style="width: 15px; height: 15px;"></span></button>
                        
                        <button onclick="crud('{{ $busStaffs->id }}','delstaff')" style="background: none;"><span class="label pull-right"><img src="https://img.icons8.com/color/48/000000/delete-sign.png" style="width: 15px; height: 15px;"></span></button>
                      
                        <button id="client_profile" title="View Profile" onclick="viewStaff('{{ $busStaffs->id }}', '{{ $busStaffs->email }}', '{{ session('busID') }}')" style="background: none;"><span class="label pull-right"><img src="https://img.icons8.com/cotton/64/000000/view-file.png" style="width: 15px; height: 15px;"></span> <img class="spinnersClient{{ $busStaffs->id }} disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>

                      </td>
                    </tr>
                  @endforeach
               
                </tbody>

                @else

                <p class="text-center"><button onclick="create('staff')" class="btn btn-default">Create Staff</button></p>
              @endif
                
                
              </table>

              @endif



            
          </div>
          <!-- /.box -->


          @if(session('role') == 'Super')

          <div class="nav-tabs-custom">
            <h4 class="bg-aqua" style="padding: 5px;">All Users</h4>

            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-hover">
                @if (count($otherUsers) > 0)
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>User Type</th>
                    <th>Platform</th>
                    <th>Date of Reg.</th>
                    <th>Action</th>
                  </tr>
                  </thead>
  
                  <tbody>
                    <?php $i = 1;?>
                    @foreach ($otherUsers as $otherUser)
                       <tr style="font-size: 12px;">
                        <td>{{ $i++ }}</td>
                        <td>{{ $otherUser->name }} </td>
                        @if($username = \App\Admin::where('email', $otherUser->email)->get())
                          @if (count($username) > 0)
                          <td> {{ $username[0]->username }} </td>
                          @else
                          <td> - </td>
                          @endif
  
                        @else
                        <td> - </td>
                        @endif
  
                        <td>{{ $otherUser->email }}</td>
                        <td>{{ $otherUser->phone_number }}</td>
                        <td>{{ $otherUser->city }}</td>
                        <td>{{ $otherUser->state }}</td>
                        <td>{{ $otherUser->country }}</td>
                        <td>{{ $otherUser->userType }}</td>
                        <td>{{ ucwords($otherUser->platform) }}</td>
                        <td>{{ date('d/F/Y', strtotime($otherUser->created_at)) }}</td>
  
                        <td>
                          {{-- <button onclick="crud('{{ $otherUser->id }}','editUser')" style="background: none;"><span class="label pull-left"><img src="https://img.icons8.com/color/48/000000/edit.png" style="width: 15px; height: 15px;"></span></button> --}}
  
                          <button onclick="crud('{{ $otherUser->email }}','deluser')" style="background: none;" title="Delete {{ $otherUser->name }}"><span class="label pull-right"><img src="https://img.icons8.com/color/48/000000/delete-sign.png" style="width: 15px; height: 15px;"></span></button>
                        </td>
                      </tr>
                    @endforeach
                 
                  </tbody>
  
                  @else
  
                  <p class="text-center">No user registration yet</p>
                @endif
                  
                  
                </table>
            </div>
            
          </div>
          <!-- /.box -->

          @endif

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
{{--         <section class="col-lg-4 connectedSortable">

          

        </section> --}}
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->


   
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Vehicle Inspection & Maintenance</b>
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="mailto: info@vimfile.com" target="_blank">Vimfile</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection
