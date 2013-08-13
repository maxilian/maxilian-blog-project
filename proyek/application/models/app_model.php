<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class app_model extends Model
{

	/* Code By Maxilian
  @maxiian_
  shellovelyan@gmail.com
  */
    function app_model()
    {
        parent::Model();
		//$this->load->library('session');
		

    }   
    function proses_login()
    {
	
		$hasil_login = FALSE;
	
		//menampung data dari form login
		$pass = $this->input->post('txtpassword');
		$username = $this->input->post('txtusername');
		//Queri untuk mencari user
		$query = $this->db->query("SELECT * FROM `user` WHERE user_username = '$username' AND user_password = '$pass'");
		
		if($query->num_rows < 1 AND $query == NULL )
		{
			$hasil_login = FALSE;
			
		} 
			if ($query->num_rows == 1 AND $query !== NULL) {
			$hasil_login = TRUE;
				
			
			} ELSE {
			
			$hasil_login == FALSE;
			}
		
	return $hasil_login;
	
	
	}
}
//Akhir dari app_model.php
?>