<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends Controller
{
		/* Code By Maxilian
  @maxiian_
  shellovelyan@gmail.com
  */
	function Blog() {
	
		parent::Controller();
		$this->ci =& get_instance();
		$this->load->model('post_model');
		
	}
	
    function index($offset = 0) { 
 
		$this->load->view('/theme/header');
		$this->load->view('/theme/sidebar');


		//limit post per page
		$perpage = 3;
 
        //load library pagination
        $this->load->library('pagination');
 
        //untuk konfigurasi pagination
        $config = array(
            'base_url' => base_url() . 'blog/index/',
            'total_rows' => count($this->post_model->get()),
            'per_page' => $perpage,
        );
 
        //inisialisasi pagination dgn config di atas        
		$data['post'] = $this->post_model->get(array('perpage' => $perpage, 'offset' => $offset));
		
		$this->pagination->initialize($config);


		//load View
		$this->load->view('/theme/content', $data);
		$this->load->view('/theme/footer');
		
       
	  }
	  
	function view($id){
		// set common properties
		//$this->ci =& get_instance();
		//$this->load->model('post_model');
		$this->obj =& get_instance();
			
		// get person details
	//	$data['title'] = 'Person Details';
		$data['post'] = $this->post_model->get_single_artikel($id)->row();
		
		// load view
	$this->load->view('theme/single', $data);
		
	}
	

    
}  
?>