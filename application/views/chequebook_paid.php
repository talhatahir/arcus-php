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
        <?php foreach ($company_cheque_data as $company_cheque_paid_item): ?>    
        <tr>
          <td><?php echo $company_cheque_paid_item['cheque_index']  ?></td>
          <td><?php echo $company_cheque_paid_item['company_date'] ?></td>
          <td><?php echo $company_cheque_paid_item['cheque_date'] ?></td>
          <td><?php echo $company_cheque_paid_item['cheque_from'] ?></td>
          <td><?php echo $company_cheque_paid_item['cheque_bank'] ?></td>
          <td><?php echo $company_cheque_paid_item['cheque_number'] ?></td>
          <td><?php echo $company_cheque_paid_item['cheque_credit'] ?></td>
          <td><?php echo $company_cheque_paid_item['cheque_debit'] ?></td>
          <td><?php echo $company_cheque_paid_item['cheque_balance'] ?></td>   
          <td><?php 
          if($company_cheque_paid_item['cheque_status']==1){
            echo '<span class="label label-success">Paid</span>';
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