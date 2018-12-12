<?php

require_once("home.php"); // including home class i.e. controller

/**
* class admin_config_sms
* @category controller
*/
class Admin_config_sms extends Home
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
    * method to load index
    * @access public
    * @return void
    */
    public function index()
    {
        $this->sms_configuration();
    }

    /**
    * method to load index
    * @access public
    * @return void
    */
    public function sms_configuration()
    {
        if (isset($_POST['submit'])) {
            $gateway = strip_tags($this->input->post('sms_gateway', true));
            $auth_id = strip_tags($this->input->post('auth_id', true));
            $token = strip_tags($this->input->post('auth_token', true));
            $phone_number = strip_tags($this->input->post('phone_number', true));
            $api_id = strip_tags($this->input->post('api_id', true));

            if($gateway=="" || $auth_id=="" || $token=="")
            redirect('admin_config_sms/sms_configuration', 'location');

            $update_data = array(
                'name' => $gateway,
                'auth_id' => $auth_id,
                'token' => $token,
                'phone_number' => $phone_number,
                'api_id' => $api_id
            );

            $this->db->update("sms_config", $update_data);
            $this->session->set_flashdata('success_message', 1);
            redirect('admin_config_sms/sms_configuration', 'location');
        }

        $data['sms_configuration'] = $this->basic->get_data('sms_config', $where = '', $select = '', $join = '', $limit = '', $start = '', $order_by = '', $group_by = '', $num_rows = 0);
        $data['body'] = 'admin/sms_config';
        $data['page_title'] = 'SMS Settings';
        $this->_viewcontroller($data);
    }
}
