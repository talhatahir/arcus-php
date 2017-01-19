<div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Rooms Available Today</h3>
                </div>
                <div class="panel-body">
                    <?php 
					if (count($current_rooms)<= 0) {
						echo '<div class="alert alert-dismissible alert-danger">         
                				All rooms are booked for Today.
              					</div>';
					}else{ ?>

                     <table class="table table-striped">

				      <thead>
				        <tr>
				          <th>Room No</th>
				          <th>Room Status</th>          
				        </tr>
				      </thead>
				      <tbody>

					
						<?php
					foreach ($current_rooms as $value) {
						echo '<tr><td><span style="font-size:100%;" class="label label-info">'.$value.'</span></td><td><span class="label label-primary">Avaiable</span></td></tr>';
						
					}
				}

					?>
				        
				      </tbody>
				    </table>
                </div>
</div>
