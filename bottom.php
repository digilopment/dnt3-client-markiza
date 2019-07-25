

</div> <!-- end wrapper -->

<?php if(ENABLE_COOKIES_STRIP){?>
<script type="text/javascript">	
function hideStripCookies(thisCookie, thisTime) {
	document.getElementById(thisCookie).style.display = "none";
	setCookie(thisCookie, 1, thisTime);
}
if(getCookie("the_cookies3") != 1){ 
	document.write('<section class="container col-md-12 row"><div id="the_cookies3" class="strip_cookies text-center"><p>Aby sme Vám zaistili lepší užívateľský komfort a prispôsobili naše služby Vašim potrebám, ukladá TV Markíza na Vašom počítači, tablete alebo smartfóne súbory cookies, a to predovšetkým pre uchovanie Vášho užívateľského nastavenia, poskytovanie obsahu na mieru, obstarávanie anonymných štatistík a zacielenie obchodných oznámení. Niektoré získané informácie TV Markíza zdieľa s inými spoločnosťami (anonymné štatistiky). Niektoré informácie sú aj priamo spracovávané ďalšími spoločnosťami (personalizácia zobrazovanej reklamy) bez zásahu TV Markíza.<br>Podrobnosti o podmienkach používania súborov cookies nájdete <a class="cookies-viac" href="//osobneudaje.markiza.sk/pravidla-pouzivania-cookies" target="_blank">tu</a>. <a class="clear-cookies" href="#" onclick="hideStripCookies(\'the_cookies3\', \'525600\')"><button class="btn btn-primary">Rozumiem</button></a></p></div></section>');
}
</script>
<?php } ?>
<?php get_bottom($data); ?>