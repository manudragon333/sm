<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model{
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function db_insert($inserts, $table) {
        $this->db->insert($table, $inserts);
        return $this->db->insert_id();
    }

    function db_update($updates,$id,$table) {
        $this->db->where('id', $id);
        return $this->db->update($table, $updates);
    }

    /*
     * Basic DB Insert/update Process.
     * @param $post_data => POST Data.
     * @param $table_name => TABLE Name
     * Function uses list_fields to get the DB Columns and filters the post data to save the required column data.
     */
    function saveRecord($post_data, $table_name){
        $post=(array) $post_data;
        $tableFields=$this->db->list_fields($table_name);
        // print_r($tableFields); die;
        if (!empty($tableFields)) {
            $data = array();
            foreach ($post as $k => $v) {
                if (in_array($k, $tableFields)) {
                    $data[$k] = $v;
                }
            }
            if (isset($data['id']) && !empty($data['id'])) {
                $id=$data['id'];
                unset ($data['id']);
                return $this->db_update($data, $id, $table_name);
            } else {
                return $this->db_insert($data,$table_name);
            }
        }else{
            return 0;
        }
    }

    /*
     * Same as saveRecord method. ONLY Diff is - if the DB primary column name is other than `id` saveRecord method cannot be used.
     * So, in this method we can pass a extra param which is the primary column name of the table.
     */
    function customSaveRecord($post_data, $table_name, $customID='id'){
        $post=(array) $post_data;
        $tableFields=$this->db->list_fields($table_name);
        // print_r($tableFields); die;
        if (!empty($tableFields)) {
            $data = array();
            foreach ($post as $k => $v) {
                if (in_array($k, $tableFields)) {
                    $data[$k] = $v;
                }
            }
            if (isset($data[$customID]) && !empty($data[$customID])) {
                $id=$data[$customID];
                unset ($data[$customID]);
                return $this->custom_db_update($data, $id, $table_name, $customID);
            } else {
                return $this->db_insert($data,$table_name);
            }
        }else{
            return 0;
        }
    }

    function custom_db_update($updates,$id,$table,$customID) {
        $this->db->where($customID, $id);
        return $this->db->update($table, $updates);
    }

    /*
     * Grid Call to get the DB Data.
     * @param $post => post values as it is.
     * @param $query => Query to get the data req for the JQGrid.
     * Returns the Data fetched from DB in a format.
     * Returned data can be then modified accordingly.
     */
    function get_jqgrid_data($post,$query){
        $page = $post['page']; // get the requested page
	$limit = $post['rows']; // get how many rows we want to have into the grid
	$sidx = $post['sidx']; // get index row - i.e. user click to sort
	$sord = $post['sord']; // get the direction
	if(!$sidx) $sidx =1;

	// mysql_select_db($database) or die("Error conecting to db.");
	// $result = mysql_query("SELECT COUNT(*) AS count FROM jobs");

        $res=$this->db->query($query);
        
	// $row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $res->num_rows();

	if( $count >0 ) {
		$total_pages = ceil($count/$limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if($start<1){ $start=0; }

        // $SQL = "SELECT * FROM jobs ORDER BY $sidx $sord LIMIT $start , $limit";
	// $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
        $sql2=$query." ORDER BY $sidx $sord LIMIT $start , $limit";
        $res2=$this->db->query($sql2);
        $result=$res2->result_array();

	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->db_data=$result;

        // print_r($responce); die;
        return $responce;
    }
    
}

?>