<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Description of Api
 * 
 * beyoou
 *
 * @author Manish Khandelwal
 */

class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function doRegistration($unique_id) {
        $data = array(
            'user_name' => $this->security->xss_clean($this->input->post('name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password'))),
            'mobile' => $this->input->post('phone'),
            'source' => 'self',
            'location' => $this->security->xss_clean($this->input->post('address')),
            'unique_id' => $unique_id,
            'lattitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude')
        );
        $this->db->insert('users', $data);
        $id = $this->db->insert_id();
        $sel = $this->db->get_where('users', ['user_id' => $id]);
        return $sel->row_array();
    }

    public function doLogin() {
        $email = $this->input->post('email');
        $mobile = $this->input->post('phone');
        $password = $this->security->xss_clean(hash('sha256', $this->input->post('password')));
        if (!empty($email)) {
            $query = $this->db->get_where('users', ['email' => $email, 'password' => $password]);
        } else if (!empty($mobile)) {
            $query = $this->db->get_where('users', ['mobile' => $mobile, 'password' => $password]);
        }
        return $query->row_array();
    }

    public function getUserDataById($user_id) {
        $result = $this->db->get_where('users', ['user_id' => $user_id]);
        return $result->row_array();
    }

    public function doUpdateProfile($user_id, $image_url) {
        $data = array(
            'user_name' => $this->input->post('user_name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'location' => $this->input->post('location'),
            'lattitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'image_url' => $image_url
        );
        $this->db->update('users', $data, ['user_id' => $user_id]);
        $query = $this->db->get_where('users', ['user_id' => $user_id]);

        return $query->row_array();
    }

    public function allCategories($language) {
        $this->db->select('category.category_id,category.image_url,' . $language . ' as category_name');
        $this->db->from('category');
        $this->db->order_by('category_id', 'desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }

    public function allSubCategories($cat_id, $language) {
        $this->db->select('sub_category.sub_category_id,sub_category.image_url,' . $language . ' as sub_category_name');
        $this->db->from('sub_category');
        $this->db->where('category_id', $cat_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    

    public function allChildCategories($subcat_id, $language) {
        $this->db->select('child_category_id,' . $language . ' as child_category_name');
        $this->db->from('child_category');
        $this->db->where('sub_category_id', $subcat_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }

    public function allSuperChildCategory($child_cat_id, $language) {
        $this->db->select('superchild_category.superchild_category_id,' . $language . ' as Superchild_category_name');
        $this->db->from('superchild_category');
        $this->db->where('child_category_id', $child_cat_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }

    public function checkEmail($email) {
        $query = $this->db->get_where('users', ['email' => $email, 'source' => 'self']);
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

    public function siteData($type, $language) {
        $this->db->select('text as description');
        $this->db->where('language_type', $language);
        $this->db->where('type', $type);
        $this->db->from('site');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function do_check_oldpassword($user_id) {
        $old_password = $this->security->xss_clean(hash('sha256', $this->input->post('old_password')));
        $result = $this->db->get_where('users', ['password' => $old_password, 'user_id' => $user_id]);
        return $result->row_array();
    }

    public function do_reset_passowrd($user_id) {
        $new_pass = $this->security->xss_clean(hash('sha256', $this->input->post('new_password')));
        $this->db->update('users', ['password' => $new_pass], ['user_id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function getAllLanguage() {
        $result = $this->db->get('language');
        return $result->result_array();
    }

    public function getShop($super_child_category_id, $language) {
        $this->db->select('shop_id,image_url,shop_name_' . $language . ' as shop_name,address_' . $language . ' as address,city_' . $language . ' as city,state_' . $language . ' as state,pincode,latitude,longitude,shop_name_en,to as open_time,from as close_time,category_id,about');
        $query = $this->db->get_where('saloon', ['superchild_category_id' => $super_child_category_id, 'status' => 'Active']);
        return $query->result_array();
    }

    public function getShopBySearchValue($super_child_category_id, $language, $search_value) {
        $this->db->select('shop_id,image_url,shop_name_' . $language . ' as shop_name,address_' . $language . ' as address,city_' . $language . ' as city,state_' . $language . ' as state,pincode,latitude,longitude,shop_name_en,to as open_time,from as close_time,category_id,about');
        $this->db->from('saloon');
        $this->db->where(['superchild_category_id' => $super_child_category_id, 'status' => 'Active']);
//        $this->db->where()
        $this->db->where('shop_name_' . $language . ' like "%' . $search_value . '%"');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getReviewCount($shop_id) {
        $this->db->select('count(review_id) as count');
        $this->db->from('review');
        $this->db->where('shop_id', $shop_id);
        $this->db->group_by('shop_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAverageRating($shop_id) {
        $this->db->select('round(avg(rating),2) as rating');
        $this->db->from('review');
        $this->db->where('shop_id', $shop_id);
        $this->db->group_by('shop_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function checkWishList($shop_id, $user_id) {
        $data = array(
            'shop_id' => $shop_id,
            'user_id' => $user_id
        );
        $query = $this->db->get_where('favourite', $data);
//        echo $this->db->last_query(); die;
        $query->row_array();
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getServiceCategory($language) {
        $this->db->select('service_category_id,' . $language . ' as service_category_name');
        $query = $this->db->get_where('service_category', ['status' => '1']);
        return $query->result_array();
    }

    public function getService($service_category_id, $language) {
        $this->db->select('service_id,' . $language . ' as service_name,price');
        $query = $this->db->get_where('service', ['service_category_id' => $service_category_id, 'status' => '1']);
        return $query->result_array();
    }

    public function getServicesByShopId($shop_id, $language) {
        $this->db->select('s.service_id,s.' . $language . ' as service_name,s.price');
        $this->db->from('service_category sc');
        $this->db->join('service s', 's.service_category_id=sc.service_category_id');
        $this->db->where('sc.shop_id', $shop_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPopularService($shop_id, $language) {
        $this->db->select('s.service_id,s.' . $language . ' as service_name,s.price');
        $this->db->from('service_category sc');
        $this->db->join('service s', 's.service_category_id=sc.service_category_id');
        $this->db->where('sc.shop_id', $shop_id);
        $this->db->where('s.popular_service', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFavoriteByUserId($user_id, $language) {
        $this->db->select('s.shop_id,s.image_url,s.shop_name_' . $language . ' as shop_name,s.address_' . $language . ' as address,s.city_' . $language . ' as city,s.state_' . $language . ' as state,s.pincode,s.latitude,s.longitude,s.from as open_time,s.to as close_time,s.category_id,s.about');
        $this->db->from('favourite f');
        $this->db->join('saloon s', 's.shop_id=f.shop_id');
        $this->db->where('f.user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCouponCodeByShopId($shop_id) {
        $this->db->select('coupon_code');
        $this->db->from('coupon');
        $this->db->where('status', 'Active');
        $this->db->where('shop_id', $shop_id);
        $this->db->or_where('shop_id', '0');
        $result = $this->db->get();
//        echo $this->db->last_query(); die;
        return $result->result_array();
    }

    public function addToFavorite() {
//        $status=$this->input->post('status');
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'shop_id' => $this->input->post('shop_id')
        );
        $query = $this->db->get_where('favourite', $data);
        if ($query->num_rows() > 0) {
            $this->db->delete('favourite', $data);
            return 0;
        } else {
            $this->db->insert('favourite', $data);
            return 1;
        }
    }

    public function getShopDetailById($shop_id, $language) {
        $top_rated_filter = $this->input->post('top_rated_filter');
        $location_filter = $this->input->post('location_filter');
        $time_filter = $this->input->post('time_filter');
        $this->db->select('s.shop_id,s.image_url,s.shop_name_' . $language . ' as shop_name,s.address_' . $language . ',s.city_' . $language . ',s.state_' . $language . ',s.pincode,s.from as open_time,s.to as close_time,s.latitude,s.longitude');
        $this->db->from('saloon s');
        $this->db->join('review r', 'r.shop_id=s.shop_id');
        $this->db->where('r.shop_id', $shop_id);
        if (!empty($top_rated_filter)) {
            $rated = implode(',', $top_rated_filter);
            $this->db->having('round(avg(r.rating),1)', $rated);
            // $this->db->where_in('round(avg(r.rating),1)',$filter_value);
        }
        if (!empty($location_filter)) {
            $location = implode(',', $location_filter);
            $this->db->where_in('s.city_' . $language, $location);
        }
//        if (!empty($time_filter)) {
//            $time = implode(',', $time_filter);
//            $this->db->where_in('s.timing', $time);
//        }
        $this->db->where('s.shop_id', $shop_id);
        $query = $this->db->get();
//         echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function checkCoupon($coupon) {
        $result = $this->db->get_Where('coupon', ['coupon_code' => $coupon]);
        return $result->row_array();
    }

    public function checkShopCoupon($coupon, $shop_id) {
        $result = $this->db->get_Where('coupon', ['coupon_code' => $coupon, 'shop_id' => $shop_id]);
        return $result->row_array();
    }

    public function getAllBooking($user_id) {
        $language = $this->input->post('language');
        $this->db->select('s.shop_id,s.image_url,s.shop_name_' . $language . ' as shop_name,b.booking_date,b.booking_time,b.total,b.booking_unique_id,b.status');
        $this->db->from('booking b');
        $this->db->join('saloon s', 's.shop_id=b.shop_id');
        $this->db->where('b.user_id', $user_id);
        $this->db->where('b.payment', '1');
//        $this->db->where('b.status!=','Cancel');
//        $this->db->order_by('b.time_filter', 'DESC');
        $result = $this->db->get();
//         echo $this->db->last_query(); die;
        return $result = $result->result_array();
    }

    public function getBookingDetailByBookingId($language) {
        $booking_unique_id = $this->input->post('booking_unique_id');
        $this->db->select('s.shop_id,s.image_url,s.shop_name_' . $language . ' as shop_name,s.from as open_time,s.to as close_time,s.address_' . $language . ' as address,b.booking_date,b.booking_time,b.service,b.user_id,b.total,s.latitude,s.longitude');
        $this->db->from('booking b');
        $this->db->join('saloon s', 's.shop_id = b.shop_id');
        $this->db->where('b.booking_unique_id', $booking_unique_id);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getServcesById($service_id, $language) {
        $language = $this->input->post('language');
        $service_id = explode(',', $service_id);
        $list = [];
        $i = 0;
        for ($i = 0; $i < count($service_id); $i++) {
            $this->db->select('s.' . $language . ' as service_name,s.price,s.service_id,sc.shop_id');
            $this->db->from('service s');
            $this->db->join('service_category sc', 'sc.service_category_id=s.service_category_id');
            $this->db->where('s.service_id', $service_id[$i]);
            $result = $this->db->get();
            $service_detail = $result->row_array();
            $list[$i]['service_name'] = $service_detail['service_name'];
            $list[$i]['price'] = $service_detail['price'];
            $list[$i]['service_id'] = $service_detail['service_id'];
        }
        return $list;
    }

    public function confirmation() {
        $booking_id = $this->input->post('booking_id');
        $transaction_id = $this->input->post('transaction_id');
        $data = array(
            'transaction_id' => $transaction_id,
            'payment' => '1'
        );
        $this->db->update('booking', $data, ['booking_unique_id' => $booking_id]);
        $this->db->select('booking_date,booking_time,service');
        $query = $this->db->get_where('booking', ['booking_unique_id' => $booking_id]);
        return $query->row_array();
    }

    public function checkOut($service, $uniqueId) {
        $booking_date = date('Y-m-d', strtotime($this->input->post('booking_date')));
        $booking_time = $this->input->post('booking_time');
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'booking_date' => $booking_date,
            'booking_unique_id' => $uniqueId,
            'booking_time' => $booking_time,
            'service' => $service,
            'total' => $this->input->post('total'),
            'shop_id' => $this->input->post('shop_id'),
            'time_filter' => $booking_date . ' ' . $booking_time,
            'payment' => '1'
        );
        $this->db->insert('booking', $data);
        return $uniqueId;
    }

    public function cancelBooking($booking_unique_id) {
        $this->db->update('booking', ['status' => 'Cancel'], ['booking_unique_id' => $booking_unique_id]);
//        echo $this->db->last_query(); die;
        return $this->db->affected_rows();
    }
    
    

    public function getAllServiceCategory($language,$cat_type) {
        $this->db->select('sc.service_category_id,sc.' . $language . ' as service_category_name,sc.shop_id,s.superchild_category_id,s.image_url');
        $this->db->from('service_category sc');
        $this->db->join('saloon s', 's.shop_id=sc.shop_id');
        if($cat_type=='wellness'){
        $this->db->where('s.category_id',3);
        }
        if($cat_type=='fitness'){
        $this->db->where('s.category_id',2);
        }
        $result = $this->db->get();
        return $result->result_array();
    }
    public function allSubCategoriesByName($cat_id, $language,$search_value) {
        $this->db->select('sub_category.sub_category_id,sub_category.image_url,' . $language . ' as sub_category_name');
        $this->db->from('sub_category');
        $this->db->where('category_id',1);
        $this->db->where('sub_category.' . $language . ' like "%' . $search_value . '%"');
        $sel = $this->db->get();
//        echo $this->db->last_query(); die;
        return $sel->result_array();
    }
    public function getAllServiceCategoryByName($language,$cat_type,$search_value) {
        $this->db->select('sc.service_category_id,sc.' . $language . ' as service_category_name,sc.shop_id,s.superchild_category_id,s.image_url,s.category_id,sc.shop_id');
        $this->db->from('service_category sc');
        $this->db->join('saloon s', 's.shop_id=sc.shop_id');
        if(ucwords($cat_type)=='Wellness'){
        $this->db->where('s.category_id',3);
        $this->db->where('sc.' .$language . ' like "%' . $search_value . '%"');
        }
        if(ucwords($cat_type)=='Fitness'){
        $this->db->where('s.category_id',2);
        $this->db->where('sc. ' .$language . ' like "%' . $search_value . '%"');
        }
        $this->db->where('sc. ' .$language . ' like "%' . $search_value . '%"');
//        $this->db->where('s.category_id',3);
//        $this->db->or_where('s.category_id',2);
        $this->db->where('(`s.category_id` = "3" OR `s.category_id` = "2")');
        
        $result = $this->db->get();
//        echo $this->db->last_query(); die;
        return $result->result_array();
    }

    public function getServiceByCategoryId($service_category_id, $language) {
        $this->db->select('s.service_id,s.' . $language . ' as service_name,s.price,sc.shop_id');
        $this->db->from('service s');
        $this->db->join('service_category sc', 'sc.service_category_id=s.service_category_id');
        $this->db->where('sc.service_category_id', $service_category_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function topRatedFilter($super_child_category_id) {
        $this->db->select('round(avg(r.rating),1) as filter_value');
        $this->db->from('saloon s');
        $this->db->join('review r', 'r.shop_id=s.shop_id');
        $this->db->where('s.superchild_category_id', $super_child_category_id);
        $this->db->group_by('r.shop_id');
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function getDistanceFilter($super_child_category_id) {
        $query = $this->db->get_where('saloon', ['superchild_category_id' => $super_child_category_id]);
        return $query->result_array();
    }

    public function getLocationFilter($super_child_category_id, $language) {
        $this->db->select('city_' . $language . ' as filter_value');
        $this->db->from('saloon');
        $this->db->where('city_' . $language . '!=', ' ');
        $this->db->group_by('filter_value');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFilteredShop($super_child_category_id, $language) {
        $top_rated_filter = $this->input->post('top_rated_filter');
        $location_filter = $this->input->post('location_filter');
        $time_filters = explode(',',$this->input->post('time_filter'));
        $this->db->select('s.shop_id,s.image_url,s.shop_name_' . $language . ' as shop_name,s.address_' . $language . ' as address,s.city_' . $language . ' as city,s.state_' . $language . ' as state,s.pincode,s.from as open_time,s.to as close_time,s.latitude,s.longitude,s.about');
        $this->db->from('saloon s');

        if (!empty($top_rated_filter)) {
            $this->db->join('review r', 'r.shop_id=s.shop_id');
            $this->db->having('round(avg(r.rating),1)', $top_rated_filter);
            // $this->db->where_in('round(avg(r.rating),1)',$filter_value);
        }
        if (!empty($location_filter)) {
//            echo $location_filter; die;
            $this->db->where_in('s.city_' . $language, $location_filter);
            
        }
        if (!empty($time_filters)) {
            $from = [];
            $f = 0;
            $to = [];
            $t = 0;
            if (!empty($time_filters[0] != null)) {
                foreach ($time_filters as $time_filter) {
                    $time = explode('to', $time_filter);
                    $from[$f] = substr($time[0], 0, 5);
                    $to[$t] = substr($time[1], 1, 5);
                    $f++;
                    $t++;
                }
                $from = implode(',', $from);
                $to = implode(',', $to);
                $this->db->where_in('s.from', $from);
                $this->db->where_in('s.to', $to);
            }
        }
        $this->db->where('s.superchild_category_id', $super_child_category_id);
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function getTimeFilter($super_child_category_id) {
        $this->db->select('from, to');
        $this->db->from('saloon');
        $this->db->group_by('from,to');
//        $this->db->where('timing!=', ' ');
        $this->db->order_by('from', 'asc');
        $query = $this->db->get();
//        echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function getServiceId($service_id, $language) {
        $this->db->select($language . ' as service_name');
        $query = $this->db->get_where('service', ['service_id' => $service_id]);
        return $query->row_array();
    }

    public function checkTokenId($user_id, $token_id) {
        $result = $this->db->get_where('token', ['user_id' => $user_id, 'token_id' => $token_id]);
        return $result->row_array();
    }

    public function deleteTokenId($user_id) {
        $result = $this->db->delete('token', ['token_id'], ['user_id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function setToken($user_id, $token_id) {
        $data = array(
            'user_id' => $user_id,
            'token_id' => $token_id
        );
        $result = $this->db->insert('token', $data);
        return $this->db->insert_id();
    }

    public function checkGuestTokenId($token_id) {
        $query = $this->db->get_where('token', ['user_id' => 0, 'token_id' => $token_id]);
        return $query->row_array();
    }

    public function setGuestUserToken($token_id) {
        $this->db->insert('token', ['token_id' => $token_id]);
        return $this->db->insert_id();
    }

    public function getTokenByUserId($user_id) {
        $result = $this->db->get('token', ['user_id' => $user_id]);
        return $result->row_array();
    }

    public function addNotificationMessage($title, $body, $user_id) {
        $data = array(
            'title' => $title,
            'body' => $body,
            'user_id' => $user_id
        );
        $this->db->insert('notification', $data);
        return $this->db->insert_id();
    }

    public function getAllTokenId() {
        $this->db->distinct();
        $this->db->select('token_id');
        $this->db->from('token');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getAllNotificationByUserId($user_id){
        $result = $this->db->get_where('notification',['user_id'=>$user_id]);
        return $result->result_array();
    }

    public function insertPaymentDetail() {
//        $services = $this->input->post('service');
//        $service = implode(',', $services);
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'service_id' => $this->input->post('service'),
            'amount' => $this->input->post('amount'),
            'payment_status' => $this->input->post('payment_status')
        );
        $this->db->insert('payment', $data);
        return $this->db->insert_id();
    }

    public function updatePaymentStatus() {
        $txn_id = $this->input->post('txn_id');
        $payment_status = $this->input->post('payment_status');
        $this->db->update('payment', ['payment_status' => $payment_status], ['tx_id' => $txn_id]);
        return $this->db->affected_rows();
    }

    public function socialLogin($unique_id) {
        $user_name = $this->input->post('user_name');
        $email = $this->input->post('email');
        $source = $this->input->post('source');
        $data = array(
            'user_name' => $this->input->post('user_name'),
            'lattitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'location' => $this->input->post('location'),
            'email' => $email,
            'source' => $source,
            'unique_id' => $unique_id
        );
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('source', $source);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            $this->db->insert('users', $data);
            $insert_id = $this->db->insert_id();
            $qu = $this->db->get_where('users', ['user_id' => $insert_id]);
            return $qu->row_array();
        }
    }

    public function getSaloonBySaloonName($saloon, $language) {
        $this->db->select('s.shop_id,s.image_url,s.banner_url,s.shop_name_' . $language . ' as shop_name,s.about,s.address_' . $language . ' as address,s.city_' . $language . ' as city,s.state_' . $language . ' as state,s.pincode,s.latitude,s.longitude,s.from as open_time,s.to as close_time');
        $this->db->from('saloon s');
        $this->db->where('s.shop_name_' . $language, $saloon);
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        return $query->row_array();
    }

}
