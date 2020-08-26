<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * 
 */
class User_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
    
    
    public function doUpdateProfile($user_id,$file1)
    {
        $data = array(
            'user_name' => $this->security->xss_clean($this->input->post('name')),                        
            'mobile' => $this->security->xss_clean($this->input->post('number')),
            'location'=>$this->security->xss_clean($this->input->post('location')),
            'image_url'=>$file1
            
        );
       $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
        return $this->db->affected_rows();
        
    }
    
     public function verify_username() {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $this->input->post('forgot_email'));
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function insert_user_activationcode($activationcode, $result) {
        $data = array(
            'user_id' => $result['user_id'],
            'activationcode' => $activationcode
        );
        $this->db->insert('user_email_verify', $data);
        return $this->db->insert_id();
    }
    
    public function update_user_email_status($user_id, $activationcode) {
        $query = $this->db->get_where('user_email_verify', ['user_id' => $user_id, 'activationcode' => $activationcode, 'status' => 'Inactive']);
        if (!empty($query->row_array())) {
            $this->db->update('user_email_verify', ['status' => 'Active'], ['user_id' => $user_id, 'activationcode' => $activationcode]);
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }
    
    public function do_check_oldpassword($email){
        $oldpassword = $this->security->xss_clean(hash('sha256', $this->input->post('op')));
        $query = $this->db->get_where('users', ['email'=>$email, 'password'=>$oldpassword]);
        return $query->row_array();
    }
    
    public function reset_password($email){
        $newpassword = $this->security->xss_clean(hash('sha256', $this->input->post('np')));
        $this->db->update('users', ['password'=>$newpassword], ['email'=>$email]);
        return $this->db->affected_rows();
    }
    
    public function getWishList($user_id,$lang)
    {
        $this->db->select('favourite.*,saloon.sub_category_id,saloon.shop_name_'.$lang.' as shop_name,saloon.address_'.$lang.' as address,saloon.image_url,saloon.pincode,saloon.city_'.$lang.' as city,saloon.shop_id');
        $this->db->from('favourite');
        $this->db->join('saloon','saloon.shop_id=favourite.shop_id');
        $this->db->where('favourite.user_id',$user_id);
        $sel = $this->db->get();
        return $sel->result_array();
        
    }
    
    public function getBooking($user_id)
    {
        $this->db->select('b.*');
        $this->db->from('booking b');        
        $this->db->where('b.user_id', $user_id);
        $this->db->order_by('booking_date', 'desc');        
        $query = $this->db->get();        
        return $query->result_array();
    }
    
    public function getSaloonDetailsById($shop_id) {
        $this->db->select('s.*');
        $this->db->from('saloon s');        
        $this->db->where('s.shop_id', $shop_id);        
        $query = $this->db->get();        
        return $query->row_array();
    }
    
    public function getServiceNameById($id) {
        $query = $this->db->get_where('service', ['service_id' => $id]);
        return $query->row_array();
    }
    
    public function cancelOrder($booking_id)
    {
         $this->db->update('booking', ['status' => 'Cancelled'], ['booking_id' => $id]);        
        return $this->db->affected_rows();
    }
    

	
   
    
}
?>