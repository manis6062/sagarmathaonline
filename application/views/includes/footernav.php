<?php $CI = &get_instance();
$menu = $CI -> Menu_model -> getAllMenu('bottom-menu');
?>
<footer>
<div class="container">
  <div class="footer_nav">
    <div class="col-lg-6">
      <p>© २०१४ चोमोलोङमा मिडिया प्रोडक्सन प्रालिद्बारा प्रकाशित / सर्वाधिकार सुरक्षित  </p>  
    </div>
    <div class="col-lg-3">
      <ul>
        <li><a href="#"><img src="<?php echo base_url();?>style/img/facebook.jpg"></a></li>
        <li><a href="#"><img src="<?php echo base_url();?>style/img/twitter.jpg"></a></li>
        <li><a href="#"><img src="<?php echo base_url();?>style/img/youtube.jpg"></a></li>      
      </ul>
    </div>
    <div class="col-lg-3">
     <p class="powered_by">Powered by <a href="http://www.webspacenepal.com/" target="_blank">Web Space Nepal</a></p>  
    </div>
  </div>
</div>











     <!--  <ul>
      	<?php 
      	if(!empty($menu)){
      	foreach($menu as $value){
      		if($value->module_controller=='home'){?>
      			<li><a href="<?php echo base_url();?>"><?php echo $value->menu_name;?></a></li>
      		<?php }elseif($value->module_controller=='contact'){?>
        		<li><a href="<?php echo base_url().$value->module_controller;?>"><?php echo $value->menu_name;?></a></li>
        	<?php }else{?>
        		<li><a href="<?php echo base_url().$value->module_controller.'/'.$value->content_id;?>"><?php echo $value->menu_name;?></a></li>
        <?php }}}?>
      </ul> -->
</footer>
<script src="<?php echo base_url();?>js/front/jquery.js"></script> 
<script src="<?php echo base_url();?>js/front/bjqs-1.3.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/front/jquery.vticker-min.js"></script>
<script src="<?php echo base_url();?>js/front/lightbox-2.6.min.js"></script>
<script src="<?php echo base_url();?>js/front/bootstrap.min.js"></script> 
<script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 600,
            width       : 600,
            responsive  : true
          });

        });
      </script>


</body>
</html>