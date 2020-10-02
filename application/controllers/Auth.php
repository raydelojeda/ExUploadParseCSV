<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MAuth');
    }

    function __destruct()
    {
        $this->db->close();
    }

    public function index($type = '', $token = '')
    {
        $data['session'] = getSessionVars();
        $data['setting'] = getSetting();
        $data['logged'] = 'NO';

        $d = array();
        $d['includeCSS'][] = 'assets/plugins/bootstrap/css/bootstrap.min.css';
        $d['includeCSS'][] = 'assets/plugins/toast-master/css/jquery.toast.css';
        $d['includeCSS'][] = 'assets/css/style.css';
        $d['includeCSS'][] = 'assets/css/support.css';
        $d['includeCSS'][] = 'assets/css/colors/light.css';
        $d['includeCSS'][] = 'assets/plugins/select2/select2.min.css';
        $d['includeJS'][] = 'assets/plugins/jquery/jquery.min.js';
        $d['includeJS'][] = 'assets/plugins/toastr/toastr.js';
        $d['includeCSS'][] = 'assets/plugins/toastr/toastr.css';
        $d['includeCSS'][] = 'assets/plugins/dropify/dist/css/dropify.min.css';
        $d['includeJS'][] = 'assets/plugins/dropify/dist/js/dropify.js';
        $d['includeJS'][] = 'assets/plugins/bootstrap/js/popper.min.js';
        $d['includeJS'][] = 'assets/plugins/bootstrap/js/bootstrap.min.js';

        $this->load->view('general/header', $d);
        $this->load->view('general/support');

        $data['bgImage'] = 'assets/images/background/iStock-482675251.jpg';

        if($this->session->userdata('loggedUser' . PROJECT))
        {
            $data['logged'] = 'YES';
            $this->goMain();
        }
        else
        {
            if(!empty($token))
            {
                $result = $this->MAuthentication->validaToken($token);//var_dump($result);

                if ($result['errorCode'] === 0)
                {
                    if($type === 'resetPass')
                    {
                        $data['id'] = $result['data']->id_user;
                        $data['token'] = $token;
                        $this->load->view('authentication/1/restorePass', $data);
                    }
                    elseif($type === 'activateAccount')
                    {
                        $result=$this->MAuthentication->activateAccount($token);

                        if ($result['errorCode'] === 0)
                        {
                            $this->session->set_flashdata('successMsg', 'Thank you for activating your account.');
                            redirect(base_url(),'refresh');
                        }
                    }
                }
                else
                {
                    $this->session->set_flashdata('warningMsg', 'Sorry, the token is expired.');
                    redirect(base_url(),'refresh');
                }
            }
            else
                $this->goLogin($data);
        }

        $d = array();

        $d['includeJS'][] = 'assets/js/waves.js';
        $d['includeJS'][] = 'assets/plugins/toast-master/js/jquery.toast.js';
        $d['includeJS'][] = 'assets/js/validation.js';
        $d['includeJS'][] = 'assets/plugins/spin/spin.min.js';
        $d['includeJS'][] = 'assets/plugins/select2/select2.min.js';
        $d['includeJS'][] = 'assets/plugins/mask/jquery.maskedinput.min.js';
        $d['includeJS'][] = 'assets/js/jasny-bootstrap.js';

        //$this->load->view('general/msg', $data);
        $this->load->view('general/footer', $d);
    }

    function goMain()
    {
        $data['session']=getSessionVars();
        $data['setting']=getSetting();
        $data['logged'] = 'NO';

        if($this->session->userdata('loggedUser' . PROJECT))
        {
            $data['logged'] = 'YES';

            $data['includeCSS'][] = 'assets/plugins/datatables/datatables.css';
            $data['includeCSS'][] = 'assets/css/scrollbars_hv.css';
            //$data['includeCSS'][] = 'assets/plugins/jQuery-File-Upload-9.22.0/css/jquery.fileupload.css';
            $data['includeJS'][] = 'assets/plugins/Chart.js-master/chart.js';
            $data['includeJS'][] = 'assets/plugins/Chart.js-master/utils.js';
            $data['includeJS'][] = 'assets/plugins/datatables/datatables.js';
            $data['includeJS'][] = 'assets/plugins/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js';
            $data['includeJS'][] = 'assets/plugins/jQuery-File-Upload-master/js/jquery.iframe-transport.js';
            $data['includeJS'][] = 'assets/plugins/jQuery-File-Upload-master/js/jquery.fileupload.js';
//            $data['includeJS'][] = 'assets/plugins/jQuery-File-Upload-9.22.0/js/vendor/jquery.ui.widget.js';
//            $data['includeJS'][] = 'assets/plugins/jQuery-File-Upload-9.22.0/js/jquery.iframe-transport.js';
//            $data['includeJS'][] = 'assets/plugins/jQuery-File-Upload-9.22.0/js/jquery.fileupload.js';
            $data['includeJS'][] = 'assets/js/jquery.slimscroll.js';
            //  $data['includeJS'][] = 'assets/js/sidebarmenu.js';
            $data['includeJS'][] = 'assets/plugins/dw_scroll_c.js';
            $data['includeJS'][] = 'assets/js/custom.js';
            $data['includeJS'][] = 'assets/plugins/typeahead.js-master/dist/typeahead.bundle.min.js';
            $data['includeJS'][] = 'assets/js/socket.io.js';
            // $data['includeCSS'][] = 'assets/plugins/footable/css/footable.bootstrap.min.css';
            // $data['includeJS'][] = 'assets/plugins/footable/js/footable.min.js';
            $this->load->view('invoices/listInvoices', $data);
        }
        else
            echo 'NO_LOGGED';
    }

    function goLogin($data = array())
    {
        $data['setting'] = getSetting();
        $data['bgImage'] = 'assets/images/background/iStock-482675251.jpg';
        $this->load->view('auth/login', $data);
        $this->load->view('general/msg', $data);
    }

    function verify()
    {
        $dataPost = $this->input->post();//var_dump($dataPost);
        //var_dump($_POST);

        $result = $this->checkDatabase($dataPost);//var_dump($result);

        if ($result['errorCode'] === 0)
            $this->goMain();
        elseif($result['errorMsg'] === 'UNVERIFIED')
            echo 'UNVERIFIED';
        else
            echo 'WRONG';
    }

    function checkDatabase($dataPost)
    {
        $result = $this->MAuth->login($dataPost);//echo $result['data']->email;
        //var_dump($result);

        if ($result['errorCode'] === 0)
        {
            $sess_array = array(
                'sessionID' => uniqid(),
                'ipAddress' => $this->input->ip_address(),
                'accessDateTime' => date("Y-m-d H:i:s"),
                'id_user' => $result['data']->id,
               /* 'id_person' => $result['data']->id_person,
                'photoFileName' => $result['data']->photoFileName,
                'gatewayCustomerID' => $result['data']->gatewayCustomerID,
                'firstName' => $result['data']->first_name,
                'lastName' => $result['data']->last_name,
                'email' => $result['data']->email,
                'rol' => $result['data']->rol,
                'account' => $result['data']->account,
                'id_account' => $result['data']->id_account,
                'logo' => $result['data']->logo,
                'default_view' => $result['data']->default_view*/
            );

            $this->session->set_userdata('loggedUser' . PROJECT, $sess_array);
        }

        return $result;
    }



    function generateTempToken($userID)
    {
        $cadena = rand(1,999999999999).date('Y-m-d');
        $token = md5(md5(md5($cadena)));

        $result = $this->MAuthentication->saveToken($userID, $token);
        $result['token']=$token;

        return $result;
    }

    function logout()
    {
        if($this->session->userdata('loggedUser' . PROJECT))
        {
            $this->session->unset_userdata('loggedUser' . PROJECT);
        }
        $this->MAuthentication->logout();
        redirect(base_url());
    }
}
