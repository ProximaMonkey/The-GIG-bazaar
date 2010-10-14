<?php
class Common_model extends Model {

    function Common_model()
    {
        parent::Model();
				$this->load->database();
		}
	
		function get_categories()
		{
			$categories = "";
			//Get a list of all active category
			$this->db->where('category_active','y');
			$query = $this->db->get('category');
			foreach($query->result() as $row)
			{
				$categories .= "<li><a href='".site_url('gig/filter/'.$row->id)."'>$row->category_name</a></li>";
			}
			return $categories;
		}
			function convert_date($date)
			{
				$date_new = explode("-",$date);
				$year = $date_new[0];
				$month = $date_new[1];
				$day = $date_new[2];
				$monthName = date("M", mktime(0, 0, 0, $month, 10));
				$format = $monthName." ".$day;

				return $format;
			}

			function convertname($id)
			{
				if($id != '-1')
				{
					$this->db->where('id', $id);
					$query = $this->db->get('members');
					$row = $query->row();
					if($row->member_name != "")
					return $row->member_name;
					else
					return $row->member_username;
				}
				else {
					return "The GigBazaar";
				}

			}
			function getusername($id)
			{
						$this->db->where('id', $id);
						$query = $this->db->get('members');
						$row = $query->row();
						return $row->member_username;
			}
			
			function categoryname($id)
			{
					$this->db->where('id', $id);
					$query = $this->db->get('category');
					$row = $query->row();
					return "<a href='".site_url('gig/filter/'.$row->id)."'>$row->category_name</a>";
			}
				function message_unreadcount()
				{
					//For the logged in member get a list of unread messages
					$this->db->where('message_to',$this->session->userdata('id'));
					$this->db->where('message_read','0');
					$query = $this->db->get('messages');
					$count = $query->num_rows();
					return $count;
				}
		function get_member_info($id)
		{
			//Replica of Function from Service Model for Controllers which does not include Service_model. Repeating :)
			
						//Now check for this person on the members table
						$this->db->where('id',$id);
						$query = $this->db->get('members');
						$row1 = $query->row();
						$data['id'] = $id;
						$data['name'] = $row1->member_name;
						$data['picture'] = $row1->member_picture;
						$data['description'] = $row1->member_description;
						$data['email'] = $row1->member_email;

						return $data;
		}
		function gigtitle($id)
		{
				$this->db->where('id', $id);
				$query = $this->db->get('gigs');
				$row = $query->row();
				return "<a href='".site_url('gig/single/'.$row->id)."'>$row->title</a>";
		}
			function checkuser($id)
			{
				$this->db->where('member_facebook',$id);
				$q = $this->db->get('members');
				$r = $q->num_rows();
				if($r > 0)
				{
					$val = "exists";
				}
				else {
					$val = "noexists";
				}
				return $val;

			}
}
