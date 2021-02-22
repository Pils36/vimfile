<style>
    .white-box{
        -webkit-box-shadow: 0px 0px 7px 1px rgba(158,158,158,1);
-moz-box-shadow: 0px 0px 7px 1px rgba(158,158,158,1);
box-shadow: 0px 0px 7px 1px rgba(158,158,158,1);

padding: 15px;
border-radius: 10px; 
    }

    .white-box > .row .col-md-10 > p{
        font-weight: bold;
        margin-top: 10px; 
    }
    .white-box > .row .col-md-2 > p img{
        margin-top: 15px;
        width: 20px; height: 20px;
    }

    .user-guide{
        color: blue;
        text-decoration: underline;
    }
    .user-guide.active{
        color: darkorange;
        text-decoration: underline;
    }

</style>





<div class="col-md-4 pull-left sms disp-0">

    {{-- Guide Here --}}

    <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Manage Inventory
              </button>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class="white-box manageinventory">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="font-weight: bold;"><b>Shop management quick start guide</b></p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-2">
                            &nbsp;
                        </div>
                        <div class="col-md-10">
                            <p>Set up Inventory</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 1: <a href="javascript:void()" onclick="userGuide('mamangeinventory')" class="user-guide mamangeinventory">Click on manage inventory</a></p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 2: <a href="javascript:void()" onclick="userGuide('createvendor')" class="user-guide createvendor">Create a vendor</a></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 3: <a href="javascript:void()" onclick="userGuide('createcategory')" class="user-guide createcategory">On successful creation of vendor, create category</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 4: <a href="javascript:void()" onclick="userGuide('createinventory')" class="user-guide createinventory">On successful creation of category, create inventory</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 5: <a href="javascript:void()" onclick="userGuide('managelabour')" class="user-guide managelabour">Great!!, You can now set up Labour</a></p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Manage Labour
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <div class="white-box managelabour">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="font-weight: bold;"><b>Shop management quick start guide</b></p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-2">
                            &nbsp;
                        </div>
                        <div class="col-md-10">
                            <p>Set up Labour</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 1: <a href="javascript:void()" onclick="userGuide('managelabour')" class="user-guide managelabour">Click on manage labour</a></p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 2: <a href="javascript:void()" onclick="userGuide('createlabourcategory')" class="user-guide createlabourcategory">Create a labour category</a></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 3: <a href="javascript:void()" onclick="userGuide('createlabourrecord')" class="user-guide createlabourrecord">On successfull creation of labour category, create labour record</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 4: <a href="javascript:void()" onclick="userGuide('addlabour')" class="user-guide addlabour">On successfull creation of labour record,Click on Add Labour</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <p><img src="https://img.icons8.com/color/25/000000/info--v1.png"/></p>
                        </div>
                        <div class="col-md-10">
                            <p>Step 5: <a href="javascript:void()" onclick="userGuide('vehiclemaintenance')" class="user-guide vehiclemaintenance">Great!!, You can now prepare estimate and work order</a></p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>

      </div>





</div>