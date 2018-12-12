<?php class Reminders extends CI_Controller { public function __construct() { parent::__construct(); $this->load->library('input');
    $this->load->library('email');
    $this->load->model('expiry_model');
  }
  public function index()
  {
      
    if(!$this->input->is_cli_request())
  {
      echo "This script can only be accessed via the command line" . PHP_EOL;
      return;
  }
  $timestamp = strtotime("now");
  $appointments = $this->expiry_model->get_days_appointments($timestamp);
  if(!empty($appointments))
  {
      foreach($appointments as $appointment)
      {
          $diff = abs(strtotime("$appointment->expire_date") - strtotime("now"));
          $years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
          $this->email->set_newline("\r\n");
          $this->email->to($appointment->email);
          $this->email->from("lms@team-shanta.com");
          $this->email->subject("Book return Reminder");
          $this->email->message("Hello,\n \nYour borrowed book '$appointment->title' issued on $appointment->issue_date.Last date of return the book is $appointment->expire_date. Only $days day remaining. Please return the book before deadline. Thank you.");
          $this->email->send();
      }
  }

  $expired = $this->expiry_model->get_days_expired($timestamp);
  if(!empty($expired))
  {
      foreach($expired as $appointment)
      {
          $diff = abs(strtotime("now") - strtotime("$appointment->expire_date"));
          $years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
          $this->email->set_newline("\r\n");
          $this->email->to($appointment->email);
          $this->email->from("lms@team-shanta.com");
          $this->email->subject("Book return Reminder");
          $this->email->message("Hello,\n \nYour borrowed book '$appointment->title' issued on $appointment->issue_date deadline is expired $days days ago. Please return the book. Thank you.");
          $this->email->send();
      }
  }
  }
}