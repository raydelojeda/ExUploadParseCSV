<div class="modal fade  bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Upload invoice</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

				<div class="row mt-2" style="">
					<div class="col-12">
						<div class="card-body">
							<h4 class="card-title">File Upload</h4>
							<form enctype="multipart/form-data">
								<input type="file" id="filename" name="filename" class="dropify"  data-height="200"/>
							</form>
						</div>
					</div>
				</div>

               <div class="row">
                    <h4 class="ml-3"><i id="uploadError"></i></h4>
               </div>
                <div class="page-titles mt-2" id="invTable">
                   <div class="row">
                        <div class="col-md-12">
                            <div class="card-body printableArea">
                                <h3><b>INVOICE</b> <span class="float-right" class="doHide" id="invNumber"></span></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <address>
                                                <h3> &nbsp;<b class="text-muted">PO Number:&nbsp;<span class="doHide" id="invPONumber"></span></b></h3>
                                                <h4 class="ml-1">Billing Address</h4>
                                                <p class="text-muted ml-1" class="doHide" id="invBillingAddress"></p>
                                            </address>
                                        </div>
                                        <div class="float-right text-right">
                                            <address>
                                                <h3>Shipping Address</h3>
                                                <p class="text-muted ml-4" class="doHide" id="invShippingAddress"></p>
                                                <p class="mt-4"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> <span class="doHide" id="invDate"></span></p>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive mt-5" style="clear: both;">
                                            <table class="table table-hover lineItemsTable" id="lineItemsTable">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Product Name</th>
                                                    <th>Product Description</th>
                                                    <th>Product SKU Number</th>
                                                    <th>Product Quantity</th>
                                                    <th>Product Price</th>
                                                    <th>Rebate Elegible</th>
                                                </tr>
                                                </thead>
                                                <tbody class="doHide" id="invLineItems">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <address>
                                                <h4 class="ml-1">Comments</h4>
                                                <p class="text-muted ml-1" class="doHide" id="invComments"></p>
                                            </address>
                                        </div>
                                        <div class="float-right mt-4 text-right">
                                            <p>Shipping Cost: <span class="doHide" id="invShippingCost"></span></p>
                                            <p>Sales Tax: <span class="doHide" id="invSalesTax"></span></p>
                                            <p>Discount: <span class="doHide" id="invDiscount"></span></p>
                                            <hr>
                                            <h3><b>Rebatible Amount :</b> <span class="doHide" id="rebatibleAmount"></span></h3>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="text-right">
                                            <button class="btn btn-success" type="submit" id="btnSaveInv">Save Invoice</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary m-3" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
		$('#filename').dropify().on('change', function(e) {
			var ext = $("input#filename").val().split(".").pop().toLowerCase();
			if($.inArray(ext, ["csv"]) == -1) {
				$("#uploadError").html('Please upload a csv file');
				return false;
			}
			if (e.target.files != undefined) {

				$("#invTable").show();
				$("#uploadError").hide();
				$("#invLineItems").empty();

				var reader = new FileReader();
				let countProduct = 0;
				reader.onload = function(e) {
					let lines = e.target.result.split('\r\n');
					let i;

					var columnsCount = lines.length;
					//Setting invoice values
					for (i=0;i < columnsCount;i)
					{
						let columnName = $.trim(lines[i].toLowerCase()).replace(/\s+/g, '');

						if(columnName.indexOf("name") >= 0)
							columnName = "name";

						//console.log(columnName);
						//console.log(lines[i+1]);
						switch(columnName) {
							case "date":
								if(isValidDate(lines[i+1])){
									$("#invDate").html(lines[i+1]);
									$('#btnSaveInv').show();
								} else
								{
									$("#invDate").html("<i class='text-danger'>The date format must be: mm/dd/yyyy</i>");
									$('#btnSaveInv').hide();
								}
								break;
							case "number":
								$("#invNumber").html("#"+lines[i+1]);
								break;
							case "ponumber":
								$("#invPONumber").html("#"+lines[i+1]);
								break;
							case "shippingaddress":
								$("#invShippingAddress").html(lines[i+1]);
								break;
							case "billingaddress":
								$("#invBillingAddress").html(lines[i+1]);
								break;
							case "shippingcost":
								$("#invShippingCost").html("$"+lines[i+1]);
								break;
							case "salestax":
								$("#invSalesTax").html("$"+lines[i+1]);
								break;
							case "discount":
								$("#invDiscount").html("$"+lines[i+1]);
								break;
							case "comments":
								$("#invComments").html(lines[i+1]);
								break;
							case "name":
								countProduct++;
								break;

							default:
								break;
						}
						i++;
					}

					if(countProduct>0)
					{
						let newProductRow = '';

						for (i=1;i <= countProduct;i)
						{
							newProductRow = '<tr id="rowProduct'+i+'"><td>'+i+'</td><td class="pName" id="rowProductName'+i+'"></td><td class="pDesc" id="rowProductDesc'+i+'"></td><td class="pSku" id="rowProductSku'+i+'"></td><td class="pQuantity" id="rowProductQuantity'+i+'"></td><td class="pPrice" id="rowProductPrice'+i+'"></td><td class="pRebate" id="rowProductRebate'+i+'"></td></tr>';
							$("#invLineItems").append(newProductRow);
							i++;
						}

						let currentNameIndex = 1;
						let currentDescIndex = 1;
						let currentSkuIndex = 1;
						let currentQuantityIndex = 1;
						let currentPriceIndex = 1;
						let currentRebateIndex = 1;
						let rebatibleAmount = 0;

						for (i=0;i < columnsCount;i)
						{
							let columnName = $.trim(lines[i].toLowerCase()).replace(/\s+/g, '');

							if(columnName.indexOf("name") >= 0)
								columnName = "name";

							if(columnName.indexOf("description") >= 0)
								columnName = "description";

							if(columnName.indexOf("sku") >= 0)
								columnName = "sku";

							if(columnName.indexOf("quantity") >= 0)
								columnName = "quantity";

							if(columnName.indexOf("price") >= 0)
								columnName = "price";

							if(columnName.indexOf("rebate") >= 0)
								columnName = "rebate";

							switch(columnName) {

								case "name":
									$("#rowProductName"+currentNameIndex).html(lines[i+1]);
									currentNameIndex++;
									break;
								case "description":
									$("#rowProductDesc"+currentDescIndex).html(lines[i+1]);
									currentDescIndex++;
									break;
								case "sku":
									$("#rowProductSku"+currentSkuIndex).html(lines[i+1]);
									currentSkuIndex++;
									break;
								case "quantity":
									$("#rowProductQuantity"+currentQuantityIndex).html(lines[i+1]);
									currentQuantityIndex++;
									break;
								case "price":
									$("#rowProductPrice"+currentPriceIndex).html(lines[i+1]);
									currentPriceIndex++;
									break;
								case "rebate":
									let rebateValue = 'Not Available';
									((lines[i+1].toLowerCase() === 'yes')||(lines[i+1]==='1')) ? rebateValue = 'Yes' : rebateValue = "No";
									$("#rowProductRebate"+currentRebateIndex).html(rebateValue);
									if(rebateValue==='Yes')
									{
										rebatibleAmount+= parseInt($("#rowProductPrice"+currentRebateIndex).text());
									}
									currentRebateIndex++;
									break;
								default:
									break;
							}
							i++;
						}

						$("#rebatibleAmount").html("$"+rebatibleAmount);
					}
					else
					{
						$("#invLineItems").append('<tr><td colspan="7" class="text-center"><i>There are not line items available</i></td></tr>');
					}
				};
				reader.readAsText(e.target.files.item(0));
				$("#btnSaveInv").removeClass('disabled').prop('disabled', false);
				/*($("#validInv").val() !== 'Invalid') ? $("#btnSaveInv").removeClass('disabled').prop('disabled', false) :
				 $("#btnSaveInv").addClass('disabled').prop('disabled', true);*/
			}
			return false;
		}).on('dropify.afterClear', function(event, element) {
			toastr.success('File deleted');
			$('.doHide').html('');
			$('#invTable').hide();
		});


        $("#btnSaveInv").addClass('disabled').prop('disabled', true);


        $("#btnSaveInv").off('click').on('click',function(){
            let invNumber = $("#invNumber").text().replace('#','');
            let invDate = $("#invDate").text();
            let invPONumber = $("#invPONumber").text().replace('#','');
            let invShippingAddress = $("#invShippingAddress").text();
            let invBillingAddress = $("#invBillingAddress").text();
            let invShippingCost = $("#invShippingCost").text().replace('$','');
            let invSalesTax = $("#invSalesTax").text().replace('$','');
            let invDiscount = $("#invDiscount").text().replace('$','');
            let invComments = $("#invComments").text();

            let table='invoices';
            let fieldID='id';
            let url = '<?php echo base_url("Invoices/saveInvoice");?>';
            let type = 'INSERT';

            let data =
            {
                table:table,
                type:type,
                field_id:fieldID,
                inv_date:invDate,
                inv_number:invNumber,
                inv_po_number: invPONumber,
                inv_shipping_address: invShippingAddress,
                inv_billing_address: invBillingAddress,
                inv_shipping_cost: invShippingCost,
                inv_sales_tax: invSalesTax,
                inv_discount: invDiscount,
                inv_comments: invComments
            };

			$.ajax({
				type: "POST",
				dataType: "html",
				url: url,
				data:data
			}).done(function(response, textStatus, jqXHR)
			{
				saveLineItems(response);
			}).fail(function(jqHTR, textStatus, thrown)
			{
				toastr.error('Something is wrong with AJAX:' + textStatus);
			});
		});

		function saveLineItems(invoiceId)
		{
			let data = {},x = 0,url = '<?php echo base_url("Invoices/saveLineItems");?>';

			let table='products';
			let fieldID='id';
			let type = 'INSERT';

			$('.lineItemsTable tr').each(function (a, b)
			{
				if($('.pName', b).text()!=='')
				{
					let productName = $('.pName', b).text();
					let productDescription = $('.pDesc', b).text();
					let productSkuNumber = $('.pSku', b).text();
					let productQuantity = $('.pQuantity', b).text();
					let productPrice = $('.pPrice',b).text();
					let productRebatElegible = $('.pRebate',b).text();

					data[x]=
					{
						table:table,
						type:type,
						field_id:fieldID,
						product_name:productName,
						product_description:productDescription,
						product_sku_number: productSkuNumber,
						product_quantity: productQuantity,
						product_price: productPrice,
						product_rebate_elegible: productRebatElegible,
						product_invoice_id: $.trim(invoiceId)
					};
					x++;
					//console.log(x);
					//console.log(data);
				}
			});

			$.ajax({
				type: "POST",
				dataType: "html",
				url: url,
				data:data
			}).done(function(response, textStatus, jqXHR)
			{
				toastr.success('Invoice saved successfully.');

				setTimeout(function () {
					//location.reload();
				}, 1000)
			}).fail(function(jqHTR, textStatus, thrown)
			{
				toastr.error('Something is wrong with AJAX:' + textStatus);
			});
		}

		//Validation functions
		function isValidDate(s) {
			var bits = s.split('/');
			var d = new Date(bits[2] + '/' + bits[1] + '/' + bits[0]);
			let result = !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
			return result;
		}

    });
</script>
