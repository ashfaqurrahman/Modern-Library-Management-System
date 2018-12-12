<?php

/**
	*Class Sms_manager
	*@category Custom Codeigniter Library
	*@author     	M.M.Muraduzzaman (konok@xeroneit.net)
	
*/

class Sms_manager{

    protected $user;
    protected $password;
    protected $recepients=array();
	protected $api_id; /**This is for clickatell gateway**/
	
	/**
	* Constructor set the CI instances
	* This is just for loading CodeIgniter instances
*/
	
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->database();
	}	

    /**
	* execute cURL for any http request
	* @access protected
	* @param string
	* @return string/json/array as per the API 
	*/
	
    private function run_curl($url)
    {
        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
	    curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");  
	   	curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");  
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 

        // grab URL and pass it to the browser
        $response=curl_exec($ch);

        // close cURL resource, and free up system resources

        curl_close($ch);
		
		return $response;
		
    }

	/**
		*set credential of the SMS gateway
		* @param string (username/auth id of the api) 
		* @param string (password or auth token of the api)
		* @param string (api id of the api , specially for clickatell)
	*/
    public function set_credentioal($user,$password,$api_id='') /**$api_id is for clickatell gateway***/
    {
        $this->user= $user;
        $this->password = $password;
		$this->api_id=$api_id;
    }
	
	/**
	* send sms
	* @param string
	* @param string or array (both will be supported)
	*/
    public function send_sms($msg, $recepient)
    {
		$q="select * from sms_config";
		$query=$this->CI->db->query($q);
		$results=$query->result_array();		
		$msg=urlencode($msg);

		if(count($results)==0) return false;
		
		foreach($results as $info)
		{
			$gateway=$info['name'];
			$auth_id=$info['auth_id'];
			$token=$info['token'];
			$phone_number=$info['phone_number'];
			$api_id=$info['api_id'];
		}
		
		$this->set_credentioal($auth_id,$token,$api_id);
		
		 if(!is_array($recepient)){
            	$recepient = array($recepient);
        	}
			
		/****** Planet IT SMS Manager ******/
		 if($gateway=='planet'){
	        $str_recepient = implode(',',$recepient);
			$msg = str_replace(' ','%20',$msg);
	        $mask= urlencode("Xerone IT");
			$msg= urlencode($msg);
		   $api_url="http://app.planetgroupbd.com/api/sendsms/plain?user={$this->user}&password={$this->password}&sender={$mask}&SMSText={$msg}&GSM={$str_recepient}";
	       $this->run_curl($api_url);
		 }
	
	
		if($gateway=='plivo'){	
			foreach($recepient as $to_number){
				$this->plivo_sms_send($phone_number,$to_number,$msg);
			}
		}

		if($gateway=='twilio'){
			foreach($recepient as $to_number){
				$this->twilio_sms_sent($phone_number,$to_number,$msg);
			}
		}
		
		if($gateway=='2-way'){
			foreach($recepient as $to_number){
				$this->send_sms_2way($to_number,$msg);
			}
		}
		
		if($gateway=='clickatell'){
				$this->clickatell_send_sms($recepient,$msg);
		}
		
		if($gateway=='nexmo'){
			foreach($recepient as $to_number){
				$message_info	= $this->nexmo_send_sms($phone_number,$to_number,$msg);
			}	 	
		}
		
		
    }
	
	/**
	* send sms through plivo sms gateway
	* @param string
	* @param string
	* @param string
	* @return json
*/
	public function plivo_sms_send($src,$dst,$text){
		# Plivo AUTH ID
		$AUTH_ID = $this->user;
		# Plivo AUTH TOKEN
		$AUTH_TOKEN = $this->password;
		
		$url = 'https://api.plivo.com/v1/Account/'.$AUTH_ID.'/Message/';
		$data = array("src" => "$src", "dst" => "$dst", "text" => "$text");
		$data_string = json_encode($data);
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HEADER, 0);  
	    	 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
	     	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
	     	 curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");  
	    	 curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");  
	     	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
	     	 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");  
		curl_setopt($ch, CURLOPT_USERPWD, $AUTH_ID . ":" . $AUTH_TOKEN);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$response = curl_exec( $ch );
		curl_close($ch);
		return $response;
	}
	
	/**
	* send sms through Twilio SMS Gateway 
	* @param string
	* @param string
	* @param string
	* @return json
*/
	public function twilio_sms_sent($from,$to,$text){
		require "twilio-php/Services/Twilio.php";
		// set your AccountSid and AuthToken from www.twilio.com/user/account
		$client = new Services_Twilio($this->user, $this->password);
		$message = $client->account->messages->create(array(
		    "From" => $from,
		    "To" => $to,
		    "Body" => $text,
		));
		return $message->id;
	 }
	 
	 public function send_sms_2way($to,$text){
	 	
		$api_code=$this->user;
		$token=$this->password;
			 
		$url = "http://www.2-waysms.com/api/{$api_code}/send.php";
			$postfields = array(
				'token' => "$token",
				'to' => "$to",
				'text' => "$text"
			);
		
			if (!$curld = curl_init()) {
				exit;
			}
			curl_setopt($curld, CURLOPT_POST, true);
			curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
			curl_setopt($curld, CURLOPT_URL,$url);
			curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
					
			$output = curl_exec($curld);
			curl_close ($curld);
			return $output;
	}
	
	/**
	* send sms through Clickatell SMS Gateway
	* @param string
	* @param string
	* @param string
	* @return json
*/
	
	/*** Pass the $to_numbers as array. Clickatell will send more numbers at a time with comma separated ****/
	function clickatell_send_sms($to_numbers,$msg){
		$msg=urldecode($msg);	
		/***** $to_numbers converted to array then implode it by commaseparated ****/
		 if(!is_array($to_numbers)){
            	$to_numbers = array($to_numbers);
        	}
		$to_numbers=implode(",",$to_numbers);	
		$url="http://api.clickatell.com/http/sendmsg?user={$this->user}&password={$this->password}&api_id={$this->api_id}&to={$to_numbers}&text={$msg}";
		$response = $this->run_curl($url);
		return $response;
	}
	
	
	/**
	* send sms through Nexmo SMS Gateway
	* @param string
	* @param string
	* @param string
	* @return json
*/

	function nexmo_send_sms($from,$to_number,$msg){
	
		 $url="https://rest.nexmo.com/sms/json?api_key={$this->user}&api_secret={$this->password}&from={$from}&to={$to_number}&text={$msg}&type=text";
		
		$response=$this->run_curl($url);
		$result=json_decode($response,TRUE);
		
		if(isset($result['messages'][0]['message-id']))
			$message_info['id']=$result['messages'][0]['message-id'];
		else
			$message_info['id']="";
			
			
		if(isset($result['messages'][0]['status']) && $result['messages'][0]['status']=='0' ){
			$message_info['status']="Sent";
			return $message_info;
		}	
		else
			$message_info['status']="";
			
		
			
		if(isset($result['messages'][0]['error-text']))	
			$message_info['status']=$result['messages'][0]['error-text'];
		else
			$message_info['status']="";
			
		return $message_info;
	}
	
	
	
	
	
}



?>