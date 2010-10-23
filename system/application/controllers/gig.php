<?php

class Gig extends Controller {

	function Gig()
	{
		parent::Controller();
		$this->load->model('Gig_model');
		if($this->session->userdata('logged_in') != TRUE)
		{
			redirect('beta/');
		}
		//$this->output->enable_profiler(TRUE);	
	}
	
	function index()
	{
		$data['title'] = "Job Details";
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('service/single',$data);
		$this->load->view('footer');
	}
	function single($id)
	{
		
		$data['gig'] = $this->Gig_model->get_job_listing($id);
		$data['title'] = $this->Gig_model->get_job_title($id);
		$data['person'] = $this->Gig_model->get_person_detail($id);
		$data['reviews'] = $this->Gig_model->get_reviews($id);
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['id'] = $id;
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('service/single',$data);
		$this->load->view('footer');
	}
	function order($id)
	{
			if($this->session->userdata('logged_in') != TRUE)
			{
				$this->session->set_flashdata('message', '<div class="form-success">Please login to place a order.</div>');
				redirect('main/login');
				end;
			}
			$status_check = $this->Gig_model->check_status($id);

			if($status_check == TRUE)
			{
				$data['title'] = "Order Job";
				$data['orderid'] = $id;
				$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
				$data['title'] = $this->Gig_model->get_job_title($id);
				$data['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
				
				$this->load->view('header',$data);			
				$this->load->view('service/order',$data);
				$this->load->view('footer');
			}
			else {
				
					$this->session->set_flashdata('message', '<div class="form-success">You cannot place a order on the service you are providing.</div>');
					redirect('gig/error');				
			}
	}
	function placeorder()
	{
		$id = $this->input->post('item_number');
		$orderid = $id;
		$title = $this->Gig_model->get_job_title($orderid);
		
		if($orderid != "")
		{
			//Now send both the users a email and then display the thank you page
			$this->db->where('id',$orderid);
			$query = $this->db->get('gigs');
			$row = $query->row();
			$user_id = $row->member_posted_by;
			$title = $row->title;
			
			$user_to = $this->Gig_model->get_person_info($user_id);
			//Get the logged in users email address
			$email_logged = $this->Gig_model->get_person_info($this->session->userdata('id'));
			$email_by = $email_logged['email'];
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('do-not-reply@thegigbazaar.com', 'thegigbazzar.com');
			$this->email->to($email_by);

			$this->email->subject('Your Order has been received : thegigbazzar.com');
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
						Hi ,<br><br>
We have received your order and have notified ".$user_to['name']." about your order.<br/><br/>".$user_to['name']." will now confirm the order and let you know when you can expect the order by.<br>
Your Order ID is : ".$orderid."
<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href='mailto:support@thegigbazzar.com'>support@thegigbazzar.com</a>
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

			/*$this->email->message('Hi, <br><br> We have received your order and have notified '.$user_to['name'].' about your order.<br/><br/>'.$user_to['name'].' will now confirm the order and let you know when you can expect the order by.<br/>
			
			Your Order ID is : '.$orderid.'
			
			<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>'); */
			$this->email->message($mail_content);
			$this->email->send();
			
			
			//Get the persons email address who is providing the service
			$this->db->where('id',$orderid);
			$query = $this->db->get('gigs');
			$row = $query->row();
			$user_id = $row->member_posted_by;			
			$email_to = $user_to['email'];
			$this->email->initialize($config);
			$this->email->from('support@thegigbazaar.com', 'thegigbazzar.com');
			$this->email->to($email_to);

			$this->email->subject('You have a new order: thegigbazzar.com');
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
						Hi ,<br><br>
We have received a new order for you for your gig-".$title.". Please login and confirm the order.<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href='mailto:support@thegigbazzar.com'>support@thegigbazzar.com</a>
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
			/*$this->email->message('Hi '.$user_to['name'].'<br><br> We have received a new order for you for your gig.'.$title.'Please login and confirm the order.<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');*/
			$this->email->message($mail_content);
			$this->email->send();
			
			//Now send a message to this through private message
			$subject = "You have a new order";
			$message = "You have a new order for the gig ".$title." by member ".$email_logged['name'];
			$date = date('Y-m-d');
			$data_message = array('message_from'=>$this->session->userdata('id'),'message_to'=>$user_id,'subject'=>$subject,'message'=>$message,'message_sent'=>$date,'message_read'=>'0');
			$this->db->insert('messages',$data_message);			
			
			
			//Now update the database
			$date = date('Y-m-d');
			$date1 = date('dmygs');	
			$randNum = $date1.rand(100000,999999);
			$data = array('orderid'=>$randNum,'order_by'=>$this->session->userdata('id'),'order_for'=>$user_id,'gigid'=>$orderid,'payment_status'=>'1','order_date'=>$date,'order_accepted'=>'0');
			$this->db->insert('orders',$data);
			$this->session->set_flashdata('message', '<div class="form-success">Order has been recorded</div>');
			redirect('gig/orderplaced/'.$randNum);	
			
		}
		else {
			$this->session->set_flashdata('message', '<div class="form-success">There was a error. We did not receive a Gig id.</div>');
			redirect('gig/error');
		}	
		
	}
	
	function error()
	{
		$data['title'] = "Error";		
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();	
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);			
		$this->load->view('service/error',$data);
		$this->load->view('footer');
	}
	function orderplaced($id)
	{
		$data['title'] = "Order Placed";		
		$data['orderid'] = $id;
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();	
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);			
		$this->load->view('service/thankyou',$data);
		$this->load->view('footer');
	}
	
	function postajob()
	{
		if($this->session->userdata('logged_in') != TRUE)
		{
			$this->session->set_flashdata('message', '<div class="form-success">Please login to place a order.</div>');
			redirect('main/login');
			end;
		}
				$header['title'] = "Post a Job";
				$data['category'] = $this->Common_model->get_categories();
				$header['unread'] = $this->Common_model->message_unreadcount();
				$data['category_dropdown'] = $this->Gig_model->get_category_dropdown();
				$data['error'] = "";
				$header['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
				$this->load->view('header',$header);
				$this->load->view('service/postajob',$data);
				$this->load->view('footer');
	}
	
	function addjob()
	{
		$this->load->library('form_validation');
		//Add the data to the database
			$this->form_validation->set_rules('quicktitle', 'Title', 'required');
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_rules('jobdescription', 'Job Description', 'required');
			//$this->form_validation->set_rules('keywords', 'Keywords ', 'required');
			$this->form_validation->set_rules('maxdays', 'Max number of Days', 'required');
				if ($this->form_validation->run() == FALSE)
				{
						$data['title'] = "TheGigBazaar | Post a Job ";
						$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
						$data['category_dropdown'] = $this->Gig_model->get_category_dropdown();
						$data['error'] = "";
						$data['fbdata'] = array(
									'user'		=> $this->facebook_connect->user,
									'user_id'	=> $this->facebook_connect->user_id,
							);
						$this->load->view('header',$data);
						$data['jobtitle'] = $this->input->post('quicktitle');
						$this->load->view('service/postajob',$data);
						$this->load->view('footer');
				}
				else {
						//check if the job title already exists
						$config['upload_path'] = './images/gigs';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '1024';
						//$config['max_width']  = '300';
						//$config['max_height']  = '150';
						$config['overwrite'] = FALSE;
						$field_name = "gigimage";
						$this->load->library('upload', $config);
							if (! $this->upload->do_upload($field_name))
								{
									$filename = "logo.png";
									$member_add = $this->Gig_model->add_job($filename);
									redirect('gig/jobposted/'.$member_add);
								}
							else {
									$upload_data = $this->upload->data();
									$filename=$upload_data['file_name'];
									$member_add = $this->Gig_model->add_job($filename);
									redirect('gig/jobposted/'.$member_add);
							}
					
					}
			
		
	}
	function jobposted($id)
	{
	
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
					$data['title'] = "TheGigBazaar | Job Posted";
					$data['serviceid'] = $id;
					$data['fbdata'] = array(
								'user'		=> $this->facebook_connect->user,
								'user_id'	=> $this->facebook_connect->user_id,
						);
					$this->load->view('header',$data);
			$this->load->view('service/jobposted',$data);
			$this->load->view('footer');
	}
	
	function filter($filter)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url()."index.php/gig/filter";
		$filter_count = $this->Gig_model->filter_count($filter);
		$config['total_rows'] = $filter_count;
		$config['per_page'] = '5';
		$config['num_links'] = '10'; 
		$this->pagination->initialize($config);
		$data['gigs'] = $this->Gig_model->get_filtered_listing($filter,5,$this->uri->segment(4));
		$data['title'] = $this->Gig_model->get_filtered_job_title($filter);
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['id'] = $filter;
		$data['pagination'] = $this->pagination->create_links();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('service/filter_view',$data);
		$this->load->view('footer');
	}
	function favorite($filter)
	{
			$this->load->library('pagination');
			$config['base_url'] = base_url()."index.php/gig/filter";
			$filter_count = $this->Gig_model->filter_count($filter);
			$config['total_rows'] = $filter_count;
			$config['per_page'] = '5';
			$config['num_links'] = '10'; 
			$this->pagination->initialize($config);
			$data['gigs'] = $this->Gig_model->get_filtered_listing($filter,5,$this->uri->segment(4));
			$data['title'] = $this->Gig_model->get_filtered_job_title($filter);
			$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
			$data['id'] = $filter;
			$data['pagination'] = $this->pagination->create_links();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('service/favourite',$data);
			$this->load->view('footer');
		
		
		
	}
	
	function search()
	{
		
			$searchstring = $this->input->post('q');

			$data['title'] = "Search";
			$data['gigs'] = $this->Gig_model->search($searchstring,5,$this->uri->segment(3));
			$this->load->library('pagination');
			$config['base_url'] = base_url()."index.php/gig/search";
			$this->db->where('approved','y');
			$this->db->where('member_disabled','n');
			$search_count = $this->Gig_model->search_count($searchstring);
			$config['total_rows'] = $search_count;
			$config['per_page'] = '5';
			$config['num_links'] = '10'; 
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
				$this->load->view('header',$data);
				$this->load->view('search_view',$data);
				$this->load->view('footer');
		
	}
	
	function delete($id)
	{
		//take the user to the page to confirm the delete
		$data['title'] = "Delete a Service Job";
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['delete_details'] = $this->Gig_model->delete_detail($id);
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
			$data['id'] = $this->session->userdata('id');
		$this->load->view('header',$data);		
		$this->load->view('member/delete_gig',$data);
		$this->load->view('footer');
	}
	
	function disable($id)
	{
		//Directly disable the list
		$data = array('member_disabled' => 'y');
		$this->db->where('id',$id);
		$this->db->update('gigs',$data);
		$this->session->set_flashdata('message', '<div class="form-success">Gig is disabled</div>');
		redirect('member/gigs');
	}
	function enable($id)
	{
		//Directly disable the list
		$data = array('member_disabled' => 'n');
		$this->db->where('id',$id);
		$this->db->update('gigs',$data);
		$this->session->set_flashdata('message', '<div class="form-success">Gig is enabled again</div>');
		redirect('member/gigs');
	}
	
	function deleteconfirm($id)
	{
			//$data = array('member_disabled' => 'y');
			$this->db->where('id',$id);
			$this->db->delete('gigs');
			$this->session->set_flashdata('message', '<div class="form-success">Gig is deleted</div>');
			redirect('member/gigs');
	}
	
	function edit($id)
	{
		$data['title'] = "Edit Details";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['delete_details'] = $this->Gig_model->edit_details($id);
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
			
		$data['id'] = $this->session->userdata['id'];
		//Did this user place this gig?
		
		
		$this->load->view('header',$data);		
		$this->load->view('member/edit_gig',$data);
		$this->load->view('footer');
	}
	
	function modifygig()
	{
		$id = $this->input->post('gig_id');
					$tags = $this->input->post('tag1')."-".$this->input->post('tag2')."-".$this->input->post('tag3')."-".$this->input->post('tag4')."-".$this->input->post('tag5'); 
		$data = array(
			'title' => $this->input->post('quicktitle'),
			'category' => $this->input->post('category'),
			'description' => $this->input->post('jobdescription'),
			'information_required' => $this->input->post('informationrequired'),
			'tags' => $tags,
			'maxnumofdays' => $this->input->post('maxdays'),
			//'image' => $filename,
			//'date_added' => $datestring,
			//'member_posted_by' => $this->session->userdata('id'),
			'approved' => 'y'
			);
			$this->db->where('id',$id);
			$this->db->update('gigs',$data);
			$this->session->set_flashdata('message', '<div class="form-success">Gig details are updated</div>');
			redirect('member/gigs');
	}
	
	function comment()
	{
		$comment = $this->Gig_model->post_comment();
		$this->session->set_flashdata('message', '<div class="form-success">Comment has been posted</div>');
		redirect('gig/single/'.$this->input->post('for_gig'));		
	}
	
	function acceptorder($orderid)
	{
			$date = date('Y-m-d');
			$data = array('order_accepted'=>'1','order_accept_date'=>$date);
			$this->db->where('orderid',$orderid);
			$update = $this->db->update('orders',$data);
		//Now that the update is done, tell the user to leave a comments and communicate
				
		
			$data['title'] = "Order Accepted";
			$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();		
			$data['orderid'] = $orderid;
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);		
			$this->load->view('member/communication',$data);
			$this->load->view('footer');
		
	}
	
	function rejectorder($orderid)
	{
		$date = date('Y-m-d');
		$data = array('order_accepted'=>'3','order_accept_date'=>$date); //here order accept date is actually the rejected date
		$this->db->where('orderid',$orderid);
		$update = $this->db->update('orders',$data);		
		//Now that the update is done, tell the user to leave a comments and communicate
		$data['id'] = $this->session->userdata('id');
		//Send a message to the user about the 
		$data['title'] = "Reject Order?";
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['orderid'] = $orderid;
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
		$this->load->view('header',$data);		
		$this->load->view('member/reject_order',$data);
		$this->load->view('footer');
		
	}
	
	function sendmessage()
	{
		//For is the buyer
		
		$orderid = $this->input->post('orderid');
		$this->db->where('orderid',$orderid);
		$query = $this->db->get('orders');
		$row = $query->row();
		$to = $row->order_by;
		$gigid = $row->gigid;
		
		
		//From is the logged in member
		$from = $this->session->userdata('id');
		$message = $this->input->post('firstmessage');		
		
		//Insert into message table
		$subject = "Your order has been accepted";
		$date = date('Y-m-d');
		$data = array('message_from'=>$from,'message_to'=>$to,'subject'=>$subject,'message'=>$message,'message_sent'=>$date);
		$this->db->insert('messages',$data);
		//Send a email to the buyer
		
		$detail = $this->Gig_model->get_person_detail($gigid);
		$email = $detail['email'];
	
		//Get the order title for the email
		$this->db->where('id',$gigid);
		$query_title = $this->db->get('gigs');		
		$row_title = $query_title->row();
		$gig_title = $row_title->title;
		
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('support@thegigbazaar.com', 'thegigbazzar.com');
			$this->email->to($email);

			$this->email->subject('Your Order has been accepted : thegigbazzar.com');
			$this->email->message('Hi, <br><br> Your order for gig '.$gig_title.'has been accepted. Message for you :
			'.$message.'
			<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
			$this->session->set_flashdata('message', '<div class="form-success">Order Accepted and message to buyer is sent.</div>');
			redirect('member/foryou');
		
		
	}
	function rejectmessage()
	{
		//For is the buyer
		
		$orderid = $this->input->post('orderid');
		$this->db->where('orderid',$orderid);
		$query = $this->db->get('orders');
		$row = $query->row();
		$to = $row->order_for;
		$gigid = $row->gigid;
		
		
		//From is the logged in member
		$from = $this->session->userdata('id');
		$message = $this->input->post('firstmessage');		
		$subject = "Your order has been rejected";
		
		//Insert into message table
		$date = date('Y-m-d');
		$data = array('message_from'=>$from,'message_to'=>$to,'subject'=>$subject,'message'=>$message,'message_sent'=>$date);
		$this->db->insert('messages',$data);
		
		//Send a email to the buyer
		
		$detail = $this->Gig_model->get_person_detail($gigid);
		$email = $detail['email'];
	
		//Get the order title for the email
		$this->db->where('id',$gigid);
		$query_title = $this->db->get('gigs');		
		$row_title = $query_title->row();
		$gig_title = $row_title->title;
		
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('support@thegigbazaar.com', 'thegigbazzar.com');
			$this->email->to($email);

			$this->email->subject('Your Order has been rejected : thegigbazzar.com');
			$this->email->message('Hi, <br><br> Your order for gig <b>'.$gig_title.'</b> has been rejected by the person providing the service.<br/><br/> Message for you :<br/>
			'.$message.'
			<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
			$this->session->set_flashdata('message', '<div class="form-success">Order Rejected and a message to the buyer is sent.</div>');
			redirect('member/foryou');
		
		
	}
	
	function save()
	{
		$id = $this->input->post('id');
		$action = $this->input->post('action');
		
		//ok, now save this in the database

		if($action == 'save_gig') //save the gig
		{
			$date = date('Y-m-d');
			$data = array('gigid'=>$id,'memberid'=>$this->session->userdata('id'),'date'=>$date);
			$this->db->insert('member_save',$data);			
			
			
					$this->db->where('id',$id);
					$q = $this->db->get('gigs');
					$r = $q->row();
					$count = $r->favs;

					$new_fav = $count+1;
					$data1 = array('favs'=>$new_fav);
					$this->db->where('id',$id);
					$this->db->update('gigs',$data1);
					
			echo "<img src='".base_url()."/images/heart_filled.png'>";
		}
 		else { echo "No action specified"; }
	}
	
	function completed($completed)
	{
		//Get the ID
		$date = date('Y-m-d');
		$data = array('order_accepted'=>'2','order_delivered'=>'y','order_delivered_date'=>$date);
		$this->db->where('orderid',$completed);
		$this->db->update('orders',$data);
		
		
		
		
		//From the orderid get the gigid 
		$this->db->where('orderid',$completed);
		$query = $this->db->get('orders');
		$row = $query->row();		
		$order_by = $row->order_for;	
		$personid = $row->order_by;
		$gigid = $row->gigid;
		$orderid = $row->orderid;
		
		
		$this->db->where('id',$gigid);
		$query_title = $this->db->get('gigs');		
		$row_title = $query_title->row();
		$gig_title = $row_title->title;
		
		
		//Update the message table
		$subject = "Order marked as completed";
		$message = 'Your order for '.$gig_title." was marked completed";
		$date = date('Y-m-d');
		$data = array('message_from'=>'-1','message_to'=>$personid,'subject'=>$subject,'message'=>$message,'message_sent'=>$date);
		$this->db->insert('messages',$data);
		
		//Add this to the payment queue
		$data = array('payment_to'=>$order_by,'paymentfor'=>$orderid,'date_completed'=>$date,'payment_processed'=>'n');
		$this->db->insert('payment_queue',$data);
		
		
		
		//Now send the member who ordered this gig a message
		$detail = $this->Gig_model->get_person_info($order_by);
		$to = $detail['email'];
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('support@thegigbazaar.com', 'thegigbazzar.com');
			$this->email->to($to);

			$this->email->subject('Your Order has been marked as completed : thegigbazzar.com');
			$this->email->message('Hi, <br><br> Your order for gig <b>'.$gig_title.'</b> has been marked as completed.Login and confirm and leave a review for the users for everyone else to see.
			<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
		redirect('member/gigdelivered/'.$completed);
		
	}



	function dispute($id)
	{		
			$data['title'] = "Raise a Dispute Message";
			$data['id'] = $id;
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();		
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);		
			$this->load->view('service/dispute',$data);
			$this->load->view('footer');	
		
	}
	function raise_dispute($id)
	{
		$orderid = $id;		
		//Flag that the order has dispute
		$date = date('Y-m-d');
		$data = array('order_dispute'=>'1','order_dispute_date'=>$date,'dispute_reason'=>$this->input->post('Reason'));
		$this->db->where('orderid',$id);
		$query = $this->db->update('orders',$data);
		
		//Tell the provider that there was a dispute raised
		
		$this->db->where('orderid',$id);
		$query = $this->db->get('orders');
		$row = $query->row();
		$order_by = $row->order_by; //Provider id
		$gigid = $row->gigid;
		
		$this->db->where('id',$gigid);
		$query_title = $this->db->get('gigs');		
		$row_title = $query_title->row();
		$gig_title = $row_title->title;
		
		$detail = $this->Gig_model->get_person_info($order_by);
		$to = $detail['email'];
		$name = $detail['name'];
		
		$me = $this->Gig_model->get_person_info($this->session->userdata('id'));
		$me_name = $me['name'];
		
		$this->load->library('email');
		$config['mailtype'] = 'html';	
		$this->email->initialize($config);
		$this->email->from('support@thegigbazaar.com', 'thegigbazzar.com');
		$this->email->to($to);

			$this->email->subject('A dispute was raised : thegigbazzar.com');
			$this->email->message('Hi, <br><br> A dispute has been raised for a service you provided with the title <b>'.$gig_title.'</b> to user.'.$me_name.'
			<br>We are currently investigating the dispute and will get back to you with our finding within a week from today.<br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
				$this->session->set_flashdata('message', '<div class="form-success">Your dispute complaint has been recorded. We will investigate the dispute and get back to you within a week.</div>');
			
		redirect('member/ordered/');		
	}
	
	function tagfilter($id)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url()."index.php/gig/tagfilter";
		$filter_count = $this->Gig_model->filter_count($id);
		$config['total_rows'] = $filter_count;
		$config['per_page'] = '5';
		$config['num_links'] = '10'; 
		$this->pagination->initialize($config);
		$data['gigs'] = $this->Gig_model->get_tag_listing($id,5,$this->uri->segment(4));
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['id'] = $id;
		$data['pagination'] = $this->pagination->create_links();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$data['title'] = "Thegigbazaar : Filter by Tag : $id";
		$this->load->view('header',$data);
		$this->load->view('service/tag_view',$data);
		$this->load->view('footer');
		
		
	}
	
	function ordered()
	{
		$data['title'] = "Raise a Dispute Message";
		$data['id'] = $id;
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();		
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);		
		$this->load->view('service/dispute',$data);
		$this->load->view('footer');
	}
	
	function cancelled()
	{
			$data['title'] = "Payment Cancelled a Dispute Message";
			$data['id'] = $id;
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();		
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);		
			$this->load->view('service/paymentcancel',$data);
			$this->load->view('footer');
		
		
	}

	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */