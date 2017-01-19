
<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron" style="background-color:transparent;">
        <h1>View rooms</h1>
        <p>View all guest rooms booked onwards <button type="button" class="btn btn-primary btn-xs"><?php echo date('Y-m-d');?></button> </p>
      </div>
<hr/>

<div class="bs-example">


    <table class="table table-striped">

      <thead>
        <tr>
          <th>Guest Id</th>
          <th>Arrival Date</th>
          <th>Departure Date</th>
        </tr>
      </thead>
      <tbody>

	<?php 
	$current_room=null;
	foreach ($booked_rooms as $value) {

		
		if ($value['guest_room']!=$current_room) {
			$current_room=$value['guest_room'];
			echo '<tr class="info"><td colspan="3"><b>'.$current_room.'</b></td></tr>';
			
		}else{
			echo '<tr>';
		}	

		echo '<td><a href="'.site_url().'/users/viewguest?guest_id='.trim($value['guest_id']).'">'.$value['guest_id'].'</a></td>';
		echo '<td>'.$value['arrival_time'].'</td>';
		echo '<td>'.$value['dept_time'].'</td>';
		echo '</tr>';
	}

	?>
        
      </tbody>
    </table>
  </div>


    </div> <!-- /container -->

