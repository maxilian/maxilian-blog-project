<?php
/* Code By Maxilian
  @maxiian_
  shellovelyan@gmail.com
  */




class post_model extends Model {

	function __construct() {
	
			parent::Model();
			
		}
		
		
			var $web_post = '';
			var $web_description ='';
			var $web_title = '';
			var $web_keyword = '';
	
	
	//fungsi mengambil semua data	
	function selectAll(){
        
		$ambildata = $this->db->get('table_post');
		
		return $ambildata;
		
    }
	
	
	//fungsi menambah data artikel
	function insert($posts){
		/*$this->web_post 		= $this->input->post('txtPosts');
		$this->web_title		= $this->input->post('txtTitle');
        $this->web_description  = $this->input->post('txtDescription');
		$this->web_keyword	= $this->input->post('txtKeyword');
        $this->db->insert('table_post', $this ); */
		$this->db->insert('table_post', $posts );
		
    } 
	
	//fungsi menghapus artikel
	function delete($id){
		$this->db->where('id_post', $id);
		$this->db->delete('table_post');
	}
	
	//ambil data
	 function get($limit = array())
    {
	
	$this->db->order_by("web_tanggal", "desc"); 
	
        if ($limit == NULL) {
            return $this->db->get('table_post')->result();
			}
        else
            {
		$this->db->count_all('table_post');	
		return $this->db->limit($limit['perpage'], $limit['offset'])->get('table_post')->result();
		}
    } 
	
	
	function get_paged_list($limit = 10, $offset = 0){
      $this->db->order_by('id_post','desc');
        return $this->db->get('table_post', $limit, $offset);
    }
	
	function get_by_id($id){
		$this->db->select('id_post');
		$this->db->where('id_post', $id);
		return $this->db->get('table_post');
	}
	
	function get_judul_artikel($id){
		$this->db->select('web_title');
		$this->db->where('id_post', $id);
		return $this->db->get('table_post');
	}
	
	function get_artikel($id) {
		$this->db->select('web_post');
		$this->db->where('id_post', $id);
		return $this->db->get('table_post');
	}
	
	function get_deskripsi($id) {
		$this->db->select('web_description');
		$this->db->where('id_post', $id);
		return $this->db->get('table_post');
	}
	
	function set_judul_artikel($id){
		$this->db->select('web_title');
		$this->db->where('id_post', $id);
		return $this->db->get('table_post');
	}
	
	function set_artikel($id) {
		$this->db->select('web_post');
		$this->db->where('id_post', $id);
		return $this->db->get('table_post');
	}
	
	function set_deskripsi($id) {
		$this->db->select('web_description');
		$this->db->where('id_post', $id);
		return $this->db->get('table_post');
	}
	
	function update($id, $post){
		$this->db->where('id_post', $id);
		$this->db->update('table_post', $post);
	
	}
	
	//menambah kategori
	function insert_category($kategori) {
		
        
        $this->db->insert('kategori', $kategori );
	}
	
	//delete kategori
	function delete_category($id){
		$this->db->where('id_kategori', $id);
		$this->db->delete('kategori');
	}
	//mengambil kategori
	function get_category_list($limit = 10, $offset = 0){
      $this->db->order_by('nama_kategori','desc');
        return $this->db->get('kategori', $limit, $offset);
    }
	function get_category() {
	
			return $this->db->get('kategori')->result();
	}
	
	
	function get_category_by_id() {
			/*SELECT nama_kategori
FROM kategori
INNER JOIN table_post ON kategori.id_kategori = table_post.id_kategori */
			$this->db->select('nama_kategori');
			$this->db->from('kategori');
			$this->db->join('table_post', 'kategori.id_kategori = table_post.id_kategori');
			return $this;
			//return $this->db->get('kategori');
	}
	
	
	function get_single_artikel($id){
		$this->db->select('web_title');
		$this->db->select('web_description');
		$this->db->select('nama_kategori');
		$this->db->select('web_tanggal');
		$this->db->select('web_keyword');
		
		
		$this->db->select('web_post');
		$this->db->where('web_title', $id);
		return $this->db->get('table_post');
	}
}


?>