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
                  <th>State/Province</th>
                  <th>City</th>
                  <th>Postal/Zip Code</th>
                  <th>Action</th>


                  @if($agreement = \App\Admin::where('email', session('email'))->where('role', 'Agent')->get())



                    @if (count($agreement) > 0 && $agreement[0]->province != "")

                    <th>Select to Print <br> <button class="btn btn-danger" type="button" class="btn btn-danger" onclick="processPrint()">Print Letter for Selected <img class="spinner disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button> </th>

                    @else

                    <th>Select to Print <br> <button class="btn btn-danger" type="button" class="btn btn-danger" onclick="processPrint()">Print Letter for Selected <img class="spinner disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button> </th>

                    @endif
                    

                  @else


                      <th>Select to Print <br> <button class="btn btn-danger" type="button" class="btn btn-danger" onclick="processPrint()">Print Letter for Selected <img class="spinner disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button> </th>



                @endif



                  

                </tr>
                </thead>
                <tbody id="inviteformcontact">

                        <?php $i = 1; $j = 0;?>

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
                                  <td>{{ $item->state }}</td>
                                  <td>{{ $item->city }}</td>
                                  <td>{{ $item->zipcode }}</td>
                                  <td>
                                    <button type="button" class="btn btn-primary" onclick="openModal('edit_info', '{{ $item->id }}')">Edit Info</button>
                                  </td>
      
                                  <td align="center">
                                      <label class="disp-0" for="checkme{{ $j }}">{{ $item->id }}</label>
                                      {{-- <input type="checkbox" name="checkme{{ $j }}" id="checkme{{ $j }}" value="{{ $item->id }}" multiple=""> --}}
                                      <input type="checkbox" name="checkme[]" value="{{ $item->id }}" multiple="">
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
                          <td>{{ $sorted->state }}</td>
                          <td>{{ $sorted->city }}</td>
                          <td>{{ $sorted->zipcode }}</td>
                          <td>
                            <button type="button" class="btn btn-primary" onclick="openModal('edit_info', '{{ $sorted->id }}')">Edit Info</button>
                          </td>

                          <td align="center">
                              <label class="disp-0" for="checkme{{ $j }}">{{ $sorted->id }}</label>
                              {{-- <input type="checkbox" name="checkme{{ $j }}" id="checkme{{ $j }}" value="{{ $sorted->id }}" multiple=""> --}}
                              <input type="checkbox" name="checkme[]" value="{{ $sorted->id }}" multiple="">
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
                          <td>{{ $sorted->state }}</td>
                          <td>{{ $sorted->city }}</td>
                          <td>{{ $sorted->zipcode }}</td>
                          <td>
                            <button type="button" class="btn btn-primary" onclick="openModal('edit_info', '{{ $sorted->id }}')">Edit Info</button>
                          </td>

                          <td align="center">
                              <label class="disp-0" for="checkme{{ $j }}">{{ $sorted->id }}</label>
                              {{-- <input type="checkbox" name="checkme{{ $j }}" id="checkme{{ $j }}" value="{{ $sorted->id }}" multiple=""> --}}
                              <input type="checkbox" name="checkme[]" value="{{ $sorted->id }}" multiple="">
                          </td>

                        </tr>

                        @endforeach


                  @endif

                    


                  @if($agreement = \App\Admin::where('email', session('email'))->where('role', 'Agent')->get())


                          @if (count($agreement) > 0 && $agreement[0]->province != "")

                          <tr>
                            <td colspan="7"></td>
                            <td align="center" colspan="1">
                              <button class="btn btn-danger" type="button" class="btn btn-danger" onclick="processPrint()">Print Letter for Selected <img class="spinner disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                            </td>
                          </tr>

                          @endif
                      

                    @else

                        

                        <tr>
                          <td colspan="7"></td>
                          <td align="center" colspan="1">
                            <button class="btn btn-danger" type="button" class="btn btn-danger" onclick="processPrint()">Print Letter for Selected <img class="spinner disp-0" src="{{ asset('img/loader/loader.gif') }}" style="width: 50px; height: auto;"></button>
                          </td>
                        </tr>



                  @endif




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
