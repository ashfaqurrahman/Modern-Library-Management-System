<?php
//including home controller
require_once("home.php");
/**
* @category controller
* class Admin
*/
class librarian extends Home
{
    /**
    * load constructor
    * @access public
    * @return void
    */

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in') != 1) {
            redirect('home/login', 'location');
        }

        if ($this->session->userdata('user_type') != 'Librarian') {
            redirect('home/login', 'location');
        }

        $this->periodic_check();

        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->upload_path = realpath(APPPATH . '../upload');
    }


    public function index()
    {
        $this->dash_board();
    }

    /**
    * display book list
    * @access public
    * @return void
    */
    public function admin_books()
    {

        $data['body'] = 'librarian/admin_books';
        $this->_librarian_viewcontroller($data);
    }

    /**
    * Add, delete , upadte function for member type using grocery crud
    * @access public
    * @return void
    */

    public function config_member_type()
    {
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');
        $crud->set_table('member_type');
        $crud->order_by('id');
        $crud->where('deleted', '0');
        $crud->set_subject($this->lang->line("member types"));
        $crud->required_fields('member_type_name');
        $crud->columns('id', 'member_type_name');
        $crud->fields('member_type_name');
        $crud->display_as('id', $this->lang->line("type id"));
        $crud->display_as('member_type_name', $this->lang->line("member types"));

        $crud->set_rules('member_type_name',$this->lang->line("member types"), 'required|is_unique[member_type.member_type_name]');

        $crud->callback_after_insert(array($this, 'add_circulation_new_type'));
        $crud->unset_read();
        $crud->unset_print();
        $crud->unset_export();

        $output = $crud->render();
        $data['output']=$output;
        $data['crud']=1;
        $data['page_title'] = "Member Type";

        $this->_librarian_viewcontroller($data);
    }

    /**
    * Add circulation crud
    * @access public
    * @return boolean
    * @param array
    * @param int
    */
    public function add_circulation_new_type($post_array, $primary_key)
    {
        $new_type_id = $primary_key;
        $table = 'circulation_config';
        $data = array(
            'member_type_id'=>$new_type_id,
            'issue_day_limit'=>'0',
            'issu_book_limit'=>'0',
            'fine_per_day'=>'0',
            'deleted'=>'0'
            );
        $this->basic->insert_data($table, $data);
        return true;
    }


    /**
    * Config member type
    * @access public
    * @return void
    */
    public function config_member()
    {
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid1');
        $crud->set_subject($this->lang->line("member"));
        $crud->set_table('member');
        $crud->order_by('member.id');
        $crud->where('member.deleted', '0');


        $crud->callback_field('type_id', array($this, 'filter_deleted_member_type'));

        $crud->set_relation('type_id', 'member_type', 'member_type_name', 'id ASC');

        $crud->field_type('password', 'password');

        $crud->columns('name','user_type', 'type_id', 'email', 'mobile', 'address', 'status');

        $crud->required_fields('name','user_type','email', 'mobile', 'password', 'address', 'status');

        $crud->add_fields('name', 'user_type', 'type_id', 'email', 'mobile', 'password', 'address', 'status');

        $crud->edit_fields('name', 'user_type', 'type_id',  'email', 'mobile', 'address', 'status');

        // $crud->callback_column('Print ID',array($this,'_print_function'));


        $crud->set_rules("email",$this->lang->line("email"),'callback_unique_email_check['.$this->uri->segment(4).']');
        
        // $images_url_pass = base_url("plugins/grocery_crud/themes/flexigrid/css/images/password.png");
        // $crud->add_action($this->lang->line("Change Password"), $images_url_pass, 'librarian/change_member_password');

        // $images_url_id = base_url("plugins/grocery_crud/themes/flexigrid/css/images/id_card.png");
        // $crud->add_action($this->lang->line("Print ID Card"), $images_url_id, 'librarian/print_id_card'); 


        $crud->display_as('id', $this->lang->line("ID"));
        $crud->display_as('name', $this->lang->line("name"));
        $crud->display_as('type_id', $this->lang->line("member types"));
        $crud->display_as('user_type', $this->lang->line("user type"));
        $crud->display_as('email', $this->lang->line("email"));
        $crud->display_as('mobile', $this->lang->line("mobile"));
        $crud->display_as('address', $this->lang->line("address"));
        $crud->display_as('status', $this->lang->line("status"));

        $crud->set_relation('type_id', 'member_type', 'member_type_name', null, 'id ASC');

        $crud->callback_field('status', array($this, 'status_field_crud'));        
        $crud->callback_column('status', array($this, 'status_display_crud'));
        $crud->callback_column('user_type', array($this, 'user_type_display_crud'));

        $crud->callback_after_update(array($this, 'send_notification_member'));
        $crud->callback_after_insert(array($this, 'change_password_to_md5'));

        $crud->unset_print();
        $crud->unset_read();
        $output = $crud->render();
        $data['output'] = $output;
        $data['crud'] = 1;
        $data['page_title'] = "Member";

        $this->_librarian_viewcontroller($data);
    }


   /* function _print_function($value,$row){
    	
    	$id = $row->id;

    	$table = 'member';
    	$where['where'] = array('member.id'=>$id);
    	$select = array('member.id as id','name','email','address','add_date','member_type.member_type_name as type_name');
    	$join =  $join = array("member_type" => "member.type_id = member_type.id,left");

    	$info = $this->basic->get_data($table,$where,$select,$join);

    	$str = implode('_|_', $info[0]);
    	$src=base_url()."barcode.php?code=".$info[0]['id'];

    	$str = $str."_|_".$src;
    	  	
    	$ret="<a onclick=\"print_member_id_card('".$str."')\">Print</a>";    	
		return $ret;
    }*/

    function unique_email_check($str, $edited_id)
    {
        $email= strip_tags(trim($this->input->post('email',TRUE)));
		if($email==""){
			$s = $this->lang->line("required");
            $s=str_replace("<b>%s</b>","",$s);
            $s="<b>".$this->lang->line("email")."</b> ".$s;
            $this->form_validation->set_message('unique_email_check', $s);
            return FALSE;
		}
        
        if(!isset($edited_id) || !$edited_id)
        $where=array("email"=>$email);
        else $where=array("email"=>$email,"id !="=>$edited_id);
        
        
        $is_unique=$this->basic->is_unique("member",$where,$select='');
        
        if (!$is_unique) 
        {
            $s = $this->lang->line("is_unique");
            $s=str_replace("<b>%s</b>","",$s);
            $s="<b>".$this->lang->line("email")."</b> ".$s;
            $this->form_validation->set_message('unique_email_check', $s);
            return FALSE;
        }
                
        return TRUE;
    }


    /**
    * Filter Deleted Member Type
    * @access public
    * @return void
    */

    public function filter_deleted_member_type($selected_value = '', $primary_key = null)
    {
        $table = 'member_type';
        $where['where'] = array('deleted'=>'0');

        $info = $this->basic->get_data($table, $where);

        $str ="<select id='field-type_id' class='chosen-select' name='type_id'>";
        $str.= "<option value=''></option>";
        foreach ($info as $value) {
            $select_flag = '';
            if ($selected_value == $value['id']) {
                $select_flag = 'selected';
            }
            $str = $str."<option value='{$value['id']}' {$select_flag}>{$value['member_type_name']}</option>";
        }

        $str = $str."</select>";
        return $str;
    }

  
    /**
    * Password hasher
    * @access public
    * @return boolean
    * @param array
    * @param int
    */
    public function change_password_to_md5($post_array, $primary_key) // Function for hashing password while adding new member.
    {
        $id = $primary_key;

        $data = array(
            'password' => md5($post_array['password']),
            'add_date' => date('Y-m-d')
            );
        $where = array('id' => $id);
        $this->basic->update_data('member', $where, $data);
        $name = $post_array['name'];
        $to = $post_array['email'];
        $password = $post_array['password'];

        $subject = 'Sign Up Notification';
        $mask = $this->config->item('product_name');
        $from = $this->config->item('institute_email');
        $url = site_url();
        $message = "Dear {$name}, Your <a href='".$url."'>{$mask}</a> username  is: {$to} and password is: {$password}.Thank you ";
        $this->_mail_sender($from, $to, $subject, $message, $mask);

        return true;
    }


    /**
    * Registration approval notification
    * @access public
    * @return boolean
    * @param array
    * @param int
    */
    public function send_notification_member($post_array, $primary_key)
    {
        if ($post_array['status'] == '1') {
            $name = $post_array['name'];
            $to = $post_array['email'];
            $subject = 'Approval Notification';
            $password = $post_array['password'];
            $mask = $this->config->item('product_name');
            $from = $this->config->item('institute_email');
            $url = site_url('home/login');
            $message = "Dear {$name}, Your member Request for <a href ='".$url."'>{$mask}</a> has been accepted. You can log in now. Thank you";
            $this->_mail_sender($from, $to, $subject, $message, $mask);
        }

        return true;
    }

    /**
    * Load admin password change form
    * @access public
    * @return void
    * @param int
    */
    public function change_member_password($id)
    {
        $this->session->set_userdata('change_member_password_id', $id);

        $table = 'member';
        $where['where'] = array('id' => $id);

        $info = $this->basic->get_data($table, $where);

        $data['member_name'] = $info[0]['name'];

        $data['body'] = 'librarian/change_member_password';
        $data['page_title'] = "Password Change";
        $this->_librarian_viewcontroller($data);
    }


    public function print_id_card($id){
    	echo $id;
    }

    /**
    * Registration approval action
    * @access public
    * @return void
    */
    public function change_member_password_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }
        $id = $this->session->userdata('change_member_password_id');
        // $this->session->unset_userdata('change_member_password_id');
        if ($_POST) {
            $this->form_validation->set_rules('password', '<b>'. $this->lang->line("password").'</b>', 'trim|required');
            $this->form_validation->set_rules('confirm_password', '<b>'. $this->lang->line("confirm password").'</b>', 'trim|required|matches[password]');
        }
        if ($this->form_validation->run() == false) {
            $this->change_member_password($id);
        } else {
            $new_password = $this->input->post('password', true);
            $new_confirm_password = $this->input->post('confirm_password', true);

            $table_change_password = 'member';
            $where_change_passwor = array('id' => $id);
            $data = array('password' => md5($new_password));
            $this->basic->update_data($table_change_password, $where_change_passwor, $data);
            $this->session->set_flashdata('success_message', 1);
                // return $this->config_member();
            redirect('librarian/config_member', 'location');
        }
    }


    /**
    * Grocery crud status display modifier
    * @access public
    * @return string
    * @param string
    * @param array
    */
    public function user_type_display_crud($value, $row)
    {
       $str=$value." level user";
       return $this->lang->line($str);        
    }


    /**
    * Grocery crud status display modifier
    * @access public
    * @return string
    * @param string
    * @param array
    */
    public function status_display_crud($value, $row)
    {
        if ($value == 1) {
            return "<span class='label label-success'>".$this->lang->line("active")."</sapn>";
        } else {
            return "<span class='label label-warning'>".$this->lang->line("inactive")."</sapn>";
        }
    }


    /**
    * Grocery crud status field modifier
    * @access public
    * @return string
    * @param string
    * @param array
    */
    public function status_field_crud($value, $row)
    {
        if ($value == '') {
            $value = 1;
        }
        return form_dropdown('status', array(0 => $this->lang->line("inactive"), 1 => $this->lang->line("active")), $value, 'class="form-control" id="field-status"');
    }

    /**
    * Book category configuration
    * @access public
    * @return void
    */
    public function config_category()
    {
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');
        $crud->set_table('category');
        $crud->order_by('id');
        $crud->where('deleted', '0');
        $crud->set_subject($this->lang->line("book categories"));
        $crud->required_fields('category_name');
        $crud->columns('id', 'category_name');
        $crud->fields('category_name');
        $crud->display_as('id',$this->lang->line("category id"));
        $crud->display_as('category_name',$this->lang->line("category name"));
        $crud->unset_read();
        $crud->unset_print();
        $crud->unset_export();

        $output = $crud->render();
        $data['output'] = $output;
        $data['crud'] = 1;
        $data['page_title'] = "Book Category";

        $this->_librarian_viewcontroller($data);
    }

    /**
    * Circulation config
    * @access public
    * @return void
    */
    public function config_circulation()
    {
        $currency = $this->config->item('currency');

        $this->load->database();
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');

        $crud->set_table('circulation_config');
        $crud->set_subject($this->lang->line('circulation settings'));
        $crud->order_by('id');
        $crud->where('circulation_config.deleted', '0');
        $crud->required_fields('issue_day_limit', 'issu_book_limit', 'fine_per_day');
        $crud->columns('member_type_id', 'issue_day_limit', 'issu_book_limit', 'fine_per_day');
        $crud->fields('issue_day_limit', 'issu_book_limit', 'fine_per_day');
        $crud->display_as('member_type_id', 'Member Type');
        $crud->set_relation('member_type_id', 'member_type', 'member_type_name', null, 'member_type_name ASC');

        $crud->display_as('issue_day_limit',$this->lang->line('issue limit - days'));
        $crud->display_as('fine_per_day',$this->lang->line('fine per day')." - ".$currency);
        $crud->display_as('issu_book_limit',$this->lang->line('issue limit - books'));
        $crud->display_as('member_type_id',$this->lang->line('member types'));

        $crud->unset_add();
        $crud->unset_read();
        $crud->unset_print();
        $crud->unset_export();
        $crud->unset_delete();

        $output = $crud->render();
        $data['output'] = $output;
        $data['crud'] = 1;
        $data['page_title'] = "Circulation Settings";

        $this->_librarian_viewcontroller($data);
    }


    /**
    * Circulation list loader
    * @access public
    * @return void
    */
    public function circulation()
    {
        $data['body'] = 'librarian/circulation';
        $data['page_title'] = 'Book Circulation';
        $this->_librarian_viewcontroller($data);
    }


    /**
    * Circulation list data loader
    * @access public
    * @return json
    */

    public function circulation_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'member_id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str = $sort." ".$order;

        // setting properties for search
        $book_id = trim($this->input->post('book_id', true));
        $member_name = trim($this->input->post('name', true));
        $book_title  = trim($this->input->post('book_title', true));
        $author      = trim($this->input->post("author", true));
        $return_status      = trim($this->input->post("return_status", true));

        $from_date = $this->input->post('from_date');
        if ($from_date != '') {
            $from_date = date('Y-m-d', strtotime($from_date));
        }

        $to_date = $this->input->post('to_date');
        if ($to_date != '') {
            $to_date = date('Y-m-d', strtotime($to_date));
        }

        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);

        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('circulation_data_book_id', $book_id);
            $this->session->set_userdata('circulation_data_name', $member_name);
            $this->session->set_userdata('circulation_data_book_title', $book_title);
            $this->session->set_userdata('circulation_data_author', $author);
            $this->session->set_userdata('circulation_data_from_date', $from_date);
            $this->session->set_userdata('circulation_data_to_date', $to_date);
            $this->session->set_userdata('circulation_data_status', $return_status);
        //  $this->session->set_userdata('book_list_category',$category_id);
        }

        // saving session data to different search parameter variables
        $search_book_id = $this->session->userdata('circulation_data_book_id');
        $search_member_name = $this->session->userdata('circulation_data_name');
        $search_book_title  = $this->session->userdata('circulation_data_book_title');
        $search_author = $this->session->userdata('circulation_data_author');
        $search_to_date = $this->session->userdata('circulation_data_to_date');
        $search_from_date = $this->session->userdata('circulation_data_from_date');
        $search_status = $this->session->userdata('circulation_data_status');
        //  $search_category=$this->session->userdata('book_list_category');

        // creating a blank where_simple array
        $where_simple = array();

        if ($search_status) {
            if ($search_status == 'returned') {
                $where_simple['is_returned'] = '1';
            }

            if ($search_status == 'expired_returned') {
                $where_simple['is_returned'] = '1';
                $where_simple['is_expired'] = '1';
            }

            if ($search_status == 'expired_not_returned') {
                $where_simple['is_returned'] = '0';
                $where_simple['is_expired'] = '1';
            }
        }

        // trimming data
        if ($search_book_id) {
            $where_simple['book_id'] = $search_book_id;
        }
        if ($search_member_name) {
            $where_simple['member.name like'] = "%".$search_member_name."%";
        }
        if ($search_book_title) {
            $where_simple['book_info.title like'] = "%".$search_book_title."%";
        }
        if ($search_author) {
            $where_simple['book_info.author like']    = "%".$search_author."%";
        }
        if ($search_from_date != '') {
            $where_simple['circulation.issue_date >='] = $search_from_date;
        }
        if ($search_to_date != '') {
            $where_simple['circulation.issue_date <='] = $search_to_date;
        }


        $where  = array('where' => $where_simple);
        $offset = ($page-1)*$rows;
        $result = array();

        $join = array(
            "member" => "member.member_idd = circulation.member_id,left",
            "book_info" => "book_info.id = circulation.book_id,left"
            );


        $table = 'circulation';

        $info = $this->basic->get_data($table, $where, $select='', $join, $limit = $rows, $start = $offset, $order_by = $order_by_str);

        $total_rows_array = $this->basic->count_row($table, $where, $count="circulation.id", $join);
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }

    /**
    * Start new circulation (form loader)
    * @access public
    * @return void
    */
    public function add_circulation()
    {
        $data['body'] = 'librarian/add_circulation';
        $data['page_title'] = 'Add Circulation Data';
        $this->_librarian_viewcontroller($data);
    }



    /**
    * New circulation action
    * @access public
    * @return void
    */
    public function add_circulation_action()
    {
        $data['body'] = 'librarian/add_circulation';

        $this->session->set_userdata("srarch_member_id", $this->input->post('member_id'));
        $member_id = $this->session->userdata("srarch_member_id");


        $table = 'member';
        $where_issue_limit['where'] = array('member_idd' => $member_id);
        $join = array('circulation_config' => "member.type_id=circulation_config.member_type_id,left");
        if ($this->basic->get_data($table, $where_issue_limit, $select = '', $join)) {
            $info_issue = $this->basic->get_data($table, $where_issue_limit, $select = '', $join);
            $fine_per_day = $info_issue[0]['fine_per_day'];
            $book_limit = $info_issue[0]['issu_book_limit'];
            $member_name = $info_issue[0]['name'];

            $data['fine_per_day'] = $fine_per_day;
            $data['book_limit'] = $book_limit;
            $data['member_name'] = $member_name;
        } else {
            $member_exist = array();
            $data['member_exist'] = $member_exist;
        }


        $table = 'member';
        $where['where'] = array('member_idd' => $member_id);
        if ($this->basic->get_data($table, $where)) {
            $table = 'circulation';
            $where = array();
            $where['where'] = array('member_id' => $member_id, 'is_returned' => 0);
            $join = array('book_info'=>'book_info.id = circulation.book_id,left');
            $select = array("*",'circulation.id as circulation_id');
            $info = $this->basic->get_data($table, $where,$select,$join);

            // echo $this->db->last_query(); exit();

            $data['info'] = $info;
            $member_exist = array('exist');
            $data['member_exist'] = $member_exist;
            $data['row'] = count($data['info']);
        } else {
            $member_exist = array();
            $data['member_exist'] = $member_exist;
        }
        $this->_librarian_viewcontroller($data);
    }


    /**
    * New issue action
    * @access public
    * @return void
    */
    public function new_issue_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $book_id = $this->input->post("book_id", true);
        $member_id = $this->session->userdata("srarch_member_id");

        //section check for availability of this book.

        $table_avl_check = 'circulation';
        $where_avl_check['where'] = array('book_id' => $book_id, 'is_returned' => '0');

        $where_present_check['where'] = array('book_id' => $book_id);

        if ($this->basic->get_data($table_avl_check, $where_present_check)) {
            if ($this->basic->get_data($table_avl_check, $where_avl_check)) {
                echo 'unavail';
                exit();
            }
        }
        //end of section check for availability of this book.

        //Secction:(A) for finding the issue day limit for a specific member.

        $table = 'member';
        $where['where'] = array('member_idd' => $member_id);
        $join = array('circulation_config' => "member.type_id=circulation_config.member_type_id,left");
        $info_issue = $this->basic->get_data($table, $where, $select = '', $join);

        // by mostofa 09/03/2017
        $member_email = $info_issue[0]['email'];
        $member_name = $info_issue[0]['name'];
        // end

        $day_limit = $info_issue[0]['issue_day_limit'];
        $book_limit = $info_issue[0]['issu_book_limit'];

        //get total issued book of this user.
        $select = array('count(id) as total_issued');
        $where['where'] = array('member_id' => $member_id, 'is_returned' => '0');
        $total_issued_book_info = $this->basic->get_data('circulation', $where, $select);

        $member_issued_book = $total_issued_book_info[0]['total_issued'];
        if ($book_limit != 0) {
            if ($book_limit <= $member_issued_book) {
                echo '0';
                exit();
            }
        }

        //End of Section(A).


        //Section(C) for updating book_info Table(In case of Issueing a book).

        $where = array('id' => $book_id);
        $data = array('status' => '0');
        $this->basic->update_data('book_info', $where, $data);

        //End of Section(c).


        //Section:(B) for for inserting new issue in the circulation table.

        $table_insert = 'circulation';
        $issue_date = date("Y-m-d");
        $expire_date = date('Y-m-d', strtotime($issue_date." +$day_limit day"));

        $data = array(
            'member_id' => $member_id,
            'book_id' => $book_id,
            'issue_date' => $issue_date,
            'expire_date' => $expire_date,
            'is_returned' => 0
            );
        if ($this->basic->insert_data($table_insert, $data)) {
            $circulation_id = $this->db->insert_id();
            $join = array('book_info'=>'book_info.id = circulation.book_id,left');
            $where['where'] = array('member_id' => $member_id, 'circulation.id' => $circulation_id);
            $new_issue = $this->basic->get_data($table_insert, $where,$select='',$join);
            $new_issue = $new_issue[0];

            echo "<tr id = 'tr_{$new_issue['id']}' class = 'display_row'>
            <td>{$new_issue['book_id']}</td>
            <td>{$new_issue['title']}</td>
            <td>{$new_issue['author']}</td>
            <td>{$new_issue['issue_date']}</td>
            <td>{$new_issue['expire_date']}</td>
            <td>{$new_issue['fine_amount']}</td>
            <td><a id='return_{$circulation_id}' class='btn btn-warning return'><i class='fa fa-reply'></i> ".$this->lang->line("return")."</a></td>

            </tr>";
            // by mostofa 09/03/2017
            $str_subject = "Book issue notification";
            $message = "Hello ".$member_name.",<br/><br/>You have been issued the book '".$new_issue['title']."' by ".$new_issue['author']." at ".$new_issue['issue_date']."<br/><br/>Details :";

            $message .= '<br/><br/><table border="1" style="border-collapse:collapse;">
                                <th bgcolor="#fafafa" style="padding:5px">Title</th>
                                <th bgcolor="#fafafa" style="padding:5px">Author</th>
                                <th bgcolor="#fafafa" style="padding:5px">Issue Date</th>
                                <th bgcolor="#fafafa" style="padding:5px">Expire Date</th>';
            $message .= '<tr>
                            <td style="padding:5px">'.$new_issue['title'].'</td>
                            <td style="padding:5px">'.$new_issue['author'].'</td>
                            <td style="padding:5px">'.$new_issue['issue_date'].'</td>
                            <td style="padding:5px">'.$new_issue['expire_date'].'</td>
                        </tr>';
            $message .= "</table><br/><br/>Thanks for using our service.<br/><b>".$this->config->item('product_name')." Team </b>";

            $from = $this->config->item('institute_email');
            $to = $member_email;
            $subject = $this->config->item('product_name')." | ".$str_subject;
            $mask = $this->config->item('product_name');
            $html = 1;
            $this->_mail_sender($from, $to, $subject, $message, $mask, $html, $smtp=1);



        } else {
            echo "failed";
        }

        //End of section(B);

    }

    /**
    * Issue checking
    * @access public
    * @return string
    */
    public function new_issue_check()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $book_id = $this->input->post('book_id', true);

        $table = 'book_info';
        $where['where'] = array('id' => $book_id);
        if ($this->basic->get_data($table, $where)) {
            $check_info = $this->basic->get_data($table, $where);
            $check_info = $check_info[0];
            $cover = site_url('upload/cover_images').'/'.$check_info['cover'];
        } else {
            $cover = 'wrong_id';
        }
        echo $cover;
    }



    /**
    * Recalculate fine (return book)
    * @access public
    * @return void
    */
    public function update_circulation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $table = 'circulation';
        $id = $this->input->post('id', true);
        $expire_flag = '0';


        //Section:(A) for get Member ID and Expire Date.
        // by mostofa 09/03/2017
        $get_where['where'] = array('id' => $id);
        $info = $this->basic->get_data($table, $get_where);

        $return_date = date("Y-m-d");
        $expire_date = $info[0]['expire_date'];
        $member_id =  $info[0]['member_id'];
        // by mostofa 09/03/2017
        $book_id = $info[0]['book_id'];
        //End of Section:(A).


        //Section:(B) for getting  fine_per_day.
        $table = 'member';
        $where_issue_limit['where'] = array('member_idd' => $member_id);
        $join = array('circulation_config' => "member.type_id=circulation_config.member_type_id,left");
        $info_issue = $this->basic->get_data($table, $where_issue_limit, $select = '', $join);
        $fine_per_day = $info_issue[0]['fine_per_day'];

        // by mostofa 09/03/2017
        $member_email = $info_issue[0]['email'];
        $member_name = $info_issue[0]['name'];
        // end

        //End of Section:(B).

        //Section:(C) for calculating 2 date differecne and fine.


        if (strtotime($return_date) > strtotime($expire_date)) {
            $diff = abs(strtotime($return_date) - strtotime($expire_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $fine_amount = $fine_per_day * $days;
            $expire_flag = '1';
        } else {
            $fine_amount = 0;
            $fine_per_day =0;
        }

        //End of Section:(C)

        $table = 'circulation';
        $where = array('id' => $id);
        $data = array(
            'is_returned'=>1,
            'fine_amount'=>$fine_amount,
            'return_date'=>$return_date,
            'is_expired'=>$expire_flag
            );
        $this->basic->update_data($table, $where, $data);

        //Section(D) for updating book_info Table(In case of returning a book).
        // by mostofa 09/03/2017
        $where = array('id' => $book_id);
        $data = array('status' => '1');
        $this->basic->update_data('book_info', $where, $data);
        
        //End of Section(D).

        // by mostofa 09/03/2017
        $where = array();
        $table_insert = "circulation";
        $join = array('book_info'=>'book_info.id = circulation.book_id,left');
        $where['where'] = array('member_id' => $member_id, 'circulation.id' => $id);
        $new_issue = $this->basic->get_data($table_insert, $where,$select='',$join);
        $new_issue = $new_issue[0];

        $str_subject = "Book return notification";
        $message = "Hello ".$member_name.",<br/><br/>You have just returned the book '".$new_issue['title']."' by ".$new_issue['author']." at ".$new_issue['return_date']."<br/><br/>Details :";

        $message .= '<br/><br/><table border="1" style="border-collapse:collapse;">
                            <th bgcolor="#fafafa" style="padding:5px">Title</th>
                            <th bgcolor="#fafafa" style="padding:5px">Author</th>
                            <th bgcolor="#fafafa" style="padding:5px">Issue Date</th>
                            <th bgcolor="#fafafa" style="padding:5px">Expire Date</th>
                            <th bgcolor="#fafafa" style="padding:5px">Return Date</th>
                            <th bgcolor="#fafafa" style="padding:5px">Fine Amount</th>';
        $message .= '<tr>
                        <td style="padding:5px">'.$new_issue['title'].'</td>
                        <td style="padding:5px">'.$new_issue['author'].'</td>
                        <td style="padding:5px">'.$new_issue['issue_date'].'</td>
                        <td style="padding:5px">'.$new_issue['expire_date'].'</td>
                        <td style="padding:5px">'.$new_issue['return_date'].'</td>
                        <td style="padding:5px">'.$new_issue['fine_amount'].'</td>
                    </tr>';
        $message .= "</table><br/><br/>Thanks for using our service.<br/><b>".$this->config->item('product_name')." Team </b>";

        $from = $this->config->item('institute_email');
        $to = $member_email;
        $subject = $this->config->item('product_name')." | ".$str_subject;
        $mask = $this->config->item('product_name');
        $html = 1;
        $this->_mail_sender($from, $to, $subject, $message, $mask, $html);

    }


    /**
    * Book list loader
    * @access public
    * @return void
    */
    public function book_list()
    {
        $data['category_info'] = $this->get_book_category();
        $data['body']='librarian/book_list.php';
        $data['page_title'] = 'Book List';
        $this->_librarian_viewcontroller($data);
    }

    /**
    * Book list data loader
    * @access public
    * @return json
    */
    public function book_list_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }
        // setting variables for pagination
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'title';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str = $sort." ".$order;

        // setting properties for search
        $isbn = trim($this->input->post('isbn', true));
        $book_id = trim($this->input->post('book_id', true));
        $title = trim($this->input->post('title', true));
        $author = trim($this->input->post("author", true));
        $category = trim($this->input->post('category_id', true));
        $from_date = $this->input->post('from_date', true);
        if($from_date != '')
            $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = $this->input->post('to_date', true);
        if($to_date != '')
            $to_date = date('Y-m-d', strtotime($to_date));


        // setting a new properties for $is_searched to set session if search occured
        $is_searched= $this->input->post('is_searched', true);


        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('book_list_isbn', $isbn);
            $this->session->set_userdata('book_list_book_id', $book_id);
            $this->session->set_userdata('book_list_title', $title);
            $this->session->set_userdata('book_list_author', $author);
            $this->session->set_userdata('book_list_category', $category);
            $this->session->set_userdata('book_list_from_date', $from_date);
            $this->session->set_userdata('book_list_to_date', $to_date);
        }
        // saving session data to different search parameter variables
        $search_isbn = $this->session->userdata('book_list_isbn');
        $search_book_id = $this->session->userdata('book_list_book_id');
        $search_title = $this->session->userdata('book_list_title');
        $search_author = $this->session->userdata('book_list_author');
        $search_category = $this->session->userdata('book_list_category');
        $search_from_date = $this->session->userdata('book_list_from_date');
        $search_to_date = $this->session->userdata('book_list_to_date');

        // creating a blank where_simple array
        $where_simple = array();

        // trimming data
        if ($search_isbn) {
            $where_simple['isbn like '] = "%".$search_isbn."%";
        }
        if ($search_book_id) {
            $where_simple['id'] = $search_book_id;
        }
        // if($search_book_id) $where_simple['id like ']= "%".$search_book_id."%";
        if ($search_title) {
            $where_simple['title like '] = "%".$search_title."%";
        }
        if ($search_author) {
            $where_simple['author like '] = "%".$search_author."%";
        }

        if ($search_from_date != '') {
            $where_simple["Date_Format(add_date,'%Y-%m-%d') >="] = $search_from_date;
        }
        if ($search_to_date != '') {
            $where_simple["Date_Format(add_date,'%Y-%m-%d') <="] = $search_to_date;
        }

        // FIND_IN_SET is used to find one single value from many values. here multiple category exists
        if ($search_category) {
            $this->db->where("FIND_IN_SET('$search_category',category_id) !=", 0);
        }

        $where_simple['deleted'] = "0";
        $where = array('where' => $where_simple);
        $offset = ($page-1)*$rows;
        $result = array();

        $table = "book_info";
        $info = $this->basic->get_data($table, $where, $select = '', $join='', $limit = $rows, $start = $offset, $order_by = $order_by_str);

        $total_rows_array = $this->basic->count_row($table, $where, $count = "id");
        $total_result = $total_rows_array[0]['total_rows'];



        echo convert_to_grid_data($info, $total_result);


    }

    /**
    * Book profile
    * @access public
    * @return void
    * @param int
    */
    public function view_details($id = 0)
    {
        $data["body"] = "librarian/view_details.php";

        $table = "book_info";
        $where['where'] = array('book_info.id' => $id);
        $result = $this->basic->get_data($table, $where, $select = '', $join = '', $limit = "", $start = "", $order_by = "");

        $result1 = $this->basic->get_data("category", $where = "", $select = '', $join = '', $limit = '', $start = null, $order_by = '');

        $cat_string = $result[0]['category_id'];    // extracting category id from data array
        $temp = explode(",", $cat_string);            // creating array from a string through explode function

        $data['info'] = $result;

        $data['all_category'] = $result1;
        $data['page_title'] = "Book Details";

        $data['existing_category'] = $temp;
        $this->_librarian_viewcontroller($data);
    }


    /**
    * Update book form
    * @access public
    * @return void
    * @param int
    */
    public function update_book($id = 0)
    {
        $data['body'] = "librarian/edit_book"; // setting view path
        $data['page_title'] = 'Edit Book';
        $table = 'book_info';
        $table2 = 'category';

        $where_simple = array("book_info.id" => $id);
        $where = array('where' => $where_simple);

        // pulling data from book_info table
        $result = $this->basic->get_data($table, $where);

        $cat_string = $result[0]['category_id'];    // extracting category id from data array
        $temp = explode(",", $cat_string);            // creating array from a string through explode function

        $data['info'] = $result[0];                    // setting data form view

        // calling some methods to show enum value.
        $data['size_all'] = $this->get_book_size();
        // $data['status_all'] = $this->get_book_status();
        $data['all_physical_form'] = $this->get_physical_form();
        $data['all_source_details'] = $this->get_book_source_details();

        $data['existing_category'] = $temp; // setting data array of existing_category to

        $id = null;
        $table3 = 'category';

        $result3 = $this->basic->get_data($table3, $where3 = '', $select = '', $join = '', $limit = '', $start = null, $order_by = '');

        $data['all_category'] = $result3;


        $this->_librarian_viewcontroller($data);
    }


    /**
    * Update book action
    * @access public
    * @return void
    * @param int
    */
    public function update_book_action($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        if ($_POST) {
            
            $this->form_validation->set_rules('author',                '<b>'.$this->lang->line("author").'</b>',              'trim|required');
            $this->form_validation->set_rules('title',                 '<b>'.$this->lang->line("title").'</b>',               'trim|required');
            $this->form_validation->set_rules('edition',               '<b>'.$this->lang->line("edition").'</b>',             'trim|required');
            $this->form_validation->set_rules('isbn',                  '<b>'.$this->lang->line("ISBN").'</b>',                'trim');
            $this->form_validation->set_rules('subtitle',              '<b>'.$this->lang->line("subtitle").'</b>',            'trim');
            $this->form_validation->set_rules('edition_year',          '<b>'.$this->lang->line("edition year").'</b>',        'trim|integer|exact_length[4]');
            $this->form_validation->set_rules('physical_form',         '<b>'.$this->lang->line("physical form").'</b>',       'trim');
            $this->form_validation->set_rules('publisher',             '<b>'.$this->lang->line("publisher").'</b>',           'trim');
            $this->form_validation->set_rules('series',                '<b>'.$this->lang->line("series").'</b>',              'trim');
            $this->form_validation->set_rules('size1',                 '<b>'.$this->lang->line("size").'</b>',                'trim');
            $this->form_validation->set_rules('price',                 '<b>'.$this->lang->line("price").'</b>',               'trim');
            $this->form_validation->set_rules('call_no',               '<b>'.$this->lang->line("call no").'</b>',             'trim');
            $this->form_validation->set_rules('location',              '<b>'.$this->lang->line("location").'</b>',            'trim');
            $this->form_validation->set_rules('clue_page',             '<b>'.$this->lang->line("clue page").'</b>',           'trim');
            $this->form_validation->set_rules('editor',                '<b>'.$this->lang->line("editor").'</b>',              'trim');
            $this->form_validation->set_rules('publishing_year',       '<b>'.$this->lang->line("publication year").'</b>',    'trim|integer|exact_length[4]');
            $this->form_validation->set_rules('publication_place',     '<b>'.$this->lang->line("publication place").'</b>',   'trim');
            $this->form_validation->set_rules('number_of_pages',       '<b>'.$this->lang->line("total pages").'</b>',         'trim');
            $this->form_validation->set_rules('source_details',        '<b>'.$this->lang->line("source").'</b>',              'trim');
            $this->form_validation->set_rules('notes',                 '<b>'.$this->lang->line("notes").'>/b>',               'trim');
            $this->form_validation->set_rules('link',                 '<b>'.$this->lang->line("link").'>/b>',               'trim');


            if ($this->form_validation->run() == false) {
                return $this->update_book($id);
            } else {
                // $single_group = $this->input->post('single_group', true);
                $temp = $this->input->post('cat', true);
                $category = '';
                if ($temp) {
                    $category = implode($temp, ',');
                }

            //  $accession_no =     $this->input->post('accession_no');
                $physical_form        =     strip_tags($this->input->post('physical_form', true));
                $author               =     strip_tags($this->input->post('author', true));
                $subtitle             =     strip_tags($this->input->post('subtitle', true));
                $edition_year         =     strip_tags($this->input->post('edition_year', true));
                $publisher            =     strip_tags($this->input->post('publisher', true));
                $series               =     strip_tags($this->input->post('series', true));
                $size1                =     strip_tags($this->input->post('size1', true));
                $price                =     strip_tags($this->input->post('price', true));
                $call_no              =     strip_tags($this->input->post('call_no', true));
                $location             =     strip_tags($this->input->post('location', true));
                $clue_page            =     strip_tags($this->input->post('clue_page', true));
                $editor               =     strip_tags($this->input->post('editor', true));
                $title                =     strip_tags($this->input->post('title', true));
                $edition              =     strip_tags($this->input->post('edition', true));
                $publishing_year      =     strip_tags($this->input->post('publishing_year', true));
                $publication_place    =     strip_tags($this->input->post('publication_place', true));
                $number_of_pages      =     strip_tags($this->input->post('number_of_pages', true));
                // $dues                =   $this->input->post('dues', true);
                $isbn                 =     strip_tags($this->input->post('isbn', true));
                $source_details       =     strip_tags($this->input->post('source_details', true));
                $notes                =     strip_tags($this->input->post('notes', true));
                $add_date             =     date("Y-m-d G:i:s"); //   $this->input->post('add_date');
                $status               =     strip_tags($this->input->post('status', true));
                $link =     strip_tags($this->input->post('link', true));


                $pdf = '';
                $not_pdf_but_link_uploaded = '';
                if($link != ''){
                    $not_pdf_but_link_uploaded = '0';
                    $pdf = $link;
                }
                else {
                    if ($_FILES['pdf']['size'] != 0) {
                        $ext=trim(array_pop(explode('.',$_FILES['pdf']['name'])));
                        if($ext=="pdf" || $ext=="epub")
                        {
                            $space_stripped_file_name = time().'.'.$ext;
                            $config1['upload_path'] = $this->upload_path.'/e_books/';
                            $config1['allowed_types'] = '*';
                            $config1['file_name'] = $space_stripped_file_name;
                            $config1['overwrite'] = true;
                            $this->upload->initialize($config1);
                            $this->load->library('upload', $config1);
                            $is_uploaded = 1;

                            if ($_FILES['pdf']['size'] != 0 && !$this->upload->do_upload("pdf")) {
                                //if any photo selected and if photo upload error occurs then reload form and show upload error
                                $is_uploaded=0;
                                $error = $this->upload->display_errors();
                                $this->session->set_userdata('pdf_error', $error);
                                return $this->update_book($id);
                                // redirect('','refresh')
                            }
                            if ($is_uploaded == 1) {
                                $pdf = $space_stripped_file_name;
                            }
                        }
                    }
                }
                


                //  $deleted=$this->input->post('deleted');
                $image = "";
                if ($_FILES['photo']['size'] != 0) {
                    $ext=trim(array_pop(explode('.',$_FILES['photo']['name'])));
                    $space_stripped_image_name = time().'.'.$ext;
                    $config2['upload_path'] = './upload/cover_images/';
                    $config2['allowed_types'] = 'jpg|png|jpeg';
                    $config2['file_name']    = $space_stripped_image_name;
                    $config2['overwrite']    =  true;
                    $config2['max_size']    =  250;
                    $config2['max_width']    =  600;
                    $config2['max_height']    =  1000;

                    $this->upload->initialize($config2);
                    $this->load->library('upload', $config2);


                    $is_uploaded = 1;
                    if ($_FILES['photo']['size'] != 0 && !$this->upload->do_upload("photo")) {
                        //if any photo selected and if photo upload error occurs then reload form and show upload error
                        $is_uploaded = 0;
                        $error = $this->upload->display_errors();
                        $this->session->set_userdata('photo_error', $error);
                        return $this->update_book($id);
                    }

                    if ($_FILES['photo']['size'] == 0) {
                        $image = 'cover_default'.'.jpg';
                        $is_uploaded = 0;
                    }

                    if ($is_uploaded == 1) {
                        // forming image name
                        $image = $space_stripped_image_name;
                    }
                }


                $data = array(
                //  'accession_no' => $accession_no,
                    'physical_form'  => $physical_form,
                    'author'  => $author,
                    'subtitle'  => $subtitle,
                    'edition_year'  => $edition_year,
                    'publisher'  => $publisher,
                    'series'  => $series,
                    'size1'  => $size1,
                    'price'  => $price,
                    'call_no'  => $call_no,
                    'location'  => $location,
                    'clue_page'  => $clue_page,
                    'editor'  => $editor,
                    'title'  => $title,
                    'edition'  => $edition,
                    'publishing_year'  => $publishing_year,
                    'publication_place'  => $publication_place,
                    'number_of_pages'  => $number_of_pages,
                    // 'dues'  => $dues,
                    'isbn'  => $isbn,
                    'source_details'  => $source_details,
                    'notes'  => $notes,
                    'add_date'  => $add_date,
                    'status'  => $status,
                    );

                if ($image != '') {
                    $data['cover']=$image;
                }
                if ($pdf != '') {
                    $data['pdf']=$pdf;
                }
                if ($category != '') {
                    $data['category_id'] = $category;
                }

                if ($not_pdf_but_link_uploaded != '') {
                    $data['is_uploaded'] = $not_pdf_but_link_uploaded;
                } else {
                    $data['is_uploaded'] = '1';
                }

                //if($image!="") $data['cover']=$image;
                if ($image) {
                    //creating thumbnail
                    $config3 = array();
                    $config3['image_library'] = 'gd2';
                    $config3['source_image'] = $this->upload_path.'/cover_images/'.$image;
                    $config3['create_thumb'] =  true;
                    $config3['new_image'] = $this->upload_path.'/cover_images/thumbnail_cover_images/';
                    $config3['width'] = 160;
                    $config3['height'] = 210;
                    $this->image_lib->initialize($config3);
                    $this->load->library('upload', $config3);
                    $this->image_lib->resize();

                    $rename_image = explode(".", $image);
                    $old_image_file = $this->upload_path.'/cover_images/thumbnail_cover_images/'.$rename_image[0].'_thumb.jpg';
                    $new_image_file = $this->upload_path.'/cover_images/thumbnail_cover_images/'.$image;
                    rename($old_image_file, $new_image_file);
                }


                if (!empty($data)) {
                    // echo "has data"; exit();
                    $group_info = $this->basic->get_data('book_info', $where=array('where'=>array('id'=>$id)));
                    $title = $group_info[0]['title'];
                    $author = $group_info[0]['author'];
                    $edition = $group_info[0]['edition'];
                    $where_update = array('title'=>$title,'author'=>$author,'edition'=>$edition);
                    $this->basic->update_data("book_info", $where_update, $data);
                    $this->session->set_flashdata('success_message', 1);
                    redirect('librarian/book_list', 'location');
                } else {
                    // echo 'has_no_data'; exit();
                    $this->session->set_flashdata("error_message", 1);
                    redirect('librarian/update_book/'.$id, 'location');
                }
            }
        }
    }



    /**
    * Delete book
    * @access public
    * @return void
    * @param int
    */
    public function delete_book_action($id=0)
    {
        $where_simple = array("book_info.id"=>$id);
        $where = array('where'=> $where_simple);
        $deleted = "1";  // binary values are considered string here


        // creating array of data
        $data = array( "deleted" => $deleted );

        // data insert and update both will be performed by $update_data function from basic model
        if (isset($data)) {
            $this->basic->update_data($table="book_info", $where=array("id" => $id), $update_data = $data);
            $this->session->set_flashdata('delete_success_message', 1);
            redirect('librarian/book_list', 'location');
        }
    }


    /**
    * Add book form
    * @access public
    * @return void
    */
    public function add_book()
    {
        $data['body'] = "librarian/add_book";
        $data['page_title'] = 'Add Book';
        $table = 'book_info';
        $table2 = 'category';

        $result = $this->basic->get_data($table, $where='', $select='', $join='', $limit='', $start=null, $order_by='');
        $result2 = $this->basic->get_data($table2, $where='');

        $data['info'] = $result;
        $data['info2'] = $result2;
        $data['size_all'] = $this->get_book_size();

        // $data['status_all']=$this->get_book_status();
        $data['all_physical_form']=$this->get_physical_form();
        $data['all_source_details']=$this->get_book_source_details();

        $this->_librarian_viewcontroller($data);
    }


    /**
    * Add book action
    * @access public
    * @return void
    */
    public function add_book_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        if ($_POST) {
            $this->form_validation->set_rules('author',                '<b>'.$this->lang->line("author").'</b>',              'trim|required');
            $this->form_validation->set_rules('title',                 '<b>'.$this->lang->line("title").'</b>',               'trim|required');
            $this->form_validation->set_rules('edition',               '<b>'.$this->lang->line("edition").'</b>',             'trim|required');
            $this->form_validation->set_rules('number_of_books',       '<b>'.$this->lang->line("number of copies").'</b>',    'trim|required|integer');
            $this->form_validation->set_rules('isbn',                  '<b>'.$this->lang->line("ISBN").'</b>',                'trim');
            $this->form_validation->set_rules('subtitle',              '<b>'.$this->lang->line("subtitle").'</b>',            'trim');
            $this->form_validation->set_rules('edition_year',          '<b>'.$this->lang->line("edition year").'</b>',        'trim|integer|exact_length[4]');
            $this->form_validation->set_rules('physical_form',         '<b>'.$this->lang->line("physical form").'</b>',       'trim');
            $this->form_validation->set_rules('publisher',             '<b>'.$this->lang->line("publisher").'</b>',           'trim');
            $this->form_validation->set_rules('series',                '<b>'.$this->lang->line("series").'</b>',              'trim');
            $this->form_validation->set_rules('size1',                 '<b>'.$this->lang->line("size").'</b>',                'trim');
            $this->form_validation->set_rules('price',                 '<b>'.$this->lang->line("price").'</b>',               'trim');
            $this->form_validation->set_rules('call_no',               '<b>'.$this->lang->line("call no").'</b>',             'trim');
            $this->form_validation->set_rules('location',              '<b>'.$this->lang->line("location").'</b>',            'trim');
            $this->form_validation->set_rules('clue_page',             '<b>'.$this->lang->line("clue page").'</b>',           'trim');
            $this->form_validation->set_rules('editor',                '<b>'.$this->lang->line("editor").'</b>',              'trim');
            $this->form_validation->set_rules('publishing_year',       '<b>'.$this->lang->line("publication year").'</b>',    'trim|integer|exact_length[4]');
            $this->form_validation->set_rules('publication_place',     '<b>'.$this->lang->line("publication place").'</b>',   'trim');
            $this->form_validation->set_rules('number_of_pages',       '<b>'.$this->lang->line("total pages").'</b>',         'trim');
            $this->form_validation->set_rules('source_details',        '<b>'.$this->lang->line("source").'</b>',              'trim');
            $this->form_validation->set_rules('notes',                 '<b>'.$this->lang->line("notes").'>/b>',               'trim');
            $this->form_validation->set_rules('link',                 '<b>'.$this->lang->line("link").'>/b>',               'trim');



            if ($this->form_validation->run() == false) {
                return $this->add_book();
            }
            else
            {
                $temp = $this->input->post('cat', true);
                $category = '';
                if ($temp) 
                {
                    $category = implode($temp, ',');
                }

            //  $accession_no =     $this->input->post('accession_no');
                $physical_form =        strip_tags($this->input->post('physical_form', true));
                $author=                strip_tags($this->input->post('author', true));
                $subtitle=              strip_tags($this->input->post('subtitle', true));
                $edition_year =         strip_tags($this->input->post('edition_year', true));
                $publisher=             strip_tags($this->input->post('publisher', true));
                $series =               strip_tags($this->input->post('series', true));
                $size1 =                strip_tags($this->input->post('size1', true));
                $price=                 strip_tags($this->input->post('price', true));
                $call_no =              strip_tags($this->input->post('call_no', true));
                $location=              strip_tags($this->input->post('location', true));
                $clue_page=             strip_tags($this->input->post('clue_page', true));
                $editor =               strip_tags($this->input->post('editor', true));
                $title=                 strip_tags($this->input->post('title', true));
                $edition =              strip_tags($this->input->post('edition', true));
                $publishing_year=       strip_tags($this->input->post('publishing_year', true));
                $publication_place=     strip_tags($this->input->post('publication_place', true));
                $number_of_pages=       strip_tags($this->input->post('number_of_pages', true));
                $number_of_books =      strip_tags($this->input->post('number_of_books', true));
                // $dues =      $this->input->post('dues', true);
                $isbn =                 strip_tags($this->input->post('isbn', true));
                $source_details =       strip_tags($this->input->post('source_details', true));
                $notes =                strip_tags($this->input->post('notes', true));
                $link =     strip_tags($this->input->post('link', true));
                //  $cover =        $this->input->post('cover');
                $add_date=  date("Y-m-d G:i:s"); // $this->input->post('add_date');

                $pdf = '';
                $not_pdf_but_link_uploaded = '';
                if($link != ''){
                    $not_pdf_but_link_uploaded = '0';
                    $pdf = $link;
                }
                else {
                    if ($_FILES['pdf']['size'] != 0) {
                        $ext=trim(array_pop(explode('.',$_FILES['pdf']['name'])));
                        if($ext=="pdf" || $ext=="epub")
                        {
                            $space_stripped_pdf_name = time().'.'.$ext;

                            $config1['upload_path'] = $this->upload_path.'/e_books/';
                            $config1['allowed_types'] = '*';
                            $config1['file_name']    = $space_stripped_pdf_name;
                            $config1['overwrite']    =  true;
                            $this->upload->initialize($config1);
                            $this->load->library('upload', $config1);
                            $is_uploaded=1;

                            if ($_FILES['pdf']['size'] != 0 && !$this->upload->do_upload("pdf")) {
                                //if any photo selected and if photo upload error occurs then reload form and show upload error
                                $is_uploaded=0;
                                $error = $this->upload->display_errors();
                                $this->session->set_userdata('pdf_error', $error);
                                return $this->add_book();
                                // redirect('librarian/add_book','location');
                            }
                            if ($is_uploaded == 1) {
                                $pdf= $space_stripped_pdf_name;
                            }
                        }
                    }
                }
                

            // photo upload
                $ext=trim(array_pop(explode('.',$_FILES['photo']['name'])));
                $space_stripped_image_name = time().'.'.$ext;

                $config2['upload_path'] = './upload/cover_images/';
                $config2['allowed_types'] = 'jpg|png|jpeg';
                $config2['file_name']    = $space_stripped_image_name;
                $config2['max_size']    =  1024;
                $config2['max_width']    =  1200;
                $config2['max_height']    =  2000;

                $this->upload->initialize($config2);
                $this->load->library('upload', $config2);

                $is_uploaded=1;

                if ($_FILES['photo']['size'] != 0 && !$this->upload->do_upload("photo")) {
                    //if any photo selected and if photo upload error occurs then reload form and show upload error
                    $is_uploaded=0;
                    $error = $this->upload->display_errors();
                    $this->session->set_userdata('photo_error', $error);
                    return $this->add_book();
                    // redirect('librarian/add_book','location');
                }
                $image="";
                if ($_FILES['photo']['size'] == 0) {
                    $image='cover_default'.'.jpg';
                    $is_uploaded=0;
                }

                if ($is_uploaded==1) {
                    // forming image name
                    $image=$space_stripped_image_name;
                }

            // photo upload ends

                if ($image) {
                    $config3['image_library'] = 'gd2';
                    $config3['source_image'] = $this->upload_path.'/cover_images/'.$image;
                    $config3['create_thumb'] =  true;
                    $config3['new_image'] = $this->upload_path.'/cover_images/thumbnail_cover_images/';
                    $config3['width'] = 160;
                    $config3['height'] = 210;
                    $this->image_lib->initialize($config3);
                    $this->load->library('upload', $config3);
                    $this->image_lib->resize();

                    $rename_image = explode(".", $image);
                    $old_image_file = $this->upload_path.'/cover_images/thumbnail_cover_images/'.$rename_image[0].'_thumb.jpg';
                    $new_image_file = $this->upload_path.'/cover_images/thumbnail_cover_images/'.$image;
                    rename($old_image_file, $new_image_file);
                }


                $data = array(
                    'physical_form'  => $physical_form,
                    'author'  => $author,
                    'subtitle'  => $subtitle,
                    'edition_year'  => $edition_year,
                    'publisher'  => $publisher,
                    'series'  => $series,
                    'size1'  => $size1,
                    'price'  => $price,
                    'call_no'  => $call_no,
                    'location'  => $location,
                    'clue_page'  => $clue_page,
                    'editor'  => $editor,
                    'title'  => $title,
                    'edition'  => $edition,
                    'publishing_year'  => $publishing_year,
                    'publication_place'  => $publication_place,
                    'number_of_pages'  => $number_of_pages,
                    'isbn'  => $isbn,
                    'source_details'  => $source_details,
                    'notes'  => $notes,
                    'add_date'  => $add_date,
                    'status' => '1'

                    );

                if ($image != '') {
                    $data['cover'] = $image;
                }
                if ($pdf != '') {
                    $data['pdf'] = $pdf;
                }
                if ($category != '') {
                    $data['category_id']  = $category;
                }
                if ($not_pdf_but_link_uploaded != '') {
                    $data['is_uploaded'] = $not_pdf_but_link_uploaded;
                } else {
                    $data['is_uploaded'] = '1';
                }

                $this->db->trans_start();
                $total_book = 0;
                $where_for_update_check['where'] = array(
                    'author'  => $author,
                    'title'  => $title,
                    'edition'  => $edition
                    );
                $exiting_info = $this->basic->get_data('book_info',$where_for_update_check,$select=array('number_of_books'));
                if ($exiting_info) {
                    $total_book = $exiting_info[0]['number_of_books'];
                    $total_book = $total_book + $number_of_books;
                    $update_where = array(
                        'author'  => $author,
                        'title'  => $title,
                        'edition'  => $edition
                        );
                    $update_data = array('number_of_books' => $total_book);
                    $this->basic->update_data('book_info',$update_where,$update_data);
                }

                if($total_book == 0)
                    $data['number_of_books'] = $number_of_books;
                else
                    $data['number_of_books'] = $total_book;


                $accession_no = array();
                $success = 0;
                if (!empty($data)) {
                    for ($i=0;$i<$number_of_books;$i++) {
                        $this->basic->insert_data('book_info', $data);
                        $accession_no[$i]['accession_no'] = $this->db->insert_id();
                    }
                    $success = 1;
                    $this->session->set_flashdata('success_message', 1);
                } else {
                    $this->session->set_flashdata("error_message", 1);
                    // return $this->add_book();
                    redirect('librarian/add_book', 'location');
                }

                $this->db->trans_complete();
                if($this->db->trans_status() === false) {
                    $this->session->set_flashdata("error_message", 1);
                    redirect('librarian/add_book', 'location');
                }


                if ($success == 1) {
                    $str = "";

                    $str .= "<div class='row' style='margin-top:27px;margin-left:20px;margin-right:20px;'>
                            <style>
                                @media print {
                                    div.page_break {page-break-after: always;}
                                }
                            </style>
                            <div class='col-xs-12'>
                    <link href='".base_url()."bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
                    <style>.btn{border-radius:0 !important;-moz-border-radius:0 !important;-webkit-border-radius:0 !important;}a{text-decoration:none !important;}</style>";
                    $i = 0;
                    foreach ($accession_no as $barcode) {
                        $src=base_url()."barcode.php?code=".$barcode['accession_no'];
                        $str .= "<div class='col-xs-6' style='padding:10px;'>
                        <div style='border:2px solid gray;height:230px;padding:10px;'>
                            <p><b>".$this->lang->line("title")." :</b>".$title."</p>
                            <p><b>".$this->lang->line("author")." :</b>".$author."</p>
                            <p><b>".$this->lang->line("edition")." :</b>".$edition."</p>
                            <p><b>".$this->lang->line("ISBN")." :</b>".$isbn."</p><br/>
                            <img src='".$src."' width='150px' height='35px' style='float:left;margin-top:0in;'/>
                        </div>
                    </div>";
                        $i++;
                        if ($i==8) {
                            $i=0;
                            $str .= "<div class='page_break'></div><br/><br/>";
                        }
                    }
                    $str .= "</div></div>";

                    $this->session->set_userdata('book_isbn_file_name', 1);
                    $data['book_ids'] = $str;
                    $data['category_info'] = $this->get_book_category();

                    $data['body']='librarian/book_list.php';
                    return $this->_librarian_viewcontroller($data);
                // redirect('librarian/book_list','location');
                }
            }
        }
    }


    /**
    * Reset password form
    * @access public
    * @return void
    */
    public function reset_password_form()
    {
        $data['page_title'] = 'Password Reset';
        $data['body'] = 'librarian/theme/password_reset_form';
        $this->_librarian_viewcontroller($data);
    }

    /**
    * Reset password action
    * @access public
    * @return void
    * @param int
    */
    public function reset_password_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $this->form_validation->set_rules('old_password', '<b>Old Password</b>', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_password', '<b>New Password</b>', 'trim|required|xss_clean');
        $this->form_validation->set_rules('confirm_new_password', '<b>Confirm New Password</b>', 'trim|required|xss_clean|matches[new_password]');
        if ($this->form_validation->run() == false) {
            $this->reset_password_form();
        } else {
            $user_id = $this->session->userdata('member_id');
            $password = $this->input->post('old_password', true);
            $new_password = $this->input->post('new_password', true);
            $table = 'member';
            $where['where'] = array(
            'id' => $user_id,
            'password' => md5($password)
            );
            $select = array('email');
            if ($this->basic->get_data($table, $where, $select)) {
                $where = array(
                'id' => $user_id,
                'password' => md5($password)
                );
                $data = array('password' => md5($new_password));
                $this->basic->update_data($table, $where, $data);
                $this->session->set_userdata('logged_in', 0);
                $this->session->set_flashdata('reset_success', 'Please login with new password');
                redirect('home/login', 'location');
                // echo $this->session->userdata('reset_success');exit();
            } else {
                $this->session->set_userdata('error', 'The old password you have given is wrong!');
                return $this->reset_password_form();
            }
        }
    }


    /**
    * Requested book list
    * @access public
    * @return void
    */
    public function requested_books()
    {
        $data['body'] = 'librarian/requested_books';
        $data['page_title'] = 'Requested Book';
        $this->_librarian_viewcontroller($data);
    }

    /**
    * Requested book data
    * @access public
    * @return json
    */
    public function requested_books_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }
            // setting variables for pagination
        $page = isset($_POST['page']) ? intval($_POST['page']) : 15;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'book_title';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str=$sort." ".$order;

            // setting properties for search
        $member_name = trim($this->input->post('name', true));
        $book_title  = trim($this->input->post('book_title', true));
        $author      = trim($this->input->post("author", true));
        $from_date = $this->input->post('from_date', true);
        if($from_date != '')
            $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = $this->input->post('to_date', true);
        if($to_date != '')
            $to_date = date('Y-m-d', strtotime($to_date));


            // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);


        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('requested_books_name',          $member_name);
            $this->session->set_userdata('requested_books_book_title',  $book_title);
            $this->session->set_userdata('requested_books_author',      $author);
            $this->session->set_userdata('requested_books_from_date',        $from_date);
            $this->session->set_userdata('requested_books_to_date',        $to_date);
            //  $this->session->set_userdata('book_list_category',$category_id);
        }

            // saving session data to different search parameter variables
        $search_member_name = $this->session->userdata('requested_books_name');
        $search_book_title  = $this->session->userdata('requested_books_book_title');
        $search_author      = $this->session->userdata('requested_books_author');
        $search_to_date      = $this->session->userdata('requested_books_to_date');
        $search_from_date      = $this->session->userdata('requested_books_from_date');
        //  $search_category=$this->session->userdata('book_list_category');

            // creating a blank where_simple array
        $where_simple=array();

            // trimming data
        if ($search_member_name) {
            $where_simple['member.name like '] = "%".$search_member_name."%";
        }
        if ($search_book_title) {
            $where_simple['request_book.book_title like '] = "%".$search_book_title."%";
        }
        if ($search_author) {
            $where_simple['request_book.author like ']    = "%".$search_author."%";
        }
        if ($search_from_date != '') {
            $where_simple['request_book.request_date >=']= $search_from_date;
        }
        if ($search_to_date != '') {
            $where_simple['request_book.request_date <=']=$search_to_date;
        }


        $where  = array('where'=>$where_simple);


        $offset = ($page-1)*$rows;
        $result = array();
        $select = array('request_book.id','member.name','request_book.book_title','request_book.author','request_book.request_date','request_book.edition','request_book.request_status');

        $table = "request_book";
        $join = array("member" => "member.member_idd = request_book.member_id,left");

        $info = $this->basic->get_data($table, $where, $select, $join, $limit=$rows, $start=$offset, $order_by=$order_by_str);



        $total_rows_array = $this->basic->count_row($table, $where, $count="request_book.id", $join);

        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }



    /**
    * Accept request
    * @access public
    * @return void
    */
    public function accept_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $req_id=$this->input->post('req_id', true);
        $table = 'request_book';
        $where = array('id'=>$req_id);
        $data = array('request_status'=>'Accepted','reply'=>'Thanks! for your request. We have accepted your request.');
        $this->basic->update_data($table, $where, $data);
    }

    /**
    * Reject request
    * @access public
    * @return void
    */
    public function reject_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $req_id=$this->input->post('req_id', true);
        $reject_reason=$this->input->post('reject_reason', true);


        $table = 'request_book';
        $where = array('id'=>$req_id);
        $data = array('request_status'=>'Rejected','reply'=>$reject_reason);
        $this->basic->update_data($table, $where, $data);

        /***Send email to the member***/

        $where['where'] = array('request_book.id'=>$req_id);
        $join=array('member'=>'member.id=request_book.member_id,left');
        $info = $this->basic->get_data('request_book', $where, $select='', $join, $limit='', $start= '', $order_by='');

        $email=$info[0]['email'];
        $name=$info[0]['name'];
        $req_book_title=$info[0]['book_title'];



        $subject = 'Request for new book is rejected';
        $mask=$this->config->item('product_name');
        $from=$this->config->item('institute_email');

        $message="Dear {$name}, <br/> Your requested book for {$req_book_title} is rejected. <br/> Reason: {$reject_reason}.
        <br/> Thank You.";
        $this->_mail_sender($from, $email, $subject, $message, $mask);
    }


    /**
    * Request book status modifier
    * @access public
    * @return string
    */
    public function status_requested_books($value, $row)
    {
        if ($value=='Pending') {
            return "<span class='label label-warning'>Pending</sapn>";
        }

        if ($value=='Accepted') {
            return "<span class='label label-success'>Accepted</sapn>";
        }

        if ($value=='Rejected') {
            return "<span class='label label-danger'>Rejected</sapn>";
        }
    }


    /**
    * Requested book details
    * @access public
    * @return void
    */
    public function view_details_requested_books($id = 0)
    {
        $data["body"] = "librarian/view_details_requested_books.php";

        $table = "request_book";

        $where_simple = array("request_book.id"=> $id);
        $where = array('where'=> $where_simple);

        $result = $this->basic->get_data($table, $where, $select='');

        $data['info'] = $result;

        $this->_librarian_viewcontroller($data);
    }

    /**
    * update_requested_book
    * @access public
    * @return void
    */
    public function update_requested_book($id = 0)
    {
        $data['body'] = 'librarian/update_requested_book';
        $data['page_title'] = 'Update Requested Book';

        $table = "request_book";

        $where['where']=array('request_book.id'=> $id);
        $result = $this->basic->get_data($table, $where, $select='');

        $data['info'] = $result;
        $this->_librarian_viewcontroller($data);
    }


    /**
    * Auto complete member
    * @access public
    * @return string
    */
    public function get_suggestion_for_member()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $member_name = $this->input->post('member_name', true);
        if ($member_name != '') {
            $where_member['or_where'] = array('name like '=> '%'.$member_name.'%','member_idd like' => $member_name.'%');
            $where_member['where'] = array('type_id !=' => 0);

            $select_member = array('member_idd','name');
            $results = $this->basic->get_data('member', $where_member, $select_member, $join = '', $limit = 20);
            $str = "<table class='table table-hover'>";
            foreach ($results as $result) {
                $str .= "<tr class='member_name' member_id='".$result['member_idd']."'><td>".$result['name']." | ID- ".$result['member_idd']."</td></tr>";
            }
            $str .= "</table>";
            echo $str;
        } else {
            echo '';
        }
    }


    /**
    * Auto complete book
    * @access public
    * @return string
    */
    public function get_suggestion_for_book()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $book_name = $this->input->post('book_name', true);
        if ($book_name != '') {
            $where_book['or_where'] = array('title like '=> '%'.$book_name.'%','id like ' => $book_name.'%');
            $where_book['where'] = array('status' => '1');
            $select_book = array('id','title');
            $results = $this->basic->get_data('book_info', $where_book, $select_book, $join='', $limit=20);
            $str = "<table class='table table-hover'>";
            foreach ($results as $result) {
                $str .= "<tr class='book_name' book_id='".$result['id']."'><td>".$result['title']." | book id- ".$result['id']."</td></tr>";
            }
            $str .= "</table>";
            echo $str;
        } else {
            echo '';
        }
    }


    /**
    * Dashboard activities loader
    * @access public
    * @return void
    */
    public function dash_board()
    {
        //Start of Section(total_book): For calculation Total number of Books.
        $table_total_book = 'book_info';
        $where_total_book['where'] = array('deleted'=>'0');
        $info_total_book = $this->basic->get_data($table_total_book, $where_total_book);
        $data['num_of_book'] = count($info_total_book);

           //End of Section(total_book).

           //Start of Section(circulation): For calculation Total number of Issued Books.

        $table_circulation = 'circulation';
        $info_ciculation = $this->basic->get_data($table_circulation, $where_circulation='');
        $num_issue_book = count($info_ciculation);

            // echo "num_issue_book: ".$num_issue_book."<br/>";
        $data['num_issue_book'] = $num_issue_book;

           //End of Section(circulation).

           //Start of Section(num_member): For calculation Total number of Members.
        $table_num_member = 'member';
        $where_num_member = array('status'=>'1');
        $info_num_member = $this->basic->get_data($table_num_member, $where_num_member);
        $num_member = count($info_num_member);
            // echo "num_member: ".$num_member."<br/>";
        $data['num_member'] = $num_member;


           //End of Section(num_member).

           //Start of Section(add_book today).

        $table_add_book_today = 'book_info';
        $today_date = date('Y-m-d');
        $where_add_book_today['where'] = array('deleted'=>'0',"Date_Format(add_date,'%Y-%m-%d')"=>$today_date);
        $info_add_book_today = $this->basic->get_data($table_add_book_today, $where_add_book_today);
        $num_add_book_today = count($info_add_book_today);
            // echo "num_add_book_today: ".$num_add_book_today."<br/>";
        $data['num_add_book_today'] = $num_add_book_today;
           //End of Section(add_book today).



           //Start Section(today_issue & today_return).
        $table_today_issue_return = 'circulation';
        $where_today_issue['where'] = array('issue_date'=>$today_date);
        $where_today_return['where'] = array('return_date'=>$today_date);

        $info_today_issue = $this->basic->get_data($table_today_issue_return, $where_today_issue);
        $info_today_return = $this->basic->get_data($table_today_issue_return, $where_today_return);

        $num_today_issue_book = count($info_today_issue);
            // echo "num_today_issue_book: ".$num_today_issue_book."<br/>";
        $data['num_today_issue_book'] = $num_today_issue_book;


        $num_today_return_book = count($info_today_return);
            // echo "num_today_return_book: ".$num_today_return_book."<br/>";
        $data['num_today_return_book'] = $num_today_return_book;
           //End Section(today_issue & today_return).

           //Start of Section(today_add_member).
        $table_today_add_member = 'member';
        $where_today_add_member['where'] = array('add_date'=>$today_date);
        $info_today_add_member = $this->basic->get_data($table_today_add_member, $where_today_add_member);
        $num_today_add_member = count($info_today_add_member);
            // echo "num_today_add_member: ".$num_today_add_member."<br/>";
        $data['num_today_add_member'] = $num_today_add_member;
           //End of Section(today_add_member).

            //Start of Section(add_book this_month).

        $table_add_book_this_month = 'book_info';
        $first_day_this_month = date('Y-m-01');
        $num_days_this_month = date('t');
        $last_day_this_month  = date("Y-m-$num_days_this_month");
        $where_add_book_this_month['where'] = array('deleted'=>'0',"Date_Format(add_date,'%Y-%m-%d') >="=>$first_day_this_month,"Date_Format(add_date,'%Y-%m-%d') <= "=>$last_day_this_month);
        $info_add_book_this_month = $this->basic->get_data($table_add_book_this_month, $where_add_book_this_month);
        $num_add_book_this_month = count($info_add_book_this_month);
            // echo "num_add_book_this_month: ".$num_add_book_this_month."<br/>";
        $data['num_add_book_this_month'] = $num_add_book_this_month;

           //End of Section(add_book this_month).

           //Start of Section(issue_book_this_month).

        $table_issue_return_book_this_month = 'circulation';
        $first_day_this_month = date('Y-m-01');
        $num_days_this_month = date('t');
        $last_day_this_month  = date("Y-m-$num_days_this_month");

        $where_issue_book_this_month['where'] = array("issue_date >="=>$first_day_this_month,"issue_date <= "=>$last_day_this_month);
        $info_issue_book_this_month = $this->basic->get_data($table_issue_return_book_this_month, $where_issue_book_this_month);
        $num_issue_book_this_month = count($info_issue_book_this_month);
            // echo "num_issue_book_this_month: ".$num_issue_book_this_month."<br/>";
        $data['num_issue_book_this_month'] = $num_issue_book_this_month;

        $where_return_book_this_month['where'] = array("return_date >="=>$first_day_this_month,"return_date <= "=>$last_day_this_month,'is_returned'=>'1');
        $info_return_book_this_month = $this->basic->get_data($table_issue_return_book_this_month, $where_return_book_this_month);
        $num_return_book_this_month = count($info_return_book_this_month);
            // echo "num_return_book_this_month: ".$num_return_book_this_month."<br/>";
        $data['num_return_book_this_month'] = $num_return_book_this_month;

           //Start of Section(issue_book_this_month).

           //Start of Section(add_member_this_month).

        $table_add_member_this_month = 'member';
        $first_day_this_month = date('Y-m-01');
        $num_days_this_month = date('t');
        $last_day_this_month  = date("Y-m-$num_days_this_month");
        $where_add_member_this_month = array('add_date >='=>$first_day_this_month,'add_date <='=>$last_day_this_month);
        $info_add_member_this_month = $this->basic->get_data($table_add_member_this_month, $where_add_member_this_month);
        $num_add_member_this_month = count($info_add_member_this_month);
            // echo "num_add_member_this_month: ".$num_add_member_this_month."<br/>";
        $data['num_add_member_this_month'] = $num_add_member_this_month;



            // bar chart
        $year = date('Y')-1;
        $last_issue_year = date("$year-m-d");

        $where['where'] = array('issue_date >=' => $last_issue_year);
        $order_by = "issue_date ASC";
        $results = $this->basic->get_data('circulation', $where, $select='', $join='', $limit='', $start=null, $order_by);

        $issued = 0;
        $returned = 0;

        $month_year_array=array();

        foreach ($results as $result) {
            $issue_month = date('M', strtotime($result['issue_date']));
            $issue_year = date('Y', strtotime($result['issue_date']));

            $return_month = date('M', strtotime($result['return_date']));
            $return_year = date('Y', strtotime($result['return_date']));

            if (isset($issue[$issue_month][$issue_year])) {
                $issue[$issue_month][$issue_year] += 1;
            } else {
                $issue[$issue_month][$issue_year]=1;
            }



            if ($result['is_returned']==1) {
                if (isset($return[$return_month][$return_year])) {
                    $return[$return_month][$return_year] += 1;
                } else {
                    $return[$return_month][$return_year]=1;
                }

                if (isset($issue[$return_month][$return_year])) {
                    $issue[$return_month][$return_year] += 0;
                } else {
                    $issue[$return_month][$return_year]=0;
                }
            } else {
                if (isset($return[$return_month][$return_year])) {
                    $return[$return_month][$return_year] += 0;
                } else {
                    $return[$return_month][$return_year]=0;
                }
            }
        }

        $chart_array=array();

        $cur_year=date('Y');
        $cur_month=date('m');
        $cur_month=(int)$cur_month;
        $months_name = array(1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'May', 6=>'Jun', 7=>'Jul', 8=>'Aug', 9=>'Sep', 10=>'Oct', 11=>'Nov', 12=>'Dec');
        $months_name_full = array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');

        for ($i=0;$i<=11;$i++) {
            $m=$months_name[$cur_month];
            $m_dis=$this->lang->line("cal_".strtolower($months_name_full[$cur_month]));
            $chart_array[$i]['year']=$m_dis."-".$cur_year;

            if (isset($issue[$m][$cur_year])) {
                $chart_array[$i]['total_issue']=$issue[$m][$cur_year];
            } else {
                $chart_array[$i]['total_issue']=0;
            }
            if (isset($return[$m][$cur_year])) {
                $chart_array[$i]['total_return']=$return[$m][$cur_year];
            } else {
                $chart_array[$i]['total_return']=0;
            }

            $cur_month=$cur_month-1;
            if ($cur_month==0) {
                $cur_month=12;
                $cur_year=$cur_year-1;
            }
        }

        $chart_array=array_reverse($chart_array);


            //data for circle chart
        $data['total_issued'] = $this->basic->get_data('circulation', $where='', $select=array('count(id) as total_issued'));
        $data['not_returned'] = $this->basic->get_data('circulation', $where=array('where'=>array('is_expired'=>'1')), $select=array('count(id) as not_returned'));

        $data['chart_bar'] = $chart_array;

           //End of Section(add_member_this_month).
        $data['body'] = 'librarian/dashboard';
        $data['page_title'] = 'Dashboard';
        $this->_librarian_viewcontroller($data);
    }


    /**
    * Daily read book list
    * @access public
    * @return void
    */
    public function daily_read_material()
    {
        $data['body'] = "librarian/daily_read_material_view_page";
        $data['page_title'] = 'Daily Read Book';
        $this->_librarian_viewcontroller($data);
    }

    /**
    * Daily read book list data loader
    * @access public
    * @return json
    */
    public function daily_read_material_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }
            // setting variables for pagination
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'title';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str=$sort." ".$order;

            // setting properties for search
        $book_id = trim($this->input->post('book_id', true));
        $isbn = trim($this->input->post('isbn', true));

        $title = trim($this->input->post('title', true));
        $author = trim($this->input->post('author', true));
        $edition = trim($this->input->post('edition', true));

        $from_date        = $this->input->post('from_date', true);
        if($from_date != '')
            $from_date        = date('Y-m-d', strtotime($from_date));
        $to_date        = $this->input->post('to_date', true);
        if($to_date != '')
            $to_date        = date('Y-m-d', strtotime($to_date));

            // setting a new properties for $is_searched to set session if search occured
        $is_searched= $this->input->post('is_searched', true);

        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('daily_read_material_book_id', $book_id);
            $this->session->set_userdata('daily_read_material_isbn', $isbn);

            $this->session->set_userdata('daily_read_material_title', $title);
            $this->session->set_userdata('daily_read_material_author', $author);
            $this->session->set_userdata('daily_read_material_edition', $edition);

            $this->session->set_userdata('daily_read_material_from_date', $from_date);
            $this->session->set_userdata('daily_read_material_to_date', $to_date);
            //  $this->session->set_userdata('book_list_category',$category);
        }

            // saving session data to different search parameter variables
        $search_book_id = $this->session->userdata('daily_read_material_book_id');
        $search_isbn = $this->session->userdata('daily_read_material_isbn');
        $search_edition = $this->session->userdata('daily_read_material_edition');

        $search_title = $this->session->userdata('daily_read_material_title');
        $search_author = $this->session->userdata('daily_read_material_author');
        $search_to_date = $this->session->userdata('daily_read_material_to_date');
        $search_from_date = $this->session->userdata('daily_read_material_from_date');


            // creating a blank where_simple array
        $where_simple=array();

            // trimming data
        if ($search_book_id) {
            $where_simple['book_id']   = $search_book_id;
        }
        if ($search_isbn) {
            $where_simple['isbn like '] = "%".$search_isbn."%";
        }

        if ($search_title) {
            $where_simple['title like ']   = "%".$search_title."%";
        }
        if ($search_author) {
            $where_simple['author like '] = "%".$search_author."%";
        }
        if ($search_edition) {
            $where_simple['edition like '] = "%".$search_edition."%";
        }


        if ($search_from_date != '') {
            $where_simple["Date_Format(read_at,'%Y-%m-%d') >="]= $search_from_date;
        }

        if ($search_to_date != '') {
            $where_simple["Date_Format(read_at,'%Y-%m-%d') <="] = $search_to_date;
        }

            //$where_simple['deleted'] =  "0";   //   0 means we will show only availabe books

        $where = array('where'=> $where_simple);

        $offset = ($page-1)*$rows;

        $join  = array("book_info" => "book_info.id = daily_read_material.book_id,left");

        $group_by = array(
            "book_id",
            "title",
            "author",
            "isbn",
            "edition",
            "Date_Format(read_at,'%Y-%m-%d')"
            );
        $select = array(
            'book_info.*',
            'daily_read_material.book_id as book_id',
            'count(daily_read_material.id) as no_of_times',
            "Date_Format(daily_read_material.read_at,'%Y-%m-%d') as read_at"
            );
        $info = $this->basic->get_data('daily_read_material', $where, $select, $join, $limit=$rows, $start= $offset,
            $order_by= $order_by_str, $group_by);
        $total_rows_array=$this->basic->count_row("daily_read_material", $where, $count="daily_read_material.id", $join);

        $total_result=$total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }


    /**
    * Add daily read book
    * @access public
    * @return void
    */
    public function add_daily_read_materials()
    {
        $data['body'] = 'librarian/add_daily_read_materials';
        $data['page_title'] = 'Add Daily Read Book';
        $this->_librarian_viewcontroller($data);
    }

    /**
    * Add daily read book action
    * @access public
    * @return void
    */
    public function add_daily_read_materials_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        if ($_POST) {
            $this->form_validation->set_rules('book_id', '<b>'.$this->lang->line("book id").'</b>', 'trim|required|integer');
        }

        if ($this->form_validation->run() == false) {
            $this->add_daily_read_materials();
        } else {
            $book_id = $this->input->post('book_id', true);

                //Section for checking this book is exist or not.
            $table_exist_book = 'book_info';
            $where_exist_book['where'] = array('id'=>$book_id);
            if (!$this->basic->is_exist($table_exist_book, $where_exist_book['where'], $select='id')) {
                $this->session->set_flashdata('not_exist_message', 1);
                return $this->add_daily_read_materials();
                    //redirect('librarian/add_daily_read_materials','location');
            } else {
                $available = $this->basic->get_data('circulation', $where=array('where'=>array('book_id'=>$book_id, 'is_returned'=>0)));
                if ($available) {
                    $this->session->set_flashdata('available_error', 1);
                    redirect('librarian/add_daily_read_materials', 'location');
                } else {
                    $present_date_time =date('Y-m-d H:i:s');
                    $table = 'daily_read_material';
                    $data = array('book_id'=>$book_id,'read_at'=>$present_date_time);

                    if ($this->basic->insert_data($table, $data)) {
                        $this->session->set_flashdata('success_message', 1);
                        redirect('librarian/daily_read_material', 'location');
                    } else {
                        $this->session->set_flashdata('error_message', 1);
                        redirect('librarian/add_daily_read_materials', 'location');
                    }
                }
            }
                //End Section for checking this book is exist or not.
        }
    }


    /**
    * Generate catalog with barcode
    * @access public
    * @return string
    */
    public function barcode_generate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $info=$this->input->post('info', true);
        $info=json_decode($info, true);
        $str = "";
        $str .= "<div class='row' style='margin-top:27px;margin-left:20px;margin-right:20px;'>
                <div class='col-xs-12'>
                <style>
                    @media print {
                        div.page_break {page-break-after: always;}
                    }
                </style>
                <link href='".base_url()."bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
                <style>.btn{border-radius:0 !important;-moz-border-radius:0 !important;-webkit-border-radius:0 !important;}a{text-decoration:none !important;}</style>";
        $i = 0;
        foreach ($info as $barcode) {
            $src=base_url()."barcode.php?code=".$barcode['id'];
            $str .= "<div class='col-xs-6' style='padding:10px;'>
                <div style='border:2px solid gray;height:230px;padding:10px;'>
                    <p><b>".$this->lang->line("title")." :</b>".$barcode['title']."</p>
                    <p><b>".$this->lang->line("author")." :</b>".$barcode['author']."</p>
                    <p><b>".$this->lang->line("edition")." :</b>".$barcode['edition']."</p>
                    <p><b>".$this->lang->line("ISBN")." :</b>".$barcode['isbn']."</p><br/>
                    <img src='".$src."' width='150px' height='35px' style='float:left;margin-top:0in;'/>
                </div>
            </div>";
            $i++;
            if ($i==8) {
                $i=0;
                $str .= "<div class='page_break'></div><br/><br/>";
            }
        }
        $str .= "</div></div>";

        echo $str;
    }

    public function import_book_action_ajax(){

       if($_FILES['csv_file']['type'] == 'text/comma-separated-values' || $_FILES['csv_file']['type'] == 'application/vnd.ms-excel' || $_FILES['csv_file']['type'] == 'text/csv')
        {
            $ext=trim(array_pop(explode('.',$_FILES['csv_file']['name'])));
            $username = $this->session->userdata('username');           
            $download_id = time();           

            $photo = $username."_".$download_id.".".$ext;  
            $photo=str_replace(" ","_",$photo);          
            $config = array
            (
                "allowed_types" => "*",
                "upload_path" => "./upload/book_import/",
                "file_name" => $photo,
                "overwrite" => TRUE
            );           

            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            $this->upload->do_upload('csv_file');
            $photo_name = $photo;
            $path = FCPATH."upload/book_import/".$photo_name;
            $path=str_replace("\\", "/", $path);

        $table = 'book_info';
//section for getting last id.****************************
        $select_last_id = 'id';      
        $order_by_last_id='id desc';
        $limit_last_id=1;

       $info = $this->basic->get_data($table, $where='', $select_last_id, $join='', $limit_last_id, $start=null, $order_by_last_id);
       $last_id = 0;
       if(!empty($info))    $last_id = $info[0]['id'];
//end of section last id.*********************************


//section for insertinr csv data. ************************
        $query="LOAD DATA LOCAL INFILE '$path'
                INTO TABLE {$table}
                Fields TERMINATED BY ','
                LINES TERMINATED BY '\n'
                (isbn, title, author,edition, edition_year, number_of_books, pdf)";        
        $this->db->query($query);
//end of section of inserting csv data. ********************  


//section for update add-date.*****************************

        $add_date = date("Y-m-d H:i:s");
        $this->basic->update_data($table,array('id >'=>$last_id),array('add_date'=>$add_date));

//end of section update add_date.***************************
        

//Section to delete first row of csv file.***********************
      $table = 'book_info';
      $where = array('isbn' => 'ISBN');
      $data = array('deleted' => '1');

      $this->basic->update_data($table, $where, $data);

//End of the section of delete first row. *************************

        echo "Your data inserted successfully";
       
        }
        else
            echo "Sorry! (".$_FILES['csv_file']['type'].") type is not allowed.";
    }


   public function generate_id()
   {
   	$data['body'] = 'librarian/generate_id';
    $this->_librarian_viewcontroller($data);


   }


   public function generate_id_data()
   {

   		$page = isset($_POST['page']) ? intval($_POST['page']) : 15;
	 	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5;
	 	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
	 	$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
	   

	 	$name      		= trim($this->input->post("name", true));
	 	$type_id    = trim($this->input->post("type_id", true));
	 	$email    	= trim($this->input->post("email", true));
	 	$mobile    		= trim($this->input->post("mobile", true));	 	

	 	$from_date 		= $this->input->post('from_date', true);
        if($from_date != '')
    	 	$from_date 		= date('Y-m-d', strtotime($from_date));
	 	$to_date 		= $this->input->post('to_date', true);
        if($to_date != '')
    	 	$to_date 		= date('Y-m-d', strtotime($to_date));


            // setting a new properties for $is_searched to set session if search occured
	 	$is_searched = $this->input->post('is_searched', true);


	 	if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field

	 		$this->session->set_userdata('member_search_name',      		$name);
	 		$this->session->set_userdata('member_search_type_id',      	$type_id);
	 		$this->session->set_userdata('member_search_email',      	$email);
	 		$this->session->set_userdata('member_search_mobile',      		$mobile);	 		
	 		$this->session->set_userdata('member_search_from_date',        $from_date);
	 		$this->session->set_userdata('member_search_to_date',        	$to_date);
            //	$this->session->set_userdata('book_list_category',$category_id);
	 	}

            // saving session data to different search parameter variables

	 	$search_name      		= $this->session->userdata('member_search_name');
	 	$search_type_id      = $this->session->userdata('member_search_type_id');
	 	$search_email     	= $this->session->userdata('member_search_email');
	 	$search_mobile    		= $this->session->userdata('member_search_mobile');	 	
	 	$search_from_date      	= $this->session->userdata('member_search_from_date');
	 	$search_to_date      	= $this->session->userdata('member_search_to_date');
       //	$search_category=$this->session->userdata('book_list_category');



        // creating a blank where_simple array
	 	$where_simple=array();

	 	          

      // trimming data


	 	if ($search_name) {
	 		$where_simple['name like ']    = "%".$search_name."%";
	 	}

	 	if ($search_type_id) {
	 		$where_simple['type_id']   = $search_type_id;
	 	}

	 	
	 	if ($search_email  ) {
	 		$where_simple['email like']   = "%".$search_email  ."%";
	 	}

	 	if ($search_mobile) {
	 		$where_simple['mobile like']   = "%".$search_mobile."%";
	 	}
	 	

	 	if ($search_from_date != '') {
	 		$where_simple["Date_Format(add_date,'%Y-%m-%d') >="]= $search_from_date;
	 	}
	 	if ($search_to_date != '') {
	 		$where_simple["Date_Format(add_date,'%Y-%m-%d') <="]=$search_to_date;
	 	}
      
           	

	 	$where  = array('where'=>$where_simple);

	 	$order_by_str=$sort." ".$order;       

	 	$offset = ($page-1)*$rows;
	 	$result = array();

	 	$table = "member";

	 	$select = array('member.id as id','member.id as member_id','name','email','user_type','mobile','address','add_date','member_type.member_type_name as type_id','status');
    	$join =  $join = array("member_type" => "member.type_id = member_type.id,left");        

	 	$info = $this->basic->get_data($table, $where, $select, $join, $limit=$rows, $start=$offset, $order_by=$order_by_str,$group_by='');
	 	

	 	
	 	$total_rows_array = $this->basic->count_row($table, $where, $count="id");



	 	$total_result = $total_rows_array[0]['total_rows'];

	 	echo convert_to_grid_data($info, $total_result);

   }


   public function barcode_generate_id(){
   	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $info=$this->input->post('info', true);
        $info=json_decode($info, true);
        $str = '<br><br/>';
        $str .= "<style>
                    p{margin-bottom:6px !important;font-size:13px;}
                    @media print {
                        div.page_break {page-break-after: always;}

                    }
                </style>
                <link href='".base_url()."bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
                <style>.btn{border-radius:0 !important;-moz-border-radius:0 !important;-webkit-border-radius:0 !important;}a{text-decoration:none !important;}</style>";
        $i = 0;
        foreach ($info as $barcode) 
        {           
            $i++;           

            $src=base_url()."barcode.php?code=".$barcode['id'];
            $class="pull-left";
            $style="";
            if($i%2==0) {$class="pull-right"; $style='margin-right:.15in;';}
            $img_url = base_url().'assets/images/logo.png';
            if($i%2!=0 || $i==1) 
            $str .= "<div class='row clearfix' style='width:100%;min-height:2.3in !important;margin-left:.15in;'>";
                $str .= "<div class='clearfix {$class}' style='padding:10px;width:3.36in !important;height:2.125in !important;border:1px solid gray; {$style}'>
                   
                        <img class='img-responsive pull-left' style='height:30px;margin-top:3px;' src='".$img_url."' alt='Logo'>
                        <img class='pull-right' src='".$src."' width='150px' height='35px' style='margin-top:0in;'/>
                        <p style='margin-top:50px;'><hr style='margin:5px 0;'>
                        <p><b>".$this->lang->line("name")." : </b>".$barcode['name']."</p>
                        <p><b>".$this->lang->line("member types")." : </b>".$barcode['type_id']."</p>
                        <p><b>".$this->lang->line("address")." : </b>".$barcode['address']."</p>
                        <p><b>".$this->lang->line("email")." : </b>".$barcode['email']."</p>
                        <p><b>".$this->lang->line("mobile")." : </b>".$barcode['mobile']."</p>
                    
                </div>";
                
            if($i%2==0) 
            $str.="</div>";

            if ($i==8) 
            {
                $i=0;
                $str .= "<div class='page_break'></div><br/><br/>";
            }
        }

        echo $str;

   }



   
}
