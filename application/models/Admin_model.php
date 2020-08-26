<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

/**
 * 
 */
class Admin_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}

	
    public function checkLogin()
    {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean($this->input->post('pass'))
        );
        
        $query = $this->db->get_where('admin',$data);
        return $query->row_array();       
        
    }
    
     public function do_check_oldpassword($em){        
        $oldpassword = $this->security->xss_clean($this->input->post('op'));
        $query = $this->db->get_where('admin', ['email'=>$em, 'password'=>$oldpassword]);
        return $query->row_array();
    }
    
    public function reset_password($em){
        $newpassword = $this->security->xss_clean($this->input->post('np'));
        $this->db->where('email',$em);
        $this->db->update('admin',['password'=>$newpassword]);
        return $this->db->affected_rows();
    }
    
    public function doAddAboutus($aboutus,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('site',['text'=>$aboutus]);
        return $this->db->affected_rows();
    }
    
    public function doAddPrivacy($privacy,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('site',['text'=>$privacy]);
        return $this->db->affected_rows();
    }
    
    public function getAboutus()
    {
        $sel = $this->db->get_where('site',['type'=>'about']);
        return $sel->result_array();
    }
    public function getPrivacy()
    {
        $sel = $this->db->get_where('site',['type'=>'privacy']);
        return $sel->result_array();
    }
    public function getTnc()
    {
        $sel = $this->db->get_where('site',['type'=>'tnc']);
        return $sel->row_array();
    }
    
    public function doAddLanguage()
    {
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'code' => $this->security->xss_clean($this->input->post('code'))
        );
        $this->db->insert('language',$data);
        return $this->db->insert_id();
    }
    
    public function getLanguages()
    {
        $this->db->select('*');
        $this->db->from('language');
        $this->db->order_by('id','desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function deleteLanguage($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('language');
        return $this->db->affected_rows();
    }
    
    public function getLanguagesById($id)
    {
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where('id',$id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function doEditLanguage($id)
    {
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'code' => $this->security->xss_clean($this->input->post('code'))
        );        
        $this->db->where('id',$id);
        $this->db->update('language',$data);
        return $this->db->affected_rows();
        
    }
    
    public function getPartner()
    {
        $this->db->select('*');
        $this->db->from('saloon');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function activatePartnerStatus($id)
    {
        $this->db->where('shop_id',$id);
        $this->db->update('saloon',['status'=>'Active']);
        return $this->db->affected_rows();
    }
    
    public function inactivatePartnerStatus($id)
    {
        $this->db->where('shop_id',$id);
        $this->db->update('saloon',['status'=>'Inactive']);
        return $this->db->affected_rows();
    }
    
}
?>