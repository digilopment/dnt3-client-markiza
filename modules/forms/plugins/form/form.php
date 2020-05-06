<?php
$data = Frontend::get();
$FORM_BASE_VALUE = array();
foreach (array_keys($data['meta_tree']['keys']) as $key) {
    if (Dnt::in_string("form_base", $key)) {
        if ($data['meta_tree']['keys'][$key]['show'] == 1) {
            $keyName = str_replace('form_base_', '', $key);
            $keyName = str_replace('name', 'meno', $keyName);
            $keyName = str_replace('surmeno', 'priezvisko', $keyName);
            $FORM_BASE_VALUE[$keyName] = $data['meta_tree']['keys'][$key];
        }
    }
}

$accept = ($data['meta_tree']['keys']['white_list_extensions']['show'] == 1) ? $data['meta_tree']['keys']['white_list_extensions']['value'] : false;
$arrayExtension = [
    'image' => 'jpg,jpeg,jpe,jif,jfif,jfi,png,gif,webp,tiff,tif,psd,raw,arw,cr2,nrw,k25,bmp,dib,heif,heic,ind,indd,indt,jp2,j2k,jpf,jpx,jpm,mj2,svg,svgz,ai,eps,pdf',
    'video' => 'webm,mpg,mp2,mpeg,mpe,mpv,ogg,mp4,m4p,m4v,avi,wmv,mov,qt,flv,swf,avchd,m4a,f4v,f4a,m4b,m4r,f4b,3gp,3gp2,3g2,3gpp,3gpp2,oga,ogv,ogx,wma'
];
$final = [];
foreach (explode(',', str_replace('-', ',', Dnt::name_url($accept))) as $format) {
    if (in_array($format, array_keys($arrayExtension))) {
        $final[] = $arrayExtension[$format];
    }
}
$extensions = join(',', $final);
?>
<style>      
.registration_form .progressUpload h4{
    padding: 15px 0px;
}
.registration_form .progressUpload .progress {
    margin: 0px;
    box-shadow: 0px 0px 0px #ffffff;
    height: 30px;
    background: #fff;
    border-radius: 2px;
    border: 1px solid #ff5718;
}
.registration_form .progressUpload .progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 14px;
    padding: 5px;
    color: #fff;
    text-align: center;
    background-color: #ff5718;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;
}

/*
.registration_form .loader {
	border: 16px solid #f3f3f3;
	border-top: 16px solid #ff5718;
	border-radius: 50%;
	width: 120px;
	height: 120px;
	animation: spin 2s linear infinite;
	margin: 0px auto;
	margin-top: 80px;
	margin-bottom: 80px;
        display: none;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
*/
</style>
<script src="http://sbg-corialsk-11-2019.localhost/dnt3-winprizes/dnt-view/layouts/team4tourism-tpl1/js/additional-methods.min.js"></script>
<!-- EMBED BEGIN -->
<?php  ob_start(); ?>
<p entity_part="5329" rel="editable">
   <img id="a501_image:ID=2328498:ID_format=3" src="https://static.markiza.sk/a501/image/file/3/1759/02kl.bona_jpg.jpg" alt="Krajšia terasa s Teleránom" crop="" event="" class="a501_image" align="" width="" height="">
   <?php echo $data['meta_tree']['keys']['perex']['value']; ?>
</p>
<hr>
<p entity_part="4462" rel="editable" align="justify">
  <?php echo $data['meta_tree']['keys']['content']['value']; ?>
</p>
<p entity_part="3835" rel="editable" align="justify">
   Tešíme sa na vás!
   Výhercovia budú vybraní a kontaktovaní na základe výberu internej komisie organizátora.<br/>
</p>
<script>
$(document).ready(function() {
 $(".checkbox-line").css("border-bottom", "1px solid #eee");
 $(".checkbox-line").last().css("border", "0px");
 
 function showProgress(percentage){
     if(percentage > 0){
         var html = '';
         $(".progressUpload").html(html);
         if (percentage < 100){
            html += '<h4>Spracúvam údaje, uploadujem súbory. Prosím počkajte...</h4>';
         }else{
            html += '<h4>Údaje sme úspešne prijali.</h4>';   
         }
         html += '<div class="progress">';
            html += '<div class="progress-bar" role="progressbar" aria-valuenow="'+percentage+'" aria-valuemin="0" aria-valuemax="100" style="width:'+percentage+'%">';
              html += ''+percentage+'%';
            html += '</div>';
          html += '</div>';
         $("#registration_form").fadeOut();
         $(".progressUpload").fadeIn();
         $(".loader").fadeIn();
         $(".progressUpload").html(html);
     }
 }
 
 $("#registration_form").validate({
  rules: {
   <?php foreach($FORM_BASE_VALUE as $key => $form){
      ?>
   <?php echo $key; ?>: {
    required: true,
    minlength: 1
   },
   <?php 
      } 
      ?>
   <?php if($data['meta_tree']['keys']['form_user_image_1']['show'] == 1 && $extensions){ ?>
   file: {
    required: false,
    extension: "<?php echo $extensions; ?>"
   },
   <?php } ?>

   <?php if($data['meta_tree']['keys']['message']['show'] == 1){ ?>
   sprava: {
    required: true,
    minlength: 1
   },
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_1']['show'] == 1){ ?>
   suhlas1: {
    required: true,
    minlength: 1
   },
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_2']['show'] == 1){ ?>
   suhlas2: {
    required: true,
    minlength: 1
   },
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_3']['show'] == 1){ ?>
   suhlas3: {
    required: true,
    minlength: 1
   },
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_4']['show'] == 1){ ?>
   suhlas4: {
    required: true,
    minlength: 1
   },
   <?php } ?>
  },
  messages: {
   <?php foreach($FORM_BASE_VALUE as $key => $form){ ?>
   <?php echo $key; ?>: "^ Toto pole je povinné",
   <?php } ?>


    <?php if($data['meta_tree']['keys']['form_user_image_1']['show'] == 1 && $extensions){ ?>
   file: {
       extension: "Povolený je len upload súborov v zozname." 
    },
   <?php } ?>
   <?php if($data['meta_tree']['keys']['message']['show'] == 1){ ?>
   sprava: "Správa pre nás nie je vyplnená",
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_1']['show'] == 1){ ?>
   suhlas1: "Tento súhlas je potrebný pre odoslanie formulára",
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_2']['show'] == 1){ ?>
   suhlas2: "Tento súhlas je potrebný pre odoslanie formulára",
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_3']['show'] == 1){ ?>
   suhlas3: "Tento súhlas je potrebný pre odoslanie formulára",
   <?php } ?>

   <?php if($data['meta_tree']['keys']['form_file_podmienky_4']['show'] == 1){ ?>
   suhlas4: "Tento súhlas je potrebný pre odoslanie formulára",
   <?php } ?>


   podmienky1: "Tento súhlas je povinný",
   podmienky2: "Tento súhlas je povinný",
   
   
  },
  submitHandler: function(form) {

   $.ajax({
    <?php if($data['meta_tree']['keys']['ajax_url']['show'] == 1){ ?>
        url : '<?php echo $data['meta_tree']['keys']['ajax_url']['value']; ?>',
    <?php } else { ?> 
        <?php if(MultyLanguage::getLang() == "0"){ ?>
        url: "<?php echo WWW_PATH; ?>rpc/json/competition-register/<?php echo $data['post_id']?>",
        <?php }else{?>
        url: "<?php echo WWW_PATH.MultyLanguage::getLang(); ?>/rpc/json/competition-register/<?php echo $data['post_id']?>",
        <?php } ?>
    <?php } ?>
    type: 'POST',
    data: new FormData($('#registration_form')[0]),

    // Tell jQuery not to process data or worry about content-type
    // You *must* include these options!
    cache: false,
    contentType: false,
    processData: false,

    // Custom XMLHttpRequest
    xhr: function() {
     var myXhr = $.ajaxSettings.xhr();
     if (myXhr.upload) {
      // For handling the progress of the upload
      myXhr.upload.addEventListener('progress', function(e) {
       if (e.lengthComputable) {
        $('progress').attr({
         value: e.loaded,
         max: e.total,
        });
        const percentage = Math.round((e.loaded * 100) / e.total);
        showProgress(percentage);
        console.log(percentage);
       }
      }, false);
      //console.log($('progress').html());
     }
     return myXhr;
    },
    success: function(data) {
     //var data = jQuery.parseJSON(data);
     console.log(data);
     if (data.response == 1) {
      $("#registration_form").css("display", "none");
      $("#form_ok").css("display", "block");
     } else if (data.response == 2) {
      alert("No valid captcha");
     } else if (data.response == 8) {
      alert("Please select image");
     } else if (data.response == 0) {
      alert("...no post request...");
     } else if (data.response == 10) {
      alert("...status OK, but this is test...");
     } else {
      writeError(data.message);
     }
    },
   });
   return false;
  }
 });

 //writeError("TEST");		
 function writeError(message) {
  $("#form-result").html("<div class=\"alert alert-error\">" + message + "</div>");
 }
});
</script> 
<div class="row sutaze-a-odkazy registration_form">
   <div class="perex">
   </div>
   <form class="col-md-12 tvn-form" id="registration_form" method="POST" enctype="multipart/form-data" novalidate="novalidate">
       
      <?php foreach($FORM_BASE_VALUE as $key => $form){ ?>
       
       <fieldset class="form-group">
         <label for="<?php echo $key; ?>">
         <span class="star">*
         </span><?php echo $form['value']; ?>
         </label>
         <input name="<?php echo $key; ?>" class="form-control" id="<?php echo $key; ?>" placeholder="<?php echo $form['value']; ?>" type="text">
      </fieldset>
     
        <?php } ?> 
       
      <!-- MESSAGE -->
      <?php if($data['meta_tree']['keys']['message']['show'] == 1){ ?>
      <fieldset class="form-group">
         <label for="sprava">
         <span class="star">*
         </span><?php echo $data['meta_tree']['keys']['message']['value']; ?>
         </label>
         <textarea name="sprava" class="form-control" id="sprava" rows="3"></textarea>
      </fieldset>
          <?php } ?>   
      
       <?php if($data['meta_tree']['keys']['video_link']['show'] == 1){ ?>
      <fieldset class="form-group">
         <label for="video_link">
         <span class="star">*
         </span><?php echo $data['meta_tree']['keys']['video_link']['value']; ?>
         </label>
         <input name="video_link" class="form-control" id="video_link" placeholder="<?php echo $data['meta_tree']['keys']['video_link']['value']; ?>" type="text">
      </fieldset>
      <?php } ?> 
      
      <?php if($data['meta_tree']['keys']['form_user_image_1']['show'] == 1){ ?>
        <fieldset class="form-group">
         <label for="file">
         <?php 
         if ($extensions) {
             echo $data['meta_tree']['keys']['form_user_image_1']['value'] . ' (' . $data['meta_tree']['keys']['white_list_extensions']['value'] . ')';
         } else {
             echo $data['meta_tree']['keys']['form_user_image_1']['value'];
         }
         ?>
         </label>
         <input id="file" accept="<?php echo $accept; ?>" name="file[]" multiple="" type="file">
      </fieldset>
        <?php } ?>
      

      <fieldset class="form-group">
          
        <?php if($data['meta_tree']['keys']['form_file_podmienky_1']['show'] == 1){ ?>
         <div class="checkbox">
            <label>
            <input id="suhlas1" name="suhlas1" type="checkbox">
            <span class="text-description">
            <span class="star" style="font-weight: bold">*
            </span>Odoslaním formuláru 
            <a href="<?php echo $data['meta_tree']['keys']['form_file_podmienky_1']['value'] ?>" target="_blank">
            <u>súhlasím
            </u>
            </a>s pravidlami súťaže
            </span>
            </label>
         </div>
          <?php } ?>
          
          
          <?php if($data['meta_tree']['keys']['form_file_podmienky_2']['show'] == 1){ ?>
         <div class="checkbox">
            <label>
            <input id="suhlas2" name="suhlas2" type="checkbox">
            <span class="text-description">
            <span class="star" style="font-weight: bold">*
            </span>Odoslaním formuláru 
            <a href="<?php echo $data['meta_tree']['keys']['form_file_podmienky_2']['value'] ?>" target="_blank">
            <u>súhlasím
            </u>
            </a>s použitím poskytnutého audiovizuálneho záznamu (súťažného videa)
            </span>
            </label>
         </div>
          <?php } ?>
          
          
          <?php if($data['meta_tree']['keys']['form_file_podmienky_3']['show'] == 1){ ?>
         <div class="checkbox">
            <label>
            <input id="suhlas3" name="suhlas3" type="checkbox">
            <span class="text-description">
            <span class="star" style="font-weight: bold">*
            </span>Odoslaním formuláru 
            <a href="<?php echo $data['meta_tree']['keys']['form_file_podmienky_3']['value'] ?>" target="_blank">
            <u>súhlasím
            </u>
            </a>so spracovaním osobitných kategórií osobných údajov
            </span>
            </label>
         </div>
          <?php } ?>
          
          <?php if($data['meta_tree']['keys']['form_file_podmienky_4']['show'] == 1){ ?>
         <div class="checkbox">
            <label>
            <input id="suhlas4" name="suhlas4" type="checkbox">
            <span class="text-description">
            <span class="star" style="font-weight: bold">*
            </span>Potvrdzujem, že vo vzťahu k poskytnutému súťažnému videu mám vysporiadané všetky potrebné práva tretích osôb   
            </span>
            </label>
         </div>
           <?php } ?>
          
           <?php if($data['meta_tree']['keys']['form_file_info_1']['show'] == 1){ ?>
         <div class="checkbox">
            <label>
            <span class="text-description">
            Podmienky a 
            <a href="<?php echo $data['meta_tree']['keys']['form_file_info_1']['value'] ?>" target="_blank">
            <u>informácie
            </u>
            </a>o spracovávaní osobných údajov účastníkov súťaže spol. MARKÍZA - SLOVAKIA, spol. s r.o
            </span>
            </label>
         </div>
           <?php } ?>
          
      </fieldset>
      <fieldset class="form-group">
         <label for="sprava">
         <span class="star">*
         </span>Povinné údaje
         </label>
      </fieldset>
      <fieldset class="form-group">
         <input name="sent" class="btn btn-primary btn-file btn-odoslat" id="submit_form" style="" type="submit">
      </fieldset>
   </form>
   <div id="form_ok" class="col-md-12 tvn-form" style="display: none">
      <div class="row">
         <h3>Ďakujeme za zapojenie sa do súťaže
         </h3>
      </div>
   </div>
   <br>
   <br>
   <!--<div class="loader"></div>-->
   <div class="progressUpload" style="display: none"></div>
</div> 
<?php $formEmbed = ob_get_clean();
echo $formEmbed;
echo '<br/><br/><br/><textarea style="
    padding: 10px;
    margin: 20px 0px;
    width: 100%;
    height: 150px;
">'. htmlentities($formEmbed).'</textarea>';
?>
   