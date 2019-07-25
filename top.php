<?php
get_top($data);
?>

<body data-spy="scroll" data-target=".navbar" class="header-fixed header-fixed-space-v2 pages-id">

<?php
color_conf($data);
if($data['meta_settings']['keys']['ga_key']['show'] == 1){
	$ga_key = $data['meta_settings']['keys']['ga_key']['value'];
	?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', '<?php echo $ga_key; ?>', 'auto');
	  ga('send', 'pageview');
	</script>
	<?php
}
if($data['meta_settings']['keys']['pixel_retargeting']['show'] == 1){
?>
<noscript>
<img height="1" width="1" border="0" alt="" style="display:none" src="<?php echo $data['meta_settings']['keys']['pixel_retargeting']['value']; ?>" />
</noscript>
<?php } ?>

   <div class="wrapper">
      <!--=== Header v8 ===-->
      <div class="header-v8 header-sticky">
         <?php  get_top_lista($data); ?>
         <?php  get_nav_menu($data, 303); ?>
      </div>



		
		
