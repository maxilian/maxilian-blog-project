<div class="admincontent"><?php echo $table; ?>


</div>

<div id="news_form" >
		<?php echo form_open('/Admin/add_category');?>
		<p>Kategori :     </p>
			<input type="text" name="txtKategori" size="63" value="<?php echo $this->validation->txtKategori; ?>"/>
		<?php echo $this->validation->txtKategori_error; ?><br/>
		<p>Deskripsi :     </p>
		<input type="text" name="txtKategoriDeskripsi" size="63" value=""/>
		
		<?php echo form_submit('submit', 'submit'); ?>
		<?php echo form_close(); ?> 
</div>