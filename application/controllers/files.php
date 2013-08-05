<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        // $this->load->model('');
    }
    
    public function index()
    {
        
    }

    function upload(){
    
        $data['content_page']='files/upload';
        $this->load->view('common/base_template',$data);
    }

    function start_upload(){
        if($this->input->post()){
            $post=$this->input->post();
            //echo '<pre>';
            //print_r($_FILES);
            
            if($_FILES["zip_file"]["name"]) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
 
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
 
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$message = "The file you are trying to upload is not a .zip file. Please try again.";
		$flag = "notzip";
	}
 
	 $target_path = "/home/content/44/9286944/html/kits/files/".$filename;  // change this to the correct site path
	if(move_uploaded_file($source, $target_path)) {
		
		$zip = new ZipArchive();
		$x = $zip->open($target_path, ZIPARCHIVE::OVERWRITE);
		if ($x === true) {
			$zip->extractTo("/home/content/44/9286944/html/kits/files"); // change this to the correct site path
			$zip->close();
 
			unlink($target_path);
		}
		$message = "Your .zip file was uploaded and unpacked.";
		$flag = "success";
	} else {	
		$message = "There was a problem with the upload. Please try again.";
		$flag = "Error";
	}
}
        }
        header("Location: upload?status=".$flag);
    }

    function mail_file($to, $from, $subject, $body, $file){
        $boundary=md5(rand());
        $headers = array(
            'MIME-Version: 1.0',
            "Content-Type: multipart/mixed; boundary=\"{$boundary}\"",
            "From: {$from}"
        );
        if(is_array($file)){
            $message = array(
                "-- {$boundary}",
                'Content-Type: text/plain',
                'Content-Transfer-Encoding: 7bit',
                '',
                chunk_split($body),
                "---{$boundary}",
                "Content-Type: {$file['type']}; name=\"{$file['name']}\"",
                "Content-Disposition: attachment; filename=\"{$file['name']}\"",
                "Content-Transfer-Encoding: base64",
                '',
                chunk_split(base64_encode(file_get_contents($file['path']))),
                "--- {$boundary}--"
            );
        }else{
            $message = array(
                "-- {$boundary}",
                'Content-Type: text/plain',
                'Content-Transfer-Encoding: 7bit',
                '',
                chunk_split($body),
                "---{$boundary}",
            );
        }
        $message = array(chunk_split($body));
       // print_r(implode("\r\n", $message));
       @mail($to, $subject, implode("\r\n", $message), implode("\r\n", $headers));
    }
       

}

?>
