<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon.png')?>">
    <title><?php echo APP_TITLE;?></title>
    <meta name="description" content="<?php echo APP_DESCRIPTION;?>">

    <?php $this->load->view('general/includeCSS', $includeCSS);?>
    <?php $this->load->view('general/includeJS', $includeJS);?>

</head>

<body>
<div id="mainContent">