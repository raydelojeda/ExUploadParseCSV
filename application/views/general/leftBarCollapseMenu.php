<?php $this->load->view('dashboard/scripts/AnalysisDetailScript');?>
<?php $this->load->view('dashboard/scripts/rebuildPath');?>

<script type="text/javascript">

    $(document).ready(function()
    {
        //--Handling left bar collapsible list --------------------

        let clientsList = $("#clientsList");

        if(clientsList.attr('aria-expanded')==='false')
            clientsList.attr('aria-expanded',true);

        clientsList.toggleClass('in');

        let analysisClient = $('.show_analysis_client');

        if(analysisClient.attr('aria-expanded')==='true')
            analysisClient.attr('aria-expanded',false);

        let filterBy =  $("#filterBy");

        filterBy.attr('aria-expanded',true);

        filterBy.off('click').on('click',function (e)
        {
            $("#clientsListFilter").toggleClass('active');

            (filterBy.attr('aria-expanded')==='false') ?
                filterBy.attr('aria-expanded',true) : filterBy.attr('aria-expanded',false);

            (clientsList.attr('aria-expanded')==='false') ?
                clientsList.attr('aria-expanded',true) : clientsList.attr('aria-expanded',false);

            (!clientsList.hasClass('in')) ?
                clientsList.addClass('in') : clientsList.removeClass('in');
        });

        analysisClient.off('click').on('click', function (e)
        {
            let idClient=jQuery(this).attr('id');

            collapseUnselectedClient(idClient);

            let projectsList = $("#projectsList"+idClient);

            if(!projectsList.hasClass('in'))
                projectsList.addClass('in');
            else
                projectsList.removeClass('in');

            (projectsList.attr('aria-expanded')==='false') ?
                projectsList.attr('aria-expanded',true) : projectsList.attr('aria-expanded',false);

            $("#clientLi"+idClient).toggleClass('active');

            let aClient = $("#anchorClient"+idClient);

            (aClient.attr('aria-expanded')==='false') ?
                aClient.attr('aria-expanded',true) : aClient.attr('aria-expanded',false);

            GetAnalysisCardView(idClient);

            $('.text-themecolor').html('List Analysis');
        });

        $('.show_analysis_project').off('click').on('click', function (e)
        {
            let id_project=jQuery(this).attr('id');
            GetAnalysisCardView(null, id_project);
        });

        function collapseUnselectedClient(idClient)
        {
            $('.clientItem').not("#clientLi"+idClient).removeClass('active');
            $('.projectItem').not("#projectsList"+idClient).attr('aria-expanded',false).removeClass('in');
        }
    });
</script>