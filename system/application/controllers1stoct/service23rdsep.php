<?php

class Service extends Controller {

	function Service()
	{
		parent::Controller();
		$this->load->model('Service_model');
		//$this->output->enable_profiler(TRUE);	
	}
	
	function index()
	{
		$data['title'] = "Job Details";
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$this->load->view('header',$data);
		$this->load->view('service/single',$data);
		$this->load->view('footer');
	}
	function single($id)
	{
		
		$data['gig'] = $this->Service_model->get_job_listing($id);
		$data['title'] = $this->Service_model->get_job_title($id);
		$data['person'] = $this->Service_model->get_person_detail($id);
		$data['reviews'] = $this->Service_model->get_reviews($id);
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['id'] = $id;
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
			$status_check = $this->Service_model->check_status($id);

			if($status_check == TRUE)
			{
				$data['title'] = "Order Job";
				$data['orderid'] = $id;
				$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
				$data['title'] = $this->Service_model->get_job_title($id);
				$this->load->view('header',$data);			
				$this->load->view('service/order',$data);
				$this->load->view('footer');
			}
			else {
				
					$this->session->set_flashdata('message', '<div class="form-success">You cannot place a order on the service you are providing.</div>');
					redirect('service/error');				
			}
	}
	function placeorder()
	{
		//Get the order id
		$orderid = $this->input->post('orderid');
		$title = $this->Service_model->get_job_title($orderid);
		//Check if the user is logged in	
		
		if($orderid != "")
		{
			//Check if the order is placed by the person who is providing the service
		
			//Process through payment gateway

			
			
			//Now send both the users a email and then display the thank you page
			$user_to = $this->Service_model->get_person_info($this->session->userdata('id'));
			//Get the logged in users email address
			$email_logged = $this->Service_model->get_person_info($this->session->userdata('id'));
			$email_by = $email_logged['email'];
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('support@wemto.com', 'thegigbazzar.com');
			$this->email->to($email_by);

			$this->email->subject('Your Order has been recorded : thegigbazzar.com');
			$this->email->message('Hi, <br><br> We have received your order and have notified '.$user_to['name'].'<br/><br/> about your order.
			
			'.$user_to['name'].' will now confirm the order and let you know when you will expect to get the order by.
			
			<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
			
			
			//Get the persons email address who is providing the service
			$this->db->where('id',$orderid);
			$query = $this->db->get('gigs');
			$row = $query->row();
			$user_id = $row->member_posted_by;			
			$email_to = $user_to['email'];
			$this->email->initialize($config);
			$this->email->from('support@wemto.com', 'thegigbazzar.com');
			$this->email->to($email_to);

			$this->email->subject('You have a new order: thegigbazzar.com');
			$this->email->message('Hi '.$user_to['name'].'<br><br> We have received a new order for you for your gig.'.$title.'Please login and confirm the order.<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
			
			//Now update the database
			$date = date('Y-m-d');
			$date1 = date('dmygs');	
			$randNum = $date1.rand(100000,999999);
			$data = array('orderid'=>$randNum,'order_by'=>$this->session->userdata('id'),'order_for'=>$user_id,'gigid'=>$orderid,'payment_status'=>'','order_date'=>$date);
			$this->db->insert('orders',$data);
			$this->session->set_flashdata('message', '<div class="form-success">Order has been recorded</div>');
			redirect('service/orderplaced/'.$randNum);	
			
		}
		else {
			$this->session->set_flashdata('message', '<div class="form-success">There was a error. We did not receive a Gig id.</div>');
			redirect('service/error');
		}	
		
	}
	
	function error()
	{
		$data['title'] = "Error";		
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();	
		$this->load->view('header',$data);			
		$this->load->view('service/error',$data);
		$this->load->view('footer');
	}
	function orderplaced($id)
	{
		$data['title'] = "Order Placed";		
		$data['orderid'] = $id;
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();	
		$this->load->view('header',$data);			
		$this->load->view('service/thankyou',$data);
		$this->load->view('footer');
	}
	
	function postajob()
	{
				$header['title'] = "Post a Job";
				$data['jobtitle'] = $this->input->post('quicktitle');
				$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
				$data['category_dropdown'] = $this->Service_model->get_category_dropdown();
				$data['error'] = "";
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
			$this->form_validation->set_rules('keywords', 'Keywords ', 'required');
			$this->form_validation->set_rules('maxdays', 'Max number of Days', 'required');
				if ($this->form_validation->run() == FALSE)
				{
						$data['title'] = "TheGigBazaar | Post a Job ";
						$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
						$data['category_dropdown'] = $this->Service_model->get_category_dropdown();
						$data['error'] = "";
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
									$data['title'] = "TheGigBazaar | Post a Job ";
									$data['error'] = $this->upload->display_errors('<div class="form-error"><p>', '</p></div>');
									$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
									$data['category_dropdown'] = $this->Service_model->get_category_dropdown();
									$this->load->view('header',$data);
									$data['jobtitle'] = $this->input->post('quicktitle');
									$this->load->view('service/postajob',$data);
									$this->load->view('footer');
								}
							else {
									$upload_data = $this->upload->data();
									$filename=$upload_data['file_name'];
									$member_add = $this->Service_model->add_job($filename);
									redirect('service/jobposted/'.$member_add);
							}
					
					}
			
		
	}
	function jobposted($id)
	{
			$data['title'] = "TheGigBazaar | Job Posted";
			$data['serviceid'] = $id;
			$this->load->view('header',$data);
			$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
			$this->load->view('service/jobposted',$data);
			$this->load->view('footer');
	}
	
	function filter($filter)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url()."index.php/service/filter";
		$filter_count = $this->Service_model->filter_count($filter);
		$config['total_rows'] = $filter_count;
		$config['per_page'] = '5';
		$config['num_links'] = '10'; 
		$this->pagination->initialize($config);
		$data['gigs'] = $this->Service_model->get_filtered_listing($filter,5,$this->uri->segment(4));
		$data['title'] = $this->Service_model->get_filtered_job_title($filter);
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('header',$data);
		$this->load->view('service/filter_view',$data);
		$this->load->view('footer');
	}
	
	function search()
	{
		
			$searchstring = $this->input->post('q');

			$data['title'] = "Search";
			$data['gigs'] = $this->Service_model->search($searchstring,5,$this->uri->segment(3));
			$this->load->library('pagination');
			$config['base_url'] = base_url()."index.php/service/search";
			$this->db->where('approved','y');
			$this->db->where('member_disabled','n');
			$search_count = $this->Service_model->search_count($searchstring);
			$config['total_rows'] = $search_count;
			$config['per_page'] = '5';
			$config['num_links'] = '10'; 
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
				$this->load->view('header',$data);
				$this->load->view('search_view',$data);
				$this->load->view('footer');
		
	}
	
	function delete($id)
	{
		//take the user to the page to confirm the delete
		$data['title'] = "Delete a Service Job";
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['delete_details'] = $this->Service_model->delete_detail($id);
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
			$this->session->set_flashdata('message', '<div class="form-success">Gig is delete</div>');
			redirect('member/gigs');
	}
	
	function edit($id)
	{
		$data['title'] = "Edit Details";
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['delete_details'] = $this->Service_model->edit_details($id);
	
		$this->load->view('header',$data);		
		$this->load->view('member/edit_gig',$data);
		$this->load->view('footer');
	}
	
	function modifygig()
	{
		$id = $this->input->post('gig_id');
		$data = array(
			'title' => $this->input->post('quicktitle'),
			'category' => $this->input->post('category'),
			'description' => $this->input->post('jobdescription'),
			'information_required' => $this->input->post('informationrequired'),
			'tags' => $this->input->post('keywords'),
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
		$comment = $this->Service_model->post_comment();
		$this->session->set_flashdata('message', '<div class="form-success">Comment has been posted</div>');
		redirect('service/single/'.$this->input->post('for_gig'));		
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
			$this->load->view('header',$data);		
			$this->load->view('member/communication',$data);
			$this->load->view('footer');
		
	}
	
	function rejectorder($orderid)
	{
		$date = date('Y-m-d');
		$data = array('order_accepted'=>'0','order_accept_date'=>$date); //here order accept date is actually the rejected date
		$this->db->where('orderid',$orderid);
		$update = $this->db->update('orders',$data);		
		//Now that the update is done, tell the user to leave a comments and communicate
		
		//Send a message to the user about the 
		$data['title'] = "Reject Order?";
		$data['category'] = $this->Common_model->get_categories();$data['unread'] = $this->Common_model->message_unreadcount();
		$data['orderid'] = $orderid;
			
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
		$to = $row->order_for;
		$gigid = $row->gigid;
		
		
		//From is the logged in member
		$from = $this->session->userdata('id');
		$message = $this->input->post('firstmessage');		
		
		//Insert into message table
		$date = date('Y-m-d');
		$data = array('message_from'=>$from,'message_to'=>$to,'message'=>$message,'message_sent'=>$date);
		$this->db->insert('messages',$data);
		//Send a email to the buyer
		
		$detail = $this->Service_model->get_person_detail($gigid);
		$email = $detail['email'];
	
		//Get the order title for the email
		$this->db->where('id',$gigid);
		$query_title = $this->db->get('gigs');		
		$row_title = $query_title->row();
		$gig_title = $row_title->title;
		
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('support@wemto.com', 'thegigbazzar.com');
			$this->email->to($email);

			$this->email->subject('Your Order has been accepted : thegigbazzar.com');
			$this->email->message('Hi, <br><br> Your order for gig '.$gig_title.'has been accepted. Message for you :
			'.$message.'
			<br><br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
			$this->session->set_flashdata('message', '<div class="form-success">Order Accepted and buyer message is sent.</div>');
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
		
		//Insert into message table
		//$date = date('Y-m-d');
		//$data = array('message_from'=>$from,'message_to'=>$to,'message'=>$message,'message_sent'=>$date);
		//$this->db->insert('messages',$data);
		//Send a email to the buyer
		
		$detail = $this->Service_model->get_person_detail($gigid);
		$email = $detail['email'];
	
		//Get the order title for the email
		$this->db->where('id',$gigid);
		$query_title = $this->db->get('gigs');		
		$row_title = $query_title->row();
		$gig_title = $row_title->title;
		
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('support@wemto.com', 'thegigbazzar.com');
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

		if($action=='save_gig') //save the gig up
		{
			$date = date('Y-m-d');
			$data = array('gigid'=>$id,'memberid'=>$this->session->userdata('id'),'date'=>$date);
			$this->db->insert('member_save',$data);
			echo "Saved";
		}
 		else echo "No action specified";
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
		$order_by = $row->order_by;	
		$gigid = $row->gigid;
		
		
		$this->db->where('id',$gigid);
		$query_title = $this->db->get('gigs');		
		$row_title = $query_title->row();
		$gig_title = $row_title->title;
		
		
		//Update the message table
		$message = 'Your order for '.$gig_title." was marked completed";
		$date = date('Y-m-d');
		$data = array('message_from'=>'-1','message_to'=>$order_by,'message'=>$message,'message_sent'=>$date);
		$this->db->insert('messages',$data);
		
		//Now send the member who ordered this gig a message
		$detail = $this->Service_model->get_person_info($order_by);
		$to = $detail['email'];
			$this->load->library('email');
			$config['mailtype'] = 'html';	
			$this->email->initialize($config);
			$this->email->from('support@wemto.com', 'thegigbazzar.com');
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
		
		$detail = $this->Service_model->get_person_info($order_by);
		$to = $detail['email'];
		$name = $detail['name'];
		
		$me = $this->Service_model->get_person_info($this->session->userdata('id'));
		$me_name = $me['name'];
		
		$this->load->library('email');
		$config['mailtype'] = 'html';	
		$this->email->initialize($config);
		$this->email->from('support@wemto.com', 'thegigbazzar.com');
		$this->email->to($to);

			$this->email->subject('A dispute was raised : thegigbazzar.com');
			$this->email->message('Hi, <br><br> A dispute has been raised for a service you provided with the title <b>'.$gig_title.'</b> to user.'.$me_name.'
			<br>We are currently investigating the dispute and will get back to you with our finding within a week from today.<br>Thanks,<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazzar.com>support@thegigbazzar.com</a>');
			$this->email->send();
				$this->session->set_flashdata('message', '<div class="form-success">Your dispute complaint has been recorded. We will investigate the dispute and get back to you within a week.</div>');
			
		redirect('member/ordered/');
		
		
		
	}
	

	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */