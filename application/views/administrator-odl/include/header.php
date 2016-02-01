<?php 
	$CI = &get_instance();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        Charisma v1.0.0

        Copyright 2012 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
    -->
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tej Technology Cms website">
    <meta name="author" content="Niroj Shakya">

    <!-- The styles -->
    <link href="<?php echo base_url() . ADMIN_CSS; ?>bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="<?php echo base_url() . ADMIN_CSS; ?>bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url() . ADMIN_CSS; ?>charisma-app.css" rel="stylesheet">
     <link href='<?php echo base_url() . ADMIN_CSS; ?>uploadify.css' rel='stylesheet'>
    <script>
        function resetForm(){
           document.getElementById("form").reset();
         } 
    </script>
    <script>
        function readURL(input) {
        
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                    $('#blah').attr('style', 'display:inline');
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }    
    </script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="<?php echo base_url() . ADMIN_CSS; ?>../img/favicon.ico">
        
</head>

<body>
	
    <?php
      $CI = & get_instance();
	   $allowed = $this -> Auth_master_model -> getAuth();?>
        <!-- topbar starts -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="<?php echo base_url().'admin';?>"><span>Sagaramatha</span></a>
                
                <!-- theme selector starts -->
                <!-- <div class="btn-group pull-right theme-container" >
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" id="themes">
                        <li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
                        <li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
                        <li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
                        <li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
                        <li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
                        <li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
                        <li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
                        <li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
                        <li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
                    </ul> 
                </div>-->
                <!-- theme selector ends -->
                
                <!-- user dropdown starts -->
                <div class="btn-group pull-right" >
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-user"></i><span class="hidden-phone"> <?php echo $this->session->userdata(ADMIN_AUTH_USERNAME). '(' . ucwords($this->session->userdata(ADMIN_AUTH_TYPE)) . ')';?></span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (in_array('self_update', $allowed)) {?>
                            <li><a href="<?php echo site_url('admin/config');?>">Profile</a></li>
                            <li class="divider"></li>
                        <?php } if(in_array('change_password', $allowed)){?>
                            <li><a href="<?php echo site_url(ADMIN_PATH.'userlist/changePassword/'.$this->session->userdata(ADMIN_AUTH_USERID));?>">Change Password</a></li>
                            <li class="divider"></li>
                        <?php }?>
                        <li><a href="<?php echo site_url('admin/logout');?>">Logout</a></li>
                    </ul>
                </div>
                <!-- user dropdown ends -->
                
                <div class="top-nav nav-collapse">
                    <ul class="nav">
                        <li><a target="_blank" href="<?php echo base_url();?>">Visit Site</a></li>
                        <li><a href="<?php echo site_url('admin');?>">Dashboard</a></li>
                        <!-- <li>
                            <form class="navbar-search pull-left">
                                <input placeholder="Search" class="search-query span2" name="query" type="text">
                            </form>
                        </li> -->
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- topbar ends -->