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
    <title>Admin Panle |  Sagarmathaonline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

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
    <link href='<?php echo base_url() . ADMIN_CSS; ?>uniform.default.css' rel='stylesheet'>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
        
</head>

<body style="background-color: #3C9ED8;">
        <div class="container-fluid">
        <div class="row-fluid">
        
            <div class="row-fluid">
                <div class="span12 center login-header">
                    <h2>Sagarmatha online Admin Panel</h2>
                </div><!--/span-->
            </div><!--/row-->
            
            <div class="row-fluid">
                <div class="well span4 center login-box">
                    <div class="alert alert-info">
                        Please login with your Username and Password.<br />
                        <?php 
                        if($this->session->flashdata('message'))
                            {
                                echo $this->session->flashdata('message');
                            }
                       ?>
                    </div>
                    <?php echo form_open('admin/login',array('class' => 'form-horizontal'));?>
                            <div class="input-prepend" title="Username" data-rel="tooltip">
                                <span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" placeholder="Username" value="<?php echo set_value('username'); ?>" />
                            <?php echo form_error('username'); ?>
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password" data-rel="tooltip">
                                <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" placeholder="Password" type="password" value="" />
                            <?php echo form_error('password'); ?>
                            </div>
                            <div class="clearfix"></div>

                            <p class="center span5">
                            <?php echo form_submit('go', 'Login',"class='btn btn-primary'");?>  
                            </p>
                       <?php echo form_close();?>
                </div><!--/span-->
            </div><!--/row-->
                </div><!--/fluid-row-->
        
    </div><!--/.fluid-container-->

    <!-- external javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- jQuery -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery-1.7.2.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery-ui-1.8.21.custom.min.js"></script>
    <!-- transition / effect library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-transition.js"></script>
    <!-- alert enhancer library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-alert.js"></script>
    <!-- modal / dialog library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-modal.js"></script>
    <!-- custom dropdown library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-dropdown.js"></script>
    <!-- scrolspy library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-scrollspy.js"></script>
    <!-- library for creating tabs -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-tab.js"></script>
    <!-- library for advanced tooltip -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-tooltip.js"></script>
    <!-- popover effect library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-popover.js"></script>
    <!-- button enhancer library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-button.js"></script>
    <!-- accordion library (optional, not used in demo) -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-collapse.js"></script>
    <!-- carousel slideshow library (optional, not used in demo) -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-carousel.js"></script>
    <!-- autocomplete library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-typeahead.js"></script>
    <!-- tour library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-tour.js"></script>
    <!-- library for cookie management -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.cookie.js"></script>
    <!-- calander plugin -->
    <script src='<?php echo base_url() . ADMIN_JS; ?>fullcalendar.min.js'></script>
    <!-- data table plugin -->
    <script src='<?php echo base_url() . ADMIN_JS; ?>jquery.dataTables.min.js'></script>


    <!-- select or dropdown enhancer -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.chosen.min.js"></script>
    <!-- checkbox, radio, and file input styler -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.uniform.min.js"></script>
    <!-- plugin for gallery image view -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.colorbox.min.js"></script>
    <!-- rich text editor library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.cleditor.min.js"></script>
    <!-- notification plugin -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.noty.js"></script>
    <!-- file manager library -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.elfinder.min.js"></script>
    <!-- star rating plugin -->
    
    <!-- history.js for cross-browser state change on ajax -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>jquery.history.js"></script>
    <!-- application script for Charisma demo -->
    <script src="<?php echo base_url() . ADMIN_JS; ?>charisma.js"></script>
    
        
</body>
</html>
