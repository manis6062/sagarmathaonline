<div class="container detail">
	<div class="col-md-8">
		<?php if(!empty($news)){
      				foreach ($news as $key => $value) {?>
		<div class="singlepage">
				<h2><a href="<?php echo base_url().'news/details/'.$value->news_id;?>"><?php echo $value->news_title;?></a></h2>
			<p><?php echo word_limiter(strip_tags($value->news_details), 50);?></p>
		</div>
		<?php }}?>
		<?php echo $links; ?>
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
</div>