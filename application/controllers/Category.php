<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Admin_model']);
        $this->load->model(['Category_model']);
    }
    
    public function category()
    {
        $data['title'] = 'Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/category',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doaddcategory()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_en', 'Category(English)', 'required');
        $this->form_validation->set_rules('category_es', 'Category(Spanish)', 'required');
        $this->form_validation->set_rules('category_fr', 'Category(French)', 'required');
        $this->form_validation->set_rules('category_pt', 'Category(Portuguesse)', 'required');        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        if(!empty($_FILES['file1']['name'])){
            $file1=$this->doUploadFile('file1');
            if(!$file1){
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } 
        
        $result = $this->Category_model->doaddcategory($file1);
        if ($result) {            
            
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/category'), 'msg' => 'Category Added']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function doUploadFile($file){
        $file1 = $_FILES[$file]['name'];
        $config['upload_path'] = './uploads/category/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $upload_data = $this->upload->data();
        if($upload_data){
            return $upload_data['file_name'];
        }else{
              $this->session->set_userdata('error', [$file => $this->upload->display_errors()]);
            return 0;
        }
    }  
    
    
    public function doEditCategory($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_en', 'Category(English)', 'required');
        $this->form_validation->set_rules('category_es', 'Category(Spanish)', 'required');
        $this->form_validation->set_rules('category_fr', 'Category(French)', 'required');
        $this->form_validation->set_rules('category_pt', 'Category(Portuguesse)', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $category_image = $this->Category_model->getCategoryImage($id);
        if(!empty($_FILES['file1']['name'])){
            $file1=$this->doUploadFile('file1');
            if(!$file1){
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        }else{
                $file1 = $category_image['image_url'];
            }
        $result = $this->Category_model->doEditCategory($id,$file1);
        if ($result) {         
            
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/category'), 'msg' => 'Category Updated']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function subCategory()
    {
        $data['title'] = 'Sub Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getsubcategories'] = $this->Category_model->getsubcategories();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/subcategory',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doaddsubcategory()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('subcategory_en', 'Sub Category(English)', 'required');
        $this->form_validation->set_rules('subcategory_es', 'Sub Category(Spanish)', 'required');
        $this->form_validation->set_rules('subcategory_fr', 'Sub Category(French)', 'required');
        $this->form_validation->set_rules('subcategory_pt', 'Sub Category(Portuguesse)', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
         if(!empty($_FILES['file1']['name'])){
            $file1=$this->doUploadFileSubcategory('file1');
            if(!$file1){
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } 
        $result = $this->Category_model->doaddsubcategory($file1);
        if ($result) {        
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/subCategory'), 'msg' => 'SubCategory Added']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function doUploadFileSubcategory($file){
        $file1 = $_FILES[$file]['name'];
        $config['upload_path'] = './uploads/subcategory/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $upload_data = $this->upload->data();
        if($upload_data){
            return $upload_data['file_name'];
        }else{
              $this->session->set_userdata('error', [$file => $this->upload->display_errors()]);
            return 0;
        }
    }
    
    public function editSubcategory($id)
    {
        $data['title'] = 'Edit Sub Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getsubcategories'] = $this->Category_model->getsubcategories();
        $data['getsubcategoriesById'] = $this->Category_model->getsubcategoriesById($id);
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/subcategory',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doEditSubcategory($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('subcategory_en', 'Sub Category(English)', 'required');
        $this->form_validation->set_rules('subcategory_es', 'Sub Category(Spanish)', 'required');
        $this->form_validation->set_rules('subcategory_fr', 'Sub Category(French)', 'required');
        $this->form_validation->set_rules('subcategory_pt', 'Sub Category(Portuguesse)', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $sub_category_image = $this->Category_model->getSubcategoryImage($id);
         if(!empty($_FILES['file1']['name'])){
            $file1=$this->doUploadFileSubcategory('file1');
            if(!$file1){
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        }else{
            $file1 =  $sub_category_image['image_url'];
         } 
        $result = $this->Category_model->doEditSubcategory($file1,$id);
        if ($result) {        
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/subCategory'), 'msg' => 'SubCategory Updated']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function childCategory()
    {
        $data['title'] = 'Child Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getsubcategories'] = $this->Category_model->getsubcategories();
        $data['getchildcategories'] = $this->Category_model->getchildcategories();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/childcategory',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doaddchildcategory()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('childcategory_en', 'Child Category(English)', 'required');
        $this->form_validation->set_rules('childcategory_es', 'Child Category(Spanish)', 'required');
        $this->form_validation->set_rules('childcategory_fr', 'Child Category(French)', 'required');
        $this->form_validation->set_rules('childcategory_pt', 'Child Category(Portuguesse)', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Category_model->doaddchildcategory();
        if ($result) {            
            
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/childCategory'), 'msg' => 'Child Category Added']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function editChildCategory($id)
    {
        $data['title'] = 'Edit Child Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getsubcategories'] = $this->Category_model->getsubcategories();
        $data['getchildcategories'] = $this->Category_model->getchildcategories();
        $data['getChildCategoryByid'] = $this->Category_model->getChildCategoryByid($id);
//        print_r($data['getChildCategoryByid']);die;
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/childcategory',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doEditChildCategory($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('childcategory_en', 'Child Category(English)', 'required');
        $this->form_validation->set_rules('childcategory_es', 'Child Category(Spanish)', 'required');
        $this->form_validation->set_rules('childcategory_fr', 'Child Category(French)', 'required');
        $this->form_validation->set_rules('childcategory_pt', 'Child Category(Portuguesse)', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Category_model->doEditChildCategory($id);
        if ($result) {            
            
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/childCategory'), 'msg' => 'Child Category Updated']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function doDeleteChildcategory($id)
    {
        $this->output->set_content_type('application/json');
        $result = $this->Category_model->doDeleteChildcategory($id);
        if($result)
        {
           $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/childCategory'), 'msg' => 'deleted']));
            return FALSE; 
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to delete']));
            return FALSE;
        }
    }
    
    public function subcat()
    {
        $id = $this->input->post('category_id');
        $data['result'] = $this->Category_model->subcat($id);  
        $this->load->view('admin/category/categryData',$data);        
    }
    
    
    
    public function superchildCategory()
    {
        $data['title'] = 'SuperChild Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getsubcategories'] = $this->Category_model->getsubcategories();
        $data['getchildcategories'] = $this->Category_model->getchildcategories();
        $data['getsuperchildcategories'] = $this->Category_model->getsuperchildcategories();
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/superchildcategory',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doaddsuperchildcategory(){
        
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('superchildcategory_en', 'SuperChild Category(English)', 'required');
        $this->form_validation->set_rules('superchildcategory_es', 'SuperChild Category(Spanish)', 'required');
        $this->form_validation->set_rules('superchildcategory_fr', 'SuperChild Category(French)', 'required');
        $this->form_validation->set_rules('superchildcategory_pt', 'SuperChild Category(Portuguesse)', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Category_model->doaddsuperchildcategory();
        if ($result) {            
            
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/superchildCategory'), 'msg' => 'SuperChild Category Added']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function editSuperChildCategory($id)
    {
        $data['title'] = 'Edit SuperChild Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getsubcategories'] = $this->Category_model->getsubcategories();
        $data['getchildcategories'] = $this->Category_model->getchildcategories();
        $data['getsuperchildcategories'] = $this->Category_model->getsuperchildcategories();
        $data['getSuperChildById'] = $this->Category_model->getSuperChildById($id);
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/superchildcategory',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doEditSuperchild($id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('superchildcategory_en', 'SuperChild Category(English)', 'required');
        $this->form_validation->set_rules('superchildcategory_es', 'SuperChild Category(Spanish)', 'required');
        $this->form_validation->set_rules('superchildcategory_fr', 'SuperChild Category(French)', 'required');
        $this->form_validation->set_rules('superchildcategory_pt', 'SuperChild Category(Portuguesse)', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Category_model->doEditSuperchild($id);
        if ($result) {            
            
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/superchildCategory'), 'msg' => 'SuperChild Category Updated']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
    }
    
    public function childcat()
    {
        $id = $this->input->post('subcategory_id');
        $data['result'] = $this->Category_model->childcat($id);  
        $this->load->view('admin/category/childcat',$data);  
        
    }
    
    public function subchildcat()
    {
        $id = $this->input->post('childcat_id');
        $data['result'] = $this->Category_model->subchildcat($id);
        $this->load->view('admin/category/subchildcat',$data);
    }
    
    public function doDeleteCategory($id)
    {
        $this->output->set_content_type('application/json');
        $result = $this->Category_model->doDeleteCategory($id);
        if($result)
        {
           $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/category'), 'msg' => 'deleted']));
            return FALSE; 
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to delete']));
            return FALSE;
        }
    }
    
    public function editCategory($id)
    {
        $data['title'] = 'Edit Category';
        $data['getCategories'] = $this->Category_model->getCategories();
        $data['getCategoryById'] = $this->Category_model->getCategoryById($id);
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/category/category',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function siteLanguage()
    {
        $data['title'] = 'Manage Language';
        $data['getSiteLanguage'] = $this->Category_model->getSiteLanguage();
//        print_r($data['getSiteLanguage']);die;
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/commons/sidebar');
        $this->load->view('admin/commons/navbar');        
        $this->load->view('admin/siteLanguage',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doManageLanguage()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('key', 'Key', 'required');
        $this->form_validation->set_rules('en', 'English', 'required');
        $this->form_validation->set_rules('es', 'Spanish', 'required');
        $this->form_validation->set_rules('fr', 'French', 'required');
        $this->form_validation->set_rules('pt', 'Portuguesse', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $result = $this->Category_model->doManageLanguage();
        if($result)
        {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('Category/siteLanguage'), 'msg' => 'Added']));
            return FALSE; 
        }else
        {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to Add']));
            return FALSE;
        }
        
    }  
    
    
    
   
}
?>