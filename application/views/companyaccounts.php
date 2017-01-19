
<div class="container">
  <div class="row">	
		<div class="account-info">
    <table class="table table-striped">
      <?php if($company_accountinfo!='no_result' && !is_null($company_accountinfo)){  ?>
      <thead>
        <tr>
          <th>#</th>
          <th>Date</th>
          <th>Remarks</th>
          <th>Credit</th>
          <th>Debit</th>
          <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        

        <?php  $counter=1;  ?>
        <?php foreach ($company_accountinfo as $guest_accountinfo_item): ?>    
        <tr>
          <td><?php echo $guest_accountinfo_item['account_index']  ?></td>
          <td><?php echo $guest_accountinfo_item['company_date'] ?></td>
          <td><?php echo $guest_accountinfo_item['company_remarks'] ?></td>
          <td><?php echo $guest_accountinfo_item['company_credit'] ?></td>
          <td><?php echo $guest_accountinfo_item['company_debit'] ?></td>
          <td><?php echo $guest_accountinfo_item['company_balance'] ?></td>   
        </tr>         
        <?php endforeach ?>
        <?php }else{ echo "<div class='col-md-4'><p class='text-danger'>No accounts data found!</p></div>"; } ?>

        <p><?php echo $links; ?></p>
      </tbody>      
    </table>
  </div>
</div>
</div>