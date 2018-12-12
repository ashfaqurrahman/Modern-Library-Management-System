<?php

require_once("home.php");

/**
* class admin_config_email
* @category controller
*/
class Admin_config_email extends Home
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
    * load index method. redirect to email_smtp_settings
    * @access public
    * @return void
    */
    public function index()
    {
        $this->email_smtp_settings();
    }

    /**
    * method to load email_smtp_settings
    * @access public
    * @return void
    */
    public function email_smtp_settings()
    {
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');
        $crud->set_table('email_config');
        $crud->order_by('email_address');
        $crud->set_subject($this->lang->line('email SMTP settings'));
        $crud->required_fields('email_address', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password', 'status');
        $crud->columns('email_address', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password', 'status');
        $crud->fields('email_address', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password', 'status');
        $crud->set_rules('email_address',$this->lang->line("email"),'valid_email');

        // $crud->field_type('smtp_password', 'password');

        // Only one smtp can be active at a time
        $crud->callback_after_insert(array($this, 'make_up_active_smtp_setting'));
        $crud->callback_after_update(array($this, 'make_up_active_smtp_setting_edit'));

        $crud->callback_field('status', array($this, 'status_field_crud'));
        $crud->callback_column('status', array($this, 'status_display_crud'));
        $crud->unset_export();
        $crud->unset_print();
        $crud->unset_read();

        $crud->display_as('email_address', $this->lang->line('email'));
        $crud->display_as('smtp_host', $this->lang->line('SMTP Host'));
        $crud->display_as('smtp_port', $this->lang->line('SMTP Port'));
        $crud->display_as('smtp_user', $this->lang->line('SMTP User'));
        $crud->display_as('smtp_password', $this->lang->line('SMTP Password'));
        $crud->display_as('status', $this->lang->line('status'));

        $output = $crud->render();
        $data['output'] = $output;
        $data['crud'] = 1;
        $data['page_title'] = 'Email Settings';
        $this->_viewcontroller($data);
    }

    /**
    * method to active smtp smtp setting
    * @access public
    * @return boolean
    */

    public function make_up_active_smtp_setting($post_array, $primary_key)
    {
        if ($post_array['status']=='1') {
            $table="email_config";
            $where=array('id !='=> $primary_key);
            $data=array("status"=>"0");
            $this->basic->update_data($table, $where, $data);
            $this->db->last_query();
        }

        return true;
    }

    /**
    * method to active smtp smtp setting edit
    * @access public
    * @return boolean
    */

    public function make_up_active_smtp_setting_edit($post_array, $primary_key)
    {
        if ($post_array['status']=='1') {
            $table="email_config";
            $where=array('id !='=> $primary_key);
            $data=array("status"=>"0");
            $this->basic->update_data($table, $where, $data);
            $this->db->last_query();
        }
        return true;
    }


    /**
    * method to load status_field_crud
    * @access public
    * @return from_dropdown dropdown
    * @param $value string
    * @param $row	array
    */
    public function status_field_crud($value, $row)
    {
        if ($value == '') {
            $value = 1;
        }
        return form_dropdown('status', array(0 => $this->lang->line("inactive"), 1 => $this->lang->line("active")), $value, 'class="form-control" id="field-status"');
    }

    /**
    * method to load status_display_crud
    * @access public
    * @return message string
    * @param $value integer
    * @param $row  array
    */
    public function status_display_crud($value, $row)
    {
        if ($value == 1) {
            return "<span class='label label-success'>".$this->lang->line("active")."</sapn>";
        } else {
            return "<span class='label label-warning'>".$this->lang->line("inactive")."</sapn>";
        }
    }
}
