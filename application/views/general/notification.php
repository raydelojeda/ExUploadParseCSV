<?php $this->load->view('general/notificationAuxList') ;?>

<script>
    $(document).ready(function()
    {
        checkNotification();

        //Notifications listener

       /* var socket = io.connect('https://'+window.location.hostname+':3000');
        //var socket = io.connect('https://'+window.location.hostname+':3000');
        //Triggered after a new notification is added
        socket.on('notificationAdded', function(data) {
            checkNotification(); //Getting unread notifications
            beep();
            $('#notifHeartbit').show();
            $('#notifPoint').show();
        });*/
    });
</script>
