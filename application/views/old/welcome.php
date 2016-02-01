<?php $CI = &get_instance();
$path = ADVERTISEMENT_IMAGE_PATH;
?>
<div class="container section">
  <div class="col-md-4">
    <div class="feature">
    		<div class="title">
    		   
    		  <h2><a href="detail.php">समाचार</a></h2> 
        </div> 
      		<?php 
      			$data = $CI -> News_model -> getNewsType('समाचार',3);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
	                <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>   		
	      		      <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      </div> 
			    <?php }
							}
      		?>
    </div>
  </div>
  <div class="col-md-4">
    <div class="feature">
      <div class="title">
        <h2><a href="#">राजनीति</a></h2> </div>   
        <?php 
          $data = $CI -> News_model -> getNewsType('राजनीति',3);
          if(!empty($data)){
            foreach ($data as $key => $value) {?>
           <div class="news_blog"> 
              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>      
              <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
            </div> 
          <?php }
            }
        ?>
    </div>
  </div>
  <div class="col-md-4">
<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/SagarmathaOnlin" data-widget-id="653813443699433472">Tweets by @SagarmathaOnlin</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

       <div class="title">
      <div class="facebook">
        <div class="fb-like-box" data-href="https://www.facebook.com/Sagaramathaonline" data-width="100%" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
      </div>	   	
    </div>
    <div class="title">
      <?php 
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
<div class="container">
  <div class="col-12 col-sm-8 col-lg-8">
   <div class="title">
     <h2><a href="">अन्तरवार्ता</a><span><a href="<?php echo base_url(); ?>news/5">View All</a></span></h2>
  </div>
  <div class="blog_even clearfix">
    <div class="col-lg-6 col-sm-12">
        <?php 
            $data = $CI -> News_model -> getNewsType('अन्तरवार्ता',1);
            if(!empty($data)){
              $i=1;
              foreach ($data as $key => $value) {
                if($i<=1){?>
             <div class="news_blog"> 
              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>
                      <?php if(!empty($value->feature_image)){?>
                      <img src="<?php echo base_url() . NEWS_IMAGE_PATH . $value -> feature_image; ?>" width="100%"> 
                      <?php } ?>  
                      <p><?php echo word_limiter(strip_tags($value -> news_details), 70) . '...'; ?></p>  
              </div> 
      <?php $i++;
              }}
              }
          ?>
    </div>
     <div class="col-lg-6 col-sm-12">
     	<?php 
      		$data = $CI -> News_model -> getNewsType('अन्तरवार्ता',3);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3> 
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
    </div>
    
    </div>
  </div>
     <div class="col-md-4">
     <div class="title">
      		 	<?php 
      			$data = $CI -> News_model -> getAdvertiseType('अन्तरवार्ता',2,'side');
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="addlist" style="margin-top:0px;">
					      		<?php if($value->link!=''){?>
		      						<a href="<?php echo $value->link;?>" target="_blank"><img src="<?php echo base_url() . $path . $value -> path; ?>" width="50%" height="90"></a>
		      					<?php } else{?>
		      						<img src="<?php echo base_url() . $path . $value -> path; ?>" width="100%" height="130">
		      					<?php }?>	
					      </div>
			<?php }
							}
      		?>	
      	</div>       	 
      </div>
  
  <div class="col-lg-4">
  </div>
</div>
<div class="container">
  <div class="col-12 col-sm-8 col-lg-8">
   <div class="title">
     <h2><a href="">मनोरञ्जन</a><span><a href="<?php echo base_url(); ?>news/3">View All</a></span></h2>
  </div>
  <div class="blog_even clearfix">
    <div class="col-lg-6 col-sm-12">
      <?php 
            $data = $CI -> News_model -> getNewsType('मनोरन्जन',1);
            if(!empty($data)){
              $i=1;
              foreach ($data as $key => $value) {
          if($i<=2){?>
             <div class="news_blog"> 
              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3> 
                      <?php if(!empty($value->feature_image)){?>
                      <img src="<?php echo base_url() . NEWS_IMAGE_PATH . $value -> feature_image; ?>" width="100%"> 
                      <?php } ?>  
                      <p><?php echo word_limiter(strip_tags($value -> news_details), 50) . '...'; ?></p>  
              </div> 
             
      <?php $i++;
              }}
              }
          ?>
    </div>
     <div class="col-lg-6 col-sm-12">
    
     	<?php 
      		$data = $CI -> News_model -> getNewsType('मनोरन्जन',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3> 
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
    </div> 
    
    </div>
    
  </div>
     <div class="col-md-4">
      
     <div class="title">
      		 	<?php 
      			$data = $CI -> News_model -> getAdvertiseType('मनोरन्जन',2,'side');
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="addlist" style="margin-top:0px;">
					      		<?php if($value->link!=''){?>
		      						<a href="<?php echo $value->link;?>" target="_blank"><img src="<?php echo base_url() . $path . $value -> path; ?>" width="50%" height="90"></a>
		      					<?php } else{?>
		      						<img src="<?php echo base_url() . $path . $value -> path; ?>" width="100%" height="130">
		      					<?php }?>	
					      </div>
			<?php }
							}
      		?>	
      	</div>       	 
      </div>
  <div class="col-lg-4">
  </div>
</div>


 <div class="container">
    <div class="col-md-4">
           <div class="feature"> 
      			<div class="title">
      		<h2><a href="#">अर्थ</a></h2>  </div>
      		<?php 
      			$data = $CI -> News_model -> getNewsType('अर्थ',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
       
      	
      	</div>
      		 
  	</div>

<div class="col-md-4">
      <div class="feature">     
     <div class="title">
          <h2><a href="#">स्वास्थ्य</a></h2> </div>   
          <?php 
            $data = $CI -> News_model -> getNewsType('स्वास्थ्य',2);
            if(!empty($data)){
              foreach ($data as $key => $value) {?>
             <div class="news_blog"> 
                      <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>      
                    <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
                 </div> 
      <?php }
              }
          ?>
          </div>        
      </div>
 <div class="col-md-4">
     <div class="title">
      		 	<h2><a href="#">लेख/विचार</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('लेख/विचार',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>   		
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
      </div>
  
  </div> 
  
  <!--Full Add-->
 <div class="container">
 hello
 	<?php 
      			$data = $CI -> News_model -> getAdvertiseType('राजनीति',2,'bottom');
      			if(!empty($data)){
      				foreach ($data as $key => $value) {
      					if($value->link!=''){?>
      						<a href="<?php echo $value->link;?>" target="_blank"><img src="<?php echo base_url() . $path . $value -> path; ?>" width="50%" height="90"></a>
      					<?php }else{?>
      						<img src="<?php echo base_url() . $path . $value -> path; ?>" width="50%" height="90">
				<?php } }
							}
      		?>	
 </div>


 <div class="container">
     <div class="col-md-4">
      
     <div class="title">
      		<h2><a href="#">खेलकुद</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('खेलकुद',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>   		
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
		 
      </div>
      
  	

    <div class="col-md-4">
      
     <div class="title">
      		<h2><a href="#">प्रवास</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('प्रवास',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>   		
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
		 
      </div>
      
    
        <div class="col-md-4">
      
     <div class="title">
      		<h2><a href="#">समाज</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('समाज',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>   		
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
		 
      </div>
  
  </div> 
  
   
<div class="container">
    <div class="col-md-12">
       
        <div class="controls pull-right hidden-xs">
        
            <a class="btn" href="#carousel-example"
                data-slide="prev"><i class="fa fa-chevron-circle-left"></i></a><a class="btn" href="#carousel-example"
                    data-slide="next"><i class="fa fa-chevron-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="container">
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                   <?php
                    if ($sliderList != 0 && count($sliderList) > 0) {
                        $count = 1;
                        foreach ($sliderList as $values) {
                            ?>
                      <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo base_url() . "uploads/slider/" . $values -> path; ?>" class="img-responsive" alt="a" />
                                </div>
                                
                            </div>
                        </div>
                          <?php
                            $count++;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
 </div>
 


 <div class="container entertainment">
	
     <div class="col-md-4">
      
     <div class="title">
      		 	<h2><a href="#">लेख/विचार</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('लेख/विचार',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
      </div>
      
       <div class="col-md-4">
      
     <div class="title">
      		 	<h2><a href="#">प्रविधि</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('लेख/विचार',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
      </div>

   <div class="col-md-4">
      
     <div class="title">
      		 	<h2><a href="#">धार्मिक</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('धार्मिक',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
      </div>


</div>
   	  
   	  
   	  
  
  </div> 
  <div class="container">
  <div class="col-md-4">
     <div class="title">
      		 	<h2><a href="#">फिचर</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('फिचर',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
      </div>
      
        <div class="col-md-4">
     <div class="title">
      		 	<h2><a href="#">विश्व समाचार</a></h2> </div>   
      		<?php 
      			$data = $CI -> News_model -> getNewsType('अन्तराष्ट्रिय',2);
      			if(!empty($data)){
      				foreach ($data as $key => $value) {?>
						 <div class="news_blog"> 
				              <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>
				      		  <p><?php echo word_limiter(strip_tags($value -> news_details), 28) . '...'; ?></p> 
				      	 </div> 
			<?php }
							}
      		?>
      </div>
      
   

 
  
  </div> 

<div class="container">
    <div class="title" style="margin-bottom: 15px;">
            <h2>Latest Video</h2> </div>
      <div class="clearfix">
    <?php 
    foreach ($themeoptionLists as $key => $value) { ?>
       
  <div class="col-lg-3 video" style="margin-bottom: 15px;"><iframe width="100%" height="215" src="<?php echo $value->theme_video  ?>" frameborder="0" allowfullscreen></iframe></div>
  

  
  <?php } ?>
    </div>
  
  <div class="box clearfix">
  <div class="col-lg-6"><img src="<?php echo base_url();?>style/images/logo.png"></div>
<!--   <div class="col-lg-3">  
  <ul>
  <li><a href="#">हाम्रो बारे</a></li>
     <li><a href="#">सम्पर्क</a></li>
  </ul></div> -->
  
  <div class="col-lg-6">
  <ul>
  <li>प्रधान सम्पादक </li>
<li>बुद्धवीर बाहिङ</li>
  
  </ul>

  </div>
  <div class="col-lg-3">
    <ul>
     <li> </li>
  </ul>

  </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>js/slider/js/bjqs-1.3.min.js"></script> 
<script src="<?php echo base_url(); ?>js/slider/js/lightbox-2.6.min.js"></script> 
