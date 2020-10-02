<div class="modal-body">
   <div class="page-titles mt-2" id="invTable">
		<div class="row">
			<div class="col-md-12">

				<div class="card-body printableArea">
					<div class="text-right mb-2">
						<button id="print" class="btn btn-sm btn-primary" type="button"> <i class="fa fa-print"></i> Print </button>
					</div>

					<h3><b>INVOICE</b> <span class="float-right" class="doHide" id="invDetailNumber"><?php echo $invoice[0]->inv_number ?></span></h3>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="float-left">
								<address>
									<h3> &nbsp;<b class="text-muted">PO Number:&nbsp;<span class="doHide" id="invDetailPONumber"><?php echo $invoice[0]->inv_po_number ?></span></b></h3>
									<h4 class="ml-1">Billing Address</h4>
									<p class="text-muted ml-1" class="doHide" id="invDetailBillingAddress"><?php echo $invoice[0]->inv_billing_address ?></p>
								</address>
							</div>
							<div class="float-right text-right">
								<address>
									<h3>Shipping Address</h3>
									<p class="text-muted ml-4" class="doHide" id="invDetailsShippingAddress"><?php echo $invoice[0]->inv_shipping_address ?></p>
									<p class="mt-4"><b>Invoice Date :</b> <i class="fa fa-calendar"></i>
										<span class="doHide" id="invDetailDate"><?php echo $invoice[0]->inv_date ?></span></p>
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
									<?php
									$rebatibleAmount = 0;
									if(isset($products))
									{

										$i = 0;
										foreach ($products as $row)
										{?>

											<tr>
												<td><?php print $i+1;?></td>
												<td><?php print $row->product_name;?></td>
												<td><?php print $row->product_description?></td>
												<td><?php print $row->product_sku_number?></td>
												<td><?php print $row->product_quantity?></td>
												<td><?php print $row->product_price?></td>
												<td><?php if($row->product_rebate_elegible == true)
										{echo "Yes"; $rebatibleAmount += $row->product_price;} else echo "No"; ?></td>
											</tr>

								   <?php $i++;}
									}?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-12">
							<div class="float-left">
								<address>
									<h4 class="ml-1">Comments</h4>
									<p class="text-muted ml-1" class="doHide" id="invDetailComments">
										<?php echo $invoice[0]->inv_comments ?>
									</p>
								</address>
							</div>
							<div class="float-right mt-4 text-right">
								<p>Shipping Cost: <span class="doHide" id="invDetailShippingCost">
										<?php echo $invoice[0]->inv_shipping_cost ?>
								</span></p>
								<p>Sales Tax: <span class="doHide" id="invDetailSalesTax">
										<?php echo $invoice[0]->inv_sales_tax ?>
								</span></p>
								<p>Discount: <span class="doHide" id="invDetailDiscount">
										<?php echo $invoice[0]->inv_discount ?>
								</span></p>
								<hr>
								<h3><b>Rebatible Amount :</b> <span class="doHide" id="rebatibleAmountDetail"><?php echo "$".$rebatibleAmount ?></span></h3>
							</div>
							<div class="clearfix"></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

