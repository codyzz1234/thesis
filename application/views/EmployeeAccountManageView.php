
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Employee Accounts</h1>
                    </div>
                  

                    <!-- Content Row -->
                   <!-- DataTales Example -->
                   <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <button type="button" class="btn btn-success text-left" id = "addAccountButton">Add Employee Account</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="employeeAccountsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>EmployeeNumber</th>
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>Last Login</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url('DashBoardController/logout')?>"> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Employee Account Modal-->

    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Employee Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <label for="searchEmployee" class="col-form-label">Search Employee</label>
                <input type="text" class="form-control" id="searchEmployee">


                <ul class="list-group" id = "result">

                </ul>

                <form id = "employeeAddForm">
                    <input type="hidden" class="form-control" id="addEmployeeId">
                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Employee Number</label>
                        <input type="text" class="form-control" id="addEmployeeNumber" readonly>
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="addFirstName" readonly>
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="addLastName" readonly>
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="addPassword">
                    </div>

                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id = "addRecord">Add Record</button>
        </div>
        </div>
    </div>
   </div>
    <!--Edit Employee Account Modal-->

    <div class="modal fade" id="editEmployeeAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Employee Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <form id = "employeeEditForm">
                    <input type="hidden" class="form-control" id="editEmployeeId">
                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Employee Number</label>
                        <input type="text" class="form-control" id="editEmployeeNumber" readonly >
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstName"readonly >
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastName"readonly >
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="editPassword">
                    </div>
                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info" id = "editRecord">Edit Record</button>
        </div>
        </div>
    </div>
   </div>

   <!-- Delete Employee Account Modal -->
   
   <div class="modal fade" id="deleteEmployeeAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Employee Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <form id = "employeeDeleteForm">
                    <input type="hidden" class="form-control" id="deleteEmployeeId">
                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Employee Number</label>
                        <input type="text" class="form-control" id="deleteEmployeeNumber" readonly >
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="deleteFirstName"readonly >
                    </div>

                    <div class="form-group">
                        <label for="FirstName" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="deleteLastName"readonly >
                    </div>
                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id = "deleteRecord">Delete Record</button>
        </div>
        </div>
    </div>
   </div>

    <!-- Jquery -->
    <script src="<?php echo base_url('assets\js\LocalScripts\JqueryMin.js') ?>"></script>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <!-- date picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <!-- Sweet Alert2 -->
    <!-- CUstom SCript -->
    <script src="<?php echo base_url('assets\js\Admin\employeeAccountManage.js') ?>"></script>
</body>

</html>