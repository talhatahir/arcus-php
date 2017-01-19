<script type="text/javascript">
    $.ajax({
            url: "<?php echo base_url(); ?>index.php/Users/getAllRoomsAvailableToday",
            type: "get", // To protect sensitive data
            success:function(response){
              $("#resAjaxResp").html(response);
            // Handle the response object
            }
        });
</script>

<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">
        <div class="col-md-6 ">
          <div class="jumbotron" style="padding:4%;">
            <h3>Welcome <?php if($this->session->userdata('role')=='0'){ echo "Admin";}else{echo "Accountant";} ?></h3>
            <p style="font-size:14px;">The Arcus Hotel management system gives full features like adding new Guest information, you can add all the expenses the guest made during their stay at the hotel and access them any time later.</p>
            <p style="font-size:14px;">Click any of the below action buttons to access that feature.</p>
            <p style="font-size:14px;">
              <a class="btn btn-default btn-danger" href="../../components/#navbar" role="button">View policy Info &raquo;</a>
            </p>
          </div>
        </div>

         <div class="col-md-3 col-md-offset-3" style="margin-top:30px;" id="resAjaxResp">
          
         </div>
      </div>
      <br/>
      <br/>

      <div class="row">
      	<div class="col-md-3">
			<button type="button" id="addguest-button" class="btn btn-success btn-default btn-block">Add New Guest</button>
      	</div>
      	<div class="col-md-3">
			<button type="button" id="search-button"class="btn btn-success btn-default btn-block">Search Guest Info</button>
      	</div>
      	<div class="col-md-3">
			<button type="button" id="accounts-button" class="btn btn-success btn-default btn-block">View Accounts</button>
      	</div>
         <div class="col-md-3">
      <button type="button" id="roomday-button" class="btn btn-success btn-default btn-block">View Rooms</button>
        </div>
      </div>
      <br/>
      <div class="row">
       
      	
      </div>

    </div> <!-- /container -->
 