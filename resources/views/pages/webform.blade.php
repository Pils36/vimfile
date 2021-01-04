@extends('layouts.app')

@section('text/css')

<style>
    html,body{
        margin: 0px;
    }
    #crmWebToEntityForm.zcwf_lblLeft {
        width:100%;
        padding: 25px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    #crmWebToEntityForm.zcwf_lblLeft * {
        box-sizing: border-box;
    }
    #crmWebToEntityForm{text-align: left;}
    #crmWebToEntityForm * {
        direction: ltr;
    }
    .zcwf_lblLeft .zcwf_title {
        word-wrap: break-word;
        padding: 0px 6px 10px;
        font-weight: bold;
    }
    .zcwf_lblLeft .zcwf_col_fld input[type=text], .zcwf_lblLeft .zcwf_col_fld textarea {
        width: 60%;
        border: 1px solid #ccc;
        resize: vertical;
        border-radius: 2px;
        float: left;
    }
    .zcwf_lblLeft .zcwf_col_lab {
        width: 30%;
        word-break: break-word;
        padding: 0px 6px 0px;
        margin-right: 10px;
        margin-top: 5px;
        float: left;
        min-height: 1px;
    }
    .zcwf_lblLeft .zcwf_col_fld {
        float: left;
        width: 68%;
        padding: 0px 6px 0px;
        position: relative;
        margin-top: 5px;
    }
    .zcwf_lblLeft .zcwf_privacy{padding: 6px;}
    .zcwf_lblLeft .wfrm_fld_dpNn{display: none;}
    .dIB{display: inline-block;}
    .zcwf_lblLeft .zcwf_col_fld_slt {
        width: 60%;
        border: 1px solid #ccc;
        background: #fff;
        border-radius: 4px;
        font-size: 12px;
        float: left;
        resize: vertical;
    }
    .zcwf_lblLeft .zcwf_row:after, .zcwf_lblLeft .zcwf_col_fld:after {
        content: '';
        display: table;
        clear: both;
    }
    .zcwf_lblLeft .zcwf_col_help {
        float: left;
        margin-left: 7px;
        font-size: 12px;
        max-width: 35%;
        word-break: break-word;
    }
    .zcwf_lblLeft .zcwf_help_icon {
        cursor: pointer;
        width: 16px;
        height: 16px;
        display: inline-block;
        background: #fff;
        border: 1px solid #ccc;
        color: #ccc;
        text-align: center;
        font-size: 11px;
        line-height: 16px;
        font-weight: bold;
        border-radius: 50%;
    }
    .zcwf_lblLeft .zcwf_row {margin: 15px 0px;}
    .zcwf_lblLeft .formsubmit {
        margin-right: 5px;
        cursor: pointer;
        color: #333;
        font-size: 12px;
    }
    .zcwf_lblLeft .zcwf_privacy_txt {
        color: rgb(0, 0, 0);
        font-size: 12px;
        font-family: Arial;
        display: inline-block;
        vertical-align: top;
        color: #333;
        padding-top: 2px;
        margin-left: 6px;
    }
    .zcwf_lblLeft .zcwf_button {
        font-size: 12px;
        color: #333;
        border: 1px solid #ccc;
        padding: 3px 9px;
        border-radius: 4px;
        cursor: pointer;
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .zcwf_lblLeft .zcwf_tooltip_over{
        position: relative;
    }
    .zcwf_lblLeft .zcwf_tooltip_ctn{
        position: absolute;
        background: #dedede;
        padding: 3px 6px;
        top: 3px;
        border-radius: 4px;word-break: break-all;
        min-width: 50px;
        max-width: 150px;
        color: #333;
    }
    .zcwf_lblLeft .zcwf_ckbox{
        float: left;
    }
    .zcwf_lblLeft .zcwf_file{
        width: 55%;
        box-sizing: border-box;
        float: left;
    }
    .clearB:after{
        content:'';
        display: block;
        clear: both;
    }
    @media all and (max-width: 600px) {
        .zcwf_lblLeft .zcwf_col_lab, .zcwf_lblLeft .zcwf_col_fld {
            width: auto;
            float: none !important;
        }
        .zcwf_lblLeft .zcwf_col_help {width: 40%;}
    }
    </style>

@show

@section('content')

  <!-- breadcrumb start-->
  <section class="breadcrumb banner_part">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2>Contact Form</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!-- ================ contact section start ================= -->


  <section class="contact-section section_padding">
    <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11540.856121918176!2d-79.76125808993915!3d43.68531360041938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b1597c120173b%3A0x8c0309afa99d74d2!2s10+George+St+N%2C+Brampton%2C+ON+L6X+1R2%2C+Canada!5e0!3m2!1sen!2sng!4v1566552642826!5m2!1sen!2sng" width="1000" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
    
          </div>


      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">{{ $pages }}</h2>
        </div>
        
<div id='crmWebToEntityForm' class='zcwf_lblLeft crmWebToEntityForm'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
     <form action='https://crm.zoho.com/crm/WebToLeadForm' name=WebToLeads4652213000000350007 method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory4652213000000350007()' accept-charset='UTF-8'>
   <input type='text' style='display:none;' name='xnQsjsdp' value='864119e6153f8df15be4a7ba6d803c516c09cd02e6ba7855d5243687ce542d7a'></input> 
   <input type='hidden' name='zc_gad' id='zc_gad' value=''></input> 
   <input type='text' style='display:none;' name='xmIwtLD' value='726de412b071bfe63dde08e2b0ee2ddd1f1d920dfc31322814366cbb870d1307'></input> 
   <input type='text'  style='display:none;' name='actionType' value='TGVhZHM='></input>
   <input type='text' style='display:none;' name='returnURL' value='https://vimfile.com/login' > </input>
       <!-- Do not remove this code. -->

       <div class="row">
           <div class="col-md-2">
            <label for='Company'>Company<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='Company' name='Company' maxlength='100' class="form-control" required></input>
           </div>
       </div>
<br>
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>City<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='City' name='City' maxlength='100' class="form-control" required></input>
           </div>
       </div>
       
       <br>
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>State<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='State' name='State' maxlength='100' class="form-control" required></input>
           </div>
       </div>
       <br>
       
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>Zip Code<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='Zip_Code' name='Zip Code' maxlength='30' class="form-control" required></input>
           </div>
       </div>
       <br>
       
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>Country<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='Country' name='Country' maxlength='100' class="form-control" required></input>
           </div>
       </div>
       <br>
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>First Name<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='First_Name' name='First Name' maxlength='40' class="form-control" required></input>
           </div>
       </div>
       
       <br>
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>Last Name<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='Last_Name' name='Last Name' maxlength='80' class="form-control" required></input>
           </div>
       </div>
       <br>
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>Email<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' ftype='email' id='Email' name='Email' maxlength='100' class="form-control" required></input>
           </div>
       </div>
       
       <br>
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>Phone<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <input type='text' id='Phone' name='Phone' maxlength='30' class="form-control" required></input>
           </div>
       </div>
       <br>
       <div class="row">
           <div class="col-md-2">
            <label for='Company'>Description<span style='color:red;'>*</span></label>
           </div>
           <div class="col-md-4">
            <textarea id='Description' name='Description' class="form-control" required></textarea>
           </div>
       </div>
       <br>
       <div class="row">
           <div class="col-md-2">
            &nbsp;
           </div>
           <div class="col-md-2">
            <input type='submit' id='formsubmit' value='Submit' title='Submit' class="btn btn-primary btn-block">
            
           </div>
           <div class="col-md-2">
            <input type='reset' name='reset' value='Reset' title='Reset' class="btn btn-danger btn-block">
            
           </div>
       </div>



      <script>
         var mndFileds=new Array('Company','Last Name','Email','Country','Description');
         var fldLangVal=new Array('Company','Last Name','Email','Country','Description'); 
          var name='';
          var email='';
      function validateEmail()
      {
          var emailFld = document.querySelectorAll('[ftype=email]');
          var i;
          for (i = 0; i < emailFld.length; i++)
          {
              var emailVal = emailFld[i].value;
              if((emailVal.replace(/^\s+|\s+$/g, '')).length!=0 )
              {
                  var atpos=emailVal.indexOf('@');
                  var dotpos=emailVal.lastIndexOf('.');
                  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailVal.length)
                  {
                      alert('Please enter a valid email address. ');
                      emailFld[i].focus();
                      return false;
                  }
              }
          }
          return true;
      }
  
         function checkMandatory4652213000000350007() {
          for(i=0;i<mndFileds.length;i++) {
            var fieldObj=document.forms['WebToLeads4652213000000350007'][mndFileds[i]];
            if(fieldObj) {
              if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
               if(fieldObj.type =='file')
                  { 
                   alert('Please select a file to upload.'); 
                   fieldObj.focus(); 
                   return false;
                  } 
              alert(fldLangVal[i] +' cannot be empty.'); 
                        fieldObj.focus();
                        return false;
              }  else if(fieldObj.nodeName=='SELECT') {
                       if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
                  alert(fldLangVal[i] +' cannot be none.'); 
                  fieldObj.focus();
                  return false;
                 }
              } else if(fieldObj.type =='checkbox'){
                  if(fieldObj.checked == false){
                  alert('Please accept  '+fldLangVal[i]);
                  fieldObj.focus();
                  return false;
                 } 
               } 
               try {
                   if(fieldObj.name == 'Last Name') {
                  name = fieldObj.value;
                     }
              } catch (e) {}
              }
          }
          if(!validateEmail()){return false;}
          document.querySelector('.crmWebToEntityForm .formsubmit').setAttribute('disabled', true);
      }
  
  function tooltipShow(el){
      var tooltip = el.nextElementSibling;
      var tooltipDisplay = tooltip.style.display;
      if(tooltipDisplay == 'none'){
          var allTooltip = document.getElementsByClassName('zcwf_tooltip_over');
          for(i=0; i<allTooltip.length; i++){
              allTooltip[i].style.display='none';
          }
          tooltip.style.display = 'block';
      }else{
          tooltip.style.display='none';
      }
  }
  </script>
      <!-- Do not remove this --- Analytics Tracking code starts --><script id='wf_anal' src='https://crm.zohopublic.com/crm/WebFormAnalyticsServeServlet?rid=726de412b071bfe63dde08e2b0ee2ddd1f1d920dfc31322814366cbb870d1307gid864119e6153f8df15be4a7ba6d803c516c09cd02e6ba7855d5243687ce542d7agid885e3c1045bd9bdcc91bdf30f82b5696gid14f4ec16431e0686150daa43f3210513'></script><!-- Do not remove this --- Analytics Tracking code ends. -->
  
  </form>
  </div>
  
  
  
  
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->


  


@endsection