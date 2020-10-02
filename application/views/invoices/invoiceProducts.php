<div class="row">
    <?php
    if(isset($data) && count($data)>0)
    {
        $i=0;

        foreach ($data as $row)
        {

            //if($i % 3==0)
            //echo '<div class="row">';
            ?>

            <div class="col-6" style="padding: 0px 5px">
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <h4 class="card-title">
                            <b>Name:</b>&nbsp;<?php print $row->product_name;?>
                        </h4>

                        <p class="card-text">
                            <b><i>Description:</i></b>&nbsp;<?php echo $row->product_description;?>
                        </p>
                        <p class="card-text">
                            <b><i>SKU Nbr:</i></b>&nbsp;<?php echo $row->product_sku_number;?>
                        </p>
                        <p class="card-text">
                            <b><i>Quantity:</i></b>&nbsp;<?php echo $row->product_quantity;?>
                        </p>
                        <p class="card-text">
                            <b><i>Price:</i></b>&nbsp;$<?php echo $row->product_price;?>
                        </p>
                        <p class="card-text">
                            <b><i>Rebate Elegible:</i></b>&nbsp;<?php if($row->product_rebate_elegible) echo "Yes"; else echo "No";?>
                        </p>
                    </div>
                </div>
            </div>

            <?php
            //if($i % 3==2)
            //echo '</div>';
            $i++;
        }
    }
    else {
    ?>
        <div class="row">
            <h3 class="ml-4"><i>No products available for the selected invoice</i></h3>
        </div>
    <?php } ;?>
</div>


