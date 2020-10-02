<?php
if (!empty($session['photoFileName']))
    $src = base_url('/assets/upload/person_photo/' . $session['photoFileName'] . '?d=' . date('H:m:s'));
else
    $src = base_url('/assets/images/male.png');
?>


<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- User profile -->
    <div class="user-profile">
        <!-- User profile image -->
        <div class="profile-img"> <img class="profilePhoto" src="<?php print $src;?>" alt="user" /> </div>
        <!-- User profile text-->
        <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $session['firstName'] . ' ' . $session['lastName']?><span class="caret"></span></a>
            <div class="dropdown-menu animated flipInY">
                <!--<a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>-->


                <a class="dropdown-item" onclick="$('.text-themecolor').html('Users');loadContent('Main/goPage/user', 'cardViewDashboad');"><i class="ti-user"></i> Users</a>
                <a class="dropdown-item" onclick="$('.text-themecolor').html('Payment Methods');loadContent('Main/goPage/paymentMethods', 'cardViewDashboad');"><i class="ti-wallet"></i> Payment Methods</a>
                <a class="dropdown-item" onclick="$('.text-themecolor').html('Subscriptions');loadContent('Main/goPage/plan', 'cardViewDashboad');"><i class="ti-money"></i> Subscriptions</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="$('.text-themecolor').html('Account Settings');loadContent('Main/goPage/account', 'cardViewDashboad');"><i class="ti-settings"></i> Account Setting</a>
                <div class="dropdown-divider"></div>
                <a onclick="logout('Authentication/logout');" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>

            </div>
        </div>
    </div>
    <!-- End User profile text-->
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li>
                <a onclick="$('.text-themecolor').html('All Analysis');loadContent('Dashboard/goDashboard', 'cardViewDashboad');" aria-expanded="false">
                    <i class="mdi mdi-gauge"></i>
                    <span class="hide-menu">All Analysis</span>
                    <span class="hide-menu label label-rounded label-inverse" style="min-width: 18px;" id="qtyAnalysis"><?php if(isset($qty_analysis))echo $qty_analysis;else echo $data['qty_analysis']?></span>
                </a>
            </li>

            <li class="active" id="clientsListFilter">
                <a href="javascript:void(0)" class="has-arrow" aria-expanded="false" id="filterBy">
                    <i class="fa fa-filter" style="font-size: 16px;"></i>
                        <span class="hide-menu">
                            Filtered By
                        </span>
                </a>
                <ul aria-expanded="false" class="collapse" id="clientsList">
                    <?php
                    $id_client = '';
                    $close = 0;
                    $arrLength = 0;

                    if(isset($clients_projects['data']) && $clients_projects['error_code']=='0')
                        $clientList = $clients_projects['data'];
                    elseif
                    (isset($data['clients_projects']['data']) && $data['clients_projects']['error_code']=='0')
                        $clientList = $data['clients_projects']['data'];

                    if(isset($clientList))
                        $arrLength = count($clientList);

                    if($arrLength > 0):
                    {

                        for($x = 0; $x < $arrLength; $x++)
                        {
                            $row=$clientList[$x];

                            if($id_client!=$row->id_c)
                            {
                                ?>
                                <li class="ml-2 clientItem" id="clientLi<?php echo $row->id_c;?>">
                                <a class="show_analysis_client has-arrow" aria-expanded="false" id="<?php echo $row->id_c;?>" data-text="<?php print $row->client_name;?>"
                                   >
                                    <?php echo $row->client_name; ?>
                                </a>
                                <ul aria-expanded="false" class="collapse projectsList<?php echo $row->id_c;?> projectItem" style="" id="projectsList<?php echo $row->id_c;?>">
                            <?php
                            }
                            ?>
                            <li>
                                <a class="show_analysis_project" id="<?php print $row->id_p;?>" data-text="<?php print $row->client_name.'|||'.$row->project_name;?>">
                                    <span class="hide-menu1 font-weight-bolder" style="font-size: 17px;"><em><?php echo $row->project_name;?></em></span>
                                    <!--<span class="hide-menu label label-rounded label-inverse" style="min-width: 18px;"><?php /*echo $row->qty_analysis;*/?></span>-->
                                </a>
                            </li>

                            <?php

                            $id_client = $row->id_c;

                            if(array_key_exists($x+1, $clientList))
                                $row_next=$clientList[$x+1];
                            else
                                $close=1;

                            if($close==1 || $id_client!=$row_next->id_c)
                            {?>
                                </ul>
                                </li>
                            <?php
                            }
                        }
                    } else: ?>
                    <li class="ml-2 mt-2" id="noClientsMsg">
                        <h6 class="text-muted"><i>No Clients available</i></h6>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- End Sidebar navigation -->
</div>

<!-- End Sidebar scroll-->
<!-- Bottom points-->
<div class="sidebar-footer text-center">

    <!--<a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>

    <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>-->

    <a style="width: 100%" onclick="logout('Authentication/logout');" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
</div>
<!-- End Bottom points-->

<?php $this->load->view('general/leftBarCollapseMenu');?>



