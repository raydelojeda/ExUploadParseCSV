<?php
//var_dump($notification);
if(!empty($notification['data']))
{
    $qtyNotification = sizeof($notification['data']);
    ?>
    <div id="notificationsList" class="message-center" qtyNotification="<?php echo $qtyNotification;?>">
        <?php
        //echo json_encode($setting);die();
        if (isset($notification['data']) && is_array($notification['data']) && $qtyNotification > 0)
        {?>
            <a>
                <h5 class="text-muted text-center"><?php echo $qtyNotification;?>&nbsp;unread</h5>
            </a>
            <?php foreach ($notification['data'] as $key => $val)
            {?>

                <a <?php if (isset($val->link)) echo 'href="' . $val->link . '"'; ?>
                    class="notifLink"
                    notificationID="<?php echo $val->id_notification; ?>"
                    style="color:<?php echo "#".$val->color; ?>;">

                    <i class="<?php echo $val->icon; ?>"></i>&nbsp;<?php echo $val->notification; ?>
                </a>
            <?php
            }
        }?>
    </div>
<?php
}
else
{    ?>
    <div class="p-3 text-center">
        <h6>You don't have any notifications</h6>
    </div>
<?php
}
?>
<script>
    $(document).ready(function()
    {
        let notif = '<?php if(!empty($notification['data']))echo 1;else echo 0;?>';
        let qtyNewNotifications = '<?php if(!empty($notification['data']))echo sizeof($notification['data']);else echo 0;?>';
        let qtyOldNotifications = '<?php if(!empty($notification['data']))echo $qtyOldNotifications;else echo 0;?>';

        if(Number(notif) === 1)
        {
            $('#notifHeartbit').show();
            $('#notifPoint').show();

            if(qtyNewNotifications !== qtyOldNotifications)
            {
              checkEmail();
            }
        }
        else
        {
            $('#notifHeartbit').hide();
            $('#notifPoint').hide();
        }

        $('.notifLink').on('click', function ()
        {
            let that = $(this);
            let notificationID = that.attr('notificationID');
            that.hide();

            let data = {};
            data['notificationID'] = notificationID;
            data['userID'] = '<?php echo $session['id_user']?>';
            data['qtyOldNotifications'] = qtyOldNotifications;

            doSomething('Notification/updateNotificationBy', data);

            checkNotification();
        });
    });

    $('#showNotifications').off('hidden.bs.dropdown').on('hidden.bs.dropdown', function () {
        let unreadNotifications = '<?php if(!empty($notification['data']))echo sizeof($notification['data']);else echo 0;?>';

        if(unreadNotifications !== '0')
        {
            $('#notifHeartbit').show();
            $('#notifPoint').show();
        }
    })
</script>