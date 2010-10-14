<?php
class Admin_model extends Model {

    function Admin_model()
    {
        parent::Model();
				$this->load->database();
		}
	
		function add_member()
		{
			$datestring = date("Y-m-d");
			$data = array(
				'member_username' => $this->input->post('username'),
				'member_email' => $this->input->post('email'),
				'member_password' => $this->input->post('password'),
				'member_dateadded' => $datestring,
				'member_verified' => 'n'
				);
				
			$this->db->insert('members', $data);
		}
		function approve_job_list()
		{
			$list = "";
			$this->db->where('approved','n');
			$this->db->where('member_disabled','n');
			$query = $this->db->get('gigs');
			foreach($query->result() as $row)
			{
				$list .= "<div id='gig'><b>$row->title</b><br/>";
				$list .= "<p>$row->description</p><br/><br/>";
				$list .= "<div id='approve'><a href='".site_url('admin/jobapprove/'.$row->id)."'>Approve</a> | <a href='".site_url('admin/jobdelete/'.$row->id)."'>Delete</a></div></div>";
			}
			return $list;
		}
		function unapproved_job_count()
		{
			$this->db->where('approved','n');
			$query = $this->db->get('gigs');
			$num = $query->num_rows();
			if($num == '0' || $num == "")
			{
				$number = "0";
			}
			else {
				$number = $num;
			}
			return $number;
		}
			function add_category()
			{
				$data = array(
					'category_name' => $this->input->post('category'),
					'category_active' => 'y'				
					);

				$this->db->insert('category', $data);
			}
			function category_list()
			{
				$list = "";
				$query = $this->db->get('category');
				foreach($query->result() as $row)
				{
					$list .= "<div id='list'><div id='list_title'><b>$row->category_name</b></div>";
					$list .= "<div id='list_action'><a href='".site_url('admin/categoryedit/'.$row->id)."'>Edit</a> | <a href='".site_url('admin/categorydelete/'.$row->id)."'>Delete</a></div></div>";
				}
				return $list;
			}
			function gigs_list()
			{
					$list = "";
					$query = $this->db->get('gigs');
					foreach($query->result() as $row)
					{
						$list .= "<div id='list'><div id='list_title'><b>$row->title</b> - ".$this->Common_model->categoryname($row->category)." - Ordered ".$this->ordercount($row->id)."</div>";
						$list .= "<div id='list_action'><!--<a href='".site_url('admin/gigedit/'.$row->id)."'>Edit</a>|-->  <a href='".site_url('admin/gigdelete/'.$row->id)."' id='category_delete'>Delete</a></div></div>";
					}
					return $list;
			}
			function comments_list()
			{
				$list = "";
				$query = $this->db->get('reviews');
				foreach($query->result() as $row)
				{
				$list .= "<div id='list'>";
				if($row->approved == 'n')
				{
					$approved = "<font color='red'>Disabled</font>";
				}				
				else {
					$approved = "";
				}
				$list .= "$approved <div id='list_title'>".$this->Common_model->getusername($row->from_user)." commented on gig  ".$this->Common_model->gigtitle($row->for_gig)." and said <b>".$row->review."</b></div>";
		
				$list .= "<div id='list_action'>";
				if($row->approved == 'n')
				{
					$list .= "<a href='".site_url('admin/commentapprove/'.$row->id)."' id='comment_disabled'>Approve</a>";
				}
				else {
						$list .= "<a href='".site_url('admin/commentdisable/'.$row->id)."' id='comment_disabled'>Disapprove</a>";
				}
				$list .= "|  <a href='".site_url('admin/commentdelete/'.$row->id)."' id='comment_delete'>Delete</a></div></div>";
			}
			return $list;
			}
			function user_list()
			{
				$list = "";
				$query = $this->db->get('members');
				foreach($query->result() as $row)
				{	
					$userinfo = $this->Common_model->get_member_info($row->id);
					$email = $userinfo['email'];
					$list .= "<div id='list'>";
					if($row->approved == 'n')
					{
						$approved = "<font color='red'>Disabled</font>";
					}				
					else {
						$approved = "";
					}
					$list .= "<div id='list_title'>$approved <b>$row->member_username</b> - ".$email."</div>";
					$list .= "<div id='list_action'>";
				if($row->member_verified == 'n')
				{
					$list .= "<a href='".site_url('admin/userapprove/'.$row->id)."' id='user_disabled'>Approve</a>";
				}
				else {
						$list .= "<a href='".site_url('admin/userdisable/'.$row->id)."' id='user_disabled'>Disapprove</a>";
				}
						$list .= "|  <a href='".site_url('admin/userdelete/'.$row->id)."' id='user_delete'>Delete</a></div></div>";
				}
	
			return $list;
			}
			
			function ordercount($gigid)
			{
				$this->db->where('gigid',$gigid);
				$query = $this->db->get('orders');
				$count = $query->num_rows();
				return $count;
			}

}
