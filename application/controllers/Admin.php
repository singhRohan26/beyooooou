<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Admin_model']);
    }
    
    public function index()
    {
        $this->load->view('admin/login');
    }
    
    public function checkLogin() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Admin_model->checkLogin();
        if ($result) {            
            $this->session->set_userdata('email', $this->input->post('email'));
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Admin/dashboard'), 'msg' => 'Loading!! Please Wait']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
            return FALSE;
        }
    }
    
    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/dashboard');
        $this->load->view('admin/commons/footer');
    }
    
    public function logout(){        
        $this->session->unset_userdata('email');
        redirect(base_url('Admin'));
    }
    
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/changePassword');
        $this->load->view('admin/commons/footer');
    }
    
    public function doChangePassword(){
        $this->output->set_content_type('application/json');
        $em = $this->session->userdata('email');
        $this->form_validation->set_rules('op', 'Old Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $this->form_validation->set_rules('np', 'New Password', 'required');
        $this->form_validation->set_rules('cp', 'Confirm Password', 'required|matches[np]');
        $result = $this->Admin_model->do_check_oldpassword($em);
        if(empty($result)){
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Old password did not match Current Password!']));
                return FALSE;
        }else{
            if($this->input->post('op') == $this->input->post('np')){
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Current Password and New Password should not be same!']));
                return FALSE;
            }
            if ($this->form_validation->run() === FALSE) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
                return FALSE;
            }
        }
        $changed = $this->Admin_model->reset_password($em);
        if ($changed) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Admin/dashboard'), 'msg' => 'Password Changed Sucessfully.']));
            return FALSE;
        }
    }
    
    public function aboutUs()
    {        
        $data['title'] = 'About Us';
        $data['aboutus'] = $this->Admin_model->getAboutus();
        $data['getLanguages'] = $this->Admin_model->getLanguages();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/aboutus',$data);
        $this->load->view('admin/commons/footer');
        
    }
    
    public function doAddAboutus($id)
    {
      $this->output->set_content_type('application/json');
      $aboutus = $this->input->post('aboutus');
      $result = $this->Admin_model->doAddAboutus($aboutus,$id);
      if($result)
      {
          $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Admin/aboutUs'), 'msg' => 'About Us Updated']));
            return FALSE;
      }else{
          $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Update']));
            return FALSE;
      }
        
    }
    
    public function privacyPolicy()
    {
        $data['title'] = 'Privacy Policy';
        $data['getLanguages'] = $this->Admin_model->getLanguages();
        $data['getprivacy'] = $this->Admin_model->getprivacy();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/privacy');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddPrivacy($id)
    {
      $this->output->set_content_type('application/json');
      $privacy = $this->input->post('privacy');
      $result = $this->Admin_model->doAddPrivacy($privacy,$id);
      if($result)
      {
          $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Admin/privacyPolicy'), 'msg' => 'Privacy Policy Updated']));
            return FALSE;
      }else{
          $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Update']));
            return FALSE;
      }
    }
    
    public function tnc()
    {
        $data['title'] = 'Terms and Conditions';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/tnc');
        $this->load->view('admin/commons/footer');
    }
    
    public function languages()
    {
        $data['title'] = 'Languages';
        $data['getLanguages'] = $this->Admin_model->getLanguages();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/languages',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddLanguage()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Language Name', 'required');
        $this->form_validation->set_rules('code', 'Language Code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }        
        $result = $this->Admin_model->doAddLanguage();
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Admin/languages'), 'msg' => 'Language Added']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function deleteLanguage($id)
    {
       $this->output->set_content_type('application/json');
        $result = $this->Admin_model->deleteLanguage($id);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Admin/languages'), 'msg' => 'Language Deleted']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to delete']));
            return FALSE;
        }
    }
    
    public function editLanguage($id)
    {
        $data['title'] = 'Edit Language';
        $data['getLanguagesById'] = $this->Admin_model->getLanguagesById($id);
        $data['getLanguages'] = $this->Admin_model->getLanguages();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/languages',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doEditLanguage($id)
    {  
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Language Name', 'required');
        $this->form_validation->set_rules('code', 'Language Code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }        
        $result = $this->Admin_model->doEditLanguage($id);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Admin/languages'), 'msg' => 'Language Updated']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Update']));
            return FALSE;
        }
    }
    
    public function faq()
    {
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/faq');
        $this->load->view('admin/commons/footer');
    }
    
    public function partnerRequest()
    {
        $data['title'] = 'Partner Request';
        $data['getPartner'] = $this->Admin_model->getPartner();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/partnerRequest',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function activatePartnerStatus($id)
    {        
        $result = $this->Admin_model->activatePartnerStatus($id);
        if($result)
        {            
            redirect('Admin/partnerRequest');
        }        
    }
    
    public function inactivatePartnerStatus($id)
    {
        $result = $this->Admin_model->inactivatePartnerStatus($id);
        if($result)
        {
            redirect('Admin/partnerRequest');
        }
    }
    
    
    
    
    
   
}
?>