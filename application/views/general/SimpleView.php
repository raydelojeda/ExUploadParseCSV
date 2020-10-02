<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$position='left';
$this->load->view('includes/header');
?>

    <body style="min-height: 100%;height: 100%;">

<div class="wrapper vh-100">
<?php

$this->load->view('includes/hidden');
$this->load->view('includes/nav');

?>

    <div class="container content" style="padding-top:5px;z-index: 1" id="main-view">
        <form class="reg-page" id='frm_auth'>

            <div class="row">
                <div class="col-12 m-5 text-center">
                    <button class="btn btn-u" type="button" onclick="window.location.replace('<?php echo base_url();?>');">Go to Login</button>
                </div>
            </div>

        </form>
    </div>

<?php

$this->load->view('includes/footer_scripts');
$this->load->view('includes/footer');

?>
<script>
    alertify.alert("<?php echo $generalMsg;?>", function()
    {
        LoadContent('Authentication/GoLogin', 0, 'div_auth');
    });
</script>
