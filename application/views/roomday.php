
<script type="text/javascript">
  $(document).ready(function(){

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    
    var checkin = $('#arrival').datepicker({
      multidateSeparator: "-",
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
      multidateSeparator: "-",
      onRender: function(date) {
        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
      }
      
    }).on('changeDate', function(ev) {
      checkout.hide();
    }).data('datepicker');



    $( "#sub" ).click(function() {
      var str='';

      $('input[name="rooms"]:checked').each(function() {
       str+=this.value+',';

     });


      str = str.substring(0, str.length - 1);


      $("#room-no").val(str);


      varDept= $("#dept").val();
      c=varDept.replace("/","-");
      d=c.replace("/","-");
      $("#dept").val(d);
      

      varDept= $("#arrival").val();
      c=varDept.replace("/","-");
      d=c.replace("/","-");
      $("#arrival").val(d);

      $( "#rform" ).submit();

    });

  });

</script>

<style type="text/css">
  .checkbox label{

   padding-right: 20px;
 }
</style>

<div class="container">

  <!-- Main component for a primary marketing message or call to action -->
  <div class="jumbotron">
    <h1>Add Guest Information</h1>
    <p>Fill out the Room(s) , Date of Arrival and Departure of the guest.</p>
    <br/>
    <form role="form" id="rform" action="<?php echo site_url();?>/users/addroomday?popup=<?php if(! is_null($frompopup)){ echo $frompopup;} ?>" method="post">        

      <div class="row">
        <div class="col-xs-4">
          <label for="arrival">Arrival date</label>
          <input id="arrival" name="arrival" type="text" data-date-format="yyyy/mm/dd" placeholder="Arrival date" class="form-control" readonly="readonly" required> 
        </div>

        <div class="col-xs-4">
          <label for="dept">Departure date</label>
          <input id="dept" name="dept" type="text" placeholder="Departure date" data-date-format="yyyy/mm/dd" readonly="readonly" class="form-control" required> 
        </div>

        <div class="col-xs-8">
          <label for="room-no">Rooms</label>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="rooms" value="R-001"> R-001
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-002"> R-002
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-101"> R-101
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-103"> R-103
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-104"> R-104
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-105"> R-105
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-106"> R-106
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-107"> R-107
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-108"> R-108
            </label>
            <label>
              <input type="checkbox" name="rooms" value="R-109"> R-109
            </label>
          </div>
          <input type="hidden" name="room-no" id="room-no" >
<!--
             <select multiple class="form-control" id="room-no"  name="room-no" required>
              <option>R-001</option>
              <option>R-002</option>
              <option>R-101</option>
              <option>R-103</option>
              <option>R-104</option>
              <option>R-105</option>
              <option>R-106</option>
              <option>R-107</option>
              <option>R-108</option>
              <option>R-109</option>
            </select> -->
          </div>
          <div class="col-xs-4">
           <?php if(! is_null($errormsg)){ echo $errormsg;} ?>	
         </div>
         
         
         <input type="hidden" name="g_id" value="<?php if(! is_null($guest_id)){ echo $guest_id;} ?>" >
       </div>

       <div class="row">
        <div class="col-md-2">
          <button type="button" class="btn btn-success btn-block" id="sub">Submit</button>
        </div>
      </div>
      
    </form>


    
  </div>
  


</div> <!-- /container -->
