
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



        var from = $('#from').datepicker({
      multidateSeparator: "-",
      onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
      }
      
    }).on('changeDate', function(ev) {
      if (ev.date.valueOf() > to.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        to.setValue(newDate);
      }
      from.hide();
      $('#to')[0].focus();
    }).data('datepicker');
    var to = $('#to').datepicker({
      multidateSeparator: "-",
      onRender: function(date) {
        return date.valueOf() <= from.date.valueOf() ? 'disabled' : '';
      }
      
    }).on('changeDate', function(ev) {
      to.hide();
    }).data('datepicker');

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
          <div class="col-xs-2">
            <button type="button" id="guestinvoice-button" class="btn btn-danger btn-block">Create Invoice</button>
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




      <div class="modal fade bs-example-modal-lg" id="guestinvoice-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width: 600px; height: 460px; overflow: scroll; background-color:white;">
            <div class="modal-content" style="top:-55px;">
                 <div class="container col-xs-12">
                     
                      
                        <h3>Select Date Range</h3>
                        <br/>                        
                          <div class="row">                            
                            <div class="col-xs-6">
                              <label for="dept">From</label>
                              <input id="from" name="from" type="text" placeholder="From date" data-date-format="yyyy/mm/dd" class="form-control cls-date" required> 
                            </div>
                            <div class="col-xs-6">
                              <label for="dept">To</label>
                              <input id="to" name="to" type="text" placeholder="To date" data-date-format="yyyy/mm/dd" class="form-control cls-date" required> 
                            </div>                            
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <button  id="guestInvoice-create" class="btn btn-primary btn-block">Create</button>
                            </div>
                            <div class="col-md-6">
                              <button type="button" style="display:none;" id="guestinvoice-print" class="btn btn-warning btn-block">Print</button>
                            </div>
                          </div>     
                          <hr/>
               
                     <div style="display:none;">
                        <input type="hidden" name="form-dateCreated" value=""  id="form-dateCreated" />                       
                        <input type="hidden" name="form-paymentMethod" value="CASH"  id="form-paymentMethod" />
                        <input type="hidden" value="<?php echo $_GET['guest_id']; ?>" name="form-guestid"  id="form-guestid" />
                        <input type="hidden" name="form-invText" value=""  id="form-invText" />                       
                    </div>
                       
                     

<div id="print-data">
    <div class="row">
        <div class="col-xs-12">
          <div class="invoice-title">
          <h2 class="pull-left">Invoice</h2><h3 class="pull-right" id="inv-id">#</h3>
        </div>
        <br/>
          <br/>
            <br/>
             <div class="row">
             &nbsp;
             </div>
      
        <div class="row">
          <div class="col-xs-6">
            <address>
            <strong id="inv-hotelname">Hotel Name</strong><br>
              <p id="inv-hoteladdress">John Smith<br>
              1234 Main<br>
              Apt. 4B<br>
              Springfield, ST 54321</p>
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong id="inv-guestname">Guest:</strong><br>
              <p id="inv-guestaddress">Jane Smith<br>
              1234 Main<br>
              Apt. 4B<br>
              Springfield, ST 54321</p>
            </address>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <address>
              <strong>Payment Method:</strong><br>
              CASH
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>Dated:</strong><br>
              <span id="inv-dated">1/11/2017-1/12/2017</span><br><br>
            </address>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Summary</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-condensed" id="inv-accData">
                <thead>
                    <tr>
                      <td><strong>Item</strong></td>
                      <td class="text-center"><strong>Price</strong></td>                      
                      <td class="text-right"><strong>Totals</strong></td>
                    </tr>
                </thead>
                <tbody>
                  <!-- foreach ($order->lineItems as $line) or some such thing here -->
                  <tr>
                    <td>BS-200</td>
                    <td class="text-center">$10.99</td>
                    <td class="text-right">$10.99</td>
                  </tr>
                  <tr>
                        <td>BS-1000</td>
                    <td class="text-center">$600.00</td>                    
                    <td class="text-right">$600.00</td>
                  </tr>
                  <tr>
                    <td class="thick-line"></td>
                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                    <td class="thick-line text-right">$670.99</td>
                  </tr>
                  <tr>
                    <td class="no-line"></td>                    
                    <td class="no-line text-center"><strong>TAX-16%</strong></td>
                    <td class="no-line text-right">$15</td>
                  </tr>
                  <tr>
                    <td class="no-line"></td>                    
                    <td class="no-line text-center"><strong>Total</strong></td>
                    <td class="no-line text-right">$685.99</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">       
       <div class="col-xs-6">
      <p  class="pull-left" style="font-size:8px;">A Product of <a href="http://www.artefaktsolutions.com/"><img height="20" alt="Arcus" src="http://localhost/hhh-artefakt//assets/images/arbw.png"></a></p>
       </div>
       <div class="col-xs-6 ">
       <p class="pull-right">Date: <span id="inv-currentDate">1//1/2017</span></p>
       </div>
    </div>
  </div>
                
                    
                    </div> <!-- /container -->
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

