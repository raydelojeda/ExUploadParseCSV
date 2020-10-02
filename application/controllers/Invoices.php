<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller
{
    // Columns names after parsing
    private $fields;
    // Separator used to explode each line
    private $separator = ';';
    // Enclosure used to decorate each field
    private $enclosure = '"';
    // Maximum row size to be used for decoding
    private $max_row_size = 4096;

    function __construct()
    {
        parent::__construct();
        $this->load->model('MInvoices');
    }

    function __destruct()
    {
        $this->db->close();
    }

    function index()
    {

    }

    function getInvoices()
    {
        $invoices=$this->MInvoices->getAllInvoices();
        $data['data']=$invoices['data'];
        $this->load->view('invoices/dataTableListInvoice',$data);
    }

    function getInvoiceProducts()
    {
        $invId=$this->input->post('invId');
        $invoice = $this->MInvoices->getInvoiceById($invId);
        $products=$this->MInvoices->getProducstByInvoice($invId);
        $data['invoice'] = $invoice['data'];
        $data['products'] = $products['data'];
        $this->load->view('invoices/invoiceProducts',$data);
    }

    function saveInvoice()
    {
        $field_id='';

        if($this->session->userdata('loggedUser' . PROJECT))
        {
            $i=0;
            foreach($_POST as $field_name => $value)
            {
                if($field_name!='table' && $field_name!='type' && $field_name!='field_id')
                {
                    if ($field_name == 'inv_date')
											$value = date("Y-m-d", strtotime($value));

                		$fields[$i] = $field_name;
                    $value = $this->security->xss_clean($value);
                    $value = html_escape($value);
                    $datas[$field_name] = $value;

                    $i++;
                }
                elseif($field_name=='table')
                    $table=$value;
                elseif($field_name=='type')
                    $type=$value;
                elseif($field_name=='field_id')
                    $field_id=$value;
            }
            //print $table;die()

            $result=$this->MInvoices->execute($type, $fields, $datas, $table, $field_id);

            if($result['error_msg']=='0' && $type=='INSERT')
                print $result['data']['last_id'];
            elseif($result['error_msg']=='0' && ($type=='UPDATE' || $type=='DELETE'))
                print $datas['id'];
            else
                print $result['error_msg'];
        }
        else
        {
            print 'NO_LOGGED';
        }
    }

    function saveLineItems()
    {
        $field_id='';

        if($this->session->userdata('loggedUserDDR'))
        {
            $i=0;

            foreach($_POST as $k => $v)
						{
							foreach($v as $field_name => $value)
							{
								if($field_name!='table' && $field_name!='type' && $field_name!='field_id') {
									$fields[$i] = $field_name;
									$value = $this->security->xss_clean($value);
									$value = html_escape($value);
									$datas[$field_name] = $value;

									$i++;
									//$asignacion = "\$" . $field_name . "='" . $value . "';";
									//eval($asignacion);
								}
								elseif($field_name=='table')
									$table=$value;
								elseif($field_name=='type')
									$type=$value;
								elseif($field_name=='field_id')
									$field_id=$value;
							}
							$this->MInvoices->execute($type, $fields, $datas, $table, $field_id);
						}
        }
        else
        {
            print 'NO_LOGGED';
        }
    }

    function uploadFile()
    {
        $msg = "";
        $status = 'ERROR';
        $arr = array();
        date_default_timezone_set('America/New_York');

        $this->load->helper('General_Helper');

        $inp_name = 'uplXMLFile';//var_dump($_FILES);
        $fileName = $_FILES[$inp_name]['name'];//echo 'el nombre '.$fileName;

        $pos = strrpos($fileName, ".");
        $name = substr($fileName, 0, $pos);
        $ext = substr($fileName, $pos + 1);

        if ($ext === "csv")
        {
            $pathFolder = 'assets/upload/temp/' . $name;
            $relativePathFolder='./' . $pathFolder ;
            $this->createRealPathFolder($relativePathFolder);
            $realPathFolder = realpath($relativePathFolder);
            $realPathFileName=$realPathFolder . '/' . $fileName;


            $config['upload_path'] = $relativePathFolder;
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 1024 * 9999999999999;
            $config['encrypt_name'] = false;
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = FALSE;
            $config['file_name'] = $name;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($inp_name))
                $msg = $this->upload->display_errors('', '');
            else
            {
                $msg = "File uploaded.";

                $data['name'] = $name;
                $data['fileName'] = $fileName;
                $data['fileSize'] = $this->FileSizeConvert(filesize($realPathFileName));
                $data['relativePathFolder'] = $relativePathFolder;
                $data['realPathFileName'] = $realPathFileName;
                $data['msg'] = $msg;
                //Start parsing here

                $parsedInvoice = $this->parseInvoice($realPathFileName);

                echo json_encode($parsedInvoice);

                echo json_encode($data);
                exit();
            }
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function createRealPathFolder($realPathFolder)
    {
        if (!file_exists($realPathFolder))
        {
            if (!mkdir($realPathFolder, 0777, true))
            {
                die('Failed to create folders...');
            }
        }
    }

    function FileSizeConvert($bytes)
    {
        $bytes = floatval($bytes);//echo $bytes.'<br>';
        $arBytes = array(
            0 => array(
                "UNIT" => "Tb",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "Gb",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "Mb",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "Kb",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "Bytes",
                "VALUE" => 1
            ),
        );

        foreach($arBytes as $arItem)
        {
            if($bytes >= $arItem["VALUE"])
            {
                $result = $bytes / $arItem["VALUE"];
                $result = round($result, 2)." ".$arItem["UNIT"];
                //$result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
                break;
            }
        }//echo $result.'<br>';
        return $result;
    }

    function parseinvoice($filePath)
    {
        // If file doesn't exist, return false
        if(!file_exists($filePath)){
            return FALSE;
        }

        $csvFile = fopen($filePath, 'r');

        // Get Fields and values
        $this->fields = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure);
        $keys_values = explode(',', $this->fields[0]);
        $keys = $this->escapeString($keys_values);

        $csvData = array();
        $i = 0;
        while(($row = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure)) !== FALSE){
            // Skip empty lines
            if($row != NULL){
                $values = explode(',', $row[0]);
                if(count($keys) == count($values)){
                    $arr        = array();
                    $new_values = array();
                    $new_values = $this->escapeString($values);
                    for($j = 0; $j < count($keys); $j++){
                        if($keys[$j] != ""){
                            $arr[$keys[$j]] = $new_values[$j];
                        }
                    }
                    $csvData[$i] = $arr;
                    $i++;
                }
            }
        }
        // Close opened CSV file
        fclose($csvFile);

        return $csvData;


    }

    function escapeString($data){
        $result = array();
        foreach($data as $row){
            $result[] = str_replace('"', '', $row);
        }
        return $result;
    }

    function printInvoice()
		{
			$this->load->view('invoices/print');
		}
}
