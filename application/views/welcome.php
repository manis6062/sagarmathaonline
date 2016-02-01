<?php $CI = &get_instance();
$path = ADVERTISEMENT_IMAGE_PATH;
$news_path = NEWS_IMAGE_PATH;
?>
<div class="container section">
  <div class="col-md-4 noleft">
    <div class="feature">
        <div class="title">
          <h2><a href="detail.php">समाचार</a></h2> 
        </div> 

          <?php 

            $data = $CI -> News_model -> getNewsType('समाचार',5);

            if(!empty($data)){

              foreach ($data as $key => $value) {?>

             <div class="news_blog"> 

                  

                  <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>      

                                   <img style = "width:50px ; height=50px;"src="<?php echo base_url() . $news_path . $value -> feature_image; ?>" style="margin-bottom:15px;">





                  <p><?php echo word_limiter(strip_tags($value -> news_details), 20) . '...'; ?></p> 

              </div> 

          <?php }

              }

          ?>

            <?php 

            $data = $CI -> News_model -> getNewsTypeTitle('समाचार',5);

            if(!empty($data)){

              foreach ($data as $key => $value) {?>

             <div class="news_blog"> 

                  

                  <p><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></p>      



              </div> 

          <?php }

              }

          ?>

    </div>

  </div>



  <div class="col-md-4">

    <div class="feature">

      <div class="title">

            <h2><a href="#">देश</a></h2> </div>   

          <?php 

            $data = $CI -> News_model -> getNewsType('देश',5);

            if(!empty($data)){

              foreach ($data as $key => $value) {?>

             <div class="news_blog"> 

                      <h3><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></h3>

                                                       <img style = "width:50px ; height=50px;"src="<?php echo base_url() . $news_path . $value -> feature_image; ?>" style="margin-bottom:15px;">



                    <p><?php echo word_limiter(strip_tags($value -> news_details), 20) . '...'; ?></p> 

                 </div> 

      <?php }

              }

          ?>

            <?php 

            $data = $CI -> News_model -> getNewsTypeTitle('देश',5);

            if(!empty($data)){

              foreach ($data as $key => $value) {?>

             <div class="news_blog"> 

                      <p><a href="<?php echo base_url() . 'news/details/' . $value -> news_id; ?>"><?php echo $value -> news_title; ?></a></p>

                 </div> 

      <?php }

              }

          ?>

    </div>

  </div>



  <div class="col-md-4 noright">

<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/SagarmathaOnlin" data-widget-id="653813443699433472">Tweets by @SagarmathaOnlin</a>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

       <div class="title">

      <div class="facebook">

        <div class="fb-like-box" data-href="https://www.facebook.com/Sagaramathaonline" data-width="100%" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

      </div>      

    </div>

    <div class="title">

      <?php 

      $data = $CI -> Advertisement_model -> getsmalladvertisment(1,5);

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

  <div class="col-md-8 noleft">

   <div class="title">

     <h2><a href="">कुराकानी</a><span><a href="<?php echo base_url(); ?>news/5">View All</a></span></h2>

  </div>

  <div class="blog_even clearfix">

    <div class="col-lg-6 col-sm-12 noleft">

        <?php 

            $data = $CI -> News_model -> getNewsType('कुराकानी',1);

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

          $data = $CI -> News_model -> getNewsTypebyoffset('कुराकानी',1,3);

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



    <div class="col-md-4 noright">

    <div class="title">

            <?php 

            $data = $CI -> Advertisement_model -> getsmalladvertisment(5,5);

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



   <div class="fulladd">

 

  <?php 

       $section = $CI -> Advertisement_model -> getSectionAdvertisment(1,1);

            if(!empty($section)){



              foreach ($section as $key => $value) {?>

            

                <img src="<?php echo base_url() .$path.$value -> path; ?>">



            <?php } }

          ?>  



                  </div>



</div>





<div class="container">

  <div class="col-sm-8 noleft">

   <div class="title">

     <h2><a href="">कला-मनोरञ्जन</a><span><a href="<?php echo base_url(); ?>news/3">View All</a></span></h2>

  </div>

  <div class="blog_even clearfix">

    <div class="col-lg-6 noleft">

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

          $data = $CI -> News_model -> getNewsTypebyoffset('मनोरन्जन',1, 3);

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

            $data = $CI -> Advertisement_model -> getsmalladvertisment(2,4);

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

</div>

 

 <div class="container">



   <div class="fulladd">

 

  <?php 

       $section = $CI -> Advertisement_model -> getSectionAdvertisment(1,2);

            if(!empty($section)){



              foreach ($section as $key => $value) {?>

            

                <img src="<?php echo base_url() .$path.$value -> path; ?>">



            <?php } }

          ?>  



                  </div>



</div>



 <div class="container">

    <div class="col-md-4 noleft">

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





 <div class="col-md-4 noright">

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

     <div class="col-md-4 noleft">

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



        <div class="col-md-4 noright">

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

                    $sliderList = $CI -> Advertisement_model -> getslideradvertisment();

                    if ($sliderList != 0 && count($sliderList) > 0) {

                       $count = 1;

                        foreach ($sliderList as $values) {

                            ?>

                      <div class="col-sm-3">

                            <div class="col-item">

                                <div class="photo">

                                    <img src="<?php echo base_url() . $path . $values -> path; ?>" class="img-responsive" alt="a" />

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

     <div class="title"><h2><a href="#">राजनीति</a></h2> </div>   

        <?php 

          $data = $CI -> News_model -> getNewsType('राजनीति',4);

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



   <div class="fulladd">

 

  <?php 

       $section = $CI -> Advertisement_model -> getSectionAdvertisment(4,4);

            if(!empty($section)){



              foreach ($section as $key => $value) {?>

            

                <img src="<?php echo base_url() .$path.$value -> path; ?>">



            <?php } }

          ?>  



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

            <h2><a href="#">पौरखी</a></h2> </div>   

          <?php 

            $data = $CI -> News_model -> getNewsType('पौरखी',2);

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

            <h2><a href="#">सम्पादकीय</a></h2> </div>   

          <?php 

            $data = $CI -> News_model -> getNewsType('सम्पादकीय',2);

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



<div class="container video">

    <div class="title" style="margin-bottom: 15px;">

            <h2>भिडियो</h2> </div>

      <div class="clearfix">

    <?php 

    foreach ($themeoptionLists as $key => $value) { ?>

  <div class="col-lg-3" style="margin-bottom: 15px;"><iframe width="100%" height="215" src="<?php echo $value->theme_video  ?>" frameborder="0" allowfullscreen></iframe></div>

  <?php } ?>

    </div>

  <div class="box clearfix">


 <div class="col-md-4">
      <h2>हाम्रो टिम</h2>

  <?php 
 foreach ($teamList as $key => $value) : ?>

      <P class="center">
      <strong><?php echo $value->category_name ; ?></strong> <br>
     <?php echo $value->name ; ?> <br>
      </P>
<?php endforeach ; ?>

  </div>


  <div class="col-md-4">
  <h2>सम्पर्क</h2>
  <p>
 <strong>मुख्य काईलय</strong><br>
दुधकुण्ड नगरपलिका<br>
वडा ५ सल्लेरी सोलुखुम्बु<br>
<br>
<strong>शखा कार्यलय</strong><br>
न्यू प्लाजा, काठमाडौं नेपाल<br>

Email:-sonews4@gmail.com<br>
news@sagarmathaonline.com
</p>
  </div>
  <div class="col-md-4">
    <h2>हाम्रो बारेमा</h2>
    <p>चोमोलोङगमा मिडिया प्रोडक्सन<br> होम प्रा.लि द्धरा सञ्चालित<br>
    <a href="http://sagarmathaonline.com/">www.sagarmathaonline.com</a>
   <a href="http://sagarmathaonline.com/"><img src="<?php echo base_url();?>style/images/logo.png" style="margin-top:25px; width:250px;"></a>
    </p>
  </div>



  </div>

</div>

<script src="<?php echo base_url(); ?>js/slider/js/bjqs-1.3.min.js"></script> 

<script src="<?php echo base_url(); ?>js/slider/js/lightbox-2.6.min.js"></script> 


