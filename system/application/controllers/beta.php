<?php

class Beta extends Controller {

	function Beta()
	{
			parent::Controller();				
		}
	
	function index()
	{		
		$this->load->view('beta');
	}
	
	function checkcode()
	{
		//Check if the valid code is entered into the system
		$code = $this->input->post('code');
		$this->db->where('code',$code);
		$q = $this->db->get('beta');
		$num = $q->num_rows();
		$r = $q->row();
		if($num > 0)
		{
			//Check if there are invites left
			$left = $r->spot_left;
			if($left > 0)
			{
				//Update the spots left code
				$new = $left - 1;
				$data = array('spot_left'=>$new);
				$this->db->where('code',$code);
				$this->db->update('beta',$data);
				
			//Valid invite code redirect to signup page
				$data = array('code'=>$code);
				$this->session->set_userdata($data);
				redirect('beta/signup');
			}
		}
		else {
			$this->session->set_flashdata('message','The invite code you entered is invalid');
			redirect('beta/index');
		}
	}
	
	function signup()
	{
		if($this->session->userdata('code') != "")
		{
			$this->load->view('betasignup');
		}
		else {
			$this->session->sess_destroy();
			redirect('beta/index');
		}
		
	}
	
	function processsignup()
	{
		$error = "0";
		$this->load->library('form_validation');
		//Add the data to the database
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
				if ($this->form_validation->run() == FALSE)
				{
						$this->load->view('betasignup');
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
							$this->session->set_flashdata('message','<div class="form-error"><p>We already have a user with this username or email address.</p></div>');
								redirect('beta/signup');
						}
						else {
							//New user
						
							$datestring = date("Y-m-d");
							$uniqueid = date("Ymd").uniqid();
							$facebook_id = "";
							$name = "";
							$verified ='y';
							$picture ='default.jpg';
						
							$data = array(
								'member_name' => $name,
								'member_picture' => $picture,
								'member_username' => mysql_real_escape_string($this->input->post('username')),
								'member_email' => mysql_real_escape_string($this->input->post('email')),
								'member_password' => mysql_real_escape_string($this->input->post('password')),
								'member_dateadded' => $datestring,
								'member_verified' => $verified,
								'member_facebook' => $facebook_id,
								'member_verification' => $uniqueid
								);

							$this->db->insert('members', $data);
							$last_id = mysql_insert_id();
							$username = $this->input->post('username');
							//Now send the email verification link
							if($verified == 'n')
							{
								$this->load->library('email');
								$config['mailtype'] = 'html';	
								$this->email->initialize($config);
								$this->email->from('info@thegigbazaar.com', 'thegigbazaar.com');
								$this->email->to($this->input->post('email'));
								$this->email->subject('Thank you for signing up: TheGigBazaar.com');
								$mail_content="<table cellspacing='0' cellpadding='0' align='center' width='666' style='font-size: 14px;'>
				    <tr>
				        <td height='18' width='666' bgcolor='#ffffff' background='".site_url('images/newsletter/top_shadow.png')."' style='width:666px;background-repeat:no-repeat;background-position:top;height:18px;'>&nbsp;</td>
				    </tr>
				    <tr>
				        <td background='".site_url('images/newsletter/middle_shadow.png')."' style='background-repeat:repeat-y; width:666px; height:370px;' height='371'>
				        <table cellspacing='0' cellpadding='0' align='center'  width='638'>
				     		<tr>
								<td height='104' width='500' background='".site_url('images/newsletter/top_bg.png')."' style='height:109px; background-repeat:repeat-x;'>   
				     				 <img src='".site_url('images/logo.png')."' width='198' height='76' alt='logo' align='left' style='padding-left:15px;' />  
								</td>  
							</tr>
							<tr>
								<td style='padding:15px;'>
									<font face='Lucida Grande, Segoe UI, Arial, Verdana, Lucida Sans Unicode, Tahoma, Sans Serif' color='#333'>
										Hi ".$username.",<br><br>
				Thank you for signing up on thegigbazaar.com . You are now a member.<br>
				<br>The Gig bazaar Team<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazaar.com>support@thegigbazaar.com</a>
									</font>
				        		</td>
				        	</tr>
				        </table>
						</td>
				    </tr>
				    <tr>
						<td height='10' bgcolor='#ffffff' background='".site_url('images/newsletter/bottom_shadow.png')."' style='background-repeat:no-repeat; background-position:bottom; height:17px;'>&nbsp;</td>
					</tr>
				</table>";
							$this->email->message($mail_content);
								$this->email->send();
							}
							$this->session->set_flashdata('message','<div class="form-success"><p>You are now registered. Please login using the link below.</p></div>');
							redirect('beta/login');								
						}
			}			
	}
	
	function login()
	{
		
		$this->load->view('betalogin');
		
	}
	
	function process_login()
	{
		//check the login details are correct
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$ref = $this->input->post('ref');
		
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
					if($ref == site_url('main/login') or $ref == "")
					{
						redirect('main/index');
					}
					else {
						redirect($ref);
					}
								
			}
			else {
				if($banned == 'n')
				{
						$this->session->set_flashdata('message', '<div class="form-error">Your account has been banned by the administrator.</div>');
				}
				else {
									$this->session->set_flashdata('message', '<div class="form-success">Your account is not yet verified.Please check your email and click on the verification link.</div>');
				}
				redirect('beta/login/');
			}
		}
		else {
					$this->session->set_flashdata('message', '<div class="form-error">Username and password details are incorrect.</div>');
								redirect('beta/login/');
	
		}
	}
	
}
?>