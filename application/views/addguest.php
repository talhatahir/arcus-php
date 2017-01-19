
<script type="text/javascript">
$(document).ready(function(){

var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 
var checkin = $('#arrival').datepicker({
  onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
  }
  checkin.hide();
  $('#dept')[0].focus();
}).data('datepicker');
var checkout = $('#dept').datepicker({
  onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkout.hide();
}).data('datepicker');

});

</script>

<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Add Guest Information</h1>
        <p>Add guest information including NIC,Phone Number and other information. Once added , the information can be easily accessed by Searching and will always be available.</p>
        <p>Fill out the form below with the provided Guest Information.</p>
        <br/>
        <form role="form" action="<?php echo site_url();?>/users/insertguestinfo" method="post">
          
          <div class="row">          
            <div class="col-xs-5">
              <input id="guest-name" name="guest-name" type="text" placeholder="Guest name" class="form-control" required autofocus> 
            </div>
            <div class="col-xs-3">
              <input id="city-name" name="city-name" type="text" placeholder="City name" class="form-control" required> 
            </div>
            <div class="col-xs-4">
             <input id="cnic-no" name="cnic-no" type="text" placeholder="CNIC" class="form-control" required> 
            </div>


            <div class="col-xs-9">
             <input id="address-no" name="address-no" type="text" placeholder="Address" class="form-control" required> 
            </div>
            <div class="col-xs-3">
             <input id="phone-no" name="phone-no" type="text" placeholder="Phone No" class="form-control" required> 
            </div>

            <div class="col-xs-8">
             <input id="visit-purpose" name="visit-purpose" type="text" placeholder="Purpose of visit" class="form-control" > 
            </div>
            <div class="col-xs-4">
             <input id="company-name" name="company-name" type="text" placeholder="Company name" class="form-control" > 
            </div>

            <div class="col-xs-4">
             <input id="country-name" name="country-name" type="text" placeholder="Country" class="form-control" > 
            </div>

            <div class="col-xs-8">
             <input id="personal-info" name="personal-info" type="text" placeholder="Personal Info" class="form-control" > 
            </div>
          </div>



          <div class="row">
            <div class="col-md-2">
              <button type="submit" class="btn btn-success btn-block">Submit</button>
            </div>
          </div>
         
        </form>


        
      </div>
      


    </div> <!-- /container -->
