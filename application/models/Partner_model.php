<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * 
 */
class Partner_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
    
   public function checkLogin()
    {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('pass'))),  
            'status'=>'Active'
        );
        
        $query = $this->db->get_where('saloon',$data);
        return $query->row_array();       
        
    }
    
    public function getDataByEmail($unique_id)
    {
        $sel = $this->db->get_where('saloon',['email'=>$unique_id]);
        return $sel->row_array();
    }
    
    public function do_check_oldpassword($em){
        
        $oldpassword = $this->security->xss_clean(hash('sha256', $this->input->post('op')));
        $query = $this->db->get_where('saloon', ['email'=>$em, 'password'=>$oldpassword]);
        return $query->row_array();
    }
    
    public function reset_password($em){
        $newpassword = $this->security->xss_clean(hash('sha256', $this->input->post('np')));
        $this->db->where('email',$em);
        $this->db->update('saloon',['password'=>$newpassword]);
        return $this->db->affected_rows();
    }
    
    public function getsuperchildcategories()
    {
        $this->db->select('*');
        $this->db->from('superchild_category');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getPartnerdetails($shop_id)
    {
//        $sel = $this->db->get_where('saloon',['shop_id',$shop_id]);
//        return $sel->row_array();
        $this->db->select('saloon.*,category.category_id,category.en as catgory_en,sub_category.sub_category_id,sub_category.en as sub_category_en,child_category.child_category_id,child_category.en as child_category_en,superchild_category.superchild_category_id,superchild_category.en as superchild_category_en');
        $this->db->from('saloon');
        $this->db->join('category','category.category_id=saloon.category_id');
        $this->db->join('sub_category','sub_category.sub_category_id=saloon.sub_category_id');
        $this->db->join('child_category','child_category.child_category_id=saloon.child_category_id');
        $this->db->join('superchild_category','superchild_category.superchild_category_id=saloon.superchild_category_id');
        $this->db->where('shop_id',$shop_id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function doUpdateProfile($shop_id,$image_url,$banner_url)
    {
         $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('category')),
            'sub_category_id' => $this->security->xss_clean($this->input->post('subcategory')),  
            'child_category_id' => $this->security->xss_clean($this->input->post('childcategory')),  
            'superchild_category_id' => $this->security->xss_clean($this->input->post('superchild')),  
            'image_url' => $image_url,  
            'banner_url' => $banner_url,  
            'shop_name_en' => $this->security->xss_clean($this->input->post('shop_name_en')),  
            'shop_name_es' => $this->security->xss_clean($this->input->post('shop_name_es')),  
            'shop_name_fr' => $this->security->xss_clean($this->input->post('shop_name_fr')),  
            'shop_name_pt' => $this->security->xss_clean($this->input->post('shop_name_pt')),  
            'address_en' => $this->security->xss_clean($this->input->post('add_en')),  
            'address_es' => $this->security->xss_clean($this->input->post('add_es')),  
            'address_fr' => $this->security->xss_clean($this->input->post('add_fr')),  
            'address_pt' => $this->security->xss_clean($this->input->post('add_pt')),  
            'state_en' => $this->security->xss_clean($this->input->post('state_name_en')),  
            'state_es' => $this->security->xss_clean($this->input->post('state_name_es')),  
            'state_fr' => $this->security->xss_clean($this->input->post('state_name_fr')),  
            'state_pt' => $this->security->xss_clean($this->input->post('state_name_pt')),  
            'city_en' => $this->security->xss_clean($this->input->post('city_name_en')),  
            'city_es' => $this->security->xss_clean($this->input->post('city_name_es')),  
            'city_fr' => $this->security->xss_clean($this->input->post('city_name_fr')),  
            'city_pt' => $this->security->xss_clean($this->input->post('city_name_pt')),  
            'pincode' => $this->security->xss_clean($this->input->post('code')),  
            'to' => $this->security->xss_clean($this->input->post('to')),  
            'from' => $this->security->xss_clean($this->input->post('from')),  
            'about' => $this->security->xss_clean($this->input->post('about')),  
            
        );
        
        $this->db->where('shop_id',$shop_id);
        $this->db->update('saloon',$data);
        return $this->db->affected_rows();
    }
    
    public function doAddServicecategory($shop_id)
    {
        $data = array(
        'shop_id'=>$shop_id,
        'en' =>$this->security->xss_clean($this->input->post('service_en')),
        'es' =>$this->security->xss_clean($this->input->post('service_es')),
        'fr' =>$this->security->xss_clean($this->input->post('service_fr')),
        'pt' =>$this->security->xss_clean($this->input->post('service_pt')),
        'status'=>'1'
        );
        $this->db->insert('service_category',$data);
        return $this->db->insert_id();
    }
    
    public function getServices()
    {
        $this->db->select('*');
        $this->db->from('service_category');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getServicess()
    {
        $this->db->select('*');
        $this->db->from('service');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function delService($service_id)
    {
        $this->db->where('service_category_id',$service_id);
        $this->db->delete('service_category');
        return $this->db->affected_rows();
    }
    
    public function delServices($service_id)
    {
        $this->db->where('service_id',$service_id);
        $this->db->delete('service');
        return $this->db->affected_rows();
    }
    
    public function doAddServices($shop_id)
    {
        $data = array(
        'service_category_id'=>$this->security->xss_clean($this->input->post('service')),
        'en' =>$this->security->xss_clean($this->input->post('service_en')),
        'es' =>$this->security->xss_clean($this->input->post('service_es')),
        'fr' =>$this->security->xss_clean($this->input->post('service_fr')),
        'pt' =>$this->security->xss_clean($this->input->post('service_pt')),
        'price' =>$this->security->xss_clean($this->input->post('price')),
         'status'=>'1'
        );
        $this->db->insert('service',$data);
        return $this->db->insert_id();
    }
    
    public function doAddcoupon($shop_id)
    {
        $data = array(
        'coupon_code' =>$this->security->xss_clean($this->input->post('coupon_code')),
        'coupon_value' =>$this->security->xss_clean($this->input->post('coupon_value')),
        'user_type'=>'Partner',
        'shop_id'=>$shop_id,
        'status'=>'Active'
        );
        $this->db->insert('coupon',$data);
        return $this->db->insert_id();
    }
    
    public function getCoupon($shop_id)
    {
        $sel = $this->db->get_where('coupon',['shop_id'=>$shop_id]);
        return $sel->result_array();
    }
    
    public function delCoupon($id)
    {
        $this->db->where('coupon_id',$id);
        $this->db->delete('coupon');
        return $this->db->affected_rows();
    }
    
    public function getCouponById($id)
    {
        $sel = $this->db->get_where('coupon',['coupon_id'=>$id]);
        return $sel->row_array();
    }
    
    public function doEditCoupon($id)
    {
        $data = array(
        'coupon_code' =>$this->security->xss_clean($this->input->post('coupon_code')),
        'coupon_value' =>$this->security->xss_clean($this->input->post('coupon_value')),
        
        );
        $this->db->where('coupon_id',$id);
        $this->db->update('coupon',$data);
        return $this->db->affected_rows();
    }

	
 
    
}
?>