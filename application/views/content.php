<?php 
$CI = & get_instance();
?>
<div class="container detail">
	<div class="col-md-8">
		<div class="title newsdetails">
			<h2><?php echo $contentdata->content_title;?></h2>
            <div class="postdate"><?php echo $contentdata->crtd_dt;?></div>
            </div>
			<p><?php echo $contentdata->content_description;?></p>    
		</div>
	</div>
	<div class="col-md-4">
		<div class="title"><?php 
      			$data = $CI -> News_model -> getAdvertiseType('स्वास्थ्य',1,'side');
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="addlist" style="margin-top:0px;">
					      		<?php if($value->link!=''){?>
		      						<a href="<?php echo $value->link;?>" target="_blank"><img src="<?php echo base_url() . $path . $value -> path; ?>" width="50%" height="90"></a>
		      					<?php } else{?>
		      						<img src="<?php echo base_url() . $path . $value -> path; ?>" width="50%" height="90">
		      					<?php }?>	
					      </div>
			<?php }
							}
      		?>	
     </div> 
	</div>

</div>

</div>
