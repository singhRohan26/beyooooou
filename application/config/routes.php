<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Site Routing
$route['contactus'] = "Site/contactUs";
$route['about'] = "Site/about_us";
$route['terms'] = "Site/terms";
$route['privacy'] = "Site/privacy";
$route['support'] = "Site/support";
$route['info'] = "Site/info";
$route['faq'] = "Site/faq";
$route['signup'] = "Site/signUp";
$route['login_username'] = "Site/login_username";
$route['login_password'] = "Site/login_password";
$route['bank_detail'] = "Site/bankDetail";
$route['logout'] = "Site/logout";
$route['forgot-password'] = "Site/forgotPassword";

$route['reset-password/(:any)/(:any)'] = "Site/password_reset/$1/$2";

//Admin Login
$route['admin'] = "admin/Admin/index";
$route['admin/checkLogin'] = "admin/Admin/checkLogin";
$route['admin/dashboard'] = "admin/Admin/dashboard";
$route['admin/forgot-password'] = "admin/Admin/forgotPassword";
$route['admin/forgot_password'] = 'admin/Admin/forgot_password';
$route['admin/reset-password/(:any)'] = "admin/Admin/password_reset_link/$1";
$route['admin/resetPassword'] = "admin/Admin/do_reset_password";
$route['admin/change-password'] = "admin/Admin/changePassword";
$route['admin/doChangePassword/(:any)'] = "admin/Admin/doChangePassword/$1";
$route['admin/profile'] = "admin/Admin/adminProfile";
$route['admin/logout'] = "admin/Admin/logout";

//Manufacturer Section
$route['admin/manufacturer'] = "admin/Manufacturer/index";
$route['admin/manufacturer/(:any)'] = "admin/Manufacturer/index/$1";
$route['admin/get-manufacturer-wrapper'] = "admin/Manufacturer/get_manufacturer_wrapper";
$route['admin/do-add-manufacturer'] = "admin/Manufacturer/do_add_manufacturer";
$route['admin/do-edit-manufacturer/(:any)'] = "admin/Manufacturer/do_edit_manufacturer/$1";
$route['admin/manufacturer/change_manufacturer_status/(:any)/(:any)'] = 'admin/Manufacturer/change_manufacturer_status/$1/$2';

//Sizes Section
$route['admin/size'] = "admin/Size/index";
$route['admin/size/(:any)'] = "admin/Size/index/$1";
$route['admin/get-size-wrapper'] = "admin/Size/get_size_wrapper";
$route['admin/do-add-size'] = "admin/Size/do_add_size";
$route['admin/do-edit-size/(:any)'] = "admin/Size/do_edit_size/$1";
$route['admin/size/change_size_status/(:any)/(:any)'] = 'admin/Size/change_size_status/$1/$2';

//PCD's Section
$route['admin/pcd'] = "admin/Pcd/index";
$route['admin/pcd/(:any)'] = "admin/Pcd/index/$1";
$route['admin/get-pcd-wrapper'] = "admin/Pcd/get_pcd_wrapper";
$route['admin/do-add-pcd'] = "admin/Pcd/do_add_pcd";
$route['admin/do-edit-pcd/(:any)'] = "admin/Pcd/do_edit_pcd/$1";
$route['admin/pcd/change_pcd_status/(:any)/(:any)'] = 'admin/Pcd/change_pcd_status/$1/$2';

//Cities Section
// $route['admin/cities'] = "admin/Pcd/cities";
// $route['admin/get-cities-wrapper'] = "admin/Pcd/get_city_wrapper";

//Cities Section
$route['admin/contacts'] = "admin/Settings/contacts";
$route['admin/get-contact-wrapper'] = "admin/Settings/get_contact_wrapper";

//Settings Routes
$route['admin/about'] = "admin/Settings/aboutUs";
$route['admin/privacy'] = "admin/Settings/privacy";
$route['admin/terms'] = "admin/Settings/terms";
$route['admin/support'] = "admin/Settings/support";
$route['admin/info'] = "admin/Settings/info";

//Users Routes
$route['admin/users'] = "admin/Settings/usersList";
$route['admin/get-users-wrapper'] = "admin/Settings/get_users_wrapper";
$route['admin/users/change_users_status/(:any)/(:any)'] = 'admin/Settings/change_users_status/$1/$2';

//Posts Routes
$route['admin/posts'] = "admin/Settings/postList";
$route['admin/get-posts-wrapper'] = "admin/Settings/get_post_wrapper";
$route['admin/posts/post_detail/(:any)'] = "admin/Settings/view_post_detail/$1";

//Social Media Listing
$route['admin/socialmedia'] = "admin/Settings/allSocialMedia";
$route['admin/get-social-media-wrapper'] = "admin/Settings/get_social_media_wrapper";
$route['admin/socialmedia/(:any)'] = "admin/Settings/allSocialMedia/$1";
$route['admin/do-edit-social-media/(:any)'] = "admin/Settings/doEditSocialMedia/$1";

//FAQ Routing
$route['admin/faq'] = "admin/Settings/faq";
$route['admin/get-faq-wrapper'] = "admin/Settings/get_faq_wrapper";
$route['admin/add-faq'] = "admin/Settings/addFaq";
$route['admin/edit-faq/(:any)'] = "admin/Settings/addFaq/$1";
$route['admin/do-edit-faq/(:any)'] = "admin/Settings/do_edit_faq/$1";
$route['admin/faq/change_faq_status/(:any)/(:any)'] = "admin/Settings/change_faq_status/$1/$2";