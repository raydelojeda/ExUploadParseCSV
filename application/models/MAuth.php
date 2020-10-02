<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MAuth extends CI_Model
{
    function  __construct()
    {
        parent::__construct();
    }

    function Result($error_code=0, $error_msg=0, $result = array())
    {
        $return['errorCode']=$error_code;
        $return['errorMsg']=$error_msg;
        $return['data']=$result;

        return $return;
    }

    function login($params)
    {
        $this -> db -> select('*');
        $this -> db -> from('users');
        //$this -> db -> join('account', 'account.id_account = user.id_account');
        //$this -> db -> join('person', 'person.id_user = user.id_user');
        $this -> db -> where('username = ' . "'" . $params['txtEmail'] . "'");
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        //$sql=$this->db->get_compiled_select();echo $sql;

        if($query -> num_rows() == 1)
        {
            if(password_verify($params['txtPassword'], $query->row()->password))
                $return=$this->Result(0, 0, $query->row());
            else
                $return=$this->Result(1, 'WRONG_PASS');
        }
        else
            $return=$this->Result(1, 'WRONG_ID');

        return $return;

        $query = $this -> db -> get();

        $sql=$this->db->get_compiled_select();echo $sql;

        if($query -> num_rows() == 1)
        {
            if($query->row()->activate_status==1)
            {
                if($query->row()->user_status==1)
                {
                    if(password_verify($params['txtPassword'], $query->row()->pass))
                        $return=$this->Result(0, 0, $query->row());
                    else
                        $return=$this->Result(1, 'WRONG_PASS');
                }
                else
                    $return=$this->Result(1, 'INACTIVE', $query->row());
            }
            else
                $return=$this->Result(1, 'UNVERIFIED', $query->row());
        }
        else
            $return=$this->Result(1, 'WRONG_ID');

        return $return;
    }


}