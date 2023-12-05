<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->

    <li class="nav-item">
        <a onclick="menu('dashboard.php','');" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                <span class="lang" key="dashboard">Dashboard</span>

            </p>
        </a>
    </li>
    <?php if ($_SESSION['role'] == 2) : ?>
        <li class="nav-item">
            <a onclick="menu('support.php','support_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    <span class="lang" key="plans">Support</span>
                </p>
            </a>
        </li>
    <?php endif; ?>
    <!--li class="nav-item">
            <a onclick="menu('payment.php','payment_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                    <span class="lang" key="users">Payment</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a onclick="menu('subscribers.php','subscribers_modal.php');" class="nav-link">
                <i class="nav-icon far fa-address-book"></i>
                <p>
                    <span class="lang" key="subscribers">Subscribers</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a onclick="menu('coupons.php','coupons_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>
                    <span class="lang" key="users">Coupons</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a onclick="menu('support.php','support_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-life-ring"></i>
                <p>
                    <span class="lang" key="users">Support</span>
                </p>
            </a>
        </li-->

    <?php if ($_SESSION['is_admin'] == '1') { ?>
        <li class="nav-item">
            <a onclick="menu('client.php','client_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    <span class="lang" key="">Client</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a onclick="menu('branch.php','branch_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-industry"></i>
                <p>
                    <span class="lang" key="">Branch</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a onclick="menu('users.php','users_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    <span class="lang" key="users">Users</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a onclick="menu('agent.php','agent_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                    <span class="lang" key="users">Agent</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a onclick="menu('support_admin.php','support_admin_modal.php');" class="nav-link">
                <i class="nav-icon fas fa-life-ring"></i>
                <p>
                    <span class="lang" key="users">Support</span>
                </p>
            </a>
        </li>
    <?php } ?>
</ul>