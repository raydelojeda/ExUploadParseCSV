<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function getSessionVars()
{
    $data=array();
    $instance = & get_instance();
    
    if($instance->session->userdata('loggedUser' . PROJECT))
    {
        $sessionData = $instance->session->userdata('loggedUser' . PROJECT);

        if (!empty($sessionData))
        {
            foreach ($sessionData as $k =>$v)
            {
                $data[$k] = $v;
            }
        }
        else
        {
            $instance->session->unset_userdata('loggedUser' . PROJECT);
            $instance->load->model('MAuthentication');
            $instance->MAuthentication->logout();
        }
    }

    return $data;
}

function updateSessionVars($key, $value)
{
    $data=array();
    $instance = & get_instance();

    if($instance->session->userdata('loggedUser' . PROJECT))
    {
        $sessionData = $instance->session->userdata('loggedUser' . PROJECT);

        foreach ($sessionData as $k =>$v)
        {
            $data[$k] = $v;
        }

        if(!empty($key))
            $data[$key] = $value;

        $instance->session->set_userdata('loggedUser' . PROJECT, $data);//var_dump($data);
    }
}

function getSetting()
{
    $instance = & get_instance();
    
    $d = array();
    $d['csrf'] = array(
        'name' => $instance->security->get_csrf_token_name(),
        'hash' => $instance->security->get_csrf_hash()
    );
    $d['type'] = 1;

    $d['generalMsg'] = $instance->session->flashdata('generalMsg');
    $d['successMsg'] = $instance->session->flashdata('successMsg');
    $d['warningMsg'] = $instance->session->flashdata('warningMsg');
    $d['errorMsg'] = $instance->session->flashdata('errorMsg');

    return $d;
}




function l()
{
    $instance =& get_instance();
    
    if(!$instance->session->userdata('language'))
    {
        $session_lang = array('lang' => 'english');
        $instance->session->set_userdata('language', $session_lang);
    }

    $session_lang = $instance->session->userdata('language');
    $data['caption_language'] = $session_lang['lang'];
}

function LoadLanguage()
{
    $instance =& get_instance();

    if(!$instance->session->userdata('language'))
    {
        $session_lang = array('lang' => 'english');
        $instance->session->set_userdata('language', $session_lang);
    }

    $session_lang = $instance->session->userdata('language');
    $language = $session_lang['lang'];

    $instance->lang->load('form_label', $language);
    $data=$instance->lang->language;//var_dump($data);
    return $data;
}

function ProfileType($session)
{
    $data=array();
	$instance =& get_instance();
	/*$access_profile=$session['role'];//echo $session['role'];
	//$id_person=$session['id_person'];//echo $id_person;

    if($access_profile=='guest')
    {
        $data['profile_type']=$access_profile;
    }
    elseif($access_profile=='developer')
    {
        $data['profile_type']=$access_profile;
    }
    elseif($access_profile=='account_admin')
    {

        $data['profile_type']=$access_profile;
    }
    elseif($access_profile=='admin')
    {
        $data['available_jobs']=5;
        $data['profile_type']=$access_profile;
    }

    $instance->load->model('M_Notification');
    $data['notification'] = $instance->M_Notification->getUnreadNotificationBy($session['webAccountRecordID']);*/

    return $data;
}