 <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top navbar-md" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url();?>"><img height="16" alt="Arcus" src="<?php echo base_url();?>/assets/images/logoname.png" /></a>
          
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" action="<?php echo site_url();?>/users/auth" method="post">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email address" required autofocus>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Sign in</button>
          </div>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

<style>
.form-control{

  margin-bottom: 0px;
}
</style>

<div class="container">
 <div  class="row"><div style="text-align:center;" class="col-md-12">       
        <img  alt="Arcus" src="<?php echo base_url();?>/assets/images/logoss.png" />
        </div></div>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron custom-jumbotron">
        <?php if(! is_null($msg)){ echo $msg;} ?>
       
        <p class="lead">The Arcus Hotel management system gives full features like adding new Guest information, you can add all the expenses the guest made during their stay at the hotel and access them any time later.</p>
        <p class="lead">Please Sign In with your email and password to access the features.</p>
        <p>
          <a class="btn btn-default btn-info" href="../../components/#navbar" role="button">View more Info &raquo;</a>
        </p>
      </div>

    </div> <!-- /container -->
 