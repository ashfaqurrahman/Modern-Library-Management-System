<?php  if (! defined('BASEPATH')) {
     exit('No Direct Script Access Allowed');
 }

class Expiry_model extends CI_Model
{
  public function get_days_appointments($day)
  {
    $day_start = date('Y-m-d', $day);
    return $this->db->select('*')
      ->from('circulation')
      ->join('member', 'member.member_idd=circulation.member_id', 'left')
      ->join('book_info', 'book_info.id=circulation.book_id', 'left')
      ->where('expire_date >', $day_start) ->where('is_returned <', 1)
      ->get()->result();
       
  }
  public function get_days_expired($day)
  {
    $day_start = date('Y-m-d', $day);
    return $this->db->select('*')
      ->from('circulation')
      ->join('member', 'member.member_idd=circulation.member_id', 'left')
      ->join('book_info', 'book_info.id=circulation.book_id', 'left')
      ->where('expire_date <', $day_start) ->where('is_returned <', 1)
      ->get()->result();
       
  }
}