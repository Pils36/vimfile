  <!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

<script src="{{ asset('js/jpreview/jpreview.js') }}"></script>


<script src="{{ asset('ext/js/summernote/summernote-updated.min.js') }}"></script>
  <script src="{{ asset('ext/js/summernote/summernote-active.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

<script src="{{ asset('js/country-state-select.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.widgets.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@if (session('success'))
        <script>
            swal('Good', '{{ session("success") }}', 'success');
        </script>

    @elseif(session('error'))

        <script>
            swal('Oops', '{{ session("error") }}', 'error');
        </script>

    @endif


  <script language="javascript">
    populateCountries("agent_country", "agent_state");
    populateCountries("agents_country", "agents_state");
  </script>

<script language="javascript">
    populateCountries("country", "state");
    populateCountries("mechstation_country", "mechstation_state");
</script>


<script language="javascript">
    populateCountries("prof_country", "prof_state");
</script>



<script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#inviteformcontact tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


  $(function () {

    // Load Appointment Messages
// setInterval(function(){ $(".appointMsg").load("includes/appointmentInbox") }, 2000);

    $('#example7').DataTable();
    $('#example6').DataTable();
    $('#example3').DataTable();
    $('#example4').DataTable();
    $('#example5').DataTable();
    $('#examplebizowner').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'responsive': true,
    });


    $('#example1').DataTable( {
      autoWidth   : true,
      responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'print',
        ]

    } );

    $("#myTable").tablesorter();




$('#newsDesc').summernote();
$('#bwDesc').summernote();
$('#review_reply').summernote();
$('#background').summernote();
$('#hours_of_operation').summernote({
  placeholder: 'Mon: 9am - 5pm <br> Tue: 9am - 5pm <br> Wed: 9am - 5pm <br> Thurs: 9am - 5pm <br> Fri: 9am - 5pm <br> Sat: 10am - 3pm <br> Sun: Closed'
});


  });

  $.widget.bridge('uibutton', $.ui.button);




// Launch List Modal
function listOut(val){
  if(val == "users"){
    $("#modal-UserList").click();
  }
  if(val == "personal"){
    $("#modal-PersonalList").click();
  }
}


function showreplyBox(id) {
    $('#post_message_id').val(id);
    $('.respondbox').removeClass('disp-0');
}


function create(val){
  if(val == "staff"){
    $("#id_staff").val('');
    $("#busIDstaff").val('{{ session('busID') }}');
    $("#firstname").val('');
    $("#lastname").val('');
    $("#username").val('');
    $("#password").val('');
    $("#email").val('');
    $("#position").val('');
    $("#modal-Staff").click();
  }
  if(val == "station"){
    $("#id").val('');
    $("#busIDstation").val('{{ session('busID') }}');
    $("#stationz").val('');
    $("#station_address").val('');
    $("#station_phone").val('');
    $("#city").val('');
    $("#state").val('');
    $("#country").val('');
    $("#modal-Station").click();
  }
}
// Create Staff
function staff(purpose,val){
    var route = "";
    var thisdata = "";

if(purpose == "create"){
    if(val == "staff"){
      $("#staff_save").text('Please wait...');
    route = "{{ URL('Ajax/Createstaff') }}";
    thisdata = {
      busID: $("#busIDstaff").val(),
      firstname: $("#firstname").val(),
      lastname: $("#lastname").val(),
      username: $("#username").val(),
      password: $("#password").val(),
      email: $("#email").val(),
      station: $("#station").val(),
      position: $("#position").val(),
      userType: $("#userType").val(),
      action: purpose,

    }


  }
  else if(val == "station"){
    $("#station_save").text('Please wait...');
     route = "{{ URL('Ajax/Createstation') }}";
      thisdata = {
        busID: $("#busIDstation").val(),
        stations: $("#stationz").val(),
        station_address: $("#station_address").val(),
        station_phone: $("#station_phone").val(),
        city: $("#city").val(),
        state: $("#state").val(),
        country: $("#country").val(),
        zipcode: $("#zippcode").val(),
        action: purpose,
    }

}

}

if(purpose == "update"){

  if(val == "staff"){
    $("#staff_update").text('Please wait...');
    route = "{{ URL('Ajax/Createstaff') }}";
    thisdata = {
      id: $("#id_staff").val(),
      busID: $("#busIDstaff").val(),
      firstname: $("#firstname").val(),
      lastname: $("#lastname").val(),
      username: $("#username").val(),
      password: $("#password").val(),
      email: $("#email").val(),
      station: $("#station").val(),
      position: $("#position").val(),
      userType: $("#userType").val(),
      action: purpose,

    }

  }
  else if(val == "station"){
    $("#station_update").text('Please wait...');
     route = "{{ URL('Ajax/Createstation') }}";
      thisdata = {
        id: $("#id").val(),
        busID: $("#busIDstation").val(),
        stations: $("#stationz").val(),
        station_address: $("#station_address").val(),
        station_phone: $("#station_phone").val(),
        city: $("#city").val(),
        state: $("#state").val(),
        country: $("#country").val(),
        zipcode: $("#zippcode").val(),
        action: purpose,
    }

}

}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
            if (result.message == "success") {

              if(result.action == "staff_created"){
                swal({
                    title: "Done",
                    text: result.res,
                    icon: result.message,
                    buttons: ["Cancel", "Ok"],
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      swal("Good", {
                        icon: "success",
                      });
                      setTimeout(function(){ location.href = 'Admin'; }, 1000);
                    } else {
                      swal("Ok Thanks!");
                    }
                  });
              }
              else if(result.action == "staff_updated"){
                $("#close_staff").click();
                swal("Good Job!", result.res, result.message);
                setTimeout(function(){ location.href = result.link; }, 5000);
              }
              else{
                $("#id").val('');
                $("#busIDstation").val('{{ session('busID') }}');
                $("#stationz").val('');
                $("#station_address").val(),
                $("#station_phone").val(),
                $("#city").val('');
                $("#state").val('');
                $("#country").val('');
                $("#close_station").click();
                swal("Good Job!", result.res, result.message);
                setTimeout(function(){ location.href = result.link; }, 1000);
              }

            }
            else
            {
              $("#staff_save").text('Save');
              $("#station_save").text('Save');
              $("#station_update").text('Update');
              $("#staff_update").text('Update');
               swal("Oops!", result.res, result.message);
            }

        }

      });
}


// Make Crud on Stations and Staff
function crud(id, val){
  var route = "{{ URL('Ajax/BusinessCrud') }}";
  var thisdata = {
    id: id,
    purpose: val,
  };

  if(val == 'delstation' || val == 'delstaff'){
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this detail!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        thisdata = {
            id: id,
            purpose: val,
          };
           setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.action == "delete"){
              swal('Ok!',result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 1000);
            }
        }
      });
      } else {
        swal("Your station detail is safe!");
      }
    });
  }
  else{
          setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
            if (result.message == "success") {
              // Do pop up
              var res;
              if(result.action == "editstation"){
                res = JSON.parse(result.data);
                $("#station_update").removeClass('disp-0');
                $("#station_save").addClass('disp-0');
                $("#id").val(res[0].id);
                $("#busIDstation").val(res[0].busID);
                $("#stationz").val(res[0].station_name);
                $("#station_address").val(res[0].station_address);
                $("#station_phone").val(res[0].station_phone);
                $("#city").val(res[0].city);
                // $("#state").val(res[0].state);
                // $("#country").val(res[0].country);
                $("#zippcode").val(res[0].zipcode);
                $("#modal-Station").click();
              }

              else if(result.action == "editstaff"){
                res = JSON.parse(result.data);

                $("#staff_update").removeClass('disp-0');
                $("#staff_save").addClass('disp-0');
                $("#id_staff").val(res[0].id);
                $("#busIDstaff").val(res[0].busID);
                $("#firstname").val(res[0].firstname);
                $("#lastname").val(res[0].lastname);
                $("#username").val(res[0].username);
                $("#password").val(res[0].password);
                $("#email").val(res[0].email);
                $("#position").val(res[0].position);
                $("#station").val(res[0].station);
                $("#modal-Staff").click();
              }


            }


        }

      });
  }


}


// Function Fetch Report
function fetchReport(val){
  var route = "";
  var thisdata = "";
  $("tbody#stationReports").html('');
  if(val == "station"){
    route = "{{ URL('Ajax/StationReport') }}";
    thisdata = {
      busID: $("#stationID").val(),
      station_name: $("#station_nameReport").val(),
      date_from: $("#date_from").val(),
      date_to: $("#date_to").val(),
    }

      setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          // Put Loader
          $(".spinner").removeClass('disp-0');
          // $("tbody#stationReports").html('<tr><td colspan="14" align="center">Loading...</td></tr>');
        },
        success: function(result){
            $(".spinner").addClass('disp-0');

          var res;
          var file;
          if (result.message == "success") {
            res = JSON.parse(result.data);
            if(result.action == "stationreport"){
                $("tbody#stationReports").html("<tr align='center'><td><a href='/Stationreportexport/"+result.resp+"/"+result.dayfrom+"/"+result.dayto+"'>Click to Export Full Report</a></td></tr>");

              $.each(res, function(v,k){
                file = k.file
                if(file != "" || file != "noImage.png"){
                  $("tbody#stationReports").append("<tr style='font-size: 12px;'><td>"+ k.date +"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.model +"</td><td>"+ k.mileage +"</td><td>"+ k.service_type +"</td><td>"+ k.service_option +"</td><td>"+ k.total_cost +"</td><td><a style='font-size: 11px;' href='/uploads/"+ k.file +"' target='_blank'>Open file</a></td></tr>");

                  $("tbody#stationReportz").append("<tr style='font-size: 12px;'><td>"+ k.date +"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.model +"</td><td>"+ k.mileage +"</td><td>"+ k.service_type +"</td><td>"+ k.service_option +"</td><td>"+ k.material_qty +"</td><td>"+ k.material_cost +"</td><td>"+ k.service_item_spec +"</td><td>"+ k.manufacturer +"</td><td>"+ k.material_qty2 +"</td><td>"+ k.material_cost2 +"</td><td>"+ k.service_item_spec2 +"</td><td>"+ k.manufacturer2 +"</td><td>"+ k.material_qty3 +"</td><td>"+ k.material_cost3 +"</td><td>"+ k.service_item_spec3 +"</td><td>"+ k.manufacturer3 +"</td><td>"+ k.labour_qty +"</td><td>"+ k.labour_cost +"</td><td>"+ k.labour_qty2 +"</td><td>"+ k.labour_cost2 +"</td><td>"+ k.other_qty +"</td><td>"+ k.other_cost +"</td><td>"+ k.total_cost +"</td><td><a style='font-size: 11px;' href='/uploads/"+ k.file +"' target='_blank'>Open file</a></td></tr>");
                }
                else{
                  $("tbody#stationReports").append("<tr style='font-size: 12px;'><td>"+ k.date +"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.model +"</td><td>"+ k.mileage +"</td><td>"+ k.service_type +"</td><td>"+ k.service_option +"</td><td>"+ k.total_cost +"</td><td></td></tr>");

                  $("tbody#stationReportz").append("<tr style='font-size: 12px;'><td>"+ k.date +"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.model +"</td><td>"+ k.mileage +"</td><td>"+ k.service_type +"</td><td>"+ k.service_option +"</td><td>"+ k.material_qty +"</td><td>"+ k.material_cost +"</td><td>"+ k.service_item_spec +"</td><td>"+ k.manufacturer +"</td><td>"+ k.material_qty2 +"</td><td>"+ k.material_cost2 +"</td><td>"+ k.service_item_spec2 +"</td><td>"+ k.manufacturer2 +"</td><td>"+ k.material_qty3 +"</td><td>"+ k.material_cost3 +"</td><td>"+ k.service_item_spec3 +"</td><td>"+ k.manufacturer3 +"</td><td>"+ k.labour_qty +"</td><td>"+ k.labour_cost +"</td><td>"+ k.labour_qty2 +"</td><td>"+ k.labour_cost2 +"</td><td>"+ k.other_qty +"</td><td>"+ k.other_cost +"</td><td>"+ k.total_cost +"</td><td></td></tr>");
                }

              });

            }

        }
        else
        {
          $("tbody#stationReports").append("<tr style='font-size: 16px; text-align: center; font-weight: bold;'><td colspan='24'>No record not found</td></tr>");
        }
      }

      });
  }

  if(val == "service_type"){
    route = "{{ URL('Ajax/ServicetypesReport') }}";
      $("tbody#report_servicetypes").html('');
      thisdata = {
        busID: $("#businessIdd").val(),
        service_type: $("#serviceTypesname").val(),
        date_from: $("#dates_from").val(),
        date_to: $("#dates_to").val(),
      }

      // Ajax Call
      setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          // Put Loader
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
          $(".spinner").addClass('disp-0');
          var res;
          var file;
          if(result.action == "service_type_report"){
            res = JSON.parse(result.data);
            $.each(res, function(v,k){
              if(file != null){
                $("tbody#report_servicetypes").append("<tr style='font-size: 12px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.manufacturer +"</td><td>"+ k.mileage +"</td><td>"+ k.service_type +"</td><td>"+ k.material_qty +"</td><td>"+ k.material_cost +"</td><td>"+ k.labour_qty +"</td><td>"+ k.labour_cost +"</td><td>"+ k.other_qty +"</td><td>"+ k.other_cost +"</td><td>"+ k.total_cost +"</td><td><a style='font-size: 11px;' href='/uploads/"+ k.file +"' target='_blank'>Open file</a></td></tr>");
              }else{
                $("tbody#report_servicetypes").append("<tr style='font-size: 12px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.manufacturer +"</td><td>"+ k.mileage +"</td><td>"+ k.service_type +"</td><td>"+ k.material_qty +"</td><td>"+ k.material_cost +"</td><td>"+ k.labour_qty +"</td><td>"+ k.labour_cost +"</td><td>"+ k.other_qty +"</td><td>"+ k.other_cost +"</td><td>"+ k.total_cost +"</td><td></td></tr>");
              }
            });
          }
        }
      });

  }


  if(val == "service_option"){
    route = "{{ URL('Ajax/ServiceOptionsReport') }}";
      $("tbody#report_serviceoptions").html('');
      thisdata = {
        busID: $("#businessIdz").val(),
        service_option: $("#serviceOptionname").val(),
        date_from: $("#datez_from").val(),
        date_to: $("#datez_to").val(),
      }

      // Ajax Call
      setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          // Put Loader
        },
        success: function(result){
          var res;
          var file;
          if(result.action == "service_type_report"){
            res = JSON.parse(result.data);
            $.each(res, function(v,k){
              if(file != null){
                $("tbody#report_serviceoptions").append("<tr style='font-size: 12px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.manufacturer +"</td><td>"+ k.mileage +"</td><td>"+ k.service_option +"</td><td>"+ k.material_qty +"</td><td>"+ k.material_cost +"</td><td>"+ k.labour_qty +"</td><td>"+ k.labour_cost +"</td><td>"+ k.other_qty +"</td><td>"+ k.other_cost +"</td><td>"+ k.total_cost +"</td><td><a style='font-size: 11px;' href='/uploads/"+ k.file +"' target='_blank'>Open file</a></td></tr>");
              }else{
                $("tbody#report_serviceoptions").append("<tr style='font-size: 12px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.manufacturer +"</td><td>"+ k.mileage +"</td><td>"+ k.service_option +"</td><td>"+ k.material_qty +"</td><td>"+ k.material_cost +"</td><td>"+ k.labour_qty +"</td><td>"+ k.labour_cost +"</td><td>"+ k.other_qty +"</td><td>"+ k.other_cost +"</td><td>"+ k.total_cost +"</td><td></td></tr>");
              }
            });
          }
          else if(result.data == ""){
            swal('...', result.res, 'info');
          }
        }
      });

  }

  // Revenue Report
  if(val == 'revenue'){
    $("tbody#revenueReports").html('');
    route = "{{ URL('Ajax/RevenueReport') }}";
    thisdata = {
      busID: $("#revenueID").val(),
      station_name: $("#revenue_nameReport").val(),
      date_from: $("#revdate_from").val(),
      date_to: $("#revdate_to").val(),
    }


        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          // Put Loader
          $(".spinnerRev").removeClass('disp-0');
          $("tbody.phpRevenue").addClass('disp-0');
          $("tbody.ajaxRevenue").removeClass('disp-0');
        },
        success: function(result){
            $(".spinnerRev").addClass('disp-0');

          var res;
          var file;
          if (result.message == "success") {
            res = JSON.parse(result.data);

            // console.log(res);
            var mat_qty = 0;
            var mat_cost = 0;
            var lab_qty = 0;
            var lab_cost = 0;

            if(result.action == "revenuereport"){
                $("tbody#revenueReports").html("<tr align='center'><td colspan='14'><a href='/Revenuereportexport/"+result.resp+"/"+result.dayfrom+"/"+result.dayto+"'>Click to Export Full Report</a></td></tr>");

              $.each(res, function(v,k){

                  mat_qty = parseInt(k.material_qty) + parseInt(k.material_qty2) + parseInt(k.material_qty3);
                  mat_cost = parseInt(k.material_cost) + parseInt(k.material_cost2) + parseInt(k.material_cost3);
                  lab_qty = parseInt(k.labour_qty) + parseInt(k.labour_qty2);
                  lab_cost = parseInt(k.labour_cost) + parseInt(k.labour_cost2);

                  $("tbody#revenueReports").append("<tr><td>"+(v+1)+"</td><td>"+ k.date +"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.service_type +"</td><td>"+ k.service_option +"</td><td>"+ k.manufacturer +"</td><td>"+ mat_qty +"</td><td>"+ mat_cost +"</td><td>"+ lab_qty +"</td><td>"+ lab_cost +"</td><td>"+ k.other_cost +"</td><td>"+ k.total_cost +"</td><td>"+ k.update_by +"</td></tr>");

              });

            }

        }
        else
        {
          $("tbody.phpRevenue").removeClass('disp-0');
          $("tbody.ajaxRevenue").addClass('disp-0');
            $(".spinnerRev").addClass('disp-0');

          swal('Oops', result.res, 'info');
        }
      }

      });

  }

}

function accessAction(id,val){
  $("tbody#tablez").html('');
  var route = "{{ URL('Ajax/Approval') }}";
  var spinner;
  var thisdata = {
    id: id,
    purpose: val
  }

  if(val == "Approve"){
    spinner = $('.spinner'+id).removeClass('disp-0');
  }
  if(val == "Decline"){
    spinner = $('.spinners'+id);
  }

  if(val == "personalDecline"){
    spinner = $('.spinners'+id);
  }

  if(val == "autostoreDecline"){
    spinner = $('.spinners'+id);
  }

  if(val == "autostorestaffDecline"){
    spinner = $('.spinners'+id);
  }

  if(val == "Approvepay"){
    spinner = $('.spinnerz'+id).removeClass('disp-0');
  }
// FOr Commercial Users
  if(val == "Approval"){
    spinner = $('.spinnerappr'+id).removeClass('disp-0');
  }

  if(val == "Decliner"){
    spinner = $('.spinnerdecl'+id);
  }

  if(val == "Payment"){
    $('#modal-CheckPayment').click();
  }

  if(val == "details"){
    $('#modal-CheckDetails').click();
  }


  if(val == "Decline" || val == "personalDecline" || val == "autostoreDecline" || val == "autostorestaffDecline" || val == "Decliner"){

            swal({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {

                        setHeaders();
                        jQuery.ajax({
                        url: route,
                        method: 'post',
                        data: thisdata,
                        dataType: 'JSON',
                        beforeSend: function(){
                            spinner.removeClass('disp-0');
                        },
                        success: function(result){
                            spinner.addClass('disp-0');
                            swal('Oops', result.res, result.message);
                        }

                    });

            } else {
                swal("Safe!");
            }
            });

  }
  else{
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinner;
          $("tbody#tablez").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
          $("tbody#tablezs").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
        },
        success: function(result){
            if (result.message == "success" && result.action == "approve") {
              $('.spinner').addClass('disp-0');
              swal('Ok', result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 1000);
            }
            else if(result.message == "success" && result.action == "paymentstatus"){
              var res = JSON.parse(result.data);
              var accounttypes = res[0].accountType;
              var typeofAcct;
              if(accounttypes == "Business"){
                typeofAcct = "Business - [Corporate]";
              }
              else if(accounttypes == "Auto Dealer"){
                typeofAcct = "Business - [Auto Dealer]";
              }
              else if(accounttypes == "Auto Care"){
                typeofAcct = "Auto Care";
              }

              else if(accounttypes == "Certified Professional"){
                typeofAcct = "Mobile Mechanics";
              }
              $("tbody#tablez").html("<tr><td>Name:</td><td></td><td colspan='4' align='center'>"+res[0].name+"</td></tr><tr><td>Company:</td><td></td><td colspan='4' align='center'>"+res[0].company+"</td></tr><tr><td>Account Type:</td><td></td><td colspan='4' align='center'>"+typeofAcct+"</td></tr><tr><td>Payment Status:</td><td></td><td colspan='4' align='center' style='font-weight: bold;'>"+res[0].payment_status+"</td></tr><tr><td>Email:</td><td></td><td colspan='4' align='center' style='font-weight: bold;'>"+res[0].email+"</td></tr><tr><td>Payment Date:</td><td></td><td colspan='4' align='center' style='font-weight: bold;'>"+res[0].date_from+"</td></tr>");
            }
            else if(result.message == "error" && result.action == "paymentstatus"){
              // $("tbody#tablez").html("<tr><td align='center'>"+result.res+"</td></tr>");
              var res = JSON.parse(result.data);
              var accounttypes = res[0].accountType;
              var typeofAcct;
              if(accounttypes == "Business"){
                typeofAcct = "Business - [Corporate]";
              }
              else if(accounttypes == "Auto Dealer"){
                typeofAcct = "Business - [Auto Dealer]";
              }
              else if(accounttypes == "Auto Care"){
                typeofAcct = "Auto Care";
              }

              else if(accounttypes == "Certified Professional"){
                typeofAcct = "Mobile Mechanics";
              }

              $("tbody#tablez").html("<tr><td>Name:</td><td></td><td colspan='4' align='center'>"+res[0].name+"</td></tr><tr><td>Company:</td><td></td><td colspan='4' align='center'>"+res[0].company+"</td></tr><tr><td>Account Type:</td><td></td><td colspan='4' align='center'>"+typeofAcct+"</td></tr><tr><td>Email:</td><td></td><td colspan='4' align='center' style='font-weight: bold; cursor: pointer;' onclick=messageClient('"+res[0].email+"')>"+res[0].email+"</td></tr><tr><td>Account Plan:</td><td></td><td colspan='4' align='center' style='font-weight: bold;'>"+res[0].plan+"</td></tr><tr><td>Payment Status:</td><td></td><td colspan='4' align='center' style='font-weight: bold;'>No Payment Made yet</td></tr><tr><td>Date of Registration:</td><td></td><td colspan='4' align='center' style='font-weight: bold;'>"+res[0].created_at+"</td></tr>");

            }
            else if(result.message == "success" && result.action == "details"){
              var res = JSON.parse(result.datas);
              var bankStatememt = res[0].bankstatement;
              var creditCard = res[0].creditcard;

              var amount;
              if(res[0].plan == "Free"){
                amount = res[0].free+' '+res[0].currency;
              }
              if(res[0].plan == "Lite"){
                amount = res[0].lite+' '+res[0].currency;
              }
              if(res[0].plan == "Commercial"){
                amount = res[0].litecommercial+' '+res[0].currency;
              }
              if(res[0].plan == "Start-Up"){
                amount = res[0].startup+' '+res[0].currency;
              }
              if(res[0].plan == "Basic"){
                amount = res[0].basic+' '+res[0].currency;
              }
              if(res[0].plan == "Classic"){
                amount = res[0].classic+' '+res[0].currency;
              }
              if(res[0].plan == "Super"){
                amount = res[0].super+' '+res[0].currency;
              }
              if(res[0].plan == "Gold"){
                amount = res[0].gold+' '+res[0].currency;
              }

              if(bankStatememt != null || creditCard != null){
                $("tbody#tablezs").html("<tr><td>Name:</td><td></td><td align='center' colspan='4'>"+res[0].name+"</td></tr><tr><td>Email:</td><td></td><td align='center' colspan='4'>"+res[0].email+"</td></tr><tr><td>Phone Number:</td><td></td><td align='center' colspan='4'>"+res[0].phone_number+"</td></tr><tr><td>City:</td><td></td><td align='center' colspan='4'>"+res[0].city+"</td></tr><tr><td>State:</td><td></td><td align='center' colspan='4'>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td align='center' colspan='4'>"+res[0].country+"</td></tr><tr><td>Bank Statement:</td><td></td><td align='center' colspan='4'><a href='/bankstatement/"+bankStatememt+"' download=''>Download</a></td></tr><tr><td>Credit Card:</td><td></td><td align='center' colspan='4'><a href='/creditcard/"+creditCard+"' download=''>Download</a></td></tr><tr><td>Payment Plan:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+res[0].plan+"</td></tr><tr><td>Subscription Plan:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+res[0].subscription_plan+"</td></tr><tr><td>Amount:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+amount+"</td></tr><tr><td>Payment Date:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+res[0].date_from+"</td></tr>");
              }else{
                $("tbody#tablezs").html("<tr><td>Name:</td><td></td><td align='center' colspan='4'>"+res[0].name+"</td></tr><tr><td>Email:</td><td></td><td align='center' colspan='4'>"+res[0].email+"</td></tr><tr><td>Phone Number:</td><td></td><td align='center' colspan='4'>"+res[0].phone_number+"</td></tr><tr><td>City:</td><td></td><td align='center' colspan='4'>"+res[0].city+"</td></tr><tr><td>State:</td><td></td><td align='center' colspan='4'>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td align='center' colspan='4'>"+res[0].country+"</td></tr><tr><td>Bank Statement:</td><td></td><td align='center' colspan='4'>No file yet</td></tr><tr><td>Credit Card:</td><td></td><td align='center' colspan='4'>No file yet</td></tr><tr><td>Payment Plan:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+res[0].plan+"</td></tr><tr><td>Subscription Plan:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+res[0].subscription_plan+"</td></tr><tr><td>Amount:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+amount+"</td></tr><tr><td>Payment Date:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>"+res[0].date_from+"</td></tr>");
              }

            }
            else if(result.message == "error" && result.action == "details"){
              var res = JSON.parse(result.datas);
              // $("tbody#tablezs").html("<tr><td align='center'>"+result.res+"</td></tr>");
              $("tbody#tablezs").html("<tr><td>Name:</td><td></td><td align='center' colspan='4'>"+res[0].name+"</td></tr><tr><td>Email:</td><td></td><td align='center' colspan='4'>"+res[0].email+"</td></tr><tr><td>Phone Number:</td><td></td><td align='center' colspan='4'>"+res[0].phone_number+"</td></tr><tr><td>City:</td><td></td><td align='center' colspan='4'>"+res[0].city+"</td></tr><tr><td>State:</td><td></td><td align='center' colspan='4'>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td align='center' colspan='4'>"+res[0].country+"</td></tr><tr><td>Bank Statement:</td><td></td><td align='center' colspan='4'>No file yet</td></tr><tr><td>Credit Card:</td><td></td><td align='center' colspan='4'>No file yet</td></tr><tr><td>Payment Plan:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>-</td></tr><tr><td>Subscription Plan:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>-</td></tr><tr><td>Amount:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>-</td></tr><tr><td>Payment Date:</td><td></td><td align='center' colspan='4' style='font-weight: bold;'>-</td></tr>");
            }
            else if(result.message == "info" && result.action == "approve"){
              $('.spinnerappr'+id).addClass('disp-0');
              swal('Oops', result.res, result.message);
            }
            else{
              swal('Oops', result.res, result.message);
            }


        }

      });
  }


}

function quickMail(val){

  if(val == "compose"){
    $("#modal-QuickMail").click();
  }

}

function messageClient(email){
  $('#quickEmail').val(email);
  $('#quickEmail').attr('readonly', true);
  $("#modal-QuickMail").click();
  $('.paystatsclose').click();
  $('#userdetailsclose').click();
  $('#estimatedetailsclose').click();
  $('#estimatepaymentdetailsclose').click();
}

function mailClient(email, val, post_id){
  $('#quickEmail').val('');
  $('#quickSubject').val('');
  $('#quickMessage').val('');

  var spinner;

  if(val == "ongoingjob"){
    spinner = $('.spinnerjob'+post_id);
  }

  var route = "{{ URL('Ajax/mailclient') }}";
  var thisdata = {email: email, val: val, post_id: post_id};

  setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
        spinner.removeClass('disp-0');
      },
      success: function(result){
          if (result.message == "success") {
            spinner.addClass('disp-0');
            swal('Good', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else{
            spinner.addClass('disp-0');
            swal('Oops', result.res, result.message);
          }


      }

    });

}

function senderMail(){
  var email = $("#quickEmail").val();
  var subject = $("#quickSubject").val();
  var message = $("#quickMessage").val();

  var route = "{{ URL('Ajax/QuickMail') }}";
  var thisdata = {email: email, subject: subject, message: message}

  if(email == "" || subject == "" || message == ""){
    swal('Not Allowed', 'Please fill all fields', 'error');
  }
  else{
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $('#sendEmail').text('Sending...');
        },
        success: function(result){
            if (result.message == "success") {
              $("#quickEmail").val('');
              $("#quickSubject").val('');
              $("#quickMessage").val('');
              $('#sendEmail').text('Sent');
              swal('Ok', result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else{
              swal('Oops', result.res, result.message);
            }


        }

      });
  }
}

// Initiate Payment
function makePay(email, amount, plan){
  var route = "{{ URL('Ajax/MakePay') }}";
  var thisdata;
  var spinner;
  // Plans for Business Owners

  if(plan == "Free"){
    thisdata = {
      email: email,
      amount: amount,
      userType: 'Individual',
      plan: plan
    }
    spinner = $(".spinnerfree");
  }
  if(plan == "Start-Up"){
    thisdata = {
      email: email,
      amount: amount,
      userType: 'Business',
      plan: plan
    }

    spinner = $(".spinnerstartup");
  }

  if(plan == "Basic"){
    thisdata = {
      email: email,
      amount: amount,
      userType: 'Business',
      plan: plan
    }

    spinner = $(".spinnerbasic");
  }
  if(plan == "Classic"){
    thisdata = {
      email: email,
      amount: amount,
      userType: 'Business',
      plan: plan
    }

    spinner = $(".spinnerclassic");
  }
  if(plan == "Super"){
    thisdata = {
      email: email,
      amount: amount,
      userType: 'Auto Care',
      plan: plan
    }

    spinner = $(".spinnersuper");
  }
  if(plan == "Gold"){
    thisdata = {
      email: email,
      amount: amount,
      userType: 'Auto Care',
      plan: plan
    }

    spinner = $(".spinnergold");
  }

  // Plan For Individual User
  if(plan == "Lite"){
    thisdata = {
      email: email,
      amount: amount,
      userType: 'Individual',
      plan: plan
    }

    spinner = $(".spinnerlite");
  }


  setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            // Pop up Modal
            $("#user_id").val("");
            $(".editPass").addClass('disp-0');
            spinner.addClass('disp-0');
            setTimeout(function(){ location.href = result.link; }, 3000);
          }
          else{
            swal('Oops', result.res, result.message);
          }


        }

      });
}

function doDowngrade(){
  $("#modal-Downgrade").click();
}


function senderDowngrade(val){
  var route = "{{ URL('Ajax/downgrade') }}";
  var thisdata = {busID: val, reason: $('#quickReason').val() };

  setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $('#sendDown').text('Sending...');
        },
        success: function(result){
          if(result.message == "success"){
            $('#quickReason').val('');
            $('#sendDown').text('Send');
            swal('Thanks', result.res, result.message);
          }
          else{
            swal('Oops', result.res, result.message);
          }


        }

      });
}

function showRev(){
  // Pop up with details
  $("#modal-RevenueAdd").click();
}

function setMin(){
  // Pop up with details
  $("#modal-setMin").click();
}

function setminCharges(){
  // Pop up with details
  $("#modal-setMinCharge").click();
}

function postRev(id, name, email){
  var route = "{{ URL('Ajax/postRevenue') }}";
  var thisdata = {name: name, email: email, avg: $('#avg_rev').val(), tot: $('#tot_rev').val() };
  var spinnerRev = $('.spinnerRev'+id);
  setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinnerRev.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            $('#avg_rev').val('');
            $('#tot_rev').val('')
            spinnerRev.addClass('disp-0');
            swal('Done', result.res, result.message);
          }
          else{
            swal('Oops', result.res, result.message);
          }

        }

      });
}




function viewProf(id, email, busID){
  $('#modal-ClientProfile').click();
  var route = "{{ URL('Ajax/getclientProfile') }}";
  var thisdata = {busID: busID, email: email};
  var spinnerRev = $('.spinnersClient'+id);
  setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinnerRev.removeClass('disp-0');
          $("tbody#clientTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
        },
        success: function(result){
          spinnerRev.addClass('disp-0');
          var res;
          var name;
          var telephone;
          var chassis_no;
          if(result.message == "success" && result.info == "full detail"){
            res = JSON.parse(result.data);
            name = JSON.parse(result.name);
            telephone = res[0].telephone;
            if(telephone == null){telephone = '-';}else{telephone = res[0].telephone;}
            chassis_no = res[0].chassis_no;
            if(chassis_no == null){chassis_no = '-';}else{chassis_no = res[0].chassis_no;}
            $("tbody#clientTable").html("<tr><td style='font-weight: 600;'>Name:</td><td></td><td align='center'>"+name+"</td></tr><tr><td style='font-weight: 600;'>Email:</td><td></td><td align='center'>"+res[0].email+"</td></tr><tr><td style='font-weight: 600;'>Telephone:</td><td></td><td align='center'>"+telephone+"</td></tr><tr><td style='font-weight: 600;'>Vehicle Licence:</td><td></td><td align='center'>"+res[0].vehicle_reg_no+"</td></tr><tr><td style='font-weight: 600;'>Vehicle Make:</td><td></td><td align='center'>"+res[0].make+"</td></tr><tr><td style='font-weight: 600;'>Vehicle Model:</td><td></td><td align='center'>"+res[0].model+"</td></tr><tr><td style='font-weight: 600;'>Chasis No:</td><td></td><td align='center'>"+chassis_no+"</td></tr><tr><td style='font-weight: 600;'>City:</td><td></td><td align='center'>"+res[0].city+"</td></tr><tr><td style='font-weight: 600;'>State:</td><td></td><td align='center'>"+res[0].state+"</td></tr><tr><td style='font-weight: 600;'>Country of Reg.:</td><td></td><td align='center'>"+res[0].country_of_reg+"</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Date:</td><td></td><td align='center'>"+res[0].date+"</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Service Option:</td><td></td><td align='center'>"+res[0].service_option+"</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Service Type:</td><td></td><td align='center'>"+res[0].service_type+"</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Total Cost:</td><td></td><td align='center'>"+res[0].total_cost+"</td></tr><tr><td style='font-weight: 600;'>Station Registered With:</td><td></td><td align='center'>"+res[0].update_by+"</td></tr>");
          }
          else if(result.message == "success" && result.info == "half detail"){
            name = JSON.parse(result.name2);
            res = JSON.parse(result.data2);
            telephone = res[0].telephone;
            if(telephone == null){telephone = '-';}else{telephone = res[0].telephone;}
            chassis_no = res[0].chassis_no;
            if(chassis_no == null){chassis_no = '-';}else{chassis_no = res[0].chassis_no;}
            $("tbody#clientTable").html("<tr><td style='font-weight: 600;'>Name:</td><td></td><td align='center'>"+name+"</td></tr><tr><td style='font-weight: 600;'>Email:</td><td></td><td align='center'>"+res[0].email+"</td></tr><tr><td style='font-weight: 600;'>Telephone:</td><td></td><td align='center'>"+telephone+"</td></tr><tr><td style='font-weight: 600;'>Vehicle Licence:</td><td></td><td align='center'>"+res[0].vehicle_reg_no+"</td></tr><tr><td style='font-weight: 600;'>Vehicle Make:</td><td></td><td align='center'>"+res[0].make+"</td></tr><tr><td style='font-weight: 600;'>Vehicle Model:</td><td></td><td align='center'>"+res[0].model+"</td></tr><tr><td style='font-weight: 600;'>Chasis No:</td><td></td><td align='center'>"+chassis_no+"</td></tr><tr><td style='font-weight: 600;'>City:</td><td></td><td align='center'>"+res[0].city+"</td></tr><tr><td style='font-weight: 600;'>State:</td><td></td><td align='center'>"+res[0].state+"</td></tr><tr><td style='font-weight: 600;'>Country of Reg.:</td><td></td><td align='center'>"+res[0].country_of_reg+"</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Date:</td><td></td><td align='center'>No record yet</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Service Option:</td><td></td><td align='center'>No record yet</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Service Type:</td><td></td><td align='center'>No record yet</td></tr><tr><td style='font-weight: 600;'>Last Maintenance Total Cost:</td><td></td><td align='center'>No record yet</td></tr><tr><td style='font-weight: 600;'>Station Registered With:</td><td></td><td align='center'>No record yet</td></tr>");
          }
          else{
            spinnerRev.addClass('disp-0');
            swal('Oops', result.res, result.message);
          }

        }

      });
}


function viewStaff(id, email, busID){
  $('#modal-ClientProfile').click();
  var route = "{{ URL('Ajax/getstaffprofile') }}";
  var thisdata = {busID: busID, email: email};
  var spinnerRev = $('.spinnersClient'+id);
  setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinnerRev.removeClass('disp-0');
          $("tbody#clientTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
        },
        success: function(result){
          spinnerRev.addClass('disp-0');
          var res;
          var name;
          var telephone;
          var chassis_no;
          if(result.message == "success" && result.info == "full detail"){
            res = JSON.parse(result.data);

            telephone = res[0].phone_number;
            if(telephone == null){telephone = '-';}else{telephone = res[0].phone_number;}
            
            $("tbody#clientTable").html("<tr><td style='font-weight: 600;'>Name:</td><td></td><td align='center'>"+res[0].name+"</td></tr><tr><td style='font-weight: 600;'>Email:</td><td></td><td align='center'>"+res[0].email+"</td></tr><tr><td style='font-weight: 600;'>Telephone:</td><td></td><td align='center'>"+telephone+"</td></tr><tr><td style='font-weight: 600;'>City:</td><td></td><td align='center'>"+res[0].city+"</td></tr><tr><td style='font-weight: 600;'>State:</td><td></td><td align='center'>"+res[0].state+"</td></tr><tr><td style='font-weight: 600;'>Country:</td><td></td><td align='center'>"+res[0].country+"</td></tr><tr><td style='font-weight: 600;'>Station name:</td><td></td><td align='center'>"+res[0].station_name+"</td></tr>");
          }
          else{
            spinnerRev.addClass('disp-0');
            swal('Oops', result.res, result.message);
          }

        }

      });
}

function quest(post_id, purpose){
  var route = "{{ URL('Ajax/ajaxQuestions') }}";
  var thisdata;
  if(purpose == 'viewquest'){
    thisdata = {
      post_id: post_id,
      purpose: purpose,
    }

        setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    success: function(result){
      if (result.message == "success" && result.purpose == "view") {
        setTimeout(function(){ location.href = location.origin+'/QuestAns/'+result.link; }, 1000);
      }


    }

    });
  }
  else if(purpose == 'delquest'){
        swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this detail!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        thisdata = {
            post_id: post_id,
            purpose: purpose,
          };
           setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "success" && result.purpose == "delete"){
              swal('Ok!',result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else if(result.message == "error" && result.purpose == "delete"){
              swal('Oops!',result.res, result.message);
            }
        }
      });
      } else {
        swal("Question is safe!");
      }
    });

  }

  else if(purpose == 'viewpost'){
    $('#modal-ViewAnswer').click();
            thisdata = {
            post_id: post_id,
            purpose: purpose,
          };
           setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $("tbody#answerTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
        },
        success: function(result){

          if(result.message == "success" && result.purpose == "viewpost"){
              var res = JSON.parse(result.data);

              $("tbody#answerTable").html("<tr><td colspan='5' style='width: 100%;'>"+res[0].answer+"</td></tr>");

            }
            else if(result.message == "error" && result.purpose == "viewpost"){
              swal('Oops!',result.res, result.message);
            }
        }
      });
  }

  else if(purpose == 'delpost'){
            swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this detail!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        thisdata = {
            post_id: post_id,
            purpose: purpose,
          };
           setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "success" && result.purpose == "deleted post"){
              swal('Ok!',result.res, result.message);
              setTimeout(function(){ location.href = location.origin+'/Question'; }, 1000);
            }
            else if(result.message == "error" && result.purpose == "deleted post"){
              swal('Oops!',result.res, result.message);
            }
        }
      });
      } else {
        swal("Question is safe!");
      }
    });
  }



}


function checkInfo(id, action, purpose){
  var route = "{{ URL('Ajax/checkInformations') }}";
  var thisdata = {id: id, action: action, purpose: purpose};
  var spinner;
  var res; var file;
  $("tbody#mmTable").html('');
  $("tbody#adTable").html('');

  if(purpose == "mechanic"){
    $('#modal-ViewMM').click();
    spinner = $("tbody#mmTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
  }
  else if(purpose == "dealer"){
    $('#modal-ViewAD').click();
    spinner = $("tbody#adTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
  }
  setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      spinner;
    },
    success: function(result){
        if (result.message == "success" && result.action == "mechanic") {
          // Get Mobile Mechanic result
          res = JSON.parse(result.data);

          if(file != "noImage.png" && res[0].trade_certificate != null){
            file = "<a href='/trade_cert/"+res[0].trade_certificate+"' target='_blank'>Open Document</a>";
          }
          else{
            file = "No Document";
          }
          $("tbody#mmTable").html("<tr><td>Name:</td><td></td><td>"+res[0].name+"</td></tr><tr><td>Email:</td><td></td><td>"+res[0].email+"</td></tr><tr><td>Telephone:</td><td></td><td>"+res[0].phone_number+"</td></tr><tr><td>City:</td><td></td><td>"+res[0].city+"</td></tr><tr><td>State:</td><td></td><td>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td>"+res[0].country+"</td></tr><tr><td>Zipcode:</td><td></td><td>"+res[0].zipcode+"</td></tr><tr><td>Subscription Plan:</td><td></td><td>"+res[0].plan+"</td></tr><tr><td>Size of Employee:</td><td></td><td>"+res[0].size_of_employee+"</td></tr><tr><td>Year of Practice:</td><td></td><td>"+res[0].year_of_practice+"</td></tr><tr><td>Specialization:</td><td></td><td>"+res[0].specialization+"</td></tr><tr><td>Trade Certificate:</td><td></td><td>"+file+"</td></tr>");
        }
        else if(result.message == "success" && result.action == "dealer"){
          // Get Auto Dealer results
          res = JSON.parse(result.data);
          if(file != "noImage.png" && res[0].file3 != null){
            file = "<a href='/dealer_licence/"+res[0].file3+"' target='_blank'>Open Document</a>";
          }
          else{
            file = "No Document";
          }

          $("tbody#adTable").html("<tr><td>Name:</td><td></td><td>"+res[0].name+"</td></tr><tr><td>Email:</td><td></td><td>"+res[0].email+"</td></tr><tr><td>Telephone:</td><td></td><td>"+res[0].telephone+"</td></tr><tr><td>City:</td><td></td><td>"+res[0].city+"</td></tr><tr><td>State:</td><td></td><td>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td>"+res[0].country+"</td></tr><tr><td>Zipcode:</td><td></td><td>"+res[0].zipcode+"</td></tr><tr><td>Subscription Plan:</td><td></td><td>"+res[0].plan+"</td></tr><tr><td>Company Name:</td><td></td><td>"+res[0].name_of_company+"</td></tr><tr><td>Company Address:</td><td></td><td>"+res[0].address+"</td></tr><tr><td>Position:</td><td></td><td>"+res[0].position+"</td></tr><tr><td>Specialty:</td><td></td><td>"+res[0].specialty+"</td></tr><tr><td>Dealer Certificate:</td><td></td><td>"+file+"</td></tr>");
        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });
}

function accountAction(id, action, purpose){
  var route = "{{ URL('Ajax/accountAction') }}";
  var thisdata = {id: id, action: action, purpose: purpose};
  var spinner;
  if(purpose == "mechanic"){
    spinner = $('.spinnermm');
  }
  else if(purpose == "dealer"){
    spinner = $('.spinnerad');
  }

    setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      spinner.removeClass('disp-0');
    },
    success: function(result){
        if (result.message == "success" && result.action == "mechanic") {
          spinner.addClass('disp-0');
          swal('Good', result.res, result.message);
          setTimeout(function(){ location.href = result.link; }, 2000);
        }
        else if(result.message == "success" && result.action == "dealer"){
          spinner.addClass('disp-0');
          swal('Good', result.res, result.message);
          setTimeout(function(){ location.href = result.link; }, 2000);
        }
        else{
          spinner.addClass('disp-0');
          swal('Oops', result.res, result.message);
        }


    }

  });

}

function ticketInfo(ticketID){
  var route = "{{ URL('Ajax/ticketInformation') }}";
  var thisdata = {ticketID: ticketID};
  var res; var mainPriority; var priority; var file; var attach;

  $('#modal-ViewTicket').click();

  setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      $("tbody#ticketTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
    },
    success: function(result){
        if (result.message == "success") {
          // Pop up result
          res = JSON.parse(result.data);

          priority = res[0].ticketPriority;
          file = res[0].ticketAttachment;

          if(priority == "High"){
            mainPriority = "<td style='color:red; font-weight: bold;'>HIGH</td>";
          }
          else if(priority == "Medium"){
            mainPriority = "<td style='color:darkorange; font-weight: bold;'>MEDIUM</td>";
          }
          else if(priority == "Low"){
            mainPriority = "<td style='color:green; font-weight: bold;'>LOW</td>";
          }
          else if(priority == "" || priority == null){
            mainPriority = "<td style='color:black; font-weight: bold;'>-</td>";
          }

          if(file != null || file != "noImage.png"){
            attach = "<a href='/ticketing_file/"+file+"'>Open Attachment</a>";
          }
          else{
            attach = "No Document"
          }

          $("tbody#ticketTable").html("<tr><td>Ticket ID:</td><td></td><td style='font-weight: bold;'>"+res[0].ticketID+"</td></tr><tr><td>Ticket Subject:</td><td></td><td style='font-weight: bold;'>"+res[0].ticketSubject+"</td></tr><tr><td>Ticket Message:</td><td></td><td style='text-align: justify;'>"+res[0].ticketMessage+"</td></tr><tr><td>Ticket Department:</td><td></td><td>"+res[0].ticketDepartment+"</td></tr><tr><td>Ticket Priority:</td><td></td>"+mainPriority+"</tr><tr><td>Client Name:</td><td></td><td>"+res[0].ticketName+"</td></tr><tr><td>Client Email:</td><td></td><td>"+res[0].ticketEmail+"</td></tr><tr><td>Ticket Attachment:</td><td></td><td>"+attach+"</td></tr>");

          $('#foot_table').html("<button title='Reply' class='btn btn-primary' onclick=ticketAction('"+res[0].ticketID+"','Reply')>Reply <i title='Reply' class='fa fa-reply'></i></button><button title='Delete' class='btn btn-danger' onclick=ticketAction('"+res[0].ticketID+"','Delete')>Delete <i title='Delete' class='fa fa-trash'></i></button>");
        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });

}

function ticketAction(id, val){
  var route = "{{ URL('Ajax/ticketActions') }}";
  var thisdata = {ticketID: id, action: val};
  var res;

  if(val == "Delete"){
        swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this detail!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        thisdata = {
            ticketID: id,
            action: val,
          };
           setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "success" && result.action == "Delete"){
              swal('Good!',result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 2000);
            }
        }
      });
      } else {
        swal("This ticket is safe");
      }
    });
  }
  else if(val == "ReplyPoint"){
    route = "{{ URL('Ajax/contactRedeem') }}";
    thisdata = {ref_code: id, action: val};
    var spinner = $('.spinnerredeemapprcont'+id);
      setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
        spinner.removeClass('disp-0');
      },
      success: function(result){
          if (result.message == "success" && result.action == "ReplyPoint") {
            spinner.addClass('disp-0');
            // Pop up mail modal
            res = JSON.parse(result.data);

            $('#quickEmail').val(res[0].email);
            $('#quickEmail').attr('readonly', true);
            $("#modal-QuickMail").click();
            $("#ticketclose").click();

          }
          else{
            spinner.addClass('disp-0');
            swal('Oops', result.res, result.message);
          }


      }

    });
  }
  else{
    setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    success: function(result){
        if (result.message == "success" && result.action == "Reply") {
          // Pop up mail modal
          res = JSON.parse(result.data);

          $('#quickEmail').val(res[0].ticketEmail);
          $('#quickSubject').val('RE: '+res[0].ticketSubject);
          $('#quickEmail').attr('readonly', true);
          $('#quickSubject').attr('readonly', true);
          $("#modal-QuickMail").click();
          $("#ticketclose").click();

        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });
  }



}

function acceptPoint(ref_code, action){
  var route = "{{ URL('Ajax/acceptPoints') }}";
  var thisdata = {ref_code: ref_code, action: action};
  var spinner = $('.spinnerredeemappr');
      setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
            if (result.message == "success" && result.action == "Approval") {
              spinner.addClass('disp-0');
              setTimeout(function(){ location.href = result.link; }, 1000);
            }
            else{
              spinner.addClass('disp-0');
              swal('Oops', result.res, result.message);
            }


        }

      });
}

function getuserdetails(id){
  var route = "{{ URL('Ajax/userfulldetails') }}";
  var thisdata = {id:id};

  var others;
  var status;

  $('#modal-ViewUserdetails').click();
  $("tbody#userdetailsTable").html('');
  $('.persClose').click();

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $("tbody#userdetailsTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
        },
        success: function(result){
            if (result.message == "success") {
              // Pop Up Detaiils
              var res = JSON.parse(result.data);

              if(res[0].userType == "Business" || res[0].userType == "Auto Dealer" || res[0].userType == "Certified Professional" || res[0].userType == "Auto Dealer" || res[0].userType == "Commercial" || res[0].userType == "Technician"){

                others = "<tr><td>Station Name:</td><td></td><td>"+res[0].station_name+"</td></tr>";
              }
              else{
                others = "";
              }

              if(res[0].status == 2){
                status = "<td style='color: red; font-weight: bold;'>DEACTIVATED</td>";
              }
              else if(res[0].status == 1){
                status = "<td style='color: green; font-weight: bold;'>ACTIVE</td>";
              }
              else{
                status = "<td style='color: darkorange; font-weight: bold;'>NOT VALID</td>";
              }

              $("tbody#userdetailsTable").html("<tr><td>Fullname:</td><td></td><td>"+res[0].name+"</td></tr><tr><td>Email:</td><td></td><td style='font-weight: bold; color: navy; cursor: pointer' onclick=messageClient('"+res[0].email+"')>"+res[0].email+"</td></tr><tr><td>Account Type:</td><td></td><td style='font-weight: bold;'>"+res[0].userType+"</td></tr><tr><td>Phone Number:</td><td></td><td>"+res[0].phone_number+"</td></tr><tr><td>City:</td><td></td><td>"+res[0].city+"</td></tr><tr><td>State/Province:</td><td></td><td>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td>"+res[0].country+"</td></tr><tr><td>Zip Code:</td><td></td><td>"+res[0].zipcode+"</td></tr>"+others+"<tr><td>Mother Maidens Name:</td><td></td><td>"+res[0].maiden_name+"</td></tr><tr><td>Where Parents Meet:</td><td></td><td>"+res[0].parent_meet+"</td></tr><tr><td>Account Plan:</td><td></td><td>"+res[0].plan+"</td></tr><tr><td>Current Status:</td><td></td>"+status+"</tr>");

          // $('#user_foot_table').html("<button title='Reply' class='btn btn-primary' onclick=ticketAction('"+res[0].ticketID+"','Reply')>Reply <i title='Reply' class='fa fa-reply'></i></button><button title='Delete' class='btn btn-danger' onclick=ticketAction('"+res[0].ticketID+"','Delete')>Delete <i title='Delete' class='fa fa-trash'></i></button>");
            }


        }

      });

}


function getautocaredetails(email, val){
  var route = "{{ URL('Ajax/userautofulldetails') }}";
  var thisdata = {email:email, val: val};
  var others;
  var status;

  $('#modal-ViewUserdetails').click();
  $("tbody#userdetailsTable").html('');
  $('.persClose').click();

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $("tbody#userdetailsTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
        },
        success: function(result){
            if (result.message == "success") {
              // Pop Up Detaiils
              var res = JSON.parse(result.data);

              if(result.action == "autoStaffs"){

                others = "<tr><td>Station Name:</td><td></td><td>"+res[0].station_name+"</td></tr>";

                  if(res[0].status == 2){
                    status = "<td style='color: red; font-weight: bold;'>DEACTIVATED</td>";
                  }
                  else if(res[0].status == 1){
                    status = "<td style='color: green; font-weight: bold;'>ACTIVE</td>";
                  }
                  else{
                    status = "<td style='color: darkorange; font-weight: bold;'>NOT VALID</td>";
                  }

                  $("tbody#userdetailsTable").html("<tr><td>Fullname:</td><td></td><td>"+res[0].name+"</td></tr><tr><td>Email:</td><td></td><td style='font-weight: bold; color: navy; cursor: pointer' onclick=messageClient('"+res[0].email+"')>"+res[0].email+"</td></tr><tr><td>Account Type:</td><td></td><td style='font-weight: bold;'>"+res[0].userType+"</td></tr><tr><td>Phone Number:</td><td></td><td>"+res[0].phone_number+"</td></tr><tr><td>City:</td><td></td><td>"+res[0].city+"</td></tr><tr><td>State/Province:</td><td></td><td>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td>"+res[0].country+"</td></tr><tr><td>Zip Code:</td><td></td><td>"+res[0].zipcode+"</td></tr>"+others+"<tr><td>Mother Maidens Name:</td><td></td><td>"+res[0].maiden_name+"</td></tr><tr><td>Where Parents Meet:</td><td></td><td>"+res[0].parent_meet+"</td></tr><tr><td>Account Plan:</td><td></td><td>"+res[0].plan+"</td></tr><tr><td>Current Status:</td><td></td>"+status+"</tr>");

              }
              else if(result.action == "autoStores"){
                others = "<tr><td>Station Name:</td><td></td><td>"+res[0].name_of_company+"</td></tr>";

                if(result.status == 2){
                    status = "<td style='color: red; font-weight: bold;'>DEACTIVATED</td>";
                  }
                  else if(result.status == 1){
                    status = "<td style='color: green; font-weight: bold;'>ACTIVE</td>";
                  }
                  else{
                    status = "<td style='color: darkorange; font-weight: bold;'>NOT VALID</td>";
                  }

                $("tbody#userdetailsTable").html("<tr><td>Name:</td><td></td><td>"+res[0].name+"</td></tr><tr><td>Position:</td><td></td><td style='font-weight: bold;'>"+res[0].position+"</td></tr><tr><td>Email:</td><td></td><td style='font-weight: bold; color: navy; cursor: pointer' onclick=messageClient('"+res[0].email+"')>"+res[0].email+"</td></tr><tr><td>Account Type:</td><td></td><td style='font-weight: bold;'>"+res[0].accountType+"</td></tr><tr><td>Phone Number:</td><td></td><td>"+res[0].telephone+"</td></tr><tr><td>City:</td><td></td><td>"+res[0].city+"</td></tr><tr><td>State/Province:</td><td></td><td>"+res[0].state+"</td></tr><tr><td>Country:</td><td></td><td>"+res[0].country+"</td></tr><tr><td>Zip Code:</td><td></td><td>"+res[0].zipcode+"</td></tr><tr><td>Zip Code:</td><td></td><td>"+res[0].zipcode+"</td></tr>"+others+"<tr><td>Mother Maidens Name:</td><td></td><td>"+res[0].maiden_name+"</td></tr><tr><td>Where Parents Meet:</td><td></td><td>"+res[0].parent_meet+"</td></tr><tr><td>Account Plan:</td><td></td><td>"+res[0].plan+"</td></tr><tr><td>Current Status:</td><td></td>"+status+"</tr>");

              }





            }


        }

      });

}

function logout(val){
   var route = "{{ URL('Ajax/AdminLogout') }}";
   var thisdata = {
      username: val,
    }
          setHeaders();
       jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
            if (result.message == "success") {
            setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 1000);
            }


        }

      });
}


function estimatedetails(post_id, estimate_id, action){
  var route;
  var thisdata;
  var spinner;

  if(action == "more"){
    $('#modal-ViewEstimatedetails').click();
    $("tbody#estimatedetailsTable").html('');
    route = "{{ URL('Ajax/getdetailEstimate') }}";
    thisdata = {post_id: post_id, estimate_id: estimate_id, action: action};
    spinner = $("tbody#estimatedetailsTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");


  }


    setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function (){
        spinner;
      },
      success: function(result){
          if (result.message == "success" && result.action == "more") {
            // Pop Up details
            var res = JSON.parse(result.data);
            $("tbody#estimatedetailsTable").html("<tr><td>Client Email:</td><td></td><td style='font-weight: bold; color: navy; cursor: pointer' onclick=messageClient('"+res[0].email+"')>"+res[0].email+"</td></tr><tr><td>Client Telephone:</td><td></td><td>"+res[0].telephone+"</td></tr><tr><td>Vehicle Licence:</td><td></td><td>"+res[0].vehicle_licence+"</td></tr><tr><td>Mileage:</td><td></td><td>"+res[0].mileage+"</td></tr><tr><td>Repair Date:</td><td></td><td>"+res[0].date+"</td></tr><tr><td>Service Type:</td><td></td><td>"+res[0].service_type+"</td></tr><tr><td>Vehicle Make & Model:</td><td></td><td>"+res[0].make+' - '+res[0].model+"</td></tr><tr><td>Service Option:</td><td></td><td>"+res[0].service_option+"</td></tr><tr><td>Material Qty 1:</td><td></td><td>"+res[0].material_qty+"</td></tr><tr><td>Material Qty 2:</td><td></td><td>"+res[0].material_qty2+"</td></tr><tr><td>Material Qty 3:</td><td></td><td>"+res[0].material_qty3+"</td></tr><tr><td>Material Qty 4:</td><td></td><td>"+res[0].material_qty4+"</td></tr><tr><td>Material Qty 5:</td><td></td><td>"+res[0].material_qty5+"</td></tr><tr><td>Material Qty 6:</td><td></td><td>"+res[0].material_qty6+"</td></tr><tr><td>Material Qty 7:</td><td></td><td>"+res[0].material_qty7+"</td></tr><tr><td>Material Qty 8:</td><td></td><td>"+res[0].material_qty8+"</td></tr><tr><td>Material Qty 9:</td><td></td><td>"+res[0].material_qty9+"</td></tr><tr><td>Material Qty 10:</td><td></td><td>"+res[0].material_qty10+"</td></tr><tr><td>Material Cost 1:</td><td></td><td>"+res[0].material_cost+"</td></tr><tr><td>Material Cost 2:</td><td></td><td>"+res[0].material_cost2+"</td></tr><tr><td>Material Cost 3:</td><td></td><td>"+res[0].material_cost3+"</td></tr><tr><td>Material Cost 4:</td><td></td><td>"+res[0].material_cost4+"</td></tr><tr><td>Material Cost 5:</td><td></td><td>"+res[0].material_cost5+"</td></tr><tr><td>Material Cost 6:</td><td></td><td>"+res[0].material_cost6+"</td></tr><tr><td>Material Cost 7:</td><td></td><td>"+res[0].material_cost7+"</td></tr><tr><td>Material Cost 8:</td><td></td><td>"+res[0].material_cost8+"</td></tr><tr><td>Material Cost 9:</td><td></td><td>"+res[0].material_cost9+"</td></tr><tr><td>Material Cost 10:</td><td></td><td>"+res[0].material_cost10+"</td></tr><tr><td>Labour Qty 1:</td><td></td><td>"+res[0].labour_qty+"</td></tr><tr><td>Labour Qty 2:</td><td></td><td>"+res[0].labour_qty2+"</td></tr><tr><td>Labour Qty 3:</td><td></td><td>"+res[0].labour_qty3+"</td></tr><tr><td>Labour Qty 4:</td><td></td><td>"+res[0].labour_qty4+"</td></tr><tr><td>Labour Qty 5:</td><td></td><td>"+res[0].labour_qty5+"</td></tr><tr><td>Labour Qty 6:</td><td></td><td>"+res[0].labour_qty6+"</td></tr><tr><td>Labour Qty 7:</td><td></td><td>"+res[0].labour_qty7+"</td></tr><tr><td>Labour Qty 8:</td><td></td><td>"+res[0].labour_qty8+"</td></tr><tr><td>Labour Qty 9:</td><td></td><td>"+res[0].labour_qty9+"</td></tr><tr><td>Labour Qty 10:</td><td></td><td>"+res[0].labour_qty10+"</td></tr><tr><td>Labour Cost 1:</td><td></td><td>"+res[0].labour_cost+"</td></tr><tr><td>Labour Cost 2:</td><td></td><td>"+res[0].labour_cost2+"</td></tr><tr><td>Labour Cost 3:</td><td></td><td>"+res[0].labour_cost3+"</td></tr><tr><td>Labour Cost 4:</td><td></td><td>"+res[0].labour_cost4+"</td></tr><tr><td>Labour Cost 5:</td><td></td><td>"+res[0].labour_cost5+"</td></tr><tr><td>Labour Cost 6:</td><td></td><td>"+res[0].labour_cost6+"</td></tr><tr><td>Labour Cost 7:</td><td></td><td>"+res[0].labour_cost7+"</td></tr><tr><td>Labour Cost 8:</td><td></td><td>"+res[0].labour_cost8+"</td></tr><tr><td>Labour Cost 9:</td><td></td><td>"+res[0].labour_cost9+"</td></tr><tr><td>Labour Cost 10:</td><td></td><td>"+res[0].labour_cost10+"</td></tr><tr><td>Other Cost:</td><td></td><td>"+res[0].other_cost+"</td></tr><tr><td>Total Cost:</td><td></td><td>"+res[0].total_cost+"</td></tr><tr><td>Service Note:</td><td></td><td>"+res[0].service_note+"</td></tr>");
          }


      }

    });

}

function estimatepaydetails(estimate_id, action){
  var route = "{{ URL('Ajax/estimatePaydetails') }}";
  var thisdata = {estimate_id: estimate_id, action: action};
  var spinner;

  if(action == "paydetails"){
    $('#modal-ViewEstimatepaymentdetails').click();
    $("tbody#estimatepaymentdetailsTable").html('');
    $("#estimatepayment_foot_table").html('');
    spinner = $("tbody#estimatepaymentdetailsTable").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
  }

  setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      spinner;
    },
    success: function(result){
      if (result.message == "success" && result.action == "paydetails") {

        // Pop up details
        var currency;
        var state;
        var res = JSON.parse(result.data);

        if(res[0].currency == null || res[0].currency == "null" || res[0].currency == ""){
          currency = "CAD/USD";
        }
        else{
          currency = res[0].currency;

        }

        // console.log(res[0].status);

        if(res[0].status == 0){
          state = "<button title='Activate Project for "+res[0].station+"' class='btn btn-danger' onclick=activateProject('"+res[0].estimate_id+"','"+res[0].post_id+"','activate')>Acknowledge Payment <i title='activate' class='fa fa-envelope'></i><img class='spinPay disp-0' src='../img/loader/loader.gif' style='width: 50px; height: auto;'></button>";
        }
        else{
          state = "<button title='Activate Project for "+res[0].station+"' class='btn btn-danger disp-0' onclick=activateProject('"+res[0].estimate_id+"','"+res[0].post_id+"','activate')>Acknowledge Payment <i title='activate' class='fa fa-envelope'></i><img class='spinPay disp-0' src='../img/loader/loader.gif' style='width: 50px; height: auto;'></button>"
        }


            $("tbody#estimatepaymentdetailsTable").html("<tr><td>Transaction ID:</td><td></td><td>"+res[0].transactionid+"</td></tr><tr><td>Client Name:</td><td></td><td style='color: navy;'>"+res[0].name+"</td></tr><tr><td>Client Email:</td><td></td><td style='font-weight: bold; color: navy; cursor: pointer' onclick=messageClient('"+res[0].email+"')>"+res[0].email+"</td></tr><tr><td>Amount Paid:</td><td></td><td>"+currency+" "+res[0].amount+"</td></tr><tr><td>Payment made for:</td><td></td><td>Maintenance Estimate</td></tr><tr><td>Job Assigned to:</td><td></td><td>"+res[0].station+"</td></tr><tr><td>Payment Gateway:</td><td></td><td>"+res[0].gateway+"</td></tr><tr><td>Payment Date:</td><td></td><td>"+res[0].created_at+"</td></tr>");

            $('#estimatepayment_foot_table').html(state);

      }
    }

  });

}

function activatejobdone(post_id, id){
  var spinner = $('.spinneractivatejob'+id);
  var route = "{{ URL('Ajax/activateJobdone') }}";
  var thisdata = {post_id: post_id};

  setHeaders();
       jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
            if (result.message == "success" && result.action == "activate") {
              spinner.addClass('disp-0');
              swal('Good job!', result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else{
              spinner.addClass('disp-0');
              swal('Oops!', result.res, result.message);
            }

        }

      });

}

function activateProject(estimate_id, post_id, action){
  var route = "{{ URL('Ajax/estimatePaydetails') }}";
  var thisdata = {estimate_id: estimate_id, action: action, post_id: post_id};
  var spinner = $('.spinPay');

      setHeaders();
       jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
            if (result.message == "success" && result.action == "activate") {
              spinner.addClass('disp-0');
              swal('Good job!', result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else{
              spinner.addClass('disp-0');
              swal('Oops!', result.res, result.message);
            }

        }

      });

}

function showNewshappening(){
  $('#news').click();
}

function allPostaction(id, val){
var route = "{{ URL('Ajax/allpostaction') }}";
    var thisdata = {id: id, val: val};
    if(val == "delete_news"){
    swal({
          title: "Are you sure you want to delete this?",
          text: "If yes, click OK to delete",
          icon: "error",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

                    setHeaders();
                        jQuery.ajax({
                        url: route,
                        method: 'post',
                        data: thisdata,
                        dataType: 'JSON',
                        success: function(result){

                            if(result.state == 'success' && result.action == 'delete_news'){
                                swal(result.title, result.message , result.state);
                                setTimeout(function(){ location.href = result.link; }, 2000);
                            }
                            else{
                                swal(result.title, result.message, result.state);
                            }


                        }

                    });
          }
        });
    }
    else{
        $("tbody#newspostresult").html('');
        $("tbody#newspostactivation").html('');

            setHeaders();
                jQuery.ajax({
                url: route,
                method: 'post',
                data: thisdata,
                dataType: 'JSON',
                beforeSend: function() {
                    if(val == "view_news"){
                        $('#view_newsPost').click();
                        $("tbody#newspostresult").html("<tr><td align='center'><img style='width: 100px; height: auto; position:relative; margin: 0 auto;' src='https://icon-library.net/images/spinner-icon-gif/spinner-icon-gif-28.jpg' /></td></tr>");
                    }
                },
                success: function(result){
                var res = JSON.parse(result.data);
                    if(result.state == 'success' && result.action == 'view_news'){
                        // Pop up Modal for details
                        var status;
                        var file_upload;
                        var file;
                        status = res[0].state;
                        file_upload = res[0].file_upload;
                        if(status == 1){
                            $('#newspostactivation').html("<button class='btn btn-danger btn-sm hec-button bg-red' style='width: 100%;' onclick=processpostView("+res[0].id+"\,'newsposts')>DEACTIVATE POST<img class='animated fadeIn spin mynewspost_btn disp-0' src='../img/loader/loader.gif' style='width: 30px; height: 30px;'></button>");
                        }
                        else if(status == 0){
                            $('#newspostactivation').html("<button class='btn btn-secondary btn-sm hec-button bg-black' style='width: 100%;' onclick=processpostView("+res[0].id+"\,'newsposts')>ACTIVATE POST<img class='animated fadeIn spin mynewspost_btn disp-0' src='../img/loader/loader.gif' style='width: 30px; height: 30px;'></button>");
                        }

                        if(file_upload != "" || file_upload != null){
                            file = "<a style='color:navy; font-weight:bold;' target='_blank' href='../newsfile/"+file_upload+"'>Open file</a>";
                        }
                        else{
                            file = "No file attached";
                        }


                        $('#newspostresult').html("<tr><td>Subject:</td><td></td><td style='font-weight: bold; text-transform:uppercase'>"+res[0].subject+"</td></tr><tr><td>Description:</td><td></td><td style='text-align: justify;'>"+res[0].description+"</td></tr><tr><td>File Upload:</td><td></td><td style='text-align:justify; color:navy; font-weight: bold;'>"+file+"</td></tr>");

                    }
                    else if(result.state == 'success' && result.action == 'edit_news'){
                        // Pop up Modal for edit
                        $('#newsPostid').val(res[0].post_id);
                        $('#newsSubject').val(res[0].subject);
                        $('#newsDesc').code(res[0].description);
                        $('.savenews').addClass('disp-0');
                        $('.updtnews').removeClass('disp-0');
                        $('#news').click();

                    }
                    else{
                        swal(result.title, result.message, result.state);
                    }

                }

            });
    }
}

function newsHapening(post_id){
    var subject = $('#newsSubject').val();
    var description = $('#newsDesc').code();
    var route = "{{ URL('Ajax/newsandhappenings') }}";
    var formData = new FormData();
    var fileSelect; var file; var actionPost;
    var spinner= $('.newsSpins');

    if(subject == ""){
        $('.error').html('Please provide subject for post').removeClass('disp-0').fadeIn().delay(3000).fadeOut();
        return false;
    }
    else if(description == ""){
        $('.error').html('Please provide description for post').removeClass('disp-0').fadeIn().delay(3000).fadeOut();
        return false;
    }
    else{

        if($('.newsAction').is(':checked') == true){
            $('.newsAction').attr('value', '1');
            actionPost = $('.newsAction').val();

            swal('Ok', 'This post will be active when uploaded', 'info');
            }
            else{
                $('.newsAction').attr('value', '0');
                actionPost = $('.newsAction').val();

                swal('Ok', 'This post will not be active when uploaded' , 'warning');

            }

            fileSelect = document.getElementById("newsUpload");

            if(fileSelect.files && fileSelect.files.length == 1){
                file = fileSelect.files[0]
                formData.set("newsUpload", file , file.name);
            }

            formData.append("post_id", post_id);
            formData.append("description", description);
            formData.append("subject", subject);
            formData.append("state", actionPost);

          setHeaders();
          jQuery.ajax({
          url: route,
            method: 'post',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            beforeSend: function(){
              spinner.removeClass('disp-0');
            },
          success: function(result){

            if(result.state == 'success'){
                spinner.addClass('disp-0');
                $('.close').click();
                swal(result.title, result.message, result.state);
                setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else{
                spinner.addClass('disp-0');
                swal(result.title, result.message, result.state);
            }

        }

      });


    }
}

function newshapeningUpdt(){
    var post_id = $('#newsPostid').val();
    var subject = $('#newsSubject').val();
    var description = $('#newsDesc').code();
    var route = "{{ URL('Ajax/newshappeningupdates') }}";
    var formData = new FormData();
    var fileSelect; var file; var actionPost;
    var spinner= $('.newsSpins');

    if(subject == ""){
        $('.error').html('Please provide subject for post').removeClass('disp-0').fadeIn().delay(3000).fadeOut();
        return false;
    }
    else if(description == ""){
        $('.error').html('Please provide description for post').removeClass('disp-0').fadeIn().delay(3000).fadeOut();
        return false;
    }
    else{

        if($('.newsAction').is(':checked') == true){
            $('.newsAction').attr('value', '1');
            actionPost = $('.newsAction').val();

            swal('Ok', 'This post will be active when uploaded', 'info');
            }
            else{
                $('.newsAction').attr('value', '0');
                actionPost = $('.newsAction').val();

                swal('Ok', 'This post will not be active when uploaded' , 'warning');

            }

            fileSelect = document.getElementById("newsUpload");

            if(fileSelect.files && fileSelect.files.length == 1){
                file = fileSelect.files[0]
                formData.set("newsUpload", file , file.name);
            }

            formData.append("post_id", post_id);
            formData.append("description", description);
            formData.append("subject", subject);
            formData.append("state", actionPost);

          setHeaders();
          jQuery.ajax({
          url: route,
            method: 'post',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            beforeSend: function(){
              spinner.removeClass('disp-0');
            },
          success: function(result){

            if(result.state == 'success'){
                spinner.addClass('disp-0');
                $('.close').click();
                swal(result.title, result.message, result.state);
                setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else{
                spinner.addClass('disp-0');
                swal(result.title, result.message, result.state);
            }

        }

      });


    }
}

function processpostView(id, val){
    var route = "{{ URL('Ajax/updateUploadaction') }}";
    var thisdata = {id: id, val: val};
    var spinner = $('.mynewspost_btn');

    if(val == "newsposts"){

                setHeaders();
                jQuery.ajax({
                url: route,
                    method: 'post',
                    data: thisdata,
                    dataType: 'JSON',
                    beforeSend: function(){
                        spinner.removeClass('disp-0');
                    },
                    success: function(result){
                    if(result.state == 'success' && result.action == "newsposts"){
                        spinner.addClass('disp-0');
                        $('.close').click();
                        swal(result.title, result.message , result.state);
                        setTimeout(function(){ location.href = result.link; }, 2000);
                    }
                    else{
                        spinner.addClass('disp-0');
                        $('.error').html(result.message).removeClass('disp-0').fadeIn().delay(3000).fadeOut();
                        swal(result.title, result.message , result.state);
                    }


                }

            });
    }
}

function discount(){
  var route = "{{ URL('Ajax/setDiscount') }}";
  if($('#set_discount').val() == ""){
    swal('Oops!', 'Set discount percent', 'warning');
    return false;
  }
  else if($('#set_servicecharge').val() == ""){
    swal('Oops!', 'Set service charge', 'warning');
    return false;
  }
  else{
      var thisdata = {discount: $('#discount').val(), percent: $('#set_discount').val(), service: $('#service').val(), service_percent: $('#set_servicecharge').val()};
  var spinner = $('.discountSpin');

    setHeaders();
    jQuery.ajax({
    url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            spinner.removeClass('disp-0');
        },
        success: function(result){
        if(result.state == 'success'){
            spinner.addClass('disp-0');
            $('.close').click();
            swal(result.title, result.message , result.state);
            setTimeout(function(){ location.href = result.link; }, 2000);
        }
        else{
            spinner.addClass('disp-0');
            swal(result.title, result.message , result.state);
        }


    }

  });
  }




}

function discountCharges(){
  var route = "{{ URL('Ajax/setDiscountCharges') }}";
  if($('#set_discountcharge').val() == ""){
    swal('Oops!', 'Set discount charge percent', 'warning');
    return false;
  }
  else{
      var thisdata = {discount: $('#discountcharge').val(), percent: $('#set_discountcharge').val()};
  var spinner = $('.discountSpinner');

    setHeaders();
    jQuery.ajax({
    url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            spinner.removeClass('disp-0');
        },
        success: function(result){
        if(result.state == 'success'){
            spinner.addClass('disp-0');
            $('.close').click();
            swal(result.title, result.message , result.state);
            setTimeout(function(){ location.href = result.link; }, 2000);
        }
        else{
            spinner.addClass('disp-0');
            swal(result.title, result.message , result.state);
        }


    }

  });
  }

}


function showBw(busID, val){
  // Pop ups
  $('#clickBW').click();
  $('#bwbusid').val(busID);
  $('#bwaction').val(val);

}

function activateBW(){
  // Pop ups
  var busID = $('#bwbusid').val();
  var action = $('#bwaction').val();
  var description = $('#bwDesc').code();
  var route = "{{ URL('Ajax/activateBW') }}";
  var thisdata = {busID: busID, description: description, action: action};
  var spinner = $('.spins');

  setHeaders();
    jQuery.ajax({
    url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            spinner.removeClass('disp-0');
        },
        success: function(result){
        if(result.state == 'success'){
            spinner.addClass('disp-0');
            $('.close').click();
            swal(result.title, result.message , result.state);
            setTimeout(function(){ location.reload(); }, 2000);
        }
        else{
            spinner.addClass('disp-0');
            swal(result.title, result.message , result.state);
        }


    }

  });

}



function processPrint(){

    $('#myform').submit();

//   var body = $('#myform')[0];
//   var formData = new FormData(body);

//   body.submit();

  // var route = "{{ URL('Ajax/printLetter') }}";
  // var spinner = $('.spinner');


}


// function processPrint(){
//   var formData = new FormData();
//   var form = $("#inviteformcontact > tr > td:nth-child(6) > input[name^='checkme']:checked");
//   var allEl = $("#inviteformcontact > tr > td:nth-child(6) > label");
//   var route = "{{ URL('Ajax/printLetter') }}";
//   var spinner = $('.spinner');

//     if(form.length == 0){
//       swal('Oops!', 'Please select from the list', 'info');
//       return false;
//     }
//     else{

//       allEl.each(function(index, el) {
//         var pos = index+1;

//          if($("#checkme"+pos).prop('checked') == true){
//             var detail = $("#checkme"+pos).val();

//             formData.append("checkme", detail);

//               setHeaders();
//                 jQuery.ajax({
//                 url: route,
//                   method: 'post',
//                   data: formData,
//                   cache: false,
//                   processData: false,
//                   contentType: false,
//                   dataType: 'JSON',
//                   beforeSend: function(){
//                     spinner.removeClass('disp-0');
//                   },
//                 success: function(result){



//               }

//             });

//          }
//          else{
//           console.log('Do nothing');
//          }

//       });



//     }





// }


function createModal(val){
    $('#'+val).click();
}


function checkClaim(company, telephone, id){

    var formData = new FormData();

    var spinner = $('.spin'+id);
    var route = "{{ URL('Ajax/supportClaims') }}";

    formData.append("company", company);
    formData.append("telephone", telephone);


    doAjax(route, spinner, formData);

}


    function doAjax(route, spinner, thisdata){
        setHeaders();
            jQuery.ajax({
                url: route,
                method: 'post',
                data: thisdata,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    spinner.removeClass('disp-0');
                },
                success: function(result){
                    if(result.message == "success"){
                        if(result.action == "claim"){
                            swal(result.title, result.res, result.message);
                            setTimeout(function(){ location.href = location.origin+"/"+result.link; }, 3000);
                        }
                        else{
                            spinner.addClass('disp-0');
                            swal(result.title, result.res, result.message);
                        }
                    }
                    else{
                        spinner.addClass('disp-0');
                        swal(result.title, result.res, result.message);
                    }
                }
            });
    };


function action(val, id){
    if(val == "delete"){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this detail!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Submit form
                $('#delete_agent').submit();
            } else {
                console.log('Safe');
            }
        });
    }
    else{
        // Run Ajax and Pop up modal
        var route = "{{ URL('Ajax/getAgent') }}";
        var thisdata = {id: id};
          // Run Ajax
            setHeaders();
            jQuery.ajax({
            url: route,
            method: 'post',
            data: thisdata,
            dataType: 'JSON',
            beforeSend: function(){
                $('#'+val).click();
            },
            success: function(result){
            if(result.message == 'success'){
            var res = JSON.parse(result.data);

                $('#agent_id').val(res[0].id);
                $('#agent_firstname').val(result.firstname);
                $('#agent_lastname').val(result.lastname);
                $('#agent_address').val(res[0].address);
                $('#agent_email').val(res[0].email);
                $('#agent_telephone').val(res[0].telephone);
                $('#agent_username').val(res[0].username);

            }
            else{
                swal(result.title, result.res , result.message);
            }


        }

        });
    }
}




function openModal(val, id){
  $('#mechstation_id').val(id);
  var route = "{{ URL('Ajax/getCrawled') }}";
  var thisdata = {id: id};
  // Run Ajax
    setHeaders();
    jQuery.ajax({
    url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            $('#'+val).click();
        },
        success: function(result){
        if(result.state == 'success'){
          var res = JSON.parse(result.data);

            $('#mechstation_id').val(res[0].id);
            $('#mechstation_name').val(res[0].station_name);
            $('#mechstation_address').val(res[0].address);
            $('#mechstation_city').val(res[0].city);
            $('#mechstation_state').append(`<option value="${res[0].state}">${res[0].state}</option>`);
            $('#mechstation_zipcode').val(res[0].zipcode);
            $('#mechstation_country').val(res[0].country);

        }
        else{
            swal(result.title, result.message , result.state);
        }


    }

  });

}



function updateCrawl(){
    var id = $('#mechstation_id').val();
    var station_name = $('#mechstation_name').val();
    var address = $('#mechstation_address').val();
    var city = $('#mechstation_city').val();
    var state = $('#mechstation_state').val();
    var zipcode = $('#mechstation_zipcode').val();
    var country = $('#mechstation_country').val();
  var route = "{{ URL('Ajax/updateCrawls') }}";
  var thisdata = {id: id, station_name: station_name, address: address, city: city, state: state, zipcode: zipcode, country: country};
    var spinner = $('.spinner');


  setHeaders();
    jQuery.ajax({
    url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            spinner.removeClass('disp-0');
        },
        success: function(result){
        if(result.state == 'success'){
            spinner.addClass('disp-0');
            $('.close').click();
            swal(result.title, result.message , result.state);
            setTimeout(function(){ location.reload(); }, 2000);
        }
        else{
            spinner.addClass('disp-0');
            swal(result.title, result.message , result.state);
        }


    }

  });


}


function comingSoon(){
    swal('Hey', 'This feature is coming soon to your screen', 'info');
}

function signAppointment(){
    swal('Hey', 'Kindly sign the agreement document before you can have access', 'info');
}

function deleteMechanics(){
        swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this detail!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $('#delete_form').submit();
      } else {
        console.log('Safe');
      }
    });
}


function deleteUpload(id){
        swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this detail!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $('#'+id).submit();
      } else {
        swal('Great!', 'File is safe!', 'success');
      }
    });
}


function updateInfo(val){
    var spinner = $('.spinner'+val);
    var route = "{{ URL('Ajax/businessUpdate') }}";
    var thisdata;

    var emailval = $('#'+val+'_email').val();

    if(val == 'company'){


        var size_of_employee = $('#size_of_employee').val();
        var company_name = $('#company_name').val();
        var company_address = $('#company_address').val();
        var city = $('#prof_city').val();
        var postal_code = $('#postal_code').val();
        var country = $('#prof_country').val();
        var state = $('#prof_state').val();
        var year_started_since = $('#year_started_since').val();
        var practical_experience = $('#practical_experience').val();
        var facebook = $('#facebook').val();
        var twitter = $('#twitter').val();
        var instagram = $('#instagram').val();
        

        if(country == "-1"){
            swal('Oops', 'Please select your country', 'info');
        }
        else{
            thisdata = {size_of_employee: size_of_employee, company_name: company_name, company_address: company_address, city: city, postal_code: postal_code, country: country, state: state, year_started_since: year_started_since, practical_experience: practical_experience,facebook: facebook, twitter: twitter, instagram: instagram, val: val, emailval: emailval};
        }



    }
    else if(val == 'contact'){

        var fullname = $('#fullname').val();
        var phone_number = $('#phone_number').val();
        var email_address = $('#email_address').val();
        var mobile = $('#mobile').val();
        var office = $('#office').val();

        thisdata = {fullname: fullname, phone_number: phone_number, email_address: email_address, mobile: mobile, office: office, val: val, emailval: emailval};

    }
    else if(val == 'speciality'){

        var mechanical = $('#mechanical').val();
        var electrical = $('#electrical').val();
        var transmissions = $('#transmissions').val();
        var body_works = $('#body_works').val();
        var others = $('#others').val();
        var service_offered = $('#service_offered').val();

        thisdata = {mechanical: mechanical, electrical: electrical, transmissions: transmissions, body_works: body_works, others: others, service_offered: service_offered, val: val, emailval: emailval};

    }
    else if(val == 'value'){

        var vimfile_discount = $('#vimfile_discount').val();
        var repair_guaranteed = $('#repair_guaranteed').val();
        var free_estimates = $('#free_estimates').val();
        var walk_in_welcome = $('#walk_in_welcome').val();
        var other_added_value = $('#other_added_value').val();
        var average_waiting_period = $('#average_waiting_period').val();
        var hours_of_operation = $('#hours_of_operation').val();

        thisdata = {vimfile_discount: vimfile_discount, repair_guaranteed: repair_guaranteed, free_estimates: free_estimates, walk_in_welcome: walk_in_welcome, other_added_value: other_added_value, average_waiting_period: average_waiting_period, hours_of_operation: hours_of_operation, val: val, emailval: emailval};

    }
    else if(val == 'amenity'){

        var wifi = $('#wifi').val();
        var rest_room = $('#rest_room').val();
        var lounge = $('#lounge').val();
        var parking_space = $('#parking_space').val();

        thisdata = {wifi: wifi, rest_room: rest_room, lounge: lounge, parking_space: parking_space, val: val, emailval: emailval};

    }
    else if(val == 'history'){

        var year_established = $('#year_established').val();
        var background = $('#background').val();

        thisdata = {year_established: year_established, background: background, val: val, emailval: emailval};

    }


    setHeaders();
    jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            spinner.removeClass('disp-0');
        },
        success: function(result){
            spinner.addClass('disp-0');
        if(result.state == 'success'){
            swal(result.title, result.message , result.state);
        }
        else{
            swal(result.title, result.message , result.state);
        }


    }

  });

}









function serviceUpdate(){
    swal({
      title: "Do you want to add to previous services?",
      text: "If yes, services offered will be added, else it will be updated",
      icon: "warning",
      buttons: ["No, just update", "Yes please!"],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Add to
        $('#addto').val(1);
        $('#service_form').submit();

      } else {
        $('#addto').val(0);
        $('#service_form').submit();
      }
    });
}


function sendingMail(val){
    $('#action').val(val);
    $('#form_submit').submit();
}

$('#other_skills').change(function(){
    if($('#other_skills').val() == "Yes"){
        $('.specific').removeClass('disp-0');
    }
    else if($('#other_skills').val() == "No"){
        $('.specific').addClass('disp-0');
    }
    else{
        $('.specific').addClass('disp-0');
    }
});


$('#vimfile_discount').change(function(){
    if($('#vimfile_discount').val() == "Yes"){
        $('.your-discount-select').removeClass('disp-0');
    }
    else if($('#vimfile_discount').val() == "No"){
        $('.your-discount-select').addClass('disp-0');
    }
    else{
        $('.your-discount-select').addClass('disp-0');
    }
});


    //Set CSRF HEADERS
 function setHeaders(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });
 }

$('.myphotos').jPreview();
$('.demo').jPreview();


</script>





<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script src="{{ asset('ext/js/util.min.js') }}"></script>