<style>
form{color:#333; padding: 15px 0;}
label{margin-bottom: 10px;}
.commenttitle{
  color: red;
}

</style>
<div class="container">
	<div class="col-md-8">
			<h2><?php echo $news->news_title;?></h2>
			<?php if(!empty($news->feature_image)){?>
				<img src="<?php echo base_url().NEWS_IMAGE_PATH.$news->feature_image;?>" width="100%" height="310">
			<?php }?>
		<p><?php echo $news->news_details;?></p>
		 <div class="col-md-12 padding-left-none">
  <div class="commentbox">
  <h3>   प्राप्त प्रतिकृयाहरू </h3>
   <?php 
            if(!empty($userComments)){
              foreach ($userComments as $key => $value) {

                ?>
                
             <div class="addlist" >
                                 <div class="commenttitle"> <?php echo  $value->name ;  ?> लेख्नुहुन्छ  |</div>
                  <p><?php echo  $value->description ; ?></p> 
                </div>
      <?php }
              }
          ?>
  </div>


<form role="form" method ="POST" action="<?php echo base_url() .'user_comments/insert' .'/' .$this->uri->segment(3) ?>" >
<div class="form-group">
    <label for="name">नाम (अनिवार्य)</label>
    <input type="name" class="form-control" id="name" name="name">
  </div>

    <div class="form-group">
      <label for="email">इमेल (अनिवार्य) (गोप्य राखिनेछ)</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>

   <div class="form-group">

  <label for="comment">प्रतिक्रिया:</label>
  <textarea class="form-control" rows="5" id="description" name="description"></textarea>
</div>
    <input type="hidden" class="form-control" value="<?php echo $this->uri->segment(3); ?>" name="news_id" >

     <button type="submit" id="submit" class="btn btn-default">पठाउनुहोस्</button>
  </form>
  </div>

     
  
   
  
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
