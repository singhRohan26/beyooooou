<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * 
 */
class Ecommerce_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
    
    public function getSubcategory()
    {
        $this->db->select('sub_category.sub_category_id,sub_category.image_url,'.$this->session->userdata('lang').' as sub_category_name');
        $this->db->from('sub_category');
        $this->db->order_by('sub_category_id','desc');
        $sel  =$this->db->get();
        return $sel->result_array();
    }
    
    public function getSubcategoryById($id)
    {
        $this->db->select('*');
        $this->db->from('sub_category');
        $this->db->where('category_id',$id);
        $sel  =$this->db->get();
        return $sel->result_array();
    }
    
    public function getCategories()
    {
        $this->db->select('category.category_id,'.$this->session->userdata('lang').' as cat_name');
        $this->db->from('category');
        $this->db->order_by('category_id','desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getSiteLanguages()
    {
        $this->db->select('languages_data.id,languages_data.key,'.$this->session->userdata('lang').' as text');
        $this->db->from('languages_data');       
        $sel = $this->db->get();
        return $sel->result_array();
    }
        
    public function getLanguages()
    {
        $this->db->select('*');
        $this->db->from('language');
        $this->db->order_by('id','desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function doRegistration($unique_id)
    {
        $data = array(
            'user_name' => $this->security->xss_clean($this->input->post('name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password'))),            
            'mobile' => $this->input->post('number'),
            'source' => 'self',
            'unique_id' => $unique_id
        );
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    
    public function doLogin($field, $pass)
    {
        $data = array(
            'email' => $field,
            'password' => $pass,
            'source' => 'self'
        );
        $query = $this->db->get_where('users', $data);
        return $query->row_array();
    }
    
    public function doAddPartner()
    {
        $data = array(            
            'email' => $this->security->xss_clean($this->input->post('partner_email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('partner_password'))),            
            'shop_name_en' => $this->input->post('saloon_name'),
        );
        $this->db->insert('saloon',$data);
        return $this->db->insert_id();
    }
    
    public function getDataByUniqueId($unique_id) {
        $result = $this->db->get_where('users', ['unique_id' => $unique_id]);
        return $result->row_array();
    }
    
    public function getShops($id,$lang)
    {
        $this->db->select('saloon.sub_category_id,saloon.shop_name_'.$lang.' as shop_name,saloon.address_'.$lang.' as address,saloon.image_url,saloon.pincode,saloon.city_'.$lang.' as city,saloon.shop_id');
        $this->db->from('saloon');
        $this->db->where('sub_category_id',$id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function shopFilteration($service,$city,$lang,$id = null)
    {
        $this->db->select('saloon.sub_category_id,saloon.shop_name_'.$lang.' as shop_name,saloon.address_'.$lang.' as address,saloon.image_url,saloon.pincode,saloon.city_'.$lang.' as city,saloon.shop_id');
        $this->db->from('saloon');
        if(!empty($service))
        {
            $this->db->join('service_category','service_category.shop_id=saloon.shop_id');
            $this->db->join('service','service.service_category_id=service_category.service_category_id');
            $this->db->where('service.service_id',$service);
        }
        if(!empty($city))
        {
            $this->db->where('saloon.city_'.$lang,$city);
        }
        if(!empty($id))
        {
            $this->db->where('saloon.sub_category_id',$id);
        }
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getShopById($shop_id)
    {
        $this->db->select('*');
        $this->db->from('saloon');
        $this->db->where('shop_id',$shop_id);
        $sel = $this->db->get();
        return $sel->row_array();
            
    }
    
    public function getServices($shop_id,$lang)
    {
        $this->db->select('service_category.'.$lang.' as service_category,service_category.service_category_id,service.'.$lang.' as service,service.service_id,service.price');
        $this->db->from('service_category');
        $this->db->join('service','service.service_category_id=service_category.service_category_id');
        $this->db->where('service_category.shop_id',$shop_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    public function getServicesGroup($shop_id,$lang)
    {
        $this->db->select('service_category.'.$lang.' as service_category,service_category.service_category_id,service.'.$lang.' as service,service.service_id,service.price');
        $this->db->from('service_category');
        $this->db->join('service','service.service_category_id=service_category.service_category_id');
        $this->db->where('service_category.shop_id',$shop_id);
        $this->db->group_by('service_category.service_category_id');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function checkPostWishlist($shop_id,$user_id)
    {
        $check_query = $this->db->get_where('favourite', ['user_id' => $user_id, 'shop_id' => $shop_id]);
        if ($check_query->num_rows() >= 1) {
            $this->db->delete('favourite', ['user_id' => $user_id, 'shop_id' => $shop_id]);
            return $this->db->affected_rows();
        }

    }
    
    public function addPostWishlist($shop_id, $user_id) {
        $data = array(
            'user_id' => $user_id,
            'shop_id' => $shop_id
           
        );
        $query = $this->db->insert('favourite', $data);
        return 1;
    }
    
    public function getpostWishlist($user_id){
        $query = $this->db->get_where('favourite', ['user_id' => $user_id]);
        return $query->result_array();
    }
    
    public function checkCoupon($coupon_code) {
        $query = $this->db->get_where('coupon', ['coupon_code' => $coupon_code]);
        return $query->row_array();

    }
    
    public function checkCouponByShop($coupon_code, $shop_id)
    {
        $query = $this->db->get_where('coupon', ['coupon_code' => $coupon_code, 'shop_id' => $shop_id]);
        return $query->row_array();
    }
    
    public function getShopTime($shop_id)
    {
        $this->db->select('saloon.from,saloon.to');
        $this->db->from('saloon');
        $this->db->where('shop_id',$shop_id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function getPriceByServiceId($service_id) {
        $this->db->select('price');
        $query = $this->db->get_where('service', ['service_id' => $service_id]);
        return $query->row_array();
    }
    
    public function booking($date, $service, $price, $shop_id, $uniqueId, $total, $discount, $user_id) {
        $data = array(
            'user_id' => $user_id,
            'booking_unique_id' => $uniqueId,
            'shop_id' => $shop_id,
            'booking_date' => $date,
            'booking_time' => $this->input->post('time'),
            'service' => implode(',', $service),
            'service_price' => implode(',', $price),
            'total' => $total,
            'discount' => $discount
        );
        $this->db->insert('booking', $data);
        return $this->db->insert_id();
    }

	public function getBookingById($id) {
        $this->db->select('s.shop_name_en,b.booking_date,booking_time,b.shop_id,b.user_id');
        $this->db->from('booking b');
        $this->db->join('saloon s', 's.shop_id=b.shop_id');
        $this->db->where('b.booking_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
   
    public function getShopDataById($shop_id) {
        $this->db->select('shop_name_en,to,from');
        $query = $this->db->get_where('saloon', ['shop_id' => $shop_id]);
        return $query->row_array();
    }
    
    public function getAllServices()
    {
        $this->db->select('service.'.$this->session->userdata('lang').' as service_name,service.service_id');
        $this->db->from('service');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getAllCities()
    {
        $this->db->select('saloon.city_'.$this->session->userdata('lang').' as city_name');
        $this->db->distinct('city_'.$this->session->userdata('lang'));
        $this->db->from('saloon');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function doAddReviews($shop_id,$user_id,$comment)
    {
            $data = array(
            'shop_id'=>$shop_id,
            'user_id'=>$user_id,
            'review'=>$comment,
            'rating'=>'4',
            'created'=> date('Y-m-d')
        );
        $this->db->insert('review',$data);
        return $this->db->insert_id();
    }
    
    public function getReviewsByShopId($shop_id){
        $this->db->select('users.user_name,users.image_url,review.review,review.rating,review.created');
        $this->db->from('review');
        $this->db->join('users','users.user_id=review.user_id');
        $this->db->where('review.shop_id',$shop_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    
    
}
?>