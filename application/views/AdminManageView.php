
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Admin Management</h1>
                    <p class="mb-4">Here you can manage Administrators</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-success text-left" id = "addAdmin">Add Administrator</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="adminManageTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Admin Id</th>
                                            <th>UserName</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Created On</th>
                                            <th>Last Login</th>
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


    <!-- Edit Admin Modal-->

<div class="modal fade bd-example-modal-lg" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmpolyeeModalLabel">Edit Records</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
        <form action ="" method = "post" id = "editAdminForm">

            <div class = "form-group" >
                <input type ="hidden" id ="editId" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Username * </label>
                <input type = "text" id = "editUserName" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Password * </label>

                <div class="input-group">
                  <input type = "password" id = "editPassword" class = "form-control">
                      <div class="input-group-append">
                        <button class="btn btn-outline-info" type="button" id = "editShowPass">
                            <i class="fas fa-eye" id = "editShowIcon"></i>
                        </button>
                      </div>  
                </div>  
            </div>

            
            <div class = "form-group">
                <label for = ""> First Name * </label>
                <input type = "text" id = "editFirstName" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Last Name * </label>
                <input type = "text" id = "editLastName" class = "form-control">
            </div>

            <div class = "form-group">
              <div class="text-right">
                <label for = ""> All fields marked with * are required </label> 
              </div>
            </div>

        </form>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" id = "updateRecords">Update Records</button>
      </div>
    </div>
  </div>
</div>

<!-- Add admin modal-->
<div class="modal fade bd-example-modal-lg" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAdminModalLabel">Add Administrator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
        <form action ="" method = "post" id = "addForm">

            <div class = "form-group">
                <label for = ""> Username * </label>
                <input type = "text" id = "addUserName" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Password * </label>
                   <div class="input-group">
                        <input type = "password" id = "addPassword" class = "form-control">
                        <div class="input-group-append">
                               <button class="btn btn-outline-info" type="button" id = "addShowPass">
                                  <i class="fas fa-eye" id = "addShowIcon"></i>
                               </button>
                        </div>   
                  </div>
            </div>

            
            <div class = "form-group">
                <label for = ""> First Name * </label>
                <input type = "text" id = "addFirstName" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Last Name * </label>
                <input type = "text" id = "addLastName" class = "form-control">
            </div>

            <div class = "form-group">
              <div class="text-right">
                <label for = ""> All fields marked with * are required </label> 
              </div>
            </div>
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" id = "addRecord">Add Administrator</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Admin Modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id = "deleteAdminModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">DELETE ADMIN?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        
                <div class = "text-center">
                    <p> ARE YOU SURE YOU WANT TO DELETE THIS ENTRY??</p>
                <div class = "text-center">
            
            <form action ="" method = "post" id = "deleteForm">
                    <div class = "form-group" >
                            <input type ="hidden" id ="deleteId" class = "form-control" readonly>
                    </div>
                    <div class = "form-group">
                        <label for = ""> Username </label>
                        <input type = "text" id = "deleteUserName" class = "form-control" readonly>
                    </div>


                    <div class = "form-group">
                        <label for = ""> First Name </label>
                        <input type = "text" id = "deleteFirstName" class = "form-control" readonly>
                    </div>

                    <div class = "form-group">
                        <label for = ""> Last Name </label>
                        <input type = "text" id = "deleteLastName" class = "form-control" readonly>
                    </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id = "deleteRecord"> Delete Record</button>
          </div>
        </div>
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


    <script>var baseurl = '<?php echo base_url() ?>';</script>

    

    <!-- Sweet Alert2 -->

    <!-- Custom Sript -->
    <script src="<?php echo base_url('assets\js\Admin\adminManage.js') ?>"></script>


</body>

</html>