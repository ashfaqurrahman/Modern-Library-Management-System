<?php


require_once("home.php"); // loading home controller

/**
* @category controller
* class Admin
*/

class update extends Home
{
      
    public function __construct()
    {
        parent::__construct();     
        $this->upload_path = realpath(APPPATH . '../upload');
        $this->user_id=$this->session->userdata('user_id');
        set_time_limit(0);
    }


    public function index()
    {
        $this->v2_5to_v2_6();
    }

  

    public function v2_5to_v2_6()
    {

        $lines="ALTER TABLE `book_info` CHANGE `cover` `cover` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'cover_default.jpg';
        ALTER TABLE `book_info` CHANGE `is_uploaded` `is_uploaded` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0'";
       
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "LMS has been updated to v2.6 successfully.".$count." queries executed.";
     
    }




    function delete_update()
    {
        unlink(APPPATH."controllers/update.php");
    }
 


}
