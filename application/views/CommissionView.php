
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">View and manage Commissions</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                    <div class="row">
                                        <button type="button" class="btn btn-success text-left" id = "addCommission">Add Commission</button>
                                    </div>
                            </div>


                        <div class="card-body">

                            <div class="row justify-content-start commissionGroup">
                                <div class="col md-4 lg-5">
                                    <div class="input-group">
                                    <input type="text" id = "dateRangePicker" name="daterange"/>
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="button" id = "applyDate">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            


                            
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="commissionsTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                
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

    <!-- Add Commission Modal -->

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Commission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action = "" method = "post" id = "addForm">

                        <div class = "form-group">

                            <div class="text-center">
                                <input type = "hidden" class = "form-control" name = "EmployeeId" data-employeeid>
                                <img src="..." class="img-fluid" alt="" name = "ImagePreview">
                                <label for = "LabelName" ></label>
                                <br>
                                <label for = "LabelNumber" ></label> 
                            </div>
                        
                        </div>

                        <div class="form-group">
                            <label for=""> Employee Number </label>
                            <input type="text" class="form-control" name = "EmployeeNumber">
                            <ul class = "list-group" id = "addResult">

                            </ul>
                        </div>

                        <div class="form-group">
                            <label for=""> Date </label>
                            <input type="text" class="form-control" name = "DatePicker">

                        </div>


                        <div class="form-group">
                            <label for=""> Description </label>
                            <input type="text" class="form-control" name = "Description">

                        </div>


                        <div class="form-group">
                            <label for=""> Amount </label>
                            <input type="text" class="form-control" name = "Amount">
                        </div>

                  </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id = "addRecord">Add Commission</button>
                </div>
                </div>
            </div>
        </div>


        <!-- Edit Commission Modal -->
        
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Commission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action = "" method = "post" id = "editForm">

                        <div class = "form-group">

                            <div class="text-center">
                                <input type = "hidden" class = "form-control" name = "CommissionId" data-commissionid>
                                <input type = "hidden" class = "form-control" name = "EmployeeId" data-employeeid>

                                <img src="..." class="img-fluid" alt="" name = "ImagePreview">
                                <label for = "LabelName" ></label>
                                <br>
                                <label for = "LabelNumber" ></label> 
                            </div>
                        
                        </div>

                        <div class="form-group">
                            <label for=""> Employee Number </label>
                            <input type="text" class="form-control" name = "EmployeeNumber">
                            <ul class = "list-group" id = "editResult">

                            </ul>
                        </div>

                        <div class="form-group">
                            <label for=""> Date </label>
                            <input type="text" class="form-control" name = "DatePicker">

                        </div>


                        <div class="form-group">
                            <label for=""> Description </label>
                            <input type="text" class="form-control" name = "Description">

                        </div>


                        <div class="form-group">
                            <label for=""> Amount </label>
                            <input type="text" class="form-control" name = "Amount">
                        </div>

                  </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" id = "editRecord">Edit Commission</button>
                </div>
                </div>
            </div>
        </div>


        <!-- Delete Commission modal-->

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Commission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action = "" method = "post" id = "deleteForm">

                        <div class = "form-group">

                            <div class="text-center">
                                <input type = "hidden" class = "form-control" name = "CommissionId" data-commissionid>

                                <img src="..." class="img-fluid" alt="" name = "ImagePreview">
                                <label for = "LabelName" ></label>
                                <br>
                                <label for = "LabelNumber" ></label> 
                            </div>
                        
                        </div>

                        <div class="form-group">
                            <label for=""> Employee Number </label>
                            <input type="text" class="form-control" name = "EmployeeNumber" readonly>
                        </div>

                        <div class="form-group">
                            <label for=""> Date </label>
                            <input type="text" class="form-control" name = "DatePicker" readonly>

                        </div>


                        <div class="form-group">
                            <label for=""> Description </label>
                            <input type="text" class="form-control" name = "Description" readonly>

                        </div>


                        <div class="form-group">
                            <label for=""> Amount </label>
                            <input type="text" class="form-control" name = "Amount" readonly>
                        </div>

                  </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id = "deleteRecord">Delete Commission</button>
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


    
    <!-- Date Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- date picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets\js\Admin\commissionmanage.js') ?>"></script>


</body>

</html>