
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Employee Management</h1>
                    <p class="mb-4 text-gray-800">Here you can manage employee information edit employee details. </p>

                    <!-- Data Tables -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <button type="button" class="btn btn-success text-left" id = "addEmployeeButton">Add Employee</button>
                            </div>
                        </div>
                    <!-- Add employee Button-->
             
                    <!-- Add Employee Butoon-->

                    <!-- Data Table Format-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="employeeRecords" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>Image</th>
                                            <th>Emp No.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Contact Number</th> 
                                            <th>Department</th> 
                                            <th>Branch</th> 
                                            <th>Position</th> 
                                            <th>Time In</th> 
                                            <th>Time Out</th>
                                            <th>Actions</th>
                                        </tr> 
                                    </thead>
                                    <tbody>

                                     
                                         
                                    </tbody>
        
                                </table>
                            </div>
                        </div>
                    <!-- Data Table Format -->
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

<!-- Add Employee Modal-->
<div class="modal fade bd-example-modal-lg" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEmployeeModalLabel">Add Records</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


     <div class="modal-body">
        <form action ="" method = "post" id = "addEmployeeForm">
            <div class = "form-group">
                <label for = ""> First Name </label>
                <input type = "text" id = "FirstName" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Last Name </label>
                <input type = "text" id = "LastName" class = "form-control">
            </div>
            
        

            <div class = "form-group">
                <label for = ""> Birthdate </label>
                <input type = "text" id = "BirthDate" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Address </label>
                <input type = "text" id = "Address" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Contact Number </label>
                <input type = "text" id = "ContactNumber" class = "form-control">
            </div>

            <div class="form-group">
                <label for="Select Department">Select Department</label>
                <select class="form-control" id="DepartmentSelector">
                </option> <option value="0">Select A Department</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Select Branch">Select Position</label>
                <select class="form-control" id="PositionSelector">
                </option> <option value="0">Select A Position</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Select Department">Select Branch</label>
                <select class="form-control" id="BranchSelector">
                </option> <option value="0">Select A Branch</option>
                </select>
            </div>

            
            <div class="form-group">
                <label for="Select Branch">Select Schedule</label>
                <select class="form-control" id="ScheduleSelector">
                </option> <option value="0">Select A Schedule</option>
                </select>
            </div>


            <div class = "form-group">
                <label for = ""> RFID Number </label>
                <input type = "text" id = "RFID" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Image</label>
                <input type = "file" id = "addImage" class = "form-control">
            </div>

            <div class = "form-group">
                <img src="..." class="img-fluid" alt="" id = "addPreview">
            </div>


        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id = "addRecords">Add Employee</button>
      </div>
    </div>
  </div>
</div>
<!-- Add Employee Modal -->



<!--Edit Employee Modal -->


<div class="modal fade bd-example-modal-lg" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmpolyeeModalLabel">Edit Records</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


     <div class="modal-body">
        <form action ="" method = "post" id = "editEmployeeForm">

            <div class = "form-group" >
                <input type ="hidden" id ="editEmployeeId">
            </div>

            <div class = "form-group" >
                     <img src="..." class="img-fluid" alt="Responsive image" id = "editPreview">
                     <input type = "file" id = "editImage" class = "form-control">
            </div>


            <div class = "form-group">
                <label for = ""> Employee Number </label>
                <input type = "text" id = "editEmployeeNumber" class = "form-control" readonly>
             </div>


            <div class = "form-group">
                <label for = ""> First Name </label>
                <input type = "text" id = "editFirstName" class = "form-control">
             </div>

            <div class = "form-group">
                <label for = ""> Last Name </label>
                <input type = "text" id = "editLastName" class = "form-control">
            </div>
            
        

            <div class = "form-group">
                <label for = ""> Birthdate </label>
                <input type = "text" id = "editBirthDate" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Address </label>
                <input type = "text" id = "editAddress" class = "form-control">
            </div>

            <div class = "form-group">
                <label for = ""> Contact Number </label>
                <input type = "text" id = "editContactNumber" class = "form-control">
            </div>

            <div class="form-group">
                <label for="Select Department">Select Department</label>
                <select class="form-control" id="editDepartmentSelector">
                </option> <option value="0">Select A Department</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Select Branch">Select Position</label>
                <select class="form-control" id="editPositionSelector">
                </option> <option value="0">Select A Position</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Select Department">Select Branch</label>
                <select class="form-control" id="editBranchSelector">
                </option> <option value="0">Select A Branch</option>
                </select>
            </div>

            
            <div class="form-group">
                <label for="Select Branch">Select Schedule</label>
                <select class="form-control" id="editScheduleSelector">
                </option> <option value="0">Select A Schedule</option>
                </select>
            </div>

            <div class = "form-group">
                <label for = ""> RFID Number </label>
                <input type = "text" id = "editRFID" class = "form-control">
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


<!-- Delete Employee Modal-->

<div class="modal fade bd-example-modal-lg" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEmployeeLabel">DELETE RECORD?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <div class="modal-body">
        <form action ="" method = "post" id = "deleteEmployeeForm">

            <div class = "form-group" >
                     <img src="..." class="img-fluid" alt="Responsive image" id = "deletePreview">
            </div>

            <div class = "form-group" >
                <input type ="hidden" id ="deleteEmployeeId">
            </div>


            <div class = "form-group">
                <label for = ""> Employee Number </label>
                <input type = "text" id = "deleteEmployeeNumber" class = "form-control" readonly>
             </div>


            <div class = "form-group">
                <label for = ""> First Name </label>
                <input type = "text" id = "deleteFirstName" class = "form-control" readonly>
             </div>

            <div class = "form-group">
                <label for = ""> Last Name </label>
                <input type = "text" id = "deleteLastName" class = "form-control" readonly>
            </div>
            
          

            <div class = "form-group">
                <label for = ""> Birthdate </label>
                <input type = "text" id = "deleteBirthDate" class = "form-control" readonly>
            </div>

            <div class = "form-group">
                <label for = ""> Address </label>
                <input type = "text" id = "deleteAddress" class = "form-control" readonly>
            </div>

            <div class = "form-group">
                <label for = ""> Contact Number </label>
                <input type = "text" id = "deleteContactNumber" class = "form-control" readonly>
            </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id = "deleteRecords">Delete Record</button>
      </div>
    </div>
  </div>
</div>



    <!-- Jquery -->
    <script src="<?php echo base_url('assets\js\LocalScripts\JqueryMin.js') ?>"></script>



    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
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
    <script src="<?php echo base_url('assets\js\Admin\employeemanage.js') ?>"></script>

</body>

</html>