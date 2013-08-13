<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin extends Controller {
 
	
 
	function admin()
	{
		parent::Controller();
		$this->load->helper('url','form', 'array');
		$this->load->model('post_model');
		$this->load->library('validation', 'adn_otentikasi', 'session');
		
		  
	}
 
	function index() {
	
		$this->obj =& get_instance();
		$data['pesan']	= "";
		
		//pengecekan session login admin
		if($this->obj->session->userdata('logged_in') == false) {
		$this->load->view('admin_message',$data);
		} else {
		redirect('admin/home');
		}
	}
 
 
	//fungsi untuk login admin
	function login() {
		
		$this->obj =& get_instance();
		$this->load->model('app_model');
        $data['pesan']	= "";
		//$credentials	 = array('logged_in'=> FALSE);
		//$this->session->set_userdata($credentials);
		//mengambil hasil return pada fungsi proses_login di model app_model.php
		$login = $this->app_model->proses_login();
			
			
        if ($login == TRUE OR $this->obj->session->userdata('logged_in') == TRUE ) {
		   
			$credentials = array('logged_in'=> TRUE, 'username' => $this->input->post('txtusername'));
			$this->session->set_userdata($credentials);
			redirect('admin/home');
		} else {
			$data['pesan']  = 'Maaf, anda tidak berhak masuk!';
			$this->load->view('admin_message',$data);
		}
		
    }
	
	//fungsi logout
    function logout() {
		$this->load->library('session');
        $this->session->sess_destroy();
		
        redirect('admin');
    }
	
	
	function home($offset = 0)
	{
		$this->obj =& get_instance();
		
		
		if($this->obj->session->userdata('logged_in') == false ) {
			$data['pesan']	= "Anda belum login !";
			$this->load->view('admin_message',$data);
			
		} else {
		
		//$this->load->view('home');

			$this->load->library('pagination');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			
			//generate tabel
			$limit = 10;
			
			$post = $this->post_model->get_paged_list($limit, $offset)->result();
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('ID Post', 'Judul', 'Actions');
			
		
			$i = 0 + $offset;
				foreach ($post as $post){
					$this->table->add_row(++$i, $post->web_title,
						
						anchor('admin/delete/'.$post->id_post,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this post?')")).' '.
						anchor('admin/update/'.$post->id_post,'update',array('class'=>'update')).' '.
						anchor('blog/view/'.$post->web_title,'view',array('class'=>'view'))
					);
				}
				
			$data['table'] = $this->table->generate();

			
		
 
			//load library pagination
			
			$this->load->library('pagination');
			 //untuk konfigurasi pagination
			$config = array(
				'base_url' => base_url() . 'admin/home/',
				'total_rows' => count($this->post_model->get()),
				'per_page' => $limit,
			);
 
			//inisialisasi pagination dgn config di atas
        
			$data['post'] = $this->post_model->get(array('perpage' => $limit, 'offset' => $offset));
			$this->pagination->initialize($config);
			
			// load view
			$this->load->view('admin/postlist', $data);
			$this->load->view('admin/footer');

		}
		
	}
	
	
	//fungsi meload halaman untuk post
	function post() {
		$this->get_category();
		$data['action'] = site_url('admin/add_posts');
		$data['kategori'] = $this->post_model->get_category();
		$this->_set_fields();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/editor', $data);
		$this->load->view('admin/footer');
	
	}
	
	
	//fungsi menambah artikel
	function add_posts() {
		//load model
		$this->load->model('post_model');
		$this->_set_fields();
		$this->_set_rules();
		
		if ($this->validation->run() == FALSE){
		
			$data['message'] = '';
			$this->post();
			
		} else {
			// save data
			$posts = array(
							'web_post' => $this->input->post('txtPosts'),
							'web_title' => $this->input->post('txtTitle'),
							'web_description' => $this->input->post('txtDescription'),
							'web_keyword' => $this->input->post('txtKeyword'),
							'nama_kategori' => $this->input->post('kategori'),
							);
			$artikel = $this->post_model->insert($posts);
			
			// set form input 
			$this->validation->txtTitle = $artikel;
			$this->validation->txtPosts = $artikel;
			redirect('admin');
			
		}
		
	}
	
	
	
	//fungsi delete artikel
	function delete($id){
	
		// delete post
		$this->post_model->delete($id);

		// redirect ke post list page
		redirect('admin/index/','refresh');
	}
	
	function update($id){
		// set validation properties
		$this->_set_fields();
		
		$this->load->model('post_model');
		
		$judul = $this->post_model->get_judul_artikel($id)->row();
		$artikel = $this->post_model->get_artikel($id)->row();
		$deskripsi = $this->post_model->get_deskripsi($id)->row();
	//	$recordid = $this->post_model->get_by_id($id)->row();
		
		// prefill form values
		
		$this->validation->txtTitle = $judul->web_title;
		$this->validation->txtPosts = $artikel->web_post;
		$this->validation->txtDescription = $deskripsi->web_description;
		//$this->validation->txtPosts = $post->web_post;
	//	$_POST['kategori'] = strtoupper($post->kategori);
		
		
		// set common properties
		
	
		// load view
		$this->get_category();
		$data['action'] = site_url('admin/update_post/'.$id);
		$data['kategori'] = $this->post_model->get_category();
		//$data['recid'] = $id;
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/editor', $data);
		$this->load->view('admin/footer');
	}
	
	
	function update_post($id){
		$this->obj =& get_instance();		
		$this->load->model('post_model');
		
		// set validation properties
		$this->_set_fields();
		$this->_set_rules();
		
		// run validation
		if ($this->validation->run() == FALSE){
		
			$data['message'] = '';
			$this->update();
			
		} else {
			// save data
			
			
			//$idartikel = $id;
			$posts = array(	
							'web_post' => $this->input->post('txtPosts'),
							'web_title' => $this->input->post('txtTitle'),
							'web_description' => $this->input->post('txtDescription'),
							'web_keyword' => $this->input->post('txtKeyword'),
							'nama_kategori' => $this->input->post('kategori')
							);
							
			$artikel = $this->post_model->update($id, $posts);
			
			// set form input 
			$this->validation->txtTitle = $artikel;
			$this->validation->txtPosts = $artikel;
			redirect('admin');
			
		}
	}
	
	//fungsi - fungsi tentang kategori
	
	function kategori() {
		$fields['txtKategori'] = 'Kategori';
		$this->validation->set_fields($fields);
		
		$limit = 10;
		$offset = 0;	
		$kategori = $this->post_model->get_category_list($limit, $offset)->result();
		
		$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('No.', 'Kategori', 'Actions');
			
		
			$i = 0 + $offset;
				foreach ($kategori as $post){
					$this->table->add_row(++$i, $post->nama_kategori, 
						
						anchor('admin/delete_category'.$post->id_kategori,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this person?')"))
						//anchor('blog/view/'.$post->web_title,'view',array('class'=>'view'))
					); 
				}
				
			$data['table'] = $this->table->generate();
			
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/kategori', $data);
		$this->load->view('admin/footer');
	}
	
	//fungsi untuk menambah kategori
	function add_category() {
	
		$this->load->model('post_model');
		$fields['txtKategori'] = 'Kategori';
		$this->validation->set_fields($fields);
		$rules['txtKategori'] = 'trim|required';
		$this->validation->set_rules($rules);
		
		$this->validation->set_message('required', '* required');
		$this->validation->set_message('isset', '* required');
		$this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if ($this->validation->run() == FALSE){
		
			$data['message'] = '';
			$this->kategori();
			
		} else {
			// save data
			 $kategori = array(
							'nama_kategori' => $this->input->post('txtKategori'),
							'kategori_deskripsi' => $this->input->post('txtKategoriDeskripsi')
							);
			$category =	$this->post_model->insert_category($kategori);
			
			// set form input 
			$this->validation->txtKategori = $category;
			redirect('admin/kategori');
			
		}
		
	}
	
	function delete_category($id) {
		$this->post_model->delete_category($id);

		// redirect to post list page
		redirect('admin/kategori/','refresh');
	}
	
	function get_category() {
	
		 $this->load->model('post_model');
		 $this->post_model->get_category();
		
	
	}
	
	function _set_fields(){
	
		$fields['txtTitle'] = 'txtTitle';
		$fields['txtPosts'] = 'Posts';
		$fields['txtDescription'] = 'Deskripsi';
		
		$this->validation->set_fields($fields);
		
	}
	
	function _set_rules(){
	
		$rules['txtTitle'] = 'trim|required';
		$rules['txtPosts'] = 'trim|required|min_length[20]';
		$rules['txtDescription'] = 'trim';
		$this->validation->set_rules($rules);
		
		$this->validation->set_message('required', '* required');
		$this->validation->set_message('isset', '* required');
		$this->validation->set_error_delimiters('<p class="error">', '</p>');
		
	}
	
	
	
}
 
/* End of file Admin.php */
/* Location: ./system/application/controllers/admin.php */
?>