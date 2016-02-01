<footer>
	<p class="pull-left">
		&copy; <a target="_blank" href="http://eshantimarga.com" target="_blank">sagarmathaonline.com</a> 2015
	</p>
	<p class="pull-right">
		Powered by: <a target="_blank" href="http://webspacenepal.com">Web Space Nepal</a>
	</p>
</footer>

</div><!--/.fluid-container-->

<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo base_url() . ADMIN_JS; ?>jquery-1.7.2.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-collapse.js"></script>
<!-- carousel slideshow library (optional, not used in demo) -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-carousel.js"></script>
<!-- autocomplete library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-typeahead.js"></script>
<!-- tour library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>bootstrap-tour.js"></script>
<!-- library for cookie management -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.cookie.js"></script>
<!-- calander plugin -->
<script src='<?php echo base_url() . ADMIN_JS; ?>fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='<?php echo base_url() . ADMIN_JS; ?>jquery.dataTables.min.js'></script>

<!-- chart libraries start -->
<script src="<?php echo base_url() . ADMIN_JS; ?>excanvas.js"></script>
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.flot.min.js"></script>
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.flot.stack.js"></script>
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.noty.js"></script>
<!-- file manager library -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?php echo base_url() . ADMIN_JS; ?>charisma.js"></script>
<script src="<?php echo base_url() . ADMIN_JS; ?>tiny-mce/editor/tiny_mce.js" type="text/javascript"></script>
<script type="text/javascript">
                tinyMCE.init({
                    mode: "exact",
                    elements: "description,detail_description,album_descript",
                    theme: "advanced",
                    plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,filemanager,youtubeIframe",
                    language: "en",
                    height: "480",
                    skin_variant : "black",
                    // Theme options
                    theme_advanced_buttons1: "save,newdocument,youtubeIframe,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                    theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                    theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,insertfile",
                    theme_advanced_toolbar_location: "top",
                    theme_advanced_toolbar_align: "left",
                    theme_advanced_statusbar_location: "bottom",
                    theme_advanced_resizing: true,
                    // This is required for the image paths to display properly
                    relative_urls: false,
                    // Example content CSS (should be your site CSS)
                    //content_css : "css/content.css",
                    extended_valid_elements:"iframe[src|width|height|name|align]",


                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url: "template_list.js",
                    external_link_list_url: "link_list.js",
                    external_image_list_url: "image_list.js",
                    media_external_list_url: "media_list.js",
                    // Replace values for the template plugin
                    template_replace_values: {
                        username: "nirojshakya",
                        staffid: "98007645"
                    }



                });
            </script>
 
<script src="<?php echo base_url() . ADMIN_JS; ?>jquery.treetable.js"></script>
<!-- <script>
      $("#example-advanced").treetable({ expandable: true });
</script>            
<script>
    $('#example-advanced').dataTable( {
      "bSort": false
    } );
</script> -->

</body>
</html>