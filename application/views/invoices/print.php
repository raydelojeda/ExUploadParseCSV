<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$position='left';
ini_set('memory_limit', '2048M');


?>
<!DOCTYPE html>
<head>
    <title>Print Invoice</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<style src="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>"></style>
	<style src="<?php echo base_url('assets/css/style.css')?>"></style>
	<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
</head>
<body>

    <div class="wrapper">
        <div id="main-view" class="col-md-12 text-left"></div>
    <div>
</body>
</html>

<script type="text/javascript">

    function printInv(dataFromParent)
    {
        $('#main-view').html(dataFromParent);
        $('.fa-print').hide();
        $('.btn').hide();
        $('.selection').hide();
        $('input').attr('readonly', 'readonly');

        window.print();
    }
</script>
