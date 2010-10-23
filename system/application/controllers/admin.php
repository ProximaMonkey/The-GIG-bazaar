<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
		//check that only logged in users can use this
		//$this->output->enable_profiler(TRUE);
		if($this->session->userdata('logged_in') != TRUE and $this->session->userdata('level') != '-1')
		{
			redirect('beta/');
		}
		$this->load->model('Admin_model');

	}
	
	function index()
	{
		$data['title'] = "Welcome to TheGigBazaar | Admin";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['withdraw'] = $this->Admin_model->withdraw_request();
		$data['recentgigs'] = $this->Admin_model->recentgigs();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('admin/main_view',$data);
		$this->load->view('footer');
	}
	
	function approvegig()
	{
			$data['title'] = "Welcome to TheGigBazaar | Approve a Gig";
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['jobs'] = $this->Admin_model->approve_job_list();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('admin/approvegig',$data);
			$this->load->view('footer');
	}
	function jobapprove($id)
	{
				$data = array( 'approved' => 'y');
				$this->db->where('id', $id);
				$this->db->update('gigs', $data);
				$this->session->set_flashdata('message', '<div class="form-success">Gig has been approved.</div>');
				redirect('admin/approvegig/');
	}
	function jobdelete($id)
	{
		$data = array('approved' => 'd');
		$this->db->where('id', $id);		
		$this->db->update('gigs',$data); 	
		$this->session->set_flashdata('message', '<div class="form-success">Gig Entry has been archived</div>');
		redirect('admin/approvegig');
	}
	
	function addcategory()
	{
		$data['title'] = "Welcome to TheGigBazaar | Add a Category";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
	$this->load->view('header',$data);
		$this->load->view('admin/category/addcategory',$data);
		$this->load->view('footer');
	}
	
	function processcategory()
	{
		//check if the field is empty
			$this->load->library('form_validation');
			//Add the data to the database
			$this->form_validation->set_rules('category', 'Category Name', 'required');
				if ($this->form_validation->run() == FALSE)
				{
						$data['title'] = "TheGigBazaar | Add a Category";
						$data['category'] = $this->Common_model->get_categories();
						$data['unread'] = $this->Common_model->message_unreadcount();
						$data['fbdata'] = array(
									'user'		=> $this->facebook_connect->user,
									'user_id'	=> $this->facebook_connect->user_id,
							);
						$this->load->view('header',$data);
							$this->load->view('admin/category/addcategory',$category);
							$this->load->view('footer');
				}
				else {
						// So all is good. Now add the category
						$category_add = $this->Admin_model->add_category();
						redirect('admin/managecategory');
				}
	}
	function managecategory()
	{
		$data['title'] = "Welcome to TheGigBazaar | Manage Category";
		$data['category_manage'] = $this->Admin_model->category_list();
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('admin/category/managecategory',$data);
		$this->load->view('footer');
	}
	
	function categoryedit($id)
	{
		$data['title'] = "Welcome to TheGigBazaar | Edit Category";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
			$this->db->where('id', $id);
			$query = $this->db->get('category');
			$row=$query->row();
			$data['id'] = $row->id;
			$data['name'] = $row->category_name;
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
	$this->load->view('header',$data);
		$this->load->view('admin/category/editcategory',$data);
		$this->load->view('footer');
	}
	function updatecategory()
	{
			$categoryid = $this->input->post('categoryid');
				$data = array(
					   'category_name' => $this->input->post('category')        
						);
					$this->db->where('id', $categoryid);
					$this->db->update('category', $data);
					$this->session->set_flashdata('message', '<div class="form-success">Category Details Updated</div>');
					redirect('admin/managecategory/');
		
	}

	function categorydelete($id)
	{
			$this->db->where('id', $id);
			$query = $this->db->get('category');
			$row=$query->row();
			$data['id'] = $row->id;
			$data['name'] = $row->category_name;
			$data['title'] = "Welcome to TheGigBazaar | Delete Category";
			$data['category'] = $this->Common_model->get_categories();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('admin/category/deletecategory',$data);
			$this->load->view('footer');
	}
	
	function deletecategory()
	{
			$categoryid = $this->input->post('categoryid');
			$this->db->where('id', $categoryid);
			$this->db->delete('category'); 	
			$this->session->set_flashdata('message', '<div class="form-success">Category deleted</div>');
			redirect('admin/managecategory');
	
	}
	
	function managegigs()
	{
			$data['title'] = "Welcome to TheGigBazaar | Manage Gigs";
			$data['category'] = $this->Common_model->get_categories();
			$data['gigs_manage'] = $this->Admin_model->gigs_list();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('admin/gigs/managegigs',$data);
			$this->load->view('footer');
	}
	
	function gigdelete($id)
	{
		$gigid = $id;
		$this->db->where('id', $gigid);
		$this->db->delete('gigs'); 	
		$this->session->set_flashdata('message', '<div class="form-success">Gig deleted</div>');
		redirect('admin/managegigs');
	}
	
	function comments()
	{
			$data['title'] = "Welcome to TheGigBazaar | Manage comments";
			$data['category'] = $this->Common_model->get_categories();
			$data['gigs_manage'] = $this->Admin_model->comments_list();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('admin/comments/managecomments',$data);
			$this->load->view('footer');		
	}
	
	
	function commentdisable($id)
	{
		$reviewid = $id;
		$data = array('approved'=>'n');
		$this->db->where('id', $reviewid);
		$this->db->update('reviews',$data); 	
		$this->session->set_flashdata('message', '<div class="form-success">Comment disabled</div>');
		redirect('admin/comments');
	}
	function commentapprove($id)
	{
		$reviewid = $id;
		$data = array('approved'=>'y');
		$this->db->where('id', $reviewid);
		$this->db->update('reviews',$data); 	
		$this->session->set_flashdata('message', '<div class="form-success">Comment approved</div>');
		redirect('admin/comments');
	}
	function commentdelete($id)
	{
		$reviewid = $id;
		$this->db->where('id', $reviewid);
		$this->db->delete('reviews'); 	
		$this->session->set_flashdata('message', '<div class="form-success">Comment deleted</div>');
		redirect('admin/comments');
	}
	
	//Users
	function manageuser()
	{
			$data['title'] = "Welcome to TheGigBazaar | Manage User";
			$data['category'] = $this->Common_model->get_categories();
			$data['user_manage'] = $this->Admin_model->user_list();
			$data['unread'] = $this->Common_model->message_unreadcount();
			$data['fbdata'] = array(
						'user'		=> $this->facebook_connect->user,
						'user_id'	=> $this->facebook_connect->user_id,
				);
			$this->load->view('header',$data);
			$this->load->view('admin/users/manageusers',$data);
			$this->load->view('footer');		
	}
	function userdisable($id)
	{
		$userid = $id;
		$data = array('member_verified'=>'n');
		$this->db->where('id', $userid);
		$this->db->update('members',$data); 	
		$this->session->set_flashdata('message', '<div class="form-success">User disabled</div>');
		redirect('admin/manageuser');
	}
	function userapprove($id)
	{
		$userid = $id;
		$data = array('member_verified'=>'y');
		$this->db->where('id', $userid);
		$this->db->update('members',$data); 	
		$this->session->set_flashdata('message', '<div class="form-success">User approved</div>');
		redirect('admin/manageuser');
	}
	function userdelete($id)
	{
		$userid = $id;
		$this->db->where('id', $userid);
		$this->db->delete('reviews'); 	
		$this->session->set_flashdata('message', '<div class="form-success">User deleted</div>');
		redirect('admin/manageuser');
	}
	function userban($id)
	{
		$userid = $id;
		$data = array('banned'=>'y');
		$this->db->where('id', $userid);
		$this->db->update('members',$data);
		
		$this->session->set_flashdata('message', '<div class="form-success">User banned</div>');
		redirect('admin/manageuser');
	}
	function approveuser()
	{
				redirect('admin/manageuser/');				
	}
	
	function recentpayment()
	{
			redirect('admin/');
	}
	function paymentreport()
	{
				$data['title'] = "Welcome to TheGigBazaar | Generate Report";
				$data['category'] = $this->Common_model->get_categories();
				$data['unread'] = $this->Common_model->message_unreadcount();
				$data['fbdata'] = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
				$this->load->view('header',$data);
				$this->load->view('admin/payment/report',$data);
				$this->load->view('footer');
	}
	function paypalreport()
	{
			$start = $this->input->post('startdate');
			$end = $this->input->post('enddate');
			$this->load->plugin('to_excel');
			$date = date('Y-m-d');
			$query = $this->db->query('SELECT members.member_paypal as "Paypal ID",withdraw.amount as "Amount",withdraw.currency_code as "Currency Code", withdraw.request_date as "Request Date"
						FROM withdraw
						LEFT JOIN members
						ON withdraw.request_from=members.id
						where withdraw.request_date between "'.$start.'" and "'.$end.'" and accepted="0" ORDER BY withdraw.request_date DESC');
			// run joins, order by, where, or anything else here
			
			$name = "paypalreport".$date;
			to_excel($query, $name);
			
			//Now consider all of these a payed and update the table
			$data = array('accepted'=>'1','accept_date'=>$date);
			$this->db->where('request_date between "'.$start.'" and "'.$end.'"');
			$this->db->update('withdraw',$data);
			
			//$this->session->set_flashdata('message', '<div class="form-success">Paypal Report Exported.All payment marked as paid</div>');
			//redirect('admin/paymentreport');
			
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */