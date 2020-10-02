<thead>
<tr>
    <th style="width: 1%" class="text-center"></th>
    <th style="" class="text-center">Date</th>
    <th style="" class="text-center">Number</th>
    <th style="" class="text-center">PO Number</th>
    <th style="" class="text-center">Shipping Address</th>
    <th style="" class="text-center">Billing Address</th>
    <th style="" class="text-center">Shipping Cost</th>
    <th style="" class="text-center">Sales Tax</th>
    <th style="" class="text-center">Discounts</th>
    <th style="" class="text-center">Comments</th>
    <th style="width: 5%">Line Items</th>
</tr>
</thead>

<tbody>

<?php

json_encode($data);

if(isset($data))
{
    $i=0;

    foreach ($data as $row)
    {?>

        <tr id="<?php print "tr" . $i;?>">
            <td style="width: 1%"><?php print $i+1;?></td>
            <td style="" class="text-center"><?php print date_format(date_create($row->inv_date),"m/d/Y");?></td>
            <td style="" class="text-center"><?php print $row->inv_number;?></td>
            <td style="" class="text-center" ><?php print $row->inv_po_number;?></td>
            <td style="" class="text-center" ><?php print $row->inv_shipping_address;?></td>
            <td style="" class="text-center" ><?php print $row->inv_billing_address;?></td>
            <td style="" class="text-center"><?php print $row->inv_shipping_cost;?></td>
            <td style="" class="text-center" ><?php print $row->inv_sales_tax;?></td>
            <td style="" class="text-center" ><?php print $row->inv_discount;?></td>
            <td style="" class="text-center" ><?php print $row->inv_comments;?></td>
            <td class="row_update_project text-center"
                id="<?php print $row->id;?>" data-toggle="modal" data-target="#upd_project_modal">
                <span class="fas fa-clipboard-list"></span>
            </td>
        </tr>

        <?php

        $i++;
    }
}
?>
</tbody>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('.row_update_project').off('click').on('click', function (e) {
            let invId = $(this).attr('id');
            getProducts(invId);
        });
    });

    function getProducts(invId) {

        let target = document.getElementById('divContent');
        let spinner = new Spinner(opts).spin(target);

        $.ajax({
            url: '<?php echo base_url("Invoices/getInvoiceProducts");?>',
            type: 'POST',
            data: {invId: invId}
        }).done(function (response, textStatus, jqXHR) {
            if (response !== 'NO_LOGGED') {
                $('#inv_products').html(response);
                spinner.stop();
            }
            else if (response === 'NO_LOGGED') {
                spinner.stop();
                toastr.error("You don\'t have access.");
                window.location.replace('<?php echo base_url()?>');
            }
        });
    }
</script>
