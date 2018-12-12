<?php

require_once("home.php"); // including home controller

/**
* class admin_config
* @category controller
*/
class Admin_config extends Home
{
    /**
    * load constructor method
    * @access public
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in')!= 1) {
            redirect('home/login', 'location');
        }

        if ($this->session->userdata('user_type')!= 'Admin') {
            redirect('home/login', 'location');
        }

    }

    /**
    * load index method. redirect to config
    * @access public
    * @return void
    */
    public function index()
    {
        $this->configuration();
    }

    /**
    * load config form method
    * @access public
    * @return void
    */
    public function configuration()
    {
        $data['condition'] = $this->basic->get_data('terms_and_condition',$where='');
        $data['body'] = "admin/edit_config";
        $data['time_zone'] = $this->_time_zone_list();
        $data['language_info'] = $this->_language_list();
        $data['page_title'] = 'General Settings';
        $this->_viewcontroller($data);
    }

    /**
    * method to edit config
    * @access public
    * @return void
    */
    public function edit_config()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        if ($_POST) {
            // validation
            $this->form_validation->set_rules('institute_name',       '<b>'.$this->lang->line('institute name').'</b>',             'trim|xss_clean');
            $this->form_validation->set_rules('institute_address',    '<b>'.$this->lang->line('institute address').'</b>',          'trim|xss_clean');
            $this->form_validation->set_rules('institute_email',      '<b>'.$this->lang->line('institute email').'</b>',            'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('institute_mobile',     '<b>'.$this->lang->line('institute phone / mobile').'</b>',   'trim|xss_clean');
            $this->form_validation->set_rules('time_zone',            '<b>'.$this->lang->line('time zone').'</b>',                  'trim|xss_clean');
            $this->form_validation->set_rules('currency',             '<b>'.$this->lang->line('currency').'</b>',                   'trim|xss_clean');
            $this->form_validation->set_rules('language',             '<b>'.$this->lang->line('language').'</b>',                   'trim|xss_clean');
            $this->form_validation->set_rules('condition',            '<b>'.$this->lang->line('terms and conditions').'</b>',       'trim|trim');

            // go to config form page if validation wrong
            if ($this->form_validation->run() == false) {
                return $this->configuration();
            } else {
                // assign
                $institute_name=addslashes(strip_tags($this->input->post('institute_name', true)));
                $institute_address=addslashes(strip_tags($this->input->post('institute_address', true)));
                $institute_email=addslashes(strip_tags($this->input->post('institute_email', true)));
                $institute_mobile=addslashes(strip_tags($this->input->post('institute_mobile', true)));
                $time_zone=addslashes(strip_tags($this->input->post('time_zone', true)));
                $currency=addslashes(strip_tags($this->input->post('currency', true)));
                $language=addslashes(strip_tags($this->input->post('language', true)));
                $condition=$this->input->post('condition', true);

                $base_path=realpath(APPPATH . '../assets/images');

                $this->load->library('upload');

                if ($_FILES['logo']['size'] != 0) {
                    $photo = "logo.png";
                    $config = array(
                        "allowed_types" => "png",
                        "upload_path" => $base_path,
                        "overwrite" => true,
                        "file_name" => $photo,
                        'max_size' => '200',
                        'max_width' => '600',
                        'max_height' => '300'
                        );
                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('logo')) {
                        $this->session->set_userdata('logo_error', $this->upload->display_errors());
                        return $this->configuration();
                    }
                }

                if ($_FILES['favicon']['size'] != 0) {
                    $photo = "favicon.png";
                    $config2 = array(
                        "allowed_types" => "png",
                        "upload_path" => $base_path,
                        "overwrite" => true,
                        "file_name" => $photo,
                        'max_size' => '50',
                        'max_width' => '32',
                        'max_height' => '32'
                        );
                    $this->upload->initialize($config2);
                    $this->load->library('upload', $config2);

                    if (!$this->upload->do_upload('favicon')) {
                        $this->session->set_userdata('favicon_error', $this->upload->display_errors());
                        return $this->configuration();
                    }
                }

                // writing application/config/my_config
                  $app_my_config_data = "<?php ";
                $app_my_config_data.= "\n\$config['default_page_url'] = '".$this->config->item('default_page_url')."';\n";
                $app_my_config_data.= "\$config['product_name'] = '".$this->config->item('product_name')."';\n";
                $app_my_config_data.= "\$config['product_short_name'] = '".$this->config->item('product_short_name')."' ;\n";
                $app_my_config_data.= "\$config['product_version'] = '".$this->config->item('product_version')." ';\n\n";
                $app_my_config_data.= "\$config['institute_address1'] = '$institute_name';\n";
                $app_my_config_data.= "\$config['institute_address2'] = '$institute_address';\n";
                $app_my_config_data.= "\$config['institute_email'] = '$institute_email';\n";
                $app_my_config_data.= "\$config['institute_mobile'] = '$institute_mobile';\n\n";
                $app_my_config_data.= "\$config['developed_by'] = '".$this->config->item('developed_by')."';\n";
                $app_my_config_data.= "\$config['developed_by_href'] = '".$this->config->item('developed_by_href')."';\n";
                $app_my_config_data.= "\$config['developed_by_title'] = '".$this->config->item('developed_by_title')."';\n";
                $app_my_config_data.= "\$config['developed_by_prefix'] = '".$this->config->item('developed_by_prefix')."' ;\n";
                $app_my_config_data.= "\$config['support_email'] = '".$this->config->item('support_email')."' ;\n";
                $app_my_config_data.= "\$config['support_mobile'] = '".$this->config->item('support_mobile')."' ;\n";
                $app_my_config_data.= "\$config['time_zone'] = '$time_zone';\n";
                $app_my_config_data.= "\$config['currency'] = '$currency';\n";
                $app_my_config_data.= "\$config['language'] = '$language';\n";
                $app_my_config_data.= "\$config['sess_use_database'] = true;\n";
                $app_my_config_data.= "\$config['sess_table_name'] = 'ci_sessions';\n";

                file_put_contents(APPPATH.'config/my_config.php', $app_my_config_data, LOCK_EX);
                  //writting  application/config/my_config

                $data = array('terms_and_condition' => $condition);
                $where = array('id' => 1);
                $this->basic->update_data('terms_and_condition',$where,$data);

                $this->session->unset_userdata("selected_language");

                $this->session->set_flashdata('success_message', 1);
                redirect('admin_config/configuration', 'location');
            }
        }
    }
}
