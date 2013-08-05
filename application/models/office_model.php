<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function sample(){
        $sql="";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_id_card_details($id){
        $sql="select i.*,b.name as branch_name from id_card_applications as i
                    left join branches as b on b.id=i.branch
                    where i.is_issued!='1' and i.id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_processed_id_cards($student_number){
        $sql="select i.*,b.name as branch_name from id_card_applications as i
                    left join branches as b on b.id=i.branch
                    where i.is_issued='1' and i.stu_number='$student_number'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_bus_pass_details($id){
        $sql="select bpa.*,b.name as branch_name,c.name as course_name,bp.name as boarding_point from bus_pass_applications as bpa
                    left join branches as b on b.id=bpa.branch
                    left join courses as c on c.id=bpa.course
                    left join boarding_points bp on bp.id=bpa.start_from
                    where bpa.is_issued!='1' and bpa.id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_study_certi_details($id){
        $sql="select sc.*,c.name as course_name from study_certi_applications as sc
                    left join courses as c on c.id=sc.course
                    where is_issued!='1' and sc.id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_processed_study_certi($student_number){
        $sql="select sc.*,c.name as course_name from study_certi_applications as sc
                    left join courses as c on c.id=sc.course
                    where is_issued='1' and sc.stu_number='$student_number'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_conduct_certi_details($id){
        $sql="select ca.*,c.name as course_name from conduct_applications as ca
                    left join courses as c on c.id=ca.course
                    where is_issued!='1' and ca.id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_processed_conduct_certi($student_number){
        $sql="select ca.*,c.name as course_name from conduct_applications as ca
                    left join courses as c on c.id=ca.course
                    where is_issued='1' and ca.stu_number='$student_number'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_processed_tc($student_number){
        $sql="select sr.*,c.name as course_name,b.name as branch_name from tc_applications as ta
                   left join student_records as sr on ta.user_id=sr.user_id
                   left join courses as c on c.id=sr.course_id
                   left join branches as b on b.id=sr.branch_id
                   where is_issued='1' and sr.students_number='$student_number'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_tc_details($id){
        $sql="select sr.*,c.name as course_name,cas.name as caste,b.name as branch_name from tc_applications as ta
                   left join student_records as sr on ta.user_id=sr.user_id
                   left join courses as c on c.id=sr.course_id
                   left join branches as b on b.id=sr.branch_id
				   left join castes as cas on cas.id=sr.caste_id
                   where is_issued!='1' and ta.id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_fee_details($student_number){
        $sql="select ifnull(sf.id,0) as id,sf.fee1,sf.fee2,sf.fee3,sf.fee4,sr.user_id from student_records as sr
                left join student_fees as sf on sr.user_id=sf.user_id
                where sr.students_number='$student_number'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_payslip_details($id){
        $sql="select psr.*,sr.name,sr.code,sr.email,sr.mobile,sr.salary,sr.status from pay_slip_requests as psr
                    left join staff_records as sr on sr.user_id=psr.user_id
                    where psr.is_issued!='1' and psr.id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_request_counts($sql){
        $res = $this->db->query($sql);
        return $res->num_rows();
    }
function get_fee_profile($user_id)
{
        $sqlx="select * from student_fees where user_id='".$user_id."'";
        $sql="select sr.*,b.name as branch_name,co.name as college_name,cu.name as course_name, ifnull(sf.fee1,'-') as fee1,ifnull(sf.fee2,'-') as fee2,ifnull(sf.fee3,'-') as fee3,ifnull(sf.fee4,'-') as fee4 from 
student_records as sr
                left join student_fees as sf on sf.user_id=sr.user_id
                left join branches as b on b.id=sr.branch_id
                left join colleges as co on co.id=sr.college_id
		left join courses as cu on cu.id=sr.course_id and cu.college_id=sr.college_id
                where sr.user_id='".$user_id."' and sr.status='1'";
        $res = $this->db->query($sql);
        return $res->result();


}
function update_student_fee_payment($receipt,$ffy,$tof,$amount,$ptype,$remarks,$uby,$userid)
{
$this->db->set('date',date("Y-m-d"));
$this->db->set('receipt_no',$receipt);
$this->db->set('user_id',$userid);
$this->db->insert('student_fee_ledger');
$num=mysql_affected_rows();


$sql = "SELECT * FROM cashbook ORDER BY id DESC LIMIT 1";
          $res = $this->db->query($sql);
         
         $row = $res->result();
          if($row)
          {
              $prevbalance = $row[0]->balance;
              $totbalance = $prevbalance+$amount;
             
          }
          else
         {
             $totbalance =$amount;
         }
         
$this->db->set('date',date("y-m-d"));
$this->db->set('credit_amount',$amount);
$this->db->set('credit_type',$tof);
$this->db->set('credit_rec_no',$receipt);
$this->db->set('updated_by',$uby);
$this->db->set('balance', $totbalance);
$this->db->insert('cashbook');

$this->db->set('receipt_no',$receipt);
$this->db->set('feeforyear',$ffy);
$this->db->set('typeoffee',$tof); 
$this->db->set('amount',$amount); 
$this->db->set('paymenttype',$ptype); 
$this->db->set('remarks',$remarks); 
$this->db->set('updatedby',$uby); 
$this->db->insert('student_fee_payments');
$n=mysql_affected_rows();
if($num==$n)
return $num;
return 0;
}


function update_cashbook_credit($post)
{
    
     $amount = $post['balance'];
     $tof = $post['details'];
     $receipt = 'Credit by Management';
     $uby = $post['updated_by'];
     
     $sql = "SELECT * FROM cashbook ORDER BY id DESC LIMIT 1";
          $res = $this->db->query($sql);
         
         $row = $res->result();
          if($row)
          {
              $prevbalance = $row[0]->balance;
              $totbalance = $prevbalance+$amount;
             
          }
          else
         {
             $totbalance =$amount;
         }
         
        $this->db->set('date',date("y-m-d"));
        $this->db->set('credit_amount',$amount);
        $this->db->set('credit_type',$tof);
        $this->db->set('credit_rec_no',$receipt);
        $this->db->set('updated_by',$uby);
        $this->db->set('balance', $totbalance);
        $this->db->insert('cashbook');
          //echo $n = mysql_affected_rows();
         
  
    
    
}


function get_all_transactions()
{
   
   $this->db->from('cashbook');
$this->db->order_by("date", "asc");
   $res = $this->db->get();
    $rows = $res->result();
    if($rows)
    {
        return $rows;
    }
    else
    {
    return $rows = 0;
    }
}

function get_prev_balance()
{
  $sql = "SELECT * FROM cashbook ORDER BY id DESC LIMIT 1";
          $res = $this->db->query($sql);
         
         $row = $res->result();
          if($row)
          {
              $prevbalance = $row[0]->balance;
             
             
          }
          else
         {
              $prevbalance =0;
         }
return $prevbalance;

}


function get_transations($dfrom,$dto)
{
    
$res  = $this->db->query("select * from cashbook  where date BETWEEN  '".$dfrom."'
AND  '".$dto."' order by date ASC" );

$data= $res->result();

return $data;
   
}


function get_student_ledger_profile($user_id)
{
        $sqlx="select * from student_fees where user_id='".$user_id."'";
        $sql="select sr.*,b.name as branch_name,co.name as college_name,cu.name as course_name,caste.name as caste, ifnull(sf.fee1,'-') as fee1,ifnull(sf.fee2,'-') as fee2,ifnull(sf.fee3,'-') as fee3,ifnull(sf.fee4,'-') as fee4 from 
student_records as sr
                left join student_fees as sf on sf.user_id=sr.user_id
                left join branches as b on b.id=sr.branch_id
                left join colleges as co on co.id=sr.college_id
		left join courses as cu on cu.id=sr.course_id and cu.college_id=sr.college_id
		left join castes as caste on caste.id=sr.caste_id
                where sr.user_id='".$user_id."' and sr.status='1'";
        $res = $this->db->query($sql);
        return $res->result();
}

function get_student_payments($userid,$ffy)
{
$sql="select pay.*,ledger.date as date from student_fee_payments as pay
left join student_fee_ledger as ledger on ledger.receipt_no=pay.receipt_no and ledger.user_id='".$userid."'
where pay.feeforyear='".$ffy."' and ledger.user_id='".$userid."'";
$res = $this->db->query($sql);
        return $res->result();
}

function get_college_names()
{
$res=$this->db->query("select * from colleges");
        return $res->result();

}
    
function get_course_names($q)
{
$res=$this->db->query("select * from courses where college_id='".$q."'");
        return $res->result();


}

function get_branch_names($p,$q)
{
$res=$this->db->query("select * from branches where college_id='".$q."' and course_id='".$p."'");
        return $res->result();
}


function get_stu_payments($coll,$cour,$br,$ffy,$ptype,$tof)
{
$sql="select sfp.*,sr.*,sfl.*,b.name as branch_name,co.name as college_name,cu.name as course_name
 from student_fee_payments as sfp
left join branches as b on b.id='".$br."'

left join colleges as co on co.id='".$coll."'
left join courses as cu on cu.id='".$cour."' and cu.college_id='".$coll."'

left join student_fee_ledger as sfl on sfl.receipt_no=sfp.receipt_no
left join student_records as sr on sr.user_id=sfl.user_id
where sfp.feeforyear='".$ffy."' and sfp.typeoffee='".$tof."' and sfp.paymenttype='".$ptype."' and 
sr.college_id='".$coll."'and sr.course_id='".$cour."' and sr.branch_id='".$br."'";

/*
select sr.*,b.name as branch_name,co.name as college_name,cu.name as course_name,caste.name as caste, ifnull(sf.fee1,'-') as fee1,ifnull(sf.fee2,'-') as fee2,ifnull(sf.fee3,'-') as fee3,ifnull(sf.fee4,'-') as fee4 from 
student_records as sr
                left join student_fees as sf on sf.user_id=sr.user_id
                left join branches as b on b.id=sr.branch_id
                left join colleges as co on co.id=sr.college_id
		left join courses as cu on cu.id=sr.course_id and cu.college_id=sr.college_id
		left join castes as caste on caste.id=sr.caste_id
                where sr.user_id='".$user_id."' and sr.status='1'";

*/
$res = $this->db->query($sql);
        return $res->result();
}
  
function get_student_balance($userid,$ffy)
{
$sql="select pay.*,ledger.date as date from student_fee_payments as pay
left join student_fee_ledger as ledger on ledger.receipt_no=pay.receipt_no and ledger.user_id='".$userid."'
where pay.feeforyear='".$ffy."' and ledger.user_id='".$userid."' and pay.typeoffee='Tution Fee'";
$res = $this->db->query($sql);
        return $res->result();
}

function load_coll_reports($coll)
{
$sql="select sfp.*,sr.*,sfl.*,co.name as college_name
 from student_fee_payments as sfp

left join colleges as co on co.id='".$coll."'


left join student_fee_ledger as sfl on sfl.receipt_no=sfp.receipt_no
left join student_records as sr on sr.user_id=sfl.user_id
where 
sr.college_id='".$coll."'";

$res = $this->db->query($sql);
        return $res->result();
}

function get_student_finances($userid)
{
$sql="select pay.*,ledger.date as date from student_fee_payments as pay
left join student_fee_ledger as ledger on ledger.receipt_no=pay.receipt_no and ledger.user_id='".$userid."'
where ledger.user_id='".$userid."'";
$res = $this->db->query($sql);
        return $res->result();
}

function get_fee_receipt($receiptno)
{
$sql="select sfp.*,sr.*,sfl.*, b.name as branch_name,co.name as college_name,cu.name as course_name
 from student_fee_payments as sfp

left join student_fee_ledger as sfl on sfl.receipt_no=sfp.receipt_no
left join student_records as sr on sr.user_id=sfl.user_id
left join branches as b on b.id=sr.branch_id
left join colleges as co on co.id=sr.college_id
left join courses as cu on cu.id=sr.course_id and cu.college_id=sr.college_id


where sfp.receipt_no='".$receiptno."'";
$res = $this->db->query($sql);
        return $res->result();
}

function get_day_reports($getdate)
{
$sql="select sfp.*,sr.*,sfl.*, b.name as branch_name,co.name as college_name,cu.name as course_name
 from student_fee_payments as sfp

left join student_fee_ledger as sfl on sfl.receipt_no=sfp.receipt_no
left join student_records as sr on sr.user_id=sfl.user_id
left join branches as b on b.id=sr.branch_id
left join colleges as co on co.id=sr.college_id
left join courses as cu on cu.id=sr.course_id and cu.college_id=sr.college_id
where sfl.date='".$getdate."'";

$res = $this->db->query($sql);
return $res->result();
} 


function getYear($id)
{
	
	$sql="select sem.*,ss.* from 
       semisters as sem
       left join student_semisters as ss on ss.semister_id=sem.id
      where ss.user_id='$id' and ss.is_current='1'";
$res = $this->db->query($sql);
$data= $res->result();
    $y=substr($data[0]->name,0,1);
	switch($y)
	{
	case 1:  return "I Year";
	case 2: return "II Year";
	case 3: return "III Year";
	case 4: return "IV Year";
	}


}

function GridData($college,$course,$branch,$fyear,$ptype,$tof)
{
$w_str="";
if($college==0 && $course=="" && $branch=="" && $fyear=="" && $ptype=="" && $tof=="")
$w_str="";
else
{

if($college!=0)
$w_str="where co.id=".$college;
if($course!="")
$w_str=$w_str." and cu.id=".$course;
if($branch!="")
$w_str=$w_str." and br.id=".$branch;


if($ptype!='')
{
if(($college!=0))
$w_str=$w_str." and sfp.paymenttype='$ptype'";
else
$w_str=$w_str." where sfp.paymenttype='$ptype'";

}

if($tof!="")
{
if($ptype=="" && $college==0)
$w_str=$w_str." where sfp.typeoffee='$tof'";
else
$w_str=$w_str." and sfp.typeoffee='$tof'";
}


if($fyear!='')
{
if($ptype=="" && $tof=="" && $college==0 )
$w_str=$w_str." where sfp.feeforyear='$fyear'";
else
$w_str=$w_str." and sfp.feeforyear='$fyear'";

}


}
$sql="select sfp.*,sr.*,sfl.*,co.name as college_name, cu.name as course_name,br.name as branch_name
 from student_fee_payments as sfp
left join student_fee_ledger as sfl on sfl.receipt_no=sfp.receipt_no
left join student_records as sr on sr.user_id=sfl.user_id and sr.status='1'
left join colleges as co on sr.college_id=co.id
left join courses as cu on cu.id=sr.course_id 
left join branches as br on br.id=sr.branch_id and br.college_id=co.id and br.course_id=cu.id
";


$sql=$sql.$w_str;
$res = $this->db->query($sql);
return $res->result();

}

function dueGridData($college,$course,$branch)
{
$w_str="";
if($college==0 && $course=="" && $branch=="")
$w_str="";
else
{
if($college!=0)
$w_str="where co.id=".$college;
if($course!="")
$w_str=$w_str." and cu.id=".$course;
if($branch!="")
$w_str=$w_str." and br.id=".$branch;

}


$sql="select sr.*,co.name as college_name, cu.name as course_name,br.name as branch_name, ifnull(sf.fee1,'---') as fee1,ifnull(sf.fee2,'---') as fee2,ifnull(sf.fee3,'---') as fee3,ifnull(sf.fee4,'---') as fee4
 from  student_records as sr
left join colleges as co on sr.college_id=co.id
left join courses as cu on cu.id=sr.course_id 
left join student_fees as sf on sf.user_id=sr.user_id
left join branches as br on br.id=sr.branch_id and br.college_id=co.id and br.course_id=cu.id 
";

$sql=$sql.$w_str;
//$sql=$sql."and sr.status='1'";
$res = $this->db->query($sql);
return $res->result();


}
function getDiscounts($userid)
{ 
$sql="select * from fee_discounts where userid='$userid'";
$res=$this->db->query($sql);
return $res->result();
}
function postDiscounts($d1,$d2,$d3,$d4,$userid,$upby)
{
$data = array(
   'userid' => $userid,
   'disc1' => $d1,
   'disc2' => $d2,
   'disc3' => $d3,
   'disc4' => $d4,
   'updatedon' => date("d-m-Y H:i:s"),
   'updatedby' => $upby,
   'ipaddress' =>$this->input->ip_address()
);

$this->db->from('fee_discounts')->where('userid',$userid);
if ($this->db->count_all_results() == 0) { 
$query = $this->db->insert('fee_discounts', $data);
}
else
{
$query = $this->db->update('fee_discounts', $data, array('userid'=>$userid));
}

}

function get_students_bulk_update($joinyear,$coll,$course,$branch,$at)
{
	$sql="select * from student_records where college_id='$coll' and course_id='$course' and branch_id='$branch' and admission_type_id='$at'
	and doj between '$joinyear-1-1' AND '$joinyear-12-31' and status='1'";
$res = $this->db->query($sql);
$data= $res->result();
return $data;
}
function postFee($user_id,$fee1,$fee2,$fee3,$fee4)
{

$this->db->from('student_fees')->where('user_id',$user_id);
if ($this->db->count_all_results() == 0) { 

	$data = array(
   'user_id' => $user_id,
   'id' => '',
   'fee1' => $fee1,
   'fee2' => $fee2,
   'fee3' => $fee3,
   'fee4' => $fee4
   //'ipaddress' =>$this->input->ip_address()
);
$query = $this->db->insert('student_fees', $data);
}
else
{
	$data = array(
   'fee1' => $fee1,
   'fee2' => $fee2,
   'fee3' => $fee3,
   'fee4' => $fee4
   //'ipaddress' =>$this->input->ip_address()
);

$query = $this->db->update('student_fees', $data, array('user_id'=>$user_id));
}
}
}
?>