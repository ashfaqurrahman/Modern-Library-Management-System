<?php

// including home controller
require_once("home.php");

/**
* class member
* @category controller
*/
class member extends Home
{
    /**
    * load constructor
    * @access public
    * @return void
    */

    public function __construct()    // constructor method
    {
        parent::__construct();    // loading constructor
        if ($this->session->userdata('logged_in') != 1) {    // setting security
            redirect('home/login', 'location');
        }

        if ($this->session->userdata('user_type') != 'Member') {
            redirect('home/login', 'location');
        }

        $this->load->library("pagination");    // loading pagination library
        $this->load->helper("form");    // loading helper form

    }

    /**
    * display home page of member
    * @access public
    * @return void
    */
    public function index()
    {
        $this->member_book_list();
    }

    // a method to load grid data page or library view page
    public function member_book_list()
    {
        $data['category_info'] = $this->get_book_category();
        $data['body']           = 'member/member_book_list';
        $data['page_title'] = 'Book List';
        $this->_member_viewcontroller($data);
    }

    // a method to output grid data
    public function member_book_list_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        // setting variables for pagination
        $page    = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows    = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort    = isset($_POST['sort']) ? strval($_POST['sort']) : 'title';
        $order    = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str = $sort." ".$order;

        // setting properties for search
        $book_id    = trim($this->input->post('book_id', true));
        $isbn        = trim($this->input->post('isbn', true));
        $title        = trim($this->input->post('title', true));
        $author    = trim($this->input->post("author", true));
        $category    = trim($this->input->post('category_id', true));

        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);

        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('member_book_list_book_id', $book_id);
            $this->session->set_userdata('member_book_list_isbn', $isbn);
            $this->session->set_userdata('member_book_list_title', $title);
            $this->session->set_userdata('member_book_list_author', $author);
            $this->session->set_userdata('member_book_list_category', $category);
        }

        // saving session data to different search parameters
        $search_book_id  = $this->session->userdata('member_book_list_book_id');
        $search_isbn     = $this->session->userdata('member_book_list_isbn');
        $search_title     = $this->session->userdata('member_book_list_title');
        $search_author   = $this->session->userdata('member_book_list_author');
        $search_category = $this->session->userdata('member_book_list_category');

        // creating a blank where_simple array
        $where_simple=array();

        // trimming data
        if ($search_book_id) {
            $where_simple['id'] = $search_book_id;
        }

        if ($search_isbn) {
            $where_simple['isbn like '] = "%".$search_isbn."%";
        }

        if ($search_title) {
            $where_simple['title like '] = "%".$search_title."%";
        }

        if ($search_author) {
            $where_simple['author like '] = "%".$search_author."%";
        }


        // FIND_IN_SET is used to find one single value from many values. here multiple category exists
        if ($search_category) {
            $this->db->where("FIND_IN_SET('$search_category', category_id) !=", 0);
        }

        // $where_simple['deleted'] = 0 means we will show only availabe books
        $where_simple['deleted'] = "0";
        $where = array('where' => $where_simple);

        $offset = ($page-1)*$rows;

        $table = "book_info";
        // getting data from table
        $info = $this->basic->get_data($table, $where, $select = '', $join = '', $limit = $rows, $start = $offset, $order_by = $order_by_str);

        $total_rows_array = $this->basic->count_row($table, $where, $count = "book_info.id");
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);    // convert to grid data
    }

    /**
    * display view details of book
    * @access public
    * @return void
    * @param integer
    */
    public function view_details($id = 0)
    {
        $data["body"] = "member/view_details";
        $data['page_title'] = 'Book Details';

        $table = "book_info";
        $where['where'] = array('book_info.id' => $id);

        $result_book_info = $this->basic->get_data($table, $where, $select = '', $join = '', $limit = "", $start = "", $order_by = "");

        $result_category = $this->basic->get_data("category", $where = "", $select = '', $join = '', $limit = '', $start = null, $order_by = '');

        $cat_string = $result_book_info[0]['category_id'];    // extracting category id from data array
        $temp = explode(",", $cat_string);    // creating array from a string through explode function

        $data['info'] = $result_book_info;

        $data['all_category'] = $result_category;

        $data['existing_category'] = $temp;

        $this->_member_viewcontroller($data);
    }

    /**
    * display request book form
    * @access public
    * @return void
    */

    public function request_book_form()
    {
        $data['body'] = 'member/request_book_form';
        $data['page_title'] = 'Request Book';
        $this->_member_viewcontroller($data);
    }

    /**
    * request book action on submit book data
    * @access public
    * @return void
    */
    public function request_book_form_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }
        $id = $this->session->userdata('member_id');

        if ($_POST) {
            // form validation

            $this->form_validation->set_rules('book_title', '<b>'.$this->lang->line("title").'</b>', "trim|required|");
            $this->form_validation->set_rules('author', '<b>'.$this->lang->line("add date").'</b>', 'trim|required');
            $this->form_validation->set_rules('edition', '<b>'.$this->lang->line("title").'</b>', 'trim|required');
            $this->form_validation->set_rules('note', '<b>'.$this->lang->line("subtitle").'</b>', 'trim|required');

            // if validation false go back to form
            if ($this->form_validation->run() == false) {
                return $this->request_book_form();
            } 


            // if validation true, save post data into variables
            $book_title    =    $this->input->post('book_title', true);
            $author        =   $this->input->post('author', true);
            $edition        =    $this->input->post('edition', true);
            $note            =    $this->input->post('note', true);
            $request_date    =   date("Y-m-d");
      


            // creating a array of variables
            $data = array(
                        'book_title'    => $book_title,
                        'author'        => $author,
                        'edition'        => $edition,
                        'note'            => $note,
                        'member_id'    => $id,
                        "request_date"    => $request_date
                    );

            $table = 'request_book';

            // if data array is not empty insert data into database
            if (!empty($data)) {
                $this->basic->insert_data($table, $data);
                $this->session->set_flashdata('success_message', 1);
                redirect('member/requested_books', 'location');
            } else {
                $this->session->set_flashdata("error_message", 1);
            }
        }
    }

    /**
    * display requested book list page
    * @access public
    * @return void
    */

    public function requested_books()
    {
        $data['body'] = 'member/requested_books';
        $data['page_title'] = 'Requested Book';
        $this->_member_viewcontroller($data);
    }

    /**
    * loading grid data
    * @access public
    * @return void
    */
    public function requested_books_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $id = $this->session->userdata('member_id');

        // setting variables for pagination
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'book_title';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str = $sort." ".$order;

        // setting properties for search
        $book_title = trim($this->input->post('book_title', true));
        $author    = trim($this->input->post("author", true));

        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);

        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('requested_books_data_book_list_book_title', $book_title);
            $this->session->set_userdata('requested_books_data_book_list_author', $author);
        }

        // saving session data to different search parameter variables
        $search_book_title = $this->session->userdata('requested_books_data_book_list_book_title');
        $search_author = $this->session->userdata('requested_books_data_book_list_author');

        // creating a blank where_simple array
        $where_simple = array();

        // trimming data
        if ($search_book_title) {
            $where_simple['book_title like '] = "%".$search_book_title."%";
        }

        if ($search_author) {
            $where_simple['author like '] = "%".$search_author."%";
        }

        $where_simple['request_book.member_id'] = $id;

        $table = "request_book";

        $offset = ($page-1)*$rows;
        $where  = array('where' => $where_simple);
        $join = array("member" => "member.member_idd = request_book.member_id, left");

        $info = $this->basic->get_data($table, $where, $select = '', $join,    $limit = $rows, $start = $offset, $order_by = '');

        $total_rows_array = $this->basic->count_row($table, $where, $count = "request_book.id", $join);
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }


    /**
    * reset password
    * @access public
    * @return void
    */
    public function reset_password_form()
    {
        $data['page_title'] = 'Password Reset';
        $data['body'] = 'member/theme_member/password_reset_form';
        $this->_member_viewcontroller($data);
    }

    public function reset_password_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('defaults/access_forbidden', 'location');
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
                $this->reset_password_form();
            }
        }
    }

    /**
    * display member circulation page
    * @access public
    * @return void
    */
    public function member_circulation()
    {
        $data['body'] = 'member/circulation';
        $data['page_title'] = 'Circulation';
        $this->_member_viewcontroller($data);
    }

    /**
    * load grid data of circulation
    * @access public
    * @return void
    */
    public function member_circulation_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $id = $this->session->userdata('member_id');

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'issue_date';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $order_by_str = $sort." ".$order;

        // setting properties for search
        // $member_name = $this->input->post('name');

        $book_title    = trim($this->input->post('book_title', true));
        $author          = trim($this->input->post("author", true));
        $return_status  = trim($this->input->post("return_status", true));

        $from_date = $this->input->post('from_date', true);

        if ($from_date !='') {
            $from_date    = date('Y-m-d', strtotime($from_date));
        }

        $to_date = $this->input->post('to_date', true);

        if ($to_date!='') {
            $to_date = date('Y-m-d', strtotime($to_date));
        }

        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);

        /***Fix the date format**/

        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            // $this->session->set_userdata('book_list_name', 		  $member_name);
            $this->session->set_userdata('personal_circulation_book_title', $book_title);
            $this->session->set_userdata('personal_circulation_author', $author);
            $this->session->set_userdata('personal_circulation_from_date', $from_date);
            $this->session->set_userdata('personal_circulation_to_date', $to_date);
            $this->session->set_userdata('personal_circulation_status', $return_status);
        //	$this->session->set_userdata('book_list_category', $category_id);
        }

        // saving session data to different search parameter variables
        // $search_member_name = $this->session->userdata('book_list_name');
        $search_book_title = $this->session->userdata('personal_circulation_book_title');
        $search_author     = $this->session->userdata('personal_circulation_author');
        $search_to_date    = $this->session->userdata('personal_circulation_to_date');
        $search_from_date  = $this->session->userdata('personal_circulation_from_date');
        $search_status     = $this->session->userdata('personal_circulation_status');
    //	$search_category=$this->session->userdata('book_list_category');

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
        // if($search_member_name) $where_simple['member.name like'] = "%".$search_member_name."%";
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

        $where_simple['member_id'] = $id;
        $where  = array('where' => $where_simple);
        $offset = ($page-1)*$rows;
        $result = array();

        $join = array(
            "member" => "member.member_idd = circulation.member_id, left",
            "book_info" => "book_info.id = circulation.book_id, left"
            );

        $table = 'circulation';

        $info = $this->basic->get_data($table, $where, $select = '', $join,    $limit = $rows, $start = $offset, $order_by = $order_by_str);

        $total_rows_array = $this->basic->count_row($table, $where, $count = "circulation.id", $join);
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }

    /**
    * display sms email history page
    * @access public
    * @return void
    */

    public function sms_email_history()
    {
        $data['message_type'] = $this->get_message_type();
        $data['body'] = 'member/sms_email_history';
        $data['page_title'] = 'Sms/Email History';
        $this->_member_viewcontroller($data);
    }

    /**
    * load gird data of sms email history
    * @access public
    * @return void
    */

    public function sms_email_history_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $id = $this->session->userdata('member_id');

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'type';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str = $sort." ".$order;

        // setting properties for search
        $type = trim($this->input->post('type', true));

        $from_date = $this->input->post('from_date', true);
        if($from_date != '')
            $from_date = date('Y-m-d', strtotime($from_date));

        $to_date = $this->input->post('to_date', true);
        if($to_date != '')
            $to_date = date('Y-m-d', strtotime($to_date));

        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);

        /***Fix the date format**/

        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('sms_email_history_sms_email_type', $type);
            $this->session->set_userdata('sms_email_history_sms_email_from_date', $from_date);
            $this->session->set_userdata('sms_email_history_sms_email_to_date', $to_date);
        }

        // saving session data to different search parameter variables
        $search_type      = $this->session->userdata('sms_email_history_sms_email_type');
        $search_from_date = $this->session->userdata('sms_email_history_sms_email_from_date');
        $search_to_date   = $this->session->userdata('sms_email_history_sms_email_to_date');

        // creating a blank where_simple array
        $where_simple = array();

        // trimming data
        if ($search_type) {
            $where_simple['type like'] = "%".$search_type."%";
        }

        if ($search_from_date != '') {
            $where_simple["date_format(sent_at,'%Y-%m-%d') >="] = $search_from_date;
        }

        if ($search_to_date != '') {
            $where_simple["date_format(sent_at,'%Y-%m-%d') <="] = $search_to_date;
        }

        $where_simple['member_id'] = $id;

        $where  = array('where' => $where_simple);
        $offset = ($page-1)*$rows;
        $result = array();

        $table = 'sms_email_history';

        $info = $this->basic->get_data($table, $where, $select = '', $join = "", $limit = $rows, $start = $offset, $order_by = $order_by_str);

        $total_rows_array = $this->basic->count_row($table, $where, $count = "sms_email_history.id", $join = '');
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }
}
