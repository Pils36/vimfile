<!-- Button trigger modal -->
<button type="button" class="btn btn-primary disp-0" data-toggle="modal" data-target="#exampleModalCenter" id="claimbusiness_info">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Claim Business NOW!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Claiming your business is the fastest way to get more traffic to your <strong>AUTO REPAIR SHOP</strong>.</h4>
                
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <center><button class="btn btn-primary btn-block" onclick="location.href='{{ route('claimbusiness') }}'">Click here to claim your business</button></center>
      </div>
    </div>
  </div>
</div>