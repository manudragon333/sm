<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function polldetails($type,$uid){
			$sql="select p.id as pid,p.question,po.id as poid,po.label,
					count(pu.poll_option_id) as poll_tot,ifnull(pu2.user_id,'') as puid,
					(select count(pu3.id) as dd from poll_users pu3 where pu3.poll_id=p.id) as tot
					from polls as p 
					left join poll_options as po on p.id=po.poll_id
					left join poll_users as pu on pu.poll_option_id=po.id
					left join poll_users as pu2 on pu2.poll_id=p.id and pu2.user_id='".$uid."'
					where po.label is not null and p.status='1' and po.status='1' 
					and (p.access='".$type."' or p.access='3') group by po.id";
        $res = $this->db->query($sql);
		$res_array=array();
       foreach($res->result()as $row){
			if(array_key_exists($row->pid,$res_array)){
					$res_array[$row->pid]['options'][]=array('id'=>$row->poid,'label'=>$row->label,'votes'=>$row->poll_tot,'is_voted'=>$row->puid,'tot'=>$row->tot);
			}else{
					$res_array[$row->pid]['id']=$row->pid;
					$res_array[$row->pid]['puid']=$row->puid;
					$res_array[$row->pid]['is_voted']=$row->puid;
                                        $res_array[$row->pid]['question']=$row->question;
					$res_array[$row->pid]['options'][]=array('id'=>$row->poid,'label'=>$row->label,'votes'=>$row->poll_tot,'is_voted'=>$row->puid,'tot'=>$row->tot);
			}
	   
	   }
	   return $res_array;
    }

    function checkpollforuser($uid,$op_id,$pid){
			$sql=$this->db->query("select id from poll_users where user_id='".$uid."' and poll_id='".$pid."' and poll_option_id='".$op_id."'");
			if($sql->num_rows()>0){
				return 0;
			}else{
				return 1;
			}
	}
	 function polldata($id){
		$sql=$this->db->query("select p.pid,p.question,p.start_date,p.end_date,p.access,po.id as poid,po.label from polls as p
left join poll_options as po on p.id=po.poll_id
where  p.id=2");
		$res_array=array();
       foreach($sql->result()as $row){
			if(array_key_exists($row->pid,$res_array)){
					$res_array[$row->pid]['options'][]=array('id'=>$row->poid,'label'=>$row->label);
			}else{
					$res_array[$row->pid]['id']=$row->pid;
					$res_array[$row->pid]['question']=$row->question;
					$res_array[$row->pid]['start_date']=$row->start_date;
					$res_array[$row->pid]['end_date']=$row->end_date;
					$res_array[$row->pid]['access']=$row->access;
					$res_array[$row->pid]['options'][]=array('id'=>$row->poid,'label'=>$row->label);
			}
	   
	   }
	   return $res_array;
	
	}

function pollResult($id)
{
//$sql=
}
}

?>
