<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <div class="brand-logo">
        <a href="#">
            <!-- <b class="logo-abbr"><img src="<?php echo asset('public/assets/images/logo.png'); ?>" alt=""> </b>
            <span class="logo-compact"><img src="<?php echo asset('public/assets/images/logo-compact.png'); ?>" alt=""></span> -->
            <span class="brand-title" style="color: #5D9E02;">
                Healthy and Yummy
                 <!-- <img src="<?php echo asset('public/front/images/logo.jpg'); ?>" width="190px;">-->
            </span>
        </a>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content clearfix">

        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="badge badge-pill gradient-2 badge-primary" id="notificationcount" onclick="clearnoti();">0</span>
                    </a>
                </li>
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="<?php echo asset('public/assets/images/logo.png'); ?>" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#ChangePasswordModal"><i class="icon-key"></i> <span>Change Password</span></a></li>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#Selltings"><i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span></a></li>
                                <li><a href="<?php echo e(URL::to('/admin/logout')); ?>"><i class="icon-logout"></i> <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************--><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/header.blade.php ENDPATH**/ ?>