<?php
if(!empty($includeJS))
{
    foreach ($includeJS as $k => $v)
    {
        ?>
        <script type="text/javascript" src="<?php echo base_url($v)?>"></script>
        <?php
    }
}
?>
