<div id="divAuth">
    <div id="wrapper">
        <div class="login-register" style="background-image:url(<?php echo base_url($bgImage);?>);">
            <div class="centeredBox">
                <div class="login-box card">
                    <div class="card-body">
                        <div>
                            <h3 class="text-center mt-2">Pivot Inc.</h3>
                        </div>
                        <div>
                            <h4 class="text-center mt-2"><i>Invoices manager</i></h4>
                        </div>
                        <form class="form-horizontal form-material needValidation" name="frm" id="frm">
                            <input type="hidden" name="<?php echo $setting['csrf']['name'];?>" value="<?php echo $setting['csrf']['hash'];?>" />
                            <h3 class="box-title mb-3">Sign In</h3>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Username" name="txtEmail" id="txtEmail">
                                    <div class="invalid-feedback">
                                        The field is required.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" required="" placeholder="Password" name="txtPassword" id="txtPassword">
                                    <div class="invalid-feedback">
                                        The field is required.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button" id="btnLogin">Log In</button>
                                </div>
                            </div>

                            <div class="form-group" hidden="">
                                <div class="col-md-12">
                                    <a href="javascript:void(0)" onclick="loadContent('Authentication/goForgotPassword', 'divAuth')" class="text-dark float-right"><i class="fa fa-lock mr-1"></i> Forgot password?</a>
                                </div>
                            </div>

                            <div class="form-group mb-0" hidden="">
                                <div class="col-sm-12 text-center">
                                    <p>Don't have an account? <a href="javascript:void(0)" onclick="loadContent('Authentication/goCreateAccount', 'divAuth')" class="text-info ml-1"><b>Sign Up</b></a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('auth/authScripts');?>
