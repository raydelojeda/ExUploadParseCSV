<?php
if(!empty($includeCSS))
{
    foreach ($includeCSS as $k => $v)
    {
        ?>
        <link href="<?php echo base_url($v);?>" rel="stylesheet">
        <?php
    }
}
?>