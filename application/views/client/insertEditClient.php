
<form class='floating-labels needValidationModal' role='form' name='frm' id='frm' action="">

	<div class="form-group mb-5 mt-3">
		<input type="text" name="client_name" id="client_name" class="form-control" required onkeyup="this.setAttribute('value', this.value);" value="<?php if(!empty($data['client']['data'][0]->client_name)) print $data['client']['data'][0]->client_name;?>" />
		<span class="bar"></span>
		<div class="invalid-feedback">
			The field is required.
		</div>
		<label for="client_name" style="width: 100px;">Client</label>
	</div>

	<div class="col-sm-12" id="footerClient">
        <div class="form-group pull-right">
            <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light" data-dismiss="modal">Cancel</button>
            <button type="button" id="btnSaveClient" class="btn btn-sm btn-info waves-effect waves-light">Save</button>
            <input type="hidden" name="id_client" id="id_client" value="<?php if(isset($data['client']['data'][0]->id_client)) print $data['client']['data'][0]->id_client;?>">
            <input type="hidden" name="accountID" id="accountID" value="<?php if(!empty($data['accountID']))echo $data['accountID'];?>">
        </div>
    </div>
</form>

