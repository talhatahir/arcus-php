
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


      $('#cheque-date').datepicker({
        multidateSeparator: "-",
        onRender: function(date) {
          return date.valueOf();
        }

      });
      


      $( "#sub" ).click(function() {

       varDept= $("#cheque-date").val();
       c=varDept.replace("/","-");
       d=c.replace("/","-");
       $("#cheque-date").val(d);

       $( "#cform" ).submit();

     });

    });

</script>

<style type="text/css">
  .custom-nav > li{
    float: none;
    display: inline-block;
  }

</style>

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
     <button type="button" id="expense-button" class="btn btn-warning btn-block">Add Cheque Info</button>
   </div>         
 </div>

 <br/>

 

 <div class="row bg-warning" id="add-expense" style="display:none;">
   <br/>
   
   <form role="form" action="<?php echo site_url();?>/users/insertcheque_account?<?php echo $_SERVER['QUERY_STRING'] ?>" method="post" id="cform">
    <input type="hidden" name="curr" id="curr" value="">
    
    <div class="col-xs-7">
     <input id="from" name="from" type="text" placeholder="From" class="form-control" required> 
   </div>

   <div class="col-xs-3">
     <input id="cheque-no" name="cheque-no" type="text" placeholder="Cheque No." class="form-control" required> 
   </div>

   <div class="col-xs-2">
     <input id="cheque-date" name="cheque-date" type="text" data-date-format="yyyy/mm/dd" placeholder="Cheque Date." class="form-control" > 
   </div>

   <div class="col-xs-4">
     <input id="bank" name="bank" type="text" placeholder="Bank Name" class="form-control" > 
   </div>

   

   <div class="col-xs-2">
     <select class="form-control" id="amount" name="amount" required>
      <option>Credit</option>
      <option>Debit</option>
    </select> 
  </div>

  <div class="col-xs-2">
   <select class="form-control" id="status" name="status" required>
    <option>Paid</option>
    <option>Not Paid</option>
  </select> 
</div>

<div class="col-xs-2">
 <input id="price" name="price" type="number" placeholder="Amount" class="form-control" min="0"  required> 
</div>
<div class="col-xs-2">
  <button type="button" class="btn btn-success btn-block" id="sub">Submit</button>
</div>


</form>
</div>
<br/>
<br/>		
<br/>
<div class="row">
 <div class="col-md-12" style="text-align:center;">
   <ul class="nav nav-tabs custom-nav">
    <li id="cheque-paid_tab" role="presentation" <?php if($_SERVER['QUERY_STRING']=='cheque_status=1')echo "class='active'"; ?> ><a href="javascript:void(0)">Paid</a></li>
    <li id="cheque-unpaid_tab" role="presentation" <?php if($_SERVER['QUERY_STRING']=='cheque_status=0')echo "class='active'"; ?>><a href="javascript:void(0)">Un Paid</a></li>		  
  </ul>
</div>
</div>


</div> 


</div> <!-- /container -->

