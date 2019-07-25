<?php
$data = Frontend::get();
   $layout = Vendor::getLayout();
   include "dnt-view/layouts/" . $layout . "/tpl_functions.php";
   include "dnt-view/layouts/" . $layout . "/top.php";
   ?>
<!-- End Header -->
<?php get_slider_main_db($data, 303, "mainslider"); ?>
<?php
   /* get_slider($data, 303); */
   
   $RAW_DATA = $data['meta_tree']['keys'];
   $HOTELY = array();
   foreach ($RAW_DATA as $key => $item) {
       if (Dnt::in_string("hotel_name", $key)) {
           $HOTELY[] = $item['show'];
       }
   }
   $COUNT_HOTEL = count($HOTELY);
   ?>
<div class="container margin-bottom-40">
   <div class="row">
      <!-- Main Content -->
      <div class="col-md-9 main-content">
         <!-- Dynamic Item -->
         <div class="blog-grid margin-bottom-30">
            <h2 class="title-v4"><?php echo $data['article']['name']; ?></h2>
            <section class="hotely">
               <?php for ($i = 1; $i <= $COUNT_HOTEL; $i++) { ?>
               <!-- about-me section-->
               <?php if ($data['meta_tree']['keys']['id_' . $i . '_hotel_name']['show'] == 1) { ?>
               <article class="item">
                  <div class="containers">
                     <div class="row">
                        <div class="col-md-5 row miniy-gallery">
                           <?php
                              $GALLERY = explode(",", $data['meta_tree']['keys']['id_' . $i . '_image_1']['value']);
                              $PHOTOS = array();
                              
                              $j = 1;
                              foreach ($GALLERY as $item) {
                                  if ($j == 1) {
                                      $class = "first";
                                  } else {
                                      $class = "other";
                                  }
                                  $img = Image::getFileImage($item);
                                  echo '<a class="example-image-link" href="' . $img . '" data-lightbox="gallery-' . $i . '">';
                                  echo '<img class="modul-image img-responsive ' . $class . '" src="' . $img . '">';
                                  echo '</a>';
                                  $j++;
                              }
                              ?>
                           <?php if ($data['meta_tree']['keys']['id_' . $i . '_text_2']['show'] == 1) { ?>
                           <div class="row dnt-progress">
                              <?php echo $data['meta_tree']['keys']['id_' . $i . '_text_2']['value'] ?> 
                           </div>
                           <?php } ?>
                        </div>
                        <div class="col-md-7">
						   <?php if ($data['meta_tree']['keys']['id_' . $i . '_hotel_name']['value']) { ?>
							<h2 class="mb-15"><?php echo $data['meta_tree']['keys']['id_' . $i . '_hotel_name']['value'] ?></h2>
						   <?php } ?>
                           <?php echo $data['meta_tree']['keys']['id_' . $i . '_text']['value'] ?>
                        </div>
                     </div>
                     <div class="row service-boxes">
                        <?php if ($data['meta_tree']['keys']['id_' . $i . '_hotel_name']['show'] == 1) { ?>
                        <div class="col-lg-3 col-md-6 col-xs-6 text-center">
                           <div class="service-box">
                              <?php /* <i class="fa fa-2x fa-heart wow bounceIn" style="visibility: visible; animation-name: bounceIn;"></i> */ ?>
                              <h3></h3>
                              <p class="text-muted"><?php echo $data['meta_tree']['keys']['id_' . $i . '_hotel_name']['value']; ?></p>
                           </div>
                        </div>
                        <?php } ?>
                        <?php if ($data['meta_tree']['keys']['id_' . $i . '_adresa']['show'] == 1) { ?>
                        <div class="col-lg-3 col-md-6 col-xs-6 text-center">
                           <div class="service-box">
                              <?php /* <i class="fa fa-2x fa-location-arrow wow bounceIn" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: bounceIn;"></i> */ ?>
                              <h3></h3>
                              <p class="text-muted"><?php echo $data['meta_tree']['keys']['id_' . $i . '_adresa']['value']; ?></p>
                           </div>
                        </div>
                        <?php } ?>
                        <?php if ($data['meta_tree']['keys']['id_' . $i . '_tel_c']['show'] == 1) { ?>
                        <div class="col-lg-3 col-md-6 col-xs-6 text-center">
                           <div class="service-box">
                              <?php /* <i class="fa fa-2x fa-paper-plane-o wow bounceIn" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"></i> */ ?>
                              <h3></h3>
                              <p class="text-muted">
                                 <?php echo $data['meta_tree']['keys']['id_' . $i . '_tel_c']['value']; ?>
                              </p>
                           </div>
                        </div>
                        <?php } ?>
                        <?php if ($data['meta_tree']['keys']['id_' . $i . '_web']['show'] == 1) { ?>
                        <div class="col-lg-3 col-md-6 col-xs-6 text-center">
                           <div class="service-box">
                              <?php /* <i class="fa fa-2x fa-globe wow bounceIn" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: bounceIn;"></i> */ ?>
                              <h3></h3>
                              <p class="text-muted"><a target="_blank" href="<?php echo $data['meta_tree']['keys']['id_' . $i . '_web']['value']; ?>">
                                 <?php echo Dnt::linkFormat($data['meta_tree']['keys']['id_' . $i . '_web']['value']); ?>
                                 </a>
                              </p>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
               </article>
               <?php } ?>
               <?php } ?>
               <!-- end of about-me section-->
            </section>
         </div>
      </div>
      <!-- Right Sidebar -->
      <div class="col-md-3">
         <?php col_right($data); ?>
      </div>
      <!-- End Right Sidebar -->
   </div>
</div>
<?php get_footer($data); ?>
<?php include "dnt-view/layouts/" . $layout . "/bottom.php"; ?>