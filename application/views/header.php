
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Arcus Hotel Management System</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/datepicker/css/datepicker.css" rel="stylesheet">
  <link rel="shortcut icon" href="http://www.artefaktsolutions.com/wp-content/uploads/2014/11/softIcon_031.png" />




  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->


      <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>    
      <script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js"></script>
      <script type="text/javascript">

        $(document).ready(function(){


          $('.cls-date').datepicker();

   

          $("#expense-button").click(function(){
           $("#expense-button").fadeOut();
           $("#add-expense").fadeIn();
         });


          $("#roomtime-button").click(function(){
            $("#room-modal").modal({
              keyboard: false
            });    
          });


          $("#guestinfo-button").click(function(){
            $("#updateguestinfo-modal").modal({
              keyboard: false
            });    
          });

          $("#guestinvoice-button").click(function(){
            $("#guestinvoice-modal").modal({
              keyboard: false
            });    
          });

          
          $('#room-modal').on('hidden.bs.modal', function () {
            location.reload();
          });

          $('#updateguestinfo-modal').on('hidden.bs.modal', function () {
            location.reload();
          });


          $("#cheque-button").click(function(){
            var url="<?php echo site_url("users/chequeaccounts?cheque_status=1"); ?>";
            window.location.href = url;
          });



          $("#cheque-paid_tab").click(function(){
            var url="<?php echo site_url("users/chequeaccounts?cheque_status=1"); ?>";
            window.location.href = url;
          });

          $("#cheque-unpaid_tab").click(function(){
            var url="<?php echo site_url("users/chequeaccounts?cheque_status=0"); ?>";
            window.location.href = url;
          });

          $("#addguest-button").click(function(){
           var url="<?php echo site_url("users/addguest"); ?>";
           window.location.href = url;
         });

          $("#search-button").click(function(){
           var url="<?php echo site_url("users/search"); ?>";
           window.location.href = url;
         });

          $("#accounts-button").click(function(){
            var url="<?php echo site_url("users/accounts"); ?>";
            window.location.href = url;
          });

          $("#roomday-button").click(function(){
            var url="<?php echo site_url("users/rooms"); ?>";
            window.location.href = url;
          });

          $(".chq-unpaid-span").click(function(){
            //debugger;
            var chqindex_id=this.id.split('_');
            $('.bs-unpaid-modal-sm').find('#chq_index_val').val(chqindex_id[1]);
            $('.bs-unpaid-modal-sm').modal('show');
            
          });

          $("#guestinvoice-print").click(function(){
            $("#guestinvoice-print").css("display","none");

            $.ajax({
                      url:"<?php echo site_url();?>"+"/users/insertGuestInvoice",
                      type: 'POST', 
                      dataType : 'json',
                      data:{forminvText:$("#print-data").html(),formguestid:$("#up-guest-id").val(),
                      formdateCreated: $("#inv-currentDate").text().replace("/","-").replace("/","-"),
                      formpaymentMethod: $("#form-paymentMethod").val()},                
                      success: function(data) {
                      console.log(data);                  
                      },
                      error: function(e) {
                      console.log(e);                       
                      }
                });

            
           var thePopup = window.open( '', "Invoice Print", "height=700,width=700" );
            thePopup.document.write('<html><head><title>my div</title>');
            thePopup.document.write('<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">');
            thePopup.document.write('<style type="text/css">#print-data{padding:20px;}</style>');
            thePopup.document.write('</head><body>');
            $('#print-data').clone().appendTo( thePopup.document.body );
            thePopup.document.write('</body></html>');          
            

            setTimeout(function() {
            thePopup.print();
          }, 2000);
              


                 
            
            
          });

          $("#submit-unpaid-chq").click(function(){
            $( "#chqform" ).submit();
            //$("#cheque-unpaid_tab").click();
            //$('.bs-unpaid-modal-sm').modal('hide');            
          });


         $("#guestInvoice-create").click(function(event){
              event.preventDefault();

              if ($("#to").val()=="") {
                alert("Please Enter To Date");
                return;
              }else if ($("#from").val()=="") {
                alert("Please Enter From Date"); 
                 return;
              }

            $.ajax({
                  url:"<?php echo site_url();?>"+"/users/guestinvoicebyDate",
                  type: 'POST', 
                  dataType : 'json',
                  data:{currDate:$("#curr").val(),guestId:$("#up-guest-id").val(),toDate: $("#to").val().replace("/","-").replace("/","-"), fromDate: $("#from").val().replace("/","-").replace("/","-")},                
                  success: function(data) {
                  console.log(data);                  
                 $("#inv-id").text(data.inv_id);       
                 $("#inv-hotelname").text(data.company_name);       
                 $("#inv-hoteladdress").html(data.company_address);    
                 $("#inv-dated").text(data.fromDate + " till "+ data.toDate);   
                 $("#inv-currentDate").text(data.currDate);
                 $("#inv-guestname").text(data.guest_name);
                 $("#inv-guestaddress").text(data.guest_address);
                 

                 var guestAcc= data.guest_accounts;
                 if (guestAcc=="" || guestAcc==undefined) {
                    $("#inv-accData").find("tbody").html("<strong>No Accounts data present.</strong>");
                    $("#guestinvoice-print").css("display","none");
                 }else{

                  var htmlData="";
                  var subt_total=0;
                  guestAcc.forEach(function(row) {
                    console.log(row);
                      subt_total=parseInt(subt_total)+parseInt(row.guest_credit);
                      htmlData+="<tr>";
                      htmlData+="<td>"+row.guest_remarks+"</td>";
                      htmlData+="<td class='text-center'>"+row.guest_credit+"</td>";
                      htmlData+="<td class='text-right'>"+row.guest_credit+"</td>";
                      htmlData+="</tr>";                    
                  });
                  $("#inv-accData").find("tbody").html("");
                  $("#inv-accData").find("tbody").append(htmlData);                  

                  htmlData="";
                  htmlData+="<tr>";
                  htmlData+="<td class='thick-line'></td>";
                  htmlData+="<td class='thick-line text-center'><strong>Subtotal</strong></td>";
                  htmlData+="<td class='thick-line text-right'>"+subt_total+"</td>";
                  htmlData+="</tr>";                    

                  $("#inv-accData").find("tbody").append(htmlData);  
                  $("#guestinvoice-print").css("display","block");

                 }                 
                           
                  },
                  error: function(e) {
                  //called when there is an error
                  //console.log(e.message);
                  }
                });
          });



        });


</script>

<style type="text/css">  
  .datepicker{z-index:9999 !important}
</style>

</head>

<body>

 <div class="navbar navbar-default navbar-fixed-top navbar-md" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo-a" href="<?php echo site_url();?>/users/home"><img height="16" alt="Arcus" src="<?php echo base_url();?>/assets/images/logoname.png" /></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li <?php if($this->uri->segment(2)=='home')echo "class='active'"; ?> ><a href="<?php echo site_url();?>/users/home"><span class="glyphicon glyphicon-th">&nbsp;</span>Dashboard</a></li>
        <li <?php if($this->uri->segment(2)=='accounts')echo "class='active'"; ?> ><a href="<?php echo site_url();?>/users/accounts"><span class="glyphicon glyphicon-list-alt">&nbsp;</span>Accounts</a></li>
        <li <?php if($this->uri->segment(2)=='search')echo "class='active'"; ?> ><a href="<?php echo site_url();?>/users/search"><span class="glyphicon glyphicon-search">&nbsp;</span>Search</a></li>
        <li <?php if($this->uri->segment(2)=='addguest')echo "class='active'"; ?> ><a href="<?php echo site_url();?>/users/addguest"><span class="glyphicon glyphicon-user">&nbsp;</span>Add New</a></li>
        <li <?php if($this->uri->segment(2)=='rooms')echo "class='active'"; ?> ><a href="<?php echo site_url();?>/users/rooms"><span class="glyphicon glyphicon-calendar">&nbsp;</span>View Rooms</a></li>        
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <li class="active"><a href="#"><b><?php if($this->session->userdata('role')=='0'){ echo "<span class='glyphicon glyphicon-tower'>&nbsp;</span>Admin";}else{echo "<span class='glyphicon glyphicon-briefcase'>&nbsp;</span>Accountant";} ?></b></a></li>
       <li><a href="<?php echo site_url();?>/main/do_logout"><span class="glyphicon glyphicon-off">&nbsp;</span>Log out</a></li>
     </ul>
   </div><!--/.nav-collapse -->
 </div>
</div>