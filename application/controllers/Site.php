<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Admin_model']);
        $this->load->model(['Category_model']);
        $this->load->model(['Ecommerce_model']);
        if(empty($this->session->userdata('lang'))){
            $this->session->set_userdata('lang', 'en');
        }
    }
    
    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 10);
        return $unique_id;
    }
    
    public function getDataByUniqueId() {
        if (!empty($this->session->userdata('unique_id'))) {
            $unique_id = $this->session->userdata('unique_id');
            $data = $this->Ecommerce_model->getDataByUniqueId($unique_id);
            return $data;
        }
    }
    
    public function index()
    {
        $data['allCategories'] = $this->Ecommerce_model->getCategories(); 
        $data['getSubcategory'] = $this->Ecommerce_model->getSubcategory();
        $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
        $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
        $data['getServices'] = $this->Ecommerce_model->getAllServices();
        $data['getAllCities'] = $this->Ecommerce_model->getAllCities();
        $this->load->view('front/commons/header');
        $this->load->view('front/commons/navbar',$data);
        $this->load->view('front/index',$data);
        $this->load->view('front/commons/footer',$data);
    }
    
    public function doCategoryFilter($id){
        $this->output->set_content_type('application/json');        
        $data['getSubcategory'] = $this->Ecommerce_model->getSubcategoryById($id);
        $content_wrapper = $this->load->view('front/include/category_wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function changeLanguage(){
        $this->session->set_userdata('lang', $this->input->post('val'));
    }
    
    public function doRegistration(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This {field} field is already taken');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('number', 'Phone Number', 'required');
        $this->form_validation->set_rules('registerr', 'Terms and Conditions', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }        
        $unique_id = $this->uniqueId();
        $result = $this->Ecommerce_model->doRegistration($unique_id);
        if ($result){
            $this->session->set_userdata('unique_id', $unique_id);            
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Registered Successfully', 'user_id' => $result, 'url' => base_url('/')]));
            return FALSE;
        }else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'You have already created you account!!Please login']));
            return FALSE;
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata('unique_id');        
        redirect(base_url('/'));
    }
    
    public function doLogin()
    {
        $this->output->set_content_type('application/json');        
        $this->form_validation->set_rules('login_email', 'Email', 'required');
        $this->form_validation->set_rules('login_password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $field = $this->security->xss_clean($this->input->post('login_email'));
        $pass = $this->security->xss_clean(hash('sha256', $this->input->post('login_password')));
        $result = $this->Ecommerce_model->doLogin($field, $pass);
        if ($result) {
            $this->session->set_userdata('unique_id', $result['unique_id']);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Succesfully ', 'url' => base_url('/')]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Email or Password']));
        }
        return FALSE;
    }
    
    public function doAddPartner()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This {field} field is already taken');
        $this->form_validation->set_rules('partner_email', 'Email', 'required|is_unique[saloon.email]');
        $this->form_validation->set_rules('partner_password', 'Password', 'required');
        $this->form_validation->set_rules('saloon_name', 'Organisation Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }        
        $result = $this->Ecommerce_model->doAddPartner();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Registered Successfully', 'url' => base_url('/')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong please try again!.']));
            return FALSE;
        }
    }
    
    public function shopsListing($id = null)
    {
        $data['title'] = 'Shop Listings';
        $lang = $this->session->userdata('lang');
        $data['user']  =$this->getDataByUniqueId();
        $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
        $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
        if(!empty($id)){
            $data['id'] = $id;
            $data['getShops'] = $this->Ecommerce_model->getShops($id,$lang);
        }else{
            $data['id'] = '';
            $id = "";
            $service = $this->session->flashdata('service');
            $city = $this->session->flashdata('city');
            $data['getShops'] = $this->Ecommerce_model->shopFilteration($service,$city,$lang,$id);
        }
        
        $data['wishlists'] = $this->Ecommerce_model->getPostWishlist($data['user']['user_id']);        
        $arr = [];
        foreach ($data['wishlists'] as $wishlist) {
            $arr[] = $wishlist['shop_id'];
        }
        $data['wishlists'] = $arr;
        $data['getServices'] = $this->Ecommerce_model->getAllServices();
        $data['getAllCities'] = $this->Ecommerce_model->getAllCities();
        $this->load->view('front/commons/header');
        $this->load->view('front/commons/navbar',$data);
        $this->load->view('front/shopsListing',$data);
        $this->load->view('front/commons/footer',$data);
    }
    
    public function shop_wrapper($id = null)
    {
        $this->output->set_content_type('application/json');
        if(empty($id)){
            $id = "";
        }
        $data['title'] = 'Shop Listings';        
        $lang = $this->session->userdata('lang');
        $service = $this->input->post('service');
        $city = $this->input->post('location');
        $data['user']  =$this->getDataByUniqueId();
        $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
        $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
        $data['getShops'] = $this->Ecommerce_model->shopFilteration($service,$city,$lang,$id);
        $data['wishlists'] = $this->Ecommerce_model->getPostWishlist($data['user']['user_id']);        
        $arr = [];
        foreach ($data['wishlists'] as $wishlist) {
            $arr[] = $wishlist['shop_id'];
        }
        $data['wishlists'] = $arr;
        $data['getServices'] = $this->Ecommerce_model->getAllServices();
        $data['getAllCities'] = $this->Ecommerce_model->getAllCities();
        $content_wrapper = $this->load->view('front/include/shop_wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function shopFrontFilter(){
        $this->output->set_content_type('application/json');
        $this->session->set_flashdata('service', $this->input->post('service'));
        $this->session->set_flashdata('city', $this->input->post('city'));
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Site/shopsListing')]));
        return FALSE;
    }
    
    public function shopFilteration($id = null)
    {
        $this->output->set_content_type('application/json');
        if(empty($id)){
            $id = "";
        }
        $service = $this->input->post('service');
        $city = $this->input->post('city');
        $lang = $this->session->userdata('lang');
        $data['user']  =$this->getDataByUniqueId();
        $result = $this->Ecommerce_model->shopFilteration($service,$city,$lang,$id);
        $data['getShops'] = $result;
        $content_wrapper = $this->load->view('front/include/shop_wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function shopDetails($shop_id)
    {
        $data['title'] = 'Shop Details';
        $data['shop_chk_id'] = $shop_id;
        $data['lang'] = $lang = $this->session->userdata('lang');
        $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
        $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
        $data['getShopById'] = $this->Ecommerce_model->getShopById($shop_id);
        $data['getServices'] = $this->Ecommerce_model->getServices($shop_id,$lang);
        $data['getServices1'] = $this->Ecommerce_model->getServicesGroup($shop_id,$lang);
        $data['getReviews'] = $this->Ecommerce_model->getReviewsByShopId($shop_id);
        $this->load->view('front/commons/header');
        $this->load->view('front/commons/navbar',$data);
        $this->load->view('front/shopDetail',$data);
        $this->load->view('front/commons/footer',$data);
    }
    
    public function doAddWishlist($shop_id){
        $this->output->set_content_type('application/json');
        $user_id = $this->getDataByUniqueId();
        $checkingResponse = $this->Ecommerce_model->checkPostWishlist($shop_id, $user_id['user_id']);
        if ($checkingResponse){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Product successfully deleted from wishlist!.']));
            return FALSE;
        }else{
            $response = $this->Ecommerce_model->addPostWishlist($shop_id, $user_id['user_id']);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Product successfully added to wishlist!.']));
            return FALSE;
        }        
    }
    
    public function addToCart($shop_id,$service,$service_id,$price) {
        $this->output->set_content_type('application/json');
        $data = array(
            'id' => $service_id,
            'name' => str_replace('%20', '-', $service),
            'shop_id' => $shop_id,
            'qty' => '1',
            'price' => $price,            
        );
        $cart = $this->cart->insert($data);               
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    
    public function cart(){
    
        $data['title'] = 'Your Cart';
        $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
        $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
        if(!empty($this->cart->contents()))
        {
            foreach($this->cart->contents() as $cart)
            {
                $shop_id = $cart['shop_id'];
                $res = $this->Ecommerce_model->getShopTime($shop_id);
                $data['shop_time'] = $res['from'].' To '.$res['to'];
            }
        }
        $this->load->view('front/commons/header');
        $this->load->view('front/commons/navbar',$data);
        $this->load->view('front/cart',$data);
        $this->load->view('front/commons/footer',$data);
    }
    
    public function applyCoupon() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $coupon_code = $this->input->post('coupon_code');
        $type = $this->Ecommerce_model->checkCoupon($coupon_code);
        if ($type['user_type'] == 'Admin') {
            $result = $this->site_model->checkCoupon($coupon_code);
        } else {
            foreach ($this->cart->contents() as $cart) {
                $shop_id = $cart['shop_id']['0'];
            }
            $result = $this->Ecommerce_model->checkCouponByShop($coupon_code, $shop_id);
        }

        if (!empty($result)) {
            $discount_msg = 'Discount(' . $result['coupon_value'] . '% Off)';
            $discount_val = ($this->cart->total() / 100) * $result['coupon_value'];
            $this->session->set_userdata('discount', $result['coupon_value']);
            $this->session->set_userdata('discount_msg', $discount_msg);
            $this->session->set_userdata('discount_val', $discount_val);
            $data['user_data'] = $this->getDataByUniqueId();            
            $data['title'] = 'Your Cart';
            $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
            $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
            $this->load->view('front/commons/header');
            $this->load->view('front/commons/navbar',$data);
            $this->load->view('front/cart',$data);
            $this->load->view('front/commons/footer',$data);
            
            $this->output->set_output(json_encode(['result' => 1, 'msg' => "Coupon Applied"]));
        } else {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => ['coupon_code' => 'Expired Or Invalid Coupon Code']]));
        }
        return FALSE;
    }
    
    
    public function removeCoupon() {
        $this->output->set_content_type('application/json');
        $this->session->unset_userdata('discount_msg');
        $this->session->unset_userdata('discount_val');
        $this->session->unset_userdata('discount');
        $data['user_data'] = $this->getDataByUniqueId();            
            $data['title'] = 'Your Cart';
            $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
            $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
            $this->load->view('front/commons/header');
            $this->load->view('front/commons/navbar',$data);
            $this->load->view('front/cart',$data);
            $this->load->view('front/commons/footer',$data);
        $this->output->set_output(json_encode(['result' => 1, 'msg' => "success"]));
    }
    
    public function removeFromCart($rowid) {
        $this->output->set_content_type('application/json');
        $this->session->unset_userdata('discount_val');
        $this->cart->update(['rowid' => $rowid, 'qty' => 0]);
        $discount_val = ($this->cart->total() / 100) * $this->session->userdata('discount');
        $this->session->set_userdata('discount_val', $discount_val);
        $this->output->set_output(json_encode(['result' => 1]));
        
        return FALSE;
    }
    
    public function booking()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $date = date('Y-m-d', strtotime($this->input->post('date')));
        $i = 0;
        $service = [];
        $salon_id;
        $price = [];
        foreach ($this->cart->contents() as $cart) {
            $shop_id = $cart['shop_id'];
            $service[$i] = $cart['id'];
            $price_value = $this->Ecommerce_model->getPriceByServiceId($cart['id']);
            $price[$i] = $price_value['price'];
            $i++;
        }
        $user_data = $this->getDataByUniqueId();
        $to_email = $user_data['email'];
        $total = $this->cart->total();
        $discount_val = $this->session->userdata('discount_val');
        $discount = $total - $discount_val;
        $result = $this->Ecommerce_model->booking($date, $service, $price, $shop_id, $this->uniqueId(), $total, $discount, $user_data['user_id']);
        if ($result) {
            $this->cart->destroy();
            $this->session->unset_userdata('discount_msg');
            $this->session->unset_userdata('discount_val');
            $this->session->unset_userdata('discount');
            $this->session->set_userdata('booking_id', $result);
            $data['booking_detail'] = $this->Ecommerce_model->getBookingById($result);
            $data['saloon_detail'] = $this->Ecommerce_model->getShopDataById($data['booking_detail']['shop_id']);
            $data['name'] = $user_data['user_name'];
            $to_email = $user_data['email'];
//            $htmlContent = $this->load->view('front/app_conf_mail', $data, TRUE);
//            $from = 'info@beyoou.com';
//            $headers = 'MIME-Version: 1.0' . "\r\n";
//            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//            $headers .= 'From: ' . $from . "\r\n";
//            $subject = 'Appointment Confirmation'; // subject
//            @mail($to_email, $subject, $htmlContent, $headers);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Site/success'), 'msg' => 'Thanks for Booking']));
            return FALSE;
        }
    }
    
    public function success()
    {
        if (empty($this->session->userdata('booking_id'))) {
            redirect(base_url('/'));            
        }
//        $data['user']  =$this->getDataByUniqueId();
//        print_r($data['user']);die;
        
            $data['title'] = 'Your Cart';
            $data['getLanguages'] = $this->Ecommerce_model->getLanguages();
            $data['getSiteLanguages'] = $this->Ecommerce_model->getSiteLanguages();
            $id = $this->session->userdata('booking_id');
            $this->session->unset_userdata('booking_id');
            $data['booking'] = $result = $this->Ecommerce_model->getBookingById($id);
//            print_r($data['booking']);die;
            $new_date = date('d-m-Y', strtotime($result['booking_date']));
            $day = date('l', strtotime($new_date));
            $month = date('F', strtotime($new_date));
            $date = date('d', strtotime($new_date));
            $data['booking_time'] = date('h:i A', strtotime($result['booking_time']));
            $data['booking_date'] = $day . ',' . $month . ' ' . $date;
            $this->load->view('front/commons/header');
            $this->load->view('front/commons/navbar',$data);
            $this->load->view('front/success',$data);
            $this->load->view('front/commons/footer',$data);
    }
    
    public function doRemoveBokkedCart(){
        $this->output->set_content_type('application/json');
        $this->cart->destroy();
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    
    public function doAddReviews($shop_id)
    {
        $this->output->set_content_type('application/json');        
        $this->form_validation->set_rules('comment', 'Comment', 'required');       
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $data['user']  =$this->getDataByUniqueId();
        $user_id = $data['user']['user_id'];
        $comment = $this->input->post('comment');
        $result = $this->Ecommerce_model->doAddReviews($shop_id,$user_id,$comment);
        if ($result){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Review is added Successfully' , 'url' => base_url('Site/success')]));
            return FALSE;
        }else{
            $response = $this->Ecommerce_model->addPostWishlist($shop_id, $user_id['user_id']);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Failed to add Review']));
            return FALSE;
        } 
        
        
        
    }
    
   
}
?>