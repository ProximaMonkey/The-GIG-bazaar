<?php
class User_model extends Model {

    function User_model()
    {
        parent::Model();
				$this->load->database();
		}
	
	function get_member_detail($id)
	{
		if($id != "")
		{
		$this->db->where('member_username', $id);
		$query = $this->db->get('members');
		$row = $query->row();
		$count = $query->num_rows();
		if($count <= 0)
		{
			$data['member_username'] = "There is no such user in the system";			
			$data['member_id'] = "";
			$data['member_name'] = "";			
			$data['member_description'] = "";
			$data['member_picture'] = "";			
			return $data;
			end;
		}
		else {
			$data['member_username'] = $row->member_username;
			$data['member_id'] = $row->id;
			$data['member_name'] = $row->member_name;			
			$data['member_description'] = $row->member_description;
			if($row->member_facebook != "")
			{
				$data['facebook'] = $row->member_facebook;
			}
			
			if($row->member_picture == "")
			{
				$data['member_picture'] = "default.png";
			}
			else {
				$data['member_picture'] = $row->member_picture;
				
			}
			
		}
	}
	else {
		$data['member_username'] = "There is no such user in the system";
			$data['member_id'] = "";
			$data['member_name'] = "";			
			$data['member_description'] = "";
			$data['member_picture'] = "";
	}
		
		return $data;
	}
	
	
	function get_member_gigs($id)
	{
		if($id != "")
		{
				$this->db->where('id', $id);
				$query_name = $this->db->get('members');
				$row_name = $query_name->row();
				$name = $row_name->member_username;
		$selling = "";
		//Get the details
		$this->db->orderby('id',"DESC");
		$this->db->where('member_posted_by',$id);
		$this->db->where('member_disabled !=','y');
		$query = $this->db->get('gigs');
		$num = $query->num_rows();
		$selling .= "<h2>Gigs by ".$name." </h2>";
		foreach($query->result() as $row)
		{
			if($row->member_disabled == 'y')
			{
				$selling .= "<div id='single_listing' style='background:#ddd;border-bottom:10px solid #fff;'>";
			}
			else {
				$selling .= "<div id='single_listing'>";
			}
			
				$selling .= "<div id=order><div  class='order_nowbutton'><a href=".site_url('gig/order/'.$row->id).">Order Now</a></div></a></div>
				<div id=single_listing_image><img src=".base_url()."/images/gigs/".$row->image." width=100 height=70><br/>									
									</div>	<div id=single_listing_content><a href=".site_url('gig/single/'.$row->id)." class=listing-title>".$row->title."</a>".
					"<p class='metadata'><b>Posted under:</b> ".$this->Common_model->categoryname($row->category)."<br><br><b>Working Days:</b> ".$row->maxnumofdays."</p><br/>".$row->description."</div></div>";
		}
	}
	else {
		$selling = "This member does not provide any services as of now";
	}
		
		return $selling;
		
	}
}
?>