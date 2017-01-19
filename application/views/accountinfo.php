
<div class="container">
<div class="row">
	<h1>Account Information</h1>
	<hr/>
	<div class="account-info">
    <table class="table table-striped">
      <?php if($guest_accountinfo!='no_result' && !is_null($guest_accountinfo)){  ?>
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
        

        <?php  $counter=1;  $balance=0.00 ?>
        <?php foreach ($guest_accountinfo as $guest_accountinfo_item): ?>    
        <tr>
          <td><?php echo $counter  ?></td>
          <td><?php echo $guest_accountinfo_item['guest_date'] ?></td>
          <td><?php echo $guest_accountinfo_item['guest_remarks'] ?></td>
          <td><?php echo $guest_accountinfo_item['guest_credit'] ?></td>
          <td><?php echo $guest_accountinfo_item['guest_debit'] ?></td>
          <td><?php
            $cred= $guest_accountinfo_item['guest_credit'];
            $debt= $guest_accountinfo_item['guest_debit'];
            $cal=$cred-$debt;

            $balance=$balance+$cal;

            echo $balance;

             ?></td>
        </tr>
         <?php  $counter=$counter+1; ?>
        <?php endforeach ?>
        <?php }else{ echo "<div class='col-md-4'><p class='text-danger'>No accounts data found!</p></div>"; } ?>
      </tbody>
    </table>
  </div>
</div>
</div>