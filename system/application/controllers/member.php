<?php

class Member extends Controller {

	function Member()
	{
		parent::Controller();	
		//$this->output->enable_profiler(TRUE);	
		$this->load->model('Member_model');
	
	}
	
	function index()
	{
		redirect('main/index');
	}
	function login()
	{
		//check the login details are correct
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		//Check if the username and password exists 
		$this->db->where('member_username',$username);
		$this->db->where('member_password',$password);
		$query = $this->db->get('members');
		
		if($query->num_rows() > 0)
		{
			//Check if member is activated
			$row = $query->row();
			$verified = $row->member_verified;
			$level = $row->level;
			$id = $row->id;
			$name = $row->member_name;
			$banned = $row->banned;
			if($name == "")
			{
				$name = $username;
			}
			else {
				$name = $row->member_name;
			}
			if($verified == 'y' and $banned == 'n')
			{
					 $data = array(
		                   'username'  => $name,
											 'logged_in'  => TRUE,
											 'level' => $level,
												'id' => $id
											  );

		      $this->session->set_userdata($data);
					$referrer = $_SERVER['HTTP_REFERER'];
			
						redirect('main/index');
					
			}
			else {
				if($banned == 'n')
				{
						$this->session->set_flashdata('message', '<div class="form-error">Your account has been banned by the administrator.</div>');
				}
				else {
									$this->session->set_flashdata('message', '<div class="form-success">Your account is not yet verified.Please check your email and click on the verification link.</div>');
				}
				redirect('main/login/');
			}
		}
		else {
					$data['error'] = "<p>Login details are incorrect</p>";
					$data['title'] = "TheGigBazaar | Login";
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
	}
	function logout()
	{
	    $this->session->sess_destroy();
	    redirect('main/index');
	}
	
	function verify($uniid)
	{
		//Check if the email and id match
		$unique = $uniid;
		$this->db->where('member_verification',$unique);
		$query = $this->db->get('members');
		
		//check if the userid is already verified
		$row = $query->row();
		$verified = $row->email_verified;
		if($verified == "y")
		{
				$this->session->set_flashdata('message', '<div class="form-success">Email address is already verified.</div>');
				redirect('member/verified/');
		}
		
		if($query->num_rows() > 0)
		{
		//Update the database
			$data = array( 'email_verified' => 'y','member_verified'=>'y');
		//	$this->db->where('member_email',$email);
			$this->db->where('member_verification',$uniid);
			$this->db->update('members', $data);
			//If they do then, tell the user that the email address is verify
			$this->session->set_flashdata('message', '<div class="form-success">Email Address Verified.You can now <a href='.site_url('main/login').'>log in</a> and access your account.</div>');
			redirect('member/verified/');
		}
		else {
			//If they do then, tell the user that the email address is verify
			$this->session->set_flashdata('message', '<div class="form-success">We cannot match your email address and your unique verification code.<br/>If you think this is a mistake, please contact us.We will fix it.</div>');
			redirect('member/verified/');
		}
		
		
	}
	
	function verified()
	{
			$data['title'] = "TheGigBazaar | Email Address Verified";
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('verified',$data);
			$this->load->view('footer');
		
	}
	
	function forgotpassword()
	{
				$data['title'] = "TheGigBazaar | Forgot Password";
				$data['category'] = $this->Common_model->get_categories();
				$data['unread'] = $this->Common_model->message_unreadcount();
				$data['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
				$this->load->view('header',$data);
				$this->load->view('forgotpassword',$data);
				$this->load->view('footer');
	}
	
	function forgot()
	{
				$email = $this->input->post('email');
				//Now we have the email address check if the email exists
				$check = $this->Member_model->check_email($email);

				if($check == "failed")
				{						
						//The email address does not exist.Load Error and display to user
								$this->session->set_flashdata('message', '<div class="form-error"><p>The email address you provided did not match any of our records.</p></div>');
						    redirect('member/forgotpassword');

				}
				else {
					//Now check if the user is activated or not
						$check_activated = $this->Member_model->check_activated($email);
						if($check_activated == "yes")
						{				
						//The Email address does exist
						//Now email the data to user
						$email_pass = $this->email_link($email);

		$this->session->set_flashdata('message', '<div class="form-success"><p>Your password has been emailed to you. Please check your email address</p></div>');
						redirect('member/forgotpassword');
						}
						else {
								$this->session->set_flashdata('message', '<div class="form-error"><p>Our records indicate that your account is not yet activated.If you think this is a error please contact us</p></div>');

						redirect('member/forgotpassword');

						}
				}
	}
	function email_link($email)
		{
			$password = "";
			
			$this->db->where('member_email',$email);
			$query =	$this->db->get('members');
			$row = $query->row();
			
			$password = $row->member_password;
			$username = $row->member_username;
			//Email Functionality Comes here
				$this->load->library('email');
				$config['mailtype'] = 'html';	
				$this->email->initialize($config);
				$this->email->from('support@thegigbazaar.com', 'thegigbazzar.com');
				$this->email->to($email);

				$this->email->subject('Your new password : thegigbazzar.com');
				$this->email->message('Hi, <br><br>Someone(hopefully you) requested our system to email your password. <br/><br/> Your password is:<br/>'.$password.'<br><br>Your username is:<b>'.$username.'</b><br><br>If you wish the change the password, please login and click on <b>Change Password</b>.<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
				$this->email->send();
			}
			
			function gigs()
			{
				//Get the current user id from the session
					$id = $this->session->userdata('id');
					$data['id'] = $this->session->userdata('id');
					$data['title'] = "TheGigBazaar | Items you are selling";
					$data['category'] = $this->Common_model->get_categories();
					$data['unread'] = $this->Common_model->message_unreadcount();
					$data['selling'] =  $this->Member_model->item_selling($id);
					$data['fbdata'] = array(
								'user'		=> $this->facebook_connect->user,
								'user_id'	=> $this->facebook_connect->user_id,
						);
					$this->load->view('header',$data);
					$this->load->view('member/selling',$data);
					$this->load->view('footer');
			}
			
			function foryou()
			{
				$id = $this->session->userdata('id');$data['id'] = $this->session->userdata('id');
				$data['title'] = "TheGigBazaar | Items you are selling";
				$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
				$data['foryou'] =  $this->Member_model->gigs_foryou($id);
				$data['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
				$this->load->view('header',$data);
				$this->load->view('member/foryou',$data);
				$this->load->view('footer');
				
			}
			
			function ordered()
			{				
				$id = $this->session->userdata('id');$data['id'] = $this->session->userdata('id');
				$data['title'] = "TheGigBazaar | Items you are selling";
				$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
				$data['ordered'] =  $this->Member_model->gigs_ordered($id);
				$data['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
				$this->load->view('header',$data);
				$this->load->view('member/ordered',$data);
				$this->load->view('footer');
				
			}
			
			function settings()
			{
				if ($this->session->userdata('id') == "")
				{
				     redirect('main/');
						$this->session->sess_destroy();
				}
						
					$id = $this->session->userdata('id');
					$data['title'] = "TheGigBazaar | Edit Profile";
					$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
					$data['member_detail'] =  $this->Member_model->get_member_detail($id);
					$data['fbdata'] = array(
								'user'		=> $this->facebook_connect->user,
								'user_id'	=> $this->facebook_connect->user_id,
						);
						$data['id'] = $this->session->userdata('id');
					$this->load->view('header',$data);
					$this->load->view('member/settings',$data);
					$this->load->view('footer');
			}
			
			function modify()
			{
				$check_validation = "0";
				$update_email = "0";
				$update_password = "0";
				//Check if the passwords matches if something is entered
				$this->load->library('form_validation');
				if($this->input->post('password') != "")
				{
					//check if they match each other
											
						$this->form_validation->set_rules('password', 'Password', 'matches[password1]');
						$this->form_validation->set_rules('password1', 'Password Confirmation', 'required');		
				
				}
			
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
					$this->form_validation->set_rules('name', 'Name', 'required');
					$this->form_validation->set_rules('description', 'Description', 'required');
				
						if ($this->form_validation->run() == FALSE)
						{
								$data['title'] = "TheGigBazaar | Update Details";
								$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
								$data['fbdata'] = array(
											'user'		=> $this->facebook_connect->user,
											'user_id'	=> $this->facebook_connect->user_id,
									);
									$data['id'] = $this->session->userdata('id');
								$this->load->view('header',$data);
								$this->load->view('member/settings',$data);
								$this->load->view('footer');
						}
						else {
						if($this->input->post('password') == "")
						{
							$data = array(
								'member_email' => $this->input->post('email'),
								
								'member_name' => $this->input->post('name'),
								'member_description' =>$this->input->post('description')
						 		);
						}
						else {
							$data = array(
								'member_email' => $this->input->post('email'),
								'member_password' => $this->input->post('password'),
								'member_name' => $this->input->post('name'),
								'member_description' =>$this->input->post('description')
						 		);
						}
												
						$this->db->where('id',$this->session->userdata('id'));
						$this->db->update('members',$data);
						$this->session->set_flashdata('message', '<div class="form-success">Your details have been updated</div>');
						redirect('member/settings');
						
						}			
				 
			}
			
			function payment()
			{			
					if ($this->session->userdata('id') == "")
					{
					     redirect('main/');
							$this->session->sess_destroy();
					}
						$id = $this->session->userdata('id');
						$data['title'] = "TheGigBazaar | Payment Settings";
						$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
						$data['member_detail'] =  $this->Member_model->get_member_detail($id);
						$data['withdraw'] = $this->Member_model->withdraw();
						$data['fbdata'] = array(
									'user'		=> $this->facebook_connect->user,
									'user_id'	=> $this->facebook_connect->user_id,
							);
							$data['id'] = $this->session->userdata('id');
						$this->load->view('header',$data);
						$this->load->view('member/payment',$data);
						$this->load->view('footer');
				
			}
			
			function updatepaypal()
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('paypalemail', 'Paypal', 'required|valid_email');
					if ($this->form_validation->run() == FALSE)
					{
						$data['id'] = $this->session->userdata('id');
						$id = $this->session->userdata('id');
							$data['title'] = "TheGigBazaar | Update Details";
							$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
							$data['member_detail'] =  $this->Member_model->get_member_detail($id);
							$data['withdraw'] = $this->Member_model->withdraw();
							$data['fbdata'] = array(
										'user'		=> $this->facebook_connect->user,
										'user_id'	=> $this->facebook_connect->user_id,
								);
							$this->load->view('header',$data);
						
							$this->load->view('member/payment',$data);
							$this->load->view('footer');
					}
					else {
						//Check if the email address already exists 
						$this->db->where('member_paypal',$this->input->post('paypalemail'));
						$this->db->get('members');
						if($q->num_rows() > 0)
						{
							$this->session->set_flashdata('message', '<div class="form-error"><p>This Paypal address already exists in the system</p></div>');
					redirect('member/payment');
							
						}
						else {
						$data = array('member_paypal'=>$this->input->post('paypalemail'));
						$this->db->where('id',$this->session->userdata('id'));
						$this->db->update('members',$data);
						$this->session->set_flashdata('message', '<div class="form-success"><p>Paypal Email Address updated</p></div>');
				redirect('member/payment');
					}
					}
			}
			
			function requestpayout()
			{
				//Check the amount and see that it is valid
				$this->load->library('form_validation');
				$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
				if ($this->form_validation->run() == FALSE)
				{
						$id = $this->session->userdata('id');
						$data['title'] = "TheGigBazaar | Request Payout";
						$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
						$data['member_detail'] =  $this->Member_model->get_member_detail($id);
						$data['withdraw'] = $this->Member_model->withdraw();
						$data['fbdata'] = array(
									'user'		=> $this->facebook_connect->user,
									'user_id'	=> $this->facebook_connect->user_id,
							);
							$data['id'] = $this->session->userdata('id');
						$this->load->view('header',$data);					
						$this->load->view('member/payment',$data);
						$this->load->view('footer');
				}
				else {
					// Is the amount greater than current balance?
					$amount = $this->input->post('amount');
					$queue = $this->Member_model->payment_queue($this->session->userdata('id'));
					//Is there a request that is not yet been processed?
					
					if($queue['count'] > 0)
					{
						$this->session->set_flashdata('payout', '<div id="highlight"><p>There is a payment request you made which is already in queue</p></div>');
						redirect('member/payment');
						end;
					}
					$date = date('Y-m-d');
					$data = array('amount'=>$this->input->post('amount'),'request_from'=>$this->session->userdata('id'),'request_date'=>$date);
					//$this->db->where('id',$this->session->userdata('id'));
					$this->db->insert('withdraw',$data);
					
					
					//Now change the payment processed in the backend to yes
					$ids_queue = explode(',',$this->input->post('ids'));
					
					foreach($ids_queue as $ids)
					{
						if($ids != "")
						{
							$data = array('payment_processed'=>'y');
							$this->db->where('id',$ids);
							$this->db->update('payment_queue',$data);
						}
					}
					
					
					$this->session->set_flashdata('payout', '<div class="form-success"><p>Request has been sent and will be processed on 10th We will send an email once approved </p></div>');
					redirect('member/payment');
				}
				
			
		}
		
		function gigdelivered($id)
		{
				$data['title'] = "TheGigBazaar | Gig Delivered";
				$data['category'] = $this->Common_model->get_categories();
				$data['unread'] = $this->Common_model->message_unreadcount();
				$data['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
					$data['id'] = $this->session->userdata('id');
				$this->load->view('header',$data);					
				$this->load->view('member/gigdelivered',$data);
				$this->load->view('footer');		
		}
		
		function inbox()
		{
			$data['id'] = $this->session->userdata('id');
			$data['title'] = "TheGigBazaar | Inbox";
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['inbox'] = $this->Member_model->get_inbox();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);					
			$this->load->view('member/inbox',$data);
			$this->load->view('footer');
			
		}
		
		function readmessage($messageid)
		{
			$data['title'] = "TheGigBazaar | Inbox";
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['message'] = $this->Member_model->getmessage($messageid);
			$data['replies'] = $this->Member_model->getreply($messageid);
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);					
			$this->load->view('member/message',$data);
			$this->load->view('footer');
		}
		
		function reply()
		{
			$reply = $this->input->post('messageid');
			//get the message id
			$message = $this->input->post('replymessage');
			$this->db->where('id',$reply);
			$query = $this->db->get('messages',$reply);
			$row = $query->row();
			$to = $row->message_from;
			$from = $row->message_to;			
			$date = date('Y-m-d');
			$data = array('message_from'=>$from,'message_to'=>$to,'message'=>$message,'message_sent'=>$date,'message_reply_to'=>$reply);
			$this->db->insert('messages',$data);
			
			redirect('member/readmessage/'.$reply);
		}
		
		function delete()
		{
			$ids = $this->input->post('delete_inbox');
			foreach($ids as $id)
			{
				$this->db->where('id', $id);
				$this->db->delete('messages');
			}	
				$this->session->set_flashdata('payout', '<div class="form-success"><p>Messages deleted.</p></div>');
				redirect('member/inbox/');
		}
		
	
	
}

/* End of file member.php */
/* Location: ./system/application/controllers/member.php */