<script type="text/javascript">

    $(document).ready(function()
    {
        $('input').keypress(function (e) {
            if (e.which === 13) {
                $('#btnLogin').trigger('click');
                return false;
            }
        });

        $('#btnLogin').on('click', function(e)
        {
            if(isValid())
            {
                let target = document.getElementById('mainContent');
                let spinner = new Spinner(opts).spin(target);

                let data = new FormData(document.getElementById('frm'));

                //data.append('email', $('#txtEmail').val());

                let init = {
                    method: 'POST',
                    body: data
                };

                fetch('<?php echo base_url("Auth/verify")?>', init)
                    .then(function (res)
                    {
                        if(res.ok)
                            return res.text();
                        else
                            throw 'Error with the server.';
                    })
                    .then(function (text)
                    {
                        text = String(text);

                        if(text === 'WRONG') {
                            toastr.error( 'Your email or password is wrong.');//console.log(text);
                        }
                        else if(text === 'UNVERIFIED') {
                            toastr.warning('In order to receive notifiactions you need to verify your Email.');
                        }
                        else if(text === 'EMPTY') {
                            toastr.error('The field email is required.');
                        }
                        else{
                            $('#mainContent').html(text);
                        }
                        spinner.stop();
                    })
                    .catch(function (error) {
                        toastr.error(error);
                        spinner.stop();
                    });
            }
        });
    });

</script>