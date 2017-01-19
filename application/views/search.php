
<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Search Guest Info</h1>
        <p>Search for any Guest information and access their detailed stay at HHH Guest House including their account details.</p>
        <p>Please enter Guest Information below to begin Search.</p>
        <div class="row">
        	<div class="col-md-8">
        		<form role="form" action="<?php echo site_url();?>/users/searchguestinfo" method="post">
        		<input type="search"  name="search-info" class="form-control input-default" placeholder="Enter Guest Name or NIC or Phone Number or Company name" required autofocus />

        	</div>
	      	<div class="col-md-4">
				    <button type="submit" class="btn btn-primary btn-default btn-block">Search</button>
			     </div>
	      	</form>
      	</div>
     
      </div>

    

      <div class="row" id="search-result">
        <?php if(! is_null($searchdata) && $searchdata!='no_result'){ ?>

      <div class="bs-example">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Company</th>
                <th>CNINC</th>
                <th>Phone</th>
              </tr>
            </thead>
            <tbody>       
        <?php  $counter=1; ?>
        <?php foreach ($searchdata as $searchdata_item): ?>      
      <tr>
                <td><?php echo $counter  ?></td>
                <td><a href="<?php echo site_url();?>/users/viewguest?guest_id=<?php echo $searchdata_item['guest_id']?>" ><?php echo $searchdata_item['guest_name'] ?></a></td>
                <td><?php echo $searchdata_item['guest_company'] ?></td>
                <td><?php echo $searchdata_item['guest_cnic'] ?></td>
                <td><?php echo $searchdata_item['guest_phone'] ?></td>
              </tr>
           <?php  $counter=$counter+1; ?>

            <?php endforeach ?>
              </tbody>
            </table>

            <?php   }else if($searchdata=='no_result'){

              echo "<div class='col-md-4'><p class='text-danger'>No results found, try again or improve your search</p></div>";
            } ?>
            
            </div>

    </div> <!-- /container -->

</div>