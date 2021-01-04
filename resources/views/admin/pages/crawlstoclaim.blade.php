@extends('layouts.dashboard')

@section('title', 'Dashboard')
<?php use \App\Http\Controllers\User; ?>
<?php use \App\Http\Controllers\Admin; ?>
@show


@section('dashContent')

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="box">
            <div class="box-header bg-blue">
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Mechanic List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($crawlsort) > 0)

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Country</th>
                  <th>Number of mechanics</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>

                  <?php $i = 1;?>
                  @foreach($crawlsort as $sorted)

                    {{-- Start --}}

                    @if($agreement = \App\Admin::where('email', session('email'))->where('role', 'Agent')->get())

                    @if (count($agreement) > 0)

                      @if($result = \App\Admin::where('country', $sorted->country)->where('role', 'Agent')->get())
                      
                        @if (count($result) > 0)

                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $sorted->country }}</td>
                          <td>{{ $sorted->total }}</td>
                          <td>
                            <button class="btn btn-primary" onclick="location.href='/Admin/supportmechanicsin/{{ $sorted->country }}'">View mechanics</button>
                          </td>
                          
                        </tr>
                            
                            
                        @endif

                      @endif

                        
                    @else

                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $sorted->country }}</td>
                      <td>{{ $sorted->total }}</td>
                      <td>
                        <button class="btn btn-primary" onclick="location.href='/Admin/supportmechanicsin/{{ $sorted->country }}'">View mechanics</button>
                      </td>
                      
                    </tr>
                        
                    @endif

                  @else


                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $sorted->country }}</td>
                    <td>{{ $sorted->total }}</td>
                    <td>
                      <button class="btn btn-primary" onclick="location.href='/Admin/supportmechanicsin/{{ $sorted->country }}'">View mechanics</button>
                    </td>
                    
                  </tr>

                  @endif


                    {{-- Stop --}}











                    
                  @endforeach

                  
                
                </tbody>
              </table>

               @else


               <h4 class="text-center">No record here yet</h4>

        @endif
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer disp-0">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection
