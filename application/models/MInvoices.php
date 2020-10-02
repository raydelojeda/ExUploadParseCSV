<?php
Class MInvoices extends CI_Model
{
    function  __construct()
    {
        parent::__construct();
    }

    function result($error_code=0, $error_msg=0, $result = array())
    {
        $return['error_code']=$error_code;
        $return['error_msg']=$error_msg;
        $return['data']=$result;

        return $return;
    }

    function getAllInvoices()
    {
        $this -> db -> select('id,inv_date,inv_number,inv_po_number,inv_shipping_address,inv_billing_address,inv_shipping_cost,inv_sales_tax,inv_discount,inv_comments');
        $this -> db -> from('invoices');
        //$sql=$this->db->get_compiled_select();echo $sql;die();
        $query = $this -> db -> get();//var_dump($query->result());die();

        if($query -> num_rows() >= 1)
            $return=$this->result(0, 0, $query->result());
        else
            $return=$this->result(1, 'NO_DATA');

        return $return;
    }

    function getProducstByInvoice($invId)
    {
        $this -> db -> select('*');
        $this -> db -> from('products');
        $this -> db -> where('product_invoice_id = ' . "'" . $invId . "'");

        $query = $this -> db -> get();//var_dump($query->result());die();

        if($query -> num_rows() >= 1)
            $return=$this->result(0, 0, $query->result());
        else
            $return=$this->result(1, 'NO_DATA');

        return $return;
    }

    function execute($type='', $fields='', $datas='', $table='', $field_id='')
    {
        $return = array();
        $err = array();

        if($type=='INSERT')
        {
            foreach ($fields as $field)
            {
                if($field!='id'){
                    $insert[$field] = $datas[$field];
                    //print $field.' = '.$record[$field].'   ';
                }
            }
            $sql = $this->db->set($insert)->get_compiled_insert($table);
            //echo $sql.'<br>';

            $this->db->insert($table, $insert);
            $insert_id['last_id'] = $this->db->insert_id();
            $return=$this->result(0, 0, $insert_id);
        }

        if($type=='UPDATE')
        {

            foreach ($fields as $field)
            {
                if($field!='id'){
                    $this->db->set($field, $datas[$field]);
                }
            }

            $this->db->where($field_id, $datas['id']);

            if($this->db->update($table))
                $return=$this->result(0, 0,array());
            else
                $err = $this->db->error();

            if (!empty($err))
                $return=$this->result($err['code'], $err['message'],array());

            return $return;
        }

        if($type=='DELETE')
        {
            $id_eliminated='';
            $var = explode("-",$datas['id']);

            try
            {
                if(sizeof($var) != 0)
                {
                    for ($i = 0; $i < sizeof($var); next($var), $i++)
                    {
                        $id = current($var);//print $id.' - ';
                        $delete=array($field_id => $id);

                        //$this->db->trans_start(FALSE);
                        $this->db->delete($table, $delete);
                        //$this->db->trans_complete();

                        $db_error = $this->db->error();
                        if (!empty($db_error) && $db_error['code'] !== 0)
                        {
                            throw new Exception($db_error['message'], $db_error['code']);
                        }
                        else
                        {
                            if($id_eliminated=='')
                                $id_eliminated=$id;
                            else
                                $id_eliminated.='-'.$id;
                        }
                    }
                }

            }
            catch (Exception $e)
            {
                $return=$this->result($e->getCode(), $e->getMessage(), $id_eliminated);
            }

            if(empty($return))
                $return=$this->result(0, 0, $id_eliminated);
        }

        return $return;
    }

}
?>


