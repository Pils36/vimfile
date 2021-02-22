<!-- jquery plugins here-->
    <!-- jquery -->
    {{-- <script src="js/jquery-1.12.1.min.js"></script> --}}

    <script src="{{ asset('ext/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('loadmore/jquery.simpleLoadMore.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweet-modal@1.3.2/dist/min/jquery.sweet-modal.min.js" integrity="sha256-fVM9ObFJ6Fp2I5kEKK5TTU+VpAWYZILaWtm6haNFIXw=" crossorigin="anonymous"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"></script>
    <script src="{{ asset('js/country-state-select.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.4/js/dataTables.autoFill.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- popper js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->

    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script> --}}
    <!-- slick js -->


    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('ext/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('ext/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('ext/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('ext/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('ext/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('ext/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('ext/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('ext/js/main.js') }}"></script>
    <script src="{{ asset('ext/js/util.min.js') }}"></script>

<script language="javascript">
    populateCountries("countryeez", "stateez");
    populateCountries("countryz", "statez");

</script>

<script language="javascript">
    populateCountries("countryzcm", "statezcm");
    populateCountries("countryzacc", "statezacc");
</script>

<script language="javascript">
    populateCountries("countryeezcom", "stateezcom");
    populateCountries("countryzdeal", "statezdeal");
</script>

<script language="javascript">
    populateCountries("create_vendorcountry", "create_vendorstate");
    populateCountries("update_vendorcountry", "update_vendorstate");
</script>


<script language="javascript">
    populateCountries("countryzee", "statezee");
</script>



@if(Auth::user())

<script>

  $(document).ready(function(){


    if("{{ Auth::user()->login_times }}" < 2){
        introJs().start();
    }

    

    setInterval(() => {
        checkEstRecs();
    }, 7000);

    // Perform Guide Operations

    function checkEstRecs(){

var station_name = "{{ Auth::user()->station_name }}";
var thisdata = {station_name: station_name};
// Check Notifications
// Do Ajax to fetch result
      setHeaders();
      jQuery.ajax({
      url: "{{ URL('Ajax/checkEstRecs') }}",
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      success: function(result){
        if(result.message == "success"){
          $('#guide1').click();
        }
      }
    });
}
    



    $('.some-list').simpleLoadMore({
      item:'div.reviewcon',
      btnHTML:'<div class="row"><div class="col-md-12"><br><br><a href="#" class="load-more__btn btn btn-danger">View More</a></div></div>',
      count: 4

    });

    $('.item-list').simpleLoadMore({
      item:'div.opportunitycontain',
      btnHTML:'<a href="#" class="load-more__btn btn btn-danger btn-block">View More</a>',
      count: 4

    });


    $('.itemListing').simpleLoadMore({
      item:'div.contDes',
      btnHTML:'<div class="row"><div class="col-md-12"><a href="#" class="load-more__btn btn btn-danger btn-block">View More</a></div></div>',
      count: 2

    });


    $('#discountcost_percent').val(0);
    $('#servicecost_percent').val(0);

    // setInterval(() => {
    //     doajaxNotify();
    // }, 2000);


    // setTimeout(() => {
    //     checkFeedback();
    // }, 5000);

  });

  function doajaxNotify(){
  var ref_code = "{{ Auth::user()->ref_code }}";
  var thisdata = {ref_code: ref_code};
  // Check Notifications
  // Do Ajax to fetch result
        setHeaders();
        jQuery.ajax({
        url: "{{ URL('Ajax/checkNotifications') }}",
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "Success"){
            // Update Notification bar
            iziToast.success({
                title: result.message,
                message: result.res,
            });

          }
        }
      });
}


 function checkFeedback(){



  var ref_code = "{{ Auth::user()->ref_code }}";
  var thisdata = {ref_code: ref_code};
  // Check Notifications
  // Do Ajax to fetch result
        setHeaders();
        jQuery.ajax({
        url: "{{ URL('Ajax/checkFeedbacks') }}",
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "Success"){
            $('.genfeed').click();
          }
        }
      });
}


function logouts(){
  var ref_code = "{{ Auth::user()->ref_code }}";
  var thisdata = {ref_code: ref_code};
  // Check Notifications
  // Do Ajax to fetch result
        setHeaders();
        jQuery.ajax({
        url: "{{ URL('Ajax/updateFeedbacks') }}",
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "Success"){
            $('#logout-form').submit();
          }
        }
      });
}


// Check for Estimate Record






</script>



@else

    {{-- @if ($pages == "Home")
        <script>
        setTimeout(() => {

        $.sweetModal({
            title: 'Claim Business NOW!',
            content: '<h4>Claiming your business is the fastest way to get more traffic to your <strong>AUTO REPAIR SHOP</strong>.</h4> <br><br> <center><div class="row"><div class="col-md-6"><button class="btn btn-danger btn-block" onclick="closeFeedback()">Close</button></div><div class="col-md-6"><a class="btn btn-primary btn-block" href="/claimbusiness">Click here to claim your business</a></div></div></center>'
        });
        }, 5000);

    </script>
    @endif --}}



@endif




<script>
  $(document).ready(function(){

    $('.sms').addClass('disp-0');


    $('#book_ref').val('');
    $('#feedback_refcode').val('');
    $('#mybook_ref').val('');
    $('#item_total_mark_up').val('');
    $('#item_total_taxrate').val('');
    $('#bizreportcheck').val('');



          // Get Rankings
        // $("#rank_table tr > td#point_id")[1].innerHTML;

        var user = $('.userrankid').val();
          var rank = $('#rank_table tr#row'+user+'>td:nth-child(1)').html();
          var alltime = $('#alltimerank_table tr#row'+user+'>td:nth-child(1)').html();
          var globalTime = $('#globalrank_table tr#row'+user+'>td:nth-child(1)').html();

          $('.Rank').text();
          $('.weekRank').text(rank);
          $('.alltimeRank').text(alltime);
          $('.globalRank').text(globalTime);



    $('#claimstable').DataTable({
    language: {
        searchPlaceholder: "Search by Company"
    }
});
    $('#connectionsList').DataTable();
    $('#monitorRecs').DataTable();
    $('.vehRecs').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });



    var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("c");

        

        if(c == "business"){
          $("#business-tab").click();
        }

        if(c == "autocare"){
            $('#autocare-tab').click();
        }

        if(c == "SecurityQuest2"){
          $('#maiden_name1').val('NULL');
          $(".parentMeet").removeClass('disp-0');
          $(".maidenName").addClass('disp-0');
          $(".passwordChange").addClass('disp-0');
        }

        if(c == "NewPassword"){
          $(".passwordChange").removeClass('disp-0');
          $(".parentMeet").addClass('disp-0');
          $(".maidenName").addClass('disp-0');
        }

        if(c == "report"){
          $("#report-tab").click();
        }
        if(c == "maintenance"){
          $("#maintenance-tab").click();
        }

        if(c == "manageinventory"){
          // Click on Shop Management and click on manageinventory tab
          $('#recordmaintenance-tab').click();
          $('.sms').removeClass('disp-0');
          $("#manageinventory-tab").click();
          $("#createpurchase-tab").click();
        }

        if(c == "responsepurchaseorder"){
          // Click on Shop Management and click on managae purchase order tab
          $('#recordmaintenance-tab').click();
          $('.sms').removeClass('disp-0');
          $("#manageinventory-tab").click();
          $("#managepurchase-tab").click();
        }

        if(c == "vehiclemanageinventory"){
          // Click on Shop Management and click on vehicle maintenance tab
          $('#recordmaintenance-tab').click();
          $("#maintenance-tab").click();
          $('.sms').removeClass('disp-0');
        }

        if(c == "manageinventory#inventory"){
          $('#inventory-tab').click();
        }
        if(c == "labourschedule"){
          $('#recordmaintenance-tab').click();
          $("#labourschedule-tab").click();
          $('.sms').removeClass('disp-0');
        }

        if(c == "opportunity"){
          $("#opportunity-tab").click();
        }

        if(c == "businessreportclientbalance"){
          $("#businessreport-tab").click();
          $('#bizreportcheck').val(1);

          if($('#bizreportcheck').val() == 1){
            $("#clientbalances-tab").click();
          }
        }
        if(c == "businessreportcashbalance"){
            $("#businessreport-tab").click();
            $('#bizreportcheck').val(4);

            if($('#bizreportcheck').val() == 4){
            $("#cashbalances-tab").click();
          }

        }
        if(c == "businessreportcreditbalance"){
            $("#businessreport-tab").click();
            $('#bizreportcheck').val(5);

            if($('#bizreportcheck').val() == 5){
            $("#creditcardbalances-tab").click();
          }

        }if(c == "businessreportbankbalance"){
            $("#businessreport-tab").click();
            $('#bizreportcheck').val(6);

            if($('#bizreportcheck').val() == 6){
            $("#bankbalances-tab").click();
          }

        }


$('#material_select').change(function(){
  // alert(1234);
  if($('#material_select').val() == 'material1'){
    $('.mat_cost1').removeClass('disp-0');
    $('.mat_select2').removeClass('disp-0');
    $('#inv_pos').val('1');
  }
  else{
    $('.mat_cost1').addClass('disp-0');
    $('.mat_select2').addClass('disp-0');
    $('#inv_pos').val('');
  }
 });

  $('#material_select2').change(function(){
  if($('#material_select2').val() == 'material2'){
    $('.mat_cost2').removeClass('disp-0');
    $('.lab_cost2').removeClass('disp-0');
    $('.addMatLab').removeClass('disp-0');
    $('.mat_select3').removeClass('disp-0');
    $('#inv_pos').val('2');
    $('#inv_position2').val('2');
  }
  else{
    $('.mat_cost2').addClass('disp-0');
    $('.lab_cost2').addClass('disp-0');
    $('.addMatLab').addClass('disp-0');
    $('.mat_select3').addClass('disp-0');
    $('#inv_pos').val('');
    $('#inv_position2').val('');
  }
 });

   $('#material_select3').change(function(){
  if($('#material_select3').val() == 'material3'){
    $('.mat_cost3').removeClass('disp-0');
    $('#inv_pos').val('3');
    $('.addMatsNew').removeClass('disp-0');
  }
  else{
    $('.mat_cost3').addClass('disp-0');
    $('#inv_pos').val('');
    $('.addMatsNew').addClass('disp-0');
  }
 });


   sumsup();
        $(".material_cost, .material_cost2, .material_cost3, .labour_cost, .labour_cost2, .other_cost").on("keydown keyup", function() {
            sumsup();
        });

        materialArth1();
        $(".material_qty, .material_ratez1").on("keydown keyup", function() {
            materialArth1();
        });
        materialArth2();
        $(".material_qty2, .material_ratez2").on("keydown keyup", function() {
            materialArth2();
        });
        materialArth3();
        $(".material_qty3, .material_ratez3").on("keydown keyup", function() {
            materialArth3();
        });
        labourArth1();
        $(".labour_qty, .labour_hour").on("keydown keyup", function() {
            labourArth1();
        });

        labourArth2();
        $(".labour_qty2, .labour_hour2").on("keydown keyup", function() {
            labourArth2();
        });



        sum();
        $("#material_cost, #labour_cost, #material_cost2, #material_cost3, #material_cost4, #material_cost5, #material_cost6, #material_cost7, #material_cost8, #material_cost9, #material_cost10, #labour_cost2, #labour_cost3, #labour_cost4, #labour_cost5, #labour_cost6, #labour_cost7, #labour_cost8, #labour_cost9, #labour_cost10, #other_cost, #part_cost").on("keydown keyup", function() {
            sum();
        });



        addup();
        $("#pay_deposit_made, #pay_cash_payment, #pay_cheque_payment_amount, #pay_card_amount").on("keydown keyup", function() {
            addup();
        });


        poaddup();
        $("#purchase_order_totcost, #purchase_order_shippingcost, #purchase_order_othercost, #purchase_order_discount, #purchase_order_tax").on("keydown keyup", function() {
            poaddup();
        });



        payaddup();
        $("#pay_tot_cost, #pay_shipping_cost, #pay_discount, #pay_othercosts, #pay_tax, #pay_po_total, #pay_advance, #pay_balance").on("keydown keyup", function() {
            payaddup();
        });

        grandaddup();
        $("#pay_balance, #pay_cashamount, #pay_chequeamount, #pay_cardamount").on("keydown keyup", function() {
            grandaddup();
        });

        labourgenaddup();
        $("#addlabour_hourly_rate, #addlabour_budgeted_hours").on("keydown keyup", function() {
            labourgenaddup();
        });

        po_qtyRate();
        $("#purchase_order_qty, #purchase_order_rate").on("keydown keyup", function() {
            po_qtyRate();
        });

        payVendor_qtyRate();
        $("#pay_quantity, #pay_rate").on("keydown keyup", function() {
            payVendor_qtyRate();
        });

        addpart_qtyrate();
        $("#items_qty, #items_unit_cost").on("keydown keyup", function() {
            addpart_qtyrate();
        });

        addpart_unitprice();
        $("#items_unit_cost, #item_mark_up, #item_discount").on("keydown keyup", function() {
            addpart_unitprice();
        });

        addpart_discount();
        $("#item_discount, #item_unit_price").on("keydown keyup", function() {
            addpart_discount();
        });

        addpart_markup();
        $("#item_mark_up, #item_unit_price").on("keydown keyup", function() {
            addpart_markup();
        });

        addpart_taxrate();
        $("#item_tax_rate, #item_unit_price").on("keydown keyup", function() {
            addpart_taxrate();
        });

        // addpart_totprice();
        // $("#item_unit_price, #item_tax_rate").on("keydown keyup", function() {
        //     addpart_totprice();
        // });

        addmaterial1();
        $("#material_unit_cost, #material_markup, #material_qty").on("keydown keyup", function() {
            addmaterial1();
        });

        addmaterial2();
        $("#material_unit_cost2, #material_markup2, #material_qty2").on("keydown keyup", function() {
            addmaterial2();
        });

        addmaterial3();
        $("#material_unit_cost3, #material_markup3, #material_qty3").on("keydown keyup", function() {
            addmaterial3();
        });
        addmaterial4();
        $("#material_unit_cost4, #material_markup4, #material_qty4").on("keydown keyup", function() {
            addmaterial4();
        });
        addmaterial5();
        $("#material_unit_cost5, #material_markup5, #material_qty5").on("keydown keyup", function() {
            addmaterial5();
        });
        addmaterial6();
        $("#material_unit_cost6, #material_markup6, #material_qty6").on("keydown keyup", function() {
            addmaterial6();
        });
        addmaterial7();
        $("#material_unit_cost7, #material_markup7, #material_qty7").on("keydown keyup", function() {
            addmaterial7();
        });
        addmaterial8();
        $("#material_unit_cost8, #material_markup8, #material_qty8").on("keydown keyup", function() {
            addmaterial8();
        });
        addmaterial9();
        $("#material_unit_cost9, #material_markup9, #material_qty9").on("keydown keyup", function() {
            addmaterial9();
        });
        addmaterial10();
        $("#material_unit_cost10, #material_markup10, #material_qty10").on("keydown keyup", function() {
            addmaterial10();
        });

        paylabouradd();
        $("#pay_labour_labourhour, #pay_labour_labourrate").on("keydown keyup", function() {
            paylabouradd();
        });

        paylabourstub1();
        $("#pay_schedule_labourcashamount, #pay_schedule_labourchequeamount, #pay_schedule_labourcreditcardamount").on("keydown keyup", function() {
            paylabourstub1();
        });

        paylabourstub2();
        $("#pay_stub_labourdeduction, #pay_stub_labourpaydue").on("keydown keyup", function() {
            paylabourstub2();
        });

        paylabourstub3();
        $("#pay_stub_labourcashamount, #pay_stub_labourchequeamount, #pay_stub_labourcreditcardamount").on("keydown keyup", function() {
            paylabourstub3();
        });



// Newsletter Alert Mail
$('#newslettermailSet').change(function(){
  var route = "{{ URL('Ajax/Alertaction') }}";
  var thisdata = {email: $('.authMail').text(), val: $('#newslettermailSet').val(), action: 'newslettermail'}

  // Do Ajax to fetch result
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "Success"){
            iziToast.success({
              title: result.message,
              message: result.res,
          });
          }
          else{
            swal('Oops', result.res, result.message);
          }
        }
      });
});





// Purchase Order Make Pay
$('#pay_po_number').change(function() {
    var route =  "{{ URL('Ajax/autoPayment') }}";
    var thisdata = {pay_po_number: $("#pay_po_number").val()}

    // Do Ajax to fetch result
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "success"){
            var res = JSON.parse(result.data);
            $('#pay_post_id').val(res[0].post_id);
            $('#pay_type').val('Make Payment');
            $('#vend_name').val(res[0].vendor);
            $('#pay_po_number').val(res[0].purchase_order_no);
            $('#pay_order_date').val(res[0].order_date);
            $('#pay_date_expected').val(res[0].expected_date);
            $('#pay_invent_item').val(res[0].purchase_order_inventory_item);
            $('#pay_quantity').val(res[0].purchase_order_qty);
            $('#pay_rate').val(res[0].purchase_order_rate);
            $('#pay_tot_cost').val(res[0].purchase_order_totcost);
            $('#pay_shipping_cost').val(res[0].purchase_order_shippingcost);
            $('#pay_discount').val(res[0].purchase_order_discount);
            $('#pay_othercosts').val(res[0].purchase_order_othercost);
            $('#pay_tax').val(res[0].purchase_order_tax);
            $('#pay_po_total').val(res[0].purchase_order_totalpurchaseorder);
          }
          else{
            // swal('Oops', result.res, result.message);
          }
        }
      });

    return false;    //<---- Add this line
});


  });
</script>

<script>
    $(function () {
populateCountries("country_of_reg", "statez");


        // Licence search
        $(".licenceKey").on("keydown keyup", function(){

            $('tbody.estimateorders').html('');
            $('tbody.workorders').html('');
            $("tbody.resultCar2").html("");
            $("tbody.resultCar2").addClass('disp-0');
            $("#email").val('');
            $("#telephone").val('');

            var mechFile;

            if($(".licenceKey").on("keydown keyup")){

                if($(".licenceKey").val() != ""){
                var key = $(".licenceKey").val();
                var route = "{{ URL('Ajax/LicenseSearches') }}";
                var thisdata = {vehicle_licence: key};
                $("tbody.resultCar2").addClass('disp-0');
                $("tbody.resultCar1").removeClass('disp-0');

                

                // Do Ajax to fetch result
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
                });
                jQuery.ajax({
                url: route,
                method: 'post',
                data: thisdata,
                dataType: 'JSON',
                success: function(result){

                  if(result.action = 'main'){

                    $("tbody.resultCar2").removeClass('disp-0');
                    $("tbody.resultCar1").addClass('disp-0');

                    var res = JSON.parse(result.data);
                    var res2 = JSON.parse(result.data2);
                    var res3 = JSON.parse(result.data3);
                    var res4 = JSON.parse(result.data4);

                    $("#email").val(res2[0].email);
                    $("#telephone").val(res2[0].telephone);

                    var file; var make; var mileage; var service_option; var service_type; var service_item_spec;
                    var manufacturer; var material_cost; var material_cost2; var material_cost3; var material_qty; var material_qty2; var material_qty3; var labour_cost; var labour_cost2; var other_cost; var total_cost; var service_note; var update_by; var payment; var pay_status; var estimate_id; var view_more; var views; var maint_rec;

                    // Maintenance Record Information

                    $.each(res, function(v,k){
                      // console.log(k);
                        file = k.file; make = k.make; mileage = k.mileage; service_option = k.service_option; service_type = k.service_type;
                        service_item_spec = k.service_item_spec; manufacturer = k.manufacturer; material_cost = k.material_cost; material_cost2 = k.material_cost2; material_cost3 = k.material_cost3; material_qty = k.material_qty; material_qty2 = k.material_qty2;material_qty3 = k.material_qty3; labour_cost = k.labour_cost; labour_cost2 = k.labour_cost2; labour_qty = k.labour_qty;labour_qty2 = k.labour_qty2; other_cost = k.other_cost; total_cost = k.total_cost; service_note = k.service_note; update_by = k.update_by; payment = k.payment; estimate_id = k.estimate_id;

                        if(payment == '2'){
                          pay_status = "PAID";
                        }
                        else if(payment == '1'){
                          pay_status = "NOT PAID";
                        }
                        else{
                          pay_status = "";
                        }

                        if(estimate_id == null){
                          view_more = "#";
                          views = "<a href='#' class='text-center'>-</a>";
                        }
                        else{
                          view_more = "/invoicereport/"+estimate_id;
                          views = "<a title='View More' style='font-size: 11px; font-weight: bold; color: darkblue;' href='"+view_more+"' target='_blank'><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;'></i></a>";


                        }

                        if(file != "noImage.png"){
                          maint_rec = "<tr style='font-size: 11px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.date +"</td><td>"+ k.service_type +"</td><td>"+ k.service_option +"</td><td>"+ k.total_cost +"</td><td>"+ k.service_note +"</td><td>"+ k.mileage +"</td><td><a style='font-size: 11px;' href='/uploads/"+ k.file +"' target='_blank'>Open file</a></td><td>"+ k.update_by +"</td><td>"+ pay_status +"</td><td>"+views+"</td><tr>";
                        }
                        else{
                          maint_rec = "<tr style='font-size: 11px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.date +"</td><td>"+ k.service_type +"</td><td>"+ k.service_option +"</td><td>"+ k.total_cost +"</td><td>"+ k.service_note +"</td><td>"+ k.mileage +"</td><td>No file</td><td>"+ k.update_by +"</td><td>"+ pay_status +"</td><td>"+views+"</td><tr>";
                        }
                        

                        $("tbody.resultCar2").append(maint_rec);

                    });


                  // Start
                  // Estimate Record Information
                    $.each(res3, function(i,j){


                        if(j.file != "noImage.png"){
                          mechFile =  "<a style='font-size: 12px; color: darkblue; font-weight: bolder;' href='/uploads/"+j.file+"' download>Download file</a>";
                        }
                        else{
                          mechFile = "No file";
                        }
                        
                            $('tbody.estimateorders').append("<tr style='font-size: 11px;'><td>"+(i+1)+"</td><td>"+j.vehicle_licence+"</td><td>"+j.date+"</td><td>"+j.service_type+"</td><td>"+j.service_option+"</td><td>"+j.total_cost+"</td><td>"+j.service_note+"</td><td>"+j.mileage+"</td><td>"+mechFile+"</td><td>"+j.update_by+"</td><td><i type='button' style='padding: 10px;' title='Edit' class='fas fa-edit text-danger' style='text-align: center; cursor: pointer;' onclick=editRecs(\'"+j.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+j.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to diagnostic' class='fas fa-shopping-cart' onclick=diagnostic(\'"+j.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to work order' class='fas fa-exchange-alt' onclick=workOrders(\'"+j.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Resend mail' class='fas fa-paper-plane text-primary mailPlane' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+j.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Print copy' class='fas fa-print text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+j.estimate_id+"'\)></i></td></tr>");

                      
                    });

                    // Work Order Record Information

                    $.each(res4, function(x,y){


                      if(y.file != "noImage.png"){
                          mechFile =  "<a style='font-size: 12px; color: darkblue; font-weight: bolder;' href='/uploads/"+y.file+"' download>Download file</a>";
                        }
                        else{
                          mechFile = "No file";
                        }


                        
                            $('tbody.workorders').append("<tr style='font-size: 11px;'><td>"+(x+1)+"</td><td>"+y.vehicle_licence+"</td><td>"+y.date+"</td><td>"+y.service_type+"</td><td>"+y.service_option+"</td><td>"+y.total_cost+"</td><td>"+y.service_note+"</td><td>"+y.mileage+"</td><td>"+mechFile+"</td><td>"+y.update_by+"</td><td><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+y.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Move to Estimate' class='fas fa-exchange-alt' onclick=estimateOrders(\'"+y.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Move to Maintenance Record' class='fas fa-tools' onclick=maintenanceOrders(\'"+y.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Resend mail' class='fas fa-paper-plane text-primary mailPlane' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+y.estimate_id+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Print copy' class='fas fa-print text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+y.estimate_id+"'\)></i></td></tr>");

                      
                    });

                  // End
                  }
                  else{
                        $('tbody.estimateorders').html('');
                        $('tbody.workorders').html('');
                        $("tbody.resultCar2").html("");
                        $("tbody.resultCar2").addClass('disp-0');
                        $("#email").val('');
                        $("#telephone").val('');
                  }

                }

              });

            }
            else{
                $('tbody.estimateorders').html('');
                $('tbody.workorders').html('');
                $("tbody.resultCar2").html("");
                $("tbody.resultCar2").addClass('disp-0');
                $("#email").val('');
                $("#telephone").val('');
            }
            }
            else{
                $('tbody.estimateorders').html('');
                $('tbody.workorders').html('');
                $("tbody.resultCar2").html("");
                $("tbody.resultCar2").addClass('disp-0');
                $("#email").val('');
                $("#telephone").val('');
            }

            });




$('.searchLicence').keypress(function (e) {
  if (e.which == 13) {
    // Click Search Btn
    $("#licencesearch").click();
    return false;    //<---- Add this line
  }
});


      $('#inv_position').val('1');
        //Initialize Select2 Elements
        $('.select2').select2();

        $('#invoicing').DataTable({
          autoFill: true
        });

        $('#invoicingPaid').DataTable({
          autoFill: true
        });

        $('#invoicingunPaid').DataTable({
          autoFill: true
        });
        $('#clientBal').DataTable({
          autoFill: true
        });
        $('#stationBal').DataTable({
          autoFill: true
        });
        $('#vendorBal').DataTable({
          autoFill: true
        });
        $('#labourBal').DataTable({
          autoFill: true
        });
        $('#cashBal').DataTable({
          autoFill: true
        });
        $('#creditcardBal').DataTable({
          autoFill: true
        });


        $('#bankBal').DataTable({
          autoFill: true
        });






        $('button#moreFields').magnificPopup({
  items: {
    src: '<div class="white-popup"><p class="text-center text-success">Select Service Type</p><select style="width: 100%; height: auto; padding: 7px;" name="services_types" id="services_types" onchange="getMe()"><option value="Service" selected="selected" disabled="disabled">Service</option><optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup><optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup><optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup><optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option></optgroup></select></div>',
      type: 'inline'
  },
  closeBtnInside: true
});



// alert($('#estimate').prop('checked'));






// Reminder Alert Mail
$('#remindmailSet').change(function(){
  var route = "{{ URL('Ajax/Alertaction') }}";
  var thisdata = {email: $('.authMail').text(), val: $('#remindmailSet').val(), action: 'remindermail'};

  // Do Ajax to fetch result
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "Success"){
            iziToast.success({
              title: result.message,
              message: result.res,
          });
          }
          else{
            swal('Oops', result.res, result.message);
          }
        }
      });

});

// Deal Alert Mail
$('#dealmailSet').change(function(){
  var route = "{{ URL('Ajax/Alertaction') }}";
  var thisdata = {email: $('.authMail').text(), val: $('#dealmailSet').val(), action: 'dealmail'}

  // Do Ajax to fetch result
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "Success"){
            iziToast.success({
              title: result.message,
              message: result.res,
          });
          }
          else{
            swal('Oops', result.res, result.message);
          }
        }
      });
});





    });




        // Sum Value
    function sum() {
            var material_cost = document.getElementById('material_cost').value;
            var labour_cost = document.getElementById('labour_cost').value;
            var material_cost2 = document.getElementById('material_cost2').value;
            var material_cost3 = document.getElementById('material_cost3').value;
            var material_cost4 = document.getElementById('material_cost4').value;
            var material_cost5 = document.getElementById('material_cost5').value;
            var material_cost6 = document.getElementById('material_cost6').value;
            var material_cost7 = document.getElementById('material_cost7').value;
            var material_cost8 = document.getElementById('material_cost8').value;
            var material_cost9 = document.getElementById('material_cost9').value;
            var material_cost10 = document.getElementById('material_cost10').value;
            var labour_cost2 = document.getElementById('labour_cost2').value;
            var labour_cost3 = document.getElementById('labour_cost3').value;
            var labour_cost4 = document.getElementById('labour_cost4').value;
            var labour_cost5 = document.getElementById('labour_cost5').value;
            var labour_cost6 = document.getElementById('labour_cost6').value;
            var labour_cost7 = document.getElementById('labour_cost7').value;
            var labour_cost8 = document.getElementById('labour_cost8').value;
            var labour_cost9 = document.getElementById('labour_cost9').value;
            var labour_cost10 = document.getElementById('labour_cost10').value;
            var other_cost = document.getElementById('other_cost').value;
            var part_cost = document.getElementById('part_cost').value;
            var discPercent = document.getElementById('discountcost_percent').value;
            var servPercent = document.getElementById('servicecost_percent').value;

            if(material_cost == ""){
              material_cost = 0;
            }
            if(labour_cost == ""){
              labour_cost = 0;
            }
            if(material_cost2 == ""){
              material_cost2 = 0;
            }
            if(material_cost3 == ""){
              material_cost3 = 0;
            }
            if(material_cost4 == ""){
              material_cost4 = 0;
            }
            if(material_cost5 == ""){
              material_cost5 = 0;
            }
            if(material_cost6 == ""){
              material_cost6 = 0;
            }
            if(material_cost7 == ""){
              material_cost7 = 0;
            }
            if(material_cost8 == ""){
              material_cost8 = 0;
            }
            if(material_cost9 == ""){
              material_cost9 = 0;
            }
            if(material_cost10 == ""){
              material_cost10 = 0;
            }
            if(labour_cost2 == ""){
              labour_cost2 = 0;
            }
            if(labour_cost3 == ""){
              labour_cost3 = 0;
            }
            if(labour_cost4 == ""){
              labour_cost4 = 0;
            }
            if(labour_cost5 == ""){
              labour_cost5 = 0;
            }
            if(labour_cost6 == ""){
              labour_cost6 = 0;
            }
            if(labour_cost7 == ""){
              labour_cost7 = 0;
            }
            if(labour_cost8 == ""){
              labour_cost8 = 0;
            }
            if(labour_cost9 == ""){
              labour_cost9 = 0;
            }
            if(labour_cost10 == ""){
              labour_cost10 = 0;
            }
            if(other_cost == ""){
              other_cost = 0;
            }
            if(part_cost == ""){
              part_cost = 0;
            }
            else{
              part_cost = part_cost;
            }
            if(discPercent == ""){
              discPercent = 0;
            }
            else{
              discPercent = discPercent / 100;
            }
            if(servPercent == ""){
              servPercent = 0;
            }
            else{
              servPercent = servPercent / 100;
            }

            var labourRes = parseInt(labour_cost) + parseInt(labour_cost2) + parseInt(labour_cost3) + parseInt(labour_cost4) + parseInt(labour_cost5) + parseInt(labour_cost6) + parseInt(labour_cost7) + parseInt(labour_cost8) + parseInt(labour_cost9) + parseInt(labour_cost10);

            var labDisc = labourRes * discPercent;

            var sub_tots = parseInt(material_cost) + parseInt(material_cost2) + parseInt(material_cost3) + parseInt(material_cost4) + parseInt(material_cost5) + parseInt(material_cost6) + parseInt(material_cost7) + parseInt(material_cost8) + parseInt(material_cost9) + parseInt(material_cost10) + parseInt(other_cost) + parseInt(part_cost) + labourRes;

            // var result = parseInt(material_cost) + parseInt(material_cost2) + parseInt(material_cost3) + parseInt(material_cost4) + parseInt(material_cost5) + parseInt(material_cost6) + parseInt(material_cost7) + parseInt(material_cost8) + parseInt(material_cost9) + parseInt(material_cost10) + parseInt(other_cost) + parseInt(part_cost) + labDisc;
            var result = sub_tots - labDisc;

            var SerDisc = result + (result * servPercent);
            // var result1 = parseInt(num2) - parseInt(num1);

            if (!isNaN(result)) {
                document.getElementById('tot_labourcost').value = Math.round(labourRes);
                document.getElementById('discountcost_amount').value = Math.round(labDisc);
                document.getElementById('sub_totcost').value = Math.round(sub_tots);
                document.getElementById('total_cost').value = Math.round(result);
                // document.getElementById('total_cost').value = Math.round(SerDisc);

                // document.getElementById('subt').value = result1;
            }
        }

        function materialArth1(){
            var material_qty = $('.material_qty').val();
            var material_ratez = $('.material_ratez1').val();

            if(material_qty == ""){
              material_qty = 0;
            }
            if(material_ratez == ""){
              material_ratez = 0;
            }

            var result = material_qty * material_ratez;
            if (!isNaN(result)) {
                $('.material_cost').val(Math.round(result));
            }
        }

        function materialArth2(){
            var material_qty = $('.material_qty2').val();
            var material_ratez = $('.material_ratez2').val();

            if(material_qty == ""){
              material_qty = 0;
            }
            if(material_ratez == ""){
              material_ratez = 0;
            }

            var result = material_qty * material_ratez;
            if (!isNaN(result)) {
                $('.material_cost2').val(Math.round(result));
            }
        }

        function materialArth3(){
            var material_qty = $('.material_qty3').val();
            var material_ratez = $('.material_ratez3').val();

            if(material_qty == ""){
              material_qty = 0;
            }
            if(material_ratez == ""){
              material_ratez = 0;
            }

            var result = material_qty * material_ratez;
            if (!isNaN(result)) {
                $('.material_cost3').val(Math.round(result));
            }
        }

        function labourArth1(){
            var labour_qty = $('.labour_qty').val();
            var labour_hour = $('.labour_hour').val();

            if(labour_qty == ""){
              labour_qty = 0;
            }
            if(labour_hour == ""){
              labour_hour = 0;
            }

            var result = labour_qty * labour_hour;
            if (!isNaN(result)) {
                $('.labour_cost').val(Math.round(result));
            }
        }

        function labourArth2(){
            var labour_qty = $('.labour_qty2').val();
            var labour_hour = $('.labour_hour2').val();

            if(labour_qty == ""){
              labour_qty = 0;
            }
            if(labour_hour == ""){
              labour_hour = 0;
            }

            var result = labour_qty * labour_hour;
            if (!isNaN(result)) {
                $('.labour_cost2').val(Math.round(result));
            }
        }

        function sumsup(){
          var material_cost = $('.material_cost').val();
            var material_cost2 = $('.material_cost2').val();
            var material_cost3 = $('.material_cost3').val();
            var labour_cost = $('.labour_cost').val();
            var labour_cost2 = $('.labour_cost2').val();
            var other_cost = $('.other_cost').val();

            if(material_cost == ""){
              material_cost = 0;
            }
            else{
              material_cost = material_cost;
            }
            if(material_cost2 == ""){
              material_cost2 = 0;
            }
            else{
              material_cost2 = material_cost2;
            }
            if(material_cost3 == ""){
              material_cost3 = 0;
            }
            else{
              material_cost3 = material_cost3;
            }
            if(labour_cost == ""){
              labour_cost = 0;
            }
            else{
              labour_cost = labour_cost;
            }
            if(labour_cost2 == ""){
              labour_cost2 = 0;
            }
            else{
              labour_cost2 = labour_cost2;
            }
            if(other_cost == ""){
              other_cost = 0;
            }

            var result = parseInt(material_cost) + parseInt(material_cost2) + parseInt(material_cost3) + parseInt(labour_cost) +parseInt(labour_cost2) + parseInt(other_cost);
            if (!isNaN(result)) {
                $('.total_cost').val(Math.round(result));
            }
        }

                // Sum Value
    function addup() {
            var pay_deposit_made = document.getElementById('pay_deposit_made').value;
            var pay_cash_payment = document.getElementById('pay_cash_payment').value;
            var pay_cheque_payment_amount = document.getElementById('pay_cheque_payment_amount').value;
            var pay_card_amount = document.getElementById('pay_card_amount').value;
            var pay_total_bill_amount = document.getElementById('pay_total_bill_amount').value;

            if(pay_deposit_made == ""){
              pay_deposit_made = 0;
            }
            if(pay_cash_payment == ""){
              pay_cash_payment = 0;
            }
            if(pay_cheque_payment_amount == ""){
              pay_cheque_payment_amount = 0;
            }
            if(pay_card_amount == ""){
              pay_card_amount = 0;
            }

            var tots = parseInt(pay_cash_payment) + parseInt(pay_cheque_payment_amount) + parseInt(pay_card_amount);
            // var result1 = parseInt(num2) - parseInt(num1);
            if (!isNaN(tots)) {
                document.getElementById('pay_total_payment_made').value = tots;

                document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        // Sum Value
    function poaddup() {
            var purchase_order_totcost = document.getElementById('purchase_order_totcost').value;
            var purchase_order_shippingcost = document.getElementById('purchase_order_shippingcost').value;
            var purchase_order_discount = document.getElementById('purchase_order_discount').value;
            var purchase_order_othercost = document.getElementById('purchase_order_othercost').value;
            var purchase_order_tax = document.getElementById('purchase_order_tax').value;

            if(purchase_order_totcost == ""){
              purchase_order_totcost = 0;
            }
            if(purchase_order_shippingcost == ""){
              purchase_order_shippingcost = 0;
            }
            if(purchase_order_discount == ""){
              purchase_order_discount = 0;
            }
            if(purchase_order_othercost == ""){
              purchase_order_othercost = 0;
            }
            if(purchase_order_tax == ""){
              purchase_order_tax = 0;
            }

            var tots = parseInt(purchase_order_totcost) + parseInt(purchase_order_shippingcost) + parseInt(purchase_order_othercost);

            if (!isNaN(tots)) {
                var rem = tots - parseInt(purchase_order_discount);

                var res =  rem + parseInt(purchase_order_tax);

                document.getElementById('purchase_order_totalpurchaseorder').value = res.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        // Sum Value
    function payaddup() {
            var pay_tot_cost = document.getElementById('pay_tot_cost').value;
            var pay_shipping_cost = document.getElementById('pay_shipping_cost').value;
            var pay_discount = document.getElementById('pay_discount').value;
            var pay_othercosts = document.getElementById('pay_othercosts').value;
            var pay_tax = document.getElementById('pay_tax').value;
            var pay_po_total = document.getElementById('pay_po_total').value;
            var pay_advance = document.getElementById('pay_advance').value;

            if(pay_tot_cost == ""){
              pay_tot_cost = 0;
            }
            if(pay_shipping_cost == ""){
              pay_shipping_cost = 0;
            }
            if(pay_discount == ""){
              pay_discount = 0;
            }
            if(pay_othercosts == ""){
              pay_othercosts = 0;
            }
            if(pay_tax == ""){
              pay_tax = 0;
            }else{
              var addTax = 100 + parseInt(pay_tax);
              pay_tax = pay_tax / addTax;
            }
            if(pay_po_total == ""){
              pay_po_total = 0;
            }
            if(pay_advance == ""){
              pay_advance = 0;
            }

            var tots = pay_po_total - parseInt(pay_advance);

            if (!isNaN(tots)) {

                document.getElementById('pay_balance').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


        // Sum Value
    function grandaddup() {
            var cashamount = document.getElementById('pay_cashamount').value;
            var chequeamount = document.getElementById('pay_chequeamount').value;
            var cardamount = document.getElementById('pay_cardamount').value;

            if(cashamount == ""){
              cashamount = 0;
            }
            if(chequeamount == ""){
              chequeamount = 0;
            }
            if(cardamount == ""){
              cardamount = 0;
            }


            var tots = parseInt(cashamount) + parseInt(chequeamount) + parseInt(cardamount);

            if (!isNaN(tots)) {

                document.getElementById('pay_grandtotal').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


        // Sum Value
    function paylabouradd() {
            var hour = document.getElementById('pay_labour_labourhour').value;
            var rate = document.getElementById('pay_labour_labourrate').value;

            if(hour == ""){
              hour = 0;
            }
            if(rate == ""){
              rate = 0;
            }

            var tots = parseInt(hour) * parseInt(rate);

            if (!isNaN(tots)) {

                document.getElementById('pay_labour_paydue').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


        // Sum Value
    function paylabourstub1() {
            var cash = document.getElementById('pay_schedule_labourcashamount').value;
            var cheque = document.getElementById('pay_schedule_labourchequeamount').value;
            var card = document.getElementById('pay_schedule_labourcreditcardamount').value;

            if(cash == ""){
              cash = 0;
            }
            if(cheque == ""){
              cheque = 0;
            }
            if(card == ""){
              card = 0;
            }

            var tots = parseInt(cash) + parseInt(cheque) + parseInt(card);

            if (!isNaN(tots)) {

                document.getElementById('pay_schedule_labourtotalamount').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


        // Sum Value
    function paylabourstub2() {
            var deduction = document.getElementById('pay_stub_labourdeduction').value;
            var paydue = document.getElementById('pay_stub_labourpaydue').value;
            var balance = document.getElementById('pay_stub_labourbalance').value;

            if(deduction == ""){
              deduction = 0;
            }
            if(paydue == ""){
              paydue = 0;
            }

            var tots = parseInt(paydue) - parseInt(deduction);

            if (!isNaN(tots)) {

                document.getElementById('pay_stub_labourbalance').value = tots.toFixed(2);
                document.getElementById('pay_stub_labourtotalpay').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

                // Sum Value
    function paylabourstub3() {
            var cash = document.getElementById('pay_stub_labourcashamount').value;
            var cheque = document.getElementById('pay_stub_labourchequeamount').value;
            var card = document.getElementById('pay_stub_labourcreditcardamount').value;

            if(cash == ""){
              cash = 0;
            }
            if(cheque == ""){
              cheque = 0;
            }
            if(card == ""){
              card = 0;
            }

            var tots = parseInt(cash) + parseInt(cheque) + parseInt(card);

            if (!isNaN(tots)) {

                document.getElementById('pay_stub_labourtotalamount').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


        // Sum Value
    function labourgenaddup() {
            var hourly_rate = document.getElementById('addlabour_hourly_rate').value;
            var budgeted_hours = document.getElementById('addlabour_budgeted_hours').value;

            if(hourly_rate == ""){
              hourly_rate = 0;
            }
            if(budgeted_hours == ""){
              budgeted_hours = 0;
            }

            var tots = parseInt(hourly_rate) * parseInt(budgeted_hours);

            if (!isNaN(tots)) {

                document.getElementById('addlabour_total_costs').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


                // Sum Value
    function po_qtyRate() {
            var qty = document.getElementById('purchase_order_qty').value;
            var rate = document.getElementById('purchase_order_rate').value;

            if(qty == ""){
              qty = 0;
            }
            if(rate == ""){
              rate = 0;
            }

            var tots = parseInt(qty) * parseInt(rate);

            if (!isNaN(tots)) {

                document.getElementById('purchase_order_totcost').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


                        // Sum Value
    function payVendor_qtyRate() {
            var qty = document.getElementById('pay_quantity').value;
            var rate = document.getElementById('pay_rate').value;

            if(qty == ""){
              qty = 0;
            }
            if(rate == ""){
              rate = 0;
            }

            var tots = parseInt(qty) * parseInt(rate);

            if (!isNaN(tots)) {

                document.getElementById('pay_tot_cost').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


                               // Sum Value
    function addpart_qtyrate() {
            var qty = document.getElementById('items_qty').value;
            var rate = document.getElementById('items_unit_cost').value;

            if(qty == ""){
              qty = 0;
            }
            if(rate == ""){
              rate = 0;
            }

            var tots = parseInt(qty) * parseInt(rate);

            if (!isNaN(tots)) {

                document.getElementById('items_total_cost').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addpart_unitprice(){
            var mark_up = document.getElementById('item_total_mark_up').value;
            var tot_cost = document.getElementById('items_total_cost').value;
            var discount = document.getElementById('item_total_discount').value;

            if(tot_cost == ""){
              tot_cost = 0;
            }
            else{
              tot_cost = tot_cost;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up;

            }if(discount == ""){
              discount = 0;
            }
            else{
              discount = discount;

            }

            var tots = (parseInt(tot_cost) - (parseInt(discount))) + parseInt(mark_up);

            if (!isNaN(tots)) {

                document.getElementById('item_unit_price').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addpart_discount(){
            var discount = document.getElementById('item_discount').value;
            var unit_cost = document.getElementById('items_total_cost').value;

            if(discount == ""){
              discount = 0;
            }
            else{
              discount = discount / 100;
            }
            if(unit_cost == ""){
              unit_cost = 0;
            }
            else{
                unit_cost = unit_cost;
            }

            var tots = unit_cost * discount;

            if (!isNaN(tots)) {

                document.getElementById('item_total_discount').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addpart_markup(){
            var mark_up = document.getElementById('item_mark_up').value;
            var unit_cost = document.getElementById('items_total_cost').value;

            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(unit_cost == ""){
              unit_cost = 0;
            }
            else{
                unit_cost = unit_cost;
            }

            var tots = unit_cost * mark_up;

            if (!isNaN(tots)) {

                document.getElementById('item_total_mark_up').value = tots.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addpart_taxrate(){
            var tax = document.getElementById('item_tax_rate').value;
            var unit_price = document.getElementById('item_unit_price').value;

            if(tax == ""){
              tax = 0;
            }
            else{
              tax = tax / 100;
            }
            if(unit_price == ""){
              unit_price = 0;
            }
            else{
                unit_price = unit_price;
            }

            var tax_rate = 1 + tax;

            var tots = (tax_rate * unit_price);

            // console.log('Total Result:=> ' +tots+' , Unit Price:=> '+unit_price);

            if (!isNaN(tots)) {

                document.getElementById('item_total_taxrate').value = tots.toFixed(2);
                document.getElementById('item_total_price').value = tots.toFixed(2);
                document.getElementById('part_cost').value = Math.round(tots);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        // function addpart_totprice(){

        //     var tot_tax_rate = document.getElementById('item_tax_rate').value;
        //     var unit_price = document.getElementById('item_unit_price').value;


        //     if(tot_tax_rate == ""){
        //       tot_tax_rate = 0;
        //     }
        //     else{
        //       tot_tax_rate = tot_tax_rate;
        //     }

        //     if(unit_price == ""){
        //       unit_price = 0;
        //     }
        //     else{
        //       unit_price = unit_price;
        //     }


        //     // var tots = ((initial1 - initial3) * initial2) + (initial1 - initial3);
        //     var tots = parseInt(tot_tax_rate);

        //     if (!isNaN(tots)) {

        //         document.getElementById('item_total_price').value = tots.toFixed(2);
        //         document.getElementById('part_cost').value = Math.round(tots);

        //         // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
        //     }
        // }

        function addmaterial1(){
            var unit_cost = document.getElementById('material_unit_cost').value;
            var mark_up = document.getElementById('material_markup').value;
            var qty = document.getElementById('material_qty').value;
            var price = document.getElementById('material_price').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost').value = tots.toFixed(2);
                document.getElementById('material_price').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }


        function addmaterial2(){
            var unit_cost = document.getElementById('material_unit_cost2').value;
            var mark_up = document.getElementById('material_markup2').value;
            var qty = document.getElementById('material_qty2').value;
            var price = document.getElementById('material_price2').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost2').value = tots.toFixed(2);
                document.getElementById('material_price2').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial3(){
            var unit_cost = document.getElementById('material_unit_cost3').value;
            var mark_up = document.getElementById('material_markup3').value;
            var qty = document.getElementById('material_qty3').value;
            var price = document.getElementById('material_price3').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost3').value = tots.toFixed(2);
                document.getElementById('material_price3').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial4(){
            var unit_cost = document.getElementById('material_unit_cost4').value;
            var mark_up = document.getElementById('material_markup4').value;
            var qty = document.getElementById('material_qty4').value;
            var price = document.getElementById('material_price4').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost4').value = tots.toFixed(2);
                document.getElementById('material_price4').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial5(){
            var unit_cost = document.getElementById('material_unit_cost5').value;
            var mark_up = document.getElementById('material_markup5').value;
            var qty = document.getElementById('material_qty5').value;
            var price = document.getElementById('material_price5').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost5').value = tots.toFixed(2);
                document.getElementById('material_price5').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial6(){
            var unit_cost = document.getElementById('material_unit_cost6').value;
            var mark_up = document.getElementById('material_markup6').value;
            var qty = document.getElementById('material_qty6').value;
            var price = document.getElementById('material_price6').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost6').value = tots.toFixed(2);
                document.getElementById('material_price6').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial7(){
            var unit_cost = document.getElementById('material_unit_cost7').value;
            var mark_up = document.getElementById('material_markup7').value;
            var qty = document.getElementById('material_qty7').value;
            var price = document.getElementById('material_price7').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost7').value = tots.toFixed(2);
                document.getElementById('material_price7').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial8(){
            var unit_cost = document.getElementById('material_unit_cost8').value;
            var mark_up = document.getElementById('material_markup8').value;
            var qty = document.getElementById('material_qty8').value;
            var price = document.getElementById('material_price8').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost8').value = tots.toFixed(2);
                document.getElementById('material_price8').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial9(){
            var unit_cost = document.getElementById('material_unit_cost9').value;
            var mark_up = document.getElementById('material_markup9').value;
            var qty = document.getElementById('material_qty9').value;
            var price = document.getElementById('material_price9').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost9').value = tots.toFixed(2);
                document.getElementById('material_price9').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }

        function addmaterial10(){
            var unit_cost = document.getElementById('material_unit_cost10').value;
            var mark_up = document.getElementById('material_markup10').value;
            var qty = document.getElementById('material_qty10').value;
            var price = document.getElementById('material_price10').value;

            if(unit_cost == ""){
              unit_cost = 0;
            }
            if(mark_up == ""){
              mark_up = 0;
            }
            else{
              mark_up = mark_up / 100;
            }
            if(qty == ""){
              qty = 0;
            }
            if(price == ""){
              price = 0;
            }
            else{
              price = parseInt(unit_cost) + (parseInt(unit_cost) * mark_up);
            }

            var tots = parseInt(qty) * price;

            if (!isNaN(tots)) {

                document.getElementById('material_cost10').value = tots.toFixed(2);
                document.getElementById('material_price10').value = price.toFixed(2);

                // document.getElementById('pay_additional_payment').value = parseInt(pay_total_bill_amount) - parseInt(pay_deposit_made);
            }
        }



//         function numberWithCommas(x) {
//     return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// }

function authCheck(val){
      // Check for Required Fields on Registration


        var firstname;
        var lastname;
        var email;
        var userType;
        var phone_number;
        var state;
        var country;
        var zipcode;
        var password;
        var cpassword;
        var maiden_name;
        var parent_meet;
        var plan;
        var market_place;
        var city;

        var route = "{{ URL('Ajax/checkuserRegistration') }}";
      var thisdata;

    if(val == "individual"){

        firstname = $("#firstnameez").val();
        lastname = $("#lastnameez").val();
        email = $("#emaileez").val();
        userType = $("#userType").val();
        phone_number = $("#phone_numbereez").val();
        state = $("#stateez").val();
        country = $("#countryeez").val();
        zipcode = $("#zipcode").val();
        password = $("#passwordeez").val();
        cpassword = $("#password-confirmeez").val();
        maiden_name = $("#maiden_nameez").val();
        parent_meet = $("#parent_meeteez").val();
        plan = $("#plan").val();
        referred_by = $("#referred_by").val();
        vehicle_licence = $("#vehicle_licenceA").val();
        vehicle_nickname = $("#vehicle_nicknameA").val();
        vehicle_model = $("#vehicle_modelA").val();
        vehicle_make = $("#vehicle_makeA").val();
        purchase_type = $("#purchase_typeA").val();
        year_owned_since = $("#year_owned_sinceA").val();
        mileage = $("#current_mileageA").val();
        city = $("#city").val();

        thisdata = {email: email, telephone: phone_number, vehicle_licence: vehicle_licence, city: city, state: state, country: country, zipcode: zipcode, vehicle_licence: vehicle_licence, vehicle_nickname: vehicle_nickname, vehicle_model: vehicle_model, vehicle_make: vehicle_make, purchase_type: purchase_type, year_owned_since: year_owned_since, mileage: mileage};

        if(firstname == ""){
          swal('Oops', 'Firstname Field can\'t be Empty', 'info');
          return false;
        }else if(lastname == ""){
          swal('Oops', 'Lastname Field can\'t be Empty', 'info');
          return false;
        }else if(email == ""){
          swal('Oops', 'Email Field can\'t be Empty', 'info');
          return false;
        }else if(userType == ""){
          swal('Oops', 'Usertype Field can\'t be Empty', 'info');
          return false;
        }
        else if(phone_number == ""){
          swal('Oops', 'Phone Number Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_licence == ""){
          swal('Oops', 'Vehicle Licence Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_model == ""){
          swal('Oops', 'Vehicle Model Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_nickname == ""){
          swal('Oops', 'Vehicle Nickname Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_make == ""){
          swal('Oops', 'Vehicle Make Field can\'t be Empty', 'info');
          return false;
        }
        else if(purchase_type == ""){
          swal('Oops', 'Select your purchase type', 'info');
          return false;
        }
        else if(year_owned_since == ""){
          swal('Oops', 'Select year owned', 'info');
          return false;
        }
        else if(mileage == ""){
          swal('Oops', 'Current mileage Field can\'t be Empty', 'info');
          return false;
        }
        else if(state == ""){
          swal('Oops', 'State Field can\'t be Empty', 'info');
          return false;
        }else if(country == ""){
          swal('Oops', 'Country Field can\'t be Empty', 'info');
          return false;
        }else if(zipcode == ""){
          swal('Oops', 'Zip code Field can\'t be Empty', 'info');
          return false;
        }else if(password == ""){
          swal('Oops', 'Password Field can\'t be Empty', 'info');
          return false;
        }else if(cpassword == ""){
          swal('Oops', 'Confirm Password Field can\'t be Empty', 'info');
          return false;
        }
        else if(plan == ""){
          swal('Oops', 'Please select a plan', 'info');
          return false;
        }

        else if(password != cpassword){
          swal('Error!', 'Password mis-match', 'error');
          return false;
        }else{

            setHeaders();
            jQuery.ajax({
            url: route,
            method: 'post',
            data: thisdata,
            dataType: 'JSON',
            beforeSend: function(){
              $("#signupfree").text('Please wait for authentication...');
            },
            success: function(result){
                // alert("Done");
                if(result.message == "success"){
                    $("#signupfree").text('Sign Up for FREE');
                    $("#register").submit();
                }
                else{
                    $("#signupfree").text('Sign Up for FREE');
                    swal("Oops!", result.res, result.message);
                }

            }

          });


        }

    }
    else if(val == "commercial"){

        firstname = $("#firstnameezcom").val();
        lastname = $("#lastnameezcom").val();
        email = $("#emaileezcom").val();
        userType = $("#userTypecom").val();
        phone_number = $("#phone_numbereezcom").val();
        state = $("#stateezcom").val();
        country = $("#countryeezcom").val();
        zipcode = $("#zipcodecom").val();
        password = $("#passwordeezcom").val();
        cpassword = $("#password-confirmeezcom").val();
        maiden_name = $("#maiden_nameezcom").val();
        parent_meet = $("#parent_meeteezcom").val();
        plan = $("#plancom").val();
        market_place = $("#market_place").val();
        referred_bycom = $("#referred_bycom").val();
        vehicle_licence = $("#vehicle_licenceB").val();
        vehicle_nickname = $("#vehicle_nicknameB").val();
        vehicle_model = $("#vehicle_modelB").val();
        vehicle_make = $("#vehicle_makeB").val();
        purchase_type = $("#purchase_typeB").val();
        year_owned_since = $("#year_owned_sinceB").val();
        mileage = $("#current_mileageB").val();
        city = $("#citycom").val();

        thisdata = {email: email, telephone: phone_number, vehicle_licence: vehicle_licence, city: city, state: state, country: country, zipcode: zipcode, vehicle_licence: vehicle_licence, vehicle_nickname: vehicle_nickname, vehicle_model: vehicle_model, vehicle_make: vehicle_make, purchase_type: purchase_type, year_owned_since: year_owned_since, mileage: mileage};

        if(firstname == ""){
          swal('Oops', 'Firstname Field can\'t be Empty', 'info');
          return false;
        }else if(lastname == ""){
          swal('Oops', 'Lastname Field can\'t be Empty', 'info');
          return false;
        }else if(email == ""){
          swal('Oops', 'Email Field can\'t be Empty', 'info');
          return false;
        }else if(userType == ""){
          swal('Oops', 'Usertype Field can\'t be Empty', 'info');
          return false;
        }
        else if(phone_number == ""){
          swal('Oops', 'Phone Number Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_licence == ""){
          swal('Oops', 'Vehicle Licence Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_model == ""){
          swal('Oops', 'Vehicle Model Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_nickname == ""){
          swal('Oops', 'Vehicle Nickname Field can\'t be Empty', 'info');
          return false;
        }
        else if(vehicle_make == ""){
          swal('Oops', 'Vehicle Make Field can\'t be Empty', 'info');
          return false;
        }
        else if(purchase_type == ""){
          swal('Oops', 'Select your purchase type', 'info');
          return false;
        }
        else if(year_owned_since == ""){
          swal('Oops', 'Select year owned', 'info');
          return false;
        }
        else if(mileage == ""){
          swal('Oops', 'Current mileage Field can\'t be Empty', 'info');
          return false;
        }
        else if(state == ""){
          swal('Oops', 'State Field can\'t be Empty', 'info');
          return false;
        }else if(country == ""){
          swal('Oops', 'Country Field can\'t be Empty', 'info');
          return false;
        }else if(zipcode == ""){
          swal('Oops', 'Zip code Field can\'t be Empty', 'info');
          return false;
        }else if(password == ""){
          swal('Oops', 'Password Field can\'t be Empty', 'info');
          return false;
        }else if(cpassword == ""){
          swal('Oops', 'Confirm Password Field can\'t be Empty', 'info');
          return false;
        }
        else if(plan == ""){
          swal('Oops', 'Please select a plan', 'info');
          return false;
        }

        else if(password != cpassword){
          swal('Error!', 'Password mis-match', 'error');
          return false;
        }else{
            setHeaders();
            jQuery.ajax({
            url: route,
            method: 'post',
            data: thisdata,
            dataType: 'JSON',
            beforeSend: function(){
              $("#signupcomfree").text('Please wait for authentication...');
            },
            success: function(result){
                // alert("Done");
                if(result.message == "success"){
                    $("#signupcomfree").text('Sign Up for FREE');
                    $("#registercom").submit();
                }
                else{
                    $("#signupcomfree").text('Sign Up for FREE');
                    swal("Oops!", result.res, result.message);
                }

            }

          });


        }

    }

}



    function addVehicle(val,plan){

        if(val == "new"){
      route = "{{URL('Ajax/Newvehicle')}}";

      // Check Important Fields
      if($("#email").val() == "" || $("#telephone").val() == "" || $("#vehicle_licence").val() == "" || $("#date").val() == "" || $("#modelz").val() == "" || $("#service_type").val() == "" || $("#service_option").val() == "" || $("#service_item_spec").val() == "" || $("#manufacturer").val() == "" || $("#material_qty").val() == "" || $("#material_cost").val() == "" || $("#labour_qty").val() == "" || $("#labour_cost").val() == "" || $("#other_qty").val() == "" || $("#other_cost").val() == "" || $("#total_cost").val() == "" || $("#mileage").val() == "")
      {
        swal('Oops', 'Kindly Fill Required Fields', 'info');
      }
      else{
              var formData = new FormData();

      var fileSelect = document.getElementById("file");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("file", file , file.name);
       }

      formData.append("email", $("#email").val());
      formData.append("telephone", $("#telephone").val());
      formData.append("busID", $("#businessID").val());
      formData.append("make", $("#make").val());
      formData.append("model", $("#modelz").val());
      formData.append("vehicle_licence", $("#vehicle_licence").val());
      formData.append("date", $("#date").val());
      formData.append("service_type", $("#service_type").val());
      formData.append("service_option", $("#service_option").val());
      formData.append("service_item_spec", $("#service_item_spec").val());
      formData.append("service_item_spec2", $("#service_item_spec2").val());
      formData.append("service_item_spec3", $("#service_item_spec3").val());
      formData.append("manufacturer", $("#manufacturer").val());
      formData.append("manufacturer2", $("#manufacturer2").val());
      formData.append("manufacturer3", $("#manufacturer3").val());
      formData.append("material_qty", $("#material_qty").val());
      formData.append("material_qty2", $("#material_qty2").val());
      formData.append("material_qty3", $("#material_qty3").val());
      formData.append("material_cost", $("#material_cost").val());
      formData.append("material_cost2", $("#material_cost2").val());
      formData.append("material_cost3", $("#material_cost3").val());
      formData.append("labour_qty", $("#labour_qty").val());
      formData.append("labour_qty2", $("#labour_qty2").val());
      formData.append("labour_cost", $("#labour_cost").val());
      formData.append("labour_cost2", $("#labour_cost2").val());
      formData.append("other_qty", $("#other_qty").val());
      formData.append("other_cost", $("#other_cost").val());
      formData.append("total_cost", $("#total_cost").val());
      formData.append("service_note", $("#service_note").val());
      formData.append("mileage", $("#mileage").val());
      formData.append("update_by", $("#update_by").val());

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
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
            // alert("Done");
            $(".spinner").addClass('disp-0');
            swal("Saved!", result.res, result.message);
            // alert(result.res);
          setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
      }




    }
    else if(val == "regnew"){
      route = "{{URL('Ajax/Carrecord')}}";


      // Check Important Fields
      if($("#useremail").val() == "" || $("#telphone").val() == "" || $("#vehicle_nickname").val() == "" || $("#date_added").val() == "" || $("#vehicle_make").val() == "" || $("#model").val() == "" || $("#vehicle_reg_no").val() == "" || $("#cityz").val() == "" || $("#cityz").val() == "" || $("#country_of_reg").val() == "" || $("#purchase_type").val() == "" || $("#year_owned_since").val() == "" || $("#current_mileage").val() == "" || $("#zipycode").val() == "")
      {
        swal('Oops', 'Kindly Fill Required Fields', 'info');
      }
      else{

      var formData = new FormData();

      var fileSelect = document.getElementById("file");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("file", file , file.name);
       }

      formData.append("busID", $("#buszIDz").val());
      formData.append("email", $("#useremail").val());
      formData.append("telephone", $("#telphone").val());
      formData.append("parentKey", $("#parentKey").val());
      formData.append("no_of_vehicle", $("#no_of_vehicle").val());
      formData.append("vehicle_nickname", $("#vehicle_nickname").val());
      formData.append("date_added", $("#date_added").val());
      formData.append("vehicle_make", $("#vehicle_make").val());
      formData.append("model", $("#model").val());
      formData.append("vehicle_reg_no", $("#vehicle_reg_no").val());
      formData.append("vehicle_vin_number", $("#vehicle_vin_number").val());
      formData.append("city", $("#cityz").val());
      formData.append("state", $("#statez").val());
      formData.append("zipcode", $("#zipycode").val());
      formData.append("country_of_reg", $("#country_of_reg").val());
      formData.append("purchase_type", $("#purchase_type").val());
      formData.append("year_owned_since", $("#year_owned_since").val());
      formData.append("current_mileage", $("#current_mileage").val());
      formData.append("firstname", $("#regFirstname").val());
      formData.append("lastname", $("#regLastname").val());
      formData.append("password", $("#regPassword").val());

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
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
            // alert("Done");
            $(".spinner").addClass('disp-0');
            swal("Saved!", result.res, result.message);
            // alert(result.res);
          setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
      }

    }

    else if(val == "reganother"){

      if(plan == 'Free'){

        swal({
          title: "You have to upgrade your account.",
          text: "Check Pricing?",
          icon: "info",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            setTimeout(function(){ location.href = 'pricing'; }, 1000);
          }
        });


      }
      else{

    route = "{{URL('Ajax/Carrecord')}}";

    var formData = new FormData();

      var fileSelect = document.getElementById("file");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("file", file , file.name);
       }
        swal({
          title: "Is this a family to "+$("#vehicle_make").val(),
          text: "If yes, click OK and make a selection in the form. Else you can proceed with a CANCEL",
          icon: "info",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            // Check Important Fields
      if($("#vehicle_nickname").val() == "" || $("#date_added").val() == "" || $("#vehicle_make").val() == "" || $("#model").val() == "" || $("#vehicle_reg_no").val() == "" || $("#statez").val() == "" || $("#country_of_reg").val() == "" || $("#purchase_type").val() == "" || $("#year_owned_since").val() == "" || $("#current_mileage").val() == "" || $("#zipycode").val() == "")
      {
        swal('Oops', 'Kindly Fill Required Fields', 'info');
      }
      else{
        formData.append("busID", $("#buszIDz").val());
        formData.append("email", $("#useremail").val());
        formData.append("telephone", $("#telphone").val());
      formData.append("parentKey", $("#parentKey").val());
      formData.append("no_of_vehicle", $("#no_of_vehicle").val());
      formData.append("vehicle_nickname", $("#vehicle_nickname").val());
      formData.append("date_added", $("#date_added").val());
      formData.append("vehicle_make", $("#vehicle_make").val());
      formData.append("model", $("#model").val());
      formData.append("vehicle_reg_no", $("#vehicle_reg_no").val());
      formData.append("vehicle_vin_number", $("#vehicle_vin_number").val());
      formData.append("state", $("#statez").val());
      formData.append("zipcode", $("#zipycode").val());
      formData.append("country_of_reg", $("#country_of_reg").val());
      formData.append("vehicle_make", $("#vehicle_make").val());
      formData.append("purchase_type", $("#purchase_type").val());
      formData.append("year_owned_since", $("#year_owned_since").val());
      formData.append("current_mileage", $("#current_mileage").val());

      setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(result){
            $("#formReg")[0].reset();
            $(".navMain, .navReg").toggleClass('active');
        }

      });
      }


          } else {

            if($("#vehicle_nickname").val() == "" || $("#date_added").val() == "" || $("#vehicle_make").val() == "" || $("#model").val() == "" || $("#vehicle_reg_no").val() == "" || $("#statez").val() == "" || $("#country_of_reg").val() == "" || $("#purchase_type").val() == "" || $("#year_owned_since").val() == "" || $("#current_mileage").val() == "" || $("#zipycode").val() == "")
      {
        swal('Oops', 'Kindly Fill Required Fields', 'info');
      }
      else{
        formData.append("email", $("#useremail").val());
      formData.append("parentKey", $("#parentKey").val());
      formData.append("no_of_vehicle", $("#no_of_vehicle").val());
      formData.append("vehicle_nickname", $("#vehicle_nickname").val());
      formData.append("date_added", $("#date_added").val());
      formData.append("vehicle_make", $("#vehicle_make").val());
      formData.append("model", $("#model").val());
      formData.append("vehicle_reg_no", $("#vehicle_reg_no").val());
      formData.append("state", $("#statez").val());
      formData.append("zipcode", $("#zipycode").val());
      formData.append("country_of_reg", $("#country_of_reg").val());
      formData.append("vehicle_make", $("#vehicle_make").val());
      formData.append("purchase_type", $("#purchase_type").val());
      formData.append("year_owned_since", $("#year_owned_since").val());
      formData.append("current_mileage", $("#current_mileage").val());


      setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(result){
            swal("Saved!", result.res, result.message);
          setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
      }


          }
        });

      }





    }




    }


    function addSettings(val){

        var route = "";
        if(val == "additionalEmail"){
            route = "{{ URL('Ajax/Additionalemail') }}";
            var formData = new FormData();

          formData.append("email", $("#mainemail").val());
          formData.append("email1", $("#email1").val());
          formData.append("email2", $("#email2").val());
          formData.append("email3", $("#email3").val());

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
          $('.spinner').removeClass('disp-0');
        },
        success: function(result){
          $('.spinner').addClass('disp-0');
            if (result.message == "success") {
                iziToast.success({
                  title: 'Saved',
                  message: result.res,
              });
            }
            else
            {
                swal("Oops!", result.res, result.message);
            }

        }

      });
    }

    if(val == "reminderSettings"){

        route = "{{ URL('Ajax/Remindersettings') }}";
            var formData = new FormData();

            formData.append("pryemail", $('.authMail').text());
          formData.append("notifyoil", $("#notifyoil").val());
          formData.append("notifyair", $("#notifyair").val());
          formData.append("notifytyre", $("#notifytyre").val());
          formData.append("notifyinspect", $("#notifyinspect").val());
          formData.append("notifyregister", $("#notifyregister").val());

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
          $('.spinner').removeClass('disp-0');
        },
        success: function(result){
          $('.spinner').addClass('disp-0');
            if (result.message == "success") {
                iziToast.success({
                  title: 'Saved',
                  message: result.res,
              });
            }
            else
            {
                swal("Oops!", result.res, result.message);
            }

        }

      });

    }
    if(val == "reminderbusSettings"){

        route = "{{ URL('Ajax/Addreminderbussettings') }}";
            var formData = new FormData();

          formData.append("remEmail", $("#remEmail").val());
          formData.append("notifyoil", $("#notifyoil").val());
          formData.append("notifyair", $("#notifyair").val());
          formData.append("notifytyre", $("#notifytyre").val());
          formData.append("notifyinspect", $("#notifyinspect").val());
          formData.append("notifyregister", $("#notifyregister").val());

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
          $('.spinner').removeClass('disp-0');
        },
        success: function(result){
          $('.spinner').addClass('disp-0');
            if (result.message == "success") {
                iziToast.success({
                  title: 'Saved',
                  message: result.res,
              });

                setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else
            {
                swal("Oops!", result.res, result.message);
            }

        }

      });

    }

    if(val == "additionalbusEmail"){

        route = "{{ URL('Ajax/Reminderbussettings') }}";
            var formData = new FormData();

          formData.append("majoremail", $("#majoremail").val());
          formData.append("majoremail1", $("#majoremail1").val());
          formData.append("majoremail2", $("#majoremail2").val());
          formData.append("majoremail3", $("#majoremail3").val());

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
          $('.spinner').removeClass('disp-0');
        },
        success: function(result){
          $('.spinner').addClass('disp-0');
            if (result.message == "success") {
                iziToast.success({
                  title: 'Saved',
                  message: result.res,
              });

                setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else
            {
                swal("Oops!", result.res, result.message);
            }

        }

      });

    }

    if(val == "vehicleinfo"){

        route = "{{ URL('Ajax/Vehiclesettings') }}";
            var formData = new FormData();
            var pos = $("#positionzz").val();
            var fileSelect = document.getElementById("filess"+pos);

          if(fileSelect.files && fileSelect.files.length == 1){
             var file = fileSelect.files[0]
             formData.set("file", file , file.name);
           }

          formData.append("pryemail", $('.authMail').text());
          formData.append("vehicle_reg_nosss", $("#vehicle_reg_nosss").val());
          formData.append("positionzz", pos);
          formData.append("chassiss_no", $("#chassiss_no").val());
          formData.append("locationss", $("#locationss").val());

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
          $('.spinner').removeClass('disp-0');
        },
        success: function(result){
          $('.spinner').addClass('disp-0');
            if (result.message == "success") {
                iziToast.success({
                  title: 'Saved',
                  message: result.res,
              });
            }
            else
            {
                swal("Oops!", result.res, result.message);
            }

        }

      });

    }
}

// Search by Licence
function licenceSearch(){

    $("#licencesearch").text('Loading...');
    var route = "{{ URL('Ajax/LicenseSearch') }}";
    var thisdata = {vehicle_licence: $("#licences").val()}

    $("tbody#list").html("");

    if($("#licences").val() == ""){
      swal('Oops', 'Enter vehicle licence number to search', 'error');
      $("#licencesearch").text('Search');
    }
    else{
          setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
            $("#licencesearch").text('Search');
            $("#licences").val('');
            if (result.message == "success") {
                var res = JSON.parse(result.data);
                var file; var make; var model; var mileage; var service_option; var service_type; var service_item_spec;
                var manufacturer; var material_cost; var labour_cost; var other_cost; var total_cost; var service_note; var update_by; var payment; var pay_status; var estimate_id; var country = '<?php if(Auth::user()){ echo Auth::user()->country;}?>'; var base;
                $.each(res, function(v,k){
                    file = k.file; make = k.make; mileage = k.mileage; service_option = k.service_option; service_type = k.service_type;
                    service_item_spec = k.service_item_spec; manufacturer = k.manufacturer; material_cost = k.material_cost; labour_cost = k.labour_cost; other_cost = k.other_cost; total_cost = k.total_cost; service_note = k.service_note; update_by = k.update_by; payment = k.payment; estimate_id = k.estimate_id; base = k.country;

                    if(payment == '2'){
                          pay_status = "PAID";
                        }
                        else if(payment == '1'){
                          pay_status = "NOT PAID";
                        }
                        else{
                          pay_status = "";
                        }

                        if(estimate_id == null){
                          view_more = "#";
                          views = "<a href='#' class='text-center'>-</a>";
                        }
                        else{
                          view_more = "/invoicereport/"+estimate_id;
                          views = "<a title='View More' style='font-size: 11px; font-weight: bold; color: darkblue;' href='"+view_more+"' target='_blank'><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;'></i></a>";
                        }

                    if(file != "noImage.png"){
                            $("tbody#list").append("<tr style='font-size: 11px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.date +"</td><td>"+ k.service_type +"</td><td>"+k.service_option+"</td><td>"+ k.total_cost +"</td><td>"+ k.service_note +"</td><td>"+ k.mileage +"</td><td><a style='font-size: 11px;' href='/uploads/"+ k.file +"' target='_blank'>Open file</a></td><td>"+ k.update_by +", ["+k.name_of_company+"]</td><td>"+ pay_status +"</td><td>"+views+"</td><tr>");


                    }else{
                            $("tbody#list").append("<tr style='font-size: 11px;'><td>"+(v+1)+"</td><td>"+ k.vehicle_licence +"</td><td>"+k.date+"</td><td>"+ k.service_type +"</td><td>"+k.service_option+"</td><td>"+ k.total_cost +"</td><td>"+ k.service_note +"</td><td>"+ k.mileage +"</td><td>No attachment</td><td>"+ k.update_by +", ["+k.name_of_company+"]</td><td>"+ pay_status +"</td><td>"+views+"</td><tr>");



                    }

                });

            }
            else
            {
               $("tbody#list").append("<tr style='font-size: 12px;'><td colspan='17' align='center'>"+ result.res +"</td><tr>");
            }

        }

      });
    }


}

$("#userType").change(function(){
  if($("#userType").val() == "Commercial"){
    $(".market_box").removeClass('disp-0');
    $(".dropPlan").addClass('disp-0');
    $(".refer").addClass('disp-0');
  }
  else{
    $(".market_box").addClass('disp-0');
    $(".dropPlan").removeClass('disp-0');
    $(".refer").removeClass('disp-0');
  }

});


$('#accountType').change(function(){
    if($('#accountType').val() == "Certified Professional"){
        $('.coyname').addClass('disp-0');
        $("#name_of_company").val('n/a');
        $('.coyaddress').addClass('disp-0');
        $("#address").val('n/a');
        $('.mypositions').addClass('disp-0');
        $('.practice').removeClass('disp-0');
        $("#position").val('n/a');
        $("#planz").val('Start Up');
        $("#usernamez").val('n/a');
        $('.trade_doc').removeClass('disp-0');
        $('.certifiedInfo').removeClass('disp-0');
        $('.incorp_doc').addClass('disp-0');
        $('.bizcustom').addClass('disp-0');
        $('.usernames').addClass('disp-0');
        $("#station_namez").val('');
        $("#station_addrez").val('');
    }
    else{
        $('.coyname').removeClass('disp-0');
        $('.coyaddress').removeClass('disp-0');
        $('.mypositions').removeClass('disp-0');
        $('.practice').addClass('disp-0');
        $('.certifiedInfo').addClass('disp-0');
        $('.trade_doc').addClass('disp-0');
        $('.usernames').removeClass('disp-0');
        $("#name_of_company").val('');
        $("#address").val('');
        $("#position").val('');
        $("#planz").prop('selectedIndex',0);
        $("#usernamez").val('');
        $("#station_namez").val('n/a');
        $("#station_addrez").val('n/a');
    }
});


function loginProcess(purpose,val){


    var route = "{{ URL('Ajax/AdminLogin') }}";

     var formData = new FormData();

    if(purpose == "Registration" && val == "Business"){

        // Check Password match
        if($("#passwordz").val() != $("#password-confirmz").val()){
            swal('Oops', 'Password mis-match', 'error');
            return false;
        }
        else if($("#name_of_company").val() == ""){
          swal('Oops', 'Company Name Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#employeeSize").val() == ""){
          swal('Oops', 'Please select employee size', 'info');
          return false;
        }
        else if($("#accountType").val() == ""){
          swal('Oops', 'Please select type of business', 'info');
          return false;
        }
        else if($("#address").val() == ""){
          swal('Oops', 'Company Address Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#cityz").val() == ""){
          swal('Oops', 'City Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#statez").val() == ""){
          swal('Oops', 'State Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#countryz").val() == ""){
          swal('Oops', 'Country Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#zipcodez").val() == ""){
          swal('Oops', 'Zip Code Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#firstnamez").val() == ""){
          swal('Oops', 'Firstname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#lastnamez").val() == ""){
          swal('Oops', 'Lastname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#usernamez").val() == ""){
          swal('Oops', 'Username Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#emailz").val() == ""){
          swal('Oops', 'Email Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#position").val() == ""){
          swal('Oops', 'Position Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#telephone").val() == ""){
          swal('Oops', 'Telephone Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#planz").val() == ""){
          swal('Oops', 'Please select a plan', 'info');
          return false;
        }
        else if($("#station_namez").val() == ""){
          swal('Oops', 'Please provide station name', 'info');
          return false;
        }
        else if($("#station_addrez").val() == ""){
          swal('Oops', 'Please provide station address', 'info');
          return false;
        }
        else{

        var fileSelect = document.getElementById("file");
          if(fileSelect.files && fileSelect.files.length == 1){
             var file = fileSelect.files[0]
             formData.set("file", file , file.name);
           }
       var fileSelect2 = document.getElementById("file2");
           if(fileSelect2.files && fileSelect2.files.length == 1){
             var file = fileSelect2.files[0]
             formData.set("file2", file , file.name);
           }
            formData.append("purpose", purpose);
            formData.append("userType", $("#userTypebis").val());
            formData.append("userID", $("#userID").val());
            formData.append("employeeSize", $("#employeeSize").val());
            formData.append("busID", $("#busID").val());
            formData.append("name_of_company", $("#name_of_company").val());
            formData.append("address", $("#address").val());
            formData.append("accountType", $("#accountType").val());
            formData.append("city", $("#cityz").val());
            formData.append("state", $("#statez").val());
            formData.append("country", $("#countryz").val());
            formData.append("zipcode", $("#zipcodez").val());
            formData.append("firstname", $("#firstnamez").val());
            formData.append("lastname", $("#lastnamez").val());
            formData.append("username", $("#usernamez").val());
            formData.append("email", $("#emailz").val());
            formData.append("position", $("#position").val());
            formData.append("password", $("#passwordz").val());
            formData.append("telephone", $("#telephone").val());
            formData.append("mobile", $("#mobile").val());
            formData.append("office", $("#office").val());
            formData.append("maiden_name", $("#maiden_namez").val());
            formData.append("parent_meet", $("#parent_meetz").val());
            formData.append("plan", $("#planz").val());
        }


    }


    if(purpose == "Registration" && val == "Auto Dealer"){


        if($("#name_of_companydeal").val() == ""){
          swal('Oops', 'Company Name Field can\'t be Empty', 'info');
          return false;
        }

        else if($("#accountTypedeal").val() == ""){
          swal('Oops', 'Please select type of business', 'info');
          return false;
        }
        else if($("#addressdeal").val() == ""){
          swal('Oops', 'Company Address Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#cityzdeal").val() == ""){
          swal('Oops', 'City Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#statezdeal").val() == ""){
          swal('Oops', 'State Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#countryzdeal").val() == ""){
          swal('Oops', 'Country Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#zipcodezdeal").val() == ""){
          swal('Oops', 'Zip Code Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#firstnamezdeal").val() == ""){
          swal('Oops', 'Firstname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#lastnamezdeal").val() == ""){
          swal('Oops', 'Lastname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#usernamezdeal").val() == ""){
          swal('Oops', 'Username Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#emailzdeal").val() == ""){
          swal('Oops', 'Email Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#positiondeal").val() == ""){
          swal('Oops', 'Position Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#telephonedeal").val() == ""){
          swal('Oops', 'Telephone Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#planzdeal").val() == ""){
          swal('Oops', 'Please select a plan', 'info');
          return false;
        }
                // Check Password match
        else if($("#passwordzdeal").val() != $("#password-confirmzdeal").val()){
            swal('Oops', 'Password mis-match', 'error');
            return false;
        }
        else{

        var fileSelect = document.getElementById("filedeal");
          if(fileSelect.files && fileSelect.files.length == 1){
             var file = fileSelect.files[0]
             formData.set("filedeal", file , file.name);
           }

           var fileSelect2 = document.getElementById("file2deal");
           if(fileSelect2.files && fileSelect2.files.length == 1){
             var file = fileSelect2.files[0]
             formData.set("file2deal", file , file.name);
           }

           var fileSelect3 = document.getElementById("file3deal");
           if(fileSelect3.files && fileSelect3.files.length == 1){
             var file = fileSelect3.files[0]
             formData.set("file3deal", file , file.name);
           }
            formData.append("purpose", purpose);
            formData.append("userType", $("#userTypebisdeal").val());
            formData.append("userID", $("#userIDdeal").val());
            formData.append("busID", $("#busIDdeal").val());
            formData.append("name_of_company", $("#name_of_companydeal").val());
            formData.append("address", $("#addressdeal").val());
            formData.append("accountType", $("#accountTypedeal").val());
            formData.append("city", $("#cityzdeal").val());
            formData.append("state", $("#statezdeal").val());
            formData.append("country", $("#countryzdeal").val());
            formData.append("zipcode", $("#zipcodezdeal").val());
            formData.append("firstname", $("#firstnamezdeal").val());
            formData.append("lastname", $("#lastnamezdeal").val());
            formData.append("username", $("#usernamezdeal").val());
            formData.append("email", $("#emailzdeal").val());
            formData.append("position", $("#positiondeal").val());
            formData.append("password", $("#passwordzdeal").val());
            formData.append("telephone", $("#telephonedeal").val());
            formData.append("mobile", $("#mobiledeal").val());
            formData.append("office", $("#officedeal").val());
            formData.append("maiden_name", $("#maiden_namezdeal").val());
            formData.append("parent_meet", $("#parent_meetzdeal").val());
            formData.append("plan", $("#planzdeal").val());
        }


    }
    else if(purpose == "Registration" && val == "CM"){
        // Check Password match
        if($("#passwordzcm").val() != $("#password-confirmzcm").val()){
            swal('Oops', 'Password mis-match', 'error');
            return false;
        }
        else if($("#employeeSizecm").val() == ""){
          swal('Oops', 'Please select employee size', 'info');
          return false;
        }
        else if($("#accountTypecm").val() == ""){
          swal('Oops', 'Please select type of business', 'info');
          return false;
        }
        else if($("#cityzcm").val() == ""){
          swal('Oops', 'City Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#statezcm").val() == ""){
          swal('Oops', 'State Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#countryzcm").val() == ""){
          swal('Oops', 'Country Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#zipcodezcm").val() == ""){
          swal('Oops', 'Zip Code Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#firstnamezcm").val() == ""){
          swal('Oops', 'Firstname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#lastnamezcm").val() == ""){
          swal('Oops', 'Lastname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#year_practicecm").val() == ""){
          swal('Oops', 'Year of practical experience can\'t be Empty', 'info');
          return false;
        }
        else if($("#emailzcm").val() == ""){
          swal('Oops', 'Email Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#telephonecm").val() == ""){
          swal('Oops', 'Telephone Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#planzcm").val() == ""){
          swal('Oops', 'Please select a plan', 'info');
          return false;
        }
        else if($("#station_namezcm").val() == ""){
          swal('Oops', 'Please provide station name', 'info');
          return false;
        }
        else if($("#station_addrezcm").val() == ""){
          swal('Oops', 'Please provide station address', 'info');
          return false;
        }
        else if($("#discountPercent").val() == ""){
          swal('Oops', 'Please select your discount rate', 'info');
          return false;
        }
        else if($("#serviceCharges").val() == ""){
          swal('Oops', 'Please select your service charge rate', 'info');
          return false;
        }
        else{

        var fileSelect3 = document.getElementById("file3");
        if(fileSelect3.files && fileSelect3.files.length == 1){
             var file = fileSelect3.files[0]
             formData.set("file3", file , file.name);
           }

            formData.append("purpose", purpose);
            formData.append("userType", $("#accountTypecm").val());
            formData.append("userID", $("#userIDcm").val());
            formData.append("employeeSize", $("#employeeSizecm").val());
            formData.append("busID", $("#busIDcm").val());
            formData.append("accountType", $("#accountTypecm").val());
            formData.append("city", $("#cityzcm").val());
            formData.append("state", $("#statezcm").val());
            formData.append("country", $("#countryzcm").val());
            formData.append("zipcode", $("#zipcodezcm").val());
            formData.append("firstname", $("#firstnamezcm").val());
            formData.append("lastname", $("#lastnamezcm").val());
            formData.append("username", $("#usernamezcm").val());
            formData.append("email", $("#emailzcm").val());
            formData.append("password", $("#passwordzcm").val());
            formData.append("telephone", $("#telephonecm").val());
            formData.append("mobile", $("#mobilecm").val());
            formData.append("office", $("#officecm").val());
            formData.append("maiden_name", $("#maiden_namezcm").val());
            formData.append("parent_meet", $("#parent_meetzcm").val());
            formData.append("plan", $("#planzcm").val());
            formData.append("year_practice", $("#year_practicecm").val());
            formData.append("specialize", $("#specializecm").val());
            formData.append("station_name", $("#station_namezcm").val());
            formData.append("station_address", $("#station_addrezcm").val());
            formData.append("discountPercent", $("#discountPercent").val());
            formData.append("serviceCharges", $("#serviceCharges").val());
        }
    }
    else if(purpose == "Registration" && val == "Acc"){
                // Check Password match
        if($("#passwordzacc").val() != $("#password-confirmzacc").val()){
            swal('Oops', 'Password mis-match', 'error');
            return false;
        }
        else if($("#name_of_companyacc").val() == ""){
          swal('Oops', 'Company Name Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#employeeSizeacc").val() == ""){
          swal('Oops', 'Please select employee size', 'info');
          return false;
        }
        else if($("#accountTypeacc").val() == ""){
          swal('Oops', 'Please select type of business', 'info');
          return false;
        }
        else if($("#streetno_addressacc").val() == ""){
          swal('Oops', 'Company Street Number Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#addressacc").val() == ""){
          swal('Oops', 'Company Address Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#cityzacc").val() == ""){
          swal('Oops', 'City Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#statezacc").val() == ""){
          swal('Oops', 'State Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#countryzacc").val() == ""){
          swal('Oops', 'Country Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#zipcodezacc").val() == ""){
          swal('Oops', 'Zip Code Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#firstnamezacc").val() == ""){
          swal('Oops', 'Firstname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#lastnamezacc").val() == ""){
          swal('Oops', 'Lastname Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#usernamezacc").val() == ""){
          swal('Oops', 'Username Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#emailzacc").val() == ""){
          swal('Oops', 'Email Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#positionacc").val() == ""){
          swal('Oops', 'Position Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#service_offer").val() == ""){
          swal('Oops', 'Please provide the service you offer', 'info');
          return false;
        }
        else if($("#telephoneacc").val() == ""){
          swal('Oops', 'Telephone Field can\'t be Empty', 'info');
          return false;
        }
        else if($("#planzacc").val() == ""){
          swal('Oops', 'Please select a plan', 'info');
          return false;
        }
        else if($("#discountaccPercent").val() == ""){
          swal('Oops', 'Please select your discount rate', 'info');
          return false;
        }
        else if($("#serviceaccCharges").val() == ""){
          swal('Oops', 'Please select your service charge rate', 'info');
          return false;
        }
        else{

        var fileSelect = document.getElementById("fileacc");
        var fileSelect2 = document.getElementById("file2acc");
        var fileSelect3 = document.getElementById("photo_video");


        var vimfile_discount = $('#vimfile_discount').val();
        var repair_guaranteed = $('#repair_guaranteed').val();
        var free_estimated = $('#free_estimated').val();
        var walk_in_specified = $('#walk_in_specified').val();
        var other_value_added = $('#other_value_added').val();
        var average_waiting = $('#average_waiting').val();
        var hours_of_operation = $('#hours_of_operation').val();
        var wifi = $('#wifi').val();
        var restroom = $('#restroom').val();
        var lounge = $('#lounge').val();
        var parking_space = $('#parking_space').val();

        var year_established = $('#year_established').val();
        var background = $('#background').val();



          if(fileSelect.files && fileSelect.files.length == 1){
             var file = fileSelect.files[0]
             formData.set("fileacc", file , file.name);
           }
          if(fileSelect2.files && fileSelect2.files.length == 1){
             var file = fileSelect2.files[0]
             formData.set("file2acc", file , file.name);
           }
           if(fileSelect3.files && fileSelect3.files.length == 1){
             var file = fileSelect3.files[0]
             formData.set("photo_video", file , file.name);
           }

            formData.append("purpose", purpose);
            formData.append("userType", $("#accountTypeacc").val());
            formData.append("userID", $("#userIDacc").val());
            formData.append("employeeSize", $("#employeeSizeacc").val());
            formData.append("busID", $("#busIDacc").val());
            formData.append("name_of_company", $("#name_of_companyacc").val());
            formData.append("street_no", $("#streetno_addressacc").val());
            formData.append("address", $("#addressacc").val());
            formData.append("accountType", $("#accountTypeacc").val());
            formData.append("city", $("#cityzacc").val());
            formData.append("state", $("#statezacc").val());
            formData.append("country", $("#countryzacc").val());
            formData.append("zipcode", $("#zipcodezacc").val());
            formData.append("year_started_since", $("#year_started_since").val());
            formData.append("year_of_practice", $("#year_of_practice").val());
            formData.append("firstname", $("#firstnamezacc").val());
            formData.append("lastname", $("#lastnamezacc").val());
            formData.append("username", $("#usernamezacc").val());
            formData.append("email", $("#emailzacc").val());
            formData.append("position", $("#positionacc").val());
            formData.append("service_offer", $("#service_offer").val());
            formData.append("password", $("#passwordzacc").val());
            formData.append("telephone", $("#telephoneacc").val());
            formData.append("mobile", $("#mobileacc").val());
            formData.append("office", $("#officeacc").val());

            formData.append("mechanical_skill", $("#mechanical_skill").val());
            formData.append("electrical_skill", $("#electrical_skill").val());
            formData.append("transmission_skill", $("#transmission_skill").val());
            formData.append("body_work_skill", $("#body_work_skill").val());
            formData.append("other_skills", $("#other_skills").val());


            formData.append("vimfile_discount", vimfile_discount);
            formData.append("repair_guaranteed", repair_guaranteed);
            formData.append("free_estimated", free_estimated);
            formData.append("walk_in_specified", walk_in_specified);
            formData.append("other_value_added", other_value_added);
            formData.append("average_waiting", average_waiting);
            formData.append("hours_of_operation", hours_of_operation);


            formData.append("wifi", wifi);
            formData.append("restroom", restroom);
            formData.append("lounge", lounge);
            formData.append("parking_space", parking_space);


            formData.append("year_established", year_established);
            formData.append("background", background);


            formData.append("maiden_name", $("#maiden_namezacc").val());
            formData.append("parent_meet", $("#parent_meetzacc").val());
            formData.append("plan", $("#planzacc").val());
            formData.append("discountaccPercent", $("#discountaccPercent").val());
            formData.append("serviceaccCharges", $("#serviceaccCharges").val());
        }
    }

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
          $(".signUpbtn").text('Processing data...');
        },
        success: function(result){
            if (result.message == "success") {
                swal("Saved!", result.res, result.message);
            setTimeout(function(){ location.href = result.link; }, 3000);
            }
            else if(result.message == "info" && result.username == "Exist"){
              swal("Oops!", result.res, result.message);
            }
            else
            {
               swal("Oops!", result.res, result.message);
            setTimeout(function(){ location.href = result.link; }, 3000);
            }

        }

      });




}

function getAppointment(val, purpose, station){
  // alert(purpose);
  $('#appointstation_name').val('');
  $('#appointref_code').val('');
    $("#appointmentID").val('');
    $("#myID").val('');
    $("#mypurpose").val('');
    $("#stationname").val('');
    $("#stationrecemail").val('');
    $(".bookings").addClass('disp-0');

    scrollTarget('makeBookings');

    if(purpose== "registered"){

      // Run Ajax
      var route = "{{ URL('Ajax/stationDetails') }}";
      var thisdata = {busID: val, station: station};

      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          var res = result.data;
          if(result.message == "success"){
            $('#appointstation_name').val(res[0].station_name);
            $('#appointref_code').val('<?php echo uniqid();?>');
            $('#appointcoy_name').text(result.coy_name+' ('+res[0].station_name+')');
            $('#appointcoy_address').text(res[0].station_address);
            $('#appointcoy_phone').text(res[0].station_phone);
            $('#appointcoy_email').text(res[0].email);
            $('#appointcoy_service').text(res[0].service_offered);
            $('#appointcoy_discount').text(result.discount+'%');
            $('#stationrecemail').val(res[0].email);

            $('#appointcoy_location').html("<a href='https://www.google.com/maps/search/"+res[0].station_address+"' target='_blank'><i type='button' class='fas fa-map-marker' style='color: red; text-align: center; padding: 7px; width: 30px; height: 30px;'></i></a>");
          }
          else{
            swal('Oops', result.res, result.message);
          }
        }
      });

        $("#appointmentID").val(val);
        $("#myID").val('0');
        $("#mypurpose").val('registered');
        $("#stationname").val(station);
      $(".bookings").removeClass('disp-0');
    }

    else if(purpose== "unregistered"){
        $("#appointmentID").val('0');
        $("#myID").val(val);
        $("#mypurpose").val('unregistered');
        $("#stationname").val(station);
      $(".bookings").removeClass('disp-0');
    }

}

function appointment(){

  var route =  "{{ URL('Ajax/BookAppointment') }}";
    var thisdata = {busID: $("#appointmentID").val(),name: $("#fullnames").val(), email: $("#mail_addr").val(), subject: $("#subjects").val(), message: $("#messages").val(),date_of_visit: $("#date_of_visit").val(), unregID: $("#myID").val(), purpose: $("#mypurpose").val(), station: $("#stationname").val(), service_option: $('#appointservice_option').val(), service_type: $('#appointservice_type').val(), current_mileage: $('#appointcurrent_mileage').val(), station_name: $('#appointstation_name').val(), ref_code: $('#appointref_code').val(), station_email: $('#stationrecemail').val()};

    // Do Ajax to fetch result
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            $('.spinnerappoints').removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            $('.spinnerappoints').addClass('disp-0');
            $("#appointmentID").val('');
            $("#subjects").val('');
            $("#messages").val('');
            $("#date_of_visit").val('');
            $(".bookings").addClass('disp-0');
            $("#myID").val('');
            $("#mypurpose").val('');

            swal('Ok!', result.res, result.message);
          }
          else{
            swal('Oops', result.res, result.message);
          }
        }
      });

}


function scrollTarget(val){
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#"+val).offset().top
    }, 2000);
}

function contactus(id, purpose){
  var route = "{{URL('Ajax/Contactus')}}";
  var thisdata;
  var name;
  var email;
  var subject;
  var message;

  if(purpose == 'Business'){

    name = $("#contact_namez");
    email = $("#contact_emailz");
    subject = $("#contact_subjectz");
    message = $("#contact_messagez");

    thisdata = {
      id: id,
      name: name.val(),
      email: email.val(),
      subject: subject.val(),
      message: message.val(),
      purpose: purpose,
    };

  }

  if(purpose == 'All'){

    name = $("#contact_name");
    email = $("#contact_email");
    subject = $("#contact_subject");
    message = $("#contact_message");

    thisdata = {
      id: id,
      name: name.val(),
      email: email.val(),
      subject: subject.val(),
      message: message.val(),
      purpose: purpose,
    };
  }

  if(name.val() == "" || email.val() == "" || subject.val() == "" || message.val() == ""){
    swal('Oops', 'Kindly Fill all Required Fields', 'info');
    return false;
  }
  else{
     setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $(".spinner").removeClass('disp-0');
          $(".arros").addClass('disp-0');
        },
        success: function(result){
            if (result.message == "success") {
              name.val('');
              email.val('');
              subject.val('');
              message.val('');
              $(".spinner").addClass('disp-0');
              $(".arros").removeClass('disp-0');
              swal("Saved!", result.res, result.message);
            }
            else
            {
               swal("Oops!", result.res, result.message);
            }

        }

      });
  }


}

function passChange(val){
  $("#user_id").val(val);
  $(".editPass").toggle();
}

function savePass(val){
  // alert(val);

  if($("#new_password").val() != $("#c_password").val()){
    swal('Oops', 'Password mis-match', 'error');
    return false;
  }
  else if($("#new_password").val() == ""){
    swal('Oops', 'Password field cannot be empty', 'info');
    return false;
  }
  else if($("#c_password").val() == ""){
    swal('Oops', 'You must confirm password', 'info');
    return false;
  }
  else{
      var route = "{{URL('Ajax/Passwordchange')}}";
      var thisdata = {id: $("#user_id").val(), email: val, password: $("#new_password").val()}

      console.log(thisdata);

       setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            // Pop up Modal
            $("#user_id").val("");
            $(".editPass").addClass('disp-0');
            $(".spinner").addClass('disp-0');
            swal('Good', result.res, result.message);
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
  var monthly;
  var yearly;



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
      userType: $('#usersType').val(),
      plan: plan
    }

    spinner = $(".spinnerstartup");
  }

  if(plan == "Lite-Commercial"){
    monthly = $('#monthlitecomsub').prop('checked');
    yearly = $('#yearlitecomsub').prop('checked');

    if(monthly == true){
    thisdata = {
          email: email,
          amount: $('#monthlitecomsub').val(),
          userType: 'Commercial',
          plan: plan,
          duration: 'monthly'
        }
    }
    else{
      thisdata = {
          email: email,
          amount: $('#yearlitecomsub').val(),
          userType: 'Commercial',
          plan: plan,
          duration: 'yearly'
        }
    }


    spinner = $(".spinnercommercial");
  }

  if(plan == "Basic"){
    monthly = $('#monthbasicsub').prop('checked');
    yearly = $('#yearbasicsub').prop('checked');

    if(monthly == true){
      thisdata = {
      email: email,
      amount: $('#monthbasicsub').val(),
      userType: $('#usersType').val(),
      plan: plan,
      duration: 'monthly'
    }
    }
    else{
      thisdata = {
      email: email,
      amount: $('#yearbasicsub').val(),
      userType: $('#usersType').val(),
      plan: plan,
      duration: 'monthly'
    }
    }


    spinner = $(".spinnerbasic");
  }
  if(plan == "Classic"){
    monthly = $('#monthclassicsub').prop('checked');
    yearly = $('#yearclassicsub').prop('checked');
    if(monthly == true){
      thisdata = {
      email: email,
      amount: $('#monthclassicsub').val(),
      userType: $('#usersType').val(),
      plan: plan,
      duration: 'monthly'
    }
    }
    else{
      thisdata = {
      email: email,
      amount: $('#yearclassicsub').val(),
      userType: $('#usersType').val(),
      plan: plan,
      duration: 'yearly'
    }
    }


    spinner = $(".spinnerclassic");
  }
  if(plan == "Super"){
    monthly = $('#monthsupersub').prop('checked');
    yearly = $('#yearsupersub').prop('checked');

    if(monthly ==  true){
      thisdata = {
      email: email,
      amount: $('#monthsupersub').val(),
      userType: $('#usersType').val(),
      plan: plan,
      duration: 'monthly'
    }
    }
    else{
      thisdata = {
      email: email,
      amount: $('#yearsupersub').val(),
      userType: $('#usersType').val(),
      plan: plan,
      duration: 'yearly'
    }
    }



    spinner = $(".spinnersuper");
  }
  if(plan == "Gold"){
    thisdata = {
      email: email,
      amount: amount,
      userType: $('#usersType').val(),
      plan: plan
    }

    spinner = $(".spinnergold");
  }

  // Plan For Individual User
  if(plan == "Lite"){
    monthly = $('#monthlitesub').prop('checked');
    yearly = $('#yearlitesub').prop('checked');

    if(monthly == true){
    thisdata = {
          email: email,
          amount: $('#monthlitesub').val(),
          userType: 'Individual',
          plan: plan,
          duration: 'monthly'
        }
    }
    else{
      thisdata = {
          email: email,
          amount: $('#yearlitesub').val(),
          userType: 'Individual',
          plan: plan,
          duration: 'yearly'
        }
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


// Edit MAintenance Record
function maintenanceEdit(id){

  $('.ins'+id).removeClass('disp-0');
  $('.exs'+id).addClass('disp-0');
  $('.saveMain'+id).removeClass('disp-0');
  $('.editMain'+id).addClass('disp-0');

}

function maintenanceSave(id){
  var spinner = $('#spinner'+id);
  var route = "{{ URL('Ajax/MaintenanceSave') }}";
  var thisdata = {
    id: id,
    vehicle_licence: $('#editLicence'+id).val(),
    date: $('#editDate'+id).val(),
    service_type: $('#editservType'+id).val(),
    service_option: $('#editservOption'+id).val(),
    service_item_spec: $('#editservItem'+id).val(),
    manufacturer: $('#editManufacturer1'+id).val(),
    material_qty: $('#editMaterialQty1'+id).val(),
    material_cost: $('#editMaterialCost1'+id).val(),
    material_qty2: $('#editMaterialQty2'+id).val(),
    material_cost2: $('#editMaterialCost2'+id).val(),
    material_qty3: $('#editMaterialQty3'+id).val(),
    material_cost3: $('#editMaterialCost3'+id).val(),
    labour_qty: $('#editLaboutQty1'+id).val(),
    labour_cost: $('#editLaboutCost1'+id).val(),
    labour_qty2: $('#editLaboutQty2'+id).val(),
    labour_cost2: $('#editLaboutCost2'+id).val(),
    other_cost: $('#editOtherCost'+id).val(),
    service_note: $('#editserviceNote'+id).val(),
    total_cost: $('#edittotalCost'+id).val(),
    mileage: $('#editMileage'+id).val(),
  };


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
            var res = JSON.parse(result.data);
            spinner.addClass('disp-0');
              $('.saveMain'+id).addClass('disp-0');
            $('.editMain'+id).removeClass('disp-0');
              $('.ins'+id).addClass('disp-0');
              $('.exs'+id).removeClass('disp-0');
            $('#editLicence'+id).val(res[0].vehicle_licence);
            $('#editDate'+id).val(res[0].date);
            $('#editservType'+id).val(res[0].service_type);
            $('#editservOption'+id).val(res[0].service_option);
            $('#editservItem'+id).val(res[0].service_item_spec);
            $('#editManufacturer1'+id).val(res[0].manufacturer);
            $('#editMaterialQty1'+id).val(res[0].material_qty);
            $('#editMaterialCost1'+id).val(res[0].material_cost);
            $('#editMaterialQty2'+id).val(res[0].material_qty2);
            $('#editMaterialCost2'+id).val(res[0].material_cost2);
            $('#editMaterialQty3'+id).val(res[0].material_qty3);
            $('#editMaterialCost3'+id).val(res[0].material_cost3);
            $('#editLaboutQty1'+id).val(res[0].labour_qty);
            $('#editLaboutCost1'+id).val(res[0].labour_cost);
            $('#editLaboutQty2'+id).val(res[0].labour_qty2);
            $('#editLaboutCost2'+id).val(res[0].labour_cost2);
            $('#editOtherCost'+id).val(res[0].other_cost);
            $('#edittotalCost'+id).val(res[0].total_cost);
            $('#editserviceNote'+id).val(res[0].service_note);
            $('#editMileage'+id).val(res[0].mileage);

            swal('Ok', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);


          }
          else{
            swal('Oops', result.res, result.message);
          }


        }

      });



}

// Business IVIM/Report FUnction
function ivimSearch(val){
  $('div#ivimRec').html('');
  $('div#reportRec').html('');
  var route = "{{ URL('Ajax/ivimSearch') }}";
  var thisdata;
  var diff; var date; var mileage; var mileSince; var tyreRotate; var inspection; var registration;
  var diff2; var date; var mileage2; var mileSince2; var tyreRotate2; var inspection2; var registration2;
  var diff3; var date; var mileage3; var mileSince3; var tyreRotate3; var inspection3; var registration3;
  var diff4; var date; var mileage4; var mileSince4; var tyreRotate4; var inspection4; var registration4;
  var diff5; var date; var mileage5; var mileSince5; var tyreRotate5; var inspection5; var registration5;

  var spinner = $('.spinner');
  if(val == 'ivim'){
    thisdata = {
      purpose: val,
      licence: $('#searchIvim').val(),
    };
  }

  if(val == 'report'){
    thisdata = {
      purpose: val,
      licence: $('#searchReport').val(),
    };
  }


        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $('tr > td img').show();
          $('#ivimSearchbtn').text('Loading');
          $('#reportSearchbtn').text('Loading');
        },
        success: function(result){
          $('tr > td img').hide();

          $('#ivimSearchbtn').text('Search');
          $('#reportSearchbtn').text('Search');

          if(result.message == "success" && result.action == "ivim"){
            var res0 = JSON.parse(result.data0);
            var res1 = JSON.parse(result.data1);
            var res2 = JSON.parse(result.data2);
            var res3 = JSON.parse(result.data3);
            var res4 = JSON.parse(result.data4);
            var res5 = JSON.parse(result.data5);
            var res6 = JSON.parse(result.data6);
            var res7 = JSON.parse(result.data7);

            if(res1 == ''){
              res1 = 'N/A';
              date = 'N/A';
              diff = 'N/A';
              mileage = 'N/A';
              mileSince = 'N/A';

            }
            else{
              res1 = JSON.parse(result.data1);
              date = res1[0].created_at;
              diff = dateDiffs(res1[0].created_at);
              mileage = res1[0].mileage;
              mileSince = mileage - res0[0].current_mileage;

            }
            if(res2== ''){
              res2= 'N/A';
              date2= 'N/A';
              diff2= 'N/A';
              mileage2 = 'N/A';
              mileSince2 = 'N/A';

            }
            else{
              res2 = JSON.parse(result.data2);
              date2 = res2[0].created_at;
              diff2 = dateDiffs(res2[0].created_at);
              mileage2 = res2[0].mileage;
              mileSince2 = mileage2 - res0[0].current_mileage;

            }
            if(res3== ''){
              res3= 'N/A';
              date3= 'N/A';
              diff3= 'N/A';
              mileage3 = 'N/A';
              mileSince3 = 'N/A';

            }
            else{
              res3 = JSON.parse(result.data3);
              date3 = res3[0].created_at;
              diff3 = dateDiffs(res3[0].created_at);
              mileage3 = res3[0].mileage;
              mileSince3 = mileage3 - res0[0].current_mileage;

            }

            if(res4== ''){
              res4= 'N/A';
              date4= 'N/A';
              diff4= 'N/A';
              mileage4 = 'N/A';
              mileSince4 = 'N/A';

            }
            else{
              res4 = JSON.parse(result.data4);
              date4 = res4[0].created_at;
              diff4 = dateDiffs(res4[0].created_at);
              mileage4 = res4[0].mileage;
              mileSince4 = mileage4 - res0[0].current_mileage;

            }

            if(res5== ''){
              res5= 'N/A';
              date5= 'N/A';
              diff5= 'N/A';
              mileage5 = 'N/A';
              mileSince5 = 'N/A';

            }
            else{
              res5 = JSON.parse(result.data5);
              date5 = res5[0].created_at;
              diff5 = dateDiffs(res5[0].created_at);
              mileage5 = res5[0].mileage;
              mileSince5 = mileage5 - res0[0].current_mileage;

            }

            // console.log(res5[0].mileage);

            $('div#ivimRec').append("<div class='itemheader'><table><tbody><tr><td>"+res0[0].vehicle_nickname+"</td><td align='right' style='padding-right:20px;'></td></tr></tbody></table></div><div class='itembody'><table style='width: 100%;' class='table table-bordered table-striped'><tbody><tr style='font-size: 12px;'><td>Last Oil Change:</td><td></td><td>Date: "+date+" </td><td></td><td>Day Since: "+diff+"</td><td></td><td> Mileage: "+mileage+"</td><td></td><td> Mile Since: "+mileSince+"</td></tr><tr style='font-size: 12px;'><td>Last Tire Rotation:</td><td></td><td>Date: "+date2+"</td><td></td><td>Day Since: "+diff2+"</td><td></td><td> Mileage: "+mileage2+"</td><td></td><td> Mile Since: "+mileSince2+"</td></tr><tr style='font-size: 12px;'><td>Last Air Filter:</td><td></td><td>Date: "+date3+" </td><td></td><td>Day Since: "+diff3+"</td><td></td><td> Mileage: "+mileage3+"</td><td></td><td> Mile Since: "+mileSince3+"</td></tr><tr style='font-size: 12px;'><td>Last Inspection:</td><td></td><td>Date: "+date4+" </td><td></td><td>Day Since: "+diff4+"</td><td></td><td> Mileage: "+mileage4+" </td><td></td><td> Mile Since: "+mileSince4+"</td></tr><tr style='font-size: 12px;'><td>Last Registration:</td><td></td><td>Date: "+date5+" </td><td></td><td>Day Since: "+diff5+" </td><td></td><td> Mileage: "+mileage5+" </td><td></td><td> Mile Since: "+mileSince5+" </td></tr></tbody></table></div>");

          }
          else if(result.message == "success" && result.action == "report"){
            var res0 = JSON.parse(result.data0);
            var res6 = JSON.parse(result.data6);
            var res7 = JSON.parse(result.data7);
            var res8 = JSON.parse(result.data8);
            var dayDiff;
            var avgtotMiles;
            var avgtotMaint;

            if(res6 == ''){
              res6 = 'N/A';
              totMiles = 'N/A';

            }
            else{
              res6 = JSON.parse(result.data6);
              totMiles = JSON.parse(result.data6);
              dayDiff = calcDiffs(res0[0].created_at,res8[0].created_at);

              if(dayDiff == 0){
                avgtotMiles = 0;
              }
              else{
                avgtotMiles = res6 / dayDiff;
              }



            }

            if(res7 == ''){
              res7 = 'N/A';
              totMaint = 'N/A';
            }
            else{
              res7 = JSON.parse(result.data7);
              totMaint = JSON.parse(result.data7);
              dayDiff = calcDiffs(res0[0].created_at,res8[0].created_at);

              if(dayDiff == 0){
                avgtotMaint = 0;
              }
              else{
                avgtotMaint = res7 / dayDiff;
              }

            }


            $('div#reportRec').append("<div class='itemheader'><table><tbody><tr><td>"+res0[0].vehicle_nickname+"</td><td align='right' style='padding-right:20px;'></td></tr></tbody></table></div><div class='itembody'><table class='table table-bordered table-striped'><tbody><tr style='font-size: 12px;'><td align='left' width='25%' style='font-weight: bold; text-transform: capitalize;'>Total miles driven:</td><td align='right'>"+res6+"</td></tr><tr style='font-size: 12px;'><td align='left' width='25%' style='font-weight: bold; text-transform: capitalize;'>Avg. miles driven per month:</td><td align='right'>"+parseFloat(avgtotMiles).toFixed(2)+"</td></tr><tr style='font-size: 12px;'><td align='left' width='25%' style='font-weight: bold; text-transform: capitalize;'>Total maintenance cost:</td><td align='right'>"+res7+"</td></tr><tr style='font-size: 12px;'><td align='left' width='25%' style='font-weight: bold; text-transform: capitalize;'>Avg. maintenance cost per month:</td><td align='right'>"+parseFloat(avgtotMaint).toFixed(2)+"</td></tr></tbody></table></div>");

          }
          else{
            swal('Oops', result.res, result.message);
          }


        }

      });
}


function deactivateAccount(id){

swal({
          title: "Are you sure you want to deactivate account?",
          text: "If yes, click OK to deactivate",
          icon: "error",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var route = "{{ URL('Ajax/deactivateUser') }}";
            var thisdata = {id: id};

            setHeaders();
                  jQuery.ajax({
                  url: route,
                  method: 'post',
                  data: thisdata,
                  dataType: 'JSON',
                  beforeSend: function(){
                    $('.spinner').removeClass('disp-0');
                  },
                  success: function(result){
                    $('.spinner').addClass('disp-0');

                    if(result.message == "success"){
                      swal('Hi!', result.res, result.message);
                      // Do logout
                      setTimeout(function(){ document.getElementById("logout-form").submit(); }, 2000);
                    }
                    else{
                      swal('Oops', result.res, result.message);
                    }


                }

              });
          }
        });



}

function dateDiffs(created_at){
  var date1 = new Date(created_at);
  var date2 = new Date();

  // To calculate the time difference of two dates
  var Difference_In_Time = date2.getTime() - date1.getTime();

  // To calculate the no. of days between two dates
  var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);


  return Math.round(Difference_In_Days);
}

function calcDiffs(acct_date, maint_date){
  var date1 = new Date(acct_date);
  var date2 = new Date(maint_date);
  var dayRes;

  // To calculate the time difference of two dates
  var Difference_In_Time = date2.getTime() - date1.getTime();

  // To calculate the no. of days between two dates
  var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);


  if(Difference_In_Days < 30){
    dayRes = 0;
  }
  else if(Difference_In_Days > 30){

    dayRes = Difference_In_Days / 30;
  }


  return Math.round(dayRes);
}


function forgotPassword(val){
  var email;
  var maiden_name;
  var route = "{{ URL('Ajax/forgotPassword') }}";
  var thisdata;
  var new_password;
  var cpassword;

  if(val == 'emailAddress'){
    email = $('#email').val();
    thisdata = {email: email, val: val};
  }
  if(val == 'maidenname1'){
    email = $('#email1').val();
    maiden_name = $('#maiden_name1').val();
    thisdata = {email: email, maiden_name: maiden_name, val: val };
  }
  if(val == 'maidenname2'){
    email = $('#email2').val();
    maiden_name = $('#maiden_name2').val();
    thisdata = {email: email, parent_meet: maiden_name, val: val};
  }

  if(val == 'passwordchange'){
    email = $('#email3').val();
    new_password = $('#new_password').val();
    cpassword = $('#cpassword').val();
    thisdata = {email: email, new_password: new_password, val: val};
  }

  if(email == ''){
    swal('Oops', 'You must provide your e-mail address.', 'warning');
  }
  else if(maiden_name == ''){
    swal('Oops', 'You have to answer this question to proceed.', 'warning')
  }
  else if(new_password != cpassword){
    swal('Oops', 'Password Mis-match', 'error')
  }
    else{

      setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
        $('.spinner').removeClass('disp-0');
      },
      success: function(result){
        $('.spinner').addClass('disp-0');

        if(result.message == "success" && result.action == "email check"){
          iziToast.success({
              title: result.res,
              message: 'You will be redirected in 5secs',
          });
          setTimeout(function(){ location.href = location.origin+'/ResetPassword/'+result.link; }, 5000);
        }

        else if(result.message == "success" && result.action == "maiden name"){
          iziToast.success({
              title: result.res,
              message: 'Preparing page to set new password',
          });

          setTimeout(function(){ location.href = location.origin+'/ResetPassword/'+result.link; }, 5000);
        }
        else if(result.message == "error" && result.action == "maiden name"){
          swal('Oops', result.res, result.message);
          setTimeout(function(){ location.href = location.origin+'/ResetPassword/'+result.link; }, 3000);
        }

        else if(result.message == "success" && result.action == "parent meet"){
          iziToast.success({
              title: result.res,
              message: 'Preparing page to set new password',
          });

          setTimeout(function(){ location.href = location.origin+'/ResetPassword/'+result.link; }, 5000);

        }
        else if(result.message == "error" && result.action == "parent meet"){
          swal('Oops', result.res, result.message);

          setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 5000);
        }

        else if(result.message == "success" && result.action == "passwordchange"){
          iziToast.success({
              title: result.message,
              message: result.res,
          });

          setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 5000);

        }
        else if(result.message == "error" && result.action == "parent meet"){
          swal('Oops', result.res, result.message);
        }

        else{
          swal('Oops', result.res, result.message);
        }


    }

  });

  }
}

function uploadDocs(val, id){

  var route = "{{ URL('Ajax/uploadStatement') }}";
  var formData = new FormData();
  var fileSelect;
  var file;
  var spinner;

  if(val == "bankstatement"){
    fileSelect = document.getElementById("bankstatement");
  if(fileSelect.files && fileSelect.files.length == 1){
      file = fileSelect.files[0]
      formData.set("bankstatement", file , file.name);
    }
    spinner = $('.spinnerbank'+id);
  }

  else if(val == "creditcards"){

    fileSelect = document.getElementById("creditcards");
  if(fileSelect.files && fileSelect.files.length == 1){
      file = fileSelect.files[0]
      formData.set("creditcards", file , file.name);
    }

    spinner = $('.spinnercredit'+id);
  }

  formData.append("id", id);
  formData.append("val", val);

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
            if(result.message == "Success"){
              fileSelect.value = "";
              spinner.addClass('disp-0');
            iziToast.success({
              title: result.message,
              message: result.res,
          });
            }
            else{
              fileSelect.value = "";
              spinner.addClass('disp-0');
              iziToast.error({
              title: result.message,
              message: result.res,
          });
            }

        }

      });

}

function moreIvim(id){
  // Get me a pop up
  $('button#moreFields').click();

}


function getMe(){
var route = "{{ URL('Ajax/moreDetails') }}";
var thisdata = {service_type: $("#services_types").val()}
      setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
      },
      success: function(result){

        if(result.message == "success"){
          $('.mfp-close').click();
          var res = JSON.parse(result.data);
          var res2 = JSON.parse(result.data2);
          var diff;
          var mileage;
          var mileSince;
          $.each(res, function(v,k){
            diff = dateDiffs(res[v].created_at);
            mileSince = res[v].mileage - res2[0].current_mileage;
            $("tbody.response").append("<tr style='font-size: 12px;'><td style='text-transform: capitalize;'>Last "+res[v].service_type+":</td><td></td><td>Date: "+res[v].date+" </td><td></td><td>Day Since: "+diff+"</td><td></td><td> Mileage: "+res[v].mileage+"</td><td></td><td> Mile Since: "+mileSince+" </td></tr>");
          });

        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });
}


function financial(val, id){

var route = "{{ URL('Ajax/commercialFinance') }}";
var thisdata;
var spinner;

if(val == "applicable_tax"){
  spinner = $('.spinnerapplicable_tax'+id);
  if($('#applicable_tax').val() == ""){
    iziToast.error({
              title: "Oops",
              message: "This field can\'t be empty",
          });

    return 0;
  }
  else{
    thisdata = {
      id: id,
    val: val,
    inflowVal: $('#applicable_tax').val(),
  };
  }

}
if(val == "post_earnings"){
  spinner = $('.spinnerpost_earnings'+id);
  if($('#post_earnings').val() == ""){
    iziToast.error({
              title: "Oops",
              message: "None of this fields can be empty",
          });

    return 0;
  }
  else{
    thisdata = {
      id: id,
    val: val,
    start_date: $('#startearn_date').val(),
    end_date: $('#endearn_date').val(),
    inflowEarn: $('#post_earnings').val(),
  };
  }

}
if(val == "mile_posts"){
  spinner = $('.spinnermile_posts'+id);

  if($('#mile_posts').val() == ""){
    iziToast.error({
              title: "Oops",
              message: "This field can\'t be empty",
          });
    return 0;
  }else{
    thisdata = {
      id: id,
    val: val,
    start_date: $('#startmile_date').val(),
    end_date: $('#endmile_date').val(),
    inflowVal: $('#mile_posts').val()
  };
  }


}
if(val == "avg_earnings"){
  spinner = $('.spinneravg_earnings'+id);

  if($('#avg_earnings').val() == ""){
    iziToast.error({
              title: "Oops",
              message: "This field can\'t be empty",
          });
    return 0;
  }else{
  thisdata = {
    id: id,
    val: val,
    inflowVal: $('#avg_earnings').val(),
    start_date:$('#start_date').val(),
    end_date: $('#end_date').val()
  };
}
}
if(val == "tot_earnings"){
  spinner = $('.spinnertot_earnings'+id);
  if($('#tot_earnings').val() == ""){
    iziToast.error({
              title: "Oops",
              message: "This field can\'t be empty",
          });
    return 0;
  }else{
  thisdata = {
    id: id,
    val: val,
    inflowVal: $('#tot_earnings').val()
  };
}
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

        if(result.message == "Success" && result.action == "applicable_tax"){
          $('#applicable_tax').val('');
          spinner.addClass('disp-0');

          iziToast.success({
              title: result.message,
              message: result.res,
          });

        }

        else if(result.message == "Success" && result.action == "post_earnings"){
          $('#post_earnings').val('');
          spinner.addClass('disp-0');

          iziToast.success({
              title: result.message,
              message: result.res,
          });

        }

        else if(result.message == "Success" && result.action == "mile_posts"){
          $('#mile_posts').val('');
          spinner.addClass('disp-0');

          iziToast.success({
              title: result.message,
              message: result.res,
          });

        }

        else if(result.message == "Success" && result.action == "avg_earnings"){
          $('#avg_earnings').val('');
          spinner.addClass('disp-0');

          iziToast.success({
              title: result.message,
              message: result.res,
          });

        }

        else if(result.message == "Success" && result.action == "tot_earnings"){
          $('#tot_earnings').val('');
          spinner.addClass('disp-0');

          iziToast.success({
              title: result.message,
              message: result.res,
          });
        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });
}


function reporttoDate(email){
  $('tbody.tableReport1').addClass('disp-0');
  $('tbody.tableReport2').html('');
  var route = "{{ URL('Ajax/moreReports') }}";
var thisdata = {
  email: email,
  date_from: $("#date_from").val(),
  date_to: $("#date_to").val()
}
      setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
        $('.spinner').removeClass('disp-0');
        $("tbody.tableReport2").append("<tr align='center' id='loadImg'><td>&nbsp;</td><td colspan='4' align='center'><img style='width: 250px; height: auto; position:relative; margin: 0 auto;' src='https://ico.xrweb.network/images/pageloader.gif' /></td></tr>");
      },
      success: function(result){

        if(result.message == "success"){
          $('.spinner').addClass('disp-0');
          $('#loadImg').hide();
          var prorated;
          var ITC;
          var res = JSON.parse(result.data);
          var proRact = JSON.parse(result.proRact);
          var vat = JSON.parse(result.vat);
          var totEarn = JSON.parse(result.totEarn);
          var totTax = JSON.parse(result.totTax);
          var busKM = JSON.parse(result.busKM);
          var sum3;
          var sum4;
          var gross;
          var tax;
          var KM;
          gross = $("#mytable tr:nth-child(13) > td:nth-child(5)")[0].innerText = Math.round(totEarn);
          tax = $("#mytable tr:nth-child(13) > td:nth-child(6)")[0].innerText = Math.round(totTax);
          KM = $("#mytable tr:nth-child(15) > td:nth-child(2)")[0].innerText = Math.round(busKM);
          var sum = 0;
          var sum2 = 0;
          var sumA = gross;
          var sumB = tax;

          $.each(res, function(v,k){
            prorated = proRact * res[v].total_cost;
            ITC = prorated * vat;
            sum = parseInt(sum)+Math.round(prorated);
            sum2 = parseInt(sum2)+Math.round(ITC);

            $("tbody.tableReport2").append("<tr style='font-size: 12px; border: 1px solid black;'><td align='center' style='border-right: 1px solid black; font-weight: bold;'>"+res[v].service_type+"</td><td align='right' style='border-right: 1px solid black'>&nbsp;</td><td align='center' width='10%' style='text-transform: capitalize; border-right: 1px solid black'>HST</td><td align='center' width='10%' style='text-transform: capitalize; border-right: 1px solid black'>"+res[v].total_cost+"</td><td align='center' width='25%' style='text-transform: capitalize; border-right: 1px solid black'>"+Math.round(prorated)+"</td><td align='center' width='35%' style='text-transform: capitalize; border-right: 1px solid black'>"+Math.round(ITC)+"</td></tr>");
          });

            sum3 = gross-sum;
            sum4 = tax-sum2;

            $("tbody.tableReport2").append("<tr style='font-size: 12px; border: 1px solid black;'><td align='center' style='border-right: 1px solid black; font-weight: bold;'>Total Expenses</td><td align='right' style='border-right: 1px solid black'>&nbsp;</td><td align='center' width='10%' style='text-transform: capitalize; border-right: 1px solid black'>&nbsp;</td><td align='center' width='10%' style='text-transform: capitalize; border-right: 1px solid black'>&nbsp;</td><td align='center' width='25%' style='text-transform: capitalize; border-right: 1px solid black'>"+Math.round(sum)+"</td><td align='center' width='35%' style='text-transform: capitalize; border-right: 1px solid black'>"+Math.round(sum2)+"</td></tr>");

            $("tbody.tableReport2").append("<tr style='font-size: 12px; border: 1px solid black;'><td align='center'>&nbsp;</td><td align='right'>&nbsp;</td><td align='center' width='10%' style='text-transform: capitalize; '>&nbsp;</td><td align='center' width='10%' style='text-transform: capitalize; '>&nbsp;</td><td align='center' width='25%' style='text-transform: capitalize; '>&nbsp;</td><td align='center' width='35%' style='text-transform: capitalize; '>&nbsp;</td></tr><tr style='font-size: 12px; border: 1px solid black;'><td align='center' style='border-right: 1px solid black; font-weight: bold;'>Business Profit/HST</td><td align='right' style='border-right: 1px solid black'>&nbsp;</td><td align='center' width='10%' style='text-transform: capitalize; border-right: 1px solid black'>HST</td><td align='center' width='10%' style='text-transform: capitalize; border-right: 1px solid black'>&nbsp;</td><td align='center' width='25%' style='text-transform: capitalize; border-right: 1px solid black'>"+Math.round(sum3)+"</td><td align='center' width='35%' style='text-transform: capitalize; border-right: 1px solid black'>"+Math.round(sum4)+"</td></tr>");

            $("tbody.tableReport2").append("<tr align='center' id='loadImg'><td colspan='12' align='center'><a href='userDashboard?c=report' type='button' class='btn btn-secondary btn-block'>Reload current report</a></td></tr>");




        }
        else{
          $('.spinner').addClass('disp-0');
          $('tbody.tableReport1').removeClass('disp-0');
        $("tbody.tableReport2").hide();
          swal('Oops', result.res, result.message);
        }


    }

  });
}

function askExperts(name, email){

  var formData = new FormData();
  var route = "{{ URL('Ajax/Expertise') }}";

  if($("#askquestion").val() == ""){
    iziToast.error({
        title: 'Important',
        message: 'You need to ask a question',
    });
  }
  else if($("#service_type").val() == null){
    iziToast.error({
        title: 'Important',
        message: 'Please select service type',
    });
  }
  else{
          var fileSelect = document.getElementById("file");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("file", file , file.name);
       }

      formData.append("email", email);
      formData.append("name", name);
      formData.append("post_id", $("#post_id").val());
      formData.append("askquestion", $("#askquestion").val());
      formData.append("service_type", $("#service_type").val());

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
          $(".spinLoad").removeClass('disp-0');
          $(".btn_post").addClass('disp-0');
        },
        success: function(result){
            if(result.message == "Success"){
              $("#service_type").val('');
              $("#askquestion").val('');
              $(".spinLoad").addClass('disp-0');
            $(".btn_post").removeClass('disp-0');
              iziToast.success({
                title: result.message,
                message: result.res,
            });
          setTimeout(function(){ location.href = result.link; }, 5000);
            }
            else{
              $(".spinLoad").addClass('disp-0');
            $(".btn_post").removeClass('disp-0');
              iziToast.info({
                title: result.message,
                message: result.res,
            });
            }

        }

      });
  }



}


function ansPost(post_id){


var route = "{{ URL('Ajax/ansPost') }}";
var thisdata = {post_id: post_id}
      setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      success: function(result){

        if(result.message == "success"){
          setTimeout(function(){ location.href = result.link; }, 1000);
        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });

}


function postAnswer(post_id){

if($('#commentReply').val() == ''){
  swal('Oops', 'You can\'t send an empty message', 'error');
}
else{

var route = "{{ URL('Ajax/anscurrPost') }}";
var thisdata = {post_id: post_id, auto_care: $('#busStation').val(), answer: $('#commentReply').val()};
      setHeaders();
      jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
        $('.spinLoader').removeClass('disp-0');
      },
      success: function(result){

        if(result.message == "Success"){
          $('#commentReply').val('');
          $('.spinLoader').addClass('disp-0');
          iziToast.success({
              title: result.message,
              message: result.res,
          });
          setTimeout(function(){ location.href = location.origin+'/answerPost/'+result.link; }, 5000);
        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });
}


}



//Invite All
$("#inviteall").click(function(){
  //Click all
  var ref_code = $('.refer_codes').val();
  var allEl = $("#inviteformcontact > div > div > div:nth-child(3) > label");
  allEl.each(function(index, el) {
    var pos = index+1;
    $("#invite"+pos).click();
  });
  $("#inviteall > img").removeClass('disp-0');
  $("button#invite").click();
});


//Invite and submit
$("button#invite").click(function(){
  var form = $("#inviteformcontact > div > div > div:nth-child(3) > input[name^='invite']:checked");
  var a = getFormData(form);
  var ref_code = $('.refer_codes').val();

  if(form.length > 0)
  {
    var i = 0;
    var myVar = setInterval(function(){
      i = i+1;
      //Extract loop value
      const regex = /([0-9]*)$/gm;
      const str = ""+Object.keys(a)[i-1]+"";
      let m;
      m = regex.exec(str)[0];
      //END of Extract

      doAjaxx(location.origin+'/Ajax/InviteContact', {'email' : a[Object.keys(a)[i-1]], 'name': $("#inviteName"+m).html(), 'pos' : i, 'from': ref_code}, i, Object.keys(a).length, m);

      if(i == Object.keys(a).length){
        clearInterval(myVar);
      }

    }, 5000);
  }
  else{
    $("#reseterr").removeClass("disp-0");
    $("#reseterr").html("Empty Selections");
    $("#reseterr").attr('style', 'background: #EEE; color: #000; border-radius: 0px; padding: 5px;');
    $("button#invite#invite > img").addClass('disp-0');
  }


});


// //Invite and submit
// $("button#inviteExcel").click(function(){
//   var form = $("#inviteformcontact > div > div > div:nth-child(3) > input[name^='invite']:checked");
//   var a = getFormData(form);

//   if(form.length > 0)
//   {
//     var i = 0;
//     var myVar = setInterval(function(){
//       i = i+1;
//       //Extract loop value
//       const regex = /([0-9]*)$/gm;
//       const str = ""+Object.keys(a)[i-1]+"";
//       let m;
//       m = regex.exec(str)[0];
//       //END of Extract

//       doAjaxx(location.origin+'/Ajax/InviteContact', {'email' : a[Object.keys(a)[i-1]], 'name': $("#inviteName"+m).html(), 'pos' : i, 'from': 'triggerinvite'}, i, Object.keys(a).length, m);

//       if(i == Object.keys(a).length){
//         clearInterval(myVar);
//       }

//     }, 5000);
//   }
//   else{
//     $("#reseterr").removeClass("disp-0");
//     $("#reseterr").html("Empty Selections");
//     $("#reseterr").attr('style', 'background: #EEE; color: #000; border-radius: 0px; padding: 5px;');
//     $("button#invite#invite > img").addClass('disp-0');
//   }


// });

function getFormData(form){
  $("button#invite > img").removeClass('disp-0');
  $("#reseterr").removeClass("disp-0");
  $("#reseterr").html("Processing....");
  $("#reseterr").attr('style', 'background: red; color: #FFF; border-radius: 0px; padding: 5px;');
    var unindexed_array = form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
       indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}


function doAjaxx(url, data, i=null, lengthArr=null, pos, from=null){

      setHeaders();
      jQuery.ajax({
      url: url,
      method: 'post',
      data: data,
      dataType: 'JSON',
      success: function(result){

        if(result.message == "Success"){
           $("button#invite > img").addClass('disp-0');
  $("#reseterr").addClass("disp-0");
  $("#reseterr").html("");
  $("#reseterr").attr('style', 'display: none;');
          iziToast.success({
              title: result.message,
              message: result.res,
          });
          // setTimeout(function(){ location.href = location.origin+'/userDashboard'; }, 3000);
        }
        else{
          swal('Oops', result.res, result.message);
        }


    }

  });
}


$('#excelFile').change(function(){
  var route = "{{ URL('Ajax/uploadExcel') }}";
  var formData = new FormData();

      var fileSelect = document.getElementById("excelFile");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("file", file , file.name);
       }

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
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
            // alert("Done");
            if(result.message == 'success'){
              $('#excelFile').val('');
              $(".spinner").addClass('disp-0');
              swal("Saved!", result.res, result.message);
              // setTimeout(function(){ location.href = result.link; }, 3000);
            }
            else{
              $('#excelFile').val('');
              $(".spinner").addClass('disp-0');
              swal("Oops!", result.res, result.message);
            }

            // alert(result.res);

        }

      });
});



function checkEstimate(){
  // Is checked
  if($('#estimate').prop('checked') == true){
    $('div#maintenances').attr('style', 'background: aliceblue');
    $('.addOns').removeClass('disp-0');
    $('.addVehicle').addClass('disp-0');
    $('#work_order').attr('disabled', true);
  }
  else if($('#estimate').prop('checked') == false){
    $('div#maintenances').attr('style', 'background: white');
    $('.addOns').addClass('disp-0');
    $('.addVehicle').removeClass('disp-0');
    $('#work_order').attr('disabled', false);
  }
}

function checkWorkorder(){
  // Is checked
  if($('#work_order').prop('checked') == true){
    $('.workorder').removeClass('disp-0');
    $('.addVehicle').addClass('disp-0');
    $('#estimate').attr('disabled', true);
  }
  else if($('#work_order').prop('checked') == false){
    $('.workorder').addClass('disp-0');
    $('.addVehicle').removeClass('disp-0');
    $('#estimate').attr('disabled', false);
  }
}


// Send Mail
function sendMails(key, email){
  // alert(email);
  var route = "{{ URL('Ajax/Estimatemail') }}";
  var thisdata = {est_id: key, email: email}
     setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      $(".spinnersMail").removeClass('disp-0');
    },
    success: function(result){
        // alert("Done");
        if(result.message == 'success'){
          $(".spinnersMail").addClass('disp-0');
          swal("Saved!", result.res, result.message);
          setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 2000);
        }
        else{
          $(".spinnersMail").addClass('disp-0');
          swal("Oops!", result.res, result.message);
        }

        // alert(result.res);

    }

  });
}

// Send Mail
function vehicleBalMails(key, email){
  // alert(email);
  var route = "{{ URL('Ajax/vehiclebalMails') }}";
  var thisdata = {est_id: key, email: email}
     setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      $(".spinnersMail").removeClass('disp-0');
    },
    success: function(result){
        // alert("Done");
        if(result.message == 'success'){
          $(".spinnersMail").addClass('disp-0');
          swal("Saved!", result.res, result.message);
          setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 2000);
        }
        else{
          $(".spinnersMail").addClass('disp-0');
          swal("Oops!", result.res, result.message);
        }

        // alert(result.res);

    }

  });
}

// Send Mail
function vendorMails(key, email){
  // alert(email);
  var route = "{{ URL('Ajax/vendormail') }}";
  var thisdata = {pay_po_number: key}
     setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      $(".spinnersMail").removeClass('disp-0');
    },
    success: function(result){
        // alert("Done");
        if(result.message == 'success'){
          $(".spinnersMail").addClass('disp-0');
          swal("Saved!", result.res, result.message);
          setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 2000);
        }
        else{
          $(".spinnersMail").addClass('disp-0');
          swal("Oops!", result.res, result.message);
        }

        // alert(result.res);

    }

  });
}

function setAllocate(name, ival){
  // console.log(name + " | "+ival);
}

function estimateSave(){
  var route = "{{ URL('Ajax/EstimatSave') }}";

       //Process 2
       var proc = ['material_qty', 'labour_qty', 'material_cost', 'labour_cost'];
       var procLen = proc.length;

       for(var iproc = 1; iproc <= 10; iproc++){
        for(jproc = 0; jproc < procLen; jproc++){

          //For first val
          if(iproc == 1){
            var name = proc[jproc];
            var ival = "N/A";
            var other = $("#"+proc[jproc]).val();
          }
          else{
            //For Other Val
            var name = proc[jproc]+iproc;
            var ival = "0";
            var other = $("#"+proc[jproc]+iproc).val();
          }

          //Check other returned values
          if(other.length < 1){
            setAllocate(name, ival);
          }

        }
      }
        // Check Important Fields
      // alert(100);

      if($("#email").val() == "" || $("#telephone").val() == "" || $("#vehicle_licence").val() == "" || $("#date").val() == "" || $("#modelz").val() == "" || $("#service_type").val() == "" || $("#service_option").val() == "" || $("#other_qty").val() == "" || $("#other_cost").val() == "" || $("#total_cost").val() == "" || $("#mileage").val() == "")
      {
        swal('Oops', 'Kindly Fill Required Fields', 'info');
      }
      else{
        // alert(12);
        var formData = new FormData();

        var fileSelect = document.getElementById("file");
        if(fileSelect.files && fileSelect.files.length == 1){
           var file = fileSelect.files[0]
           formData.set("file", file , file.name);
         }

      //SetFormdata
      var setformdata = [
        {appendTo: 'estimate_id', selector: 'estimate_id'},
        {appendTo: 'vin_number', selector: 'vin_number'},
        {appendTo: 'email', selector: 'email'},
        {appendTo: 'telephone', selector: 'telephone'},
        {appendTo: 'busID', selector: 'businessID'},
        {appendTo: 'make', selector: 'make'},
        {appendTo: 'model', selector: 'modelz'},
        {appendTo: 'vehicle_licence', selector: 'vehicle_licence'},
        {appendTo: 'date', selector: 'date'},
        {appendTo: 'service_type', selector: 'service_type'},
        {appendTo: 'service_option', selector: 'service_option'},
        {appendTo: 'service_item_spec', selector: 'service_item_spec'},
        {appendTo: 'service_item_spec2', selector: 'service_item_spec2'},
        {appendTo: 'service_item_spec3', selector: 'service_item_spec3'},
        {appendTo: 'manufacturer', selector: 'manufacturer'},
        {appendTo: 'manufacturer2', selector: 'manufacturer2'},
        {appendTo: 'manufacturer3', selector: 'manufacturer3'},
        {appendTo: 'material_qty', selector: 'material_qty'},
        {appendTo: 'material_qty2', selector: 'material_qty2'},
        {appendTo: 'material_qty3', selector: 'material_qty3'},
        {appendTo: 'material_qty4', selector: 'material_qty4'},
        {appendTo: 'material_qty5', selector: 'material_qty5'},
        {appendTo: 'material_qty6', selector: 'material_qty6'},
        {appendTo: 'material_qty7', selector: 'material_qty7'},
        {appendTo: 'material_qty8', selector: 'material_qty8'},
        {appendTo: 'material_qty9', selector: 'material_qty9'},
        {appendTo: 'material_qty10', selector: 'material_qty10'},
        {appendTo: 'material_cost', selector: 'material_cost'},
        {appendTo: 'material_cost2', selector: 'material_cost2'},
        {appendTo: 'material_cost3', selector: 'material_cost3'},
        {appendTo: 'material_cost4', selector: 'material_cost4'},
        {appendTo: 'material_cost5', selector: 'material_cost5'},
        {appendTo: 'material_cost6', selector: 'material_cost6'},
        {appendTo: 'material_cost7', selector: 'material_cost7'},
        {appendTo: 'material_cost8', selector: 'material_cost8'},
        {appendTo: 'material_cost9', selector: 'material_cost9'},
        {appendTo: 'material_cost10', selector: 'material_cost10'},
        {appendTo: 'labour_qty', selector: 'labour_qty'},
        {appendTo: 'labour_qty2', selector: 'labour_qty2'},
        {appendTo: 'labour_qty3', selector: 'labour_qty3'},
        {appendTo: 'labour_qty4', selector: 'labour_qty4'},
        {appendTo: 'labour_qty5', selector: 'labour_qty5'},
        {appendTo: 'labour_qty6', selector: 'labour_qty6'},
        {appendTo: 'labour_qty7', selector: 'labour_qty7'},
        {appendTo: 'labour_qty8', selector: 'labour_qty8'},
        {appendTo: 'labour_qty9', selector: 'labour_qty9'},
        {appendTo: 'labour_qty10', selector: 'labour_qty10'},
        {appendTo: 'labour_cost', selector: 'labour_cost'},
        {appendTo: 'labour_cost2', selector: 'labour_cost2'},
        {appendTo: 'labour_cost3', selector: 'labour_cost3'},
        {appendTo: 'labour_cost4', selector: 'labour_cost4'},
        {appendTo: 'labour_cost5', selector: 'labour_cost5'},
        {appendTo: 'labour_cost6', selector: 'labour_cost6'},
        {appendTo: 'labour_cost7', selector: 'labour_cost7'},
        {appendTo: 'labour_cost8', selector: 'labour_cost8'},
        {appendTo: 'labour_cost9', selector: 'labour_cost9'},
        {appendTo: 'labour_cost10', selector: 'labour_cost10'},
        {appendTo: 'labour_hour', selector: 'labour_qty'},
        {appendTo: 'labour_rate', selector: 'labour_rate1'},
        {appendTo: 'labour_hour2', selector: 'labour_qty2'},
        {appendTo: 'labour_rate2', selector: 'labour_rate2'},
        {appendTo: 'labour_hour3', selector: 'labour_qt3'},
        {appendTo: 'labour_rate3', selector: 'labour_rate3'},
        {appendTo: 'labour_hour4', selector: 'labour_qty4'},
        {appendTo: 'labour_rate4', selector: 'labour_rate4'},
        {appendTo: 'labour_hour5', selector: 'labour_qty5'},
        {appendTo: 'labour_rate5', selector: 'labour_rate5'},
        {appendTo: 'labour_hour6', selector: 'labour_qty6'},
        {appendTo: 'labour_rate6', selector: 'labour_rate6'},
        {appendTo: 'labour_hour7', selector: 'labour_qty7'},
        {appendTo: 'labour_rate7', selector: 'labour_rate7'},
        {appendTo: 'labour_hour8', selector: 'labour_qty8'},
        {appendTo: 'labour_rate8', selector: 'labour_rate8'},
        {appendTo: 'labour_hour9', selector: 'labour_qty9'},
        {appendTo: 'labour_rate9', selector: 'labour_rate9'},
        {appendTo: 'labour_hour10', selector: 'labour_qty10'},
        {appendTo: 'labour_rate10', selector: 'labour_rate10'},
        {appendTo: 'other_qty', selector: 'other_qty'},
        {appendTo: 'other_cost', selector: 'other_cost'},
        {appendTo: 'total_cost', selector: 'total_cost'},
        {appendTo: 'service_note', selector: 'service_note'},
        {appendTo: 'mileage', selector: 'mileage'},
        {appendTo: 'update_by', selector: 'update_by'},
        {appendTo: 'inventory_list1', selector: 'inventory_list1'},
        {appendTo: 'inventory_amount1', selector: 'inventory_amount1'},
        {appendTo: 'inventory_addnote1', selector: 'inventory_list1'},
        {appendTo: 'inventory_list2', selector: 'inventory_list2'},
        {appendTo: 'inventory_amount2', selector: 'inventory_amount2'},
        {appendTo: 'inventory_addnote2', selector: 'inventory_list2'},
        {appendTo: 'inventory_list3', selector: 'inventory_list3'},
        {appendTo: 'inventory_amount3', selector: 'inventory_amount3'},
        {appendTo: 'inventory_addnote3', selector: 'inventory_list3'},
        {appendTo: 'technician', selector: 'technician_in_charge'},
        {appendTo: 'opportunity_id', selector: 'opportunity_ids'}
      ];
      var setformdataLen = setformdata.length;
        for(jproc = 0; jproc < setformdataLen; jproc++){
          formData.append(setformdata[jproc].appendTo, $("#"+setformdata[jproc].selector).val());
        }


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
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
            if(result.message == "success"){

            $("#estimate_id").val('<?php echo uniqid()."_".time()?>');
            $("#vin_number").val('');
            $("#email").val('');
            $("#telephone").val('');
            $("#make").val('');
            $("#modelz").val('');
            $("#vehicle_licence").val('');
            $("#date").val('');
            $("#service_type").val('');
            $("#service_option").val('');
            $("#service_item_spec").val('');
            $("#service_item_spec2").val('');
            $("#service_item_spec3").val('');
            $("#manufacturer").val('');
            $("#manufacturer2").val('');
            $("#manufacturer3").val('');
            $("#material_qty").val('');
            $("#material_qty2").val('');
            $("#material_qty3").val('');
            $("#material_qty4").val('');
            $("#material_qty5").val('');
            $("#material_qty6").val('');
            $("#material_qty7").val('');
            $("#material_qty8").val('');
            $("#material_qty9").val('');
            $("#material_qty10").val('');
            $("#material_cost").val('');
            $("#material_cost2").val('');
            $("#material_cost3").val('');
            $("#material_cost4").val('');
            $("#material_cost5").val('');
            $("#material_cost6").val('');
            $("#material_cost7").val('');
            $("#material_cost8").val('');
            $("#material_cost9").val('');
            $("#material_cost10").val('');
            $("#labour_qty").val('');
            $("#labour_qty2").val('');
            $("#labour_qty3").val('');
            $("#labour_qty4").val('');
            $("#labour_qty5").val('');
            $("#labour_qty6").val('');
            $("#labour_qty7").val('');
            $("#labour_qty8").val('');
            $("#labour_qty9").val('');
            $("#labour_qty10").val('');
            $("#labour_cost").val('');
            $("#labour_cost2").val('');
            $("#labour_cost3").val('');
            $("#labour_cost4").val('');
            $("#labour_cost5").val('');
            $("#labour_cost6").val('');
            $("#labour_cost7").val('');
            $("#labour_cost8").val('');
            $("#labour_cost9").val('');
            $("#labour_cost10").val('');
            $("#other_qty").val('');
            $("#other_cost").val('');
            $("#total_cost").val('');
            $("#service_note").val('');
            $("#mileage").val('');
            $("#file").val('');
            $("#technician").prop('selectedIndex',0);
            $(".spinner").addClass('disp-0');

            var res = JSON.parse(result.data);


              $('tbody#estimateRes').html("<tr style='font-size: 11px;'><td style='color: darkblue; font-weight: bold; font-size: 13px;'>NEW</td><td>"+res[0].vehicle_licence+"</td><td>"+res[0].date+"</td><td>"+res[0].service_type+"</td><td>"+res[0].service_option+"</td><td>"+res[0].total_cost+"</td><td>"+res[0].service_note+"</td><td>"+res[0].mileage+"</td><td><a style='font-size: 12px; color: darkblue; font-weight: bolder;' href='/uploads/"+res[0].file+"' download>Download file</a></td><td>"+res[0].update_by+"</td><td><i type='button' style='padding: 10px;' title='Edit' class='fas fa-edit text-danger' style='text-align: center; cursor: pointer;' onclick=editRecs(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to diagnostic' class='fas fa-shopping-cart' onclick=diagnostic(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to work order' class='fas fa-exchange-alt' onclick=workOrders(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Resend mail' class='fas fa-paper-plane text-primary mailPlane' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Print copy' class='fas fa-print text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td></tr>");

              $(".spinner").addClass('disp-0');

              swal("Thanks!", result.res, result.message);
          }
          else{
            $(".spinner").addClass('disp-0');

            swal("Oops!", result.res, result.message);
          }

        }

      });
    }
}



function editRecs(id){
    var route = "{{ URL('Ajax/editEstimates') }}";
    var thisdata = {post_id: id};

            setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){

          if(result.message == "success"){
            var res = JSON.parse(result.data);
            // Scroll Top, mark estimate checkbox and disable from clicks
                $('#estimate').attr('checked', true);
                $('#estimate').attr('disabled', true);
                $('#work_order').attr('disabled', true);
                scrollTarget('editEstimate');

            // Insert Record
                $("#estimate_id").val(res[0].estimate_id);
              $("#email").val(res[0].email);
              $("#telephone").val(res[0].telephone);
              $("#make").val(res[0].make);
              $("#modelz").val(res[0].model);
              $("#vehicle_licence").val(res[0].vehicle_licence);
              $("#date").val(res[0].date);
              $("#service_type").val(res[0].service_type);
              $("#service_option").val(res[0].service_option);
              $("#service_item_spec").val(res[0].service_item_spec);
              $("#service_item_spec2").val(res[0].service_item_spec2);
              $("#service_item_spec3").val(res[0].service_item_spec3);
              $("#manufacturer").val(res[0].manufacturer);
              $("#manufacturer2").val(res[0].manufacturer2);
              $("#manufacturer3").val(res[0].manufacturer3);
              $("#material_qty").val(res[0].material_qty);
              $("#material_qty2").val(res[0].material_qty2);
              $("#material_qty3").val(res[0].material_qty3);
              $("#material_qty4").val(res[0].material_qty4);
              $("#material_qty5").val(res[0].material_qty5);
              $("#material_qty6").val(res[0].material_qty6);
              $("#material_qty7").val(res[0].material_qty7);
              $("#material_qty8").val(res[0].material_qty8);
              $("#material_qty9").val(res[0].material_qty9);
              $("#material_qty10").val(res[0].material_qty10);
              $("#material_cost").val(res[0].material_cost);
              $("#material_cost2").val(res[0].material_cost2);
              $("#material_cost3").val(res[0].material_cost3);
              $("#material_cost4").val(res[0].material_cost4);
              $("#material_cost5").val(res[0].material_cost5);
              $("#material_cost6").val(res[0].material_cost6);
              $("#material_cost7").val(res[0].material_cost7);
              $("#material_cost8").val(res[0].material_cost8);
              $("#material_cost9").val(res[0].material_cost9);
              $("#material_cost10").val(res[0].material_cost10);
              $("#labour_qty").val(res[0].labour_qty);
              $("#labour_qty2").val(res[0].labour_qty2);
              $("#labour_qty3").val(res[0].labour_qty3);
              $("#labour_qty4").val(res[0].labour_qty4);
              $("#labour_qty5").val(res[0].labour_qty5);
              $("#labour_qty6").val(res[0].labour_qty6);
              $("#labour_qty7").val(res[0].labour_qty7);
              $("#labour_qty8").val(res[0].labour_qty8);
              $("#labour_qty9").val(res[0].labour_qty9);
              $("#labour_qty10").val(res[0].labour_qty10);
              $("#labour_cost").val(res[0].labour_cost);
              $("#labour_cost2").val(res[0].labour_cost2);
              $("#labour_cost3").val(res[0].labour_cost3);
              $("#labour_cost4").val(res[0].labour_cost4);
              $("#labour_cost5").val(res[0].labour_cost5);
              $("#labour_cost6").val(res[0].labour_cost6);
              $("#labour_cost7").val(res[0].labour_cost7);
              $("#labour_cost8").val(res[0].labour_cost8);
              $("#labour_cost9").val(res[0].labour_cost9);
              $("#labour_cost10").val(res[0].labour_cost10);
              $("#other_qty").val(res[0].other_qty);
              $("#other_cost").val(res[0].other_cost);
              $("#total_cost").val(res[0].total_cost);
              $("#service_note").val(res[0].service_note);
              $("#mileage").val(res[0].mileage);

              // Generate New Button
              $('.editable').removeClass('disp-0');
              $('.addVehicle').addClass('disp-0');
              $('.addOns').addClass('disp-0');
              $('.workorder').addClass('disp-0');
          }
          else{
              swal('Oops!', result.res, result.message);
          }

        }

      });

}

function saveEdited(){
    var spinner = $('.spinneredit');
    var route = "{{ URL('Ajax/saveEdit') }}";

    // Start

    if($("#email").val() == "" || $("#telephone").val() == "" || $("#vehicle_licence").val() == "" || $("#date").val() == "" || $("#modelz").val() == "" || $("#service_type").val() == "" || $("#service_option").val() == "" || $("#other_qty").val() == "" || $("#other_cost").val() == "" || $("#total_cost").val() == "" || $("#mileage").val() == "")
      {
        swal('Oops', 'Kindly Fill Required Fields', 'info');
      }
      else if($("#service_item_spec").val() == ""){
        $("#service_item_spec").val('n/a');
      }
      else if($("#technician_in_charge").val() == ""){
        $("#technician_in_charge").val('n/a');
      }
      else if($("#manufacturer").val() == ""){
        $("#manufacturer").val('n/a');
      }
      else if($("#material_qty").val() == ""){
        $("#material_qty").val('0');
      }
      else if($("#material_cost").val() == ""){
        $("#material_cost").val('0');
      }
      else if($("#labour_qty").val() == ""){
        $("#labour_qty").val('0');
      }
      else if($("#labour_cost").val() == ""){
        $("#labour_cost").val('0');
      }
      else if($("#material_qty2").val() == ""){
        $("#material_qty2").val('0');
      }
      else if($("#material_cost2").val() == ""){
        $("#material_cost2").val('0');
      }

      else if($("#labour_qty2").val() == ""){
        $("#labour_qty2").val('0');
      }
      else if($("#labour_qty3").val() == ""){
        $("#labour_qty3").val('0');
      }
      else if($("#labour_qty4").val() == ""){
        $("#labour_qty4").val('0');
      }
      else if($("#labour_qty5").val() == ""){
        $("#labour_qty5").val('0');
      }
      else if($("#labour_qty6").val() == ""){
        $("#labour_qty6").val('0');
      }
      else if($("#labour_qty7").val() == ""){
        $("#labour_qty7").val('0');
      }
      else if($("#labour_qty8").val() == ""){
        $("#labour_qty8").val('0');
      }
      else if($("#labour_qty9").val() == ""){
        $("#labour_qty9").val('0');
      }
      else if($("#labour_qty10").val() == ""){
        $("#labour_qty10").val('0');
      }
      else if($("#labour_cost2").val() == ""){
        $("#labour_cost2").val('0');
      }
      else if($("#labour_cost3").val() == ""){
        $("#labour_cost3").val('0');
      }
      else if($("#labour_cost4").val() == ""){
        $("#labour_cost4").val('0');
      }
      else if($("#labour_cost5").val() == ""){
        $("#labour_cost5").val('0');
      }
      else if($("#labour_cost6").val() == ""){
        $("#labour_cost6").val('0');
      }
      else if($("#labour_cost7").val() == ""){
        $("#labour_cost7").val('0');
      }
      else if($("#labour_cost8").val() == ""){
        $("#labour_cost8").val('0');
      }
      else if($("#labour_cost9").val() == ""){
        $("#labour_cost9").val('0');
      }
      else if($("#labour_cost10").val() == ""){
        $("#labour_cost10").val('0');
      }
      else if($("#material_qty3").val() == ""){
        $("#material_qty3").val('0');
      }
      else if($("#material_qty4").val() == ""){
        $("#material_qty4").val('0');
      }
      else if($("#material_qty5").val() == ""){
        $("#material_qty5").val('0');
      }
      else if($("#material_qty6").val() == ""){
        $("#material_qty6").val('0');
      }
      else if($("#material_qty7").val() == ""){
        $("#material_qty7").val('0');
      }
      else if($("#material_qty8").val() == ""){
        $("#material_qty8").val('0');
      }
      else if($("#material_qty9").val() == ""){
        $("#material_qty9").val('0');
      }
      else if($("#material_qty10").val() == ""){
        $("#material_qty10").val('0');
      }
      else if($("#material_cost3").val() == ""){
        $("#material_cost3").val('0');
      }
      else if($("#material_cost4").val() == ""){
        $("#material_cost4").val('0');
      }
      else if($("#material_cost5").val() == ""){
        $("#material_cost5").val('0');
      }
      else if($("#material_cost6").val() == ""){
        $("#material_cost6").val('0');
      }
      else if($("#material_cost7").val() == ""){
        $("#material_cost7").val('0');
      }
      else if($("#material_cost8").val() == ""){
        $("#material_cost8").val('0');
      }
      else if($("#material_cost9").val() == ""){
        $("#material_cost9").val('0');
      }
      else if($("#material_cost10").val() == ""){
        $("#material_cost10").val('0');
      }

      else{
          var formData = new FormData();

      var fileSelect = document.getElementById("file");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("file", file , file.name);
       }

      formData.append("estimate_id", $("#estimate_id").val());
      formData.append("email", $("#email").val());
      formData.append("vin_number", $("#vin_number").val());
      formData.append("telephone", $("#telephone").val());
      formData.append("busID", $("#businessID").val());
      formData.append("make", $("#make").val());
      formData.append("model", $("#modelz").val());
      formData.append("vehicle_licence", $("#vehicle_licence").val());
      formData.append("date", $("#date").val());
      formData.append("service_type", $("#service_type").val());
      formData.append("service_option", $("#service_option").val());
      formData.append("service_item_spec", $("#service_item_spec").val());
      formData.append("service_item_spec2", $("#service_item_spec2").val());
      formData.append("service_item_spec3", $("#service_item_spec3").val());
      formData.append("manufacturer", $("#manufacturer").val());
      formData.append("manufacturer2", $("#manufacturer2").val());
      formData.append("manufacturer3", $("#manufacturer3").val());
      formData.append("material_qty", $("#material_qty").val());
      formData.append("material_qty2", $("#material_qty2").val());
      formData.append("material_qty3", $("#material_qty3").val());
      formData.append("material_qty4", $("#material_qty4").val());
      formData.append("material_qty5", $("#material_qty5").val());
      formData.append("material_qty6", $("#material_qty6").val());
      formData.append("material_qty7", $("#material_qty7").val());
      formData.append("material_qty8", $("#material_qty8").val());
      formData.append("material_qty9", $("#material_qty9").val());
      formData.append("material_qty10", $("#material_qty10").val());
      formData.append("material_cost", $("#material_cost").val());
      formData.append("material_cost2", $("#material_cost2").val());
      formData.append("material_cost3", $("#material_cost3").val());
      formData.append("material_cost4", $("#material_cost4").val());
      formData.append("material_cost5", $("#material_cost5").val());
      formData.append("material_cost6", $("#material_cost6").val());
      formData.append("material_cost7", $("#material_cost7").val());
      formData.append("material_cost8", $("#material_cost8").val());
      formData.append("material_cost9", $("#material_cost9").val());
      formData.append("material_cost10", $("#material_cost10").val());
      formData.append("labour_qty", $("#labour_qty").val());
      formData.append("labour_qty2", $("#labour_qty2").val());
      formData.append("labour_qty3", $("#labour_qty3").val());
      formData.append("labour_qty4", $("#labour_qty4").val());
      formData.append("labour_qty5", $("#labour_qty5").val());
      formData.append("labour_qty6", $("#labour_qty6").val());
      formData.append("labour_qty7", $("#labour_qty7").val());
      formData.append("labour_qty8", $("#labour_qty8").val());
      formData.append("labour_qty9", $("#labour_qty9").val());
      formData.append("labour_qty10", $("#labour_qty10").val());
      formData.append("labour_cost", $("#labour_cost").val());
      formData.append("labour_cost2", $("#labour_cost2").val());
      formData.append("labour_cost3", $("#labour_cost3").val());
      formData.append("labour_cost4", $("#labour_cost4").val());
      formData.append("labour_cost5", $("#labour_cost5").val());
      formData.append("labour_cost6", $("#labour_cost6").val());
      formData.append("labour_cost7", $("#labour_cost7").val());
      formData.append("labour_cost8", $("#labour_cost8").val());
      formData.append("labour_cost9", $("#labour_cost9").val());
      formData.append("labour_cost10", $("#labour_cost10").val());
      formData.append("other_qty", $("#other_qty").val());
      formData.append("other_cost", $("#other_cost").val());
      formData.append("total_cost", $("#total_cost").val());
      formData.append("service_note", $("#service_note").val());
      formData.append("mileage", $("#mileage").val());
      formData.append("update_by", $("#update_by").val());
      formData.append("inventory_list1", $("#inventory_list1").val());
      formData.append("inventory_amount1", $("#inventory_amount1").val());
      formData.append("inventory_addnote1", $("#inventory_list1").val());
      formData.append("inventory_list2", $("#inventory_list2").val());
      formData.append("inventory_amount2", $("#inventory_amount2").val());
      formData.append("inventory_addnote2", $("#inventory_list2").val());
      formData.append("inventory_list3", $("#inventory_list3").val());
      formData.append("inventory_amount3", $("#inventory_amount3").val());
      formData.append("inventory_addnote3", $("#inventory_list3").val());
      formData.append("technician", $("#technician_in_charge").val());

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
          var res = JSON.parse(result.data);
          $("#estimate_id").val('<?php echo uniqid()."_".time()?>');
          $("#email").val('');
          $("#vin_number").val('');
          $("#telephone").val('');
          $("#make").val('');
          $("#modelz").val('');
          $("#vehicle_licence").val('');
          $("#date").val('');
          $("#service_type").val('');
          $("#service_option").val('');
          $("#service_item_spec").val('');
          $("#service_item_spec2").val('');
          $("#service_item_spec3").val('');
          $("#manufacturer").val('');
          $("#manufacturer2").val('');
          $("#manufacturer3").val('');
          $("#material_qty").val('');
          $("#material_qty2").val('');
          $("#material_qty3").val('');
          $("#material_qty4").val('');
          $("#material_qty5").val('');
          $("#material_qty6").val('');
          $("#material_qty7").val('');
          $("#material_qty8").val('');
          $("#material_qty9").val('');
          $("#material_qty10").val('');
          $("#material_cost").val('');
          $("#material_cost2").val('');
          $("#material_cost3").val('');
          $("#material_cost4").val('');
          $("#material_cost5").val('');
          $("#material_cost6").val('');
          $("#material_cost7").val('');
          $("#material_cost8").val('');
          $("#material_cost9").val('');
          $("#material_cost10").val('');
          $("#labour_qty").val('');
          $("#labour_qty2").val('');
          $("#labour_qty3").val('');
          $("#labour_qty4").val('');
          $("#labour_qty5").val('');
          $("#labour_qty6").val('');
          $("#labour_qty7").val('');
          $("#labour_qty8").val('');
          $("#labour_qty9").val('');
          $("#labour_qty10").val('');
          $("#labour_cost").val('');
          $("#labour_cost2").val('');
          $("#labour_cost3").val('');
          $("#labour_cost4").val('');
          $("#labour_cost5").val('');
          $("#labour_cost6").val('');
          $("#labour_cost7").val('');
          $("#labour_cost8").val('');
          $("#labour_cost9").val('');
          $("#labour_cost10").val('');
          $("#other_qty").val('');
          $("#other_cost").val('');
          $("#total_cost").val('');
          $("#service_note").val('');
          $("#mileage").val('');
          $("#file").val('');
          $("#technician").prop('selectedIndex',0);
          spinner.addClass('disp-0');


            $('tbody#estimateRes').html("<tr style='font-size: 11px;'><td style='color: green; font-weight: bold; font-size: 13px;'>UPDATED</td><td>"+res[0].vehicle_licence+"</td><td>"+res[0].date+"</td><td>"+res[0].service_type+"</td><td>"+res[0].service_option+"</td><td>"+res[0].total_cost+"</td><td>"+res[0].service_note+"</td><td>"+res[0].mileage+"</td><td><a style='font-size: 12px; color: darkblue; font-weight: bolder;' href='/uploads/"+res[0].file+"' download>Download file</a></td><td>"+res[0].update_by+"</td><td><i type='button' style='padding: 10px;' title='Edit' class='fas fa-edit text-danger' style='text-align: center; cursor: pointer;' onclick=editRecs(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to diagnostic' class='fas fa-shopping-cart' onclick=diagnostic(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to work order' class='fas fa-exchange-alt' onclick=workOrders(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Resend mail' class='fas fa-paper-plane text-primary mailPlane' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Print copy' class='fas fa-print text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td></tr>");

            swal("Thanks!", result.res, result.message);

          // setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
    }

    // End
}

function getPage(id){
  // Redirect to page
  var url = "Estimatedetail/"+id;

  var win = window.open(url, '_blank');
  win.focus();

}



function workOrders(id){
  var route = "{{ URL('Ajax/moveWorkorder') }}";
  var thisdata = {post_id: id}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $('tbody#estimateRes').html("<tr align='center'><td colspan='27'><img src='https://cdn.dribbble.com/users/172519/screenshots/3520576/dribbble-spinner-800x600.gif' style='width: 50px; height: 50px;'></td></tr>");
        },
        success: function(result){
          var res = JSON.parse(result.data);
          $('tbody#estimateRes').html("<tr align='center'><td style='font-weight: bold; color: darkblue;' colspan='27'>This section is active when an estimate is generated</td></tr>");

          $('tbody#workorderRes').html("<tr style='font-size: 11px;'><td style='color: darkblue; font-weight: bold; font-size: 13px;'>NEW</td><td>"+res[0].vehicle_licence+"</td><td>"+res[0].date+"</td><td>"+res[0].service_type+"</td><td>"+res[0].service_option+"</td><td>"+res[0].total_cost+"</td><td>"+res[0].service_note+"</td><td>"+res[0].mileage+"</td><td><a style='font-size: 12px; color: darkblue; font-weight: bolder;' href='/uploads/"+res[0].file+"' download>Download file</a></td><td>"+res[0].update_by+"</td><td><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Move to Estimate' class='fas fa-exchange-alt' onclick=estimateOrders(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Move to Maintenance Record' class='fas fa-tools' onclick=maintenanceOrders(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Resend mail' class='fas fa-paper-plane text-primary mailPlane' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Print copy' class='fas fa-print text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td></tr>");

          swal("Thanks!", result.res, result.message);
          // setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
}

function estimateOrders(id){
  var route = "{{ URL('Ajax/moveEstimateorder') }}";
  var thisdata = {post_id: id}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $('tbody#workorderRes').html("<tr align='center'><td colspan='27'><img src='https://cdn.dribbble.com/users/172519/screenshots/3520576/dribbble-spinner-800x600.gif' style='width: 50px; height: 50px;'></td></tr>");
        },
        success: function(result){
          var res = JSON.parse(result.data);
          $('tbody#workorderRes').html("<tr align='center'><td style='font-weight: bold; color: darkblue;' colspan='27'>This section is active when work order is generated</td></tr>");

          $('tbody#estimateRes').html("<tr style='font-size: 11px;'><td style='color: darkblue; font-weight: bold; font-size: 13px;'>NEW</td><td>"+res[0].vehicle_licence+"</td><td>"+res[0].date+"</td><td>"+res[0].service_type+"</td><td>"+res[0].service_option+"</td><td>"+res[0].total_cost+"</td><td>"+res[0].service_note+"</td><td>"+res[0].mileage+"</td><td><a style='font-size: 12px; color: darkblue; font-weight: bolder;' href='/uploads/"+res[0].file+"' download>Download file</a></td><td>"+res[0].update_by+"</td><td><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to diagnostic' class='fas fa-shopping-cart' onclick=diagnostic(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Close to work order' class='fas fa-exchange-alt' onclick=workOrders(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Resend mail' class='fas fa-paper-plane text-primary mailPlane' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Print copy' class='fas fa-print text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td></tr>");

          swal("Thanks!", result.res, result.message);
          // setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
}

function workOrderSave(){
  var route = "{{ URL('Ajax/WorkorderSave') }}";
        // Check Important Fields

               //Process 2
       var proc = ['material_qty', 'labour_qty', 'material_cost', 'labour_cost'];
       var procLen = proc.length;

       for(var iproc = 1; iproc <= 10; iproc++){
        for(jproc = 0; jproc < procLen; jproc++){

          //For first val
          if(iproc == 1){
            var name = proc[jproc];
            var ival = "N/A";
            var other = $("#"+proc[jproc]).val();
          }
          else{
            //For Other Val
            var name = proc[jproc]+iproc;
            var ival = "0";
            var other = $("#"+proc[jproc]+iproc).val();
          }

          //Check other returned values
          if(other.length < 1){
            setAllocate(name, ival);
          }

        }
      }

      if($("#email").val() == "" || $("#telephone").val() == "" || $("#vehicle_licence").val() == "" || $("#date").val() == "" || $("#modelz").val() == "" || $("#service_type").val() == "" || $("#service_option").val() == "" || $("#other_qty").val() == "" || $("#other_cost").val() == "" || $("#total_cost").val() == "" || $("#mileage").val() == "")
      {
        swal('Oops', 'Kindly Fill Required Fields', 'info');
      }

      else{
          var formData = new FormData();

      var fileSelect = document.getElementById("file");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("file", file , file.name);
       }

       //SetFormdata
      var setformdata = [
        {appendTo: 'estimate_id', selector: 'estimate_id'},
        {appendTo: 'vin_number', selector: 'vin_number'},
        {appendTo: 'opportunity_id', selector: 'opportunity_id'},
        {appendTo: 'email', selector: 'email'},
        {appendTo: 'telephone', selector: 'telephone'},
        {appendTo: 'busID', selector: 'businessID'},
        {appendTo: 'make', selector: 'make'},
        {appendTo: 'model', selector: 'modelz'},
        {appendTo: 'vehicle_licence', selector: 'vehicle_licence'},
        {appendTo: 'date', selector: 'date'},
        {appendTo: 'service_type', selector: 'service_type'},
        {appendTo: 'service_option', selector: 'service_option'},
        {appendTo: 'service_item_spec', selector: 'service_item_spec'},
        {appendTo: 'service_item_spec2', selector: 'service_item_spec2'},
        {appendTo: 'service_item_spec3', selector: 'service_item_spec3'},
        {appendTo: 'manufacturer', selector: 'manufacturer'},
        {appendTo: 'manufacturer2', selector: 'manufacturer2'},
        {appendTo: 'manufacturer3', selector: 'manufacturer3'},
        {appendTo: 'material_qty', selector: 'material_qty'},
        {appendTo: 'material_qty2', selector: 'material_qty2'},
        {appendTo: 'material_qty3', selector: 'material_qty3'},
        {appendTo: 'material_cost', selector: 'material_cost'},
        {appendTo: 'material_cost2', selector: 'material_cost2'},
        {appendTo: 'material_cost3', selector: 'material_cost3'},
        {appendTo: 'labour_qty', selector: 'labour_qty'},
        {appendTo: 'labour_qty2', selector: 'labour_qty2'},
        {appendTo: 'labour_cost', selector: 'labour_cost'},
        {appendTo: 'labour_cost2', selector: 'labour_cost2'},
        {appendTo: 'other_qty', selector: 'other_qty'},
        {appendTo: 'other_cost', selector: 'other_cost'},
        {appendTo: 'total_cost', selector: 'total_cost'},
        {appendTo: 'service_note', selector: 'service_note'},
        {appendTo: 'mileage', selector: 'mileage'},
        {appendTo: 'update_by', selector: 'update_by'},
        {appendTo: 'inventory_list1', selector: 'inventory_list1'},
        {appendTo: 'inventory_amount1', selector: 'inventory_amount1'},
        {appendTo: 'inventory_addnote1', selector: 'inventory_list1'},
        {appendTo: 'inventory_list2', selector: 'inventory_list2'},
        {appendTo: 'inventory_amount2', selector: 'inventory_amount2'},
        {appendTo: 'inventory_addnote2', selector: 'inventory_list2'},
        {appendTo: 'inventory_list3', selector: 'inventory_list3'},
        {appendTo: 'inventory_amount3', selector: 'inventory_amount3'},
        {appendTo: 'inventory_addnote3', selector: 'inventory_list3'},
        {appendTo: 'technician', selector: 'technician_in_charge'}
      ];
      var setformdataLen = setformdata.length;
        for(jproc = 0; jproc < setformdataLen; jproc++){
          formData.append(setformdata[jproc].appendTo, $("#"+setformdata[jproc].selector).val());
        }


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
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
          var res = JSON.parse(result.data);
          $("#email").val('');
          $("#telephone").val('');
          $("#make").val('');
          $("#modelz").val('');
          $("#vehicle_licence").val('');
          $("#date").val('');
          $("#service_type").val('');
          $("#service_option").val('');
          $("#service_item_spec").val('');
          $("#service_item_spec2").val('');
          $("#service_item_spec3").val('');
          $("#manufacturer").val('');
          $("#manufacturer2").val('');
          $("#manufacturer3").val('');
          $("#material_qty").val('');
          $("#material_qty2").val('');
          $("#material_qty3").val('');
          $("#material_cost").val('');
          $("#material_cost2").val('');
          $("#material_cost3").val('');
          $("#labour_qty").val('');
          $("#labour_qty2").val('');
          $("#labour_cost").val('');
          $("#labour_cost2").val('');
          $("#other_qty").val('');
          $("#other_cost").val('');
          $("#total_cost").val('');
          $("#service_note").val('');
          $("#mileage").val('');
          $("#file").val('');
          $("#technician").prop('selectedIndex',0);
          $(".spinner").addClass('disp-0');

            $('tbody#workorderRes').html("<tr style='font-size: 11px;'><td style='color: darkblue; font-weight: bold; font-size: 13px;'>NEW</td><td>"+res[0].vehicle_licence+"</td><td>"+res[0].date+"</td><td>"+res[0].service_type+"</td><td>"+res[0].service_option+"</td><td>"+res[0].total_cost+"</td><td>"+res[0].service_note+"</td><td>"+res[0].mileage+"</td><td><a style='font-size: 12px; color: darkblue; font-weight: bolder;' href='/uploads/"+res[0].file+"' download>Download file</a></td><td>"+res[0].update_by+"</td><td><i type='button' style='padding: 10px;' title='View More' class='fas fa-eye text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Move to Estimate' class='fas fa-exchange-alt' onclick=estimateOrders(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Move to Maintenance Record' class='fas fa-tools' onclick=maintenanceOrders(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Resend mail' class='fas fa-paper-plane text-primary mailPlane' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td><td><i type='button' style='padding: 10px;' title='Print copy' class='fas fa-print text-danger' style='text-align: center; cursor: pointer;' onclick=getPage(\'"+result.info+"'\)></i></td></tr>");

            swal("Thanks!", result.res, result.message);

          // setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
    }
}

    //Set CSRF HEADERS
 function setHeaders(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });
 }

// Service Worker

if ('serviceWorker' in navigator) {
    console.log("Will the service worker register?");
    navigator.serviceWorker.register('service-worker.js')
      .then(function(reg){
        console.log("Yes, it did.");
     }).catch(function(err) {
        console.log("No it didn't. This happened:", err)
    });
 }

function diagnostic(id){
  $('#pay_licence').val('');
  $('#pay_maintenace_date').val('');
  $('#pay_service_option').val('');
  $('#pay_service_type').val('');
  $('#pay_total_bill_amount').val('');
  $('#outstand_val').val('1');
  // Ajax get data, and post on payment
    var route = "{{ URL('Ajax/diagnostics') }}";
  var thisdata = {post_id: id}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $("#revenue-tab").click();

        },
        success: function(result){
          var res = JSON.parse(result.data);
          if($('#outstand_val').val() == "1"){
            $("#receievepayment-tab").click();
          }
          else{
            $("#invoices-tab").click();
          }
          $('#pay_licence').val(res[0].vehicle_licence);
          $('#pay_maintenace_date').val(res[0].date);
          $('#pay_service_option').val(res[0].service_option);
          $('#pay_service_type').val(res[0].service_type);
          $('#pay_total_bill_amount').val(res[0].total_cost);
        }

      });
}

function postMaterial(id, val){
  console.log(id);
}

function maintenanceOrders(id){
    var route = "{{ URL('Ajax/movemaintenanceOrder') }}";
  var thisdata = {post_id: id}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $('tbody#workorderRes').html("<tr align='center'><td colspan='27'><img src='https://cdn.dribbble.com/users/172519/screenshots/3520576/dribbble-spinner-800x600.gif' style='width: 50px; height: 50px;'></td></tr>");
        },
        success: function(result){
          swal("Thanks!", result.res, result.message);
          setTimeout(function(){ location.href = result.link; }, 2000);
        }

      });
}

$('#spec_payment_type').change(function(){
  if($('#spec_payment_type').val() == "Diagnostics"){
    // $('#pay_total_bill_amount').attr('disabled','disabled');
    $('.spec_date').addClass('disp-0');
    $('.diag_date').removeClass('disp-0');
  }
  else if($('#spec_payment_type').val() == "Completed Works"){
    $('.spec_date').removeClass('disp-0');
    $('.diag_date').addClass('disp-0');
    // $('#pay_total_bill_amount').removeAttr('disabled');

  }
  else{
    // $('#pay_total_bill_amount').removeAttr('disabled');
    $('.spec_date').addClass('disp-0');
    $('.diag_date').addClass('disp-0');
  }
});

function fetchInvoice(){

    // Do Ajax
  var route = "{{ URL('Ajax/checkcompletedWorks') }}";
  var thisdata = {licence: $('#spec_pay_search_licence').val()}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $('.spinnerChecker').removeClass('disp-0');
          $("tbody#payRecs").html('');
        },
        success: function(result){

          if(result.message == "success"){
            $(".recsPay").removeClass('disp-0');
            var res = JSON.parse(result.data);

            $.each(res, function(v,k){
              $("tbody#payRecs").append("<tr style='text-align: center; font-size: 13px;'><td>"+(v+1)+"</td><td>"+k.vehicle_licence+"</td><td>"+k.date+"</td><td>"+k.service_option+"</td><td>"+k.service_type+"</td><td>"+k.total_cost+"</td><td><i type='button' style='padding: 10px;' title='Process Payment' class='fas fa-cart-arrow-down' onclick='getPayment("+k.id+")'></i></td></tr>");
            });
            // Populate Result
            $('.spinnerChecker').addClass('disp-0');

          }
          else{
            $('.spinnerChecker').addClass('disp-0');
            $(".recsPay").addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }

        }

      });
}

function fetchdiagInvoice(){

    // Do Ajax
  var route = "{{ URL('Ajax/checkdiaginvoice') }}";
  var thisdata = {licence: $('#diag_pay_search_licence').val()}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $('.spinnerdiagChecker').removeClass('disp-0');
          $("tbody#payRecs").html('');
        },
        success: function(result){

          if(result.message == "success"){
            $(".recsPay").removeClass('disp-0');
            var res = JSON.parse(result.data);
            // Populate Result
            $('.spinnerdiagChecker').addClass('disp-0');
            $.each(res, function(v,k){
              $("tbody#payRecs").append("<tr style='text-align: center; font-size: 13px;'><td>"+(v+1)+"</td><td>"+k.vehicle_licence+"</td><td>"+k.date+"</td><td>"+k.service_option+"</td><td>"+k.service_type+"</td><td>0</td><td><i type='button' style='padding: 10px;' title='Process Payment' class='fas fa-cart-arrow-down' onclick='getPayment("+k.id+")'></i></td></tr>");
            });

          }
          else{
            $('.spinnerdiagChecker').addClass('disp-0');
            $(".recsPay").addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }

        }

      });
}

function getPayment(id){
      // Do Ajax
  var route = "{{ URL('Ajax/getPaymentRec') }}";
  var thisdata = {id: id}
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $('.spinnerChecker').removeClass('disp-0');
          $("tbody#payRecs").html('');
          $(".recsPay").addClass('disp-0');
        },
        success: function(result){

          if(result.message == "success"){
            var res = JSON.parse(result.data);
            // Populate Result
            $('.spinnerChecker').addClass('disp-0');

            if(res[0].diagnostics == 1){
                $('#pay_licence').val(res[0].vehicle_licence);
                $('#pay_maintenace_date').val(res[0].date);
                $('#pay_service_option').val(res[0].service_option);
                $('#pay_service_type').val(res[0].service_type);
                $('#pay_total_bill_amount').val('0');
            }
            else if(res[0].maintenance == 1){
              $('#pay_licence').val(res[0].vehicle_licence);
              $('#pay_maintenace_date').val(res[0].date);
              $('#pay_service_option').val(res[0].service_option);
              $('#pay_service_type').val(res[0].service_type);
              $('#pay_total_bill_amount').val(res[0].total_cost);
            }

          }
          else{
            $('.spinnerChecker').addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }

        }

      });
}

function processPay(val){
  if(val == "payment"){
    var tot_bill;
    var spec_payment_type = $('#spec_payment_type').val();

    if(spec_payment_type == "Diagnostics"){
      tot_bill = 0;
    }
    else{
      tot_bill = $('#pay_total_bill_amount').val();
    }
    var route = "{{ URL('Ajax/processPayment') }}";
    var thisdata = {
      licence: $('#pay_licence').val(),
      maintenace_date: $('#pay_maintenace_date').val(),
      service_option: $('#pay_service_option').val(),
      service_type: $('#pay_service_type').val(),
      total_bill_amount: tot_bill,
      deposit_made: $('#pay_deposit_made').val(),
      additional_payment: $('#pay_additional_payment').val(),
      cash_payment: $('#pay_cash_payment').val(),
      cheque_payment_number: $('#pay_cheque_payment_number').val(),
      cheque_payment_date: $('#pay_cheque_payment_date').val(),
      cheque_payment_amount: $('#pay_cheque_payment_amount').val(),
      card_number: $('#pay_card_number').val(),
      cc: $('#pay_cc').val(),
      card_amount: $('#pay_card_amount').val(),
      total_payment_made: $('#pay_total_payment_made').val(),
      spec_payment_type: spec_payment_type
    }

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){

          if(result.message == "success"){
            $(".spinner").addClass('disp-0');
            $('#pay_licence').val('');
            $('#pay_maintenace_date').val('');
            $('#pay_service_option').val('');
            $('#pay_service_type').val('');
            $('#pay_total_bill_amount').val('');
            $('#pay_deposit_made').val('');
            $('#pay_additional_payment').val('');
            $('#pay_cash_payment').val('');
            $('#pay_cheque_payment_number').val('');
            $('#pay_cheque_payment_date').val('');
            $('#pay_cheque_payment_amount').val('');
            $('#pay_card_number').val('');
            $('#pay_cc').val('');
            $('#pay_card_amount').val('');
            $('#pay_total_payment_made').val('');

            swal("Thanks!", result.res, result.message);
          }
          else{
            $(".spinner").addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }

          // setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });
  }
  else if(val == "cancel"){
    swal({
      title: "Are you sure?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // click dashboard
        $("#maintenance-tab").click();
      } else {

      }
    });
  }
}

function printCopy(id){
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');


    mywindow.document.write(document.getElementById(id).innerHTML);


    mywindow.print();
    mywindow.close();

    // return true;
}

function sendPOmails(id, email){
  // alert(email);
  var route = "{{ URL('Ajax/POemail') }}";
  var thisdata = {post_id: id, email: email}
     setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      $(".spinnersMail").removeClass('disp-0');
    },
    success: function(result){
        // alert("Done");
        if(result.message == 'success'){
          $(".spinnersMail").addClass('disp-0');
          swal("Thanks!", result.res, result.message);
          setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 2000);
        }
        else{
          $(".spinnersMail").addClass('disp-0');
          swal("Oops!", result.res, result.message);
        }

        // alert(result.res);

    }

  });
}

function openappPart(){
  $('.partSection').removeClass('disp-0');
  scrollTarget('partsAdd');
}

function addParts(id, action){
  var route = "{{ URL('Ajax/addnewPart') }}";
  var formData = new FormData();
  if(action == 'save'){
      var fileSelect = document.getElementById("part_warranty");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("part_warranty", file , file.name);
       }

      formData.append("post_id", $('#estimate_id').val());
      formData.append("part_number", $("#part_number").val());
      formData.append("part_description", $("#part_description").val());
      formData.append("part_category", $("#part_category").val());
      formData.append("vendor_code", $("#vendor_code").val());
      formData.append("vendor", $("#vendor").val());
      formData.append("part_manufacturer", $("#part_manufacturer").val());
      formData.append("part_location", $("#part_location").val());
      formData.append("items_qty", $("#items_qty").val());
      formData.append("items_unit_cost", $("#items_unit_cost").val());
      formData.append("items_total_cost", $("#items_total_cost").val());
      formData.append("item_mark_up", $("#item_mark_up").val());
      formData.append("item_discount", $("#item_discount").val());
      formData.append("item_unit_price", $("#item_unit_price").val());
      formData.append("item_total_discount", $("#item_total_discount").val());
      formData.append("item_tax_rate", $("#item_tax_rate").val());
      formData.append("item_total_price", $("#item_total_price").val());
      formData.append("assigned_technician", $("#assigned_technician").val());

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
          $(".spinnerParts").removeClass('disp-0');
        },
        success: function(result){

          if(result.message == "success"){
            $(".spinnerParts").addClass('disp-0');
            $('#part_number').val('');
            $('#part_description').val('');
            $('#part_category').val('');
            $('#part_warranty').val('');
            $('#vendor_code').val('');
            $('#vendor').val('');
            $('#part_manufacturer').val('');
            $('#part_location').val('');
            $('#items_qty').val('');
            $('#items_unit_cost').val('');
            $('#items_total_cost').val('');
            $('#item_mark_up').val('');
            $('#item_discount').val('');
            $('#item_unit_price').val('');
            $('#item_total_discount').val('');
            $('#item_tax_rate').val('');
            $('#item_total_price').val('');
            $('#assigned_technician').val('');

            $('.partSection').addClass('disp-0');
            var optionValue = result.data;
            swal("Good!", result.res, result.message);
            // Get Result
            $('.myinventory').append(`<option value="${optionValue}">${optionValue}</option>`);

          }
          else{
            $(".spinnerParts").addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }

          // setTimeout(function(){ location.href = result.link; }, 1000);
        }

      });

  }
  else if(action == 'cancel'){
        swal({
      title: "Are you sure?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Close all inputs
        $('#part_number').val('');
        $('#part_description').val('');
        $('#part_category').val('');
        $('#part_warranty').val('');
        $('#vendor_code').val('');
        $('#vendor').val('');
        $('#part_manufacturer').val('');
        $('#part_location').val('');
        $('#items_qty').val('');
        $('#items_unit_cost').val('');
        $('#items_total_cost').val('');
        $('#item_mark_up').val('');
        $('#item_discount').val('');
        $('#item_unit_price').val('');
        $('#item_total_discount').val('');
        $('#item_tax_rate').val('');
        $('#item_total_price').val('');
        $('#assigned_technician').val('');
        $('.partSection').addClass('disp-0');
      } else {

      }
    });
  }
}

$('#po_suggestion').change(function(){
  if($('#po_suggestion').val() == "auto generate"){
    $('.po_suggestion').removeClass('disp-0');
    $('#purchase_order_no_sugg').removeClass('disp-0');
    $('#purchase_order_no').addClass('disp-0');
    $('.po_suggest').addClass('disp-0');
  }
  else if($('#po_suggestion').val() == "user defined"){
    $('.po_suggestion').removeClass('disp-0');
    $('#purchase_order_no').removeClass('disp-0');
    $('#purchase_order_no_sugg').addClass('disp-0');
    $('.po_suggest').addClass('disp-0');
  }
  else{
    $('.po_suggestion').addClass('disp-0');
    $('#purchase_order_no').addClass('disp-0');
    $('#purchase_order_no_sugg').addClass('disp-0');
    $('.po_suggest').addClass('disp-0');
  }

});

function savePO(post_id, action){

  var route = "{{ URL('Ajax/createPO') }}";
  var spinner;
  var purchase_order_no;

  if($('#purchase_order_no').val() == ""){
    purchase_order_no = $('#purchase_order_no_sugg').val();
  }
  else if($('#purchase_order_no_sugg').val() == ""){
    purchase_order_no = $('#purchase_order_no').val();
  }


  if(action == "submit"){
    spinner = $('.spinnerPOsubmit');
  }
  else if(action == "printmail"){
    spinner = $('.spinnerPOprintmail');
  }

  if($('#myVendor').val() == ""){
    swal('Oops', 'Kindly Select Vendor', 'info');
    return false;
  }
  else if(purchase_order_no == ""){
    swal('Oops', 'You cannot submit without purchase order #', 'info');
    return false;
  }
  else if($('#order_date').val() == "" || $('#expected_date').val() == ""){
    swal('Oops', 'You cannot submit without order date or expected date', 'info');
    return false;
  }
  else if($('#purchase_order_inventory_item').val() == ""){
    swal('Oops', 'You need to create inventory if you have none', 'info');
    return false;
  }
  else{
    var thisdata = {
    post_id: post_id,
    action: action,
    vendor: $('#myVendor').val(),
    purchase_order_no: purchase_order_no,
    order_date: $('#order_date').val(),
    expected_date: $('#expected_date').val(),
    purchase_order_inventory_item: $('#purchase_order_inventory_item').val(),
    purchase_order_qty: $('#purchase_order_qty').val(),
    purchase_order_rate: $('#purchase_order_rate').val(),
    purchase_order_totcost: $('#purchase_order_totcost').val(),
    purchase_order_shippingcost: $('#purchase_order_shippingcost').val(),
    purchase_order_discount: $('#purchase_order_discount').val(),
    purchase_order_othercost: $('#purchase_order_othercost').val(),
    purchase_order_tax: $('#purchase_order_tax').val(),
    purchase_order_totalpurchaseorder: $('#purchase_order_totalpurchaseorder').val(),
    purchase_order_shipto: $('#purchase_order_shipto').val(),
    purchase_order_address1: $('#purchase_order_address1').val(),
    purchase_order_address2: $('#purchase_order_address2').val(),
    purchase_order_city: $('#purchase_order_city').val(),
    purchase_order_state: $('#stateez').val(),
    purchase_order_country: $('#countryeez').val(),
    purchase_order_zip: $('#purchase_order_zip').val(),
    purchase_order_destphone: $('#purchase_order_destphone').val(),
    purchase_order_destfax: $('#purchase_order_destfax').val(),
    purchase_order_destmail: $('#purchase_order_destmail').val(),
    purchase_order_orderby: $('#purchase_order_orderby').val()

  }

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){

          if(result.message == "success" && result.action == 'submit'){
            spinner.addClass('disp-0');
            $('#myVendor').val('');
            $('#purchase_order_no').val('');
            $('#order_date').val('');
            $('#expected_date').val('');
            $('#purchase_order_inventory_item').val('');
            $('#purchase_order_qty').val('');
            $('#purchase_order_rate').val('');
            $('#purchase_order_totcost').val('');
            $('#purchase_order_shippingcost').val('');
            $('#purchase_order_discount').val('');
            $('#purchase_order_othercost').val('');
            $('#purchase_order_tax').val('');
            $('#purchase_order_totalpurchaseorder').val('');
            $('#purchase_order_shipto').val('');
            $('#purchase_order_address1').val('');
            $('#purchase_order_address2').val('');
            $('#purchase_order_city').val('');
            $('#purchase_order_state').val('');
            $('#purchase_order_country').val('');
            $('#purchase_order_zip').val('');
            $('#purchase_order_destphone').val('');
            $('#purchase_order_destfax').val('');
            $('#purchase_order_destmail').val('');
            $('#purchase_order_orderby').val('');

            swal("Thanks!", result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 3000);
          }
          else if(result.message == "success" && result.action == 'printmail'){
            spinner.addClass('disp-0');
            $('#myVendor').val('');
            $('#purchase_order_no').val('');
            $('#order_date').val('');
            $('#expected_date').val('');
            $('#purchase_order_inventory_item').val('');
            $('#purchase_order_qty').val('');
            $('#purchase_order_rate').val('');
            $('#purchase_order_totcost').val('');
            $('#purchase_order_shippingcost').val('');
            $('#purchase_order_discount').val('');
            $('#purchase_order_othercost').val('');
            $('#purchase_order_tax').val('');
            $('#purchase_order_totalpurchaseorder').val('');
            $('#purchase_order_shipto').val('');
            $('#purchase_order_address1').val('');
            $('#purchase_order_address2').val('');
            $('#purchase_order_city').val('');
            $('#purchase_order_state').val('');
            $('#purchase_order_country').val('');
            $('#purchase_order_zip').val('');
            $('#purchase_order_destphone').val('');
            $('#purchase_order_destfax').val('');
            $('#purchase_order_destmail').val('');
            $('#purchase_order_orderby').val('');

            setTimeout(function(){ location.href = location.origin+'/PurchaseOrderHistory/'+result.link; }, 1000);
          }
          else{
            spinner.addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }
        }

      });
  }



}

function createVendor(){
  var spinner = $('.spinnervendor');
  var optionValue;
  var route = "{{ URL('Ajax/createVendor') }}";
  if($('#create_vendorcode').val() == ""){
    swal('Oops', 'Vendor code is needed', 'info');
    return false;
  }
  else if($('#create_vendorname').val() == ""){
    swal('Oops', 'Vendor name is needed', 'info');
    return false;
  }
  else if($('#create_vendorcountry').val() == ""){
    swal('Oops', 'Select vendor country', 'info');
    return false;
  }
  else if($('#create_vendorstate').val() == ""){
    swal('Oops', 'Select vendor state', 'info');
    return false;
  }
  else if($('#create_vendorcity').val() == ""){
    swal('Oops', 'Select vendor city', 'info');
    return false;
  }
  else if($('#create_vendoremail').val() == ""){
    swal('Oops', 'Vendor email is needed', 'info');
    return false;
  }
  else if($('#create_vendorphone').val() == ""){
    swal('Oops', 'Vendor phone number is needed', 'info');
    return false;
  }
  else{
      var thisdata = {
      vendor_code: $('#create_vendorcode').val(),
      vendor_name: $('#create_vendorname').val(),
      vendor_salesrep: $('#create_vendorsalesrep').val(),
      vendor_country: $('#create_vendorcountry').val(),
      vendor_state: $('#create_vendorstate').val(),
      vendor_city: $('#create_vendorcity').val(),
      vendor_address: $('#create_vendoraddress').val(),
      vendor_email: $('#create_vendoremail').val(),
      vendor_phone: $('#create_vendorphone').val(),
      vendor_fax: $('#create_vendorfax').val(),
      vendor_createdby: $('#create_vendorcreatedby').val()
    }

    setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success" && result.action == "insert"){
            spinner.addClass('disp-0');
            $('#create_vendorcode').val('');
            $('#create_vendorname').val('');
            $('#create_vendorsalesrep').val('');
            $('#create_vendoraddress').val('');
            $('#create_vendoremail').val('');
            $('#create_vendorphone').val('');
            $('#create_vendorfax').val('');
            $('#create_vendorcreatedby').val('');
            optionValue = result.data;
            $('#myVendor').append(`<option value="${optionValue}">${optionValue}</option>`);
            swal("Thanks!", result.res, result.message);
          }
          else if(result.message == "success" && result.action == "update"){
            spinner.addClass('disp-0');
            $('#create_vendorcode').val('');
            $('#create_vendorname').val('');
            $('#create_vendorsalesrep').val('');
            $('#create_vendoraddress').val('');
            $('#create_vendoremail').val('');
            $('#create_vendorphone').val('');
            $('#create_vendorfax').val('');
            $('#create_vendorcreatedby').val('');
            swal("Thanks!", result.res, result.message);
          }
          else{
            spinner.addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }

        }
      });
  }

}

function orderActions(post_id, val){
  var route = "{{ URL('Ajax/orderActions') }}";
  var thisdata = {post_id: post_id, val: val};
  var spinner = $('.spinnerorder');
  var res;
      setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success" && result.action == "movetoinventory"){
            spinner.addClass('disp-0');
            res = JSON.parse(result.data);
            var qtyathand;
            var purchase_order_qty;
            var calTot;
            $.each(res, function(v,k){
              qtyathand = k.qtyathand;
              purchase_order_qty = k.purchase_order_qty;

              calTot = parseInt(qtyathand) + parseInt(purchase_order_qty);

              $("tbody#invItems").append("<tr style='font-size: 11px;'><td>"+(v+1)+"</td><td>"+ k.part_no +"</td><td>"+ k.description +"</td><td>"+ k.category +"</td><td>"+ k.upccode +"</td><td>"+k.purchase_order_qty+"</td><td>"+k.purchase_order_no+"</td><td>"+ calTot +"</td><td>"+ k.vendor +"</td><td>"+ k.location +"</td><tr>");
            });

            swal("Good!", result.res, result.message);
            setTimeout(function(){ location.href = result.link; }, 2000);
          }
          // else if(result.message == "success" && result.action == "makepayment"){
          //   spinner.addClass('disp-0');
          //   res = JSON.parse(result.data);
          //   $('#pay_post_id').val(res[0].post_id);
          //   $('#pay_type').val('Make Payment');
          //   $('#pay_po_number').val(res[0].purchase_order_no);
          //   $('#pay_order_date').val(res[0].order_date);
          //   $('#pay_date_expected').val(res[0].expected_date);
          //   $('#pay_invent_item').val(res[0].purchase_order_inventory_item);
          //   $('#pay_quantity').val(res[0].purchase_order_qty);
          //   $('#pay_rate').val(res[0].purchase_order_rate);
          //   $('#pay_tot_cost').val(res[0].purchase_order_totcost);
          //   $('#pay_shipping_cost').val(res[0].purchase_order_shippingcost);
          //   $('#pay_discount').val(res[0].purchase_order_discount);
          //   $('#pay_othercosts').val(res[0].purchase_order_othercost);
          //   $('#pay_tax').val(res[0].purchase_order_tax);
          //   $('#pay_po_total').val(res[0].purchase_order_totalpurchaseorder);
          //   $('#makePayments').click();
          //   $('.proPayment').removeClass('disp-0');
          //   $('.invoice').addClass('disp-0');
          // }
          else if(result.message == "success" && result.action == "receiveorder"){
            spinner.addClass('disp-0');
            res = JSON.parse(result.data);
            $('#pay_post_id').val(res[0].post_id);
            $('#pay_type').val('Generate Invoice');
            $('#pay_po_number').val(res[0].purchase_order_no);
            $('#vend_name').val(res[0].vendor);
            $('#pay_order_date').val(res[0].order_date);
            $('#pay_date_expected').val(res[0].expected_date);
            $('#pay_invent_item').val(res[0].purchase_order_inventory_item);
            $('#pay_quantity').val(res[0].purchase_order_qty);
            $('#pay_rate').val(res[0].purchase_order_rate);
            $('#pay_tot_cost').val(res[0].purchase_order_totcost);
            $('#pay_shipping_cost').val(res[0].purchase_order_shippingcost);
            $('#pay_discount').val(res[0].purchase_order_discount);
            $('#pay_othercosts').val(res[0].purchase_order_othercost);
            $('#pay_tax').val(res[0].purchase_order_tax);
            $('#pay_po_total').val(res[0].purchase_order_totalpurchaseorder);
            $('#makePayments').click();
            $('.proPayment').addClass('disp-0');
            $('.invoice').removeClass('disp-0');

            $('#payvendor-tab').click();
            swal("Good!", result.res, result.message);
          }
          else{
            spinner.addClass('disp-0');
            swal("Oops!", result.res, result.message);
          }
        }

      });
}

function poPay(val){

  var route = "{{ URL('Ajax/poPayments') }}";
  var thisdata;
  var spinner;

  if(val == "cancel"){
        swal({
      title: "Are you sure?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // click dashboard
        $('#pay_post_id').val('');
        $('#pay_order_date').val('');
        $('#pay_date_expected').val('');
        $('#pay_invent_item').val('');
        $('#pay_description_of_item').val('');
        $('#pay_quantity').val('');
        $('#pay_rate').val('');
        $('#pay_tot_cost').val('');
        $('#pay_shipping_cost').val('');
        $('#pay_discount').val('');
        $('#pay_othercosts').val('');
        $('#pay_tax').val('');
        $('#pay_po_total').val('');
        $('#pay_advance').val('');
        $('#pay_balance').val('');
        $('#pay_cashamount').val('');
        $('#pay_chequeno').val('');
        $('#pay_chequedate').val('');
        $('#pay_chequeamount').val('');
        $('#pay_credit').val('');
        $('#pay_cc').val('');
        $('#pay_cardamount').val('');
        $("#pay_type").prop('selectedIndex',0);
        $("#pay_po_number").prop('selectedIndex',0);
        $("#vend_name").prop('selectedIndex',0);
      } else {

      }
    });
  }
  else if(val == "payment"){
    spinner = $('.spinnerpay');
    thisdata = {
      val: 'payment',
      post_id: $('#pay_post_id').val(),
      pay_type: 'make payment',
      pay_po_number: $('#pay_po_number').val(),
      vend_name: $('#vend_name').val(),
      pay_order_date: $('#pay_order_date').val(),
      pay_date_expected: $('#pay_date_expected').val(),
      pay_invent_item: $('#pay_invent_item').val(),
      pay_description_of_item: $('#pay_description_of_item').val(),
      pay_quantity: $('#pay_quantity').val(),
      pay_rate: $('#pay_rate').val(),
      pay_tot_cost: $('#pay_tot_cost').val(),
      pay_shipping_cost: $('#pay_shipping_cost').val(),
      pay_discount: $('#pay_discount').val(),
      pay_othercosts: $('#pay_othercosts').val(),
      pay_tax: $('#pay_tax').val(),
      pay_po_total: $('#pay_po_total').val(),
      pay_advance: $('#pay_advance').val(),
      pay_balance: $('#pay_balance').val(),
      pay_cashamount: $('#pay_cashamount').val(),
      pay_chequeno: $('#pay_chequeno').val(),
      pay_chequedate: $('#pay_chequedate').val(),
      pay_chequeamount: $('#pay_chequeamount').val(),
      pay_credit: $('#pay_credit').val(),
      pay_cc: $('#pay_cc').val(),
      pay_cardamount: $('#pay_cardamount').val(),
      pay_grandtotal: $('#pay_grandtotal').val()
    };

  }
  // else if(val == "invoice"){
  //   spinner = $('.spinnerinvoice');
  //   thisdata = {
  //     val: 'invoice',
  //     post_id: $('#pay_post_id').val(),
  //     pay_type: $('#pay_type').val(),
  //     pay_po_number: $('#pay_po_number').val(),
  //     pay_order_date: $('#pay_order_date').val(),
  //     pay_date_expected: $('#pay_date_expected').val(),
  //     pay_invent_item: $('#pay_invent_item').val(),
  //     pay_quantity: $('#pay_quantity').val(),
  //     pay_rate: $('#pay_rate').val(),
  //     pay_tot_cost: $('#pay_tot_cost').val(),
  //     pay_shipping_cost: $('#pay_shipping_cost').val(),
  //     pay_discount: $('#pay_discount').val(),
  //     pay_othercosts: $('#pay_othercosts').val(),
  //     pay_tax: $('#pay_tax').val(),
  //     pay_po_total: $('#pay_po_total').val(),
  //     pay_advance: $('#pay_advance').val(),
  //     pay_balance: $('#pay_balance').val(),
  //     pay_cashamount: $('#pay_cashamount').val(),
  //     pay_chequeno: $('#pay_chequeno').val(),
  //     pay_chequedate: $('#pay_chequedate').val(),
  //     pay_chequeamount: $('#pay_chequeamount').val(),
  //     pay_credit: $('#pay_credit').val(),
  //     pay_cc: $('#pay_cc').val(),
  //     pay_cardamount: $('#pay_cardamount').val()
  //   };
  // }
  else if(val == "printmail"){
    spinner = $('.spinnerprints');
    thisdata = {
      val: 'printmail',
      post_id: $('#pay_post_id').val(),
      pay_type: 'make payment',
      pay_po_number: $('#pay_po_number').val(),
      vend_name: $('#vend_name').val(),
      pay_order_date: $('#pay_order_date').val(),
      pay_date_expected: $('#pay_date_expected').val(),
      pay_invent_item: $('#pay_invent_item').val(),
      pay_description_of_item: $('#pay_description_of_item').val(),
      pay_quantity: $('#pay_quantity').val(),
      pay_rate: $('#pay_rate').val(),
      pay_tot_cost: $('#pay_tot_cost').val(),
      pay_shipping_cost: $('#pay_shipping_cost').val(),
      pay_discount: $('#pay_discount').val(),
      pay_othercosts: $('#pay_othercosts').val(),
      pay_tax: $('#pay_tax').val(),
      pay_po_total: $('#pay_po_total').val(),
      pay_advance: $('#pay_advance').val(),
      pay_balance: $('#pay_balance').val(),
      pay_cashamount: $('#pay_cashamount').val(),
      pay_chequeno: $('#pay_chequeno').val(),
      pay_chequedate: $('#pay_chequedate').val(),
      pay_chequeamount: $('#pay_chequeamount').val(),
      pay_credit: $('#pay_credit').val(),
      pay_cc: $('#pay_cc').val(),
      pay_cardamount: $('#pay_cardamount').val(),
      pay_grandtotal: $('#pay_grandtotal').val()
    };
  }

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success" && result.action == "payment"){
            spinner.addClass('disp-0');
            $('#pay_post_id').val('');
            $('#pay_po_number').val('');
            $("#vend_name").prop('selectedIndex',0);
            $('#pay_order_date').val('');
            $('#pay_date_expected').val('');
            $('#pay_invent_item').val('');
            $('#pay_quantity').val('');
            $('#pay_description_of_item').val('');
            $('#pay_rate').val('');
            $('#pay_tot_cost').val('');
            $('#pay_shipping_cost').val('');
            $('#pay_discount').val('');
            $('#pay_othercosts').val('');
            $('#pay_tax').val('');
            $('#pay_po_total').val('');
            $('#pay_advance').val('');
            $('#pay_balance').val('');
            $('#pay_cashamount').val('');
            $('#pay_chequeno').val('');
            $('#pay_chequedate').val('');
            $('#pay_chequeamount').val('');
            $('#pay_credit').val('');
            $('#pay_cc').val('');
            $('#pay_cardamount').val('');
            $('#pay_grandtotal').val('');
            swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);

          }
          else if(result.message == "success" && result.action == "printmail"){

            setTimeout(function(){ location.href = location.origin+'/purchaseprint/'+result.link; }, 3000);
            // setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else{
            spinner.addClass('disp-0');
            swal('Oops!', result.res, result.message);
          }
        }
        });

}

function createInv(){
  var route = "{{ URL('Ajax/createInvItem') }}";
  var post_id;
  var spinner = $('.spinnerinvs');

  if($('#inv_post_id').val() == ""){
    post_id = $('#inv_post_id').val('<?php echo uniqid().'_'.time();?>');
  }
  else{
    post_id = $('#inv_post_id').val();
  }

  if($('#inv_parts_no').val() == ""){
    swal('Oops', 'You can not submit without Part No.', 'info');
    return false;
  }
  else if($('#inv_description').val() == ""){
    swal('Oops', 'You can not submit without description', 'info');
    return false;
  }
  else if($('#inv_category').val() == ""){
    swal('Oops', 'You can not submit without category', 'info');
    return false;
  }
  else if($('#inv_upccode').val() == ""){
    swal('Oops', 'You can not submit without UPC code', 'info');
    return false;
  }
  else if($('#inv_location').val() == ""){
    swal('Oops', 'You can not submit without location', 'info');
    return false;
  }
  else if($('#inv_qtyathand').val() == ""){
    swal('Oops', 'You can not submit without quantity at hand', 'info');
    return false;
  }
  else if($('#inv_createdby').val() == ""){
    swal('Oops', 'You can not submit without created by', 'info');
    return false;
  }
  else{
    var thisdata = {
      post_id: post_id,
      part_no: $('#inv_parts_no').val(),
      description: $('#inv_description').val(),
      category: $('#inv_category').val(),
      upccode: $('#inv_upccode').val(),
      location: $('#inv_location').val(),
      qtyathand: $('#inv_qtyathand').val(),
      createdby: $('#inv_createdby').val()
    };
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            spinner.addClass('disp-0');
            $('#inv_parts_no').val('');
            $('#inv_description').val('');
            $('#inv_category').val('');
            $('#inv_upccode').val('');
            $('#inv_location').val('');
            $('#inv_qtyathand').val('');
            $('#inv_createdby').val('');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else{
            spinner.addClass('disp-0');
            swal('Oops!', result.res, result.message);
          }
        }
        });
  }

}

function createCategory(action){

  if(action == "submit"){
    var route = "{{ URL('Ajax/createCategory') }}";
    var spinner = $('.spinnercat');
    var thisdata = {
      category: $('#category_name').val(),
      description: $('#category_description').val(),
    };
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            spinner.addClass('disp-0');
            $('#category_name').val('');
            $('#category_description').val('');
            var optionValue = result.data;
            $('#inv_category').append(`<option value="${optionValue}">${optionValue}</option>`);
            swal('Good!', result.res, result.message);
            // setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else{
            spinner.addClass('disp-0');
            swal('Oops!', result.res, result.message);
          }
        }
        });
  }
  else if(action == "cancel"){
            swal({
      title: "Are you sure?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // click dashboard
        $('#category_name').val('');
        $('#category_description').val('');
      } else {

      }
    });
  }
}


function labourCreate(action){
  var route = "{{ URL('Ajax/manageLabour') }}";
  var formData = new FormData();
  var spinner;
  if(action == "labours_category"){

    if($("#labours_category").val() == ""){
      swal('Oops!', 'Please provide category', 'info');
      return false;
    }
    else{
      spinner = $('.spinnerlabours_category');
      formData.append("action", action);
      formData.append("busID", $("#labours_busID").val());
      formData.append("labours_category", $("#labours_category").val());
    }

  }
  else if (action == "labours_record") {

    if($("#labours_description").val() == ""){
      swal('Oops!', 'Please provide description', 'info');
      return false;
    }
    else if($("#labours_categories").val() == ""){
      swal('Oops!', 'Please select category', 'info');
      return false;
    }
    else if($("#hour").val() == ""){
      swal('Oops!', 'Please provide the hour', 'info');
      return false;
    }
    else if($("#rate_per_hour").val() == ""){
      swal('Oops!', 'Please provide the rate per hour', 'info');
      return false;
    }
    else if($("#flat_rate").val() == ""){
      swal('Oops!', 'Please provide the flate rate', 'info');
      return false;
    }
    else if($("#wholesale_rate").val() == ""){
      swal('Oops!', 'Please provide the wholesale rate', 'info');
      return false;
    }
    else if($("#retail_rate").val() == ""){
      swal('Oops!', 'Please provide the retail rate', 'info');
      return false;
    }
    else if($("#detailed_description").val() == ""){
      swal('Oops!', 'Please write detailed description', 'info');
      return false;
    }
    else if($("#labour_note").val() == ""){
      swal('Oops!', 'Please leave a note', 'info');
      return false;
    }
    else{
      spinner = $('.spinnerlabours_record');
    var fileSelect = document.getElementById("labour_video");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("labour_video", file , file.name);
       }
       formData.append("action", action);
      formData.append("busID", $("#labourscat_busID").val());
      formData.append("labours_description", $("#labours_description").val());
      formData.append("labours_categories", $("#labours_categories").val());
      formData.append("hour", $("#hour").val());
      formData.append("rate_per_hour", $("#rate_per_hour").val());
      formData.append("flat_rate", $("#flat_rate").val());
      formData.append("wholesale_rate", $("#wholesale_rate").val());
      formData.append("retail_rate", $("#retail_rate").val());
      formData.append("detailed_description", $("#detailed_description").val());
      formData.append("labour_note", $("#labour_note").val());
    }

  }

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
            if(result.message == "success" && result.action == "labours_category"){
                  // alert("Done");
                spinner.addClass('disp-0');
                swal("Saved!", result.res, result.message);
                // alert(result.res);
              setTimeout(function(){ location.href = result.link; }, 3000);
            }
            else if(result.message == "success" && result.action == "labours_record"){
                // alert("Done");
                spinner.addClass('disp-0');
                swal("Saved!", result.res, result.message);
                // alert(result.res);
              setTimeout(function(){ location.href = result.link; }, 3000);
            }
        }

      });
}


function manageTime(){
  var route = "{{ URL('Ajax/manageTime') }}";
  var spinner = $('.spinnertimesheet');

  if($('#timesheet_date_in').val() == ""){
    swal('Oops!', 'Please insert date in', 'info');
      return false;
  }
  else if($('#timesheet_time_in').val() == ""){
    swal('Oops!', 'Please insert time in', 'info');
      return false;
  }
  else if($('#timesheet_date_out').val() == ""){
    swal('Oops!', 'Please insert date out', 'info');
      return false;
  }
  else if($('#timesheet_time_out').val() == ""){
    swal('Oops!', 'Please insert time out', 'info');
      return false;
  }
  else{
      var thisdata = {
    date_in: $('#timesheet_date_in').val(),
    time_in: $('#timesheet_time_in').val(),
    date_out: $('#timesheet_date_out').val(),
    time_out: $('#timesheet_time_out').val(),
    technician_name: $('#timesheet_technician_name').val(),
    technician_id: $('#timesheet_technician_id').val()
  };

          setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        beforeSend: function(){
          spinner.removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            spinner.addClass('disp-0');
            $('#timesheet_date_in').val('');
            $('#timesheet_time_in').val('');
            $('#timesheet_date_out').val('');
            $('#timesheet_time_out').val('');
            $('#timesheet_technician_name').val('');
            $('#timesheet_technician_id').val('');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else{
            spinner.addClass('disp-0');
            swal('Oops!', result.res, result.message);
          }
        }
        });
  }


}


function addLabour(busID){
  var route = "{{ URL('Ajax/addLabour') }}";
  var spinner = $('.spinneraddlabour');
  var formData = new FormData();
  if($("#addlabour_firstname").val() == ""){
    swal('Oops!', 'Please provide firstname', 'info');
      return false;
  }
  else if($("#addlabour_lastname").val() == ""){
    swal('Oops!', 'Please provide lastname', 'info');
      return false;
  }
  else if($("#addlabour_password").val() == ""){
    swal('Oops!', 'Please provide password', 'info');
      return false;
  }
  else if($("#addlabour_category").val() == ""){
    swal('Oops!', 'Please select category', 'info');
      return false;
  }
  else if($("#addlabour_speciality").val() == ""){
    swal('Oops!', 'Please describe speciality', 'info');
      return false;
  }
  else if($("#addlabour_email").val() == ""){
    swal('Oops!', 'Please provide email address', 'info');
      return false;
  }
  else if($("#addlabour_phone").val() == ""){
    swal('Oops!', 'Please provide phone number', 'info');
      return false;
  }
  else if($("#addlabour_hourly_rate").val() == ""){
    swal('Oops!', 'Please provide hourly rate', 'info');
      return false;
  }
  else if($("#addlabour_flat_rate").val() == ""){
    swal('Oops!', 'Please provide flat rate', 'info');
      return false;
  }
  else if($("#addlabour_budgeted_hours").val() == ""){
    swal('Oops!', 'Please provide budgeted hours', 'info');
      return false;
  }
  else if($("#addlabour_actual_hours").val() == ""){
    swal('Oops!', 'Please provide actual hours', 'info');
      return false;
  }
  else if($("#addlabour_labour_costs").val() == ""){
    swal('Oops!', 'Please provide labour cost', 'info');
      return false;
  }
  else if($("#addlabour_total_costs").val() == ""){
    swal('Oops!', 'Please provide total cost', 'info');
      return false;
  }
  else if($("#addlabour_job_description").val() == ""){
    swal('Oops!', 'Please provide job description', 'info');
      return false;
  }
  else if($("#addlabour_notes").val() == ""){
    swal('Oops!', 'Please add a note', 'info');
      return false;
  }
  else if($("#addlabour_timesheet").val() == ""){
    swal('Oops!', 'Please provide time sheet lookup', 'info');
      return false;
  }
  else{

      var fileSelect = document.getElementById("addlabour_videoupload");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("addlabour_videoupload", file , file.name);
       }

      formData.append("busID", busID);
      formData.append("firstname", $("#addlabour_firstname").val());
      formData.append("lastname", $("#addlabour_lastname").val());
      formData.append("category", $("#addlabour_category").val());
      formData.append("speciality", $("#addlabour_speciality").val());
      formData.append("email", $("#addlabour_email").val());
      formData.append("password", $("#addlabour_password").val());
      formData.append("userType", $("#addlabour_role").val());
      formData.append("phone", $("#addlabour_phone").val());
      formData.append("hourly_rate", $("#addlabour_hourly_rate").val());
      formData.append("flat_rate", $("#addlabour_flat_rate").val());
      formData.append("budgeted_hours", $("#addlabour_budgeted_hours").val());
      formData.append("actual_hours", $("#addlabour_actual_hours").val());
      formData.append("labour_cost", $("#addlabour_labour_costs").val());
      formData.append("total_cost", $("#addlabour_total_costs").val());
      formData.append("job_description", $("#addlabour_job_description").val());
      formData.append("notes", $("#addlabour_notes").val());
      formData.append("timesheet", $("#addlabour_timesheet").val());
  }

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
            if(result.message == "success"){
                  // alert("Done");
                spinner.addClass('disp-0');
                swal("Saved!", result.res, result.message);
                // alert(result.res);
              setTimeout(function(){ location.href = result.link; }, 3000);
            }

        }

      });

}


function openPO(val){
  $('#manageinventory-tab').click();
  if(val == "create_po"){
    $('#'+val).click();
  }
}

$('.myinventory').change(function(){
  var route = "{{ URL('Ajax/fetchtheNeedful') }}";
  var pos = $('#inv_pos').val();
  var thisdata = {inventory: $('.myinventory').val(), pos: pos, action: 'inventory'};
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
            if(result.message == "success"){
              var res = JSON.parse(result.data);
              var qtyathand = res[0].qtyathand;
              var poqty = res[0].purchase_order_qty;
              var totQty = parseInt(qtyathand) + parseInt(poqty);
              if(result.message == "success" && result.position == "1"){
                $('#inventory_amount1').val(totQty);
                $('#material_unit_cost').val(res[0].purchase_order_totalpurchaseorder);
              }
              else if(result.message == "success" && result.position == "2"){
                $('#inventory_amount2').val(totQty);
                $('#material_unit_cost2').val(res[0].purchase_order_totalpurchaseorder);
              }
              else if(result.message == "success" && result.position == "3"){
                $('#inventory_amount3').val(totQty);
                $('#material_unit_cost3').val(res[0].purchase_order_totalpurchaseorder);
              }
            }
            else{
              swal('Oops!', result.res, result.message);
            }

        }

      });
});

$('#labour_qty').on("keydown keyup", function(){
  var route = "{{ URL('Ajax/fetchtheNeedful') }}";
  var pos = $('#inv_position').val();
  var lab_qty;
  if(pos == "1"){
    lab_qty = $('#labour_qty').val();
  }
  else{
    lab_qty = $('#labour_qty'+pos).val();
  }
  var category = $('#labour_cat'+pos).val();
  var description = $('#labour_jobdescription'+pos).val();

  var thisdata = {labour: $('#labour_rate1').val(), pos: pos, action: 'labour_rate', lab_qty: lab_qty, category: category, description: description};

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "success"){
            if(result.message == "success" && result.position == "1"){
              $('#labour_cost').val(result.data);
            }

          }
          else{
              swal('Oops!', result.res, result.message);
            }

        }

      });
});

$('#labour_qty2').on("keydown keyup", function(){
  var route = "{{ URL('Ajax/fetchtheNeedful') }}";
  var pos2 = $('#inv_position2').val();
  var lab_qty;
  if(pos2 == "2"){
    lab_qty = $('#labour_qty2').val();
  }
  else{
    lab_qty = $('#labour_qty'+pos2).val();
  }
  var category = $('#labour_cat'+pos2).val();
  var description = $('#labour_jobdescription'+pos2).val();

  var thisdata = {labour: $('#labour_rate2').val(), pos: pos2, action: 'labour_rate', lab_qty: lab_qty, category: category, description: description};

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "success"){
            if(result.message == "success" && result.position == "2"){
              $('#labour_cost2').val(result.data);
            }
          }
          else{
              swal('Oops!', result.res, result.message);
            }

        }

      });
});

$('#updateVendors').change(function(){

  if($('#updateVendors').val() != ""){
var route = "{{ URL('Ajax/getvendors') }}";
  var thisdata = {vendor_code: $('#updateVendors').val()};

         setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){
          if(result.message == "success"){
            var res = JSON.parse(result.data);
            $('#update_vendorcode').val(res[0].vendor_code);
            $('#update_vendorname').val(res[0].vendor_name);
            $('#update_vendorsalesrep').val(res[0].vendor_salesrep);
            $('#update_vendoraddress').val(res[0].vendor_address);
            $('#update_vendorcountry').val(res[0].vendor_country);
            $('#update_vendorstate').val(res[0].vendor_state);
            $('#update_vendorcity').val(res[0].vendor_city);
            $('#update_vendoremail').val(res[0].vendor_email);
            $('#update_vendorphone').val(res[0].vendor_phone);
            $('#update_vendorfax').val(res[0].vendor_fax);
            $('#update_vendorupdatedby').val(res[0].vendor_createdby);
          }
          else{
              swal('Oops!', result.res, result.message);
            }

        }

      });
  }
  else{
      $('#update_vendorcode').val('');
      $('#update_vendorname').val('');
      $('#update_vendorsalesrep').val('');
      $('#update_vendoraddress').val('');
      $('#update_vendoremail').val('');
      $('#update_vendorphone').val('');
      $('#update_vendorfax').val('');
}

});

function updateVendor(){
  var route = "{{ URL('Ajax/updatevendors') }}";
  var thisdata = {
    vendor_code: $('#update_vendorcode').val(),
    vendor_name: $('#update_vendorname').val(),
    vendor_salesrep: $('#update_vendorsalesrep').val(),
    vendor_address: $('#update_vendoraddress').val(),
    vendor_country: $('#update_vendorcountry').val(),
    vendor_state: $('#update_vendorstate').val(),
    vendor_city: $('#update_vendorcity').val(),
    vendor_email: $('#update_vendoremail').val(),
    vendor_phone: $('#update_vendorphone').val(),
    vendor_fax: $('#update_vendorfax').val(),
    vendor_createdby: $('#update_vendorupdatedby').val()
  };

           setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $('.spinnervendorupdt').removeClass('disp-0');
        },
        success: function(result){

          if(result.message == "success"){
            $('.spinnervendorupdt').addClass('disp-0');
            $('#update_vendorcode').val('');
            $('#update_vendorname').val('');
            $('#update_vendorsalesrep').val('');
            $('#update_vendoraddress').val('');
            $('#update_vendoremail').val('');
            $('#update_vendorphone').val('');
            $('#update_vendorfax').val('');

            swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else{
              $('.spinnervendorupdt').addClass('disp-0');
              swal('Oops!', result.res, result.message);
            }

        }

      });
}

$('#vendor').change(function(){
  var route = "{{ URL('Ajax/vendDetails') }}";
  var thisdata = {vendor_email: $('#vendor').val()};

           setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){

          if(result.message == "success"){
            var res = JSON.parse(result.data);
            $('#vendor_code').val(res[0].vendor_code);
          }
          else{
              swal('Oops!', result.res, result.message);
            }

        }

      });
});

function viewBalance(action, id){
  var route = "{{ URL('Ajax/balanceReview') }}";
  var thisdata = {purpose: action, estimate_id: id}
  var spin = $('.spin'+id);
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spin.removeClass('disp-0');
        },
        success: function(result){

          if(result.message == "success" && result.action == "clientBal"){
            spin.addClass('disp-0');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = location.origin+'/clientbalance/'+result.link; }, 3000);
          }
          else if(result.message == "success" && result.action == "labourbal"){
            spin.addClass('disp-0');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = location.origin+'/labourbalance/'+result.link; }, 3000);
          }
          else if(result.message == "success" && result.action == "cashbal"){
            spin.addClass('disp-0');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = location.origin+'/cashbalance/'+result.link; }, 3000);
          }
          else if(result.message == "success" && result.action == "creditcardBal"){
            spin.addClass('disp-0');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = location.origin+'/creditcardbalance/'+result.link; }, 3000);
          }
          else if(result.message == "success" && result.action == "bankBal"){
            spin.addClass('disp-0');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = location.origin+'/bankbalance/'+result.link; }, 3000);
          }
          else{
            spin.addClass('disp-0');
              swal('Oops!', result.res, result.message);
            }

        }

      });

}

function newBack(val){
  location.href = "../userDashboard?c="+val;
}

function goBack() {
   window.history.back();
}

$('#pay_labour_licence').change(function(){
  if($('#pay_labour_licence').val() != ""){
      var route = "{{ URL('Ajax/fetchtheNeedful') }}";


  var thisdata = {
    licence: $('#pay_labour_licence').val(),
    action: "getLabour"
  };
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){

          if(result.message == "success" && result.action == "getLabour"){
            var res = JSON.parse(result.data);
            var labour_rate; var labour_hour;

            if(res[0].labour_hour == null){
              labour_hour = 0;
            }
            else{
              labour_hour = res[0].labour_hour;
            }
            if(res[0].labour_rate == null){
              labour_rate = 0.00;
            }
            else{
              labour_rate = res[0].labour_rate;
            }
            $('#pay_labour_correctLicence').val(res[0].vehicle_licence);
            $('#pay_labour_make').val(res[0].make);
            $('#pay_labour_model').val(res[0].model);
            $('#pay_labour_reportdate').val(res[0].date);
            $('#pay_labour_servicetype').val(res[0].service_type);
            $('#pay_labour_serviceoption').val(res[0].service_option);
            $('#pay_labour_labourhour').val(labour_hour);
            $('#pay_labour_labourrate').val(labour_rate);
            $('#pay_labourtechnicians').val(result.data2);
          }
          else{
              swal('Oops!', result.res, result.message);
          }

        }

      });
  }
  else{
    $('#pay_labour_correctLicence').val('');
    $('#pay_labour_make').val('');
    $('#pay_labour_model').val('');
    $('#pay_labour_reportdate').val('');
    $('#pay_labour_servicetype').val('');
    $('#pay_labour_serviceoption').val('');
    $('#pay_labour_labourhour').val('');
    $('#pay_labour_labourrate').val('');
    $('#pay_labour_paydue').val('');
    $('#pay_labourtechnicians').val('');
  }

});



function paylabour(val){
  var route = "{{ URL('Ajax/paySchedule') }}";
  var thisdata;
  var spinner;
if(val == "edit"){
  $('#pay_labour_make').attr('readonly', false);
  $('#pay_labour_model').attr('readonly', false);
  $('#pay_labour_reportdate').attr('readonly', false);
  $('#pay_labour_servicetype').attr('readonly', false);
  $('#pay_labour_serviceoption').attr('readonly', false);
}
else if(val == "movetopayschedule"){
  spinner = $('.spinnermovetopayschedule');
  thisdata = {
    estimate_id: $('#pay_labour_licence').val(),
    licence: $('#pay_labour_correctLicence').val(),
    make: $('#pay_labour_make').val(),
    model: $('#pay_labour_model').val(),
    date: $('#pay_labour_reportdate').val(),
    service_type: $('#pay_labour_servicetype').val(),
    service_option: $('#pay_labour_serviceoption').val(),
    labour_hour: $('#pay_labour_labourhour').val(),
    labour_rate: $('#pay_labour_labourrate').val(),
    labour_paydue: $('#pay_labour_paydue').val(),
    technician: $('#pay_labourtechnicians').val(),
    purpose: val
  };
}

else if(val == "printmail"){
    // spinner = $('.spinnerprintsmail');
    spinner = $('.spinstubTabl');
  thisdata = {
    estimate_id: $('#pay_labour_licence').val(),
    licence: $('#pay_labour_correctLicence').val(),
    make: $('#pay_labour_make').val(),
    model: $('#pay_labour_model').val(),
    date: $('#pay_labour_reportdate').val(),
    service_type: $('#pay_labour_servicetype').val(),
    service_option: $('#pay_labour_serviceoption').val(),
    labour_hour: $('#pay_labour_labourhour').val(),
    labour_rate: $('#pay_labour_labourrate').val(),
    labour_paydue: $('#pay_labour_paydue').val(),
    technician: $('#pay_labourtechnicians').val(),
    purpose: val
  };
}

else if(val == "paystub"){

  if($('#pay_schedule_labourstartdate').val() == ""){
    swal('Oops!', 'Kindly insert start date', 'info');
    return false;
  }
  else if($('#pay_schedule_labourenddate').val() == ""){
    swal('Oops!', 'Kindly insert end date', 'info');
    return false;
  }
  else{
      // spinner = $('.spinnerpaystub');
      spinner = $('.spinstubTabl');
      thisdata = {
        estimate_id: $('#pay_schedule_labourname').val(),
        start_date: $('#pay_schedule_labourstartdate').val(),
        end_date: $('#pay_schedule_labourenddate').val(),
        licence: $('#pay_schedule_labourlicence').val(),
        make: $('#pay_schedule_labourmake').val(),
        model: $('#pay_schedule_labourmodel').val(),
        reportdate: $('#pay_schedule_labourreportdate').val(),
        service_type: $('#pay_schedule_labourservicetype').val(),
        service_option: $('#pay_schedule_labourserviceoption').val(),
        hour: $('#pay_schedule_labourhour').val(),
        rate: $('#pay_schedule_labourrate').val(),
        paydue: $('#pay_schedule_labourpaydue').val(),
        cashamount: $('#pay_schedule_labourcashamount').val(),
        chequeno: $('#pay_schedule_labourchequeno').val(),
        chequedate: $('#pay_schedule_labourchequedate').val(),
        chequeamount: $('#pay_schedule_labourchequeamount').val(),
        creditcardno: $('#pay_schedule_labourcreditcardno').val(),
        creditcardcc: $('#pay_schedule_labourcreditcardcc').val(),
        creditcardamount: $('#pay_schedule_labourcreditcardamount').val(),
        totalamount: $('#pay_schedule_labourtotalamount').val(),
        purpose: val
      };
  }

}

else if(val == "paystubmail"){

  if($('#pay_schedule_labourstartdate').val() == ""){
    swal('Oops!', 'Kindly insert start date', 'info');
    return false;
  }
  else if($('#pay_schedule_labourenddate').val() == ""){
    swal('Oops!', 'Kindly insert end date', 'info');
    return false;
  }
  else{
      spinner = $('.spinnerprintsmail');
      thisdata = {
        estimate_id: $('#pay_schedule_labourname').val(),
        start_date: $('#pay_schedule_labourstartdate').val(),
        end_date: $('#pay_schedule_labourenddate').val(),
        licence: $('#pay_schedule_labourlicence').val(),
        make: $('#pay_schedule_labourmake').val(),
        model: $('#pay_schedule_labourmodel').val(),
        reportdate: $('#pay_schedule_labourreportdate').val(),
        service_type: $('#pay_schedule_labourservicetype').val(),
        service_option: $('#pay_schedule_labourserviceoption').val(),
        hour: $('#pay_schedule_labourhour').val(),
        rate: $('#pay_schedule_labourrate').val(),
        paydue: $('#pay_schedule_labourpaydue').val(),
        cashamount: $('#pay_schedule_labourcashamount').val(),
        chequeno: $('#pay_schedule_labourchequeno').val(),
        chequedate: $('#pay_schedule_labourchequedate').val(),
        chequeamount: $('#pay_schedule_labourchequeamount').val(),
        creditcardno: $('#pay_schedule_labourcreditcardno').val(),
        creditcardcc: $('#pay_schedule_labourcreditcardcc').val(),
        creditcardamount: $('#pay_schedule_labourcreditcardamount').val(),
        totalamount: $('#pay_schedule_labourtotalamount').val(),
        purpose: val
      };
  }

}

else if(val == "paystubcancel"){

        swal({
      title: "Are you sure?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Close all inputs
        $("#pay_schedule_labourname").prop('selectedIndex',0);
        $('#pay_schedule_labourstartdate').val('');
        $('#pay_schedule_labourenddate').val('');
        $('#pay_schedule_labourlicence').val('');
        $('#pay_schedule_labourmake').val('');
        $('#pay_schedule_labourmodel').val('');
        $('#pay_schedule_labourreportdate').val('');
        $('#pay_schedule_labourservicetype').val('');
        $('#pay_schedule_labourserviceoption').val('');
        $('#pay_schedule_labourhour').val('');
        $('#pay_schedule_labourrate').val('');
        $('#pay_schedule_labourpaydue').val('');
        $('#pay_schedule_labourcashamount').val('');
        $('#pay_schedule_labourchequeno').val('');
        $('#pay_schedule_labourchequedate').val('');
        $('#pay_schedule_labourchequeamount').val('');
        $('#pay_schedule_labourcreditcardno').val('');
        $('#pay_schedule_labourcreditcardcc').val('');
        $('#pay_schedule_labourcreditcardamount').val('');
        $('#pay_schedule_labourtotalamount').val('');
      } else {

      }
    });


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

          if(result.message == "success" && result.action == "movetopayschedule"){
            spinner.addClass('disp-0');
            $("#pay_labour_licence").prop('selectedIndex',0);
            $('#pay_labour_correctLicence').val('');
            $('#pay_labour_make').val('');
            $('#pay_labour_model').val('');
            $('#pay_labour_reportdate').val('');
            $('#pay_labour_servicetype').val('');
            $('#pay_labour_serviceoption').val('');
            $('#pay_labour_labourhour').val('');
            $('#pay_labour_labourrate').val('');
            $('#pay_labour_paydue').val('');
            $('#pay_labourtechnicians').val('');

            swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else if(result.message == "success" && result.action == "printmail"){
              spinner.addClass('disp-0');
              $("#pay_labour_licence").prop('selectedIndex',0);
              $('#pay_labour_correctLicence').val('');
              $('#pay_labour_make').val('');
              $('#pay_labour_model').val('');
              $('#pay_labour_reportdate').val('');
              $('#pay_labour_servicetype').val('');
              $('#pay_labour_serviceoption').val('');
              $('#pay_labour_labourhour').val('');
              $('#pay_labour_labourrate').val('');
              $('#pay_labour_paydue').val('');
              $('#pay_labourtechnicians').val('');

              swal('Good!', result.res, result.message);

              setTimeout(function(){ location.href = location.origin+'/Paystubmail/'+result.link; }, 2000);
          }
          else if(result.message == "success" && result.action == "paystub"){
            spinner.addClass('disp-0');
            $("#pay_schedule_labourname").prop('selectedIndex',0);
            $('#pay_schedule_labourstartdate').val('');
            $('#pay_schedule_labourenddate').val('');
            $('#pay_schedule_labourlicence').val('');
            $('#pay_schedule_labourmake').val('');
            $('#pay_schedule_labourmodel').val('');
            $('#pay_schedule_labourreportdate').val('');
            $('#pay_schedule_labourservicetype').val('');
            $('#pay_schedule_labourserviceoption').val('');
            $('#pay_schedule_labourhour').val('');
            $('#pay_schedule_labourrate').val('');
            $('#pay_schedule_labourpaydue').val('');
            $('#pay_schedule_labourcashamount').val('');
            $('#pay_schedule_labourchequeno').val('');
            $('#pay_schedule_labourchequedate').val('');
            $('#pay_schedule_labourchequeamount').val('');
            $('#pay_schedule_labourcreditcardno').val('');
            $('#pay_schedule_labourcreditcardcc').val('');
            $('#pay_schedule_labourcreditcardamount').val('');
            $('#pay_schedule_labourtotalamount').val('');

            // $('#payLabstore').click();

            // $('button#payLabstore').magnificPopup({
            //   items: {
            //     src: '<div class="white-popup"><p class="text-center text-success" style="font-weight: bold;">Select Payment Gateway</p><br><div class="row"><div class="col-md-6"><a type="button" href="/paypalpayinstore/'+result.estimate_id+'"><img src="https://www.freepnglogos.com/uploads/paypal-logo-png-3.png" style="width: auto; height: 100px"/></a><br><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/cotton/64/000000/money-transfer.png" style="width: 30px; height: 30px;">Other Countries</p></div><div class="col-md-6"><a type="button" href="/monerispayinstore/'+result.estimate_id+'"><img src="https://logodix.com/logo/2028590.png" style="width: auto; height: 100px"/></a><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/color/48/000000/canada-circular.png" style="width: 30px; height: 30px;">Canada & <img src="https://img.icons8.com/color/48/000000/usa-circular.png" style="width: 30px; height: 30px;"> US</p></div></div></div>',
            //       type: 'inline'
            //   },
            //   closeBtnInside: true
            // });

            // swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);
          }

          else if(result.message == "success" && result.action == "paystubmail"){
            spinner.addClass('disp-0');
            $("#pay_schedule_labourname").prop('selectedIndex',0);
            $('#pay_schedule_labourstartdate').val('');
            $('#pay_schedule_labourenddate').val('');
            $('#pay_schedule_labourlicence').val('');
            $('#pay_schedule_labourmake').val('');
            $('#pay_schedule_labourmodel').val('');
            $('#pay_schedule_labourreportdate').val('');
            $('#pay_schedule_labourservicetype').val('');
            $('#pay_schedule_labourserviceoption').val('');
            $('#pay_schedule_labourhour').val('');
            $('#pay_schedule_labourrate').val('');
            $('#pay_schedule_labourpaydue').val('');
            $('#pay_schedule_labourcashamount').val('');
            $('#pay_schedule_labourchequeno').val('');
            $('#pay_schedule_labourchequedate').val('');
            $('#pay_schedule_labourchequeamount').val('');
            $('#pay_schedule_labourcreditcardno').val('');
            $('#pay_schedule_labourcreditcardcc').val('');
            $('#pay_schedule_labourcreditcardamount').val('');
            $('#pay_schedule_labourtotalamount').val('');

            swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = location.origin+'/Paystubmail/'+result.link; }, 2000);
          }
          else{

              spinner.addClass('disp-0');
              swal('Oops!', result.res, result.message);
          }

        }

      });


}

function checksomeInfo(val){
  var route = "{{ URL('Ajax/informationCheck') }}";
  var spinner;
  $('tbody#stubreport').html('');
  if(val == "paystub"){
    var thisdata = {
      estimate_id: $('#pay_schedule_labourname').val(),
      start_date: $('#pay_schedule_labourstartdate').val(),
      end_date: $('#pay_schedule_labourenddate').val(),
      val: 'paystub'
    };
    spinner = $('.spinstub');

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
          if(result.message == "success" && result.action == "paystub"){
            var res = JSON.parse(result.data);

            $.each(res, function(v,k){
              $("tbody#stubreport").append("<tr style='font-size: 12px;'><td>"+(v+1)+"</td><td>"+ k.date +"</td><td>"+ k.vehicle_licence +"</td><td>"+ k.make +"</td><td>"+ k.model +"</td><td>"+ k.service_option +"</td><td>"+ k.service_type +"</td><td>"+ k.hour +"</td><td>"+ k.rate +"</td><td>"+ k.pay_due +"</td><td><i type='button' class='fas fa-hand-holding-usd' onclick=paylabour('paystub') title='Process Pay' style='cursor:pointer; font-size: 12px;'></i> <i type='button' class='fas fa-envelope-open-text' title='Print/Email' onclick=paylabour('paystubmail') style='cursor:pointer; font-size: 12px;'></i></td><tr>");
            });
          }
          else{
              $('tbody#stubreport').html('');
              swal('Oops!', result.res, result.message);
          }

        }

      });
  }
}



$('#pay_schedule_labourname').change(function(){

  if($('#pay_schedule_labourname').val != ""){
          var route = "{{ URL('Ajax/fetchtheNeedful') }}";


  var thisdata = {
    estimate_id: $('#pay_schedule_labourname').val(),
    action: "payschedule"
  };
        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){

          if(result.message == "success" && result.action == "payschedule"){
            var res = JSON.parse(result.data);
            $('#pay_schedule_labourlicence').val(res[0].licence);
            $('#pay_schedule_labourmake').val(res[0].make);
            $('#pay_schedule_labourmodel').val(res[0].model);
            $('#pay_schedule_labourreportdate').val(res[0].date);
            $('#pay_schedule_labourservicetype').val(res[0].service_type);
            $('#pay_schedule_labourserviceoption').val(res[0].service_option);
            $('#pay_schedule_labourhour').val(res[0].hour);
            $('#pay_schedule_labourrate').val(res[0].rate);
            $('#pay_schedule_labourpaydue').val(res[0].pay_due);
          }
          else{
              swal('Oops!', result.res, result.message);
          }

        }

      });
  }
  else{
    $('#pay_schedule_labourstartdate').val('');
    $('#pay_schedule_labourenddate').val('');
    $('#pay_schedule_labourlicence').val('');
    $('#pay_schedule_labourmake').val('');
    $('#pay_schedule_labourmodel').val('');
    $('#pay_schedule_labourreportdate').val('');
    $('#pay_schedule_labourservicetype').val('');
    $('#pay_schedule_labourserviceoption').val('');
    $('#pay_schedule_labourhour').val('');
    $('#pay_schedule_labourrate').val('');
    $('#pay_schedule_labourpaydue').val('');
    $('#pay_schedule_labourcashamount').val('');
    $('#pay_schedule_labourchequeno').val('');
    $('#pay_schedule_labourchequedate').val('');
    $('#pay_schedule_labourchequeamount').val('');
    $('#pay_schedule_labourcreditcardno').val('');
    $('#pay_schedule_labourcreditcardcc').val('');
    $('#pay_schedule_labourcreditcardamount').val('');
    $('#pay_schedule_labourtotalamount').val('');
  }
});


    //   $('button.proPayment').magnificPopup({
    //   items: {
    //     src: '<div class="white-popup"><p class="text-center text-success" style="font-weight: bold;">Select Payment Gateway</p><br><div class="row"><div class="col-md-6"><a type="button" href="/paypalpayinstore/'+$('#pay_stub_labourname').val()+'"><img src="https://www.freepnglogos.com/uploads/paypal-logo-png-3.png" style="width: auto; height: 100px"/></a><br><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/cotton/64/000000/money-transfer.png" style="width: 30px; height: 30px;">Other Countries</p></div><div class="col-md-6"><a type="button" href="/monerispayinstore/'+$('#pay_stub_labourname').val()+'"><img src="https://logodix.com/logo/2028590.png" style="width: auto; height: 100px"/></a><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/color/48/000000/canada-circular.png" style="width: 30px; height: 30px;">Canada & <img src="https://img.icons8.com/color/48/000000/usa-circular.png" style="width: 30px; height: 30px;"> US</p></div></div></div>',
    //       type: 'inline'
    //   },
    //   closeBtnInside: true
    // });


  $('#pay_stub_labourname').change(function(){



    if($('#pay_stub_labourname').val != ""){
      var route = "{{ URL('Ajax/fetchtheNeedful') }}";
  var thisdata = {
    estimate_id: $('#pay_stub_labourname').val(),
    action: "paystublabour"
  };


        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){

          if(result.message == "success" && result.action == "paystublabour"){
            var res = JSON.parse(result.data);
            $('#pay_stub_labourlicence').val(res[0].licence);
            $('#pay_stub_labourmake').val(res[0].make);
            $('#pay_stub_labourmodel').val(res[0].model);
            $('#pay_stub_labourreportdate').val(res[0].date);
            $('#pay_stub_labourservicetype').val(res[0].service_type);
            $('#pay_stub_labourserviceoption').val(res[0].service_option);
            $('#pay_stub_labourhour').val(res[0].hour);
            $('#pay_stub_labourrate').val(res[0].rate);
            $('#pay_stub_labourpaydue').val(res[0].pay_due);
            $('#pay_stub_labourstartdate').val(res[0].start_date);
            $('#pay_stub_labourenddate').val(res[0].end_date);
            $('#pay_stub_labourtechnician').val(res[0].technician);
          }
          else{
              swal('Oops!', result.res, result.message);
          }

        }

      });
  }
  else{
    $('#pay_stub_labourstartdate').val('');
    $('#pay_stub_labourenddate').val('');
    $('#pay_stub_labourlicence').val('');
    $('#pay_stub_labourmake').val('');
    $('#pay_stub_labourmodel').val('');
    $('#pay_stub_labourreportdate').val('');
    $('#pay_stub_labourservicetype').val('');
    $('#pay_stub_labourserviceoption').val('');
    $('#pay_stub_labourhour').val('');
    $('#pay_stub_labourrate').val('');
    $('#pay_stub_labourpaydue').val('');
    $('#pay_stub_labourdeduction').val('');
    $('#pay_stub_labourbalance').val('');
    $('#pay_stub_labourtotalpay').val('');
    $('#pay_stub_labourcashamount').val('');
    $('#pay_stub_labourchequeno').val('');
    $('#pay_stub_labourchequedate').val('');
    $('#pay_stub_labourchequeamount').val('');
    $('#pay_stub_labourcreditcardno').val('');
    $('#pay_stub_labourcreditcardcc').val('');
    $('#pay_stub_labourcreditcardamount').val('');
    $('#pay_stub_labourtotalamount').val('');
    $('#pay_stub_labourtechnician').val('');
  }


});


  // $('.proPayment').click();

    // $('button.proPayment').magnificPopup({
    //   items: {
    //     src: '<div class="white-popup"><p class="text-center text-success" style="font-weight: bold;">Select Payment Gateway</p><br><div class="row"><div class="col-md-6"><a type="button" href="/paypalpayinstore/'+$('#pay_stub_labourname').val()+'"><img src="https://www.freepnglogos.com/uploads/paypal-logo-png-3.png" style="width: auto; height: 100px"/></a><br><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/cotton/64/000000/money-transfer.png" style="width: 30px; height: 30px;">Other Countries</p></div><div class="col-md-6"><a type="button" href="/monerispayinstore/'+$('#pay_stub_labourname').val()+'"><img src="https://logodix.com/logo/2028590.png" style="width: auto; height: 100px"/></a><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/color/48/000000/canada-circular.png" style="width: 30px; height: 30px;">Canada & <img src="https://img.icons8.com/color/48/000000/usa-circular.png" style="width: 30px; height: 30px;"> US</p></div></div></div>',
    //       type: 'inline'
    //   },
    //   closeBtnInside: true
    // });


function processStub(val){
  var route = "{{ URL('Ajax/processStub') }}";
  var thisdata;
  var spinner;

if(val == "processpaystubcancel"){
      swal({
      title: "Are you sure?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Close all inputs
        $("#pay_stub_labourname").prop('selectedIndex',0);
        $('#pay_stub_labourstartdate').val('');
        $('#pay_stub_labourenddate').val('');
        $('#pay_stub_labourlicence').val('');
        $('#pay_stub_labourmake').val('');
        $('#pay_stub_labourmodel').val('');
        $('#pay_stub_labourreportdate').val('');
        $('#pay_stub_labourservicetype').val('');
        $('#pay_stub_labourserviceoption').val('');
        $('#pay_stub_labourhour').val('');
        $('#pay_stub_labourrate').val('');
        $('#pay_stub_labourdeduction').val('');
        $('#pay_stub_labourbalance').val('');
        $('#pay_stub_labourtotalpay').val('');
        $('#pay_stub_labourpaydue').val('');
        $('#pay_stub_labourcashamount').val('');
        $('#pay_stub_labourchequeno').val('');
        $('#pay_stub_labourchequedate').val('');
        $('#pay_stub_labourchequeamount').val('');
        $('#pay_stub_labourcreditcardno').val('');
        $('#pay_stub_labourcreditcardcc').val('');
        $('#pay_stub_labourcreditcardamount').val('');
        $('#pay_stub_labourtotalamount').val('');
        $('#pay_stub_labourtechnician').val('');
      } else {

      }
    });
}

else if(val == "processpaystub"){
  spinner = $('.spinnerprocesspaystub');
  thisdata = {
       estimate_id: $("#pay_stub_labourname").val(),
       start_date: $('#pay_stub_labourstartdate').val(),
       end_date: $('#pay_stub_labourenddate').val(),
       licence: $('#pay_stub_labourlicence').val(),
       make: $('#pay_stub_labourmake').val(),
       model: $('#pay_stub_labourmodel').val(),
       reportdate: $('#pay_stub_labourreportdate').val(),
       service_type: $('#pay_stub_labourservicetype').val(),
       service_option: $('#pay_stub_labourserviceoption').val(),
       hour: $('#pay_stub_labourhour').val(),
       rate: $('#pay_stub_labourrate').val(),
       deduction: $('#pay_stub_labourdeduction').val(),
       balance: $('#pay_stub_labourbalance').val(),
       totalpay: $('#pay_stub_labourtotalpay').val(),
       pay_due: $('#pay_stub_labourpaydue').val(),
       cashamount: $('#pay_stub_labourcashamount').val(),
       chequeno: $('#pay_stub_labourchequeno').val(),
       chequedate: $('#pay_stub_labourchequedate').val(),
       chequeamount: $('#pay_stub_labourchequeamount').val(),
       creditcardno: $('#pay_stub_labourcreditcardno').val(),
       creditcardcc: $('#pay_stub_labourcreditcardcc').val(),
       creditcardamount: $('#pay_stub_labourcreditcardamount').val(),
       totalamount: $('#pay_stub_labourtotalamount').val(),
       technician: $('#pay_stub_labourtechnician').val(),
       purpose: val
  };
}
else if(val == "processpaystubmail"){
    spinner = $('.spinnerprocesspaystubmail');
  thisdata = {
       estimate_id: $("#pay_stub_labourname").val(),
       start_date: $('#pay_stub_labourstartdate').val(),
       end_date: $('#pay_stub_labourenddate').val(),
       licence: $('#pay_stub_labourlicence').val(),
       make: $('#pay_stub_labourmake').val(),
       model: $('#pay_stub_labourmodel').val(),
       reportdate: $('#pay_stub_labourreportdate').val(),
       service_type: $('#pay_stub_labourservicetype').val(),
       service_option: $('#pay_stub_labourserviceoption').val(),
       hour: $('#pay_stub_labourhour').val(),
       rate: $('#pay_stub_labourrate').val(),
       deduction: $('#pay_stub_labourdeduction').val(),
       balance: $('#pay_stub_labourbalance').val(),
       totalpay: $('#pay_stub_labourtotalpay').val(),
       pay_due: $('#pay_stub_labourpaydue').val(),
       cashamount: $('#pay_stub_labourcashamount').val(),
       chequeno: $('#pay_stub_labourchequeno').val(),
       chequedate: $('#pay_stub_labourchequedate').val(),
       chequeamount: $('#pay_stub_labourchequeamount').val(),
       creditcardno: $('#pay_stub_labourcreditcardno').val(),
       creditcardcc: $('#pay_stub_labourcreditcardcc').val(),
       creditcardamount: $('#pay_stub_labourcreditcardamount').val(),
       totalamount: $('#pay_stub_labourtotalamount').val(),
       technician: $('#pay_stub_labourtechnician').val(),
       purpose: val
  };
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

          if(result.message == "success" && result.action == "processpaystub"){

            spinner.addClass('disp-0');
            $("#pay_stub_labourname").prop('selectedIndex',0);
            $('#pay_stub_labourstartdate').val('');
            $('#pay_stub_labourenddate').val('');
            $('#pay_stub_labourlicence').val('');
            $('#pay_stub_labourmake').val('');
            $('#pay_stub_labourmodel').val('');
            $('#pay_stub_labourreportdate').val('');
            $('#pay_stub_labourservicetype').val('');
            $('#pay_stub_labourserviceoption').val('');
            $('#pay_stub_labourhour').val('');
            $('#pay_stub_labourrate').val('');
            $('#pay_stub_labourdeduction').val('');
            $('#pay_stub_labourbalance').val('');
            $('#pay_stub_labourtotalpay').val('');
            $('#pay_stub_labourpaydue').val('');
            $('#pay_stub_labourcashamount').val('');
            $('#pay_stub_labourchequeno').val('');
            $('#pay_stub_labourchequedate').val('');
            $('#pay_stub_labourchequeamount').val('');
            $('#pay_stub_labourcreditcardno').val('');
            $('#pay_stub_labourcreditcardcc').val('');
            $('#pay_stub_labourcreditcardamount').val('');
            $('#pay_stub_labourtotalamount').val('');
            $('#pay_stub_labourtechnician').val('');

            swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);
          }

          else if(result.message == "success" && result.action == "processpaystubmail"){
            spinner.addClass('disp-0');
            $("#pay_stub_labourname").prop('selectedIndex',0);
            $('#pay_stub_labourstartdate').val('');
            $('#pay_stub_labourenddate').val('');
            $('#pay_stub_labourlicence').val('');
            $('#pay_stub_labourmake').val('');
            $('#pay_stub_labourmodel').val('');
            $('#pay_stub_labourreportdate').val('');
            $('#pay_stub_labourservicetype').val('');
            $('#pay_stub_labourserviceoption').val('');
            $('#pay_stub_labourhour').val('');
            $('#pay_stub_labourrate').val('');
            $('#pay_stub_labourdeduction').val('');
            $('#pay_stub_labourbalance').val('');
            $('#pay_stub_labourtotalpay').val('');
            $('#pay_stub_labourpaydue').val('');
            $('#pay_stub_labourcashamount').val('');
            $('#pay_stub_labourchequeno').val('');
            $('#pay_stub_labourchequedate').val('');
            $('#pay_stub_labourchequeamount').val('');
            $('#pay_stub_labourcreditcardno').val('');
            $('#pay_stub_labourcreditcardcc').val('');
            $('#pay_stub_labourcreditcardamount').val('');
            $('#pay_stub_labourtotalamount').val('');
            $('#pay_stub_labourtechnician').val('');

            swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = location.origin+'/Paystubmail/'+result.link; }, 2000);
          }
          else{
              swal('Oops!', result.res, result.message);
          }

        }

      });

}


function labourstubMails(id){
  var route = "{{ URL('Ajax/labourstubMails') }}";
  var thisdata = {estimate_id: id};

          setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $('.spinnerstubMail').removeClass('disp-0');
        },
        success: function(result){

          if(result.message == "success"){
            $('.spinnerstubMail').addClass('disp-0');
            swal('Good!', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);
          }
          else{
            $('.spinnerstubMail').addClass('disp-0');
              swal('Oops!', result.res, result.message);
          }

        }

      });
}


var cnt=3;
var labcnt=2;
function addnewRecs(action){
  if(action == "material"){
     cnt=cnt + 1;
     $('.mat_cost'+cnt).removeClass('disp-0');
  }
  if(action == "labour"){
    labcnt=labcnt + 1;
     $('.lab_cost'+labcnt).removeClass('disp-0');
  }
}



function makeActions(phone, action){
    var route = "{{ URL('Ajax/performsearchAction') }}";
    var thisdata = {phone: phone, action: action};

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $('.spinner').removeClass('disp-0');
        },
        success: function(result){

          if(result.message == "success" && result.action == "make call"){
            $('.spinner').addClass('disp-0');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = 'tel:'+result.link; }, 2000);
          }
          else if(result.message == "success" && result.action == "send sms"){
            $('.spinner').addClass('disp-0');
            swal('Good!', result.res, result.message);
            setTimeout(function(){ location.href = 'sms:'+result.link; }, 2000);
          }
          else if(result.message == "success" && result.action == "book appointment"){
            $('.spinner').addClass('disp-0');
            swal('Good!', result.res, result.message);
          }
          else{
            $('.spinner').addClass('disp-0');
              swal('Oops!', result.res, result.message);
          }

        }

      });

}

function editTech(id){
    var route = "{{ URL('Ajax/technicianEdit') }}";
    var thisdata = {id: id};

        setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        success: function(result){

          if(result.message == "success"){
            var res = JSON.parse(result.data);
            $('#addlabour_id').val(res[0].id);
            $('#addlabour_firstname').val(res[0].firstname);
            $('#addlabour_lastname').val(res[0].lastname);
            $('#addlabour_email').val(res[0].email);
            $('#addlabour_phone').val(res[0].phone);
            $('#addlabour_password').val('');
            $('#addlabour_speciality').val(res[0].speciality);
            $('#addlabour_category').val(res[0].category);
            $('#addlabour_hourly_rate').val(res[0].hourly_rate);
            $('#addlabour_flat_rate').val(res[0].flat_rate);
            $('#addlabour_budgeted_hours').val(res[0].budgeted_hours);
            $('#addlabour_total_costs').val(res[0].total_cost);
            $('#addlabour_actual_hours').val(res[0].actual_hours);
            $('#addlabour_labour_costs').val(res[0].labour_cost);
            $('#addlabour_job_description').val(res[0].job_description);
            $('#addlabour_notes').val(res[0].notes);

                // Open AddLabour Pane
                $('#addlabour-tab').click();
                // Change To update button
                $('.addlabour_sbmt').addClass('disp-0');
                $('.addlabour_updt').removeClass('disp-0');
          }
          else{
            $('.spinner').addClass('disp-0');
              swal('Oops!', result.res, result.message);
          }

        }

      });

}

function updateLabour(){
  var route = "{{ URL('Ajax/UpdateLabour') }}";
  var spinner = $('.spinneraddlabour_updt');
  var formData = new FormData();
  if($("#addlabour_firstname").val() == ""){
    swal('Oops!', 'Please provide firstname', 'info');
      return false;
  }
  else if($("#addlabour_lastname").val() == ""){
    swal('Oops!', 'Please provide lastname', 'info');
      return false;
  }
  else if($("#addlabour_category").val() == ""){
    swal('Oops!', 'Please select category', 'info');
      return false;
  }
  else if($("#addlabour_speciality").val() == ""){
    swal('Oops!', 'Please describe speciality', 'info');
      return false;
  }
  else if($("#addlabour_email").val() == ""){
    swal('Oops!', 'Please provide email address', 'info');
      return false;
  }
  else if($("#addlabour_phone").val() == ""){
    swal('Oops!', 'Please provide phone number', 'info');
      return false;
  }
  else if($("#addlabour_hourly_rate").val() == ""){
    swal('Oops!', 'Please provide hourly rate', 'info');
      return false;
  }
  else if($("#addlabour_flat_rate").val() == ""){
    swal('Oops!', 'Please provide flat rate', 'info');
      return false;
  }
  else if($("#addlabour_budgeted_hours").val() == ""){
    swal('Oops!', 'Please provide budgeted hours', 'info');
      return false;
  }
  else if($("#addlabour_actual_hours").val() == ""){
    swal('Oops!', 'Please provide actual hours', 'info');
      return false;
  }
  else if($("#addlabour_labour_costs").val() == ""){
    swal('Oops!', 'Please provide labour cost', 'info');
      return false;
  }
  else if($("#addlabour_total_costs").val() == ""){
    swal('Oops!', 'Please provide total cost', 'info');
      return false;
  }
  else if($("#addlabour_job_description").val() == ""){
    swal('Oops!', 'Please provide job description', 'info');
      return false;
  }
  else if($("#addlabour_notes").val() == ""){
    swal('Oops!', 'Please add a note', 'info');
      return false;
  }
  else{

      var fileSelect = document.getElementById("addlabour_videoupload");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("addlabour_videoupload", file , file.name);
       }

      formData.append("id", $("#addlabour_id").val());
      formData.append("firstname", $("#addlabour_firstname").val());
      formData.append("lastname", $("#addlabour_lastname").val());
      formData.append("category", $("#addlabour_category").val());
      formData.append("speciality", $("#addlabour_speciality").val());
      formData.append("email", $("#addlabour_email").val());
      formData.append("password", $("#addlabour_password").val());
      formData.append("userType", $("#addlabour_role").val());
      formData.append("phone", $("#addlabour_phone").val());
      formData.append("hourly_rate", $("#addlabour_hourly_rate").val());
      formData.append("flat_rate", $("#addlabour_flat_rate").val());
      formData.append("budgeted_hours", $("#addlabour_budgeted_hours").val());
      formData.append("actual_hours", $("#addlabour_actual_hours").val());
      formData.append("labour_cost", $("#addlabour_labour_costs").val());
      formData.append("total_cost", $("#addlabour_total_costs").val());
      formData.append("job_description", $("#addlabour_job_description").val());
      formData.append("notes", $("#addlabour_notes").val());
  }

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
            if(result.message == "success"){
                spinner.addClass('disp-0');
                swal("Saved!", result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 3000);
            }

        }

      });
}

function Monitor(busID, purpose, licence){
    var route = "{{ URL('Ajax/monitorRecords') }}";
    var thisdata = {busID: busID, purpose: purpose, licence: licence};
    var spinner = $('.spinnermonitor');

    if(purpose == "deleterec"){
        swal({
          title: "Are you sure you want to delete record?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            route = "{{ URL('Ajax/monitorRecords') }}";
            thisdata = {busID: busID, purpose: 'deleterec', licence: licence};

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
                    if(result.message == "success" && result.action == "deleterec"){
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

          } else {

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
          spinner.removeClass('disp-0');
        },
        success: function(result){
            if(result.message == "success" && result.action == "estimate"){
                spinner.addClass('disp-0');
                setTimeout(function(){ location.href = location.origin+'/MonitorRecord/'+result.link; }, 2000);
            }
            else if(result.message == "success" && result.action == "workorder"){
                spinner.addClass('disp-0');
              setTimeout(function(){ location.href = location.origin+'/MonitorRecord/'+result.link; }, 2000);
            }
            else if(result.message == "success" && result.action == "maintenance"){
                spinner.addClass('disp-0');
              setTimeout(function(){ location.href = location.origin+'/MonitorRecord/'+result.link; }, 2000);
            }
            else if(result.message == "success" && result.action == "ownerrec"){
                spinner.addClass('disp-0');
              setTimeout(function(){ location.href = location.origin+'/MonitoruserRecord/'+result.link; }, 2000);
            }
            else{
                spinner.addClass('disp-0');
                swal('Oops', result.res, result.message);
            }

        }

      });
    }



}


function bookTicket(val){
var route;
var formData = new FormData();
var spinner = $('.spinTicket');
if(val == "submit"){
    route = "{{ URL('Ajax/bookingTicket') }}";

      var fileSelect = document.getElementById("ticketAttachment");
      if(fileSelect.files && fileSelect.files.length == 1){
         var file = fileSelect.files[0]
         formData.set("ticketAttachment", file , file.name);
       }

    formData.append("ticketID", $("#ticketID").val());
    formData.append("ticketName", $("#ticketName").val());
    formData.append("ticketEmail", $("#ticketEmail").val());
    formData.append("ticketSubject", $("#ticketSubject").val());
    formData.append("ticketDepartment", $("#ticketDepartment").val());
    formData.append("ticketRelatedServices", $("#ticketRelatedServices").val());
    formData.append("ticketPriority", $("#ticketPriority").val());
    formData.append("ticketMessage", $("#ticketMessage").val());

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
            if(result.message == "success"){
                $("#ticketID").val('<?php echo '#'.mt_rand(10000, 99999);?>');
                $("#ticketSubject").val('');
                $("#ticketMessage").val('');
                $("#ticketAttachment").val('');
                $("#ticketDepartment").prop('selectedIndex',0);
                $("#ticketRelatedServices").prop('selectedIndex',0);

                spinner.addClass('disp-0');
                swal("Thanks!", result.res, result.message);
            }
            else{
                spinner.addClass('disp-0');
                swal("Oops!", result.res, result.message);
            }
        }

      });
}
else if(val == "cancel"){
    $("#ticketSubject").val('');
    $("#ticketMessage").val('');
    $("#ticketDepartment").prop('selectedIndex',0);
    $("#ticketRelatedServices").prop('selectedIndex',0);
    $("#ticketAttachment").val('');
}

}

      // Auto Care Search
$('#auto_care').keypress(function (e) {
  if (e.which == 13) {
    var route =  "{{ URL('Ajax/AutoCare') }}";
    var thisdata = {auto_care: $("#auto_care").val(),}

    // Do Ajax to fetch result
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
        });
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
            $('.spinnerAutocare').removeClass('disp-0');
        },
        success: function(result){
          if(result.message == "success"){
            // console.log(result);
            $('.spinnerAutocare').addClass('disp-0');
            setTimeout(function(){ location.href = result.link; }, 1000);
          }
          else{
            $('.spinnerAutocare').addClass('disp-0');
            swal('Oops', result.res, result.message);
          }
        }
      });

    return false;    // Add this line
  }
});


function resendInvite(id){
 var route = "{{ URL('Ajax/resendInvites') }}";
 var thisdata = {id: id};
 var spinner = $('.spinnerinv'+id);

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
                spinner.addClass('disp-0');
                setTimeout(function(){ location.href = result.link; }, 2000);
            }
            else{
                spinner.addClass('disp-0');
                swal('Oops', result.res, result.message);
            }

        }

      });
}


$('#know_about1').change(function(){
    if($('#know_about1').val() == "Friends" || $('#know_about1').val() == "Invite Email"){
        $('#referred_by').val('');
        $('.ref1').removeClass('disp-0');
    }
    else{
        $('#referred_by').val('N/A');
        $('.ref1').addClass('disp-0');
    }
});
$('#know_about2').change(function(){
    if($('#know_about2').val() == "Friends" || $('#know_about2').val() == "Invite Email"){
        $('#referred_bycom').val('');
        $('.ref2').removeClass('disp-0');
    }
    else{
        $('#referred_bycom').val('N/A');
        $('.ref2').addClass('disp-0');
    }
});


function redeemPoint(ref_code, action, userType, points){
    var route = "{{ URL('Ajax/redeemPoints') }}";
    var thisdata = {ref_code: ref_code, action: action};
    var spinner = $('.spinredeem');
    var pointMax;
    var mypoints;

    if(action == 'noteligible' && userType == 'Individual'){
        pointMax = 50000;
        mypoints = 1000 * points;
        needed = pointMax - mypoints;

        swal(mypoints+' points available', 'You need '+needed+' points more to be eligible to redeem points', 'info');
    }
    else if(action == 'noteligible' && userType == 'Commercial'){
        pointMax = 10000;
        mypoints = 1000 * points;
        needed = pointMax - mypoints;
        swal(mypoints+' points available', 'You need '+needed+' points more to be eligible to redeem points', 'info');
    }
    else{
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
            if(result.message == "success" && result.action == "start"){
                spinner.addClass('disp-0');
                setTimeout(function(){ location.href = result.link; }, 1000);
            }
            else if(result.message == "success" && result.action == "claim"){
                spinner.addClass('disp-0');
                setTimeout(function(){ location.href = result.link; }, 3000);
            }
            else{
                spinner.addClass('disp-0');
                swal('Oops', result.res, result.message);
            }

        }

      });
    }



}

function advancesearch(){
var route = "{{ URL('Ajax/AdvanceSearch') }}";
var thisdata = {zipcode: $('#advanceSearch').val()};
var spinner = $('.spinner');
if($('#advanceSearch').val() == ""){
  swal('Oops!', 'Please enter a valid postal/zip code', 'warning');
  return false;
}
else{
  setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          spinner.removeClass('disp-0');
          $('#advanceSearch').val('');
        },
        success: function(result){
            if(result.message == "success"){
                spinner.addClass('disp-0');

                setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 1000);
            }
            else{
                spinner.addClass('disp-0');
                swal('Oops', result.res, result.message);
            }

        }

      });
}

}

$('#postrequestby').change(function(){
  // Go fetch result
  $('#localeresult').text('');

  if($('#postrequestby').val() == ""){
    $('#localeresult').text('Select an option');
  }
  else{
    var route = "{{ URL('Ajax/fetchRequest') }}";
    var thisdata = {search: $('#postrequestby').val()};
    setHeaders();
        jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
        $('#localeresult').text('Searching...');
      },
      success: function(result){
          if(result.message == "success"){
              $('#localeresult').text(result.data);
          }
          else{
              $('#localeresult').text('0 mechanic found');
          }

      }

    });
  }



});

$('#postlicence').change(function(){
  $('#postmake').val('');
    $('#postmodel').val('');
  var route = "{{ URL('Ajax/getLicence') }}";
  var thisdata = {licence: $('#postlicence').val()};

  if($('#postlicence').val() == ""){
    $('#postmake').val('Nothing to show');
    $('#postmodel').val('Nothing to show');
    $('#postmileage').val('Nothing to show');
    $('#postyear').val('Nothing to show');
  }
  else{
        setHeaders();
        jQuery.ajax({
      url: route,
      method: 'post',
      data: thisdata,
      dataType: 'JSON',
      beforeSend: function(){
        $('#postmake').val('Fetching...');
        $('#postmodel').val('Fetching...');
        $('#postmileage').val('Fetching...');
        $('#postyear').val('Fetching...');
      },
      success: function(result){
          if(result.message == "success"){
            var res = JSON.parse(result.data);
              $('#postmake').val(res[0].make);
              $('#postmodel').val(res[0].model);
              $('#postmileage').val(result.mileage);
              $('#postyear').val(res[0].year_owned_since);
          }
          else{
              $('#postmake').val(result.res);
              $('#postmodel').val(result.res);
              $('#postmileage').val(result.res);
              $('#postyear').val(result.res);
          }

      }

    });
  }



});


function createPost(ref_code, email){

  if($('#postSubject').val() == ""){
    swal('Oops!', 'Please give hint about your description', 'info');
  return false;
  }
  else if($('#postServeoption').val() == ""){
    swal('Oops!', 'Please select service option', 'info');
  return false;
  }
  else if($('#postlicence').val() == ""){
    swal('Oops!', 'Please select licence', 'info');
  return false;
  }
  else if($('#postmake').val() == ""){
    swal('Oops!', 'Please provide the vehicle make', 'info');
  return false;
  }
  else if($('#postmodel').val() == ""){
    swal('Oops!', 'Please provide the vehicle model', 'info');
  return false;
  }
  else if($('#postmileage').val() == ""){
    swal('Oops!', 'Please provide the vehicle mileage', 'info');
  return false;
  }
  else if($('#post_curr_mileage').val() == ""){
    swal('Oops!', 'Please provide your curent mileage', 'info');
  return false;
  }
  else if($('#postDescription').val() == ""){
    swal('Oops!', 'Please provide the description', 'info');
    return false;
  }
  else if($('#postrequestby').val() == ""){
    swal('Oops!', 'Please select where you want your request sent to', 'info');
    return false;
  }
  else if($('#postserviceneeded').val() == ""){
    swal('Oops!', 'Please enter where service is needed', 'info');
    return false;
  }
  else if($('#postcity').val() == ""){
    swal('Oops!', 'Please enter the city', 'info');
    return false;
  }
  else if($('#poststate').val() == ""){
    swal('Oops!', 'Please enter the state', 'info');
    return false;
  }
  else if($('#postzipcode').val() == ""){
    swal('Oops!', 'Please enter your zipcode', 'info');
    return false;
  }
  else{
    var route = "{{ URL('Ajax/createPost') }}";
    var thisdata = {
      post_id: $('#postIDs').val(),
      ref_code: ref_code,
      email: email,
      subject: $('#postSubject').val(),
      service_option: $('#postServeoption').val(),
      licence: $('#postlicence').val(),
      make: $('#postmake').val(),
      model: $('#postmodel').val(),
      mileage: $('#postmileage').val(),
      post_year: $('#postyear').val(),
      curr_mileage: $('#post_curr_mileage').val(),
      description: $('#postDescription').val(),
      timeline: $('#posttimeline').val(),
      postrequestby: $('#postrequestby').val(),
      postserviceneeded: $('#postserviceneeded').val(),
      postcity: $('#postcity').val(),
      poststate: $('#poststate').val(),
      postzipcode: $('#postzipcode').val()
    };
    var spinner = $('.spinnerpost');

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
            spinner.addClass('disp-0');
            $('#postIDs').val("<?php echo 'POST_'.mt_rand('10000', '99999'); ?>");
            $('#postSubject').prop('selectedIndex',0);
            $('#postServeoption').prop('selectedIndex',0);
            $('#postlicence').prop('selectedIndex',0);
            $('#postmake').val('');
            $('#postmodel').val('');
            $('#postmileage').val('');
            $('#postyear').val('');
            $('#post_curr_mileage').val('');
            $('#postDescription').val('');
            $('#posttimeline').val('');
            $('#postrequestby').prop('selectedIndex',0);
            $('#postserviceneeded').val('');
            $('#localeresult').text('');
            swal('Good Job!', result.res, result.message);

            setTimeout(function(){ location.href = result.link; }, 2000);
        }
        else{
            spinner.addClass('disp-0');
            swal('Oops', result.res, result.message);
        }

    }

  });

  }



}

function clientIvim(licence){
  $('#checkIvim').val('');
  $('.sms').addClass('disp-0');

    var route = "{{ URL('Ajax/userIvim') }}";
  var thisdata = {licence: licence};

    setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      $('#checkIvim').val('1');
    },
    success: function(result){
        if(result.message == "success"){

            $('#recordmaintenance-tab').click();

            $('.sms').removeClass('disp-0');

            if($('#checkIvim').val() == '1'){
              $('#ivim-tab').click();
              $('#searchIvim').val(result.data);
              $('#ivimSearchbtn').click();
            }
            // Click IVIM, and run report
        }
        else{
            swal('Oops', result.res, result.message);
        }

    }

  });
}

function checkIvim(post_id){
  $('#checkIvim').val('');
  $('.sms').addClass('disp-0');
  var route = "{{ URL('Ajax/checkIvim') }}";
  var thisdata = {post_id: post_id};
  var spinner = $('.spinnerivim'+post_id);

    setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      spinner.removeClass('disp-0');
      $('#checkIvim').val('1');
    },
    success: function(result){
        if(result.message == "success"){
            spinner.addClass('disp-0');

            $('#recordmaintenance-tab').click();

            $('.sms').removeClass('disp-0');

            if($('#checkIvim').val() == '1'){

              $('#ivim-tab').click();
              $('#searchIvim').val(result.data);
              $('#ivimSearchbtn').click();
            }
            // Click IVIM, and run report
        }
        else{
            spinner.addClass('disp-0');
            swal('Oops', result.res, result.message);
        }

    }

  });

}

function opportAction(post_id, val){
  var route = "{{ URL('Ajax/actionOpport') }}";
  var thisdata = {post_id: post_id, val: val};
  var spinner = $('.spinneractionOpport');

  if(val == "delete"){
    swal({
          title: "Are you sure you want to delete post?",
          text: "If yes, click OK to delete",
          icon: "error",
          buttons: true,
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

                    if(result.message == "success" && result.action == "delete"){
                      swal('Good!', result.res, result.message);
                      setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 3000);
                    }
                    else{
                      spinner.addClass('disp-0');
                      swal('Oops', result.res, result.message);
                    }

                }

              });
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
          spinner.removeClass('disp-0');
        },
        success: function(result){
            if(result.message == "success" && result.action == "edit"){
                spinner.addClass('disp-0');
                var res = JSON.parse(result.data);
                // Get Post estimate
                $('#postIDs').val(res[0].post_id);
                $('#postSubject').val(res[0].post_subject);
                $('#postServeoption').val(res[0].service_option);
                $('#postlicence').val(res[0].post_licence);
                $('#postmake').val(res[0].post_make);
                $('#postmodel').val(res[0].post_model);
                $('#postmileage').val(res[0].post_mileage);
                $('#postyear').val(res[0].post_year);
                $('#post_curr_mileage').val(res[0].post_curr_mileage);
                $('#postcity').val(res[0].postcity);
                $('#poststate').val(res[0].poststate);
                $('#postzipcode').val(res[0].postzipcode);
                $('#postDescription').val(res[0].post_description);
                $('#postserviceneeded').val(res[0].post_service_need);
                $('#posttimeline').val(res[0].post_timeline);
                $('.savespost').addClass('disp-0');
                $('.updatespost').removeClass('disp-0');

                $('#recordposttoboads-tab').click();

            }
            else{
                spinner.addClass('disp-0');
                swal('Oops', result.res, result.message);
            }

        }

      });
  }



}

function updatePost(){


  if($('#postSubject').val() == ""){
    swal('Oops!', 'Please give hint about your description', 'info');
  return false;
  }
  else if($('#postServeoption').val() == ""){
    swal('Oops!', 'Please select service option', 'info');
  return false;
  }
  else if($('#postmake').val() == ""){
    swal('Oops!', 'Please provide the vehicle make', 'info');
  return false;
  }
  else if($('#postmodel').val() == ""){
    swal('Oops!', 'Please provide the vehicle model', 'info');
  return false;
  }
  else if($('#postmileage').val() == ""){
    swal('Oops!', 'Please provide the vehicle mileage', 'info');
  return false;
  }
  else if($('#postDescription').val() == ""){
    swal('Oops!', 'Please provide the description', 'info');
    return false;
  }
  else if($('#postrequestby').val() == ""){
    swal('Oops!', 'Please select where you want your request sent to', 'info');
    return false;
  }
  else if($('#postserviceneeded').val() == ""){
    swal('Oops!', 'Please select where service is needed', 'info');
    return false;
  }
  else if($('#postcity').val() == ""){
    swal('Oops!', 'Please enter the city', 'info');
    return false;
  }
  else if($('#poststate').val() == ""){
    swal('Oops!', 'Please enter the state', 'info');
    return false;
  }
  else if($('#postzipcode').val() == ""){
    swal('Oops!', 'Please enter your zipcode', 'info');
    return false;
  }
  else{
    var route = "{{ URL('Ajax/updateactionOpport') }}";
    var thisdata = {
      post_id: $('#postIDs').val(),
      subject: $('#postSubject').val(),
      service_option: $('#postServeoption').val(),
      licence: $('#postlicence').val(),
      make: $('#postmake').val(),
      model: $('#postmodel').val(),
      mileage: $('#postmileage').val(),
      post_year: $('#postyear').val(),
      curr_mileage: $('#post_curr_mileage').val(),
      description: $('#postDescription').val(),
      timeline: $('#posttimeline').val(),
      postserviceneeded: $('#postserviceneeded').val(),
      postcity: $('#postcity').val(),
      poststate: $('#poststate').val(),
      postzipcode: $('#postzipcode').val()

    };
    var spinner = $('.spinnerpost');

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


}


function prepareEstimate(post_id ,email, ref_code){
  $('#prepEst').val('');
  $('.sms').addClass('disp-0');
  var route = "{{ URL('Ajax/prepareEstimate') }}";
  var thisdata = {post_id: post_id, email: email, ref_code: ref_code};
  var spinner = $('.spinnerprepestimate'+post_id);

    setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      spinner.removeClass('disp-0');
      $('#prepEst').val('1');
    },
    success: function(result){
        if(result.message == "success"){
          var res = JSON.parse(result.data);
          // var res2 = JSON.parse(result.post_id);
            spinner.addClass('disp-0');
            // Click Estimate Button
            $('#recordmaintenance-tab').click();
            $('.sms').removeClass('disp-0');
            $('#estimate').click();

            

            if($('#prepEst').val() == '1'){
              $('#recordmaintenance-tab').click();
              $('.sms').removeClass('disp-0');
              // Show Discount and Admin Fee
              $('.moreServ').removeClass('disp-0');
            }


            $('#vehicle_licence').val(res[0].vehicle_reg_no);
            $('#email').val(res[0].email);
            $('#telephone').val(res[0].telephone);
            $('#make').val(res[0].make);
            $('#modelz').val(res[0].model);
            $('#service_type').val(result.service_type);
            $('#opportunity_ids').val(result.post_id);

            // Set up price for Discount
            $('#discountcost_percent').val(result.discountpercent);
            $('#servicecost_percent').val(result.servicepercent);

        }
        else{
            spinner.addClass('disp-0');
            swal('Oops', result.res, result.message);
        }

    }

  });
}


function newprepareEstimate(post_id, email, ref_code){

  $('#prepEst').val('');
  $('#discountscheck').val('');
  $('.sms').addClass('disp-0');
  var route = "{{ URL('Ajax/newestimatePrepare') }}";
  var thisdata = {post_id: post_id, email: email, ref_code: ref_code};
  var spinner = $('.spinnernewprepestimate'+post_id);

    setHeaders();
    jQuery.ajax({
    url: route,
    method: 'post',
    data: thisdata,
    dataType: 'JSON',
    beforeSend: function(){
      spinner.removeClass('disp-0');
      $('#prepEst').val('1');
      $('#discountscheck').val('1');
    },
    success: function(result){
        if(result.message == "success"){

          // Ask question

          swal({
          title: "Are you sure you want to prepare estimate?",
          text: "If yes, click OK to continue",
          icon: "info",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var res = JSON.parse(result.data);
          // var res2 = JSON.parse(result.post_id);
            spinner.addClass('disp-0');
            // Click Estimate Button
            $('#recordmaintenance-tab').click();
            $('.sms').removeClass('disp-0');
            $('#estimate').click();

            if($('#prepEst').val() == '1' && $('#discountscheck').val() == '1'){
              $('#recordmaintenance-tab').click();
              $('.sms').removeClass('disp-0');
              // Show Discount and Admin Fee
              $('.moreServ').removeClass('disp-0');
              $('.adminfee').addClass('disp-0');
                $('#servicecost_percent').val(0);

            }


            $('#vehicle_licence').val(res[0].vehicle_reg_no);
            $('#email').val(res[0].email);
            $('#telephone').val(res[0].telephone);
            $('#make').val(res[0].make);
            $('#modelz').val(res[0].model);
            $('#service_type').val(result.service_type);
            $('#service_option').val(result.service_option);
            $('#mileage').val(result.mileage);
            $('#opportunity_ids').val(result.post_id);

            // Show discount
            $('#discountcost_percent').val(result.discountpercent);
          }
        });


        }
        else{
            spinner.addClass('disp-0');
            swal('Oops', result.res, result.message);
        }

    }

  });

}

function payWithPaystack(amount, email, center, post_id, estimate_id, name){
        $('.spin').removeClass('disp-0');
        var email = email;
        var fullname = name;
        var amount = amount;
        var station = center;
        var post_id = post_id;
        var estimate_id = estimate_id;

    var handler = PaystackPop.setup({
      key: 'pk_live_6d26fb29446cf8b89d70cc3364aadf2c0915c604',
      email: email,
      amount: amount * 100,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      firstname: fullname,
      // label: "Optional string that replaces customer email"
      metadata: {
         custom_fields: [
            {
                display_name: "Fullname",
                variable_name: "name",
                value: fullname
            }
         ]
      },
      callback: function(response){
        // Ajax Send Data to Back end
        var route = "{{ URL('Ajax/prepareestimatePay') }}";
        var thisdata = {transactionid: response.reference, name: fullname, email: email, amount: amount, currency: 'NGN', station: station, post_id: post_id, estimate_id: estimate_id}

          setHeaders();
          jQuery.ajax({
          url: route,
          method: 'post',
          data: thisdata,
          dataType: 'JSON',
          success: function(result){
            $('.spin').addClass('disp-0');
            swal('Good', result.res, 'success');
        }

      });

      },
      onClose: function(){
        $('.spin').addClass('disp-0');
        swal('Closed');
      }
    });
    handler.openIframe();
  }


  function monerisPay(){
    var customerID = $('#customerID').val();
    var updateby = $('#updateby').val();
    var opportID = $('#opportID').val();
    var estimateID = $('#estimateID').val();
    var name = $('#full_name').val();
    var email = $('#my_email').val();
    var tot_amount = $('#addedvat_amount').val();
    var creditcard_no = $('#creditcard_no').val();
    var card_month = $('#card_month').val();
    var expirydate = $('#expirydate').val();
    var trans_description = $('#trans_description').val();

    if(tot_amount == ""){
      swal('Oops!', 'Please provide amount for this transaction', 'error');
      return false;
    }
    else if(creditcard_no == ""){
      swal('Oops!', 'Card number is required to process payment', 'error');
      return false;
    }
    else if(card_month == ""){
      swal('Oops!', 'Select expiry month', 'error');
      return false;
    }
    else if(expirydate == ""){
      swal('Oops!', 'Select expiry year', 'error');
      return false;
    }
    else if(trans_description == ""){
      swal('Oops!', 'Provide transaction description', 'error');
      return false;
    }
    else{
          var route = "{{ URL('Ajax/monerisAPI') }}";
    var thisdata = {customerID: customerID, updateby: updateby, opportID: opportID, estimateID: estimateID, name: name, email: email, tot_amount: tot_amount, creditcard_no: creditcard_no, card_month: card_month, expirydate: expirydate, trans_description: trans_description};
    var spinner = $('.spinnerMoneris');

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
            // var res2 = JSON.parse(result.post_id);
              spinner.addClass('disp-0');
              $('#tot_amount').val('');
              $('#addedvat_amount').val('');
              $('#creditcard_no').val('');
              $('#card_month').val('');
              $('#expirydate').val('');
              $('#trans_description').val('');

              swal('Thanks!', result.res, result.message);

              setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 3000);
          }
          else{
              spinner.addClass('disp-0');
              swal('Oops', result.res, result.message);
          }

      }

    });
    }




  }

  function monerisPayinstore(){
    var customerID = $('#customerID').val();
    var station = $('#stationname').val();
    var paidto = $('#paidto').val();
    var estimateID = $('#estimateID').val();
    var paymentpurpose = $('#paymentpurpose').val();
    var name = $('#full_name').val();
    var email = $('#my_email').val();
    var tot_amount = $('#addedvat_amount').val();
    var creditcard_no = $('#creditcard_no').val();
    var card_month = $('#card_month').val();
    var expirydate = $('#expirydate').val();
    var trans_description = $('#trans_description').val();

    if(tot_amount == ""){
      swal('Oops!', 'Please provide amount for this transaction', 'error');
      return false;
    }
    else if(creditcard_no == ""){
      swal('Oops!', 'Card number is required to process payment', 'error');
      return false;
    }
    else if(card_month == ""){
      swal('Oops!', 'Select expiry month', 'error');
      return false;
    }
    else if(expirydate == ""){
      swal('Oops!', 'Select expiry year', 'error');
      return false;
    }
    else if(trans_description == ""){
      swal('Oops!', 'Provide transaction description', 'error');
      return false;
    }
    else{
          var route = "{{ URL('Ajax/monerisAPI') }}";
    var thisdata = {customerID: customerID, station: station, paidto: paidto, estimateID: estimateID, paymentpurpose: paymentpurpose, name: name, email: email, tot_amount: tot_amount, creditcard_no: creditcard_no, card_month: card_month, expirydate: expirydate, trans_description: trans_description};
    var spinner = $('.spinnerMonerisinstore');

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
            // var res2 = JSON.parse(result.post_id);
              spinner.addClass('disp-0');
              $('#tot_amount').val('');
              $('#addedvat_amount').val('');
              $('#creditcard_no').val('');
              $('#card_month').val('');
              $('#expirydate').val('');
              $('#trans_description').val('');

              swal('Thanks!', result.res, result.message);

              setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 3000);
          }
          else{
              spinner.addClass('disp-0');
              swal('Oops', result.res, result.message);
          }

      }

    });
    }




  }



  function jobDone(id, post_id, val, role){
    // alert(post_id);
    var route = "{{ URL('Ajax/Jobsdone') }}";
    var thisdata = {post_id: post_id, val: val, role: role};
    var spinner = $('.spinner'+val+'_'+id);

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
          if(result.message == "success" && result.action == "owners"){
              spinner.addClass('disp-0');
              swal('Thanks!', result.res, result.message);
              setTimeout(function(){ location.href = location.origin+'/Review/'+result.link; }, 3000);
          }
          else if(result.message == "success" && result.action == "mechanic"){
            spinner.addClass('disp-0');
              swal('Thanks!', result.res, result.message);
              setTimeout(function(){ location.href = result.link; }, 3000);
          }
          else{
              spinner.addClass('disp-0');
              swal('Oops', result.res, result.message);
          }

      }

    });


  }

  function reviewMechanic(){
    var ref_code = $('#refCode').val();
    var station_name = $('#station_name').val();
    var post_id = $('#post_id').val();
    var technician = $('#technician').val();
    var rating = $('#rating').val();
    var comment = $('#comment').val();

    var spinner = $('.spinnerReview');

    if(rating == ""){
      swal('Oops!', 'Please give a rating', 'warning');
      return false;
    }
    else if(comment == ""){
      swal('Oops!', 'Please give a comment', 'warning');
      return false;
    }
    else{
      var route = "{{ URL('Ajax/Reviewmechanic') }}";
      var thisdata = {ref_code: ref_code, station_name: station_name, post_id: post_id, technician: technician, rating: rating, comment: comment};

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
              spinner.addClass('disp-0');
              swal('Thanks!', result.res, result.message);
              setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 3000);
          }
          else{
              spinner.addClass('disp-0');
              swal('Oops', result.res, result.message);
          }

      }

    });
    }



  }

  // function proceedPay(estimate_id){

  // }

    $('button#proceedPay').magnificPopup({
  items: {
    src: '<div class="white-popup"><p class="text-center text-success" style="font-weight: bold;">Select Payment Gateway</p><br><div class="row"><div class="col-md-6"><a type="button" href="/paypalpay/'+$('#paymentPin').val()+'"><img src="https://www.freepnglogos.com/uploads/paypal-logo-png-3.png" style="width: auto; height: 100px"/></a><br><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/cotton/64/000000/money-transfer.png" style="width: 30px; height: 30px;">Other Countries</p></div><div class="col-md-6"><a type="button" href="/monerispay/'+$('#paymentPin').val()+'"><img src="https://logodix.com/logo/2028590.png" style="width: auto; height: 100px"/></a><p style="font-weight:bold; text-transform:uppercase; text-align:center"><img src="https://img.icons8.com/color/48/000000/canada-circular.png" style="width: 30px; height: 30px;">Canada & <img src="https://img.icons8.com/color/48/000000/usa-circular.png" style="width: 30px; height: 30px;"> US</p></div></div></div>',
      type: 'inline'
  },
  closeBtnInside: true
});


$('#newsletter-submit').click(function (){
  if($('#newsletter-form-email').val() == ""){
    swal('Oops!', 'Please provide a valid email', 'warning');
  }
  else{
    var route = "{{ URL('Ajax/subscribeNews') }}";
      var thisdata = {email: $('#newsletter-form-email').val()};
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
          if(result.message == "success"){
              spinner.addClass('disp-0');
              swal('Thanks!', result.res, result.message);
              $('#newsletter-form-email').val('');
          }
          else{
              spinner.addClass('disp-0');
              swal('Oops', result.res, result.message);
          }

      }

    });
  }
});



function triplogAction(action, licence){
  var route = "{{ URL('Ajax/apiTripLogaccount') }}";
  var thisdata = {action: action, licence: licence};
  var spinner = $('.spinnerclientcheck');

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
          if(result.message == "success" && result.action == "create_user"){
              spinner.addClass('disp-0');
              // Load data from API
              swal('Thanks!', result.res, result.message);
          }
          else{
              spinner.addClass('disp-0');
              swal('Oops', result.res, result.message);
          }

      }

    });

}


function confirmRequest(ref_code){
  $.sweetModal({
  title: 'Confirm Request',
  content: '<div class="row"><div class="col-md-6"><input type="hidden" value="'+ref_code+'" id="book_ref"><h4>Visit took place</h4><br><select class="form-control" id="visitation_info"><option value="">Select option</option><option value="Yes">Yes</option><option value="No">No</option></select></div><br><div class="col-md-6"><h4>Received Discount</h4><br><select class="form-control" id="receive_discount"><option value="">Select option</option><option value="Yes">Yes</option><option value="No">No</option></select></div></div><br><div class="row"><div class="col-md-6"><h4>Rate quality of service</h4><br><select class="form-control" id="quality_of_service"><option value="">Select option</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div><div class="col-md-6"><h4>&nbsp;</h4><br><button class="btn btn-danger btn-block" onclick="closeAppoint()">Close Appointment <img class="spinit disp-0" style="width: 30px; height: 30px; position:relative; margin: 0 auto;" src="https://www.desline.com/congress/laspalmas2020/img/loading.gif" /></button></div></div>'
});
}

function closeAppoint(){
  // Do Checks
  if($('#visitation_info').val() == ""){
    swal('Oops', 'Select option if visitation took place', 'info');
    return false;
  }
  else if($('#receive_discount').val() == ""){
    swal('Oops', 'Select option if received discount', 'info');
    return false;
  }
  else if($('#quality_of_service').val() == ""){
    swal('Oops', 'Select option to rate the quality of service', 'info');
    return false;
  }
  else{
    swal({
          title: "Are you sure you want to close appointment?",
          text: "If yes, click OK to close",
          icon: "warning",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var route = "{{ URL('Ajax/CloseAppoint') }}";
            var thisdata = {ref_code: $('#book_ref').val(), visitation_info: $('#visitation_info').val(), receive_discount: $('#receive_discount').val(), quality_of_service: $('#quality_of_service').val()};

            setHeaders();
                  jQuery.ajax({
                  url: route,
                  method: 'post',
                  data: thisdata,
                  dataType: 'JSON',
                  beforeSend: function(){
                    $('.spinit').removeClass('disp-0');
                  },
                  success: function(result){
                    $('.spinit').addClass('disp-0');

                    if(result.message == "success"){
                      swal('Good!', result.res, result.message);
                      // Do logout
                      setTimeout(function(){ location.href = result.link; }, 2000);
                    }
                    else{
                      $('.spinit').addClass('disp-0');
                      swal('Oops', result.res, result.message);
                    }


                }

              });
          }
        });
  }

}


function visittookPlace(ref_code){
    $.sweetModal({
  title: 'Confirm Visit took place',
  content: '<div class="row"><div class="col-md-6"><input type="hidden" value="'+ref_code+'" id="mybook_ref"><h4>Visit took place</h4><br><select class="form-control" id="visitation_tookinfo"><option value="">Select option</option><option value="Yes">Yes</option><option value="No">No</option></select></div><br><div class="col-md-6"><h4>Granted Discount</h4><br><select class="form-control" id="granted_discount"><option value="">Select option</option><option value="Yes">Yes</option><option value="No">No</option></select></div></div><br><div class="row"><div class="col-md-12"><h4>&nbsp;</h4><br><button class="btn btn-danger btn-block" onclick="acccloseAppoint()">Close Appointment <img class="spinit disp-0" style="width: 30px; height: 30px; position:relative; margin: 0 auto;" src="https://www.desline.com/congress/laspalmas2020/img/loading.gif" /></button></div></div>'
});
}

function acccloseAppoint(){
    // Do Checks
  if($('#visitation_tookinfo').val() == ""){
    swal('Oops', 'Select option if visitation took place', 'info');
    return false;
  }
  else if($('#granted_discount').val() == ""){
    swal('Oops', 'Select option if received discount', 'info');
    return false;
  }
  else{
    swal({
          title: "Are you sure you want to close appointment?",
          text: "If yes, click OK to close",
          icon: "warning",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var route = "{{ URL('Ajax/AccCloseAppoint') }}";
            var thisdata = {ref_code: $('#mybook_ref').val(), visitation_info: $('#visitation_tookinfo').val(), granted_discount: $('#granted_discount').val()};

            setHeaders();
                  jQuery.ajax({
                  url: route,
                  method: 'post',
                  data: thisdata,
                  dataType: 'JSON',
                  beforeSend: function(){
                    $('.spinit').removeClass('disp-0');
                  },
                  success: function(result){
                    $('.spinit').addClass('disp-0');

                    if(result.message == "success"){
                      swal('Good!', result.res, result.message);
                      // Do logout
                      setTimeout(function(){ location.href = result.link; }, 2000);
                    }
                    else{
                      $('.spinit').addClass('disp-0');
                      swal('Oops', result.res, result.message);
                    }


                }

              });
          }
        });
  }
}

function onlineChat(email, ref_code){
    swal('Hey', 'Feature coming soon!', 'info');
}

function genFeedback(ref_code){

// Do Sweet modal here
$.sweetModal({
    title: 'Feedback / Suggest a Feature',
    content: '<p>We appreciate the time you have taken to help us improve our site & service. Please use the form below to provide us your feedback.</p><br><div class="row"><input type="hidden" id="feedback_refcode" value="'+ref_code+'"><div class="col-md-12"><select class="form-control" id="feedback_subject" name="feedback_subject"><option value="">Select and Option</option><option value="Make a Suggestion">Make a Suggestion</option><option value="Report a Bug">Report a Bug</option><option value="Send a Compliment">Send a Compliment</option><option value="Make a Complaint">Make a Complaint</option></select></div></div><br><div class="row"><div class="col-md-12"><textarea class="form-control" style="height:100px;" id="feedback_description"></textarea></div></div><br><div class="row"><div class="col-md-6"><button class="btn btn-primary btn-block" onclick="submitFeedback()" id="feedback_submit">Submit</button></div><div class="col-md-6"><button class="btn btn-danger btn-block" onclick="closeFeedback()">Close</button></div></div>'
});

}

function submitFeedback(){
    if($('#feedback_subject').val() == ""){
        swal('Oops!', 'Please select an option', 'info');
        return false;
    }
    else if($('#feedback_description').val() == ""){
        swal('Oops', 'Please write us a message', 'info');
        return false;
    }
    else{
        var spinner = $('#feedback_submit');
        var route = "{{ URL('Ajax/Feedbacks') }}";
        var thisdata = {
            ref_code : $('#feedback_refcode').val(),
            subject : $('#feedback_subject').val(),
            description : $('#feedback_description').val()
        };

        setHeaders();
          jQuery.ajax({
          url: route,
          method: 'post',
          data: thisdata,
          dataType: 'JSON',
          beforeSend: function(){
            spinner.text('Sending Feedback...');
          },
          success: function(result){

            if(result.message == "success"){
                spinner.text('Submit');
                $('#feedback_subject').val('');
              $('#feedback_description').val('');
              swal('Good!', result.res, result.message);

            }
            else{
              spinner.text('Submit');
              swal('Oops', result.res, result.message);
            }


        }

      });

    }

}

function closeFeedback(){
    $('.sweet-modal-close-link').click();
}


function promoUser(val){
    if(val == "appointment"){
        swal({
          title: "Make a Request?",
          text: "We require you login/register to have access to dashboard. Thank you.",
          icon: "info",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            location.href = 'https://vimfile.com/userDashboard';
          }
        });
    }

    else if(val == "search"){
        $('.imgPromo').addClass('disp-0');
        $('.someSearch').removeClass('disp-0');
    }
}


function doSearch(){
    var route = "{{ URL('Ajax/otherSearch') }}";
    var thisdata = {auto_care: $('#search').val()};

    setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend: function(){
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
            if(result.message == "success"){
                $(".spinner").addClass('disp-0');
                swal("Saved!", result.res, result.message);
                // alert(result.res);
                  setTimeout(function(){ location.href = result.link; }, 1000);
            }
            else{
                $(".spinner").addClass('disp-0');
                swal("Oops!", result.res, result.message);
            }

        }

      });
}

function appointmentPromo(link){
    swal({
          title: "Make a Request?",
          text: "We require you login/register to have access to dashboard. Thank you.",
          icon: "info",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            location.href = 'https://vimfile.com/Search/'+link;
          }
        });
}


  function doTips(val){
    if(val == "request for estimate"){
      introJs().goToStepNumber(10).start();
    }
  }




function checkClaim(company, telephone, id){

    var formData = new FormData();

    var spinner = $('.spin'+id);
    var route = "{{ URL('Ajax/checkClaims') }}";

    formData.append("company", company);
    formData.append("telephone", telephone);


    doAjax(route, spinner, formData);

}



    function updateProfile(email){
        var formData = new FormData();
        var spinner = $('.spin');
        var route = "{{ URL('Ajax/updateme') }}";

            var size_of_employee = $('#size_of_employee').val();
            var station_name = $('#station_name').val();
            var station_address = $('#station_address').val();
            var country = $('#countryzee').val();
            var state = $('#statezee').val();
            var city = $('#city').val();
            var zipcode = $('#zipcode').val();
            var year_started_since = $('#year_started_since').val();
            var fullname = $('#fullname').val();
            var myemail = $('#email').val();
            var phone_number = $('#phone_number').val();
            var mobile = $('#mobile').val();
            var office = $('#office').val();
            var mechanical_skill = $('#mechanical_skill').val();
            var electrical_skill = $('#electrical_skill').val();
            var transmission_skill = $('#transmission_skill').val();
            var body_work_skill = $('#body_work_skill').val();
            var other_skills = $('#other_skills').val();
            var other_skills_specify = $('#specify_other_skill').val();
            var vimfile_discount = $('#vimfile_discount').val();
            var discountPercent = $('#discountPercent').val();
            var repair_guaranteed = $('#repair_guaranteed').val();
            var free_estimated = $('#free_estimated').val();
            var walk_in_specified = $('#walk_in_specified').val();
            var other_value_added = $('#other_value_added').val();
            var average_waiting = $('#average_waiting').val();
            var hours_of_operation = $('#hours_of_operation').val();
            var wifi = $('#wifi').val();
            var restroom = $('#restroom').val();
            var lounge = $('#lounge').val();
            var parking_space = $('#parking_space').val();
            var year_established = $('#year_established').val();
            var background = $('#background').val();
            var g_recaptcha_response = $('#g-recaptcha-response').val();

            if(size_of_employee == ""){
                swal('Oops', 'Please select employee size', 'info');
                return false;
            }
            else if(station_name == ""){
                swal('Oops', 'Please type your station name', 'info');
                return false;
            }
            else if(station_address == ""){
                swal('Oops', 'Please type your station address', 'info');
                return false;
            }

            else if(country == ""){
                swal('Oops', 'Please select country', 'info');
                return false;
            }
            else if(state == ""){
                swal('Oops', 'Please select state/province', 'info');
                return false;
            }
            else if(city == ""){
                swal('Oops', 'Please type your city', 'info');
                return false;
            }
            else if(zipcode == ""){
                swal('Oops', 'Please type your zip code', 'info');
                return false;
            }
            else if(year_started_since == ""){
                swal('Oops', 'Please select the date you started business', 'info');
                return false;
            }

            else if(fullname == ""){
                swal('Oops', 'Please type your fullname', 'info');
                return false;
            }
            else if(email == ""){
                swal('Oops', 'Please type your email', 'info');
                return false;
            }
            else if(phone_number == ""){
                swal('Oops', 'Please type your phone number', 'info');
                return false;
            }

            else if(mechanical_skill == ""){
                swal('Oops', 'Please select mechanical skill', 'info');
                return false;
            }
            else if(electrical_skill == ""){
                swal('Oops', 'Please select electrical skill', 'info');
                return false;
            }
            else if(transmission_skill == ""){
                swal('Oops', 'Please select transmission skill', 'info');
                return false;
            }
            else if(body_work_skill == ""){
                swal('Oops', 'Please select body work skill', 'info');
                return false;
            }
            else if(other_skills == ""){
                swal('Oops', 'Please type other skills. If none kindly type NILL', 'info');
                return false;
            }
            else if(vimfile_discount == ""){
                swal('Oops', 'Please select if you offer vimfile discount', 'info');
                return false;
            }
            else if(repair_guaranteed == ""){
                swal('Oops', 'Please select if you offer repair guarantee', 'info');
                return false;
            }
            else if(free_estimated == ""){
                swal('Oops', 'Please select if you offer free estimate', 'info');
                return false;
            }
            else if(walk_in_specified == ""){
                swal('Oops', 'Please select if you offer walks-in welcome', 'info');
                return false;
            }
            else if(other_value_added == ""){
                swal('Oops', 'Please type other value added. If none, kindly type NILL', 'info');
                return false;
            }
            else if(average_waiting == ""){
                swal('Oops', 'Please tell us your average waiting time', 'info');
                return false;
            }
            else if(hours_of_operation == ""){
                swal('Oops', 'Please tell us the hours you spend on operation', 'info');
                return false;
            }
            else if(wifi == ""){
                swal('Oops', 'Do you have wifi?', 'info');
                return false;
            }
            else if(restroom == ""){
                swal('Oops', 'DO you have a general neutral rest room?', 'info');
                return false;
            }
            else if(lounge == ""){
                swal('Oops', 'Do you have a loung?', 'info');
                return false;
            }
            else if(parking_space == ""){
                swal('Oops', 'Do you have a parking space?', 'info');
                return false;
            }

            else if(year_established == ""){
                swal('Oops', 'Please insert the year established', 'info');
                return false;
            }
            else if(g_recaptcha_response == ""){
                swal('Oops', 'Please verify that you are not a robot', 'info');
                return false;
            }

            else{
                formData.append("size_of_employee", size_of_employee);
                formData.append("station_name", station_name);
                formData.append("station_address", station_address);
                formData.append("country", country);
                formData.append("state", state);
                formData.append("city", city);
                formData.append("zipcode", zipcode);
                formData.append("mobile", mobile);
                formData.append("office", office);
                formData.append("year_started_since", year_started_since);
                formData.append("phone_number", phone_number);
                formData.append("mechanical_skill", mechanical_skill);
                formData.append("electrical_skill", electrical_skill);
                formData.append("transmission_skill", transmission_skill);
                formData.append("body_work_skill", body_work_skill);
                formData.append("other_skills", other_skills);
                formData.append("other_skills_specify", other_skills_specify);
                formData.append("vimfile_discount", vimfile_discount);
                formData.append("discountPercent", discountPercent);
                formData.append("repair_guaranteed", repair_guaranteed);
                formData.append("free_estimated", free_estimated);
                formData.append("walk_in_specified", walk_in_specified);
                formData.append("other_value_added", other_value_added);
                formData.append("average_waiting", average_waiting);
                formData.append("hours_of_operation", hours_of_operation);
                formData.append("wifi", wifi);
                formData.append("restroom", restroom);
                formData.append("lounge", lounge);
                formData.append("parking_space", parking_space);
                formData.append("fullname", fullname);
                formData.append("email", myemail);
                formData.append("year_established", year_established);
                formData.append("background", background);
            }


        doAjax(route, spinner, formData);
    }


    function doAjax(route, spinner, thisdata){
      $('tbody#vintable').html('');
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
                    $('tbody#vintable').html('<tr><td colspan="2" align="center"><img src="https://res.cloudinary.com/pilstech/image/upload/v1603447174/grey_style_zyxc4p.gif" alt="" style="width: 50px; height: 50px;"></td></tr>');
                },
                success: function(result){
                    if(result.message == "success"){

                      $('tbody#vintable').html('<tr><td colspan="2" align="center"><img src="https://res.cloudinary.com/pilstech/image/upload/v1603447174/grey_style_zyxc4p.gif" alt="" style="width: 50px; height: 50px;" class="disp-0"></td></tr>');

                      spinner.addClass('disp-0');
                        if(result.action == "stage1"){
                            // Display stage 2
                            $('.stage1').addClass('disp-0');
                            $('#stage2_busID').val(result.busID);
                            $('.stage2').removeClass('disp-0');
                        }

                        else if(result.action == "stage2"){
                            $('.stage2').addClass('disp-0');
                            $('#stage3_busID').val(result.busID);
                            $('.stage3').removeClass('disp-0');
                        }

                        else if(result.action == "stage3"){
                            swal(result.title, result.res, result.message);
                            setTimeout(function(){ location.href = location.origin+"/login"; }, 3000);
                        }

                        else if(result.action == "update"){

                          if(result.userType == "Auto Dealer"){
                            swal(result.title, result.res, result.message);
                            setTimeout(function(){ location.href='https://autodealer.vimfile.com'; }, 3000);
                          }
                          else{
                            swal(result.title, result.res, result.message);
                            setTimeout(function(){ location.reload(); }, 3000);
                          }

                            
                        }
                        else if(result.action == "claim"){
                            swal(result.title, result.res, result.message);
                            setTimeout(function(){ location.href = location.origin+"/profileupdate/"+result.link; }, 3000);
                        }
                        else if(result.action == "appointment"){
                          var res = JSON.parse(result.data);
                            appointPop(res[0].subject, res[0].current_mileage, res[0].ref_code);
                        }
                        else if(result.action == "vinlookup"){
                          var res = JSON.parse(result.data);

                          $.each(res.decode, function(v,k){
                              $('tbody#vintable').append('<tr><td>'+k.label+'</td><td>'+k.value+'</td></tr>');
                          });

                        }
                        else{
                            spinner.addClass('disp-0');
                            swal(result.title, result.res, result.message);
                            $('tbody#vintable').html('<tr><td colspan="2" align="center"><img src="https://res.cloudinary.com/pilstech/image/upload/v1603447174/grey_style_zyxc4p.gif" alt="" style="width: 50px; height: 50px;" class="disp-0"></td></tr>');
                        }
                    }
                    else{
                        spinner.addClass('disp-0');
                        swal(result.title, result.res, result.message);
                        $('tbody#vintable').html('<tr><td colspan="2" align="center"><img src="https://res.cloudinary.com/pilstech/image/upload/v1603447174/grey_style_zyxc4p.gif" alt="" style="width: 50px; height: 50px;" class="disp-0"></td></tr>');
                    }
                }
            });
    };



function showreplyBox(id){
    $('.review_reply'+id).removeClass('disp-0');
    $('.replymessage'+id).addClass('disp-0');
}

function hideReply(id){
  $('.review_reply'+id).addClass('disp-0');
    $('.replymessage'+id).removeClass('disp-0');
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




function phoneAppointment(email, ref_code) {

  // Run Ajax for record

  var formData = new FormData();

  var spinner = $('.phoneappointspin'+ref_code);
  var route = "{{ URL('Ajax/checkappointment') }}";

  formData.append("email", email);
  formData.append("ref_code", ref_code);


  doAjax(route, spinner, formData);


    
}


  function lookupVin(){

    var formData = new FormData();

      var spinner = $('.spinnerlookup');
      var route = "{{ URL('Ajax/vinlookup') }}";

    if($('#lookupnumber').val() == ""){
      swal('Oops!', 'Please provide a valid VIN number', 'error');
    }
    else{

      formData.append("id", 'decode');
      formData.append("vin", $('#lookupnumber').val());

      doAjax(route, spinner, formData);
    }

    

  }


function appointPop(subject, current_mileage, ref_code){
  $.sweetModal({
            title: "Phone Appointment",
            content: '<form action="{{ route("phoneappointment") }}" method="post">@csrf<div class="row"><div class="col-md-12"><label for="subject">Subject</label><input type="hidden" name="ref_code" value="'+ref_code+'" class="form-control"><input type="text" name="subject" value="'+subject+'" class="form-control"></div><br><br><div class="col-md-12"><label for="date_of_visit">Date to Call</label><input type="date" name="date_of_visit" id="date_of_visit" class="form-control"></div><br><br><div class="col-md-12"><label for="service_option">Service Option</label><select name="service_option" id="service_option" class="form-control"><option value="Major Repair">Major Repair</option><option value="Minor Repair">Minor Repair</option><option value="Scheduled Maintenance">Scheduled Maintenance</option><option value="Emergency Maintenance">Emergency Maintenance</option></select></div><br><br><div class="col-md-12"><label for="my_service_type">Service Type</label><select name="my_service_type" id="my_service_type" class="form-control"><option value="Service" selected="selected" disabled="disabled">Service</option><optgroup label="Admin"><option value="inspection">inspection</option><option value="registration">registration</option><option value="insurance">insurance</option><option value="road assistance">road assistance</option><option value="business taxes">business taxes</option><option value="Road Fines">Road Fines</option><option value="Ticket">Ticket</option></optgroup><optgroup label="Fuel"><option value="fuel">fuel</option><option value="car wash">car wash</option></optgroup><optgroup label="Maintenance"><option value="air conditioning recharge">air conditioning recharge</option><option value="air filter">air filter</option><option value="battery">battery</option><option value="brake fluid flush">brake fluid flush</option><option value="brake pads">brake pads</option><option value="brake rotors">brake rotors</option><option value="coolant flush">coolant flush</option><option value="distributor cap &amp; rotor">distributor cap &amp; rotor</option><option value="fuel filter">fuel filter</option><option value="headlight">headlight</option><option value="oil change">oil change</option><option value="power steering flush">power steering flush</option><option value="spark plugs">spark plugs</option><option value="timing belt">timing belt</option><option value="tire - new">tire - new</option><option value="tire balancing">tire balancing</option><option value="tire inflation">tire inflation</option><option value="tire rotation">tire rotation</option><option value="wheel rotation and tire balancing">Wheel Rotation & Tire Balancing</option><option value="transmission fluid flush">transmission fluid flush</option><option value="wheel alignment">wheel alignment</option><option value="wiper blades">wiper blades</option><option value="other">other</option><option value="cabin air filter">cabin air filter</option><option value="smog check">smog check</option></optgroup><optgroup label="Repairs"><option value="alternator">alternator</option><option value="belt">belt</option><option value="body work">body work</option><option value="brake caliper">brake caliper</option><option value="carburetor">carburetor</option><option value="catalytic converter">catalytic converter</option><option value="clutch">clutch</option><option value="control arm">control arm</option><option value="coolant temperature sensor">coolant temperature sensor</option><option value="exhaust">exhaust</option><option value="fuel injector">fuel injector</option><option value="fuel tank">fuel tank</option><option value="head gasket">head gasket</option><option value="heater core">heater core</option><option value="hose">hose</option><option value="line">line</option><option value="mass air flow sensor">mass air flow sensor</option><option value="muffler">muffler</option><option value="oxygen sensor">oxygen sensor</option><option value="radiator">radiator</option><option value="shock/strut">shock/strut</option><option value="starter">starter</option><option value="thermostat">thermostat</option><option value="tie rod">tie rod</option><option value="transmission">transmission</option><option value="water pump">water pump</option><option value="wheel bearings">wheel bearings</option><option value="window">window</option><option value="windshield">windshield</option><option value="road side assistance">road side assistance</option><option value="other">other</option><option value="sensor">sensor</option></optgroup></select></div><br><br><div class="col-md-12"><label for="current_mileage">Current Mileage</label><input type="text" name="current_mileage" id="my_current_mileage" class="form-control" value="'+current_mileage+'"></div><br><br><div class="col-md-12"><label for="my_message">Appointment Discussion</label><textarea class="form-control" name="my_message" id="my_message" placeholder="Enter Message" style="height: 150px; resize: none;"></textarea></div><br><br><div class="col-md-12"><button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button></div></div></form>',
            blocking: true
        });
}



function userGuide(val){

  $('.close').click();

  $('.mamangeinventory').removeClass('active');
  $('.createvendor').removeClass('active');
  $('.createcategory').removeClass('active');
  $('.createinventory').removeClass('active');
  $('.managelabour').removeClass('active');
  $('.createlabourcategory').removeClass('active');
  $('.createlabourrecord').removeClass('active');
  $('.addlabour').removeClass('active');
  $('.vehiclemaintenance').removeClass('active');

  if(val == 'shopmanagement'){
    $("#recordmaintenance-tab").click();
  }
  if(val == 'mamangeinventory'){
    $("#recordmaintenance-tab").click();
    $("#manageinventory-tab").click();
    $('.mamangeinventory').addClass('active');
  }
  if(val == 'createvendor'){
    $("#recordmaintenance-tab").click();
    $("#manageinventory-tab").click();
    $("#createvendor-tab").click();
    $('.createvendor').addClass('active');
  }
  if(val == 'createcategory'){
    $("#recordmaintenance-tab").click();
    $("#manageinventory-tab").click();
    $("#createcategory-tab").click();
    $('.createcategory').addClass('active');
  }
  if(val == 'createinventory'){
    $("#recordmaintenance-tab").click();
    $("#manageinventory-tab").click();
    $("#createinventoryitem-tab").click();
    $('.createinventory').addClass('active');
  }
  if(val == 'managelabour'){
    $("#recordmaintenance-tab").click();
    $("#labourschedule-tab").click();
    $('.managelabour').addClass('active');
  }
  if(val == 'createlabourcategory'){
    $("#recordmaintenance-tab").click();
    $("#labourschedule-tab").click();
    $("#createlabourcategory-tab").click();
    $('.createlabourcategory').addClass('active');
  }
  if(val == 'createlabourrecord'){
    $("#recordmaintenance-tab").click();
    $("#labourschedule-tab").click();
    $("#createlabourrecord-tab").click();
    $('.createlabourrecord').addClass('active');
  }
  if(val == 'addlabour'){
    $("#recordmaintenance-tab").click();
    $("#labourschedule-tab").click();
    $("#addlabour-tab").click();
    $('.addlabour').addClass('active');
  }
  if(val == 'vehiclemaintenance'){
    $("#recordmaintenance-tab").click();
    $("#maintenance-tab").click();
    $("#estimateprep-tab").click();
    $('.vehiclemaintenance').addClass('active');
  }


}


$('#recordmaintenance-tab').click(function(){
  if(this){
    $('.sms').removeClass('disp-0');
  }
})

$('#home-tab').click(function(){
  if(this){
    $('.sms').addClass('disp-0');
  }
})
$('#myreviews-tab').click(function(){
  if(this){
    $('.sms').addClass('disp-0');
  }
})

$('#appointmentonphone-tab').click(function(){
  if(this){
    $('.sms').addClass('disp-0');
  }
})

$('#vinlookup-tab').click(function(){
  if(this){
    $('.sms').addClass('disp-0');
  }
})


</script>








<script type="text/javascript">

  (function() {
    var capterra_vkey = 'e8ddd47edac9d603027984a5028e9a17',
    capterra_vid = '2152991',
    capterra_prefix = (('https:' == document.location.protocol)
      ? 'https://ct.capterra.com' : 'http://ct.capterra.com');
    var ct = document.createElement('script');
    ct.type = 'text/javascript';
    ct.async = true;
    ct.src = capterra_prefix + '/capterra_tracker.js?vid='
      + capterra_vid + '&vkey=' + capterra_vkey;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ct, s);
  })();
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f5fad6b4704467e89eee058/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>

</html>

