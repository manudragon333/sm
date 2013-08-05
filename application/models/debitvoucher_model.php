<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Debitvoucher_model extends CI_Model {
  function __construct() {
    // Call the Model constructor
    parent::__construct();
  }

  function check_debitvoucher($post) {

    $sql = "select * from debit_vouchers where vorefno='" . $post['vorefno'] . "'";
    $res = $this -> db -> query($sql);
    return $res -> result_array();
  }

  function addvoucher($post) {
/*
echo "<pre>";
print_r($post);
echo "</pre>";
*/
		  $this->db->query("insert into debit_vouchers (`vorefno`, `vcreationdate`, `debitedto`, `type`,`received`,`createdby`,`college_code`) values('".$post['vorefno']."','".$post['vcreationdate']."','".$post['debitedto']."','".$post['type']."','".$post['received']."','".$post['createdby']."','".$post['college_code']."')");
			
			$particulars_count = count($post['payment_details']);
          
			
	for($i=0;$i<$particulars_count;$i++) {
		
	//echo "insert into debit_payment_particulars (`vorefno`, `particulars`, `amount`) values('".$post['vorefno']."','".$post['payment_details'][$i]."','".$post['amount'][$i]."')";
	//exit;
		$this->db->query("insert into debit_payment_particulars (`vorefno`, `particulars`, `amount`) values('".$post['vorefno']."','".$post['payment_details'][$i]."','".$post['amount'][$i]."')");;
	
  }
  
  $amount = -$post['received'];
   $sql = "SELECT * FROM cashbook ORDER BY id DESC LIMIT 1";
          $res = $this->db->query($sql);
          $row = $res->result();
          $op_balance = 0;
          if($row)
          {
              $prevbalance = $row[0]->balance;
              $totbalance = $prevbalance+$amount;
             
          }
          else
          {
              $totbalnce = $amount;
          }
          if($post['type']==1)
          {
             $type='Cash'; 
          }
          elseif( $post['type']==2)
          {
              $type = 'DD';
          }
          elseif( $post['type']==3)
          {
              $type = 'Cheque';
          }
          else
          {
              $type = 'Other';
          }
         // echo $type;
          
          $this->db->set('date',date("y-m-d"));
          $this->db->set('debit_ammount', $post['received']);
          $this->db->set('debit_details', $post['debitedto']);
          $this->db->set('debit_type',$type);
          $this->db->set('debit_rec_no', $post['vorefno']);
          $this->db->set('updated_by', $post['createdby']);
           $this->db->set('balance', $totbalance);
           $this->db->insert('cashbook');
}
    
    
    function update_cashbook_debit($post)
{
    
   
    $amount = -$post['received'];
    
  
    $this->db->select('*');
     $this->db->where('date >=', date('Y-m-d'));
     $res = $this->db->get('cashbook');
      $nors = $res->result();
      if($nors)
      {
         
          $data['balance']=$nors[0]->balance+$amount;
          $this->db->where('id',$nors[0]->id);
          $this->db->update('cashbook', $data);
          
      }
      else
      {
          
          $sql = "SELECT * FROM cashbook ORDER BY id DESC LIMIT 1";
          $res = $this->db->query($sql);
          $row = $res->result();
          $op_balance = 0;
          if($row)
          {
              $op_balance = $row[0]->op_balance;
              $amount = $op_balance+$amount;
              $this->db->set('op_balance', $row[0]->balance );
          }
         
          $this->db->set('date',date("Y-m-d"));
          $this->db->set('balance',$amount);
          $this->db->insert('cashbook');
          //echo $n = mysql_affected_rows();
          }
   
    
    
}
}
?>
