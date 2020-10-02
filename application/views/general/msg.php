<?php
if(!empty($setting['generalMsg']))$generalMsg = $setting['generalMsg'];
if(!empty($setting['successMsg']))$successMsg = $setting['successMsg'];
if(!empty($setting['warningMsg']))$warningMsg = $setting['warningMsg'];
if(!empty($setting['errorMsg']))$errorMsg = $setting['errorMsg'];
?>

<script type="text/javascript">

    $(document).ready(function()
    {
        let generalMsg = '<?php if(!empty($generalMsg))echo $generalMsg;?>';
        let errorMsg = '<?php if(!empty($errorMsg))echo $errorMsg;?>';
        let successMsg = '<?php if(!empty($successMsg))echo $successMsg;?>';
        let warningMsg = '<?php if(!empty($warningMsg))echo $warningMsg;?>';
        //console.log(generalMsg);
        if(generalMsg !== '')toastr.info(generalMsg);
        if(errorMsg !== '')toastr.error(errorMsg);
        if(successMsg !== '')toastr.success(successMsg);
        if(warningMsg !== '')toastr.warning(warningMsg);
    });

</script>