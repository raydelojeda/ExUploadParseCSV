<style>
    @media screen and (min-width: 676px) {
        .modal-dialog {
            max-width: 1280px; /* New width for default modal */
        }
    }
</style>
<div class="fix-header fix-sidebar card-no-border1">
    <div id="main-wrapper">
        <?php $this->load->view('general/topBar');?>
        <div class="" style="background-color: #f2f7f8;">
            <div class="container-fluid" id="divContent" style="padding: 5px 30px 30px 30px;">

                <div class="col-12 mt-3 p-2" style="background-color: #fff;">
                    <div class="row mb-3" style="padding: 0px;">
                        <div class="col col-6 pull-left" id=""></div>
                        <div class="col col-6 pull-right">
                            <div style="display: inline-block;width: 100%;text-align: right; margin-rigth:25px">
                                <button type="button"
                                        id="btnUploadInv"
                                        class="btn btn-sm btn-info waves-effect waves-light"
                                        data-toggle="modal" data-target="#exampleModal">Upload invoice</button>
                            </div>
                        </div>
                        <?php $this->load->view('invoices/uploadInvoice');?>
                    </div>
                    <div class="row" style="padding: 0px;">
                        <div class="col col-12">
                            <table id="tblInvoices"
                                   class="table table-hover table-responsive"
                                   style="margin-left: auto;margin-right: auto;" width="100%">
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade bd-example-modal-lg" id="upd_project_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Invoice Products</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class='fill-up validatable sky-form' role='form' name='frm_modal1' id='frm_modal1' action="">
                                            <div class="col-md-12" id="inv_products"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer class="footer">
            © <?php echo date('Y');?> Pivot Inc.
        </footer>
    </div>
</div>

<?php $this->load->view('general/includeCSS', $includeCSS);?>
<?php $this->load->view('general/includeJS', $includeJS);?>
<?php $this->load->view('general/modal');?>
<?php $this->load->view('general/support');?>

<script>
    $(document).ready(function()
    {
        loadDataTableInvoices();

        $("#btnUploadInv").off('click').on('click', function(){

            $("#invTableHeaders").empty();
            $("#invTable").hide();
        });

    });

    function loadDataTableInvoices(isRefresh = false)
    {
        let spinner = '';
        if(!isRefresh)
        {
            let target = document.getElementById('divContent');
            spinner = new Spinner(opts).spin(target);
        }

        $.ajax({
            url: '<?php echo base_url("Invoices/getInvoices");?>',
            type: 'POST',
            data:{}
        }).done(function(response, textStatus, jqXHR)
        {
            if(response !== 'NO_LOGGED')
            {
                $('#tblInvoices').html(response);
                if(!isRefresh)
                    dtInvoices();
            }
            else if(response === 'NO_LOGGED')
            {
                toastr.error("You don\'t have access.");
                window.location.replace('<?php echo base_url()?>');
            }
            if(!isRefresh)
                spinner.stop();
        });
    }

    function dtInvoices()
    {
        return $('#tblInvoices').DataTable(
            {
                dom:
                    "<'row'<'col-sm-3 col-md-3 col-lg-3'l>" +
                        "<'col-sm-3 col-md-3 col-lg-3'>" +
                        "<'col-sm-6 col-md-6 col-lg-6'f>>'tip'",
                "scrollX": true,
                language: { search: "",sLengthMenu: "_MENU_"}
            });
    }

</script>






