<?php

/*
 * Description of Api
 * 
 * beyoou
 *
 * @author Manish Khandelwal
 */

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Api_model']);
    }

    //Manish function
    // For get user detail
    public function getUserDetail($result) {
        $list = [];
        $list['user_id'] = $result['user_id'];
        $list['user_name'] = $result['user_name'];
        $list['email'] = $result['email'];
        $list['image_url'] = $result['image_url'];
        $list['location'] = $result['location'];
        $list['latitude'] = $result['lattitude'];
        $list['longitude'] = $result['longitude'];
        if (!empty($result['mobile'])) {
            $list['mobile'] = $result['mobile'];
        } else {
            $list['mobile'] = '';
        }
        if (!empty($result['image_url'])) {
            $list['image_url'] = base_url('uploads/profile/' . $result['image_url']);
        } else {
            $list['image_url'] = '';
        }

        return $list;
    }

//Rohan function
//For generate unique id
    public function uniqueId() {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIPQRSTUVWXYZ';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 10);
        return $unique_id;
    }

//For login
    public function doLogin() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Api_model->doLogin();
        if (!empty($result)) {
            $result['image_url'] = base_url('uploads/profile/' . $result['image_url']);
        }
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Successfuly', 'data' => $result]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Incorrect Email address or Password!']));
        }
    }

//For Registration
    public function doRegistration() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'This {field} is already registered with us.');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[6]|max_length[20]|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $unique_id = $this->uniqueId();
        $result = $this->Api_model->doRegistration($unique_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Registration Successfuly', 'data' => $result]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Registration Failed']));
        }
    }

//For get Categories
    public function allCategories() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('language', 'Language Code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $language = $this->input->post('language');
        $results = $this->Api_model->allCategories($language);
        if ($results) {
            $list = $this->setImageUrl($results);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'data loaded', 'data' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'data not found']));
        }
    }

    public function setImageUrl($results) {
        $list = [];
        $i = 0;
        foreach ($results as $res) {
            $list[$i]['category_id'] = $res['category_id'];
            $list[$i]['category_name'] = $res['category_name'];
            $list[$i]['image_url'] = base_url('uploads/category/' . $res['image_url']);
            $i++;
        }
        return $list;
    }

//For get sub categories
    public function allSubCategories() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_id', 'Category Id', 'required');
        $this->form_validation->set_rules('language', 'Language Code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $cat_id = $this->input->post('category_id');
        $language = $this->input->post('language');
        $results = $this->Api_model->allSubCategories($cat_id, $language);
        if ($results) {
            $list = $this->setSubCategoryImageUrl($results);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'data loaded', 'data' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'data not found']));
        }
    }

    public function setSubCategoryImageUrl($results) {
        $i = 0;
        $list = [];
        foreach ($results as $res) {
            $list[$i]['sub_category_id'] = $res['sub_category_id'];
            $list[$i]['sub_category_name'] = $res['sub_category_name'];
            $list[$i]['image_url'] = base_url('uploads/subcategory/' . $res['image_url']);
            $list[$i]['cat_type'] = 'beauty';
            $i++;
        }
        return $list;
    }

//For get child categories
    public function allChildCategories() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('sub_category_id', 'Sub Category Id', 'required');
        $this->form_validation->set_rules('language', 'Language Code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $subcat_id = $this->input->post('sub_category_id');
        $language = $this->input->post('language');
        $childCategories = $this->Api_model->allChildCategories($subcat_id, $language);

        $list = [];
        $i = 0;
        foreach ($childCategories as $childCategory) {
            $list[$i]['child_category_id'] = $childCategory['child_category_id'];
            $list[$i]['child_category_name'] = $childCategory['child_category_name'];
            $list[$i]['super_child_category'] = $this->Api_model->allSuperChildCategory($childCategory['child_category_id'], $language);
            $i++;
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'data loaded', 'data' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'data not found']));
        }
    }

//For get super child categories
    public function allSuperChildCategory() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('child_category_id', 'Child Category Id', 'required');
        $this->form_validation->set_rules('language', 'Language Code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $child_cat_id = $this->input->post('child_category_id');
        $language = $this->input->post('language');
        $result = $this->Api_model->allSuperChildCategory($child_cat_id, $language);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'data loaded', 'data' => $result]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'data not found']));
        }
    }

    //Manish Function
//For send forgot passowrd link
    public function forgotPassword() {
        $this->output->set_content_type('application/json');
        $email = $this->input->post('email');
        $results = $this->Api_model->checkEmail($email);
        if ($results) {
            $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $activationcode = substr(str_shuffle($str), 0, 10);
            $this->send_forgot_password_link($results, $activationcode);

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Link has been sent to your registered email']));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email address does not exist']));
            return false;
        }
    }

//For mail forgot password link
    public function send_forgot_password_link($result, $activationcode) {
        $this->load->library('email');
        $getEmailResponse = $this->Api_model->insert_user_activationcode($activationcode, $result);

        $htmlContent = "<h3>Hi " . $result['user_name'] . ",</h3>";
        $htmlContent .= "<div style='padding-top:8px;'>Please click here to create a new password</div>";
        $htmlContent .= "<a href='" . base_url('user/passwordReset/' . $result['user_id'] . '/' . $activationcode) . "'> Click Here!!</a> Set new password!";

        $to = $result['email'];
        $subject = 'Reset password';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('info@beyoou.com', 'Beyoou Admin');
        $this->email->to($to);
        $this->email->subject('Hey!, ' . $result['user_name'] . ' your reset password link');
        $this->email->message($htmlContent);
        $this->email->send();
        return true;
    }

    public function doUploadImage() {
        $config = array(
            'upload_path' => "./uploads/profile/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "3048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['error' => $this->upload->display_errors()]);
            return 0;
        }
    }

//For update profile
    public function doUpdateProfile() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $user_id = $this->input->post('user_id');

        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadImage();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => -2, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $data = $this->Api_model->getUserDataById($user_id);
            $image_url = $data['image_url'];
        }
        $results = $this->Api_model->doUpdateProfile($user_id, $image_url);
        if ($results) {
            $list = $this->getUserDetail($results);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'User info updated successfully', 'user_info' => $list]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes were made']));
            return FALSE;
        }
    }

//For get site data
    public function siteData() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('language', 'Language', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->from_validation->error_array()]));
            return FALSE;
        }
        $type = $this->input->post('type');
        $language = $this->input->post('language');
        $list = $this->Api_model->siteData($type, $language);
        $new_data = strip_tags($list['description']);
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => $type, 'Description' => $new_data]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No about us found']));
            return FALSE;
        }
    }

// For change password
    public function changePassword() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('old_password', 'old password', 'required');
        $this->form_validation->set_rules('new_password', 'new password', 'required|min_length[6]|max_length[20]', array('min_length' => 'New password length must be of 6 digits!'));
        $this->form_validation->set_rules('confirm_new_password', 'confirm new password', 'required|min_length[6]|max_length[20]|matches[new_password]', array('min_length' => 'Confirm new password length must be of 6 digits', 'matches' => 'New password and confirm new password should be same!'));
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $user_id = $this->input->post('user_id');
        $result = $this->Api_model->do_check_oldpassword($user_id);
        if (!empty($result)) {
            $changed = $this->Api_model->do_reset_passowrd($user_id);
            if ($changed) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password changed successfully!']));
                return FALSE;
            }
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password not change!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => 2, 'msg' => 'Old and Current password does not match!']));
            return FALSE;
        }
    }

// For get all language
    public function getAllLanguage() {
        $this->output->set_content_type('application/json');
        $language = $this->Api_model->getAllLanguage();
        $this->output->set_output(json_encode(['result' => 1, 'languages' => $language, 'msg' => 'Language']));
        return FALSE;
    }

// For get service category
    public function getServiceCategory() {
        $this->output->set_content_type('application/json');
        $language = $this->input->post('language');
        $results = $this->Api_model->getServiceCategory($language);
        $list = [];
        $i = 0;
        foreach ($results as $result) {
            $list[$i]['service_category_id'] = $result['service_category_id'];
            $list[$i]['service_category_name'] = $result['service_category_name'];
            $list[$i]['services'] = $this->Api_model->getService($result['service_category_id'], $language);
            $i++;
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'service category', 'service_category' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No data found']));
        }
        return FALSE;
    }

// For get popular service
    public function popularService() {
        $this->output->set_content_type('application/json');
        $language = $this->input->post('language');
        $shop_id = $this->input->post('shop_id');
        $results = $this->Api_model->getPopularService($shop_id, $language);
        $list = [];
        $i = 0;
        foreach ($results as $result) {
            $list[$i]['service_id'] = $result['service_id'];
            $list[$i]['service_name'] = $result['service_name'];
            $list[$i]['price'] = $result['price'];
            $i++;
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'popular service', 'popular_service' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No data found']));
        }
        return FALSE;
    }

// For get favorite shop
    public function favorite() {
        $this->output->set_content_type('application/json');
        $user_id = $this->input->post('user_id');
        $language = $this->input->post('language');
        $results = $this->Api_model->getFavoriteByUserId($user_id, $language);
        $list = [];
        $i = 0;
        foreach ($results as $result) {
            $list[$i]['shop_id'] = $result['shop_id'];
            $list[$i]['favorite'] = "1";
            $list[$i]['image_url'] = base_url('uploads/shop/' . $result['image_url']);
            $list[$i]['shop_name'] = $result['shop_name'];
            $list[$i]['url'] = base_url('Api/getShopByName/' . str_replace(' ', '-', $result['shop_name']) . '/' . $language);
            $list[$i]['coupon_code'] = $this->Api_model->getCouponCodeByShopId($result['shop_id']);
            $list[$i]['description'] = $result['about'];
            $list[$i]['address'] = $result['address'];
            $list[$i]['city'] = $result['city'];
            $list[$i]['state'] = $result['state'];
            $list[$i]['pincode'] = $result['pincode'];
            $list[$i]['latitude'] = $result['latitude'];
            $list[$i]['longitude'] = $result['longitude'];
            $list[$i]['open_time'] = $result['open_time'];
            $list[$i]['close_time'] = $result['close_time'];
            $review = $this->Api_model->getReviewCount($result['shop_id']);
            if (!empty($review)) {
                $list[$i]['review'] = $review['count'];
            } else {
                $list[$i]['review'] = "0";
            }
            $rating = $this->Api_model->getAverageRating($result['shop_id']);
            if (!empty($rating)) {
                $rating = floatval($rating['rating']);
                $list[$i]['rating'] = (string) $rating;
            } else {
                $list[$i]['rating'] = "0";
            }

            $list[$i]['popular_services'] = $this->Api_model->getPopularService($result['shop_id'], $language);
            $list[$i]['all_services'] = $this->Api_model->getServicesByShopId($result['shop_id'], $language);
            $i++;
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'favorite', 'shop' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No salon found in favorite']));
        }
        return FALSE;
    }

// For add shop in favorite list
    public function addToFavorite() {
        $this->output->set_content_type('application/json');
        $results = $this->Api_model->addToFavorite();
        if ($results) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Added to Favorites']));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Removed from Favorites']));
        }
        return FALSE;
    }

    //For get shop by name
    public function getShopByName($saloon_name, $language) {
        $shop_detail = [];
        $saloon_n = str_replace('-', ' ', $saloon_name);
        $saloon_detail = $this->Api_model->getSaloonBySaloonName($saloon_n, $language);
        $data['user_data'] = $this->getDataByUniqueId();
        $shop_detail = $saloon = $this->filteredSalon($saloon_detail);
        return $shop_detail;
    }

    // get filtered shop
    public function filteredSalon($result) {
        $list = [];
        $list['shop_id'] = $result['shop_id'];
        $list['image_url'] = base_url('uploads/shop/' . $result['image_url']);
        $list['saloon_name'] = $result['shop_name'];
        $list['address'] = $result['address'];
        $list['city'] = $result['city'];
        $list['state'] = $result['state'];
        $list['pincode'] = $result['pincode'];
        $list['open_time'] = $result['open_time'];
        $list['close_time'] = $result['close_time'];
        $list['latitude'] = $result['latitude'];
        $list['longitude'] = $result['longitude'];
        $list['about'] = $result['about'];
        $review = $this->Api_model->getReviewCount($result['shop_id']);
        if (!empty($review)) {
            $list[$i]['review'] = $review['count'];
        } else {
            $list[$i]['review'] = "0";
        }
        $rating = $this->Api_model->getAverageRating($result['shop_id']);
        if (!empty($rating)) {
            $list[$i]['rating'] = $rating['rating'];
        } else {
            $list[$i]['rating'] = "0";
        }
        $list[$i]['popular_services'] = $this->Api_model->getPopularService($result['shop_id'], $language);
        $list[$i]['all_services'] = $this->Api_model->getServicesByShopId($result['shop_id'], $language);
        return $list;
    }

    // For get all shop
    public function getShop() {
        $this->output->set_content_type('application/json');
        $super_child_category_id = $this->input->post('super_child_category_id');
        $language = $this->input->post('language');
        $user_id = $this->input->post('user_id');
        $results = $this->Api_model->getShop($super_child_category_id, $language);
        $list = [];
        $i = 0;
        foreach ($results as $result) {
            if (!empty($user_id)) {
                $favorite = $this->Api_model->checkWishList($result['shop_id'], $user_id);
                $list[$i]['favorite'] = (string) $favorite;
            } else {
                $list[$i]['favorite'] = "0";
            }
            $list[$i]['shop_id'] = $result['shop_id'];
            $list[$i]['image_url'] = base_url('uploads/shop/' . $result['image_url']);
            $list[$i]['shop_name'] = $result['shop_name'];
            $list[$i]['url'] = base_url('Api/getShopByName/' . str_replace(' ', '-', $result['shop_name']) . '/' . $language);
            $list[$i]['address'] = $result['address'];
            $list[$i]['coupon_code'] = $this->Api_model->getCouponCodeByShopId($result['shop_id']);
            $list[$i]['description'] = $result['about'];
            $list[$i]['city'] = $result['city'];
            $list[$i]['state'] = $result['state'];
            $list[$i]['pincode'] = $result['pincode'];
            $list[$i]['latitude'] = $result['latitude'];
            $list[$i]['longitude'] = $result['longitude'];
            $list[$i]['open_time'] = $result['open_time'];
            $list[$i]['close_time'] = $result['close_time'];
            $review = $this->Api_model->getReviewCount($result['shop_id']);
            if (!empty($review)) {
                $list[$i]['review'] = $review['count'];
            } else {
                $list[$i]['review'] = "0";
            }
            $rating = $this->Api_model->getAverageRating($result['shop_id']);
            if (!empty($rating)) {
                $list[$i]['rating'] = $rating['rating'];
            } else {
                $list[$i]['rating'] = "0";
            }

            $list[$i]['popular_services'] = $this->Api_model->getPopularService($result['shop_id'], $language);
            $list[$i]['all_services'] = $this->Api_model->getServicesByShopId($result['shop_id'], $language);
            $i++;
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'shop Listing', 'shop' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No data found']));
        }
        return FALSE;
    }

    //For apply coupon
    public function applyCoupon() {
        $this->output->set_content_type('application/json');
        $coupon = $this->input->post('coupon');
        $price = $this->input->post('price');
        $type = $this->Api_model->checkCoupon($coupon);
        $shop_id = $this->input->post('shop_id');
        if ($type['user_type'] == 'Admin') {
            $result = $this->Api_model->checkCoupon($coupon);
        } else {
            $result = $this->Api_model->checkShopCoupon($coupon, $shop_id);
        }
        if ($result) {
            $disount_price = ($price * $result['coupon_value']) / 100;
            $discounted_price = $price - $disount_price;
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Coupon ' . $coupon . ' Applied Successfully', 'Discount_price' => $disount_price, 'Discounted_Price' => $discounted_price]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Coupon code wrong or coupon get expired']));
            return FALSE;
        }
    }

    //Get All booking
    public function getAllBooking() {
        $this->output->set_content_type('application/json');
        $user_id = $this->input->post('user_id');
        $results = $this->Api_model->getAllBooking($user_id);
        $list = [];
        $i = 0;
        foreach ($results as $result) {
            $list[$i]['image_url'] = base_url('uploads/shop/' . $result['image_url']);
            $list[$i]['shop_id'] = $result['shop_id'];
            $list[$i]['shop_name'] = $result['shop_name'];
            $list[$i]['discounted_price'] = $result['total'];
            $new_date = date('d-m-Y', strtotime($result['booking_date']));
            $list[$i]['day'] = date('F', strtotime($new_date));
            $list[$i]['booking_time'] = date('h:i A', strtotime($result['booking_time']));
            $day = date('l', strtotime($new_date));
            $month = date('F', strtotime($new_date));
            $date = date('d', strtotime($new_date));
            $list[$i]['booking_date'] = substr($day, 0, 3) . ' ' . $date . ',' . $month;
            $list[$i]['price'] = $result['total'];
            $list[$i]['unique_id'] = $result['booking_unique_id'];
            $list[$i]['booking_status'] = $result['status'];
            $i++;
        }
        $current_booking = [];
        $c = 0;
        $today_date = date('Y-m-d');
        foreach ($results as $result) {
            if ($result['booking_date'] >= $today_date && $result['status'] != 'Cancel') {
                $current_booking[$c]['image_url'] = base_url('uploads/shop/' . $result['image_url']);
                $current_booking[$c]['shop_id'] = $result['shop_id'];
                $current_booking[$c]['shop_name'] = $result['shop_name'];
                $current_booking[$c]['discounted_price'] = $result['total'];
                $new_date = date('d-m-Y', strtotime($result['booking_date']));
                $current_booking[$c]['day'] = date('F', strtotime($new_date));
                $current_booking[$c]['booking_time'] = date('h:i A', strtotime($result['booking_time']));
                $day = date('l', strtotime($new_date));
                $month = date('F', strtotime($new_date));
                $date = date('d', strtotime($new_date));
                $current_booking[$c]['booking_date'] = substr($day, 0, 3) . ' ' . $date . ',' . $month;
                $current_booking[$c]['price'] = $result['total'];
                $current_booking[$c]['unique_id'] = $result['booking_unique_id'];
                $current_booking[$c]['booking_status'] = $result['status'];
                $c++;
            }
           
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'All Bookings', 'bookings' => $list, 'current_booking' => $current_booking]));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Booking Available']));
            return false;
        }
    }

    //for get booking detail by id

    public function getBookingDetailByBookingId() {
        $this->output->set_content_type('application/json');
        $language = $this->input->post('language');
        $results = $this->Api_model->getBookingDetailByBookingId($language);
        $results['booking_date'] = date('d-m-Y', strtotime($results['booking_date']));
        $results['latitude'] = $results['latitude'];
        $results['longitude'] = $results['longitude'];
        $results['url'] = base_url('Api/getShopByName/' . str_replace(' ', '-', $results['shop_name']) . '/' . $language);
        $results['discounted_price'] = $results['total'];
        if (!empty($results['image_url'])) {
            $results['image_url'] = base_url('uploads/shop/' . $results['image_url']);
        }
        $services = $this->Api_model->getServcesById($results['service'], $language);
        $results['service'] = $services;
        $review = $this->Api_model->getReviewCount($results['shop_id']);
        if (!empty($review)) {
            $results['review'] = $review['count'];
        } else {
            $results['review'] = "0";
        }
        $rating = $this->Api_model->getAverageRating($results['shop_id']);
        if (!empty($rating)) {
            $results['rating'] = $rating['rating'];
        } else {
            $results['rating'] = "0";
        }
        if (!empty($results['user_id'])) {
            $favorite = $this->Api_model->checkWishList($results['shop_id'], $results['user_id']);
            $results['favorite'] = (string) $favorite;
        } else {
            $results['favorite'] = "0";
        }
        if ($results) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'booking_detail', 'booking' => $results]));
            return FALSE;
        }
    }

    //Get confirmed booking detail
    public function confirmation() {
        $this->output->set_content_type('application/json');
        $language = $this->input->post('language');
        $result = $this->Api_model->confirmation();
        $list = [];
        $new_date = date('d-m-Y', strtotime($result['booking_date']));
        $day = date('l', strtotime($new_date));
        $month = date('F', strtotime($new_date));
        $date = date('d', strtotime($new_date));
        $list['booking_time'] = date('h:i A', strtotime($result['booking_time']));
        $list['booking_date'] = $day . ',' . $month . ' ' . $date;
        $service_list = [];
        $i = 0;
        $services = explode(',', $result['service']);
        foreach ($services as $service_id) {
            $ser = $this->Api_model->getServiceId($service_id, $language);
            $service_list[$i] = $ser['service_name'];
            $i++;
        }

        $list['service'] = $service_list;
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'booking detail', 'booking_detail' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No data found']));
        }
        return FALSE;
    }

    //checkout after select service
    public function checkOut() {
        $this->output->set_content_type('application/json');
        $services = $this->input->post('service');
        $service = implode(',', $services);
        $unique_id = $this->uniqueId();
        $result = $this->Api_model->checkOut($service, $unique_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'booking', 'booking_id' => $result]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No data found']));
        }
        return FALSE;
    }

    // for cancel booking
    public function cancelBooking() {
        $this->output->set_content_type('application/json');
        $booking_unique_id = $this->input->post('booking_unique_id');
        $result = $this->Api_model->cancelBooking($booking_unique_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Booking cancelled']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Booking not cancelled']));
            return FALSE;
        }
    }

    // get all service category
    public function getAllServiceCategory() {
        $this->output->set_content_type('application/json');
        $language = $this->input->post('language');
        $cat_type = $this->input->post('cat_type');
        $service_categories = $this->Api_model->getAllServiceCategory($language, $cat_type);

        if ($service_categories) {
            $i = 0;
            foreach ($service_categories as $service) {
                if (!empty($service['image_url'])) {
                    $service_categories[$i]['image_url'] = base_url('uploads/shop/' . $service['image_url']);
                } else {
                    $service_categories[$i]['image_url'] = '';
                }
                $i++;
            }
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Services', 'service_category' => $service_categories]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No service found']));
            return FALSE;
        }
    }

//    public function allSubCategoriesByName() {
//        $this->output->set_content_type('application/json');
//        $this->form_validation->set_rules('category_id', 'Category Id', 'required');
//        $this->form_validation->set_rules('language', 'Language Code', 'required');
//        $this->form_validation->set_rules('search_value', 'search value', 'required');
//        $cat_type = $this->input->post('cat_type');
//        if ($this->form_validation->run() === FALSE) {
//            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
//            return FALSE;
//        }
//        $cat_id = $this->input->post('category_id');
//        $language = $this->input->post('language');
//        $search_value = $this->input->post('search_value');
//        $results = $this->Api_model->allSubCategoriesByName($cat_id, $language,$search_value);
//        if ($results) {
//            $list = $this->setSubCategoryImageUrl($results);
//            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'data loaded', 'data' => $list]));
//        } else {
//            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'data not found']));
//        }
//    }

    public function getAllServiceCategoryByName() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_id', 'Category Id', 'required');
        $language = $this->input->post('language');
        $cat_type = $this->input->post('cat_type');
        $search_value = $this->input->post('search_value');
//        if (ucwords($cat_type) == 'Beauty') {
            $cat_id = $this->input->post('category_id');
            $results = $this->Api_model->allSubCategoriesByName($cat_id, $language, $search_value);
            $categories = $this->setSubCategoryImageUrl($results);
           
//        } else {
            $service_categories = $this->Api_model->getAllServiceCategoryByName($language, $cat_type, $search_value);
            $i = 0;
            foreach ($service_categories as $service) {
                if (!empty($service['image_url'])) {
                    $service_categories[$i]['image_url'] = base_url('uploads/shop/' . $service['image_url']);
                } else {
                    $service_categories[$i]['image_url'] = '';
                }
                if($service['category_id']=='2'){
                    $service_categories[$i]['cat_type'] = 'fitness';
                }
                if($service['category_id']=='3'){
                    $service_categories[$i]['cat_type'] = 'wellness';
                }
                $i++;
            }
//        }
            $list = array_merge($categories,$service_categories);
        
        if ($list) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Services', 'service_category' => $list]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No service found']));
            return FALSE;
        }
    }

    // get services
    public function getService() {
        $this->output->set_content_type('application/json');
        $language = $this->input->post('language');
        $service_category_id = $this->input->post('service_category_id');
        $services = $this->Api_model->getServiceByCategoryId($service_category_id, $language);
        if ($services) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'all services', 'service' => $services]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No service found']));
            return FALSE;
        }
    }

    public function top_rated_filter($results) {
        $i = 0;
        $list = [];
        foreach ($results as $result) {
            $list[$i] = $result['filter_value'];
            $i++;
        }
        $unique = array_unique($list);
        $arr = [];
        for ($j = 0; $j < count($unique); $j++) {
            $arr[$j]['filter_value'] = $unique[$j];
        }
        return $arr;
    }

    // get filter shop on various filter
    public function filter() {
        $this->output->set_content_type('application/json');
        $key = $this->input->post('key');
        $super_child_category_id = $this->input->post('super_child_category_id');
        if ($key == 'top_rated_filter') {
            $result = $this->Api_model->topRatedFilter($super_child_category_id);
            $res = $this->top_rated_filter($result);
            if ($res) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Top Rated Filter', 'filter_value' => $res]));
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Top Rated Filter Found']));
            }
            return FALSE;
        } else if ($key == 'distance_filter') {
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $results = $this->Api_model->getDistanceFilter($super_child_category_id);
            $i = 0;
            $val = [];
            foreach ($results as $result) {
                $val[$i] = round($this->distance($latitude, $longitude, $result['latitude'], $result['longitude'], 'K'));
                $i++;
            }

            $values = array_unique($val);
            sort($values);
            $list = [];
            $i = 0;
            foreach ($values as $value) {
                $list[$i]['filter_value'] = (string) $value;
                $i++;
            }
            if ($list) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Distance Filter', 'filter_value' => $list]));
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Distance Filter Found']));
            }
            return FALSE;
        } else if ($key == 'location_filter') {
            $language = $this->input->post('language');
            $result = $this->Api_model->getLocationFilter($super_child_category_id, $language);
            if ($result) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Location Filter', 'filter_value' => $result]));
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Location Filter Found']));
            }
            return FALSE;
        } else if ($key == 'time_filter') {
            $times = $this->Api_model->getTimeFilter($super_child_category_id);
            $list = [];
            $i = 0;
            foreach ($times as $time) {
                $list[$i]['filter_value'] = $time['from'] . 'AM to ' . $time['to'] . 'PM';
                $i++;
            }
            if ($list) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Location Filter', 'filter_value' => $list]));
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Location Filter Found']));
            }
            return FALSE;
        }
    }

    // count distance of shop from user
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    // for get filtered shop
    public function getFilteredShop() {
        $this->output->set_content_type('application/json');
        $super_child_category_id = $this->input->post('super_child_category_id');
        $language = $this->input->post('language');
        $results = $this->Api_model->getFilteredShop($super_child_category_id, $language);
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $list = [];
        $user_id = $this->input->post('user_id');
        $i = 0;
        $j = 0;
        foreach ($results as $result) {
            $distance_filter = $this->input->post('distance_filter');
            $distance_filter = explode(',', $distance_filter);
            if (!empty($distance_filter && !empty($latitude) && !empty($longitude))) {
                $distance_length = count($distance_filter);
                $distance = round($this->distance($latitude, $longitude, $result['latitude'], $result['longitude'], 'K'));
                if ($distance_length == 1) {
                    $length = $distance_filter[0];
                    if ($length <= $distance) {
                        $list[$j] = $this->shopDetail($result, $user_id, $language);
                        $j++;
                    }
                } else if ($distance_length > 1) {
                    $min_length = min($distance_filter);
                    $max_length = max($distance_filter);
                    if ($distance >= $min_length && $distance <= $max_length) {
                        $list[$j] = $this->shopDetail($result, $user_id, $language);
                        $j++;
                    }
                }
            } else {
                $list[$i] = $this->shopDetail($result, $user_id, $language);
            }
            $i++;
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Filtered Product', 'shop' => $list]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Shop Found']));
            return FALSE;
        }
    }

    public function shopDetail($result, $user_id = null, $language) {
        $list = [];
        $list['shop_id'] = $result['shop_id'];
        $list['image_url'] = base_url('uploads/shop/' . $result['image_url']);
        $list['shop_name'] = $result['shop_name'];
        $list['address'] = $result['address'];
        $list['url'] = base_url('Api/getShopByName/' . str_replace(' ', '-', $result['shop_name']) . '/' . $language);
        $list['description'] = $result['about'];
        $list['city'] = $result['city'];
        $list['state'] = $result['state'];
        $list['pincode'] = $result['pincode'];
        $list['latitude'] = $result['latitude'];
        $list['longitude'] = $result['longitude'];
        $list['open_time'] = $result['open_time'];
        $list['close_time'] = $result['close_time'];
        $review = $this->Api_model->getReviewCount($result['shop_id']);
        if (!empty($review)) {
            $list['review'] = $review['count'];
        } else {
            $list['review'] = "0";
        }
        $rating = $this->Api_model->getAverageRating($result['shop_id']);
        if (!empty($rating)) {
            $list['rating'] = $rating['rating'];
        } else {
            $list['rating'] = "0";
        }
        if (!empty($results['user_id'])) {
            $favorite = $this->Api_model->checkWishList($result['shop_id'], $user_id);
            $list['favorite'] = (string) $favorite;
        } else {
            $list['favorite'] = "0";
        }
        $list['coupon_code'] = $this->Api_model->getCouponCodeByShopId($result['shop_id']);
        $list['popular_services'] = $this->Api_model->getPopularService($result['shop_id'], $language);
        $list['all_services'] = $this->Api_model->getServicesByShopId($result['shop_id'], $language);

        return $list;
    }

    public function getShopByNameInSearch() {
        $this->output->set_content_type('application/json');
        $super_child_category_id = $this->input->post('super_child_category_id');
        $language = $this->input->post('language');
        $user_id = $this->input->post('user_id');
        $search_value = $this->input->post('search_value');
        $results = $this->Api_model->getShopBySearchValue($super_child_category_id, $language, $search_value);
        $list = [];
        $i = 0;
        foreach ($results as $result) {
            if (!empty($user_id)) {
                $favorite = $this->Api_model->checkWishList($result['shop_id'], $user_id);
                $list[$i]['favorite'] = (string) $favorite;
            } else {
                $list[$i]['favorite'] = "0";
            }
            $list[$i]['shop_id'] = $result['shop_id'];
            $list[$i]['image_url'] = base_url('uploads/shop/' . $result['image_url']);
            $list[$i]['shop_name'] = $result['shop_name'];
            $list[$i]['url'] = base_url('Api/getShopByName/' . str_replace(' ', '-', $result['shop_name']) . '/' . $language);
            $list[$i]['address'] = $result['address'];
            $list[$i]['coupon_code'] = $this->Api_model->getCouponCodeByShopId($result['shop_id']);
            $list[$i]['description'] = $result['about'];
            $list[$i]['city'] = $result['city'];
            $list[$i]['state'] = $result['state'];
            $list[$i]['pincode'] = $result['pincode'];
            $list[$i]['latitude'] = $result['latitude'];
            $list[$i]['longitude'] = $result['longitude'];
            $list[$i]['open_time'] = $result['open_time'];
            $list[$i]['close_time'] = $result['close_time'];
            $review = $this->Api_model->getReviewCount($result['shop_id']);
            if (!empty($review)) {
                $list[$i]['review'] = $review['count'];
            } else {
                $list[$i]['review'] = "0";
            }
            $rating = $this->Api_model->getAverageRating($result['shop_id']);
            if (!empty($rating)) {
                $list[$i]['rating'] = $rating['rating'];
            } else {
                $list[$i]['rating'] = "0";
            }

            $list[$i]['popular_services'] = $this->Api_model->getPopularService($result['shop_id'], $language);
            $list[$i]['all_services'] = $this->Api_model->getServicesByShopId($result['shop_id'], $language);
            $i++;
        }
        if ($list) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'shop Listing', 'shop' => $list]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No data found']));
        }
        return FALSE;
    }

    //for set token id
    public function setToken() {
        $this->output->set_content_type('application/json');
        $user_id = $this->input->post('user_id');
        $token_id = $this->input->post('token_id');
        if (!empty($user_id)) {
            $check = $this->Api_model->checkTokenId($user_id, $token_id);
            if ($check) {
                $this->output->set_output(json_encode(['result' => 0, 'msg' => 'Token id already exist']));
            } else {
                $this->Api_model->deleteTokenId($user_id);
                $update = $this->Api_model->setToken($user_id, $token_id);
                if ($update) {
                    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Token update successfully']));
                    return FALSE;
                } else {
                    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Token not updated']));
                    return FALSE;
                }
            }
        } else {
            $result = $this->Api_model->checkGuestTokenId($token_id);
            if ($result) {
                $this->output->set_output(json_encode(['result' => 0, 'msg' => 'Token Already Exists']));
                return false;
            } else {
                $result = $this->Api_model->setGuestUserToken($token_id);
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Token Id Added']));
                return false;
            }
        }
    }

    //for send notification
    function sendNotificationToUser() {
        $this->output->set_content_type('application/json');
        $user_id = $this->input->post('user_id');
        $token = $this->Api_model->getTokenByUserId($user_id);

        $title = "New Message";
        $body = "Hello, buddy How Are You?";

        $msg = array('body' => $body,
            'title' => $title
        );
        $this->Api_model->addNotificationMessage($title, $body, $user_id);

        $api_key = 'AAAAKZLje1I:APbGQDw8FD...TjmtuINVB-g';

        $fields = array(
            'to' => $token['token_id'],
            'notification' => $msg
        );

        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'notification send']));
        return false;
    }

    //for send notification to all
    public function sendNotificationToAll() {
        $this->output->set_content_type('application/json');
        $token_arrs = $this->Api_model->getAllTokenId();
        $i = 0;
        $token = [];
        foreach ($token_arrs as $tok) {
            $msg = array(
                'body' => "Hello, user How are you.",
                'title' => 'New Message'
            );

            $fields = array(
                'to' => $tok["token_id"],
                'notification' => $msg,
            );

            $headers = array('Authorization:key = ' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);
        }

        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'notification send']));
        return false;
    }
    
    //for get notification
    public function getAllNotificationByUserId(){
        $this->output->set_content_type('application/json');
        $user_id = $this->input->post('user_id');
        $result = $this->Api_model->getAllNotificationByUserId($user_id);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'all notification', 'notification'=>$result]));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'no notification']));
            return FALSE;
        }
    }

    //for insert payment detail
    public function insertPaymentDetail() {
        $this->output->set_content_type('application/json');
        $result = $this->Api_model->insertPaymentDetail();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Payment done successfully']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Payment failed']));
            return FALSE;
        }
    }

    //for update payment status
    public function updatePaymentStatus() {
        $this->output->set_content_type('application/json');
        $result = $this->Api_model->updatePaymentStatus();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Payment status update successfully']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Payment status not updated']));
            return FALSE;
        }
    }

    //for social login
    public function socialLogin() {
        $this->output->set_content_type('application/json');
        $unique_id = $this->uniqueId();
        $result = $this->Api_model->socialLogin($unique_id);
        if ($result) {
            $list = $this->getUserDetail($result);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully', 'user_info' => $list]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Credentials']));
            return FALSE;
        }
    }

}

?>