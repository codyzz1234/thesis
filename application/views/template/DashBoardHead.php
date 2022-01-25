<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ampong Dental</title>

    <!-- Custom fonts for this template-->

    <link rel = "stylesheet" href="<?php echo base_url('assets/dashboard/vendor/fontawesome-free/css/all.min.css') ?>" type="text/css" />

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel = "stylesheet" href="<?php echo base_url('assets/dashboard/vendor/fontawesome-free/css/all.min.css') ?>" type="text/css" />
    
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
   <!-- Custom styles for this template-->
    <link rel = "stylesheet" href="<?php echo base_url('assets/dashboard/css/sb-admin-2.min.css') ?>" type="text/css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Toastr -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel = "stylesheet" href="<?php echo base_url('assets/toastr/toastr.css') ?>" type="text/css" />
    
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"/>

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link rel = "stylesheet" href="<?php echo base_url('assets\css\Admin\adminStyle.css') ?>" type="text/css" />

    <!-- Time Picker -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <!--Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <script>var baseurl = '<?php echo base_url() ?>';</script>



    

</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('DashBoard')?>">
                <div class="sidebar-brand-text mx-3">Ampong Dental</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('DashBoard')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Employee Management
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#EmployeeNavSection"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-tasks"></i>
                    <span>Employees</span>
                </a>
                <div id="EmployeeNavSection" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Employee Details:</h6>
                        <a class="collapse-item" href="<?php echo base_url('EmployeeManageController')?>">Employee List</a>
                        <a class="collapse-item" href="<?php echo base_url('EmployeeSalaryControl')?>">Employee Salaries</a>
                    </div>
                </div>
            </li>

            

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('DepartmentControl')?>">
                <i class="fas fa-building"></i>
                    <span>Departments</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('PositionControl')?>">
                <i class="fas fa-portrait"></i>
                    <span>Positions</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('AttendanceControl')?>">
                <i class="fas fa-concierge-bell"></i>
                    <span>Attendance</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('ScheduleControl')?>">
                <i class="fas fa-clipboard-list"></i>
                    <span>Schedules</span></a>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#PayrollNavSection"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-money-check"></i>
                    <span>Payroll</span>
                </a>

                <div id="PayrollNavSection" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Payroll Details:</h6>
                        <a class="collapse-item" href="<?php echo base_url('CommissionControl')?>">Dental Commissions</a>

                        <a class="collapse-item" href="<?php echo base_url('PayrollControl')?>">Payroll Management</a>
                    </div>
                </div>


            </li>

         

            <!-- Nav Item - Utilities Collapse Menu -->
    

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
           
            <!-- Nav Item - Pages Collapse Menu -->
  

            <!-- Nav Item - Charts -->
          

            <!-- Nav Item - Tables -->
          

            <!-- Divider -->
           

            <!-- Sidebar Toggler (Sidebar) -->
        

            <!-- Sidebar Message -->
        

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>

                                <a class="dropdown-item" href= "<?php echo base_url('AdminManageController')?>">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Manage Administrators
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                             </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
