<?php

function color_conf($data) {
    //$color = $data['']
    //var_dump($data['meta_settings']['keys']['color']['value']);
    //$colorInverse = Dnt::colorInverse($color);

    $color = $data['meta_settings']['keys']['color']['value'];
    $colorRGBA = Dnt::hex2rgba($color, 0.85);
    $colorDarken4 = Dnt::darkenColor($color, 4);
    $colorDarken2 = Dnt::darkenColor($color, 2);
    $colorDarken2RGBA = Dnt::hex2rgba($color, 0.7);
    $reverseTextColor = "#ffffff";
    echo '<style>
   
   .strip_cookies {background: ' . $colorDarken2 . ';}
   .strip_cookies .btn-primary {background-color: ' . $color . ';border-color: ' . $colorDarken2 . ';}
   
   html body,
   .footer-v8 .footer h2,
   .carousel-caption h1,
   html body h2.title-v4{
	   font-family: "' . $data['meta_settings']['keys']['font']['value'] . '" !important;
   }
   
   .title-v4 {
       color: ' . $color . ';
   }
   .blog-grid h3 {
       color: ' . $color . ';
   }
   .header-v8 .dropdown-menu {
       border-top: solid 3px ' . $color . ';
   }
   .blog-slider span.blog-slider-badge {
       background: ' . $color . ';
   }
   a {
       color: ' . $color . ';
   }
   a:hover {
       color: ' . $colorDarken2 . ';
   }
   .btn-u {
       background: ' . $color . ';
   }
   .bg-color-darker {
       /*background-color: ' . $color . ' !important;*/
   }
   .fa{
   	 color: ' . $color . ';
   }
   
   h1,h2,h3,h4,h5,h6{
   	color: ' . $color . ';
   }
   .blog-topbar {
       background: ' . $colorDarken2 . ';
   }
   .blog-social-shares li.podmienky a{
   		color: ' . $colorDarken2 . ';
   }
   .title-v4 {
       border-bottom: 3px solid ' . $color . ';
   }
   .ms-wk .ms-slide {
       border: 2px solid ' . $color . ';
   }
   .blog-slider .blog-slider-title {
       background-color: ' . $color . ';
   }
   .dnt-form input {
       border: 1px solid ' . $colorDarken2 . ';
   }
   .dnt-form label {
       color: ' . $colorDarken2 . ';
       font-size: 14px;
   }
   .dnt-form a {
       color: ' . $colorDarken2 . ';
   }
   .dnt-form a:hover {
       color: ' . $color . ';
   }
   .main-content .thankyou-reg p{
		color: ' . $color . ';
	}
   .slider-wrap{
   	background-color: ' . $colorDarken2 . ';
   }
   .slider-wrap .text {
       background-color: ' . $colorDarken2RGBA . ';
   }
   
   .footer-v8 .copyright {
       background: ' . $colorDarken4 . ';
   }
   .footer-v8 .footer {
       background: ' . $colorDarken2 . ';
   }
   .btn-u:hover,
   .btn-u:focus,
   .btn-u:active,
   .btn-u.active,
   .open .dropdown-toggle.btn-u {
   	background: ' . $colorDarken2 . ';
   }
   .btn-u-split.dropdown-toggle {
   	border-left: solid 1px ' . $colorDarken2 . ';
   }
   
   a {
   	color: ' . $color . ';
   }
   
   .header-v8 .dropdown-menu {
   	border-top: solid 3px ' . $color . ';
   }
   .header-v8 .dropdown-menu .active > a,
   .header-v8 .dropdown-menu li > a:hover {
   	color: ' . $color . ';
   }
   .header-v8 .navbar-nav .open .dropdown-menu > li > a:hover,
   .header-v8 .navbar-nav .open .dropdown-menu > li > a:focus {
   	color: ' . $color . ';
   }
   .header-v8 .navbar-nav .open .dropdown-menu > .active > a,
   .header-v8 .navbar-nav .open .dropdown-menu > .active > a:hover,
   .header-v8 .navbar-nav .open .dropdown-menu > .active > a:focus {
   	color: ' . $color . ';
   }
   
   .header-v8 .navbar-nav .open .dropdown-menu > .disabled > a,
   .header-v8 .navbar-nav .open .dropdown-menu > .disabled > a:hover,
   .header-v8 .navbar-nav .open .dropdown-menu > .disabled > a:focus {
   	color: ' . $color . ';
   }
   .header-v8 .navbar-nav > li > a:hover {
   	color: ' . $color . ';
   }
   .header-v8 .navbar-nav > .active > a,
   .header-v8 .navbar-nav > .active > a:hover,
   .header-v8 .navbar-nav > .active > a:focus {
   	color: ' . $color . ' !important;
   }
   .header-v8 .mega-menu .mega-menu-fullwidth .dropdown-link-list li a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .column-one a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .tags-v4 a:hover {
   	border-color: ' . $color . ';
   	background-color: ' . $color . ';
   }
   .footer-v8 .footer .footer-lists li a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .latest-news h3 a:hover {
   	color: ' . $color . ';
   }
   .footer-v8 .footer .input-group-btn .input-btn {
   	background: ' . $color . ';
   }
   .footer-v8 .footer .social-icon-list li i:hover {
   	background: ' . $color . ';
   	border-color: ' . $color . ';
   }
   .blog-slider span.blog-slider-badge {
   	background: ' . $color . ';
   }
   .blog-slider .blog-slider-title h2 a:hover {
   	color: ' . $color . ';
   }
   .blog-ms-v2 .ms-thumb-frame-selected .ms-thumb h3 {
   	color: ' . $color . ';
   }
   .tab-v4 .tab-heading h2 {
   	color: ' . $color . ';
   }
   .title-v4 {
   	color: ' . $color . ';
   }
   .tab-v4 .nav-tabs > .active > a,
   .tab-v4 .nav-tabs > .active > a:hover,
   .tab-v4 .nav-tabs > .active > a:focus {
   	color: ' . $color . ';
   }
   .blog-grid h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-grid .blog-grid-info li a:hover {
   	color: ' . $color . ';
   }
   .blog-grid a.r-more {
   	color: ' . $color . ';
   }
   .blog-grid a.r-more {
   	border-bottom: 1px solid ' . $color . ';
   }
   .blog-thumb .blog-thumb-desc h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-thumb .blog-thumb-info li a:hover {
   	color: ' . $color . ';
   	text-decoration: none;
   }
   .tab-v5 .nav-tabs li.active a {
   	color: ' . $color . ';
   }
   .blog-thumb-v3 h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-video span.category-badge {
   	background: ' . $color . ';
   }
   .twitter-posts .twitter-posts-in a.link {
   	color: ' . $color . ';
   }
   .blog-social-shares li a:hover {
   	color: ' . $color . ';
   }
   .tab-v4 .nav-tabs > li > a:hover {
   	color: ' . $color . ';
   }
   .blog-cars-heading .owl-navigation .owl-btn:focus,
   .blog-cars-heading .owl-navigation .owl-btn:hover {
   	color: ' . $color . ';
   }
   .blog-cars-heading h2 {
   	color: ' . $color . ';
   }
   .blog-thumb-v4 h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-thumb-v2 .blog-thumb-desc h3 a:hover {
   	color: ' . $color . ';
   }
   .blog-thumb-v2 .blog-thumb-info li a:hover {
   	color: ' . $color . ';
   }
   .breadcrumb li.active,
   .breadcrumb li a:hover {
   	color: ' . $color . ';
   }
   .single-page-quote:after {
   	background: ' . $color . ';
   }
   .single-page-quote p {
   	color: ' . $color . ';
   }
   .source-list li a {
   	color: ' . $color . ';
   }
   .blog-grid-tags li a:hover {
   	background: ' . $color . ';
   }
   
   .btn-u.btn-u-default {
   	background: ' . $color . ';
   }
   .btn-u.btn-u-default:hover,
   .btn-u.btn-u-default:focus,
   .btn-u.btn-u-default:active,
   .btn-u.btn-u-default.active,
   .open .dropdown-toggle.btn-u.btn-u-default {
   	background: #c0392b;
   }
   .btn-u.btn-u-split-default.dropdown-toggle {
   	border-left: solid 1px #c0392b;
   }
   
   .blog-thumb .blog-thumb-hover:hover:after {
   	background: rgba(231,76,60,0.9);
   }
   #topcontrol:hover {
   	background: rgba(231,76,60,0.9);
   }
   .blog-video h4 {
   	background: rgba(231,76,60,0.8);
   }
   .blog-grid .blog-grid-grad i:hover {
   	background: rgba(231,76,60,1);
   }
   .blog-thumb-v2 .blog-thumb-grad i:hover {
   	background: rgba(231,76,60,1);
   }
   
   
   /*added in v1.9*/
   .promo-section .tp-caption.Newspaper-Subtitle, .promo-section .Newspaper-Subtitle, .promo-section .erinyen .tp-tab-title {
       color: ' . $color . ';
   }
   
   .tp-bannertimer {
   	background: ' . $color . ';
   }
   
   .carousel-caption h1{
       color: ' . $colorDarken2 . ';;
   }
   .carousel-caption h1 strong{
       padding: 5px;
   	background: ' . $color . ';
   }
   </style>';
}
?>
<?php

function get_top($data) {
    ?>
    <!DOCTYPE html>
    <!--[if IE 9]> 
    <html lang="sk" class="ie9">
       <![endif]-->
    <!--[if !IE]><!--> 
    <html lang="<?php echo Frontend::getMetaSetting($data, "language"); ?>">
        <!--<![endif]-->
        <head>
            <meta charset="utf-8">
            <title><?php echo $data['title']; ?></title>
            <?php
            foreach ($data['meta'] as $meta) {
                echo $meta;
            }
            ?>
            <meta name="author" content="designdnt">
            <meta name="viewport" content="width=device-width" />
            <?php
            $favicon = Settings::getImage($data['meta_settings']['keys']['favicon']['value']);
            ?>
            <!-- Favicone Icon -->
            <link rel="" type="img/x-icon" href="<?php echo $favicon; ?>" />
            <link rel="" type="img/png" href="<?php echo $favicon; ?>" />
            <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $favicon; ?>" />
            <!-- CSS Customization -->
            <link rel="stylesheet" href="<?php echo $data['media_path']; ?>css/bundle.css">
            <link rel="stylesheet" href="<?php echo $data['media_path']; ?>css/custom.css?<?php echo rand(10, 1000) ?>">
            <!-- Custom Web Fonts -->
			<?php
            $font = $data['meta_settings']['keys']['font']['value'];
			if($font == 'Roboto'){
				$fontStyle = "<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700'>";
			}
			elseif($font == 'Open Sans'){
				$fontStyle = "<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>";
			}
			elseif($font == 'Merriweather'){
				$fontStyle = "<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>";
			}
			elseif($font == 'Lucida Sans Unicode' || $font == 'Myriad Pro Regular' || $font == 'Times New Roman'){
				$fontStyle = "";
			}
			else{
				$fontStyle = "<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=".$font."'>";
			}
			echo $fontStyle;
            ?>
            <!-- light box -->
            <script src="<?php echo $data['media_path']; ?>js/lightbox-plus-jquery.min.js"></script>
            <script src="<?php echo $data['media_path']; ?>js/jquery.min.js"></script>
            <script src="<?php echo $data['media_path']; ?>js/jquery.validate.js"></script>
            <script src="<?php echo $data['media_path']; ?>js/additional-methods.min.js"></script>
            <script src="<?php echo $data['media_path']; ?>js/cookies.js"></script> <!-- Gem jQuery -->
        </head>
    <?php } ?><?php

    function get_bottom($data) {
        ?>
        <!-- JS Global Compulsory -->
        <script src="<?php echo $data['media_path']; ?>js/jquery-migrate.min.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/bootstrap.min.js"></script>
        <!-- JS Implementing Plugins -->
        <script src="<?php echo $data['media_path']; ?>js/back-to-top.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/smoothScroll.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/waypoints.min.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/jquery.counterup.min.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/jquery.fancybox.pack.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/owl.carousel.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/masterslider.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/jquery.easing.min.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/modernizr.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/main.js"></script> <!-- Gem jQuery -->
        <!-- JS Customization -->
        <script src="<?php echo $data['media_path']; ?>js/custom.js"></script>
        <!-- JS Page Level -->
        <script src="<?php echo $data['media_path']; ?>js/app.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/fancy-box.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/owl-carousel.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/master-slider-showcase1.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/style-switcher.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script type="text/javascript">
            $('.carousel').carousel({
                pause: true,
                interval: false
            });
            jQuery(document).ready(function () {
                App.init();
                App.initCounter();
                FancyBox.initFancybox();
                OwlCarousel.initOwlCarousel();
                OwlCarousel.initOwlCarousel2();
                StyleSwitcher.initStyleSwitcher();
                MasterSliderShowcase1.initMasterSliderShowcase1();
            });
        </script>
    </body>
    </html>
<?php } ?><?php

function get_top_lista($data) {
    $multylanguage = new MultyLanguage;
    $db = new Db;
    $webhook = new Webhook;
    $rest = new Rest;
    $searchUrl = $webhook->getSitemapModules("search");
    ?>
    <div class="blog-topbar">
        <div class="topbar-search-block">
            <div class="container">
                <form action="<?php echo $searchUrl[0] ?>">
                    <input type="text" name="q" class="form-control" 
                           placeholder="<?php echo MultyLanguage::translate($data, "text_to_search", "translate"); ?>">
                    <div class="search-close"><i class="fa fa-times" aria-hidden="true"></i></div>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-xs-8">
                    <div class="jazyky">
                        <ul>
                            <li><a href="<?php echo WWW_PATH; ?>"><i class="fa fa-2x fa-home"></i></a></li>
                            <?php
							//var_dump($data['post_id']);
                            $lngArr = MultyLanguage::activeVendorLangs();
                            if (count($lngArr) > 1) {
                                foreach (MultyLanguage::activeVendorLangs() as $lg) {
                                    $urlLg = WWW_PATH . "" . $lg . "/a/" . $data['post_id'];
                                    ?>
                                    <li>
                                        <a href="<?php echo $urlLg; ?>" >
                                            <img src="<?php echo $data['media_path']."/images/flags/flag_" . $lg . ".png"; ?>" alt="<?php echo $lg; ?>"></a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4 clearfix">
                    <i class="fa fa-search search-btn pull-right"></i> 
                    <?php /* <ul class="topbar-list topbar-log_reg pull-right visible-sm-block visible-md-block visible-lg-block">
                      <li class="cd-log_reg home"><a class="cd-signin" href="javascript:void(0);"><?php echo $translate['prihlasit'];?></a></li>
                      </ul> */ ?>
                </div>
            </div>
            <!--/end row-->
        </div>
        <!--/end container-->
    </div>
    <!-- End Topbar blog -->
<?php } ?><?php

function get_nav_menu($data) {
    $multylanguage = new MultyLanguage;
    $article = new ArticleView;
    $rest = new Rest;
    $db = new Db;
    ?>	
    <!-- Navbar -->
    <div class="navbar mega-menu" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="res-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                    <?php
                    $logo_firmy = Settings::getImage($data['meta_settings']['keys']['logo_firmy']['value']);
                    $logo_firmy_2 = Settings::getImage($data['meta_settings']['keys']['logo_firmy_2']['value']);
                    $logo_firmy_3 = Settings::getImage($data['meta_settings']['keys']['logo_firmy_3']['value']);

                    $logo_url = $data['meta_settings']['keys']['logo_url']['value'];
                    $logo_url_2 = $data['meta_settings']['keys']['logo_url_2']['value'];
                    $logo_url_3 = $data['meta_settings']['keys']['logo_url_3']['value'];
                    ?>
                    <?php if ($data['meta_settings']['keys']['logo_firmy']['show'] == 1) { ?>
                        <a target="_blank" href="<?php echo $logo_url ?>">
                            <img class="logo" src="<?php echo $logo_firmy; ?>" alt="Logo">
                        </a>
                    <?php } ?>
                    <?php if ($data['meta_settings']['keys']['logo_firmy_2']['show'] == 1) { ?>
                        <a target="_blank" href="<?php echo $logo_url_2; ?>">
                            <img class="logo" src="<?php echo $logo_firmy_2; ?>" alt="Logo">
                        </a>
                    <?php } ?>
                    <?php if ($data['meta_settings']['keys']['logo_firmy_3']['show'] == 1) { ?>
                        <a target="_blank" href="<?php echo $logo_url_3; ?>">
                            <img class="logo" src="<?php echo $logo_firmy_3; ?>" alt="Logo">
                        </a>
                    <?php } ?>
                </div>
            </div>
            <!--/end responsive container-->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <div class="res-container">
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <?php
                        foreach (Navigation::getParents() as $row) {
                            //$name_url_1 = $article->getPostParam("name_url", $row['id_entity'], false);
                            $name_url_1 = $row['name_url'];
                            ?>
                            <li class="dropdown home <?php
                            if ($article->getPostParam("name_url", $row['id_entity']) == $rest->webhook(1)) {
                                echo "active";
                            }
                            ?> ">
                                <?php if ($row['name_url'] == "no_url") { ?>
                                    <a><?php echo $article->getPostParam("name", $row['id_entity']); ?></a>
                                <?php } else { ?>
                                    <a  href="<?php echo $name_url_1; ?>"><?php echo $article->getPostParam("name", $row['id_entity']); ?></a>
                                    <?php } ?>
                                    <?php if (Navigation::hasChild($row['id_entity'])) { ?>
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach (Navigation::getChildren($row['id_entity']) as $row2) {
                                            //$name_url_2 = $article->getPostParam("name_url", $row2['id_entity'], false);
                                            $name_url_2 = $row2['name_url'];
                                            ?>
                                            <li class="<?php
                                                if ($article->getPostParam("name_url", $row['id_entity']) == $rest->webhook(1)) {
                                                    echo "active";
                                                }
                                                ?>"><a href="<?php echo $name_url_2; ?>"><?php echo $article->getPostParam("name", $row2['id_entity']); ?></a></li>
                                            <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!--/responsive container-->
            </div>
            <!--/navbar-collapse-->
        </div>
        <!--/end contaoner-->
    </div>
    <!-- End Navbar -->
    <?php } ?><?php
    
    function get_footer($data) { ?>
    <!--=== Footer v8 ===-->
    <div class="footer-v8">
        <?php
        $fbPage = $data['meta_settings']['keys']['facebook_page_sw']['value'];
        $fbPost = $data['meta_settings']['keys']['facebook_post_sw']['value'];
        $fbWidht = "400";
        $fbHeight = "600";

        $instaEmbed = $data['meta_settings']['keys']['instagram_sw']['value'];
        $youtubeEmbed = $data['meta_settings']['keys']['youtube_sw']['value'];
        $twitterEmbedCode = $data['meta_settings']['keys']['twitter_sw']['value'];

        $dataSwArr = array(
            $data['meta_settings']['keys']['facebook_page_sw']['show'],
            $data['meta_settings']['keys']['facebook_post_sw']['show'],
            $data['meta_settings']['keys']['instagram_sw']['show'],
            $data['meta_settings']['keys']['youtube_sw']['show'],
            $data['meta_settings']['keys']['twitter_sw']['show'],
        );

        $x = 0;
        foreach ($dataSwArr as $swValue) {
            $x += $swValue;
        }

        if ($x == 1) {
            $colMdSocialWall = 12;
            $wrappWidth = 25;
        } elseif ($x == 2) {
            $colMdSocialWall = 6;
            $wrappWidth = 50;
        } elseif ($x == 3) {
            $colMdSocialWall = 4;
            $wrappWidth = 75;
        } elseif ($x == 4) {
            $colMdSocialWall = 3;
            $wrappWidth = 100;
        } elseif ($x == 5) {
            $colMdSocialWall = "3 width20";
            $wrappWidth = 100;
        }
        ?>
                <?php if ($x > 0) { ?>
            <style>.social-wall .wrapp{margin: 0px auto;width: <?php echo $wrappWidth; ?>%;}</style>
            <section class="social-wall">
                <div class="row wrapp">
                    <?php if ($data['meta_settings']['keys']['facebook_page_sw']['show'] == 1) { ?>
                        <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                            <iframe src="https://www.facebook.com/plugins/page.php?href=<?php echo $fbPage; ?>&tabs=timeline&width=<?php echo $fbWidht; ?>&height=<?php echo $fbHeight; ?>&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                        </div>
                    <?php } ?>
                    <?php if ($data['meta_settings']['keys']['facebook_post_sw']['show'] == 1) { ?>
                        <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                            <iframe src="https://www.facebook.com/plugins/post.php?href=<?php echo $fbPost; ?>&tabs=timeline&width=<?php echo $fbWidht; ?>&height=<?php echo $fbHeight; ?>&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                        </div>
                    <?php } ?>
                    <?php if ($data['meta_settings']['keys']['instagram_sw']['show'] == 1) { ?>
                        <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                            <iframe src="<?php echo $instaEmbed; ?>"  style="" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                        </div>
                    <?php } ?>
                    <?php if ($data['meta_settings']['keys']['youtube_sw']['show'] == 1) { ?>
                        <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                            <iframe src="<?php echo $youtubeEmbed; ?>"  style="" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                        </div>
                    <?php } ?>
                    <?php if ($data['meta_settings']['keys']['twitter_sw']['show'] == 1) { ?>
                        <div class="col-md-<?php echo $colMdSocialWall; ?> item">
                <?php echo $twitterEmbedCode; ?>
                        </div>
        <?php } ?>
                </div>
            </section>
    <?php } ?>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-6 column-one md-margin-bottom-50">
                        <h2>Menu</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="mini-menu">
                                    <?php
                                    foreach ($data['menu_items'] as $item) {
                                        $name_url_1 = $item['name_url'];
                                        $name_1 = $item['name'];
                                        ?>
                                        <li class=" ">
                                            <a  href="<?php echo $name_url_1; ?>"><?php echo $name_1; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h2><?php echo Multylanguage::translate($data, "socialne_siete", "translate"); ?></h2>
                        <!-- Social Icons -->
                        <ul class="social-icon-list margin-bottom-20">
                                <?php if ($data['meta_settings']['keys']['facebook_page']['show'] == 1) { ?>
                                <li>
                                    <a href="<?php echo $data['meta_settings']['keys']['facebook_page']['value'] ?>" target="_blank">
                                        <i class="rounded-x  fa fa-facebook"></i> 
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if ($data['meta_settings']['keys']['twitter']['show'] == 1) { ?>
                                <li>
                                    <a href="<?php echo $data['meta_settings']['keys']['twitter']['value'] ?>" target="_blank">
                                        <i class="rounded-x  fa fa-twitter"></i>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if ($data['meta_settings']['keys']['linked_in']['show'] == 1) { ?>
                                <li>
                                    <a href="<?php echo $data['meta_settings']['keys']['linked_in']['value'] ?>" target="_blank">
                                        <i class="rounded-x  fa fa-linkedin"></i> 
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if ($data['meta_settings']['keys']['google_plus']['show'] == 1) { ?>
                                <li>
                                    <a href="<?php echo $data['meta_settings']['keys']['google_plus']['value'] ?>" target="_blank">
                                        <i class="rounded-x  fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if ($data['meta_settings']['keys']['youtube_channel']['show'] == 1) { ?>
                                <li>
                                    <a href="<?php echo $data['meta_settings']['keys']['youtube_channel']['value'] ?>" target="_blank">
                                        <i class="rounded-x  fa fa-youtube"></i>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if ($data['meta_settings']['keys']['instagram']['show'] == 1) { ?>
                                <li>
                                    <a href="<?php echo $data['meta_settings']['keys']['instagram']['value'] ?>" target="_blank">
                                        <i class="rounded-x  fa fa-instagram"></i>
                                    </a>
                                </li>
                                <?php } ?>	
                        </ul>
                        <!-- End Social Icons -->
                    </div>
                </div>
                <!--/end row-->
            </div>
            <!--/end container-->
        </footer>
        <footer class="copyright">
            <div class="container">
                <ul class="list-inline terms-menu">
                    <li>
                        <a href="<?php echo WWW_PATH ?>">
                         <?php echo Multylanguage::translate($data, "footer_signature", "translate"); ?> <?php echo date("Y"); ?>
                        </a>
                    </li>
                        <?php if ($data['meta_settings']['keys']['impressum']['show'] == 1) { ?>						
                        <li>
                            <a href="<?php echo $data['meta_settings']['keys']['impressum']['value'] ?>" target="_blank">
                        <?php echo Multylanguage::translate($data, "impressum", "translate"); ?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($data['meta_settings']['keys']['data_protection']['show'] == 1) { ?>
                        <li>
                            <a href="<?php echo $data['meta_settings']['keys']['data_protection']['value'] ?>" target="_blank">
                                <?php echo Multylanguage::translate($data, "data_protection", "translate"); ?>
                            </a>
                        </li>
                        <?php } ?>
                </ul>
            </div>
            <!--/end container-->
        </footer>
    </div>
    <!--=== End Footer v8 ===-->
<?php } ?><?php

function col_right($data) { ?>
    <!-- Blog Thumb v3 -->
    <div class="margin-bottom-50 dalsie-info">
        <h2 class="title-v4 ">Menu</h2>
        <div class="blog-thumb-v3">
            <ul class="col-right pdc">
                <?php
                foreach ($data['menu_items'] as $item) {
                    $name_url_1 = $item['name_url'];
                    $name_1 = $item['name'];
                    ?>
                    <li>
                        <a href="<?php echo $name_url_1; ?>"><?php echo $name_1; ?></a>
                    </li>
                <?php } ?>
                <!-- vyskum a vyvoj --> 
            </ul>
        </div>
        <hr class="hr-xs">
    </div>
    <!-- nastrojaren -->
    <div class="margin-bottom-50 dalsie-info">
        <h2 class="title-v4 "><?php echo Multylanguage::translate($data, "partneri", "translate"); ?></h2>
        <div class="blog-thumb-v3">
            <ul class="logos">
                <?php
                $logo_firmy = Settings::getImage($data['meta_settings']['keys']['logo_firmy']['value']);
                $logo_firmy_2 = Settings::getImage($data['meta_settings']['keys']['logo_firmy_2']['value']);
                $logo_firmy_3 = Settings::getImage($data['meta_settings']['keys']['logo_firmy_3']['value']);

                $logo_url = $data['meta_settings']['keys']['logo_url']['value'];
                $logo_url_2 = $data['meta_settings']['keys']['logo_url_2']['value'];
                $logo_url_3 = $data['meta_settings']['keys']['logo_url_3']['value'];
                ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy']['show'] == 1) { ?>
                    <li>
                        <a target="_blank" href="<?php echo $logo_url; ?>">
                            <img class="img-responsive" src="<?php echo $logo_firmy; ?>" alt="logo" />
                        </a>
                    </li>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy_2']['show'] == 1) { ?>
                    <li>
                        <a target="_blank" href="<?php echo $logo_url_2; ?>">
                            <img class="img-responsive" src="<?php echo $logo_firmy_2; ?>" alt="logo" />
                        </a>
                    </li>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy_3']['show'] == 1) { ?>
                    <li >
                        <a target="_blank" href="<?php echo $logo_url_3; ?>">
                            <img class="img-responsive" src="<?php echo $logo_firmy_3; ?>" alt="logo" />
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="margin-bottom-50 dalsie-info">
        <h2 class="title-v4 "><?php echo Multylanguage::translate($data, "registracia", "translate"); ?></h2>
        <div class="blog-thumb-v3">
            <ul class="col-right logos">
                <li>
                    <a href="<?php echo Rest::getModulUrl("registracia"); ?>"><span class="btn-u"><?php echo Multylanguage::translate($data, "registracia", "translate"); ?></span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Blog Thumb v3 -->
    <!-- Social Shares -->
    <div class="margin-bottom-50">
        <h2 class="title-v4"><?php echo Multylanguage::translate($data, "pravidla_sutaze", "translate"); ?></h2>
        <ul class="blog-social-shares">
            <?php
            $webhook = new Webhook;

            $name_url = $webhook->getSitemapModules("registracia");
            $regId = ArticleView::StaticViewParam("id_entity", $name_url[0]);
            $customRegData = Frontend::get(false, $regId);
            $pdfId = $customRegData['meta_tree']['keys']['form_file_podmienky_1']['value'];
            if ($customRegData['meta_tree']['keys']['form_file_podmienky_1']['show'] == 1) {
                ?>
                <li class="podmienky">
                    <a href="<?php echo Image::getFileImage($pdfId) ?>" target="_blank">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i><?php echo Multylanguage::translate($data, "suhlas_s_podmienkami_1", "translate"); ?>
                    </a>
                </li>
            <?php } ?>
            <?php /*
               <?php if($data['meta_settings']['keys']['facebook_page']['show'] == 1){?>
            <li>
               <a href="<?php echo $data['meta_settings']['keys']['facebook_page']['value'] ?>" target="_blank">
               <i class="rounded-x fb fa fa-facebook"></i> Facebook
               </a>
            </li>
            <?php } ?>
            <?php if($data['meta_settings']['keys']['twitter']['show'] == 1){?>
            <li>
               <a href="<?php echo $data['meta_settings']['keys']['twitter']['value'] ?>" target="_blank">
               <i class="rounded-x tw fa fa-twitter"></i>Twitter
               </a>
            </li>
            <?php } ?>
            <?php if($data['meta_settings']['keys']['linked_in']['show'] == 1){?>
            <li>
               <a href="<?php echo $data['meta_settings']['keys']['linked_in']['value'] ?>" target="_blank">
               <i class="rounded-x li fa fa-linkedin"></i> LinkedIn
               </a>
            </li>
            <?php } ?>
            <?php if($data['meta_settings']['keys']['google_plus']['show'] == 1){?>
            <li>
               <a href="<?php echo $data['meta_settings']['keys']['google_plus']['value'] ?>" target="_blank">
               <i class="rounded-x gp fa fa-google-plus"></i>Google Plus
               </a>
            </li>
            <?php } ?>
            <?php if($data['meta_settings']['keys']['youtube_channel']['show'] == 1){?>
            <li>
               <a href="<?php echo $data['meta_settings']['keys']['youtube_channel']['value'] ?>" target="_blank">
               <i class="rounded-x yt fa fa-youtube"></i>Youtube
               </a>
            </li>
            <?php } ?>
            <?php if($data['meta_settings']['keys']['instagram']['show'] == 1){?>
            <li>
               <a href="<?php echo $data['meta_settings']['keys']['instagram']['value'] ?>" target="_blank">
               <i class="rounded-x ig fa fa-instagram"></i>Instagram
               </a>
            </li>
            <?php } ?>
            */ ?>
        </ul>
    </div>
    <!-- End Social Shares -->
    <!-- Blog Carousel Heading -->
<?php } ?><?php

function get_slider_carousel($data, $dataType, $ids, $name, $text) {
    //$GALLERY = explode(",", $data['meta_tree']['keys']['galeria_1']['value']);
    $GALLERY = explode(",", $ids);
    $PHOTOS = array();
    if ($dataType == "ids") {
        foreach ($GALLERY as $item) {
            $PHOTOS[] = Image::getFileImage($item);
        }
    } else {
        $db = new Db;
        $article = new ArticleView;
        $query = "SELECT * FROM dnt_posts WHERE type = 'post' AND 
      		cat_id = '" . $ids . "' AND vendor_id = '" . Vendor::getId() . "'";
        if ($db->num_rows($query) > 0) {
            foreach ($db->get_results($query) as $row) {
                $PHOTOS[] = $article->getPostImage($row['id_entity']);
            }
        }
    }
    ?>
    <div id="<?php echo $name; ?>" class="carousel slide" data-ride="carousel" data-interval="false">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            foreach ($PHOTOS as $index => $photo) {
                ?>
                <li data-target="#<?php echo $name; ?>" data-slide-to="<?php echo $i; ?>" class="<?php
                    if ($i == 0) {
                        echo "active";
                    }
                    ?>"></li>
                <?php
                $i++;
            }
            ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $j = 0;
            foreach ($PHOTOS as $index => $photo) { ?>
              <div class="item <?php
                   if ($j == 0) {
                       echo "active";
                   }
                   ?>">
                  <img src="<?php echo $photo; ?>" alt="Los Angeles">
                  <?php if ($text) { ?>
                      <div class="carousel-caption d-none d-md-block">
                          <h1><?php echo $text ?></h1>
                      </div>
                  <?php } ?>
              </div>
               <?php $j++;
            }
            ?>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#<?php echo $name; ?>" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#<?php echo $name; ?>" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php
}

function get_slider_main_ids($data, $dataType, $ids, $name) {
    //$GALLERY = explode(",", $data['meta_tree']['keys']['galeria_1']['value']);
    $GALLERY = explode(",", $ids);
    $PHOTOS = array();
    if ($dataType == "ids") {
        foreach ($GALLERY as $item) {
            $PHOTOS[] = Image::getFileImage($item);
        }
    } else {
        $db = new Db;
        $article = new ArticleView;
        $query = "SELECT * FROM dnt_posts WHERE type = 'post' AND 
      		cat_id = '" . $ids . "' AND vendor_id = '" . Vendor::getId() . "'";
        if ($db->num_rows($query) > 0) {
            foreach ($db->get_results($query) as $row) {
                $PHOTOS[] = $article->getPostImage($row['id_entity']);
            }
        }
    }
    ?>
    <div class="slider-wrap">
        <div class="container">
            <div class="col-md-12">
                <div class="dnt-carousel-slider carousel slide" id="<?php echo $name; ?>">
                    <div class="carousel-inner">
                    <?php
                    $j = 0;
                    foreach ($PHOTOS as $index => $photo) {
                        ?>
                        <div class="item <?php
                        if ($j == 0) {
                            echo "active";
                        }
                        ?>">
                            <div class="col-md-6 col-xs-12">
                                <div class="wrap">
                                    <a href="#">
                                        <div class="text">Ahoj toto je test<br/><span class="description">Tak vyplňte súťažný formulár a budete automaticky zapojený do žrebovania o jeden z 2 letných pobytov</span></div>
                                        <img src="<?php echo $photo; ?>" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $j++;
                    }
                    ?>
                    </div>
                    <a class="left carousel-control" href="#<?php echo $name; ?>" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#<?php echo $name; ?>" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#<?php echo $name; ?>').carousel({
                interval: 10000
            })

            $('.dnt-carousel-slider.carousel .item').each(function () {
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                /*if (next.next().length>0) {
                 next.next().children(':first-child').clone().appendTo($(this));
                 }
                 else {
                 $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
                 }
                 */
            });
        });
    </script>
    <?php
}

function get_slider_main_db($data, $ids, $name) {
    $multylanguage = new MultyLanguage;
    $article = new ArticleView;
    $db = new Db;

    $query = "SELECT * FROM dnt_posts WHERE type = 'post' AND cat_id = '" . $ids . "' AND vendor_id = '" . Vendor::getId() . "' AND `show` > 0";

    if ($db->num_rows($query) > 0) {
        ?>
        <div class="slider-wrap">
            <div class="container">
                <div class="col-md-12">
                    <div class="dnt-carousel-slider carousel slide" id="<?php echo $name; ?>">
                        <div class="carousel-inner">
                            <?php
                            $j = 0;
                            foreach ($db->get_results($query) as $row) {
                                if (Dnt::is_external_url($row['name_url'])) {
                                    $nameUrl = $row['name_url'];
                                } else {
                                    $nameUrl = false;
                                }
                                $image = $article->getPostImage($row['id_entity'], false, Image::MEDIUM);
                                $perex = Dnt::not_html($row['perex']);
                                $content = Dnt::not_html($row['content']);
                                ?>
                                <div class="item <?php
                                if ($j == 0) {
                                    echo "active";
                                }
                                ?>">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="wrap">
                                            <a target="_blank" href="<?php echo $nameUrl ?>">
                                                <?php if ($perex || $content) { ?>
                                                    <div class="text"><?php echo $perex; ?><br/><span class="description"><?php echo $content; ?></span></div>
                                                <?php } ?>
                                                <img src="<?php echo $image; ?>" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $j++;
                            }
                            ?>
                        </div>
                        <a class="left carousel-control" href="#<?php echo $name; ?>" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#<?php echo $name; ?>" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#<?php echo $name; ?>').carousel({
                    interval: 10000
                })

                $('.dnt-carousel-slider.carousel .item').each(function () {
                    var next = $(this).next();
                    if (!next.length) {
                        next = $(this).siblings(':first');
                    }
                    next.children(':first-child').clone().appendTo($(this));
                });
            });
        </script>
        <?php
    }
}

function get_slider($data) {
    ?>
    <?php
    $multylanguage = new MultyLanguage;
    $article = new ArticleView;
    $db = new Db;
    $query = "SELECT * FROM dnt_posts WHERE type = 'post' AND cat_id = '" . AdminContent::getCatId("sliders") . "' AND vendor_id = '" . Vendor::getId() . "' AND `show` > 0";
    if ($db->num_rows($query) > 0) {
        ?>
        <!--<style>
            @media screen and (-webkit-min-device-pixel-ratio:0)
            and (min-resolution:.001dpcm) {
                .blog-ms-v1.content-sm.bg-color-darker.margin-bottom-60{
                    zoom: 0.7;
                }
            }
        </style>-->
        <!-- Master Slider -->
        <div class="blog-ms-v1 content-sm bg-color-darker margin-bottom-60">
            <div class="master-slider ms-skin-default" id="masterslider">
        <?php
        foreach ($db->get_results($query) as $row) {
            if (Dnt::is_external_url($row['name_url'])) {
                $nameUrl = $row['name_url'];
            } else {
                $nameUrl = false;
            }
            $image = $article->getPostImage($row['id_entity']);
            ?>
                <div class="ms-slide blog-slider">
                    <img src="<?php echo $image; ?>" data-src="<?php echo $image; ?>" alt="lorem ipsum dolor sit"/>
                    <span class="blog-slider-badge" 
                    <?php if ($nameUrl) { ?> onclick="location.href = '<?php echo $nameUrl ?>';" <?php } ?>  ><?php echo $row['name']; ?></span>
                    <div class="ms-info"></div>
                    <div class="blog-slider-title">
                    <?php if ($nameUrl) { ?>
                    <a target="_blank" href="<?php echo $nameUrl; ?>">
                        <h2><?php echo $row['perex']; ?></h2>
                    </a>
                    <?php } else { ?>
                    <h2><?php echo $row['perex']; ?></h2>
                    <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- END Master Slider -->
    <?php } ?>
<?php } ?>
<?php

function get_paralax($image, $name) { ?>
    <style>
        .microslider-wrapper{
            background: url('<?php echo $image; ?>') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        }
    </style>
    <div class="microslider-wrapper">
        <div class="page-name-wrapper">
            <span class="page-name"><span class="name"><?php echo $name; ?></span></span>
        </div>
    </div>
<?php } ?>