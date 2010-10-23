<?php

class User extends Controller {

	function User()
	{
			parent::Controller();				
			$this->load->model('User_model');	
			//$this->output->enable_profiler(TRUE);	
					if($this->session->userdata('logged_in') != TRUE)
					{
						redirect('beta/');
					}
	}
	
	function index()
	{		
		redirect('user/view/'.$this->uri->segment(3));
	}
	
	function view()
	{
		$user_details = $this->User_model->get_member_detail($this->uri->segment(3));
		//echo $user_details['member_id'];
		$user_gigs = $this->User_model->get_member_gigs($user_details['member_id']);
		$data['title'] = $this->uri->segment(3)."'"."s Public Profile - TheGigBazaar ";
		$data['category'] = $this->Common_model->get_categories();
		$data['unread'] = $this->Common_model->message_unreadcount();
		
		$data['user'] = $user_details;
		$data['gigs'] = $user_gigs;
		$data['fbdata'] = array(
					'user'		=> $this->facebook_connect->user,
					'user_id'	=> $this->facebook_connect->user_id,
			);
		$this->load->view('header',$data);
		$this->load->view('member/user_details',$data);
		$this->load->view('footer');
	}
	
}
?>