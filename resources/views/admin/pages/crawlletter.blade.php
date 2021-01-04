@extends('layouts.dashboard')

@section('title', 'Dashboard')
<?php use \App\Http\Controllers\User; ?>
<?php use \App\Http\Controllers\SuggestedMechanics; ?>
@show


@section('dashContent')

<div class="wrapper">

  @include('includes.dashhead')
  @include('includes.dashaside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="box">
            <div class="box-header bg-blue">
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Claim Business Letters</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if($crawlsort != "#")

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Company Name</th>
                  <th>Contact Address</th>
                  <th>Contact Name</th>
                  <th>Contact Email</th>
                  <th>Contact Phone</th>
                  <th>State/Province</th>
                  <th>File</th>
                </tr>
                </thead>
                <tbody>

                  @if($leftOver = \App\SuggestedMechanics::where('country', request()->get('country'))->where('country', '!=', null)->orderBy('created_at', 'DESC')->get())


                  @if(count($leftOver) > 0)

                    <?php $i = 1;?>
                  @foreach($leftOver as $sorted)

                  @if(file_exists($crawlsort.'/'.$sorted->station_name.'.pdf'))

                      @if($userInfo = \App\User::where('station_name', $sorted->station_name)->where('country', '!=', null)->orderBy('created_at', 'DESC')->get())
                        
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $sorted->station_name }}</td>
                        <td>{{ $sorted->address }}</td>

                        @if($userInfo = \App\User::where('station_name', $sorted->station_name)->get())

                        @if(count($userInfo) > 0)
                        <td>{{ $userInfo[0]->name }}</td>
                        <td>{{ $userInfo[0]->email }}</td>
                        @else
                        <td>-</td>
                        <td>-</td>

                        @endif

                        @else

                        <td>-</td>
                        <td>-</td>
                        @endif
                        
                        <td>{{ $sorted->telephone }}</td>
                        <td>{{ $sorted->state }}</td>
                        <td>
                          <a href="/{{ $crawlsort.'/'.$sorted->station_name.'.pdf' }}" class="btn btn-primary" target="_blank">Preview to Print Letter</a>
                        </td>
                        
                      </tr>

                      @endif

                    @endif
                    
                  @endforeach




                  @endif


                  @endif

                  
                
                </tbody>
              </table>

               @else


               <h4 class="text-center">No letters here</h4>

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
