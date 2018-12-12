<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
* class home
* @category controller
*/

class home extends CI_Controller
{
    /**
    * load constructor
    * @access public
    * @return void
    */
    public $language;
    public $is_rtl;
    public function __construct()
    {
        parent::__construct();
        set_time_limit(0);
        $this->load->helpers('my_helper');

        $this->is_rtl=FALSE;
        $this->language="";
        $this->_language_loader();

        $seg = $this->uri->segment(2);
        if ($seg!="installation" && $seg!= "installation_action") {
            if (file_exists(APPPATH.'install.txt')) {
                redirect('home/installation', 'location');
            }
        }

        if (!file_exists(APPPATH.'install.txt')) {
            $this->load->database();
            $this->load->model('basic');
            /**Disable STRICT_TRANS_TABLES mode if exist on mysql ***/
            $query="SET SESSION sql_mode = ''";
            $this->db->query($query);
            $this->load->library('sms_manager');
            $this->_time_zone_set();

            if(function_exists('ini_set'))
            ini_set('memory_limit', '-1');

            $this->upload_path = realpath(APPPATH . '../upload');
        }
    }


    public function _language_loader()
    {
        if($this->config->item("language")=="arabic")
        $this->is_rtl=TRUE;

        if(!$this->config->item("language") || $this->config->item("language")=="")
        $this->language="english";
        else $this->language=$this->config->item('language');

        $this->lang->load('sidebar', $this->language);
        $this->lang->load('dashboard', $this->language);
        $this->lang->load('general_settings', $this->language);
        $this->lang->load('book', $this->language);
        $this->lang->load('member', $this->language);
        $this->lang->load('book_read_request_report', $this->language);
        $this->lang->load('circulation', $this->language);
        $this->lang->load('notification', $this->language);
        $this->lang->load('front', $this->language);
        $this->lang->load('memberpanel', $this->language);
        $this->lang->load('common', $this->language);
        $this->lang->load('message', $this->language);

        $this->lang->load('calendar', $this->language);
        $this->lang->load('date', $this->language);
        $this->lang->load('db', $this->language);
        $this->lang->load('email', $this->language);
        $this->lang->load('form_validation', $this->language);
        $this->lang->load('ftp', $this->language);
        $this->lang->load('imglib', $this->language);
        $this->lang->load('migration', $this->language);
        $this->lang->load('number', $this->language);
        $this->lang->load('pagination', $this->language);
        $this->lang->load('profiler', $this->language);
        $this->lang->load('unit_test', $this->language);
        $this->lang->load('upload', $this->language);
    }


    /**
    * load index page of home
    * @access public
    * @return void
    */
    public function index()
    {
        $data = $this->index_data_loader();
        $data['body'] = 'site/homepage';
        $data['page_title'] = "homepage";
        $data["language_info"] = $this->_language_list();
        $this->_site_viewcontroller($data);
    }

    /**
    * load data loader
    * @access public
    * @return $data array
    */
    public function index_data_loader()
    {
        $data = array();
        $data['book_category'] = $this->get_book_category();

        $table = "daily_read_material";
        $select = array(
            "book_info.id",
            "book_info.category_id",
            "book_info.title",
            "book_info.size1 as size",
            "book_info.publishing_year",
            "book_info.publisher",
            "book_info.edition_year",
            "book_info.subtitle",
            "book_info.edition",
            "book_info.isbn",
            "book_info.author",
            "COUNT(daily_read_material.id) AS total_read",
            "book_info.cover"
            );
        $join = array('book_info' => "book_info.id=daily_read_material.book_id,left");
        $data['read_book'] = $this->basic->get_data($table, $where = '', $select, $join, $limit = 12, $start = 0, $order_by = 'read_at DESC', $group_by = 'title, author, edition');

        $table = "circulation";
        $select = array(
            "book_info.id",
            "book_info.category_id",
            "book_info.title",
            "book_info.size1 as size",
            "book_info.publishing_year",
            "book_info.publisher",
            "book_info.edition_year",
            "book_info.subtitle",
            "book_info.edition",
            "book_info.isbn",
            "book_info.author",
            "COUNT(circulation.id) AS total_issued",
            "book_info.cover"
            );
        $join = array('book_info' => "book_info.id=circulation.book_id,left");
        $data['issued_book'] = $this->basic->get_data($table, $where = '',  $select, $join, $limit = 12, $start = 0, $order_by = 'issue_date DESC', $group_by = 'title,author,edition');

        $table = "book_info";
        $select = array(
            "sum(cast(cast(book_info.status as char) as SIGNED)) as available_book",
            "book_info.number_of_books",
            "book_info.id",
            "book_info.category_id",
            "book_info.title",
            "book_info.size1 as size",
            "book_info.publishing_year",
            "book_info.publisher",
            "book_info.edition_year",
            "book_info.subtitle",
            "book_info.edition",
            "book_info.isbn",
            "book_info.author",
            "book_info.cover",
            "book_info.add_date"
            );
        $data['recent_book'] = $this->basic->get_data($table, $where = '', $select, $join = '', $limit = 12, $start = 0, $order_by = 'add_date DESC', $group_by = 'title, author, edition');
        // echo $this->db->last_query();
        return $data;
    }

    /**
    * set time zone method
    * @access public
    * @return void
    */
    function _time_zone_set()
    {
        $time_zone = $this->config->item('time_zone');
        if ($time_zone== '') {
            $time_zone="Europe/Dublin";
        }
        date_default_timezone_set($time_zone);
    }

    /**
    * load time zone list method
    * @access public
    * @return $all_time_zone
    */
     function _time_zone_list()
     {
         $all_time_zone = array(
            'Kwajalein'                     => 'GMT -12.00 Kwajalein',
            'Pacific/Midway'                 => 'GMT -11.00 Pacific/Midway',
            'Pacific/Honolulu'                 => 'GMT -10.00 Pacific/Honolulu',
            'America/Anchorage'             => 'GMT -9.00  America/Anchorage',
            'America/Los_Angeles'             => 'GMT -8.00  America/Los_Angeles',
            'America/Denver'                 => 'GMT -7.00  America/Denver',
            'America/Tegucigalpa'             => 'GMT -6.00  America/Tegucigalpa',
            'America/New_York'                 => 'GMT -5.00  America/New_York',
            'America/Caracas'                 => 'GMT -4.30  America/Caracas',
            'America/Halifax'                 => 'GMT -4.00  America/Halifax',
            'America/St_Johns'                 => 'GMT -3.30  America/St_Johns',
            'America/Argentina/Buenos_Aires' => 'GMT +-3.00 America/Argentina/Buenos_Aires',
            'America/Sao_Paulo'             =>' GMT -3.00  America/Sao_Paulo',
            'Atlantic/South_Georgia'         => 'GMT +-2.00 Atlantic/South_Georgia',
            'Atlantic/Azores'                 => 'GMT -1.00  Atlantic/Azores',
            'Europe/Dublin'                 => 'GMT        Europe/Dublin',
            'Europe/Belgrade'                 => 'GMT +1.00  Europe/Belgrade',
            'Europe/Minsk'                     => 'GMT +2.00  Europe/Minsk',
            'Asia/Kuwait'                     => 'GMT +3.00  Asia/Kuwait',
            'Asia/Tehran'                     => 'GMT +3.30  Asia/Tehran',
            'Asia/Muscat'                     => 'GMT +4.00  Asia/Muscat',
            'Asia/Yekaterinburg'             => 'GMT +5.00  Asia/Yekaterinburg',
            'Asia/Kolkata'                     => 'GMT +5.30  Asia/Kolkata',
            'Asia/Katmandu'                 => 'GMT +5.45  Asia/Katmandu',
            'Asia/Dhaka'                     => 'GMT +6.00  Asia/Dhaka',
            'Asia/Rangoon'                     => 'GMT +6.30  Asia/Rangoon',
            'Asia/Krasnoyarsk'                 => 'GMT +7.00  Asia/Krasnoyarsk',
            'Asia/Brunei'                     => 'GMT +8.00  Asia/Brunei',
            'Asia/Seoul'                     => 'GMT +9.00  Asia/Seoul',
            'Australia/Darwin'                 => 'GMT +9.30  Australia/Darwin',
            'Australia/Canberra'             => 'GMT +10.00 Australia/Canberra',
            'Asia/Magadan'                     => 'GMT +11.00 Asia/Magadan',
            'Pacific/Fiji'                     => 'GMT +12.00 Pacific/Fiji',
            'Pacific/Tongatapu'             => 'GMT +13.00 Pacific/Tongatapu'
        );
         return $all_time_zone;
     }

    /**
    * disable cache method
    * @access public
    * @return void
    */
     function _disable_cache()
     {
         header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
         header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
         header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
         header("Cache-Control: post-check=0, pre-check=0", false);
         header("Pragma: no-cache");
     }

    /**
    * method for security
    * @access public
    * @return void
    */
    public function access_forbidden()
    {
        $this->load->view('page/access_forbidden');
    }

    /**
    * method for viewing data on view page
    * @access public
    * @return void
    * @param  $data array()
    */
     function _public_viewcontroller($data = array())
     {
         $this->load->view('public/theme/theme_public', $data);
     }

    /**
    * method for front view controller
    * @access public
    * @return void
    * @param  $data array()
    */
     function _front_viewcontroller($data = array())
     {
         // $this->_disable_cache();
        if (!isset($data['body'])) {
            $data['body'] = $this->config->item('default_page_url');
        }

         if (!isset($data['page_title'])) {
             $data['page_title'] = "";
         }

         $this->load->view('front/theme_front', $data);
     }

    /**
    * method for front view controller
    * @access public
    * @return void
    * @param  $data array()
    */
    function _viewcontroller($data = array())
    {
        if (!isset($data['body'])) {
            $data['body'] = $this->config->item('default_page_url');
        }

        if (!isset($data['page_title'])) {
            $data['page_title'] = "Admin Panel";
        }

        if (!isset($data['crud'])) {
            $data['crud'] = 0;
        }
        // fetch all pending student queries to show in admin notification area
        //$data['student_query_notifications']=$this->_admin_notifications();
        $this->load->view('admin/theme/theme', $data);
    }

    /**
    * method for front view controller
    * @access public
    * @return void
    * @param  $data array()
    */

    function _member_viewcontroller($data = array())
    {
        if (!isset($data['body'])) {
            $data['body'] = $this->config->item('default_page_url');
        }

        if (!isset($data['page_title'])) {
            $data['page_title'] = "Member Panel";
        }

        if (!isset($data['crud'])) {
            $data['crud'] = 0;
        }

        $this->load->view('member/theme_member/theme', $data);
    }

    /**
    * method for front view controller
    * @access public
    * @return void
    * @param  $data array()
    */

    function _librarian_viewcontroller($data = array())
    {
        if (!isset($data['body'])) {
            $data['body'] = $this->config->item('default_page_url');
        }

        if (!isset($data['page_title'])) {
            $data['page_title'] = "Librarian Panel";
        }

        if (!isset($data['crud'])) {
            $data['crud'] = 0;
        }

        $this->load->view('librarian/theme/theme', $data);
    }

    /**
    * method for front view controller
    * @access public
    * @return void
    * @param  $data array()
    */

    function _site_viewcontroller($data = array())
    {
        if (!isset($data['body'])) {
            $data['body'] = "site/homepage";
        }
        if (!isset($data['page_title'])) {
            $data['page_title'] = "";
        }
        $this->load->view('site/theme_front', $data);
    }

    /**
    * method to install software
    * @access public
    * @return void
    */

    public function installation()
    {
        if (!file_exists(APPPATH.'install.txt')) {
            redirect('home/login', 'location');
        }
        $data = array("body" => "page/install", "page_title" => "Install Package","language_info" => $this->_language_list());
        $this->_front_viewcontroller($data);
    }

    /**
    * method to installation action
    * @access public
    * @return void
    */

    public function installation_action()
    {
        if (!file_exists(APPPATH.'install.txt')) {
            redirect('home/login', 'location');
        }

        if ($_POST) {
            // validation
            $this->form_validation->set_rules('host_name',               '<b>Host Name</b>',                   'trim|required|xss_clean');
            $this->form_validation->set_rules('database_name',           '<b>Database Name</b>',               'trim|required|xss_clean');
            $this->form_validation->set_rules('database_username',       '<b>Database Username</b>',           'trim|required|xss_clean');
            $this->form_validation->set_rules('database_password',       '<b>Database Password</b>',           'trim|xss_clean');
            $this->form_validation->set_rules('app_username',            '<b>Admin Panel Login Email</b>',     'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('app_password',            '<b>Admin Panel Login Password</b>',  'trim|required|xss_clean');
            $this->form_validation->set_rules('institute_name',          '<b>Institute Name</b>',              'trim|xss_clean');
            $this->form_validation->set_rules('institute_address',       '<b>Institute Address</b>',           'trim|xss_clean');
            $this->form_validation->set_rules('institute_mobile',        '<b>Institute Phone / Mobile</b>',    'trim|xss_clean');
            $this->form_validation->set_rules('language',                '<b>Language</b>',                    'trim');


            // go to config form page if validation wrong
            if ($this->form_validation->run() == false) {
                return $this->installation();
            } else {
                $host_name = addslashes(strip_tags($this->input->post('host_name', true)));
                $database_name = addslashes(strip_tags($this->input->post('database_name', true)));
                $database_username = addslashes(strip_tags($this->input->post('database_username', true)));
                $database_password = addslashes(strip_tags($this->input->post('database_password', true)));
                $app_username = addslashes(strip_tags($this->input->post('app_username', true)));
                $app_password = addslashes(strip_tags($this->input->post('app_password', true)));
                $institute_name = addslashes(strip_tags($this->input->post('institute_name', true)));
                $institute_address = addslashes(strip_tags($this->input->post('institute_address', true)));
                $institute_mobile = addslashes(strip_tags($this->input->post('institute_mobile', true)));
                $language = addslashes(strip_tags($this->input->post('language', true)));

                if (!@mysql_connect($host_name, $database_username, $database_password)) {
                    $this->session->set_userdata('mysql_error', "Could not conenect to MySQL.");
                    return $this->installation();
                }
                if (!@mysql_select_db($database_name)) {
                    $this->session->set_userdata('mysql_error', "Database not found.");
                    return $this->installation();
                }
                mysql_close();

                 // writing application/config/my_config
                  $app_my_config_data = "<?php ";
                $app_my_config_data.= "\n\$config['default_page_url'] = '".$this->config->item('default_page_url')."';\n";
                $app_my_config_data.= "\$config['product_name'] = '".$this->config->item('product_name')."';\n";
                $app_my_config_data.= "\$config['product_short_name'] = '".$this->config->item('product_short_name')."' ;\n";
                $app_my_config_data.= "\$config['product_version'] = '".$this->config->item('product_version')." ';\n\n";
                $app_my_config_data.= "\$config['institute_address1'] = '$institute_name';\n";
                $app_my_config_data.= "\$config['institute_address2'] = '$institute_address';\n";
                $app_my_config_data.= "\$config['institute_email'] = '$app_username';\n";
                $app_my_config_data.= "\$config['institute_mobile'] = '$institute_mobile';\n";
                $app_my_config_data.= "\$config['developed_by'] = '".$this->config->item('developed_by')."';\n";
                $app_my_config_data.= "\$config['developed_by_href'] = '".$this->config->item('developed_by_href')."';\n";
                $app_my_config_data.= "\$config['developed_by_title'] = '".$this->config->item('developed_by_title')."';\n";
                $app_my_config_data.= "\$config['developed_by_prefix'] = '".$this->config->item('developed_by_prefix')."' ;\n";
                $app_my_config_data.= "\$config['support_email'] = '".$this->config->item('support_email')."' ;\n";
                $app_my_config_data.= "\$config['support_mobile'] = '".$this->config->item('support_mobile')."' ;\n";
                $app_my_config_data.= "\$config['time_zone'] = '".$this->config->item('')."' ;\n";
                $app_my_config_data.= "\$config['currency'] = 'USD';\n";
                $app_my_config_data.= "\$config['language'] = '$language';\n";
                $app_my_config_data.= "\$config['sess_use_database'] = TRUE;\n";
                $app_my_config_data.= "\$config['sess_table_name'] = 'ci_sessions';\n";
                file_put_contents(APPPATH.'config/my_config.php', $app_my_config_data, LOCK_EX);
                  //writting  application/config/my_config

                  //writting application/config/database
                  $database_data = "";
                $database_data.= "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n
                    \$active_group = 'default';
                    \$active_record = true;
                    \$db['default']['hostname'] = '$host_name';
                    \$db['default']['username'] = '$database_username';
                    \$db['default']['password'] = '$database_password';
                    \$db['default']['database'] = '$database_name';
                    \$db['default']['dbdriver'] = 'mysqli';
                    \$db['default']['dbprefix'] = '';
                    \$db['default']['pconnect'] = TRUE;
                    \$db['default']['db_debug'] = TRUE;
                    \$db['default']['cache_on'] = FALSE;
                    \$db['default']['cachedir'] = '';
                    \$db['default']['char_set'] = 'utf8';
                    \$db['default']['dbcollat'] = 'utf8_general_ci';
                    \$db['default']['swap_pre'] = '';
                    \$db['default']['autoinit'] = TRUE;
                    \$db['default']['stricton'] = FALSE;";
                file_put_contents(APPPATH.'config/database.php', $database_data, LOCK_EX);
                  //writting application/config/database

                  // loding database library, because we need to run queries below and configs are already written

                  $this->load->database();
                $this->load->model('basic');
                  // loding database library, because we need to run queries below and configs are already written

                  // dumping sql
                  $dump_file_name = 'lmis_initial_db.sql';
                $dump_sql_path = 'assets/backup_db/'.$dump_file_name;
                $this->basic->import_dump($dump_sql_path);
                  // dumping sql

                  //generating hash password for admin and updaing database
                  $app_password = md5($app_password);
                $this->basic->update_data($table = "member", $where = array("user_type" => "Admin"), $update_data = array("mobile" => $institute_mobile, "email" => $app_username, "password" => $app_password, "name" => $institute_name, "status" => "1", "deleted" => "0", "address" => $institute_address));
                  //generating hash password for admin and updaing database

                  //deleting the install.txt file,because installation is complete
                  if (file_exists(APPPATH.'install.txt')) {
                      unlink(APPPATH.'install.txt');
                  }
                  //deleting the install.txt file,because installation is complete
                  redirect('home/login');
            }
        }
    }


    /**
    * method for registering user
    * @access public
    * @return void
    */
    public function registration()
    {
        $data['condition'] = $this->basic->get_data('terms_and_condition',$where='');
        $data['body'] = 'site/registration';
        $data['page_title'] = "Registration";
        $data['user_type'] = $this->get_member_types();
        $this->_site_viewcontroller($data);
    }

    /**
    * method for registration action
    * @access public
    * @return void
    */
    public function registration_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        if ($_POST) {
            $this->form_validation->set_rules('first_name',            '<b>'.$this->lang->line("first name").'</b>',        'trim|required');
            $this->form_validation->set_rules('last_name',             '<b>'.$this->lang->line("last name").'</b>',        'trim|required');
            $this->form_validation->set_rules('member_id',            '<b>'.$this->lang->line("member id").'</b>',        'trim|required|is_unique[member.member_idd]');
            $this->form_validation->set_rules('email',                 '<b>'.$this->lang->line("email").'</b>',            'trim|required|valid_email|is_unique[member.email.0]');
            $this->form_validation->set_rules('mobile',                '<b>'.$this->lang->line("mobile").'</b>',        'trim|required|is_unique[member.mobile]');
            $this->form_validation->set_rules('user_type',             '<b>'.$this->lang->line("user type").'</b>',        'trim|required');
            $this->form_validation->set_rules('password',              '<b>'.$this->lang->line("password").'</b>',            'trim|required');
            $this->form_validation->set_rules('password_confirmation', '<b>'.$this->lang->line("confirm password").'</b>',    'trim|required|matches[password]');
            $this->form_validation->set_rules('address',               '<b>'.$this->lang->line("address").'</b>',            'trim');


            if ($this->form_validation->run() == false) {
                return $this->registration();
            } else {
                $first_name = $this->input->post('first_name', true);
                $last_name = $this->input->post('last_name', true);
                $member_id = $this->input->post('member_id', true);
                $name = $first_name." ".$last_name;
                $password = $this->input->post('password', true);
                $password = md5($password);
                $email = $this->input->post('email', true);
                $mobile = $this->input->post('mobile', true);
                $address = $this->input->post('address', true);
                $user_type = $this->input->post('user_type', true);

                $data = array(
                     'name' => $name,
                     'member_idd' => $member_id,
                     'type_id' => $user_type,
                     'password' => $password,
                     'email' => $email,
                     'mobile' => $mobile,
                     'status' => '0',
                     'user_type' => "Member",
                     'address' => $address,
                     'add_date' => date("Y-m-d")
                );

                $subject = $this->config->item('product_name')." - New Member Registered";
                $message = "Hello admin <br> A new member name: ".$name.", email :".$email." has just registered to ".$this->config->item('product_name').' - '.$this->config->item('institute_address1')." and waiting for your aprroval to access the system.";

                if ($this->basic->insert_data('member', $data)) {
                    $this->_mail_sender($from = $email, $to = $this->config->item("institute_email"), $subject, $message, $mask = $this->config->item('product_name'));
                    $this->session->set_flashdata('registration_success', 1);
                    redirect('home/registration', 'location');
                }
            }
        }
    }

    /**
    * method for contacting user
    * @access public
    * @return void
    */

    public function contact()
    {
        $data['body'] = 'site/contact';
        $data['page_title'] = "Contact Us";
        $this->_site_viewcontroller($data);
    }

    /**
    * method for contacting user through
    * @access public
    * @return void
    */

    public function email_contact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        if ($_POST) {
            $this->form_validation->set_rules('email',                    '<b>'.$this->lang->line("email").'</b>',            'trim|required|valid_email');
            $this->form_validation->set_rules('subject',                  '<b>'.$this->lang->line("message subject").'</b>',            'trim|required');
            $this->form_validation->set_rules('message',                  '<b>'.$this->lang->line("message").'</b>',            'trim|required');

            if ($this->form_validation->run() == false) {
                return $this->contact();
            } else {
                $email = $this->input->post('email', true);
                $subject = $this->input->post('subject', true);
                $message = $this->input->post('message', true);

                $this->_mail_sender($from = $email, $to = $this->config->item("institute_email"), $subject, $message, $mask = $from);
                $this->session->set_flashdata('mail_sent', 1);

                redirect('home/contact', 'location');
            }
        }
    }

    /**
    * method for book function
    * @access public
    * @return void
    */

    public function book()
    {
        if (isset($_GET['search']) || isset($_GET['category_name'])) {
            $title = $this->input->get('title');
            $author = $this->input->get('author');
            $category_name = $this->input->get('category_name');

            //setting search info to session variables so that search query dont lost
            $this->session->set_userdata('public_lb_title', $title);
            $this->session->set_userdata('public_lb_author', $author);
            $this->session->set_userdata('public_lb_category_name', $category_name);
            $this->session->set_userdata('public_lb_search', 1);
        }

        //retriving search session variables
        $title = $this->session->userdata('public_lb_title');
        $author = $this->session->userdata('public_lb_author');
        $category_name = $this->session->userdata('public_lb_category_name');

        $total_rows = 0;
        $per_page = 21;
        $uri_segment = 3;
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        $select = array(
            "sum(cast(cast(book_info.status as char) as SIGNED)) as available_book",
            "book_info.number_of_books",
            "book_info.id",
            "book_info.category_id",
            "book_info.title",
            "book_info.size1 as size",
            "book_info.publishing_year",
            "book_info.publisher",
            "book_info.edition_year",
            "book_info.subtitle",
            "book_info.edition",
            "book_info.isbn",
            "book_info.author",
            "book_info.cover",
            "book_info.add_date"
            );

        if ($this->session->userdata('public_lb_search')!= 1) {
            // default search
            // $where = array("where" => array("book_info.status" => "1"));
            $book_info = $this->basic->get_data($table = "book_info", $where='', $select, $join = "", $limit = $per_page, $start = $page, $order_by = 'title ASC', $group_by = 'title, author, edition');
            $total_rows_array = $this->basic->count_row($table = "book_info", $where, $count = 'book_info.id', $join = "", $group_by = 'title, author, edition');            
            $total_rows =$total_rows_array[0]['total_rows'];
            // echo $this->db->last_query(); exit();
        
        } else {
            $where = array();
            if ($title!= "") {
                $where['where']['title like '] = "%".$title."%";
            }
            if ($author!= "") {
                $where['where']['author like'] = "%".$author."%";
            }
            if ($category_name!= "") {
                $this->db->where("FIND_IN_SET('$category_name', category_id) !=", 0);
            }
            // $where['where']['book_info.status'] = '1';
            $i=0;
            $select = array(
                "sum(cast(cast(book_info.status as char) as SIGNED)) as available_book",
                "book_info.number_of_books",
                "book_info.id",
                "book_info.category_id",
                "book_info.title",
                "book_info.size1 as size",
                "book_info.publishing_year",
                "book_info.publisher",
                "book_info.edition_year",
                "book_info.subtitle",
                "book_info.edition",
                "book_info.isbn",
                "book_info.author",
                "book_info.cover",
                "book_info.add_date"
                );

// ORDER BY CAST(`pic_number` AS SIGNED) DESC
// wf�F��)�

            $book_info = $this->basic->get_data($table = "book_info", $where, $select, $join = "", $limit = $per_page, $start = $page, $order_by = 'title ASC', $group_by = 'title, author, edition');
            // echo  $this->db->last_query(); 
            if ($category_name!= "") {
                $this->db->where("FIND_IN_SET('$category_name', category_id) !=", 0);
            }
            $total_rows_array = $this->basic->count_row($table = "book_info", $where, $count = 'book_info.id', $join = "", $group_by = 'title, author, edition');            
            // echo "<br/>".$this->db->last_query(); exit();
            $total_rows =$total_rows_array[0]['total_rows'];
            
        }


        $config['total_rows']    =   $total_rows;
        $config['base_url']    =    site_url("home/book");
        $config['per_page']    =    $per_page; // row per page
        $config["uri_segment"]    =    $uri_segment;  //depth of pagination link,here 3 (Ex- site/students/2)
        $config['next_link']    =    '>>';
        $config['prev_link']    =    '<<';
        $config['num_links']    =    5;
        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();


        $data['page_title'] = "book";
        $data['book_info'] = $book_info;
        $data['book_category'] = $this->get_all_book_category();
        $data["body"] = "site/book";

        $this->_site_viewcontroller($data);
    }

    public function get_all_book_category()
    {
        $category = array();
        $sql = "SELECT id,category_name FROM category ORDER BY category_name ASC";
        $results = $this->basic->execute_query($sql);
        foreach ($results as $row) {
            $category[$row['id']] = $row['category_name'];
        }
        return $category;
    }

    /**
    * method to login of user
    * @access public
    * @return void
    */

    public function login() //loads home view page after login (this )
    {
        if (file_exists(APPPATH.'install.txt')) {
            redirect('home/installation', 'location');
        }

        if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Admin') {
            redirect('admin/index', 'location');
        }
        if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Librarian') {
            redirect('librarian/index', 'location');
        }

        if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Member') {
            redirect('member/index', 'location');
        }

        $this->form_validation->set_rules('username', '<b>'.$this->lang->line("email").'</b>', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('password', '<b>'.$this->lang->line("password").'</b>', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->load->view('page/login');
        } else {
            $username = $this->input->post('username', true);
            $password = md5($this->input->post('password', true));

            $table = 'member';
            $where['where'] = array('email' => $username, 'password' => $password, "status" => "1");

            $info = $this->basic->get_data($table, $where, $select = '', $join = '', $limit = '', $start = '', $order_by = '', $group_by = '', $num_rows = 1);

            $count = $info['extra_index']['num_rows'];

            if ($count == 0) {
                $this->session->set_flashdata('login_msg', $this->lang->line("invalid email or password"));
                redirect(uri_string());
            } else {
                $username = $info[0]['name'];
                $user_type = $info[0]['user_type'];
                $member_id = $info[0]['member_idd'];

                $this->session->set_userdata('logged_in', 1);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('user_type', $user_type);
                $this->session->set_userdata('member_id', $member_id);

                if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Admin') {
                    redirect('admin/index', 'location');
                }

                if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Member') {
                    redirect('member/index', 'location');
                }
                if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Librarian') {
                    redirect('librarian/index', 'location');
                }
            }
        }
    }


    /**
    * method for logout of user
    * @access public
    * @return void
    */

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home/login', 'location');
    }

    /**
    * method for random number generator
    * @access public
    * @return $rand number
    * @param $length integer 6
    */

    function _random_number_generator($length = 6)
    {
        $rand = substr(uniqid(mt_rand(), true), 0, $length);
        return $rand;
    }

    /**
    * method for forgot password view page
    * @access public
    * @return void
    */

    public function forgot_password()
    {
        $data['body'] = 'page/forgot_password';
        $data['page_title'] = "Password Recovery";
        $this->_front_viewcontroller($data);
    }

    /**
    * method for code generation
    * @access public
    * @return void
    */

    public function code_genaration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }

        $email = trim($this->input->post('email'));
        $result = $this->basic->get_data('member', array('where' => array('email' => $email)), array('count(*) as num'));

        if ($result[0]['num'] == 1) {
            //entry to forget_password table
            $expiration = date("Y-m-d H:i:s", strtotime('+1 day', time()));
            $code = $this->_random_number_generator();
            $url = site_url().'home/password_recovery';

            $table = 'forget_password';
            $info = array(
                'confirmation_code' => $code,
                'email' => $email,
                'expiration' => $expiration
                );

            if ($this->basic->insert_data($table, $info)) {
                //email to user
                $message = "<p>".$this->lang->line('to reset your password please perform the following steps')." : </p>
                            <ol>
                                <li>".$this->lang->line("go to this url")." : ".$url."</li>
                                <li>".$this->lang->line("enter this code")." : ".$code."</li>
                                <li>".$this->lang->line("reset your password")."</li>
                            <ol>
                            <h4>".$this->lang->line("link and code will expire after 24 hours")."</h4>";

                $from = $this->config->item('institute_email');
                $to = $email;
                $subject = $this->config->item('product_name')." | Reset Password";
                $mask = $subject;
                $html = 1;
                $this->_mail_sender($from, $to, $subject, $message, $mask, $html);
            }
        } else {
            echo 0;
        }
    }

    /**
    * method for password recovery
    * @access public
    * @return void
    */
    public function password_recovery()
    {
        $data['body'] = 'page/password_recovery';
        $data['page_title'] = "Password Recovery";
        $this->_front_viewcontroller($data);
    }

    /**
    * method for password recovery check
    * @access public
    * @return void
    */

    public function recovery_check()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }


        if ($_POST) {
            $code = strip_tags(trim($this->input->post('code', true)));
            $newp = md5($this->input->post('newp', true));
            $conf = md5($this->input->post('conf', true));

            if($code=="" || $newp=="" || ($newp != $conf)) return false;

            $table = 'forget_password';
            $where['where'] = array('confirmation_code' => $code, 'success' => 0);
            $select = array('email', 'expiration');

            $result = $this->basic->get_data($table, $where, $select);

            if (empty($result)) {
                echo 0;
            } else {
                foreach ($result as $row) {
                    $email = $row['email'];
                    $expiration = $row['expiration'];
                }

                $now = time();
                $exp = strtotime($expiration);

                if ($now>$exp) {
                    echo 1;
                } else {
                    $this->basic->update_data('member', array('email' => $email), array('password' => $newp));
                    $this->basic->update_data('forget_password', array('confirmation_code' => $code), array('success' => 1));
                    echo 2;
                }
            }
        }
    }

    /**
    * method for getting book size
    * @access public
    * @return $return_array array
    */
    public function get_book_size()
    {
        $all_book_sizes = $this->basic->get_enum_values($table = "book_info", $column = "size1");
        foreach ($all_book_sizes as $row) {
            // $return_array[trim($row)] = trim($row);
            $return_array[trim($row)] = $this->lang->line(trim($row));
        }
        return $return_array;
    }

    /**
    * method for getting book status
    * @access public
    * @return $return_array array()
    * not used anymore
    */
    public function get_book_status()
    {
        // $all_book_status = $this->basic->get_enum_values($table = "book_info", $column = "status");
        // foreach ($all_book_status as $row) {
        //     $return_array[trim($row)] = trim($row);
        // }
        
        $return_array=array('1'=>$this->lang->line("available"),'0'=>$this->lang->line("unavailable"));
        return $return_array;
    }

    /**
    * method for getting book status
    * @access public
    * @return $category array
    */

    public function get_book_category()
    {
        $category = array();
        $table = 'category';
        $select = array('id', 'category_name');
        $results = $this->basic->get_data($table, $where = '', $select, $join = '', $limit = '', $start = '', $order_by = 'category_name asc', $group_by = '', $num_rows = 0);
        foreach ($results as $row) {
            $category[$row['id']] = $row['category_name'];
        }
        return $category;
    }

    /**
    * method for getting physical form of books
    * @access public
    * @return $return_array array
    */
    public function get_physical_form()
    {
        $all_physical_form = $this->basic->get_enum_values($table = "book_info", $column = "physical_form");
        foreach ($all_physical_form as $row) {
            $return_array[trim($row)] = $this->lang->line(trim($row));
        }
        return $return_array;
    }

    /**
    * method for getting message types send to user
    * @access public
    * @return $return_array
    */

    public function get_message_type()
    {
        $type = $this->basic->get_enum_values($table = "sms_email_history", $column = "type");
        foreach ($type as $row) {
            $return_array[trim($row)] = $this->lang->line(trim($row));
        }
        return $return_array;
    }


    /**
    * method for getting book status
    * @access public
    * @return $return_array
    */

    public function get_book_source_details()
    {
        $all_source_details = $this->basic->get_enum_values($table = "book_info", $column = "source_details");
        foreach ($all_source_details as $row) {
            $return_array[trim($row)] = $this->lang->line(trim($row));
        }
        return $return_array;
    }

    /**
    * method for getting book status
    * @access public
    * @return $member_types array()
    */
    public function get_member_types()
    {
        $classes = array();
        $table = 'member_type';
        $select = array('id', 'member_type_name');
        $member_types=array();

        $results = $this->basic->get_data($table, $where = '', $select, $join = '', $limit = '', $start = '', $order_by = '', $group_by = '',
            $num_rows = 0);

        foreach ($results as $row) {
            $member_types[$row['id']] = $row['member_type_name'];
        }
        return $member_types;
    }


    /**
    * method to config mail sender
    * @access public
    * @return boolean
    */
    function _mail_sender($from = '', $to = '', $subject = '', $message = '', $mask = "", $html = 0, $smtp = 1)
    {
        if ($from!= '' && $to!= '' && $subject!='' && $message!= '') {
            if (!is_array($to)) {
                $to=array($to);
            }

            if ($smtp == '1') {
                $where2 = array("where" => array('status' => '1'));
                $email_config_details = $this->basic->get_data("email_config", $where2, $select = '', $join = '', $limit = '', $start = '',
                                                        $group_by = '', $num_rows = 0);

                if (count($email_config_details) == 0) {
                    $this->load->library('email');
                } else {
                    foreach ($email_config_details as $send_info) {
                        $send_email = trim($send_info['email_address']);
                        $smtp_host = trim($send_info['smtp_host']);
                        $smtp_port = trim($send_info['smtp_port']);
                        $smtp_user = trim($send_info['smtp_user']);
                        $smtp_password = trim($send_info['smtp_password']);
                    }

            /*****Email Sending Code ******/
                $config = array(
                  'protocol' => 'smtp',
                  'smtp_host' => "{$smtp_host}",
                  'smtp_port' => "{$smtp_port}",
                  'smtp_user' => "{$smtp_user}", // change it to yours
                  'smtp_pass' => "{$smtp_password}", // change it to yours
                  'mailtype' => 'html',
                  'charset' => 'utf-8',
                  'newline' =>  '\r\n',
                  'smtp_timeout' => '30'
                 );

                    $this->load->library('email', $config);
                }
            } /*** End of If Smtp== 1 **/

            if (isset($send_email) && $send_email!= "") {
                $from = $send_email;
            }
            $this->email->from($from, $mask);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
            if ($html == 1) {
                $this->email->set_mailtype('html');
            }

            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
    * method to sent sms
    * @access public
    * @return boolean
    */

    function _sms_sender($message = '', $mobile = '')
    {
        if ($message!= '' && $mobile!= '') {
            $this->sms_manager->send_sms($message, $mobile);
            return true;
        } else {
            return false;
        }
    }


    /**
    * method to get language
    * @access public
    * @return array
    */
    function _language_list() 
     {
         $language = array
         (
            "arabic"=>"Arabic",
            "bengali"=>"Bengali",
            "chinese"=>"Chinese",
            "dutch"=>"Dutch",
            "english"=>"English (Default)",
            "french"=>"French",
            "german"=>"German",
            "georgian"=>"Georgian",
            "hindi"=>"Hindi",
            "italian"=>"Italian",
            "japanese"=>"Japanese",
            "portuguese"=>"Portuguese",
            "russian"=>"Russian",
            "spanish"=>"Spanish"
         );
         return $language;
     }









    // ***************************************************************** //

    function get_general_content($url,$proxy=""){
            
            
            $ch = curl_init(); // initialize curl handle
           /* curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);*/
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
            curl_setopt($ch, CURLOPT_AUTOREFERER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7);
            curl_setopt($ch, CURLOPT_REFERER, 'http://'.$url);
            curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
            curl_setopt($ch, CURLOPT_TIMEOUT, 50); // times out after 50s
            curl_setopt($ch, CURLOPT_POST, 0); // set POST method

         
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
            curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
            
            $content = curl_exec($ch); // run the whole process
            
            curl_close($ch);
            
            return $content;
            
    }
    

    public function important_feature(){

         if(file_exists(APPPATH.'/config/licence.txt') && file_exists(APPPATH.'/core/licence.txt')){
            $config_existing_content = file_get_contents(APPPATH.'/config/licence.txt');
            $config_decoded_content = json_decode($config_existing_content, true);

            $core_existing_content = file_get_contents(APPPATH.'/core/licence.txt');
            $core_decoded_content = json_decode($core_existing_content, true);

            if($config_decoded_content['is_active'] != md5($config_decoded_content['purchase_code']) || $core_decoded_content['is_active'] != md5(md5($core_decoded_content['purchase_code']))){
              redirect("home/credential_check", 'Location');
            }
            
        } else {
            redirect("home/credential_check", 'Location');
        }


    }


    public function credential_check()
    {
        $data['body'] = 'front/credential_check';
        $data['page_title'] = "Credential Check";
        $this->_front_viewcontroller($data);
    }

    public function credential_check_action()
    {
        $domain_name = $this->input->post("domain_name",true);
        $purchase_code = $this->input->post("purchase_code",true);
        $only_domain = get_domain_only($domain_name);
        // $only_domain = "xeroneit.ne";
       
       $response=$this->code_activation_check_action($purchase_code,$only_domain);

       echo $response;

    }


    

    public function code_activation_check_action($purchase_code,$only_domain){

         $url = "http://xeroneit.net/development/envato_license_activation/purchase_code_check.php?purchase_code={$purchase_code}&domain={$only_domain}&item_name=ssem";

        $credentials = $this->get_general_content($url);
        $decoded_credentials = json_decode($credentials);
        if($decoded_credentials->status == 'success'){
            $content_to_write = array(
                'is_active' => md5($purchase_code),
                'purchase_code' => $purchase_code,
                'item_name' => $decoded_credentials->item_name,
                'buy_at' => $decoded_credentials->buy_at,
                'licence_type' => $decoded_credentials->license,
                'domain' => $only_domain,
                'checking_date'=>date('Y-m-d')
                );
            $config_json_content_to_write = json_encode($content_to_write);
            file_put_contents(APPPATH.'/config/licence.txt', $config_json_content_to_write, LOCK_EX);

            $content_to_write['is_active'] = md5(md5($purchase_code));
            $core_json_content_to_write = json_encode($content_to_write);
            file_put_contents(APPPATH.'/core/licence.txt', $core_json_content_to_write, LOCK_EX);

            return json_encode("success");

        } else {
            if(file_exists(APPPATH.'/core/licence.txt')) unlink(APPPATH.'/core/licence.txt');
            return json_encode($decoded_credentials);
        }
    }

    public function periodic_check(){

        $today= date('d');

        if($today%7==0){

          if(file_exists(APPPATH.'/config/licence.txt') && file_exists(APPPATH.'/core/licence.txt')){
                $config_existing_content = file_get_contents(APPPATH.'/config/licence.txt');
                $config_decoded_content = json_decode($config_existing_content, true);
                $last_check_date= $config_decoded_content['checking_date'];
                $purchase_code  = $config_decoded_content['purchase_code'];
                $base_url = base_url();
                $domain_name    = get_domain_only($base_url);

                if( strtotime(date('Y-m-d')) != strtotime($last_check_date)){
                    $this->code_activation_check_action($purchase_code,$domain_name);         
                }
        }
     }
  }





  
}
