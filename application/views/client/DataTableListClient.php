<thead>
<tr>
    <th style="width: 1%" class="text-center"></th>
    <th style="">Client</th>
    <th style="width: 5%" class="text-center">Status</th>
    <th style="width: 5%"></th>
    <th style="width: 5%"></th>
</tr>
</thead>

<tbody>

<?php
if(isset($data['client']['data']))
{
    $i=0;

    foreach ($data['client']['data'] as $row)
    {

        if($row->client_status=='1')$status='<span class="fa fa-check"></span>';else $status='<span class="fa fa-ban"></span>';
        ?>

        <tr id="<?php print "tr" . $i;?>">
            <td style="width: 1%"class="text-center" ><?php print $i+1;?></td>
            <td style="" class="" ><?php print $row->client_name;//echo json_encode($row);?></td>
            <td style="width: 5%" class="text-center">
                <div class="checkbox checkbox-inverse">
                    <input class="act_deact_status_client" <?php if($row->client_status=='1')echo 'checked';?>
                           id="status_<?php if(isset($row->id_client))print $row->id_client;?>" type="checkbox">
                    <label for="status_<?php if(isset($row->id_client))print $row->id_client;?>">&nbsp;</label>
                </div>
            </td>
            <td style="width: 5%" class="text-center">
                <span clientID="<?php print $row->id_client;?>" class="fa fa-edit pointer m-1 editClient <?php if (!empty($row->id_project))echo 'd-none';?>"></span>
            </td>
            <td style="width: 5%" class="text-center">
                <span clientID="<?php print $row->id_client;?>" class="fa fa-trash pointer m-1 deleteClient <?php if (!empty($row->id_project))echo 'd-none';?>"></span>
            </td>
        </tr>

        <?php

        $i++;
    }
}
?>
</tbody>
<script type="text/javascript">

	$('.act_deact_status_client').off('click').on('click', function ()
	{
		let client_status;
		let id = $(this).attr('id').substring(7);

		if($(this).prop('checked'))
			client_status = 1;
		else
			client_status = 0;

		activateInactivateClient(id, client_status);
	});

    function activateInactivateClient(id, status)
    {
        if(id !== '')
        {
            let data =
            {
                table:'client',
                type:'UPDATE',
                client_status:status,
                field_id:'id_client',
                id:id
            };

            let target = document.getElementById('divContent');
            let spinner = new Spinner(opts).spin(target);

            $.ajax({
                type: "POST",
                dataType: "html",
                url: '<?php echo base_url("Main/ActivateInactivate")?>',
                data:data
            }).done(function(response, textStatus, jqXHR)
            {
                if(response !== 'NO_LOGGED')
                {
                    if($.isNumeric(response) && response>0)
                        toastr.success('Data saved.');
                }
                else if(response === 'NO_LOGGED')
                {
                    toastr.error("You don\'t have access.");
                    window.location.replace('<?php echo base_url()?>');
                }
            }).fail(function(jqHTR, textStatus, thrown)
            {
                toastr.error('Something is wrong with AJAX:' + textStatus);
            });

            spinner.stop();
        }
        else
            toastr.error('You have to select a row.');
    }

	$('.editClient').off('click').on('click', function ()
	{
		let clientID = $(this).attr('clientID');
		insertEditClient(clientID);
	});

	$('#btnAddClient').off('click').on('click', function ()
	{
		insertEditClient();
	});

	function insertEditClient(clientID = '')
	{
		let target = document.getElementById('divContent');
		let spinner = new Spinner(opts).spin(target);

		let data = {clientID:clientID};

		$.ajax({
			url: '<?php echo base_url("Main/getData");?>',
			type: 'POST',
			data: {data_type:'insertEditClient',view_url:'client/insertEditClient', data:data}
		}).done(function(response)
		{
			if(response !== 'NO_LOGGED')
			{
				modalUpdateClient(response);
				spinner.stop();
			}
			else if(response === 'NO_LOGGED')
			{
				spinner.stop();
				toastr.error("You don\'t have access.");
				window.location.replace('<?php echo base_url()?>');
			}
		});
	}

	function modalUpdateClient(res)
	{
		let type;
		let modal = $('#modal_div');
		modal.find('.modal-title').html('Insert Client');
		modal.find('#modal_body').html(res);
		modal.find('#modal_footer').html(modal.find('#footerClient').html());
		modal.find('#footerClient').remove();
		modal.modal('show');

        let originalClientName =  modal.find('#client_name').val();

		modal.find('#btnSaveClient').on('click', function ()
		{
			let table='client';
			let fieldID='id_client';
			let url = '<?php echo base_url("Main/saveObject");?>';

			if (isValidModal(modal))
			{
				let accountID = modal.find('#accountID').val();
				let clientID = modal.find('#id_client').val();
				let clientName = modal.find('#client_name').val();

				if (clientID !== '')
					type = 'UPDATE';
				else
					type = 'INSERT';

				let data =
				{
					table:table,
					type:type,
					client_name:clientName,
					id_account:accountID,
					field_id:fieldID,
					id:clientID
				};

				$.ajax({
					type: "POST",
					dataType: "html",
					url: url,
					data:data
				}).done(function(response, textStatus, jqXHR)
				{
					let uploadViewSelectedClient = $('#divClient .tt-input').val();
                    if(type==='UPDATE' && originalClientName === uploadViewSelectedClient)
                        $('#divClient .tt-input').val(clientName);

                    modal.modal('hide');
					$('.text-themecolor').html('List Client');loadContent('Main/goPage/client', 'cardViewDashboad');
				}).fail(function(jqHTR, textStatus, thrown)
				{
					toastr.error('Something is wrong with AJAX:' + textStatus);
				});
			}
		});
	}

	$('.deleteClient').off('click').on('click', function ()
	{
		let clientID = $(this).attr('clientID');
		let title = 'Are you sure you want to delete it?'
		toastr.info('<div class="text-center p-5"><button type="button" id="btnToastConfirm" class="btn btn-secondary m-3">Yes</button><button type="button" id="btnToastClear" class="btn btn-secondary m-3">No</button></div>', title,
				{
					timeOut: 50000,
					tapToDismiss: false,
					extendedTimeOut: 100000,
					positionClass: "toast-top-full-width",
					onShown: function (toast)
					{
						$("#btnToastClear").click(function(){
							toastr.remove();
						});

						$("#btnToastConfirm").click(function(){
							toastr.remove();
							deleteClient(clientID);
						});
					}
				});
	});

	function deleteClient(clientID)
	{
		if (clientID !== '')
		{
			let data =
					{
						table:'client',
						type:'DELETE',
						field_id:'id_client',
						id:clientID
					};

			$.ajax({
				type: "POST",
				dataType: "html",
				url: '<?php echo base_url("Main/saveObject");?>',
				data:data
			}).done(function(response)
			{
				if(Number(response))
				{
					toastr.success('Client deleted.');
                    $('#divClient .typeahead').val('');
					loadContent('Main/goPage/client', 'cardViewDashboad');
				}
			}).fail(function(jqHTR, textStatus, thrown)
			{
				toastr.error('Something is wrong with AJAX:' + textStatus);
			});
		}
		else
		{
			toastr.error('You have to select a client.');
		}
	}

</script>
