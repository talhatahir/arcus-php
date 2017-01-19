
 <!-- Fixed navbar -->
 <script type="text/javascript">
 $(document).ready(function(){
  var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd}
    if(mm<10){mm='0'+mm}

    var today = yyyy+'-'+mm+'-'+dd;
    $("#curr").val(today);

  });

 </script>



<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron" style="background-color:transparent;">
        <h1>Guest Information</h1>
        <p>View guest information and account information of the guest below.</p>
      </div>
<hr/>
<?php
$guest_result= $guest_result[0];
$guest_rooms=$guest_room_time;
$guest_room_time= $guest_room_time[0]; 

?>
      <div class="container">
          <div class="row">          
            <div class="col-xs-5 profile">
              <label for="guest-name">Guest Name</label>
              <div id="guest-name"><?php echo $guest_result['guest_name']  ?></div>
            </div>
            <div class="col-xs-3 profile">
            	<label for="city-name">City</label>
              <div id="city-name"><?php echo $guest_result['guest_city'] ?>  </div>
            </div>
            <div class="col-xs-4 profile">
            	<label for="cnic-no">CNIC No</label>
              <div id="cnic-no"><?php echo $guest_result['guest_cnic'] ?></div>
            </div>


            <div class="col-xs-9 profile">
            	<label for="address-no">Address</label>
              <div id="address-no"><?php echo $guest_result['guest_address'] ?></div>
            </div>
            <div class="col-xs-3 profile">
            	<label for="phone-no">Phone No</label>
              <div id="phone-no"><?php echo $guest_result['guest_phone'] ?></div>
            </div>

            <div class="col-xs-8 profile">
            	<label for="visit-purpose">Visit Purpose</label>
              <div id="visit-purpose"><?php echo $guest_result['guest_purpose'] ?></div>
            </div>
            <div class="col-xs-4 profile">
            	<label for="company-name">Company</label>
              <div id="company-name"><?php echo $guest_result['guest_company'] ?></div>
            </div>

            <div class="col-xs-4 profile">
            	<label for="country-name">Country</label>
              <div id="country-name"><?php echo $guest_result['guest_country'] ?></div>
            </div>

            <div class="col-xs-5 profile">
            	<label for="personal-info">Personal Info</label>
              <div id="personal-info"><?php if(!empty($guest_result['guest_info'])){ echo $guest_result['guest_info']; }else{echo "<p class='text-danger'>No data found</p>";} ?></div>
            </div>

 			      <div class="col-xs-2 profile">
            	<label for="arrival-date">Arrival Date</label>
              <div id="arrival-date"><?php if(!empty($guest_room_time['arrival_time'])){ echo $guest_room_time['arrival_time']; }else{echo "<p class='text-danger'>No data found</p>";} ?></div>
            </div>


          </div>

         

          <div class="row">
            

            <div class="col-xs-5 profile">
              <label for="dept-date">Departure date</label>
              <div id="dept-date" name="dept-date"><?php if(!empty($guest_room_time['dept_time'])){ echo $guest_room_time['dept_time']; }else{echo "<p class='text-danger'>No data found</p>";} ?></div>
            </div>

            <div class="col-xs-4 profile">
              <label for="room-no">Room No</label>
             <div id="room-no">
            <?php 
            
            if($guest_rooms!="no_result"){ 
                 foreach ($guest_rooms as $value) {
                  echo $value['guest_room']."&nbsp;&nbsp;";
                  }?>

             <?php  }else{
               echo "<p class='text-danger'>No data found</p>";} ?>
           </div>             
            </div>
            
          </div>

         <div class="row">
         	<div class="col-xs-2">
				    <button type="button" id="expense-button" class="btn btn-warning btn-block">Add Expense</button>
			    </div>
          <div class="col-xs-2">
            <button type="button" id="roomtime-button" class="btn btn-primary btn-block">Update Room</button>
          </div>
          <div class="col-xs-2">
            <button type="button" id="guestinfo-button" class="btn btn-success btn-block">Update Guest Info</button>
          </div>
		     </div>

		 	<br/>

		 	

          <div class="row bg-info" id="add-expense" style="display:none;">
          	<br/>
            <form role="form" action="<?php echo site_url();?>/users/insertguest_account" method="post">
          	 <input type="hidden" name="guest_id" value="<?php echo $guest_result['guest_id']  ?>">
             <input type="hidden" name="curr" id="curr" value="">
			  <div class="col-xs-5">
             <input id="remarks" name="remarks" type="text" placeholder="Remarks" class="form-control" required> 
            </div>

			 <div class="col-xs-2">
             <select class="form-control" id="amount" name="amount" required>
              <option>Credit</option>
              <option>Debit</option>
              </select> 
            </div>
            <div class="col-xs-2">
             <input id="price" name="price" type="number" placeholder="Amount" class="form-control" min="0"  required> 
            </div>
            <div class="col-xs-2">
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          
         
        	</form>
          </div>
          <hr/>
		


        <div class="modal fade bs-example-modal-lg" id="room-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width: 600px; height: 460px; overflow: hidden;">
            <div class="modal-content" style="top:-55px;">
              <iframe style="width:100%; height:700px;" src="<?php echo site_url();?>/users/roomday?guest_id=<?php echo $guest_result['guest_id']?>&popup=1"></iframe>
            </div>
          </div>
        </div>


        <div class="modal fade bs-example-modal-lg" id="updateguestinfo-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width: 700px; height: 460px; overflow: hidden;">
            <div class="modal-content" style="top:-55px;">
                <div class="container col-xs-10">

                      <!-- Main component for a primary marketing message or call to action -->
                      <div class="jumbotron">
                        <h3>Update Guest Information</h3>
                        <br/>
                        <form role="form" action="<?php echo site_url();?>/users/updateguestinfo" method="post">
                          
                          <div class="row">   
                              
                            <div class="col-xs-4">
                              <input id="up-guest-name" name="up-guest-name" type="text" placeholder="Guest name" class="form-control"  value="<?php echo $guest_result['guest_name']  ?>" required autofocus> 
                            </div>
                            <div class="col-xs-4">
                              <input id="up-city-name" name="up-city-name" type="text" placeholder="City name" class="form-control" value="<?php echo $guest_result['guest_city']  ?>" required> 
                            </div>
                            <div class="col-xs-4">
                             <input id="up-cnic-no" name="up-cnic-no" type="text" placeholder="CNIC" class="form-control" value="<?php echo $guest_result['guest_cnic']  ?>" required> 
                            </div>


                            <div class="col-xs-8">
                             <input id="up-address-no" name="up-address-no" type="text" placeholder="Address" class="form-control" value="<?php echo $guest_result['guest_address']  ?>" required> 
                            </div>
                            <div class="col-xs-4">
                             <input id="up-phone-no" name="up-phone-no" type="text" placeholder="Phone No" class="form-control" value="<?php echo $guest_result['guest_phone']  ?>" required> 
                            </div>

                            <div class="col-xs-6">
                             <input id="up-visit-purpose" name="up-visit-purpose" type="text" placeholder="Purpose of visit" class="form-control" value="<?php echo $guest_result['guest_purpose']  ?>" > 
                            </div>
                            <div class="col-xs-6">
                             <input id="up-company-name" name="up-company-name" type="text" placeholder="Company name" class="form-control" value="<?php echo $guest_result['guest_company']  ?>"> 
                            </div>

                            <div class="col-xs-6">
                             <input id="up-country-name" name="up-country-name" type="text" placeholder="Country" class="form-control" value="<?php echo $guest_result['guest_country']  ?>"> 
                            </div>

                            <div class="col-xs-6">
                             <input id="up-personal-info" name="up-personal-info" type="text" placeholder="Personal Info" class="form-control" value="<?php echo $guest_result['guest_info']  ?>"> 
                            </div>

                            <input type="hidden" value="<?php echo $_GET['guest_id']; ?>" name="up-guest-id" id="up-guest-id"/>
                            
                          </div>



                          <div class="row">
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                          </div>
                         
                        </form>


                        
                      </div>
                      


                    </div> <!-- /container -->

            </div>
          </div>
        </div>

   

	</div> 


    </div> <!-- /container -->

