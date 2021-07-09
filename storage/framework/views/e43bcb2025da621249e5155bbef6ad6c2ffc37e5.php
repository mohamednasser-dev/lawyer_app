<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
           Lawyer<span> App</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <?php
            $user_type = auth()->user()->type;
            if($user_type != 'manager'){
            ?>
            <li class="nav-item">
                <a href="<?php echo e(route('home')); ?>" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_home')); ?></span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="<?php echo e(url('/users')); ?>">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_users')); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(url('/clients')); ?>" class="nav-link">
                    <i class="link-icon" data-feather="globe"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_clients')); ?></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_cases')); ?></span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?php echo e(url('/addCase')); ?>" class="nav-link"><?php echo e(trans('site_lang.side_add_case')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('/caseDetails')); ?>" class="nav-link"><?php echo e(trans('site_lang.side_search_case')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/mohdareen')); ?>">
                    <i class="link-icon" data-feather="check-square"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_mohdar')); ?></span>
                </a>
            </li>
            <?php
            $user_type = auth()->user()->type;
            if($user_type == 'admin'){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/categories')); ?>">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_categories')); ?></span>
                </a>

            </li>
            <?php
            }
            ?>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="charts">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_reports')); ?></span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?php echo e(url('/dailyReport')); ?>" class="nav-link"><?php echo e(trans('site_lang.side_reports_daily')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('/MonthlyReport')); ?>" class="nav-link"><?php echo e(trans('site_lang.side_reports_monthly')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php
            }
            ?>
            <?php
            $user_type = auth()->user()->type;
            if($user_type == 'manager'){
            ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title"><?php echo e(trans('site_lang.side_ControlPanel')); ?></span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?php echo e(url('/packages')); ?>" class="nav-link"><?php echo e(trans('site_lang.side_Packages')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">theme</h6>
        <div class="row">
            <div class="form-check form-check-inline">
                <a class="btn btn-success" href="<?php echo e(url('theme/light')); ?>" id="theme" role="button" data-toggle="" aria-haspopup="true" aria-expanded="false">
                    <i class="" title="light" id="light"></i>
                    <span class="font-weight-medium ml-1 mr-1">light</span>
                </a>
            </div>
            <div class="form-check form-check-inline">
                <a class="btn btn-dark" href="<?php echo e(url('theme/dark')); ?>" id="theme" role="button" data-toggle="" aria-haspopup="true" aria-expanded="false">
                    <i class="" title="dark" id="dark"></i>
                    <span class="font-weight-medium ml-1 mr-1">dark</span>
                </a>
            </div>
        </div>

    </div>
</nav>
<?php /**PATH D:\projects\lawyer_app\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>