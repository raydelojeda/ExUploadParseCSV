<thead>
<tr>
    <th style="width: 1%"></th>

    <?php

    $total_with=0;

    foreach (get_object_vars($value) as $key => $val)
    {
        //echo $key;
        $two_letters=substr($key, 0, 2);
        $with=(int) $two_letters;
        $total_with=$total_with+$with;
    }
    //echo $total_with;
    foreach (get_object_vars($value) as $key => $val)
    {
        $two_letters=(int) substr($key, 0, 2);

        if(is_int($two_letters) && $two_letters!=0)
        {
            $column_text = substr($key, 3);
            ?>

                <th style="width: <?php if($total_with>0)echo $two_letters/$total_with*100;?>%"><?php echo $column_text;?></th>

            <?php
        }
        elseif (substr($key, 0, 2)==='DT')
        {
            ?>
                <th style="width: 1%">&nbsp;</th>
            <?php
        }
    }
    ?>

</tr>
</thead>
<tbody>