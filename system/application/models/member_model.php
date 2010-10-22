<?php
class Member_model extends Model {

    function Member_model()
    {
        parent::Model();
				$this->load->database();
		}

		function check_activated($em)
		{
			$this->db->where('member_email', $em);
			$this->db->where('member_verified', 'y');
			$query = $this->db->get('members');		
			if ($query->num_rows() > 0)
			{
				$check = "yes";
			}
			else 
			{
				$check = "no";
			}	
			return $check;
		}
		function check_email($email_address)
		{
			$this->db->where('member_email', $email_address);
			$query = $this->db->get('members');

			if ($query->num_rows() > 0)
			{
				$check = "success";
				}
			else 
			{
				$check = "failed";
			}		
			return $check;
		}
		
		function item_selling($id)
		{
			$selling = "";
			//Get the details
			$this->db->orderby('id',"DESC");
			$this->db->where('member_posted_by',$id);
			$query = $this->db->get('gigs');
			$num = $query->num_rows();
			$selling .= "<br/><b>You are selling a total of ".$num." items</b><br/><br/>";
			foreach($query->result() as $row)
			{
				if($row->member_disabled == 'y')
				{
					$selling .= "<div id='single_listing' style='background:#ddd;border-bottom:10px solid #fff;'>";
				}
				else {
					$selling .= "<div id='single_listing'>";
				}
				
					$selling .= "<div id=single_listing_image>
					<img src=".base_url()."/assets/timthumb.php?src=".base_url()."/images/gigs/".$row->image."&h=70&w=100&zc=1\" alt=''>
					<br/></div><div id=single_listing_content><a href=".site_url('gig/single/'.$row->id)." class=listing-title>".$row->title."</a>".
						substr(strip_tags($row->description),0,100)."...</div>						
							
							<div id=meta>Posted on ".$this->Common_model->convert_date($row->date_added)." - View: - $row->views - <a href='".site_url('gig/edit/'.$row->id)."'>Edit</a> | <a href='".site_url('gig/delete/'.$row->id)."'>Delete</a> |";
								if($row->member_disabled == 'y')
								{
									$selling .= "<a href='".site_url('gig/enable/'.$row->id)."'>Enable</a></div>";
								}
								else {
									$selling .= "<a href='".site_url('gig/disable/'.$row->id)."'>Disable</a></div>";
								}
					 
								$selling .= " </div>";
			}
			
			return $selling;
			
		}
		function gigs_foryou($id)
		{
			$foryou = "";
			$gigid = "";
			//Get the details
			$this->db->where('order_for',$id);
			$query = $this->db->get('orders');
			$num = $query->num_rows();		
			$foryou .= "<br/><br/><b>You have a total of ".$num." orders</b><br/><br/>";

			foreach($query->result() as $gigs)
			{
				
				$title = $this->get_gigtitle($gigs->gigid);
				$order_status = $this->get_orderstatus($gigs->orderid);
				
				if($gigs->order_accepted == '0')
				{
					$status = "Not accepted";
				}
				if($gigs->order_accepted == '1')
				{
					$status = "In Progress";
				}
				if($gigs->order_accepted == '2')
				{
					$status = "Completed";
				}
				if($gigs->order_accepted == '3')
				{
					$status = "You rejected the order";
				}
				
					$foryou .= '<div class=single_order>
									<div class=order_date>
						Date:<br/> '.$gigs->order_date.'</div>
						<div class=order_title><a href='.site_url('gig/single/'.$gigs->gigid).' class=listing-title>'.$title.' </a></div>
						<div class=order_status>'.$status.'</div>
						<div class="order_actions">';
						if($order_status == '1')
						{
							$foryou .= "<b style='color:green'>Gig Accepted on: </b>".$gigs->order_accept_date." | <a href='".site_url('gig/completed/'.$gigs->orderid)."'>Gig Completed</a>";
						}
						if($order_status == '3')
						{
							$foryou .= "<b style='color:red'>Gig Rejected on: </b>".$gigs->order_accept_date;
						}
							if($order_status == '2')
							{
								$foryou .= "<b style='color:green'>Gig marked as completed on: </b>".$gigs->order_delivered_date;
							}
						
						if($order_status == "0"){
							$foryou .= '<a href="'.site_url('gig/acceptorder/'.$gigs->orderid).'">Accept this order</a> | <a href="'.site_url('gig/rejectorder/'.$gigs->orderid).'">Reject this order</a>';
						}
						if($gigs->order_for != $this->session->userdata('id'))
						{
						$foryou .= ' | Send a message to <a href="'.site_url('member/sendmessage/'.$this->Common_model->getusername($gigs->order_for)).'">'.$this->Common_model->convertname($gigs->order_for).'</a>';
						}
						$foryou .= '</div></div>';
						}
			
			return $foryou;
			
		}
		function gigs_ordered($id)
		{
			$ordered = "";
			$gigid = "";
			$status = "";
			//Get the details
			$this->db->where('order_by',$id);
			$query = $this->db->get('orders');
			$num = $query->num_rows();		
			$ordered .= "<br/><br/><b>You have ordered a  total of ".$num." items</b><br/><br/>";
			foreach($query->result() as $row)
			{
				$gigid .= $row->gigid.",";
			}
			$gig_explode = explode(',',$gigid);
			
			foreach($query->result() as $gigs)
			{
					$title = $this->get_gigtitle($gigs->gigid);
					if($gigs->order_accepted == '0')
					{
						$status = "Not accepted";
					}
					if($gigs->order_accepted == '1')
					{
						$status = "In Progress";
					}
					if($gigs->order_accepted == '2')
					{
						$status = "Completed";
					}
					if($gigs->order_accepted == '3')
					{
						$status = "<font color='red'>Order Rejected</font>";
					}
					$ordered .= '<div class=single_order>
									<div class=order_date>
						Date:<br/> '.$gigs->order_date.'</div>
						<div class=order_title><a href='.site_url('gig/single/'.$gigs->gigid).">".$title.' </a></div>
						<div class=order_status><b>Current Status:</b> '.$status.'</div>';
						if($gigs->order_accepted != '2')
						{
							$ordered .= '<div class="order_actions">	<a href="'.site_url('gig/contactseller/'.$gigs->orderid).'">Contact Seller</a>';
							if($gigs->order_accepted != '3')
							{
								$ordered .= ' | <a href="'.site_url('gig/cancelorder/'.$gigs->orderid).'">Cancel order</a></div>';
							}
						}
						else {
							//Check if a dispute has been raised
							if($gigs->order_dispute != '1')
							{
							
							$current_date = date('Y-m-d');
							$completed_date = $gigs->order_delivered_date;							
							$diff = abs(strtotime($current_date) - strtotime($completed_date));
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
								if($days <= 15)
								{
							$ordered .= '<div class="order_actions">	<a href="'.site_url('gig/contactseller/'.$gigs->orderid).'">Contact Seller</a> | <a href="'.site_url('gig/dispute/'.$gigs->orderid).'">File Dispute</a></div>';
							
								}
							}
							else {
									$ordered .= '<div class="order_actions">	<a href="'.site_url('gig/contactseller/'.$gigs->orderid).'">Contact Seller</a> | <font color=red>Dispute Raised</font> </div>';
							}
						
						}
				}
															
							
				return $ordered;
			
		}
		function get_member_detail($id)
		{
			if($id != "-1")
			{
			$this->db->where('id', $id);
			$query = $this->db->get('members');
			$row = $query->row();
			$data['member_email'] = $row->member_email;
			$data['member_name'] = $row->member_name;			
			$data['member_description'] = $row->member_description;
			$data['member_paypal'] = $row->member_paypal;
			$data['facebook'] = $row->member_facebook;
			}
			else {
				$data['member_name'] = "Thegigbazaar System";
			}
			return $data;
		}
		
		function withdraw()
		{
			$amount = "";
			$count = "";
			$qid = "";
			$withdraw['qid'] = "";
			$data['inqueue'] = "";
				$this->db->where('payment_to', $this->session->userdata('id'));
					$this->db->where('payment_processed', 'n');				
				$query = $this->db->get('payment_queue');
				foreach($query->result() as $row)
				{
					//Check if the dispute has been raised for this gig
					$this->db->select('order_id,order_dispute');
					$this->db->where('orderid',$row->paymentfor);
					$q = $this->db->get('orders');
					$r = $q->row();
					if($r->order_dispute != '1')
					{
						$completed = $row->date_completed;;
						$today = date('Y-m-d');
						
						$diff = abs(strtotime($completed) - strtotime($today));
						$years = floor($diff / (365*60*60*24));
						$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
						$daysdiff = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						if($daysdiff >= 15)
						{
							$qid .= $row->id.",";
							//echo $qid."<br/>";
							$count++;
						}
					}					
				}
				if($count <= "0")
				{
					$withdraw['total_amount'] = "0";
					$withdraw['disabled'] = "1";
					
				}
				else {
					$amount = 500 * $count;
					$percent = number_format((($amount * 20) / 100),2);
					$final = $amount-$percent;
					
					$amount = $final;
					
					$this->db->where('accepted','0');
					$this->db->where('request_from',$this->session->userdata('id'));
					$q = $this->db->get('withdraw');
					$r = $q->row();
					if($q->num_rows() > 0)
					{
						$current = $r->amount;
						$withdraw['inqueue'] = "There is amount waiting to be processed : Amount:".$current;
					}
					else {
						$current = "0";
					}
					if($current > 0)
					{
						$current_amount = "[".$current." in queue to be processed]";
					}
					else {
						$current_amount = "";
					}
					$withdraw['amount'] = $amount;
					$withdraw['qid'] = $qid;
					$withdraw['total_amount'] = "<b id='highlight'>".CURRENCY.$amount."</b>".$current_amount;
					$withdraw['disabled'] = "0";
					if($amount < '1000')
					{
						$withdraw['submit'] = "disabled";
						$withdraw['error'] = "You do not have enough balance to make the withdrawal.<br/><br/>Minimum balance required is : <b id='highlight'>".CURRENCY.MINIMUM_BALANCE."</b>";
					}
					else if($amount == $current){
						$withdraw['submit'] = "disabled";
						$withdraw['error'] = "There is already a payment to be processed in queue.";
					}
					else {
						$withdraw['submit'] = "";
						$withdraw['error'] = "";
						
					}
				}			
				
				return $withdraw;
		}
		
		function balance($id)
		{
			$amount = "";
			$this->db->where('payment_to', $id);
			$this->db->where('payment_processed','0'); // Get all the unpaid payments only
			$query = $this->db->get('payment_queue');
				foreach($query->result() as $row)
				{
					$amount .= $amount + $row->amount;
				}
				$total_amount = $amount;
				
				return $total_amount;
		}
		
		function payment_queue($id)
		{
			$qu = "";
			$this->db->where('request_from', $id);
			$this->db->where('accepted','0'); // 0 = Payment is not yet processed
			$query = $this->db->get('withdraw');
			$row = $query->row();
			$count = $query->num_rows();			
			$qu['count'] = $count;
			//$qu['date'] = $this->convert_date($row->request_date);	
			return $qu;
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
		
		function get_gigtitle($gigid)
		{
			$this->db->where('id',$gigid);
			$query = $this->db->get('gigs');
			$row = $query->row();
			$title = $row->title;			
			return $title;
			
		}
		
		function get_orderstatus($id)
		{
			$this->db->where('orderid',$id);
			$query = $this->db->get('orders');
			$row = $query->row();
			$status = $row->order_accepted;
			return $status;
		}
		
		function get_inbox()
		{
			$inbox = "";
			$this->db->orderby('id','DESC');			
			$this->db->where('message_to', $this->session->userdata('id'));
			//$this->db->group_by("message_reply_to"); 
			$query = $this->db->get('messages');
			if($query->num_rows() > 0)
			{
			foreach($query->result() as $row)
			{
				$inbox .= "<div id='single_message'><div id='message_text'>";
				$title = $this->get_member_detail($row->message_from);
				$subject = $row->subject;
				if($row->message_read == 0)
				{
					$inbox .= "<img src='".base_url()."/images/message.png' align='absmiddle' class='icon'><b><a href='".site_url('member/readmessage/'.$row->id)."'>".$subject."</a></b>";
				}
				else {
					$inbox .= "<img src='".base_url()."/images/message_read.png' align='absmiddle' class='icon'><a href='".site_url('member/readmessage/'.$row->id)."'>".$subject."</a>";
				}
			
				$inbox .= "</div><div id='message_date'>Sent on: $row->message_sent</div><div id='message_by'>Sent By:".$this->Common_model->convertname($row->message_from)."<span style='float:right'>Delete<input type='checkbox' value='$row->id' name='delete_inbox[]'></span></div></div>	";				
			}
			
			$inbox .= "<div style='float:right;margin-top:20px;'><input type='submit' value='delete' /></div>";
			}
			else {
				$inbox = "<br><br/><br/><center><u>No messages for you yet</u></center>";
			}
			return $inbox;		
			
		}
		function getmessage($id)
		{
				if($id != "")
				{
					$this->db->where('id',$id);
					$query = $this->db->get('messages');
					$row = $query->row();
					$message['subject'] = $row->subject;
					$message['message'] = $row->message;
					$message['message_sent'] = $row->message_sent;
					if($row->message_from == '-1')
					{
						$message['reply'] = 'disable';
					}	
					else {
						$message['reply'] = 'active';
					}
					$message['id'] = $row->id;	
					if($row->message_read == '0')
					{
						$data = array('message_read'=>'1');
						$this->db->where('id',$id);
						$this->db->update('messages',$data);
					}			
				}
				return $message;	
		}	
		
		function getreply($id)
		{
			$replies = "";
				if($id != "")
				{
					$this->db->where('message_reply_to',$id);
					$query = $this->db->get('messages');
					foreach($query->result() as $row)
					{
						$replies .= "<div id='reply'>".$row->message."</div>";					
					}
					
					return $replies;
					
				}
			
			
			
		}	
	
}
