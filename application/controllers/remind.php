<?php
require_once("home.php");

/**
* class member
* @category controller
*/
class remind extends Home
{
    /**
    * loading constructor method
    * @access public
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in')!=1) {
            redirect('home/login', 'location');
        }

        if ($this->session->userdata('user_type')!='Librarian') {
            redirect('home/login', 'location');
        }
    }

    /**
    * method to load index page.
    * @access public
    * @return void
    */
    public function index()
    {
        $data['body'] = 'librarian/reminder';
        $data['page_title'] = 'Reminder';
        $this->_librarian_viewcontroller($data);
    }

    /**
    * method to load reminder data
    * @access public
    * @return void
    */
    public function reminders_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'circulation.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $order_by_str = $sort." ".$order;

        $name = trim($this->input->post('name', true));

        $issue_from_date = $this->input->post('issue_from_date', true);
        $issue_from_date = date('Y-m-d', strtotime($issue_from_date));
        if ($issue_from_date == '1970-01-01') {
            $issue_from_date = '';
        }
        $issue_to_date = $this->input->post('issue_to_date', true);
        $issue_to_date = date('Y-m-d', strtotime($issue_to_date));
        if ($issue_to_date == '1970-01-01') {
            $issue_to_date = '';
        }

        $expire_from_date = $this->input->post('expire_from_date', true);
        $expire_from_date = date('Y-m-d', strtotime($expire_from_date));
        if ($expire_from_date == '1970-01-01') {
            $expire_from_date = '';
        }
        $expire_to_date = $this->input->post('expire_to_date', true);
        $expire_to_date = date('Y-m-d', strtotime($expire_to_date));
        if ($expire_to_date == '1970-01-01') {
            $expire_to_date = '';
        }

        $is_searched= $this->input->post('is_searched', true);

        if ($is_searched) {
            $this->session->set_userdata('send_email_name', $name);
            $this->session->set_userdata('send_email_issue_from_date', $issue_from_date);
            $this->session->set_userdata('send_email_issue_to_date', $issue_to_date);
            $this->session->set_userdata('send_email_expire_from_date', $expire_from_date);
            $this->session->set_userdata('send_email_expire_to_date', $expire_to_date);
        }

        $search_name=$this->session->userdata('send_email_name');
        $search_issue_from_date=$this->session->userdata('send_email_issue_from_date');
        $search_issue_to_date=$this->session->userdata('send_email_issue_to_date');
        $search_expire_from_date=$this->session->userdata('send_email_expire_from_date');
        $search_expire_to_date=$this->session->userdata('send_email_expire_to_date');


        $where_simple = array();

        if ($search_name) {
            $where_simple['member.name like '] = '%'.$search_name.'%';
        }
        if ($search_issue_from_date != '') {
            $where_simple['circulation.issue_date >='] = $search_issue_from_date;
        }
        if ($search_issue_to_date != '') {
            $where_simple['circulation.issue_date <='] = $search_issue_to_date;
        }
        if ($search_expire_from_date != '') {
            $where_simple['circulation.expire_date >='] = $search_expire_from_date;
        }
        if ($search_expire_to_date != '') {
            $where_simple['circulation.expire_date <='] = $search_expire_to_date;
        }

        $where_simple['circulation.is_returned'] = 0;

        $where = array('where' => $where_simple);
        $offset = ($page-1)*$rows;
        $result = array();

        $join = array(
            'member' => 'circulation.member_id = member.member_idd,left',
            'book_info' => 'circulation.book_id = book_info.id,left'
            );
        $select = array('circulation.id as id', 'member.name as name', 'member.user_type', 'member.member_idd as member_id', 'member.email as email', 'member.mobile', 'book_info.title as title', 'issue_date', 'expire_date');

        $info = $this->basic->get_data('circulation', $where, $select, $join, $limit = $rows, $start = $offset, $order_by = $order_by_str, $group_by = '', $num_rows =1);

        // echo $this->db->last_query(); exit();

        $total_rows_array = $this->basic->count_row($table = "circulation", $where, $count = "circulation.id", $join, $group_by = '');

        $total_result=$total_rows_array[0]['total_rows'];
        // $total_result=$info['extra_index'];

        echo convert_to_grid_data($info, $total_result);
    }


    /**
    * method to send notification
    * @access public
    * @return void
    */
    public function send_notification()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $subject = $this->input->post('subject', true);
        $message = $this->input->post('content', true);
        $message_type = $this->input->post('message_type', true);
        $mask = $this->config->item('product_name');
        $from = $this->config->item('institute_email');

        $count = 0;
        $to_email = array();
        $to_mobile = array();
        $member_id_array = array();
        $info = $this->input->post('info');
        $info = json_decode($info, true);

        $sms_send_status = array(); // flag to prevent sending sms from same number twice

        foreach ($info as $member) {
            // forming array for  bulk emmail
            if ($message!= "" && $from!= "" && $member['email']!= "" && $subject!= "" && $member['member_id']!= "") {
                $member_id_array[] = $member['member_id'];
                $to_email[] = $member['email'];
            }

            if ($message_type == "SMS") {
                // sms is sending one by one

               if ($message == "" ||  $member['mobile'] == "" || $subject == "" || $member['member_id'] == "") {
                   continue;
               }
                if (isset($sms_send_status[$member['mobile']]) && $sms_send_status[$member['mobile']] == 1) {
                    continue;
                }

                if ($this->_sms_sender($message, $member['mobile'])) {
                    $insert_data = array(
                        "member_id" => $member['member_id'],
                        "title" => $subject,
                        "message" => $message,
                        "sent_at" => date('Y-m-d H:i:s'),
                        "type" => "SMS"
                    );

                    $this->basic->insert_data('sms_email_history', $insert_data);
                    $sms_send_status[$member['mobile']] = 1;
                    $count++;
                }
            }
        }

        $member_id_array = array_unique($member_id_array);

        if ($message_type == "Email") {
            // email is sending bulk

            $to_email = array_unique($to_email);

            if ($this->_mail_sender($from, $to_email, $subject, $message, $mask)) {
                foreach ($member_id_array as $key=>$val) {
                    $insert_data = array("member_id" => $val, "title" => $subject, "message" => $message, "sent_at" => date('Y-m-d H:i:s'),"type" => "Email");
                    $this->basic->insert_data('sms_email_history', $insert_data);
                    $count++;
                }
            }
        }


        if ($message_type=="Notification") {
            // only notification

            foreach ($member_id_array as $key=>$val) {
                $insert_data=array("member_id"=>$val,"title"=>$subject,"message"=>$message,"sent_at"=>date('Y-m-d H:i:s'),"type"=>"Notification");
                $this->basic->insert_data('sms_email_history', $insert_data);
                $count++;
            }
        }

        echo $this->lang->line("total").' '.$count." / ".count($member_id_array)." ".$this->lang->line($message_type)." ".$this->lang->line("sent");
    }
}
