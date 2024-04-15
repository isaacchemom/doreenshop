<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS</title>
   

<link href="https://www.chukahighschool.sc.ke/bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
  

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

</head>

<body class="hold-transition sidebar-mini">

    
    <div class="wrapper" id="app">

        

        <loader-component></loader-component>



        <nav class="main-header navbar navbar-expand navbar-white navbar-light">


            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                    

                        
    

                        <li class="nav-item">
                            
                            <router-link to="/dashboard" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    DASHBOARD

                                </p>
                            </router-link>

                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">

                            <router-link to="/staff" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    STAFF

                                </p>
                            </router-link>

                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">

                            <router-link to="/suppliers" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    SUPPLIERS

                                </p>
                            </router-link>

                        </li>
                    </ul>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">

                            <router-link to="/departments" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    DEPARTMENTS|OFFICES

                                </p>
                            </router-link>

                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">

                            <router-link to="/category" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    CATEGORIES

                                </p>
                            </router-link>

                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">

                            <router-link to="/products" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Products

                                </p>
                            </router-link>

                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">

                            <router-link to="/sales" class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>

                                    Sales
                                </p>
                            </router-link>

                        </li>
                    </ul>

                    
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">

                        <router-link to="/dailyreport" class="nav-link" active-class="active">
                            <i class="nav-icon fas fa-th"></i>
                            <p>

                                Daily Report
                            </p>
                        </router-link>

                    </li>
                </ul>



                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">

                    <router-link to="/dailyreports" class="nav-link" active-class="active">
                        <i class="nav-icon fas fa-th"></i>
                        <p>

                            Sales Report
                        </p>
                    </router-link>

                </li>
            </ul>


                </nav>

                
                

            </div>

        </aside>
        

        <div class="content-wrapper">
            <router-view></router-view>

        </div>

        <aside class="control-sidebar control-sidebar-dark">

            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright &copy; 2023 <a href="#">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
   
    
  

    
    <!--
    
   
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js'"></script>
    <script src="https://adminlte.io/themes/v3/plugins/jszip/jszip.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.flash.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> 

<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script

-->


 <!-- Bootstrap CSS -->

    <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

</body>

</html>
