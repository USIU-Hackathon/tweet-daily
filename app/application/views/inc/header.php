<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url();?>favicon.ico">

    <title>TweetDaily &#187; Go sleep and get the tweets at the end of the day.</title>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <?php
    if(isset($date_picker)):
    ?>
    <link href="<?php echo base_url();?>assets/css/datepicker.css" rel="stylesheet">
    <?php endif; ?>
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TweetDaily</a>
        </div>
        <div class="navbar-collapse collapse">
          <?php
          function menu_is_active($menu,$active){
            if($active == $menu){
              return "active";
            }
          }

          ?>
          <ul class="nav navbar-nav">
            <li class="<?php echo menu_is_active("home",$active); ?>"><?php echo anchor("home","Home"); ?></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown active-inverse">
            <?php if($this->session->userdata('is_logged_in')){ ?>
              <a href="#" class="dropdown-toggle white" data-toggle="dropdown"><i class="fa fa-arrow-circle-right"></i> 
                    <?php echo $this->session->userdata('first_name')." ".
                                $this->session->userdata('last_name');
                       ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <!-- <li><a href="#"><i class='fa fa-gear'></i> Settings</a></li> -->
                        <li><?php echo anchor("home/user/logout","<i class='fa fa-sign-out'></i> Logout"); ?></li>
                    </ul>

            <?php } else{ ?>
              
              <?php echo anchor("home/user/login","<i class='fa fa-lock'></i> Login</span>","class='strong white'"); ?>
                <ul class="dropdown-menu" role="menu">
                </ul>
            <?php } ?>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <?php
    if(!isset($css_class)) $css_class="none";
    if(!isset($css_id)) $css_id = "none";
    ?>

    <div class="container content <?php echo $css_class; ?>" id="<?php echo $css_id; ?>">

      <!-- message area -->

      <?php
      $msg = $this->session->flashdata("msg");
      if($msg != ""){
        echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
      }
      ?>