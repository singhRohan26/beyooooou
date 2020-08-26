<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Admin_model']);
        $this->load->model(['Category_model']);
        $this->load->model(['Ecommerce_model']);
        $this->load->model(['User_model']);
        if(empty($this->session->userdata('lang'))){
            $this->session->set_userdata('lang', 'en');
        }
    }
    
    public function getDataByUniqueId() {
        if (!empty($this->session->userdata('unique_id'))) {
            $unique_id = $this->session->userdata('unique_id');
            $data = $this->Ecommerce_model->getDataByUniqueId($unique_id);
            return $data;
        }
    }
    
    public function userProfile()
    {
        if(empty($this->session->userdata('unique_id')))
        {
            redirect('/');
        }
        $data['UserDetails'] = $this->getDataByUniqueId();
        $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
        $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
        $lang = $this->session->userdata('lang');
        $data['getWishList'] = $this->User_model->getWishList($data['UserDetails']['user_id'],$lang);
        $data['getBooking'] = $book = $this->User_model->getBooking($data['UserDetails']['user_id']);
        
        $serve_name = array();
        $i = 0;
            
        foreach ($book as $bookings) {
            $services = explode(',', $bookings['service']);
            $list = [];
            $j = 0;
            $serve_name[$i]['shop_id'] = $bookings['shop_id'];
            $serve_name[$i]['booking_id'] = $bookings['booking_id'];
            $serve_name[$i]['status'] = $bookings['status'];
            $serve_name[$i]['total'] = $bookings['total'];
            $serve_name[$i]['discount'] = $bookings['discount'];
            $shop_detail = $this->User_model->getSaloonDetailsById($serve_name[$i]['shop_id']);
            $serve_name[$i]['shop_name'] = $shop_detail['shop_name_en'];
            $serve_name[$i]['shop_image'] = base_url('uploads/shop/' . $shop_detail['image_url']);
            $new_date = date('d-m-Y', strtotime($bookings['booking_date']));
            $serve_name[$i]['day'] = date('F', strtotime($new_date));
            $serve_name[$i]['booking_time'] = date('h:i A', strtotime($bookings['booking_time']));
            $day = date('l', strtotime($new_date));
            $month = date('F', strtotime($new_date));
            $date = date('d', strtotime($new_date));
            $serve_name[$i]['booking_date'] = $month;
            $serve_name[$i]['booking_date_month'] = substr($day, 0, 3) . ' ' . $date . ',' . $month;
            foreach ($services as $service) {
                $ser = $this->User_model->getServiceNameById($service);
                $serve_name[$i]['service_name'][$j] = $ser['en'];
                $j++;
            }
            $i++;
        }
        
        $data['services'] = $serve_name;
        $this->load->view('front/commons/header');
        $this->load->view('front/commons/navbar',$data);
        $this->load->view('front/details',$data);
        $this->load->view('front/commons/footer',$data);
    }
    
    public function doUpdateProfile()
    {
        $this->output->set_content_type('application/json');        
        $this->form_validation->set_rules('name', 'Name', 'required');        
        $this->form_validation->set_rules('number', 'Phone Number', 'required');
        $this->form_validation->set_rules('location', 'Address', 'required');        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $userDetails = $this->getDataByUniqueId();
        $user_id = $userDetails['user_id'];
        $img = $userDetails['image_url'];
        if(!empty($_FILES['file1']['name'])){
            
            $file1=$this->doUploadFile('file1');
        }if(empty($_FILES['file1']['name'])){
            $file1=$img;
        }
        $result = $this->User_model->doUpdateProfile($user_id,$file1);
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Profile Updated', 'user_id' => $result, 'url' => base_url('User/userProfile')]));
            return FALSE;
        }else
        {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Update']));
            return FALSE;
        }
        
    }
    
    public function doUploadFile($file)
    {        
        $file1 = $_FILES[$file]['name'];
        $config['upload_path'] = './uploads/users/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';       
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
    }
    
    
    public function forgot_password_checked() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('forgot_email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->User_model->verify_username();
        
        if ($result) {
            $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $activationcode = substr(str_shuffle($str), 0, 10);
            $this->send_forgot_password_link($result, $activationcode);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Reset Password Link has been Sent to Your E-mail Id.Please Check your E-mail.', 'url' => base_url('/')]));
            return FALSE;
        }else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'User does not exist..!!']));
            return FALSE;
        }
    }
    
    public function send_forgot_password_link($result, $activationcode) {
        $this->load->library('email');
        $getEmailResponse = $this->Ecommerce_model->insert_user_activationcode($activationcode, $result);
        $htmlContent = "<h3>Dear " . $result['user_name'] . ",</h3>";
        $htmlContent .= "<div style='padding-top:8px;'>Please Click The following link to Update your password..</div>";
        $htmlContent .= base_url('User/passwordReset/' . $result['user_id'] . '/' . $activationcode) . " Click Here!";
        $to = $result['email'];
        $subject = 'Hey!, ' . $result['user_name'] . ' your reset password link';
        $message = $htmlContent;
            $header = "from:BeYoou<info@beyou.com> \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail ($to,$subject,$message,$header);
        return true;
    }
    
    public function passwordReset($user_id,$activationcode)
    {
        if(empty($this->session->userdata('unique_id')))
        {
            redirect('/');
        }
        $data['user_id'] = $user_id;
        $checkResponse = $this->User_model->update_user_email_status($user_id, $activationcode);
        $data['title'] = "Reset Password";
         $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
        $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
        if ($checkResponse) {            
        $this->load->view('front/commons/header');
        $this->load->view('front/commons/navbar',$data);
        $this->load->view('front/resetPassword',$data);
        $this->load->view('front/commons/footer',$data);
        } else {
            echo "This is the Wrong or Expired Activation Code";
        }
    }
    
    public function doChangePassword()
    {
         $this->output->set_content_type('application/json');
         $data['user_data'] = $user = $this->getDataByUniqueId();
        $this->form_validation->set_rules('op', 'Old Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $this->form_validation->set_rules('np', 'New Password', 'required');
        $this->form_validation->set_rules('cp', 'Confirm Password', 'required|matches[np]');
        $result = $this->User_model->do_check_oldpassword($user['email']);
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
        $changed = $this->User_model->reset_password($user['email']);
        if ($changed) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('/'), 'msg' => 'Password Updated Sucessfully.']));
            return FALSE;
        }
    }
    
    public function cancelOrder($booking_id){
        $this->output->set_content_type('application/json');
        $result = $this->User_model->cancelOrder($booking_id);
        if (!empty($result)) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Your Booking Successfully Cancelled!', 'url' => base_url('User/userProfile')]));
            return FALSE;
        }
    }
    
    
    
   
}
?>