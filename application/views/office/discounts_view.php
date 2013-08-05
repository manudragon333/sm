<?
if(isset($paid1))
//echo $paid1;
if(isset($paid2))
//echo $paid2;
if(isset($paid3))
//echo $paid3;
if(isset($paid4))
//echo $paid4."<br>";
//if(isset($a))
$v=0;$data=array();
if(isset($course))
$v=$course;
if(isset($fee1))
$data['fee1']=$fee1;
else
$data['fee1']=0;
if(isset($fee1))
$data['fee2']=$fee2;
else
$data['fee2']=0;
if(isset($fee1))
$data['fee3']=$fee3;
else
$data['fee3']=0;
if(isset($fee4))
$data['fee4']=$fee4;
else
$data['fee4']=0;


if($v=="1")
$this->load->view('office/btech_discounts',$data);
else if($v=="2")
$this->load->view('office/btech_discounts');
else if($v=="3")
$this->load->view('office/btech_discounts');
else if($v=="4")
$this->load->view('office/btech_discounts');
else if($v=="5")
$this->load->view('office/btech_discounts');




echo $user_id;
?>