<?php
   $layout = Vendor::getLayout();
   $data = Frontend::get();
   include "dnt-view/layouts/".$layout."/tpl_functions.php";
   include "dnt-view/layouts/".$layout."/top.php"; 
   ?>
<!-- End Header -->
<?php get_slider_main_db($data, 303, "mainslider");?>
<div class="container margin-bottom-40">
   <div class="row">
      <!-- Main Content -->
      <div class="col-md-9 main-content">
         <!-- Dynamic Item -->
         <div class="blog-grid margin-bottom-30">
            <h2 class="title-v4">Page not found</h2>
            <section class="error-404">
				<?php $imageUrl = Frontend::getDeafult($data, "media_path")."images/not-found.png";?>
				<img src="<?php echo $imageUrl; ?>" class="img-responsive">
               <h3>We're sorry. The page you are looking for cannot be found. You may have followed a broken or outdated link, or there may be an error on our site. <br/>Please try searching or going to another page</h3>
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
<?php include "dnt-view/layouts/".$layout."/bottom.php"; ?>