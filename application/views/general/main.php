<div class="fix-header fix-sidebar card-no-border1">
    <div id="main-wrapper">
        <?php $this->load->view('dashboard/scripts/AnalysisScript');?>
        <?php $this->load->view('general/topBar');?>
        <aside class="left-sidebar" style="box-shadow: 4px -4px 10px rgba(0, 0, 0, 0.05);" id="leftBarAnalysisContent">
        <?php $this->load->view('general/leftBar');?></aside>
         <div class="page-wrapper" style="background-color: #f2f7f8;">

            <div class="container-fluid" id="divContent" style="padding: 5px 30px 30px 30px;"></div>

            <footer class="footer">
                © <?php echo date('Y');?> MacTutor Inc.
            </footer>

        </div>
        
    </div>
</div>
<?php $this->load->view('general/includeCSS', $includeCSS);?>
<?php $this->load->view('general/includeJS', $includeJS);?>
<?php $this->load->view('general/modal');?>
<?php $this->load->view('general/support');?>

<script type="text/javascript">

    $(document).ready(function()
    {
        loadContent('Main/goPage/statisticsDashboard', 'divContent');
        //setInterval(checkNotification, 20000);
    });

</script>
