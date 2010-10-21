<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
		$this->load->model('Main_model');
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		//$this->output->enable_profiler(TRUE);	
	}
	
	function index()
		{		
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
		//$cookie = $this->get_facebook_cookie(FACEBOOK_APP_ID, FACEBOOK_SECRET);
		
		//$data['cookie'] = $this->get_facebook_cookie(FACEBOOK_APP_ID, FACEBOOK_SECRET);
		$data['title'] = "Welcome to TheGigBazaar";
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/main/index/";
		if($this->session->userdata('logged_in') == TRUE)
		{
			$this->db->where('member_posted_by !=',$this->session->userdata('id'));
		}
		$this->db->where('approved','y');
		$this->db->where('member_disabled','n');
		$config['total_rows'] = $this->db->get('gigs')->num_rows();
		$config['per_page'] = '5';
		$config['num_links'] = '10'; 
		$this->pagination->initialize($config);
		$data['gigs'] = $this->Main_model->gig_listing_homepage(5,$this->uri->segment(3),'hot');
		$data['pagination'] = $this->pagination->create_links();
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$this->load->view('header',$data);
		$this->load->view('main_view',$data);
		$this->load->view('footer');
	}
	
	
	function login()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			redirect('main/index');
		}
		$data['title'] = "TheGigBazaar | Login";
		$data['error'] = "";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
		$this->load->view('header',$data);
		$this->load->view('login',$data);
		$this->load->view('footer');
		
	}
	function signup()
	{
		$data['error'] = "";
		$data['title'] = "TheGigBazaar | Signup";
		$data['category'] = $this->Common_model->get_categories();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
			$fbdata = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);  
		if($fbdata['user_id'])
		{
			$this->load->view('fbsignup',$data);
		}
		else {
			$this->load->view('signup',$data);
		}
		$this->load->view('footer');
	}
	
	function verify()
	{
		$error = "0";
		$this->load->library('form_validation');
		//Add the data to the database
			$this->form_validation->set_rules('username', 'Username', 'required');
			$fbdata = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
			if($fbdata['user_id'] == '')
			{			
			$this->form_validation->set_rules('password', 'Password', 'required|matches[password1]');
			$this->form_validation->set_rules('password1', 'Password Confirmation', 'required');
			}
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				if ($this->form_validation->run() == FALSE)
				{
						$data['error'] = "";
						$data['title'] = "TheGigBazaar | Signup";
						$data['category'] = $this->Common_model->get_categories();
						$data['unread'] = $this->Common_model->message_unreadcount();
						$data['fbdata'] = array(
									'user'		=> $this->facebook_connect->user,
									'user_id'	=> $this->facebook_connect->user_id,
							);
						$this->load->view('signup',$data);
						$this->load->view('footer');
				}
				else {
						//check if the username and password already exists	
						$this->db->where('member_username',$this->input->post('username'));
						$query = $this->db->get('members');
						if($query->num_rows() > 0)
						{
							$error = '1';
						}
						$this->db->where('member_email',$this->input->post('email'));
						$query1 = $this->db->get('members');
						if($query1->num_rows() > 0)
						{
							$error = '1';
						}					
						
						if($error == '1')
						{
								$data['error'] = "<div class='form-error'><p>We already have a user with this username or email address.</p></div>";
								$data['title'] = "TheGigBazaar | Signup";
								$data['category'] = $this->Common_model->get_categories();
								$data['unread'] = $this->Common_model->message_unreadcount();
									$data['fbdata'] = array(
												'user'		=> $this->facebook_connect->user,
												'user_id'	=> $this->facebook_connect->user_id,
										);
								$this->load->view('signup',$data);
								$this->load->view('footer');
						}
						else {
							//New user
								$member_add = $this->Main_model->add_member();
								$username = $this->input->post('username');
								$data['category'] = $this->Common_model->get_categories();
								$data['unread'] = $this->Common_model->message_unreadcount();
									if($fbdata['user_id'] == '')
									{
										$data['title'] = "TheGigBazaar | Verify your email address";
										$data['fbdata'] = array(
													'user'		=> $this->facebook_connect->user,
													'user_id'	=> $this->facebook_connect->user_id,
											);
										$this->load->view('verify',$data);
										$this->load->view('footer');
									}
									else {		
										$this->db->where('member_facebook',$fbdata['user']['uid']);
										$q = $this->db->get('members');
										$r = $q->row();								
										$data = array(
									                 'username'  => $r->member_username,
																	 'logged_in'  => TRUE,
																		'id' => $r->id
																	  );
											$this->session->set_userdata($data);
											redirect('http://dev.thegigbazaar.com');
									}	
						}
					
				}
	
	}
	
	function contact($id)
	{
		if($this->session->userdata('logged_in') != TRUE)
		{
			redirect('main/login');
		}
		else {			
			  if($id == $this->session->userdata('id'))
				{
					$this->session->set_flashdata('message', '<div class="form-error"><p>You cannot send a message to yourself</p></div>');
					redirect('main/index');
				}
				$data['id'] = $id;
				$data['title'] = "Send Message";
				$data['category'] = $this->Common_model->get_categories();
				$data['unread'] = $this->Common_model->message_unreadcount();		
				$data['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
				$this->load->view('header',$data);		
				$this->load->view('member/send_message',$data);
				$this->load->view('footer');
			
		}
		
	}
	function send_contact()
	{
		$to = $this->input->post('id');
		$detail = $this->Common_model->get_member_info($to);
		$email = $detail['email'];
		
		$from = $this->session->userdata('id');
		$from_detail = $this->Common_model->get_member_info($to);
		$from_name = $from_detail['name'];
		$message = $this->input->post('contact');		
		
			$date = date('Y-m-d');
			$data = array('message_from'=>$from,'message_to'=>$to,'message'=>$message,'message_sent'=>$date,'message_reply_to'=>'new');
			$this->db->insert('messages',$data);
		
				$this->load->library('email');
				$config['mailtype'] = 'html';	
				$this->email->initialize($config);
				$this->email->from('support@thegigbazaar.com', 'thegigbazzar.com');
				$this->email->to($email);

				$this->email->subject('You have a new message : thegigbazzar.com');
				$this->email->message('Hi, <br/><br/> You have a new message sent to you from a user on thegigbazaar.com:<br/><br/>
				'.$message.'
				<br><br>You are becoming popular on our website. Congrats.<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
				$this->email->send();
				$this->session->set_flashdata('message', '<div class="form-success">Message has been sent.</div>');
				redirect('main/contact/'.$to);
		
		
		
	}
	
	function about()
	{
		$data['title'] = "TheGigBazaar | About us";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('about',$data);
		$this->load->view('footer');

	}
	
	function faq()
	{
		$data['title'] = "TheGigBazaar | FAQ";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('faq',$data);
		$this->load->view('footer');
	
	}
	
	function favorite()
	{
			$data['title'] = "TheGigBazaar | Favourites";
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$this->load->library('pagination');
			$config['base_url'] = base_url()."index.php/main/favorite";
			$this->db->where('approved','y');
			$this->db->where('member_disabled','n');
			$config['total_rows'] = $this->db->get('gigs')->num_rows();
			$config['per_page'] = '10';
			$config['num_links'] = '10'; 
			$this->pagination->initialize($config);
			$data['gigs'] = $this->Main_model->gig_listing_homepage(10,$this->uri->segment(3),'fav');
			$data['pagination'] = $this->pagination->create_links();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('favourite',$data);
			$this->load->view('footer');	
	}
	function recent()
	{
		echo $this->session->userdata('id');
			$data['title'] = "TheGigBazaar | Recently Posted Gigs";
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$this->load->library('pagination');
			$config['base_url'] = base_url()."index.php/main/recent";
			$this->db->where('approved','y');
			$this->db->where('member_disabled','n');
			$config['total_rows'] = $this->db->get('gigs')->num_rows();
			$config['per_page'] = '5';
			$config['num_links'] = '10'; 
			$this->pagination->initialize($config);
			$data['gigs'] = $this->Main_model->gig_listing_homepage(5,$this->uri->segment(3),'recent');
			$data['pagination'] = $this->pagination->create_links();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('recent',$data);
			$this->load->view('footer');	
	}
	
	function terms()
	{
		$data['title'] = "TheGigBazaar | Terms of Service";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('terms',$data);
		$this->load->view('footer');
	}
	function get_facebook_cookie($app_id, $application_secret) {
	  $args = array();
	  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
	  ksort($args);
	  $payload = '';
	  foreach ($args as $key => $value) {
	    if ($key != 'sig') {
	      $payload .= $key . '=' . $value;
	    }
	  }
	  if (md5($payload . $application_secret) != $args['sig']) {
	    return null;
	  }
	  return $args;
	}
	
	function fbtest()
	{
			$this->load->library('facebook_connect');
			
			$data['fb'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
						
					);

			// This is how to call a client API methods
			//
			//$this->facebook_connect->client->feed_registerTemplateBundle($one_line_story_templates, $short_story_templates, $full_story_template);
			//$this->facebook_connect->client->events_get($data['user_id']);

			$this->load->view('fbtest', $data);
	}
	function dbbackup()
	{
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup(); 
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		$date = date('Ymd');
		write_file('../backup/thegigbazaar'.$date.'.zip', $backup); 
		// Load the download helper and send the file to your desktop
		//$this->load->helper('download');
		//force_download('multitude'.$date.'.zip', $backup);
		$this->load->library('email');
		$config['mailtype'] = "html";		
		$this->email->initialize($config);
		
		
		$this->email->from('admin@thegigbazaar.com', 'Multitude Backup');
		$this->email->to('h.sanat@live.com');
		$this->email->cc('cybersunil03@hotmail.com');
		$date1 = date('Y-m-d');
		$this->email->subject('Thegigbazaar Backup');
			$this->email->attach('../backup/thegigbazaar'.$date.'.zip');	
		$this->email->message('Backup for Date '.$date1);	
		
		$this->email->send();
		//Now delete the file
		//unlink('../backup/multitude'.$date.'.zip');
		echo $this->email->print_debugger();
		
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */