<script>
    function getDetailView(id, name, type, view, extraData)
    {
        $('.text-themecolor').html();
        $('#cardViewDashboad').empty();

        let target = document.getElementById('divContent');
        let spinner = new Spinner(opts).spin(target);

        $.ajax({
            url: "<?php echo base_url('Main/getData')?>",
            type: 'POST',
            data: {data_type:type,view_url:view, id:id, name:name, extraData:extraData}
        }).done(function(response, textStatus, jqXHR)
        {
            if(response !== 'NO_LOGGED')
            {
                $('#cardViewDashboad').html(response);
                $('.text-themecolor').html($('.mylegend').html());
                $('.mylegend').html('');
                spinner.stop();
            }
            else if(response === 'NO_LOGGED')
            {
                spinner.stop();
                toastr.error("You don\'t have access.");
                window.location.replace('<?php echo base_url()?>');
            }
            rebuildPath();
        });
    }
</script>