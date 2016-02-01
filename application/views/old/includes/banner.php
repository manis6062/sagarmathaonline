<?php $CI = &get_instance();
$path = NEWS_IMAGE_PATH;
$bannerpath = ADVERTISEMENT_IMAGE_PATH;
$banner = $CI -> News_model -> getAllBanner();
$advertisement = $CI -> News_model -> getAdvertiseType('समाचार',3);
$main = $CI -> News_model -> getnews('main');
$latest = $CI -> News_model -> getnews('latest');
$popular = $CI -> News_model -> getnews('popular');
?>
<div class="col-lg-5">
	<div id="banner-fade">

		<!-- start Basic Jquery Slider -->
		<ul class="bjqs">
			<?php
if(!empty($banner)){
foreach($banner as $value){
			?>
			<li>
				<a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>">
					<img src="<?php echo base_url() . $path . $value -> feature_image; ?>" title="<?php echo word_limiter(strip_tags($value -> news_details), 30); ?>"></a>
			</li>
			<?php }} ?>
		</ul>
		<!-- end Basic jQuery Slider -->
	</div>
	<!-- End outer wrapper -->
</div>
<div class="col-lg-4 col-sm-12">
<div class="feature">
      <div class="title">
        <h2><a href="#">मुख्य समाचार</a></h2>
      </div>
        <?php if(!empty($main)){
				foreach($main as $value){	
			?>
			<div class="news_blog">
				<h2><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>" rel="bookmark"><?php echo $value -> news_title; ?></a></h2>
				<?php if($value->feature_image!=''){?>
				<img src="<?php echo base_url() . $path . $value -> feature_image; ?>" alt="" align="left" height="50px" width="50px">
				<?php } echo word_limiter(strip_tags($value -> news_details), 20);?>
			</div>
			<?php }} ?>
      
    </div>       
    </div>
<div class="col-lg-3 add">
	<?php if(!empty($advertisement)){
		$i=1;
		foreach($advertisement as $value){
			if($i<=4){?>
			<div class="addlist" style="margin-top:0px;">
           				<a href="<?php echo base_url() . $bannerpath . $value -> path; ?>" rel="lightbox"><img src="<?php echo base_url() . $bannerpath . $value -> path; ?>"></a>
			</div>
		<?php $i++;
				}
				}
				}
			?>
</div>
</div>
<div class="container">
  <div class="fulladd">
  	<img src="<?php echo base_url();?>style/img/aaxon.jpg" style="margin-bottom:15px;">
  </div>
</div>
