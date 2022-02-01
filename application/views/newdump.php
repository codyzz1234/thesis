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
</div