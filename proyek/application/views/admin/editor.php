<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo base_url()?>js/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|, cut,copy,paste,pastetext,pasteword,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,styleprops,|,nonbreaking,pagebreak",
			theme_advanced_buttons3 : "tablecontrols,|,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : false,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script>
<div id="news_form" >
	  
	  <!--<?php echo form_open('/admin/add_posts');?>-->
	<form method="post" action="<?php echo $action; ?>" >
			<div id="titlepost_form"> <tr><p>Title :      </p>
				<td>
				<input type="text" name="txtTitle" size="63" value="<?php echo $this->validation->txtTitle; ?>"/>
				<?php echo $this->validation->txtTitle_error; ?>
						</td>
					</tr>
			</div>
	
	<div id="descriptionpost_form">
	<tr>
		<p>Description : </p>
		<td>
		<textarea name="txtDescription" rows="3" cols="65" ><?php echo $this->validation->txtDescription; ?></textarea>
		<?php echo $this->validation->txtDescription_error; ?>
		</td>
	</tr>
	</div>
	<div id="keywordpost_form">
	<tr>
		<p>Keyword :     </p>
		<td><input type="text" name="txtKeyword" size="63" /></td>
		</tr>
	</div>
	<textarea name="txtPosts" rows="20" cols="25" style="width: 70%" class="tinymce" value=""><?php echo $this->validation->txtPosts; ?></textarea><?php echo $this->validation->txtPosts_error; ?><br/>
	<div id="kategoripost_form">
		<tr>Kategori   :
		<td><select name="kategori"><?php foreach ($kategori as $category): ?>
			
			<option value="<?php echo $category->nama_kategori;  ?>" ><?php echo $category->nama_kategori; ?> </option>    
		<?php endforeach; ?></select> </td>
		</tr>
		<!--<?php echo form_submit('submit', 'submit'); ?>-->
		<input type="submit" value="Save"/>
		
	</div>
	
       <?php echo form_close(); ?> 
		 
		 
		 </div>
     