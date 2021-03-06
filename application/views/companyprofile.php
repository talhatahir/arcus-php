
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
        <h1>Accounts Information</h1>
        <p>View complete detail of company Accounts and company Information below.</p>
      </div>
<hr/>

      <div class="container">
          <div class="row">          
            <div class="col-xs-5 profile">
              <label for="guest-name">Company Name</label>
              <div id="guest-name">HHH Brothers Guest House</div>
            </div>
            <div class="col-xs-3 profile">
            	<label for="city-name">Established</label>
              <div id="city-name">20-5-2012  </div>
            </div>
            <div class="col-xs-4 profile">
            	<label for="cnic-no">Owner </label>
              <div id="cnic-no">Haseeb Altaf Bhatti</div>
            </div>


            <div class="col-xs-9 profile">
            	<label for="phone-no">Phone No</label>
              <div id="phone-no">0334-2342-221</div>
            </div>
            <div class="col-xs-3 profile">
            	<label for="phone-no">Phone No</label>
              <div id="phone-no">0334-2342-221</div>
            </div>
            
          </div>

          <hr/>
         <div class="row">
         	<div class="col-xs-2">
				   <button type="button" id="expense-button" class="btn btn-warning btn-block">Add Expense</button>
			    </div>
          <div class="col-xs-2" style="float:right;">
           <button type="button" id="cheque-button" class="btn btn-danger btn-block">View Cheque Book</button>
          </div>
          <div class="col-xs-2" style="float:right;">
           <button type="button" id="invoices-button" class="btn btn-info btn-block">View Invoices</button>
          </div>
		 </div>

		 	<br/>

		 	

          <div class="row bg-info" id="add-expense" style="display:none;">
          	<br/>
            <form role="form" action="<?php echo site_url();?>/users/insertcompany_account" method="post">
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
		

   

	</div> 


    </div> <!-- /container -->

