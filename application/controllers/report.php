<?php
require_once("home.php");


/**
* class member
* @category controller
*/
class report extends Home
{

    /**
    * load constructor method
    * @access public
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in')!=1) {
            redirect('home/login', 'location');
        }

        if ($this->session->userdata('user_type')!='Admin') {
            redirect('home/login', 'location');
        }
    }

    /**
    * load constructor method
    * @access public
    * @return void
    */
    public function index()
    {
        $data['body'] = 'admin/report';
        $data['page_title'] = 'Fine / Penalty Report';
        $this->_viewcontroller($data);
    }

    /**
    * method to load report data
    * @access public
    * @return void
    */
    public function report_data()
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
        $member_name    = trim($this->input->post('name', true));
        $from_date        = $this->input->post('from_date', true);
        if($from_date != '')
            $from_date      = date('Y-m-d', strtotime($from_date));
        $to_date        = $this->input->post('to_date', true);
        if($to_date != '')
            $to_date        = date('Y-m-d', strtotime($to_date));

        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);

        if ($is_searched) {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('fine_name',        $member_name);
            $this->session->set_userdata('fine_from_date',  $from_date);
            $this->session->set_userdata('fine_to_date',    $to_date);
        //	$this->session->set_userdata('book_list_category',$category_id);
        }

        // saving session data to different search parameter variables
        $search_member_name = $this->session->userdata('fine_name');
        $search_to_date     = $this->session->userdata('fine_to_date');
        $search_from_date   = $this->session->userdata('fine_from_date');
    //	$search_category=$this->session->userdata('book_list_category');

        // creating a blank where_simple array
        $where_simple = array();
        // $todate = date("Y-m-d");


        // trimming data
        if ($search_member_name) {
            $where_simple['member.name like'] = "%".$search_member_name."%";
        }
        if ($search_from_date != '') {
            $where_simple['circulation.return_date >='] = $search_from_date;
        }
        if ($search_to_date != '') {
            $where_simple['circulation.return_date <='] = $search_to_date;
        }

        $where_simple['circulation.fine_amount !='] = 0;

        $where  = array('where' => $where_simple);
        $offset = ($page-1)*$rows;
        $result = array();

        $join = array(
            "member" => "member.member_idd = circulation.member_id,left",
            "book_info" => "book_info.id = circulation.book_id,left"
            );

        $table='circulation';

        $select = array(
            'sum(fine_amount) as fine_amount',
            'circulation.member_id as member_id',
            'member.email email',
            'member.name name',
            'member.mobile',
            'member.address as address',
            'circulation.id as id'
            );

        $group_by = "member_id";

        $info = $this->basic->get_data($table, $where, $select, $join, $limit = $rows, $start = $offset, $order_by = $order_by_str, $group_by);
        $total_rows_array = $this->basic->count_row($table, $where, $count = "circulation.id", $join);
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }

    /**
    * method to load report details data
    * @access public
    * @return void
    */
    public function report_details()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $member_id            = $this->input->post('id', true);
        $search_to_date     = $this->session->userdata('fine_to_date');
        $search_from_date   = $this->session->userdata('fine_from_date');

        $table = 'circulation';
        $join = array(
            "member" => "member.member_idd = circulation.member_id,left",
            "book_info" => "book_info.id = circulation.book_id,left"
            );

        if ($search_from_date != '') {
            $where_simple['circulation.return_date >=']= $search_from_date;
        }
        if ($search_to_date != '') {
            $where_simple['circulation.return_date <=']=$search_to_date;
        }

        $where_simple['circulation.fine_amount !='] = 0;
        $where_simple['circulation.member_id'] = $member_id;

        // $where['where'] = array('member_id'=>$member_id,'fine_amount !='=>0);

        $where  = array('where' => $where_simple);
        $info = $this->basic->get_data($table, $where, $select='', $join);

        $str = "<table class='table table-hover'>
					<tr>
						<th>".$this->lang->line("title")."</th>
						<th>".$this->lang->line("issue date")."</th>
						<th>".$this->lang->line("expiry date")."</th>
						<th>".$this->lang->line("return date")."</th>
						<th>".$this->lang->line("fine")." - ".$this->config->item('currency')."</th>
					</tr>
				 ";
        foreach ($info as $detail) {
            $str .= "<tr><td>".$detail['title']."</td><td>".$detail['issue_date']."</td><td>".$detail['expire_date']."</td><td>".$detail['return_date']."</td><td>".$detail['fine_amount']."</td></tr>";
        }
        $str .= "</table>";

        echo $str;
    }

    /**
    * method to report download option
    * @access public
    * @return void
    */
    public function report_download()
    {
        // saving session data to different search parameter variables
        $search_member_name = $this->session->userdata('fine_name');
        $search_to_date     = $this->session->userdata('fine_to_date');
        $search_from_date   = $this->session->userdata('fine_from_date');
    //	$search_category=$this->session->userdata('book_list_category');

        // creating a blank where_simple array
        $where_simple = array();
        // $todate = date("Y-m-d");


        // trimming data
        if ($search_member_name) {
            $where_simple['member.name like'] = "%".$search_member_name."%";
        }
        if ($search_from_date != '') {
            $where_simple['circulation.return_date >='] = $search_from_date;
        }
        if ($search_to_date != '') {
            $where_simple['circulation.return_date <='] = $search_to_date;
        }

        $where_simple['circulation.fine_amount !='] = 0;

        $where  = array('where' => $where_simple);

        $join = array(
            "member" => "member.member_idd = circulation.member_id,left",
            "book_info"=>"book_info.id = circulation.book_id,left"
            );


        $table = 'circulation';

        $select = array(
            'sum(fine_amount) as fine_amount',
            'circulation.member_id as member_id',
            'member.email email',
            'member.mobile',
            'member.name name',
            'member.address as address',
            'circulation.id as id'
            );

        $group_by = "member_id";

        $info = $this->basic->get_data($table, $where, $select, $join, $limit = '', $start = '', $order_by = 'member_id asc', $group_by);


        $fp = fopen("download/report/brief_report.csv", "w");
        $head=array("Member ID", "Member Name", "Member Email","Member Mobile", "Fine Amount (".$this->config->item('currency').") ");
        fputcsv($fp, $head);
        $write_info = array();

        foreach ($info as  $value) {
            $write_info['member_id'] = $value['member_id'];
            $write_info['name'] = $value['name'];
            $write_info['mobile'] = $value['email'];
            $write_info['email'] = $value['mobile'];
            $write_info['fine_amount'] = $value['fine_amount'];

            fputcsv($fp, $write_info);
        }

        fclose($fp);
        $file_name = "download/report/brief_report.csv";
        $data['file_name'] = $file_name;
        $this->load->view('page/download', $data);
    }

    /**
    * method to load notification report form
    * @access public
    * @return void
    */
    public function notification_report()
    {
        $data['message_type'] = $this->get_message_type();
        $data['body'] = 'admin/notification_report';
        $data['page_title'] = 'Notification Report';
        $this->_viewcontroller($data);
    }

    /**
    * method to load notification report data
    * @access public
    * @return void
    */
    public function notification_report_data()
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
        $type = trim($this->input->post('type', true));
        $name = trim($this->input->post('name', true));
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
            $this->session->set_userdata('notification_report_type', $type);
            $this->session->set_userdata('notification_report_name', $name);
            $this->session->set_userdata('notification_report_from_date', $from_date);
            $this->session->set_userdata('notification_report_to_date', $to_date);
        }

        // saving session data to different search parameter variables
        $search_type      = $this->session->userdata('notification_report_type');
        $search_name      = $this->session->userdata('notification_report_name');
        $search_from_date = $this->session->userdata('notification_report_from_date');
        $search_to_date   = $this->session->userdata('notification_report_to_date');

        // creating a blank where_simple array
        $where_simple = array();

        // trimming data
        if ($search_type) {
            $where_simple['type like'] = "%".$search_type."%";
        }

        if ($search_name) {
            $where_simple['member.name like'] = "%".$search_name."%";
        }

        if ($search_from_date != '') {
            $where_simple["date_format(sent_at,'%Y-%m-%d') >="] = $search_from_date;
        }

        if ($search_to_date != '') {
            $where_simple["date_format(sent_at,'%Y-%m-%d') <="] = $search_to_date;
        }

        $join = array(
            "member" => "sms_email_history.member_id = member.member_idd,left",
            );
        $select = array('sms_email_history.*','member.name as name','member.email','member.mobile');


        $where  = array('where' => $where_simple);
        $offset = ($page-1)*$rows;
        $result = array();

        $table = 'sms_email_history';

        $info = $this->basic->get_data($table, $where, $select, $join, $limit = $rows, $start = $offset, $order_by = $order_by_str);

        $total_rows_array = $this->basic->count_row($table, $where, $count = "sms_email_history.id", $join);
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }

    /**
    * method to load notification report download option
    * @access public
    * @return void
    */
    public function notification_report_download()
    {
        // saving session data to different search parameter variables
        $search_type      = $this->session->userdata('notification_report_type');
        $search_name      = $this->session->userdata('notification_report_name');
        $search_from_date = $this->session->userdata('notification_report_from_date');
        $search_to_date   = $this->session->userdata('notification_report_to_date');

        // creating a blank where_simple array
        $where_simple = array();

        // trimming data
        if ($search_type) {
            $where_simple['type like'] = "%".$search_type."%";
        }

        if ($search_name) {
            $where_simple['member.name like'] = "%".$search_name."%";
        }

        if ($search_from_date != '') {
            $where_simple["date_format(sent_at,'%Y-%m-%d') >="] = $search_from_date;
        }

        if ($search_to_date != '') {
            $where_simple["date_format(sent_at,'%Y-%m-%d') <="] = $search_to_date;
        }

        $join = array(
            "member" => "sms_email_history.member_id = member.member_idd,left",
            );
        $select = array('sms_email_history.*','member.name as name','member.email','member.mobile');


        $where  = array('where' => $where_simple);

        $table = 'sms_email_history';

        $info = $this->basic->get_data($table, $where, $select, $join, $limit = '', $start = '', $order_by = 'member_id asc');

        $fp=fopen("download/report/notification_report.csv", "w");
        $head=array("Member Name","Member Email","Member Mobile","Notification Type","Subject","Message","Sent at");
        fputcsv($fp, $head);
        $write_info = array();

        foreach ($info as  $value) {
            $write_info['name'] = $value['name'];
            $write_info['email'] = $value['email'];
            $write_info['mobile'] = $value['mobile'];
            $write_info['type'] = $value['type'];
            $write_info['title'] = $value['title'];
            $write_info['message'] = $value['message'];
            $write_info['sent_at'] = $value['sent_at'];

            fputcsv($fp, $write_info);
        }

        fclose($fp);
        $file_name = "download/report/notification_report.csv";
        $data['file_name'] = $file_name;
        $this->load->view('page/download', $data);
    }
}
