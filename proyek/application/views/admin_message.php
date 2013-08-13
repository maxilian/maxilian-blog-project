<link rel="stylesheet" id="login-css"  href="<?php echo base_url(); ?>login.css" type="text/css" media="all" />

<?php
echo '<h1>Silahkan login untuk masuk....</h1>';
echo '<form method="POST" action="';
echo base_url();
echo 'admin/login">
<table>
	<tr>
		<td>User Name</td>
		<td> : </td>
		<td><input type="text" name="txtusername" maxlength="15"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td> : </td>
		<td><input type="password" name="txtpassword" maxlength="15"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="submit" value="kirim"></td>
	</tr>
</table>
</form>
<font color="red">'.$pesan.'</font>';
?>