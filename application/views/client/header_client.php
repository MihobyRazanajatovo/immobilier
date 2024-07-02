<header>
    <div class="wrapper">
        <div class="iq-sidebar  sidebar-default  ">
            <div class="iq-sidebar-logo d-flex align-items-end justify-content-between">
                <a href="#" class="header-logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>" class="img-fluid rounded-normal light-logo" alt="logo">
                    <img src="<?php echo base_url('assets/images/logo-dark.png'); ?>" class="img-fluid rounded-normal d-none sidebar-light-img" alt="logo">
                    <span>Mada Immo</span>
                </a>
                <div class="side-menu-bt-sidebar-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="side-menu">
                        <li class="sidebar-layout">
                            <a href="<?php echo base_url('Client'); ?>" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </i>
                                <span class="ml-2">Accueil</span>
                                <!-- <p class="mb-0 w-10 badge badge-pill badge-primary">6</p> -->
                            </a>
                        </li>
                        <!-- <li class="px-3 pt-3 pb-2">
                            <span class="text-uppercase small font-weight-bold">Pages</span>
                        </li> -->
                        <li class="sidebar-layout">
                            <a href="<?php echo base_url('client/payment_status_by_client'); ?>" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </i>
                                <span class="ml-2">Statut loyer</span>
                                <!-- <p class="mb-0 w-10 badge badge-pill badge-primary">6</p> -->
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- header -->
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="side-menu-bt-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary wrapper-menu" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="notification-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        <span class="bg-primary"></span>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="notification-dropdown">
                                        <div class="card shadow-none m-0 border-0">
                                            <div class="p-3 card-header-border">
                                                <h6 class="text-center">
                                                    Notifications
                                                </h6>
                                            </div>
                                            <div class="card-body overflow-auto card-header-border p-0 card-body-list" style="max-height: 500px;">
                                                <ul class="dropdown-menu-1 overflow-auto list-style-1 mb-0">
                                                    <a href="<?php echo base_url('portefeuille/show_recharges_en_attente'); ?>">
                                                        <li class="dropdown-item-1 float-none p-3">
                                                            <div class="list-item d-flex justify-content-start align-items-start">
                                                                <div class="list-style-detail ml-2 mr-2">
                                                                    <h6 class="font-weight-bold">Recharge en attente</h6>
                                                                    <p class="m-0">
                                                                        <small class="text-secondary">You got new order of
                                                                            goods</small>
                                                                    </p>
                                                                    <p class="m-0">
                                                                        <small class="text-secondary">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary mr-1" width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                            </svg>
                                                                            5 hours ago</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </a>
                                                </ul>
                                            </div>
                                            <div class="card-footer text-muted p-3">
                                                <p class="mb-0 text-primary text-center font-weight-bold">Show all
                                                    notifications</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon search-content">
                                    <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="svg-icon text-secondary" id="h-suns" height="25" width="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12" placeholder="type here to search...">
                                                <a href="#" class="search-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="nav-item nav-icon dropdown-toggle pr-0 search-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo base_url('assets/images/user/1.jpg'); ?>" class="img-fluid avatar-rounded" alt="user">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-item  d-flex svg-icon border-top">
                                            <svg class="svg-icon mr-0 text-secondary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <a href="<?php echo base_url('logout'); ?>">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
</header>
<script src="<?php echo base_url('assets/js/backend-bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/slider.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>