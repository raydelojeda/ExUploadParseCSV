<div class="col-12 mt-3 p-2" style="background-color: #fff;">
    <div class="row mb-3" style="padding: 0px;">
        <div class="col col-6 pull-left" id=""></div>
        <div class="col col-6 pull-right">
            <div style="display: inline-block;width: 100%;text-align: right;">
                <button id="btnAddClient" class="btn btn-sm btn-info waves-effect waves-light">Add</button>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 0px;">
        <div class="col col-12">
            <table id="data_table_client" class="table table-hover table-responsive" style="margin-left: auto;margin-right: auto;" width="100%"></table>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function()
    {
        loadDataTableClient();
    });
    
</script>
