<?php
$CI = & get_instance();
$menu = $CI->News_category_model->getAllMenu();
$flash = $CI->News_model->getFlashnews();
?>
<div class="navbar navbar-default">
	<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		</button>
	</div>
	<div class="navbar-collapse collapse">
		<?php //$active[$current] = 'class = active'; ?>

		<div class="menu">
			<ul class="nav navbar-nav">
				<li <?php
                if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "welcome") {
                    echo 'class="active"';
                }
                ?>><a href="<?php echo base_url(); ?>">गृहपृष्ठ</a></li>
                <?php
                    if (!empty($menu)) {
                        foreach ($menu as $value) {
                                ?>
                            <li <?php
                                if ($this->uri->segment(4) == "$value->id") {
                                    echo 'class="active"';
                                }
                                ?>><a href="<?php echo site_url('news/' . $value->id); ?>"><?php echo $value->category_name; ?></a></li>
                            <?php
                    }
                }
                ?>   
			</ul>
		</div>
	</div>
</div>
</div>
<?php 
	if($this->uri->segment(1)==''){
		if(!empty($flash)){?>
			<div class="container">
            <div class="bs-callout bs-callout-warning">
				<div class="title" style="text-align: center; font-size: 25px; font-weight: bold; margin: 15px; color:#639016;">
					<?php echo $flash->news_title;?>
				</div>
				<?php if($flash->feature_image!=''){?><div style="text-align: center;"><img align="middle" src="<?php echo base_url().'uploads/news/'.$flash->feature_image;?>" style="width: 50%;"></div><?php }?>
				<div style="text-align: center; font-size: 14px; margin: 15px;"><?php echo $flash->news_details;?></div>
                </div>
			</div>
	<?php }}
	?>

<div class="wrapper">	
	<div class="container" style="padding-top:15px;">

