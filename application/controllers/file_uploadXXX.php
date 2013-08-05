<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_upload extends CI_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        // $this->load->model('');
    }

    public function index() {
        
    }

    function upload() {
        $uploadDir = base_url(). '/uploads/';
        $uploadDir = "D:\wamp\www\mycollege\site\uploads\\";
        $uploadFile = $uploadDir . basename($_FILES['Filedata']['name']);
        if (true || isset($_FILES)) {
            
            // 1. submitting the html form
            if (!isset($_GET['jqUploader'])) {
                // 1.a javascript off, we need to upload the file
                if (move_uploaded_file($_FILES[0]['tmp_name'], $uploadFile)) {
                    // delete the file
                    @unlink($uploadFile);
                    $html_body = '<h1>File successfully uploaded!</h1><pre>';
                    $html_body .= print_r($_FILES, true);
                    $html_body .= '</pre>';
                } else {
                    $html_body = '<h1>File upload error!</h1>';

                    switch ($_FILES[0]['error']) {
                        case 1:
                            $html_body .= 'The file is bigger than this PHP installation allows';
                            break;
                        case 2:
                            $html_body .= 'The file is bigger than this form allows';
                            break;
                        case 3:
                            $html_body .= 'Only part of the file was uploaded';
                            break;
                        case 4:
                            $html_body .= 'No file was uploaded';
                            break;
                        default:
                            $html_body .= 'unknown errror';
                    }
                    $html_body .= 'File data received: <pre>';
                    $html_body .= print_r($_FILES, true);
                    $html_body .= '</pre>';
                }
                $html_body = '<h1>Full form</h1><pre>';
                $html_body .= print_r($_POST, true);
                $html_body .= '</pre>';
            } else {
                // 1.b javascript on, so the file has been uploaded and its filename is in the POST array
                $html_body = '<h1>Form posted!</h1><p>Error:<pre>';
                $html_body .= print_r($_POST, false);
                $html_body .= '</pre>';
            }
            myHtml($html_body);
        } else {
            if ($_GET['jqUploader'] == 1) {
                $myFile = "log.txt";
                $fh = fopen($myFile, 'w');
                $stringData = print_r($_FILES, true);
                fwrite($fh, $stringData);
                fclose($fh);
                // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // 2. performing jqUploader flash upload
                if ($_FILES['Filedata']['name']) {
                    if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadFile)) {
                        // delete the file
                        @unlink($uploadFile);
                        return $uploadFile;
                    }
                } else {
                    if ($_FILES['Filedata']['error']) {
                        return $_FILES['Filedata']['error'];
                    }
                }
            }
        }
    }

    function myHtml($bodyHtml) {
        echo $bodyHtml;
    }

    function obsafe_print_r($var, $return = false, $html = false, $level = 0) {
        $spaces = "";
        $space = $html ? "&nbsp;" : " ";
        $newline = $html ? "<br />" : "\n";
        for ($i = 1; $i <= 6; $i++) {
            $spaces .= $space;
        }
        $tabs = $spaces;
        for ($i = 1; $i <= $level; $i++) {
            $tabs .= $spaces;
        }
        if (is_array($var)) {
            $title = "Array";
        } elseif (is_object($var)) {
            $title = get_class($var) . " Object";
        }
        $output = $title . $newline . $newline;
        foreach ($var as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $level++;
                $value = obsafe_print_r($value, true, $html, $level);
                $level--;
            }
            $output .= $tabs . "[" . $key . "] => " . $value . $newline;
        }
        if ($return)
            return $output;
        else
            echo $output;
    }

}

?>
