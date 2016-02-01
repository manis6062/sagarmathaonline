<div class="container">
	<div class="col-md-8">
			<h2><?php echo $news->news_title;?></h2>
			<?php if(!empty($news->feature_image)){?>
				<img src="<?php echo base_url().NEWS_IMAGE_PATH.$news->feature_image;?>" width="100%" height="310">
			<?php }?>
		<p><?php echo $news->news_details;?></p>
		</div>
	</div>
	<div class="col-md-4">
		<?php 
				$path = ADVERTISEMENT_IMAGE_PATH;
      			if(!empty($newsadd)){
      				foreach ($newsadd as $key => $value) {?>
						 <div class="addlist" style="margin-top:5px;">
					      		<a href="#" rel="lightbox"><img src="<?php echo base_url() . $path . $value -> path; ?>"></a>
					      </div>
			<?php }
							}
      		?>	
	</div>

</div>
