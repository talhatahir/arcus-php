
<script type="text/javascript">
	$(document).ready(function(){
		var today = new Date();
		var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd}
    	if(mm<10){mm='0'+mm}

    		var today = yyyy+'-'+mm+'-'+dd;
    	$("#curr_company").val(today);

    });

</script>

<div class="container">
	<div class="row">	
		<div class="account-info">
			<table class="table table-striped">
				<?php if($company_cheque_data!='no_result' && !is_null($company_cheque_data)){  ?>
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Cheque Date</th>
						<th>From</th>
						<th>Bank</th>
						<th>Number</th>
						<th>Credit</th>
						<th>Debit</th>
						<th>Balance</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>


					<?php  $counter=1;  ?>
					<?php foreach ($company_cheque_data as $company_cheque_unpaid_item): ?>    
						<tr>
							<td><?php echo $company_cheque_unpaid_item['cheque_index']  ?></td>
							<td><?php echo $company_cheque_unpaid_item['company_date'] ?></td>
							<td><?php echo $company_cheque_unpaid_item['cheque_date'] ?></td>
							<td><?php echo $company_cheque_unpaid_item['cheque_from'] ?></td>
							<td><?php echo $company_cheque_unpaid_item['cheque_bank'] ?></td>
							<td><?php echo $company_cheque_unpaid_item['cheque_number'] ?></td>
							<td><?php echo $company_cheque_unpaid_item['cheque_credit'] ?></td>
							<td><?php echo $company_cheque_unpaid_item['cheque_debit'] ?></td>
							<td><?php echo $company_cheque_unpaid_item['cheque_balance'] ?></td>   
							<td><?php 
								if($company_cheque_unpaid_item['cheque_status']==0){
									echo '<span id="chqindex_'.$company_cheque_unpaid_item['cheque_index'].'" style="cursor:pointer;" class="label label-danger chq-unpaid-span">Un Paid</span>';
								}

								?></td>
							</tr>         
						<?php endforeach ?>
						<?php }else{ echo "<div class='col-md-4'><p class='text-danger'>No Cheque data found!</p></div>"; } ?>

						<p><?php echo $links; ?></p>
					</tbody>      
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade bs-unpaid-modal-sm">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-labelledby="mySmallModalLabel" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Please confirm</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to change status to <b>Paid</b>?</p>
				</div>
				<div class="modal-footer">
					<form role="form" id="chqform" action="<?php echo site_url();?>/users/updatestatus_unpaidtopaid?<?php echo $_SERVER['QUERY_STRING'] ?>" method="post">        
						<input type="hidden" value="" id="chq_index_val" name="chq_index_val">
						<input type="hidden" name="curr" id="curr_company" >
					</form>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="submit-unpaid-chq" class="btn btn-primary">Continue</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->