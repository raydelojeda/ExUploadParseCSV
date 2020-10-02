<tr id="<?php print "tr" . $i;?>">
    <td><?php print $i+1;?></td>

    <?php

    foreach (get_object_vars($value) as $key => $val)
    {
        $two_letters=(int) substr($key, 0, 2);//echo substr($key, 0, 2).' - '.$two_letters.'<br>';

        if(is_int($two_letters) && $two_letters!=0)
        {
            ?>

                <td>
                    <?php
                    //echo $val;

                        //if(strpos($val, 'OPEN_MODEL') >== 0)
                            $val = str_replace('MODAL-I', '<a class="show_modal"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><div class="hide" data-title=', $val);
                            $val = str_replace('MODAL', '<a class="show_modal"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="hide" data-title=', $val);

                        echo $val;
                    ?>
                </td>

            <?php
        }
        elseif (substr($key, 0, 2)==='DT')
        {
            ?>
            <td><a class="show_modal"><i class="fa fa-info-circle"></i><div class="hide" data-title="Details" style="display: none;"><?php echo $val;?></div></a></td>
            <?php
        }
    }
    ?>

</tr>


<script type="text/javascript">

    jQuery(document).ready(function()
    {
//        $('.show_modal').on('click', function ()
//        {
//            var detail=jQuery(this).children('.hide').html();//alert(detail);
//            var title=jQuery(this).children('.hide').attr('data-title');//alert(title);
//            var modal = $('#modal_div');
//            modal.find('.modal-title').html(title);
//            modal.find('#modal_body').html(detail);
//            modal.appendTo("body").modal('show');
//        });
    });

</script>