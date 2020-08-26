<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * 
 */
class Category_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
    
    public function doaddcategory($file1)
    {
        $data = array(
        
            'en' => $this->security->xss_clean($this->input->post('category_en')),
            'es' => $this->security->xss_clean($this->input->post('category_es')),
            'fr' => $this->security->xss_clean($this->input->post('category_fr')),
            'pt' => $this->security->xss_clean($this->input->post('category_pt')),
            'image_url' => $file1,
            'status'=>'1'
        );
        $this->db->insert('category',$data);
        return $this->db->insert_id();
    }
    
    public function getCategories()
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->order_by('category_id','desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function doaddsubcategory($file1)
    {
        $data = array(
        
            'category_id' => $this->security->xss_clean($this->input->post('category')),
            'en' => $this->security->xss_clean($this->input->post('subcategory_en')),
            'es' => $this->security->xss_clean($this->input->post('subcategory_es')),
            'fr' => $this->security->xss_clean($this->input->post('subcategory_fr')),
            'pt' => $this->security->xss_clean($this->input->post('subcategory_pt')),
            'image_url' => $file1,
            'status'=>'1'
        );
        $this->db->insert('sub_category',$data);
        return $this->db->insert_id();
    }
    
    public function doEditSubcategory($file1,$id)
    {
        $data = array(        
            'category_id' => $this->security->xss_clean($this->input->post('category')),
            'en' => $this->security->xss_clean($this->input->post('subcategory_en')),
            'es' => $this->security->xss_clean($this->input->post('subcategory_es')),
            'fr' => $this->security->xss_clean($this->input->post('subcategory_fr')),
            'pt' => $this->security->xss_clean($this->input->post('subcategory_pt')),
            'image_url' => $file1,
            'status'=>'1'
        );
        $this->db->where('sub_category_id',$id);
        $this->db->update('sub_category',$data);
        return $this->db->affected_rows();
    }
    
    public function doEditCategory($id,$file1)
    {
        $data = array(
        
            'en' => $this->security->xss_clean($this->input->post('category_en')),
            'es' => $this->security->xss_clean($this->input->post('category_es')),
            'fr' => $this->security->xss_clean($this->input->post('category_fr')),
            'pt' => $this->security->xss_clean($this->input->post('category_pt')),
            'image_url' =>$file1,
            'status'=>'1'
        );
        $this->db->where('category_id',$id);
        $this->db->update('category',$data);
        return true;
    }
    
    public function getsubcategories()
    {
        $this->db->select('*');
        $this->db->from('sub_category');
        $this->db->order_by('sub_category_id','desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function doaddchildcategory()
    {
        $data = array(
        
            'category_id' => $this->security->xss_clean($this->input->post('category')),
            'sub_category_id' => $this->security->xss_clean($this->input->post('subcategory')),
            'en' => $this->security->xss_clean($this->input->post('childcategory_en')),
            'es' => $this->security->xss_clean($this->input->post('childcategory_es')),
            'fr' => $this->security->xss_clean($this->input->post('childcategory_fr')),
            'pt' => $this->security->xss_clean($this->input->post('childcategory_pt')),
            'status'=>'1'
        );
        $this->db->insert('child_category',$data);
        return $this->db->insert_id();
    }
    
    public function doEditChildCategory($id)
    {
        $data = array(
        
            'category_id' => $this->security->xss_clean($this->input->post('category')),
            'sub_category_id' => $this->security->xss_clean($this->input->post('subcategory')),
            'en' => $this->security->xss_clean($this->input->post('childcategory_en')),
            'es' => $this->security->xss_clean($this->input->post('childcategory_es')),
            'fr' => $this->security->xss_clean($this->input->post('childcategory_fr')),
            'pt' => $this->security->xss_clean($this->input->post('childcategory_pt')),
            'status'=>'1'
        );
        $this->db->where('child_category_id',$id);
        $this->db->update('child_category',$data);
        return $this->db->affected_rows();
    }
    
    public function subcat($id)
    {
        $this->db->select('*');
        $this->db->from('sub_category');
        $this->db->where('category_id',$id);
        $sel = $this->db->get();
        return $sel->result_array();        
    }
    
    public function getchildcategories()
    {
        $this->db->select('*');
        $this->db->from('child_category');
        $sel = $this->db->get();
        return $sel->result_array();  
    }
    
    public function doaddsuperchildcategory()
    {
        $data = array(
        
            'category_id' => $this->security->xss_clean($this->input->post('category')),
            'sub_category_id' => $this->security->xss_clean($this->input->post('subcategory')),
            'child_category_id' => $this->security->xss_clean($this->input->post('childcategory')),
            'en' => $this->security->xss_clean($this->input->post('superchildcategory_en')),
            'es' => $this->security->xss_clean($this->input->post('superchildcategory_es')),
            'fr' => $this->security->xss_clean($this->input->post('superchildcategory_fr')),
            'pt' => $this->security->xss_clean($this->input->post('superchildcategory_pt')),
            'status'=>'1'
        );
        $this->db->insert('superchild_category',$data);
        return $this->db->insert_id();
    }
    
    public function doEditSuperchild($id)
    {
        $data = array(
        
            'category_id' => $this->security->xss_clean($this->input->post('category')),
            'sub_category_id' => $this->security->xss_clean($this->input->post('subcategory')),
            'child_category_id' => $this->security->xss_clean($this->input->post('childcategory')),
            'en' => $this->security->xss_clean($this->input->post('superchildcategory_en')),
            'es' => $this->security->xss_clean($this->input->post('superchildcategory_es')),
            'fr' => $this->security->xss_clean($this->input->post('superchildcategory_fr')),
            'pt' => $this->security->xss_clean($this->input->post('superchildcategory_pt')),
            'status'=>'1'
        );
        $this->db->where('superchild_category_id',$id);
        $this->db->update('superchild_category',$data);
        return $this->db->affected_rows();
    }
    
    public function childcat($id){
        $this->db->select('*');
        $this->db->from('child_category');
        $this->db->where('sub_category_id',$id);
        $sel = $this->db->get();
        return $sel->result_array();     
    }
    
    public function getsuperchildcategories()
    {
        $this->db->select('*');
        $this->db->from('superchild_category');
        $sel = $this->db->get();
        return $sel->result_array();  
    }
    
    public function doDeleteCategory($id){
        $this->db->where('category_id',$id);
        $this->db->delete('category');
        return $this->db->affected_rows();
    }
    
    public function getCategoryById($id)
    {
        $this->db->select('*');
        $this->db->from('category');
       $this->db->where('category_id',$id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function getsubcategoriesById($id)
    {
        $this->db->select('sub_category.*,category.en as category_en');
        $this->db->from('sub_category');
        $this->db->join('category','category.category_id=sub_category.category_id');
       $this->db->where('sub_category_id',$id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function doManageLanguage()
    {
         $data = array(        
            'key' => $this->security->xss_clean($this->input->post('key')),            
            'en' => $this->security->xss_clean($this->input->post('en')),
            'es' => $this->security->xss_clean($this->input->post('es')),
            'fr' => $this->security->xss_clean($this->input->post('fr')),
            'pt' => $this->security->xss_clean($this->input->post('pt')),
            'status'=>'1'
        );
        $this->db->insert('languages_data',$data);
        return $this->db->insert_id();
    }
    
    public function getSiteLanguage()
    {
        $this->db->select('*');
        $this->db->from('languages_data');        
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function subchildcat($id)
    {
        $this->db->select('*');
        $this->db->from('superchild_category');  
        $this->db->where('child_category_id',$id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getCategoryImage($id)
    {
        $this->db->select('category.image_url');
        $this->db->from('category');
        $this->db->where('category_id',$id);
        $sel  = $this->db->get();
        return $sel->row_array();
    }
    
    public function getSubcategoryImage($id)
    {
        $this->db->select('sub_category.image_url');
        $this->db->from('sub_category');
        $this->db->where('sub_category_id',$id);
        $sel  = $this->db->get();
        return $sel->row_array();
    }
    
    public function getChildCategoryByid($id)
    {
        $this->db->select('child_category.*,category.en as category_en,sub_category.en as sub_category_en');
        $this->db->from('child_category');
        $this->db->join('category','category.category_id=child_category.category_id');
        $this->db->join('sub_category','sub_category.sub_category_id=child_category.sub_category_id');
        $this->db->where('child_category.child_category_id',$id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function doDeleteChildcategory($id)
    {
        $this->db->where('child_category_id',$id);
        $this->db->delete('child_category');
        return $this->db->affected_rows();
    }
    
    public function getSuperChildById($id)
    {
        $this->db->select('superchild_category.*,category.en as category_en,sub_category.en as sub_category_en,child_category.en as child_category_en');
        $this->db->from('superchild_category');
        $this->db->join('category','category.category_id=superchild_category.category_id');
        $this->db->join('sub_category','sub_category.sub_category_id=superchild_category.sub_category_id');
        $this->db->join('child_category','child_category.child_category_id=superchild_category.child_category_id');
        $this->db->where('superchild_category.superchild_category_id',$id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    

	
    
    
}
?>