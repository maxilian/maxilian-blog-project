<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class adn_otentikasi
{
    function adn_otentikasi()
    {
        $this->obj =& get_instance();
		
    }
 
    function is_logged_in()
    {
        if ($this->obj->session) {
 
            if ($this->obj->session->userdata('logged_in'))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }
}
 
/* Akhir dari adn_otentikasi.php */
?>