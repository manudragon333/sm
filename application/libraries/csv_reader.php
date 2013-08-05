<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * CSVReader Class
 *
 * $Id: csvreader.php 147 2007-07-09 23:12:45Z Pierre-Jean $
 *
 * Allows to retrieve a CSV file content as a two dimensional array.
 * The first text line shall contains the column names.
 *
 * @author        Pierre-Jean Turpeau
 * @link        http://www.codeigniter.com/wiki/CSVReader
 */
//     function index()
//    {
//             $this->load->library('csvreader');
//
//             $filePath = './csv/products.csv';
//
//             $data['csvData'] = $this->csvreader->parse_file($filePath);
//
//             $this->load->view('csv_view', $data);
//    }


/* <table cellpadding="0" cellspacing="0">
  <thead>
  <th>
  <td>PRODUCT ID</td>
  <td>PRODUCT NAME</td>
  <td>CATEGORY</td>
  <td>PRICE</td>
  </th>
  </thead>

  <tbody>
  <?php foreach($csvData as $field){?>
  <tr>
  <td><?=$field['id']?></td>
  <td><?=$field['name']?></td>
  <td><?=$field['category']?></td>
  <td><?=$field['price']?></td>
  </tr>
  <?php }?>
  </tbody>

  </table>
 */






class Csv_reader {

    var $fields;/** columns names retrieved after parsing */
    var $separator = ',';/** separator used to explode each line */

    /**
     * Parse a text containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @return    array
     */
    function parse_text($p_Text) {
        $lines = explode("\n", $p_Text);
        return $this->parse_lines($lines);
    }

    /**
     * Parse a file containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @return    array
     */
    function parse_file($p_Filepath) {
        $lines = file($p_Filepath);
        return $this->parse_lines($lines);
    }

    /*
      added by augustin magdici
      for cvs's with quotes >> field1, "field2, with quote", field3, "field, with, quotes,", field 5
      (excel standard save in this format)
     */

    function strc($string, $start, $end) {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function likee($needle, $haystack) {
        $pos = stripos($haystack, $needle);
        if ($pos === false) {
            return false;
        } else {
            return true;
        }
    }

    function str_replace_once($needle, $replace, $haystack) {
        $pos = strpos($haystack, $needle);
        if ($pos === false) {
            return $haystack;
        }
        return substr_replace($haystack, $replace, $pos, strlen($needle));
    }

    //end quote added by augustin magdici

    /**
     * Parse an array of text lines containing CSV formatted data.
     *
     * @access    public
     * @param    array
     * @return    array
     */
    function parse_lines($p_CSVLines) {
        $content = FALSE;
        foreach ($p_CSVLines as $line_num => $line) {
            if ($line != '') {

                //added by augustin magdici (quote)

                while ($this->likee('"', $line)) {
                    $line = $this->str_replace_once('"', "[aaxaa]", $line);
                    $line = $this->str_replace_once('"', "[bbxaa]", $line);
                }

                while ($this->likee('[aaxaa]', $line)) {
                    $x1 = $this->strc($line, "[aaxaa]", "[bbxbb]");
                    $x2 = str_replace(",", "[acomax]", $x1);
                    $line = str_replace($x1, $x2, $line);
                    $line = $this->str_replace_once('[aaxaa]', '', $line);
                    $line = $this->str_replace_once('[bbxbb]', '', $line);
                }
                // end added by augustin magdici (quote)

                $elements = explode($this->separator, trim($line));


                if (!is_array($content)) { // the first line contains fields names
                    $this->fields = $elements;
                    $content = array();
                } else {
                    $item = array();
                    foreach ($this->fields as $id => $field) {
                        if (isset($elements[$id])) {
                            $item[$field] = str_replace("[acomax]", ",", $elements[$id]); //some quote change
                        }
                    }
                    $content[] = $item;
                }
            }
        }
        return $content;
    }

}

?>