<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" alt="" height="80">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(url('/')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" alt="" height="80">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(url('/')); ?>"  >
                        <i class="ri-dashboard-2-line" ></i> <span>Dashboard</span>
                    </a>
                </li> 
               <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link"><?php echo app('translator')->get('translation.analytics'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link"><?php echo app('translator')->get('translation.crm'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link"><?php echo app('translator')->get('translation.ecommerce'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link"><?php echo app('translator')->get('translation.crypto'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link"><?php echo app('translator')->get('translation.projects'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft" class="nav-link"> <?php echo app('translator')->get('translation.nft'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-job" class="nav-link"><span><?php echo app('translator')->get('translation.job'); ?></span> <span class="badge badge-pill bg-success"><?php echo app('translator')->get('translation.new'); ?></span></a>
                            </li>
                        </ul>
                    </div>
                </li> end Dashboard Menu  -->
              <?php if(Auth::user()->role==1): ?>
              

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(url('/restaurants')); ?>"  >
                        <i class="ri-account-circle-line" ></i> <span>Restaurants</span>
                    </a>
                </li> 
             <?php endif; ?>
             <?php
                 if(Auth::user()->role==999)
                 {
                    $approve=\App\Models\Seller::where(['id' => Auth::user()->seller_id])->where(['profile_status' => 0])->get();
                    $final=count($approve)>0 ? 1:0;
                 }
                 else{
                    $final=1;
                 }
             ?>
              
             <?php if($final==1): ?>
             <li class="nav-item">
                <a class="nav-link menu-link" href="<?php echo e(url('/users')); ?>"  >
                    <i class="ri-account-circle-line" ></i> <span>Users</span>
                </a>
            </li>
            
             <li class="nav-item">
                <a class="nav-link menu-link" href="<?php echo e(url('/section')); ?>"  >
                    <i class="ri-dashboard-2-line" ></i> <span>Sections</span>
                </a>
            </li> 

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(url('/tables')); ?>"  >
                        <i class="ri-dashboard-2-line" ></i> <span>Tables</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(url('/category')); ?>"  >
                        <i class="ri-dashboard-2-line" ></i> <span>Category</span>
                    </a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(url('/product')); ?>"  >
                        <i class="ri-dashboard-2-line" ></i> <span>Menu</span>
                    </a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(url('/customers')); ?>"  >
                        <i class="ri-dashboard-2-line" ></i> <span>Customers</span>
                    </a>
                </li> 

                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#orders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="orders">
                        <i class="ri-dashboard-2-line"></i> <span> Orders</span>
                    </a>
                    <div class="collapse menu-dropdown" id="orders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(url('/currentorders')); ?>" class="nav-link">Current Orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/orders_billed')); ?>" class="nav-link">Billed</a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH D:\xampp\htdocs\RMS\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>