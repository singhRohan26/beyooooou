<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

class Partner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Partner_model']);
        $this->load->model(['Category_model']);
        $this->load->model(['Ecommerce_model']);
        $this->load->model(['User_model']);
        if(empty($this->session->userdata('lang'))){
            $this->session->set_userdata('lang', 'en');
        }
    }
    
    public function index()
    {
        $this->load->view('partner/login');
    }
    
    public function getDataByEmail()
    {
        if (!empty($this->session->userdata('email'))) {
            $unique_id = $this->session->userdata('email');
            $data = $this->Partner_model->getDataByEmail($unique_id);
            return $data;
        }
    }
    
    public function checkLogin()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Partner_model->checkLogin();
        if ($result) {            
            $this->session->set_userdata('email', $this->input->post('email'));
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/dashboard'), 'msg' => 'Loading!! Please Wait']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
            return FALSE;
        }
    }
    
    public function dashboard()
    {
        if(empty($this->session->userdata('email')))
        {
            redirect('Partner');
        }
        $data['title']  = 'Partner Dashboard';
        $data['partnerDetails'] = $this->getDataByEmail();
        $this->load->view('partner/commons/header',$data);
        $this->load->view('partner/commons/sidebar');
        $this->load->view('partner/commons/navbar',$data);        
        $this->load->view('admin/dashboard',$data);
        $this->load->view('partner/commons/footer');
    }
    
    public function logout(){        
        $this->session->unset_userdata('email');
        redirect(base_url('Partner'));
    }
    
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['partnerDetails'] = $this->getDataByEmail();
        $this->load->view('partner/commons/header',$data);
        $this->load->view('partner/commons/sidebar');
        $this->load->view('partner/commons/navbar');        
        $this->load->view('partner/changePassword');
        $this->load->view('partner/commons/footer');
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
        $result = $this->Partner_model->do_check_oldpassword($em);
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
        $changed = $this->Partner_model->reset_password($em);
        if ($changed) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/dashboard'), 'msg' => 'Password Changed Sucessfully.']));
            return FALSE;
        }
    }
    
    public function myProfile()
    {
        $data['title'] = 'My Profile';
        $data['partnerDetails'] = $this->getDataByEmail();        
        $shop_id = $data['partnerDetails']['shop_id'];
        $data['shop_id'] =$shop_id;
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getsubcategories'] = $this->Category_model->getsubcategories();
        $data['getsuperchildcategories'] = $this->Partner_model->getsuperchildcategories();
        $data['getPartnerdetails']  = $this->Partner_model->getPartnerdetails($shop_id);
        $this->load->view('partner/commons/header',$data);
        $this->load->view('partner/commons/sidebar');
        $this->load->view('partner/commons/navbar');        
        $this->load->view('partner/myProfile',$data);
        $this->load->view('partner/commons/footer');
    }
    
    public function doUpdateProfile($shop_id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('subcategory', 'Sub Category', 'required');
        $this->form_validation->set_rules('childcategory', 'Child category', 'required');
        $this->form_validation->set_rules('superchild', 'Super child category', 'required');
        $this->form_validation->set_rules('shop_name_en', 'Shop name(en)', 'required');
        $this->form_validation->set_rules('shop_name_es', 'Shop name(es)', 'required');
        $this->form_validation->set_rules('shop_name_fr', 'Shop name(fr)', 'required');
        $this->form_validation->set_rules('shop_name_pt', 'Shop name(pt)', 'required');
        $this->form_validation->set_rules('code', 'Pin code', 'required');
        $this->form_validation->set_rules('from', 'From time', 'required');
        $this->form_validation->set_rules('to', 'To time', 'required');
        $this->form_validation->set_rules('city_name_en', 'City name(en)', 'required');
        $this->form_validation->set_rules('city_name_es', 'City name(es)', 'required');
        $this->form_validation->set_rules('city_name_fr', 'City name(fr)', 'required');
        $this->form_validation->set_rules('city_name_pt', 'City name(pt)', 'required');
        $this->form_validation->set_rules('state_name_en', 'State name(en)', 'required');
        $this->form_validation->set_rules('state_name_es', 'State name(es)', 'required');
        $this->form_validation->set_rules('state_name_fr', 'State name(fr)', 'required');
        $this->form_validation->set_rules('state_name_pt', 'State name(pt)', 'required');
        $this->form_validation->set_rules('add_en', 'Address(en)', 'required');
        $this->form_validation->set_rules('add_es', 'Address(es)', 'required');
        $this->form_validation->set_rules('add_fr', 'Address(fr)', 'required');
        $this->form_validation->set_rules('add_pt', 'Address(pt)', 'required');
        $this->form_validation->set_rules('about', 'Description', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadProfileImage('image_url');
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $user = $this->getDataByEmail();
            $image_url = $user['image_url'];
        }
        if (!empty($_FILES['banner_url']['name'])) {
            $banner_url = $this->doUploadBannerImage('banner_url');
            if (!$banner_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $user = $this->getDataByEmail();
            $banner_url = $user['banner_url'];
        }
        
        $result = $this->Partner_model->doUpdateProfile($shop_id,$image_url,$banner_url);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/dashboard'), 'msg' => 'Profile Updated']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to update']));
                return FALSE;
        }   
        
        
    }
    
      public function doUploadProfileImage($image_url) {
        $file1 = $_FILES[$image_url]['name'];
        $config['upload_path'] = './uploads/shop/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        $this->upload->do_upload($image_url);
        $upload_data = $this->upload->data();
        if($upload_data){
            return $upload_data['file_name'];
        }else{
              $this->session->set_userdata('error', [$image_url => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function doUploadBannerImage($banner_url) {
        $file1 = $_FILES[$banner_url]['name'];
        $config['upload_path'] = './uploads/banner/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        $this->upload->do_upload($banner_url);
        $upload_data = $this->upload->data();
        if($upload_data){
            return $upload_data['file_name'];
        }else{
              $this->session->set_userdata('error', [$banner_url => $this->upload->display_errors()]);
            return 0;
        }
    
    }
    
    public function serviceCategory()
    {
        $data['title'] = 'Add services Category';
        $data['partnerDetails'] = $this->getDataByEmail();
        $data['getServices'] = $this->Partner_model->getServices();
        $this->load->view('partner/commons/header',$data);
        $this->load->view('partner/commons/sidebar');
        $this->load->view('partner/commons/navbar');        
        $this->load->view('partner/serviceCategory',$data);
        $this->load->view('partner/commons/footer');
    }
    
    public function doAddServicecategory()
    {
        $this->output->set_content_type('application/json');        
        $this->form_validation->set_rules('service_en', 'Services(en)', 'required');
        $this->form_validation->set_rules('service_es', 'Services(es)', 'required');
        $this->form_validation->set_rules('service_fr', 'Services(fr)', 'required');
        $this->form_validation->set_rules('service_pt', 'Services(pt)', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $partner_details = $data['partnerDetails'] = $this->getDataByEmail();
        $result = $this->Partner_model->doAddServicecategory($partner_details['shop_id']);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/serviceCategory'), 'msg' => 'Service Added']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to add']));
                return FALSE;
        }
    }
    
    public function delService($service_id)
    {
        $this->output->set_content_type('application/json');
        $result = $this->Partner_model->delService($service_id);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/serviceCategory'), 'msg' => 'Service Deleted']));
            return FALSE;
        }else
        {
            $this->output->set_output(json_encode(['result' => -1,'url' => base_url('Partner/serviceCategory'), 'msg' => 'Failed to delete']));
                return FALSE;
        }
    }
    
    public function service()
    {
        $data['title'] = 'Add services';
        $data['partnerDetails'] = $this->getDataByEmail();
        $data['getServicescategory'] = $this->Partner_model->getServices();
        $data['getServices'] = $this->Partner_model->getServicess();
        $this->load->view('partner/commons/header',$data);
        $this->load->view('partner/commons/sidebar');
        $this->load->view('partner/commons/navbar');        
        $this->load->view('partner/service',$data);
        $this->load->view('partner/commons/footer');
    }
    
    public function doAddServices()
    {
        $this->output->set_content_type('application/json');        
        $this->form_validation->set_rules('service', 'Service Category', 'required');
        $this->form_validation->set_rules('service_en', 'Services(en)', 'required');
        $this->form_validation->set_rules('service_es', 'Services(es)', 'required');
        $this->form_validation->set_rules('service_fr', 'Services(fr)', 'required');
        $this->form_validation->set_rules('service_pt', 'Services(pt)', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $partner_details = $data['partnerDetails'] = $this->getDataByEmail();
        $result = $this->Partner_model->doAddServices($partner_details['shop_id']);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/service'), 'msg' => 'Service Added']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to add']));
                return FALSE;
        }
    }
    
    public function delServices($service_id)
    {
        $this->output->set_content_type('application/json');
        $result = $this->Partner_model->delServices($service_id);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/service'), 'msg' => 'Service Deleted']));
            return FALSE;
        }else
        {
            $this->output->set_output(json_encode(['result' => -1,'url' => base_url('Partner/service'), 'msg' => 'Failed to delete']));
                return FALSE;
        }
    }
    
    public function coupon()
    {        
        $data['title'] = 'Add Coupon';
        $data['partnerDetails'] = $this->getDataByEmail();
        $data['getCoupon'] = $this->Partner_model->getCoupon($data['partnerDetails']['shop_id']);
        $this->load->view('partner/commons/header',$data);
        $this->load->view('partner/commons/sidebar');
        $this->load->view('partner/commons/navbar');        
        $this->load->view('partner/coupon',$data);
        $this->load->view('partner/commons/footer');
    }
    
    public function doAddcoupon()
    {
        $this->output->set_content_type('application/json');        
        $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
        $this->form_validation->set_rules('coupon_value', 'Coupon Value', 'required');        
        if ($this->form_validation->run() === FALSE) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return FALSE;
        }
        $shop_id = $this->getDataByEmail();
        $result = $this->Partner_model->doAddcoupon($shop_id['shop_id']);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/coupon'), 'msg' => 'Coupon Added']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to add']));
                return FALSE;
        }
    }
    
    public function delCoupon($id)
    {
        $this->output->set_content_type('application/json'); 
        $result = $this->Partner_model->delCoupon($id);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/coupon'), 'msg' => 'Coupon Deleted']));
            return FALSE;            
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to delete']));
                return FALSE;
        }
    }
    
    public function editCoupon($id)
    {
        $data['title'] = 'Add Coupon';
        $data['partnerDetails'] = $this->getDataByEmail();
        $data['getCoupon'] = $this->Partner_model->getCoupon($data['partnerDetails']['shop_id']);
        $data['getCouponById'] = $this->Partner_model->getCouponById($id);
        $this->load->view('partner/commons/header',$data);
        $this->load->view('partner/commons/sidebar');
        $this->load->view('partner/commons/navbar');        
        $this->load->view('partner/coupon',$data);
        $this->load->view('partner/commons/footer');
    }
    
    public function doEditCoupon($id)
    {
        $this->output->set_content_type('application/json');        
        $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
        $this->form_validation->set_rules('coupon_value', 'Coupon Value', 'required');        
        if ($this->form_validation->run() === FALSE) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return FALSE;
        }
        
        $result = $this->Partner_model->doEditCoupon($id);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Partner/coupon'), 'msg' => 'Coupon Updated']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1,'url' => base_url('Partner/coupon'), 'msg' => 'Failed to update']));
                return FALSE;
        }
    }
}
?>