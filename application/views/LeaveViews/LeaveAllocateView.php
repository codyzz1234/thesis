
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Leave Allocate</h1>
                 
                    </div>
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                    <div class="row">
                                        <button type="button" class="btn btn-success text-left" id = "addAllocation">Add Leave Allocation</button>
                                    </div>
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="leaveAllocateTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Employee Number</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Leave Allocated</th>
                                            <th>Leave Use</th>
                                            <th>Leave Balance</th>
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

    <!-- Add Allocation Modal -->
    <div class="modal fade" id="addAllocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Allocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type = "hidden" id = "addId" class = "form-control">
                    <div class = "form-group">
                        <label for = ""> Search Employee </label>
                        <input type = "text" id = "addSearch" class = "form-control">

                        <ul class="list-group" id = "addResult">

                        </ul>
                    </div>
                    
                    <div class = "form-group">
                        <label for = ""> First Name </label>
                        <input type = "text" id = "addFirst" class = "form-control"readonly>
                    </div>

                    <div class = "form-group">
                        <label for = ""> Last Name </label>
                        <input type = "text" id = "addLast" class = "form-control"readonly>
                    </div>

                    <div class = "form-group">
                        <label for = "">  Employee Number </label>
                        <input type = "text" id = "addNumber" class = "form-control"readonly>
                    </div>

                    <div class = "form-group">
                        <label for = "">  Amount Of Days To Allocate  </label>
                        <input type = "text" id = "addAllocate" class = "form-control">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id = "addRecord">Add Allocation</button>
            </div>
            </div>
        </div>
        </div>

    <!-- Edit Allocation-->
    <div class="modal fade" id="editAllocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Allocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type = "hidden" id = "editId" class = "form-control">

                    
                    <div class = "form-group">
                        <label for = ""> First Name </label>
                        <input type = "text" id = "editFirst" class = "form-control"readonly>
                    </div>

                    <div class = "form-group">
                        <label for = ""> Last Name </label>
                        <input type = "text" id = "editLast" class = "form-control"readonly>
                    </div>

                    <div class = "form-group">
                        <label for = "">  Employee Number </label>
                        <input type = "text" id = "editNumber" class = "form-control"readonly>
                    </div>

                    <div class = "form-group">
                        <label for = "">  Leave Allocated  </label>
                        <input type = "text" id = "editAllocate" class = "form-control">
                    </div>

                    <div class = "form-group">
                        <label for = "">  Leave Use  </label>
                        <input type = "text" id = "editUse" class = "form-control">
                    </div>

                    <div class = "form-group">
                        <label for = "">  Leave Balance </label>
                        <input type = "text" id = "editBalance" class = "form-control">
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" id = "editRecord">Edit Allocation</button>
            </div>
            </div>
        </div>
        </div>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
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

    
    <!-- Jquery -->
    <<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>window.jQuery || document.write('<script src="assets\js\JQueryLocal\JqueryMin.js">\x3C/script>')</script>

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
    <script src="<?php echo base_url('assets\js\Admin\LeaveScripts\leaveallocation.js') ?>"></script>



</body>

</html>