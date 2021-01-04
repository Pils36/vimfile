@extends('layouts.dashboard')

@section('title', 'Dashboard')
<?php use \App\Http\Controllers\User; ?>
<?php use \App\Http\Controllers\Admin; ?>
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
              <h3 class="box-title" style="text-transform: uppercase; font-weight: bolder;">Mechanic List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">



        @if(count($crawlsort) > 0)

                <h4><b>Search</b></h4>
                <input type="text" name="search" id="search" placeholder="Search by company, address, state/province, city, zipcode" class="form-control">
                <br>
              <table id="myTable" class="table table-bordered table-striped tablesorter">
                <form action="{{ route('printLetter') }}" method="POST" id="myform">
                      @csrf

                <thead>
                <tr style="font-size: 13px;">
                  <th>#</th>
                  <th>Company</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>State/Province</th>
                  <th>City</th>
                  <th>Postal/Zip Code</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody id="inviteformcontact">
                        <?php $i = 1; $j = 0;?>


                  {{-- Start --}}

                  @if($agreement = \App\Admin::where('email', session('email'))->where('role', 'Agent')->get())

                    @if (count($agreement) > 0 && $agreement[0]->province != "")

                          @php
                              $province = json_decode($agreement[0]->province);
                          @endphp

                        @foreach ($province as $thisstate)

                                @if($result = \App\SuggestedMechanics::where('location', 'LIKE', '%'.$thisstate.'%')->orWhere('state', 'LIKE', '%'.$thisstate.'%')->get())

                                    @if (count($result) > 0)

                                        <?php $j = $j + 1; ?>

                                          @foreach ($result as $item)
                                            <tr>
                                              <td>{{ $i++ }}</td>
                                              <td>{{ $item->station_name }}</td>
                                              <td>{{ $item->address }}</td>
                                              <td>{{ $item->telephone }}</td>
                                              <td>{{ $item->state }}</td>
                                              <td>{{ $item->city }}</td>
                                              <td>{{ $item->zipcode }}</td>
                                              <td>
                                                <a type="button" class="btn btn-primary" onclick="checkClaim('{{ $item->station_name }}', '{{ $item->telephone }}', {{ $i }})">Update Info. <img class="spin{{ $i }} disp-0" src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 20px; height: 20px;"></a>
                                              </td>

                                            </tr>
                                        @endforeach

                                      

                                    @endif

                              @endif
                        @endforeach


                        @else

                        @foreach($crawlsort as $sorted)


                <?php $j = $j + 1; ?>
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $sorted->station_name }}</td>
                      <td>{{ $sorted->address }}</td>
                      <td>{{ $sorted->telephone }}</td>
                      <td>{{ $sorted->state }}</td>
                      <td>{{ $sorted->city }}</td>
                      <td>{{ $sorted->zipcode }}</td>
                      <td>
                        <a type="button" class="btn btn-primary" onclick="checkClaim('{{ $sorted->station_name }}', '{{ $sorted->telephone }}', {{ $i }})">Update Info. <img class="spin{{ $i }} disp-0" src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 20px; height: 20px;"></a>
                      </td>

                    </tr>

                  @endforeach

                    @endif


                @else

                @foreach($crawlsort as $sorted)


                <?php $j = $j + 1; ?>
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $sorted->station_name }}</td>
                      <td>{{ $sorted->address }}</td>
                      <td>{{ $sorted->telephone }}</td>
                      <td>{{ $sorted->state }}</td>
                      <td>{{ $sorted->city }}</td>
                      <td>{{ $sorted->zipcode }}</td>
                      <td>
                        <a type="button" class="btn btn-primary" onclick="checkClaim('{{ $sorted->station_name }}', '{{ $sorted->telephone }}', {{ $i }})">Update Info. <img class="spin{{ $i }} disp-0" src="https://i.ya-webdesign.com/images/loading-gif-png-5.gif" style="width: 20px; height: 20px;"></a>
                      </td>

                    </tr>

                  @endforeach


                @endif


                  {{-- End --}}



                </tbody>
                </form>
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
