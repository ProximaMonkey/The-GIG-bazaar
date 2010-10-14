<?php
class Main_model extends Model {

    function Main_model()
    {
        parent::Model();
				$this->load->database();
		}
	
		function add_member()
		{
			$datestring = date("Y-m-d");
			$uniqueid = date("Ymd").uniqid();
			$fbdata = array(
							'user'		=> $this->facebook_connect->user,
							'user_id'	=> $this->facebook_connect->user_id,
					);
			if($fbdata['user_id'] != '')
			{
				$facebook_id = $fbdata['user_id'];
				$name = $fbdata['user']['name'];
				$verified = 'y';
				$picture = $fbdata['user']['pic_square'];				
			}
			else {
				$facebook_id = "";
				$name = "";
				$verified ='n';
				$picture ='';
			}
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
				$this->email->subject('Verify Email address: TheGigBazaar.com');
				$this->email->message('Hi'.$username.'<br><br>Please verify your email address by clicking on the link below.
				<a href='.site_url('member/verify/'.$uniqueid).'>Click here</a>
				<br>The Gig bazaar Team<br><br><b>If you have any queries regarding the email, please email us at <a href=mailto:support@thegigbazaar.com>support@thegigbazaar.com</a>');
				$this->email->send();
			}
			
		}
		function gig_listing_homepage($num,$offset,$sort)
		{
				$list = "";
				$count = 1;
				$this->db->orderby('id','DESC');
				$this->db->where('approved','y');
				$this->db->where('member_disabled','n');
				switch($sort)
				{
					case "hot":
					$this->db->orderby('views','DESC');
					break;
					
					case "fav":
					$this->db->orderby('favs','DESC');
					break;
					
					case "recent":
					$this->db->orderby('date_added','DESC');
					break;
					
				}
				$query = $this->db->get('gigs',$num,$offset);
				foreach($query->result() as $row)
				{
					
					$list .= "
					<div class='gig'>
					<div class='order'>
					<div class='order-button'>
						<a href='".site_url('gig/order/'.$row->id)."' class='button-links orderpadding'>Order this GIG</a>
					</div><!--order button ends-->
					<div class='order-time'>ordered ".$this->ordercount($row->id)." times</div><!--order-time ends-->
					</div><!--order ends-->
					<span class='serial'>".$count++.".</span>
					<div class='favorite-views'>
					<div class='view'><span id='savecount".$row->id."' class='".$this->savecount($row->id)."'>".$this->savecount($row->id)."</span><br/>";
					if($this->session->userdata('logged_in') == TRUE)
					{
					if($this->check_savestatus($row->id,$this->session->userdata('id')) == 'saved')
					{
							$list .= "<span id='heart_icon$row->id'><img src='".base_url()."/images/heart_filled.png'></span>";
					}
					else {
						$list .= "<span class='save_button' id='save_button".$row->id."'><a href='#' class='save_gig' id='".$row->id."'><span id='heart_icon$row->id'><img src='".base_url()."/images/heart_empty.png'></span></a>";
					}
					}
					else {
						$list .= "<span><a href='".site_url('main/login')."'><img src='".base_url()."/images/heart_empty.png'></span></a>";
					}
					$list .= "
					<!--<iframe src='http://www.facebook.com/plugins/like.php?href=".site_url('gig/single/'.$row->id)."&amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=lucida+grande&amp;colorscheme=light&amp;height=21' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:450px; height:21px;' allowTransparency='true'></iframe>-->
					
					</div><!--view ends-->
					</div><!--favorite-views ends-->
					<div class='gig-image'><img src='".base_url()."/assets/timthumb.php?src=".base_url()."/images/gigs/".$row->image."&h=56&w=56&zc=1 alt=''></div><!--blog image ends-->
					
					<div class='gig-content'>
					<div class='heading-of-gig'><b><a href='".site_url('gig/single/'.$row->id)."' class=listing-title>$row->title</a></b></div><!--heading of bg ends-->
					<div class='by'>By <a href='".site_url('user/view/'.$this->Common_model->getusername($row->member_posted_by))."'>".$this->Common_model->convertname($row->member_posted_by)."</a></div><!--by ends-->
					<div class='tag-bg-left'>Tagged as</div>
					
					";
						
						$tags = explode('-',$row->tags);
						$count1 = 0;
						foreach($tags as $tag)
						{
							if($count1 < 10)
							{
								if($tag != "")
								{
									if (!ereg('[^A-Za-z0-9]',$tag)) 
									{
									$list .= "<div class='tag-bg-right'><a href='".site_url('gig/tagfilter/'.$tag)."'>".strip_tags($tag)."</a></div>";
									}
								}
							}
							$count1++;
						}
						
						$list .= "</div><!--tag ends-->
						
					
					<br  clear='left' /></div>
					
					";
						/*$list .= '<div id=single_listing>
							<div id=single_listing_image><br/>
									</div>
							<div id=single_listing_content><a href='.site_url('service/single/'.$row->id).' class=listing-title>'.$row->title.' </a>'.
						substr(strip_tags($row->description),0,100).'...</div>

								<div id=order><a href='.site_url('service/single/'.$row->id).' class="">Read more</a></div>
								<div id=meta>Posted by: <a href="'.site_url('user/view/'.$this->Common_model->getusername($row->member_posted_by)).'">'.$this->Common_model->convertname($row->member_posted_by).'</a> on '.$this->Common_model->convert_date($row->date_added).'</div>
									<div id=share><a href='.site_url('service/single/'.$row->id).'>Comment</a> |	
									';
									if($this->check_savestatus($row->id,$this->session->userdata('id')) == 'saved')
									{
									$list .=  '<span class="save_button" id="save_button'. $row->id.'"><a href="#" class="save_gig" id="'.$row->id.'">Save</a></span><span class="save_message" id="save_message'.$row->id.'"></span>';
									}	
									else {
										$list .= "Saved";
									}
									$list .= "</div></div>";*/
				}
				return $list;
		}
		
		function check_savestatus($gigid,$memberid)
		{
			$this->db->where('gigid',$gigid);
			$this->db->where('memberid',$memberid);
			$query = $this->db->get('member_save');
			$count = $query->num_rows();
			if($count > 0)
			{
				return "saved";
			}
			else {
				return "notsaved";
			}
			
		}
		
		function savecount($gigid)
		{
				$this->db->where('gigid',$gigid);
						$query = $this->db->get('member_save');
				$count = $query->num_rows();
				
				return $count;
		}
		function ordercount($gigid)
		{
				$this->db->where('gigid',$gigid);
				$query = $this->db->get('orders');
				$count = $query->num_rows();
				
				return $count;
		}
		function checkuser($email)
		{
			$this->db->where('member_facebook',$email);
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
		function register_user($id,$email,$name,$username)
		{
			$datestring = date("Y-m-d");
			$uniqueid = date("Ymd").uniqid();
			$data = array(
				'member_username' => $username,
				'member_email' => $email,
				'member_password' => $uniqueid,
				'member_dateadded' => $datestring,
				'member_verified' => 'y',
				'member_verification' => $id
				);

			$this->db->insert('members', $data);
		}
	
}
