<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $post->web_title; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>styles.css" type="text/css" />
<meta name='robots' content='all' />
<meta name="keywords" content="<?php echo $post->web_keyword; ?>" />
<meta name="description" content="<?php echo $post->web_description; ?>" />

			
            
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>

<script type="text/javascript" src="js/custom.js"></script>
</head>

<body>
<?php echo base_url(); ?>
	<div id="header">
    	<h1><a href="/">Maxilian<strong>Project</strong></a></h1>
        <h2>My Personal Web</h2>
        <div class="clear"></div>
    </div>
    <div id="nav">
    	<ul class="sf-menu dropdown">
        	<li class="selected"><a href="<?php echo base_url(); ?>">Home</a></li>
            <!--<li><a class="has_submenu" href="examples.html">Examples</a>
            	<ul>
                	<li><a href="page.html">Static Text Page</a></li>
                    <li><a href="#">A sub Link</a></li>
                    <li><a href="#">Another link</a></li>
                </ul>
            </li>
            <li><a class="has_submenu" href="#">Products</a>
            	<ul>
                	<li><a href="#">Product One</a></li>
                    <li><a href="#">Product Two</a></li>
                    <li><a href="#">Product Three</a></li>
                </ul>
            </li>
            <li><a href="#">Solutions</a></li>
            <li><a href="#">Contact</a></li>-->
        </ul>
    </div>
<div id="container">    
    

<?php $this->load->view('/theme/sidebar'); ?>
    <div class="content">
       <h1><?php 
	    echo anchor('blog/view/'.$post->web_title,$post->web_title,array('class'=>'view')); ?>
		</h1>
	
        <div id="contentpost">
		<em>Posted date: <?php echo $post->web_tanggal; ?> </em>
	   <br/>
	   <br/>
		<?php echo $post->web_post; ?>
		
		<br/>
		<strong>Category : <?php echo $post->nama_kategori; ?></strong>
		</div>
    </div>
  <?php $this->load->view('/theme/footer'); ?>  
