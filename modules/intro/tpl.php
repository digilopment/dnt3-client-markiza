<?php
$data = Frontend::get();
   $layout = Vendor::getLayout();
   include "dnt-view/layouts/".$layout."/tpl_functions.php";
   include "dnt-view/layouts/".$layout."/top.php"; 
   ?>
<!-- End Header -->
<?php /*get_slider($data, 303);*/ ?>
<?php /*
   <style type="text/css">
   .microslider-wrapper{
   	background: url('<?php echo Image::getFileImage($data['meta_tree']['keys']['intro_image']['value']);?>') no-repeat center center fixed; 
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-position: 0px -150px;
}
</style>
<div class="microslider-wrapper">
   <div class="page-name-wrapper">
      <span class="page-name"><span class="name"><?php echo $data['meta_tree']['keys']['intro_name']['value']; ?></span></span>
   </div>
</div>
*/?>
<style>
   .microslider-wrapper.inside-carousel{
   background: transparent;
   -webkit-background-size: cover;
   -moz-background-size: cover;
   -o-background-size: cover;
   /*background-position: 0px -150px;*/
   overflow: hidden;
   height: auto;
   max-height: initial;
   }
   .inside-carousel .carousel {
   /* margin-top: -150px;*/
   }
</style>
<div class="microslider-wrapper inside-carousel">
   <?php 
      $ids = $data['meta_tree']['keys']['intro_bg_image']['value'];
      if($data['meta_tree']['keys']['intro_perex']['show'] == 1){
        $text = $data['meta_tree']['keys']['intro_perex']['value'];
      }else{
       $text = false;
      }
      get_slider_carousel($data, "ids", $ids, "carousel1", $text); ?>
</div>
<div class="margin-bottom-60"></div>
<div class="container margin-bottom-40">
   <div class="row">
      <!-- Main Content -->
      <div class="col-md-9 main-content">
         <!-- Dynamic Item -->
         <div class="blog-grid margin-bottom-30">
            <h2 class="title-v4"><?php echo $data['meta_tree']['keys']['intro_name']['value']; ?></h2>
            <div class="overflow-h margin-bottom-10 article-view">
               <?php echo $data['article']['perex'];?>
               <?php echo $data['meta_tree']['keys']['intro_content']['value'];?>
            </div>
            <?php if($data['meta_tree']['keys']['intro_image']['show'] == 1){ ?>
            <?php 
               $ids = $data['meta_tree']['keys']['intro_image']['value'];
               get_slider_carousel($data, "ids", $ids, "carousel2", false); ?>
            <?php } ?>
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
<?php include "dnt-view/layouts/".$layout."/bottom.php"; ?>