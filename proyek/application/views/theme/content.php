<?php
/*foreach($ambildata->result_array() as $row) {
?>
<?=$row["id_post"]?>
<?php
}*/?>
<?php foreach ($post as $row): ?>
	
    <div class="content">
       <h1><?php 
	    echo anchor('blog/view/'.$row->web_title,$row->web_title,array('class'=>'view')); ?>
		</h1>
	
        <div id="contentpost">
		<em>Posted date: <?php echo $row->web_tanggal ?> </em>
	   <br/>
	   <br/>
		<?php echo $row->web_post; ?>
		<br/>
		<strong>Category : <?php echo $row->nama_kategori; ?> </strong>
		
		</div>
    </div>
    
<?php endforeach; ?> 
<?php echo $this->pagination->create_links(); ?>