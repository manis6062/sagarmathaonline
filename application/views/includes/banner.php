<?php $CI = &get_instance();
$path = NEWS_IMAGE_PATH;
$bannerpath = ADVERTISEMENT_IMAGE_PATH;
$banner = $CI -> News_model -> getAllBanner();
$advertisement = $CI -> Advertisement_model -> getsmalladvertisment(3,0);
$large = $CI -> Advertisement_model -> getlargeadvertisment(0);
$section = $CI -> Advertisement_model -> getSectionAdvertisment(0,1);
$main = $CI -> News_model -> getnews('main');
$latest = $CI -> News_model -> getnews('latest');
$popular = $CI -> News_model -> getnews('popular');
?>
<div class="col-lg-5 noleft">
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
        <?php 
      			$data = $CI -> News_model -> getNewsType('मुख्य समाचार',4);

      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
	                
                  <h3>
                  <a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>   		
	      		      <img style = "width:50px ; height=50px;"src="<?php echo base_url() . $path . $value -> feature_image; ?>" style="margin-bottom:15px;">

                  <p><?php echo word_limiter(strip_tags($value -> news_details), 20) . '...'; ?></p> 
				      </div> 
			    <?php }
							}
      		?>
      
    </div>       
    </div>
<div class="col-lg-3 noright">
	<?php if(!empty($advertisement)){
		foreach($advertisement as $value){?>
			<div class="addlist" style="margin-top:0px;">
           				<a href="<?php echo $value -> link; ?>" target='_blank'><img src="<?php echo base_url() . $bannerpath . $value -> path; ?>"></a>
			</div>
		<?php 
				}
				}
			?>
</div>
</div>
<div class="container">
  <div class="fulladd">
  	<img src="<?php echo base_url() . $bannerpath . $large -> path; ?>" style="margin-bottom:15px;">
  </div>
</div>
  <div class="container">

   <div class="fulladd">
 
  <?php 
       
            if(!empty($section)){

              foreach ($section as $key => $value) {?>
             
                <img src="<?php echo base_url() .$bannerpath.$value -> path; ?>">

            <?php } }
          ?>  

                  </div>

</div>
