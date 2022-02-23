<!doctype html>
<html lang="en">
  <head>
    <title>PDO</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
  </head>
  <body>
    

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">Tutorials</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <h4 class="text-center text-danger my-4">CRUD Application Using PHP-OOP, PDO-MySQL, AJAX</h4>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <h4 class="mt-2 text-primary">All users in database</h4>
          </div>
          <div class="col-lg-6">
            <button type="button" class="btn btn-primary m-1 float-end" data-bs-toggle="modal" data-bs-target="#addModal">Add new user</button>
            <a class="btn btn-success m-1 float-end" href="#" role="button">Export to Excel</a>
          </div>

        </div>

        <hr class="my-2">

        <div class="row">
          <div class="col-lg-12">

          <div class="table-responsive" id="showUser">      

          </div>

          </div>
        </div>

      </div>


      <!-- Add new user modal -->
      <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalLabel">Add User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" id="form-data">
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" name="firstname" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" name="lastname" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" name="phone" required>
                </div>
                <button type="submit" id="insert" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Edit/Update user modal -->
      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalLabel">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" id="edit-form-data">
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" name="firstname" id="firstname" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" name="lastname" id="lastname" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" name="phone" id="phone" required>
                </div>
                <button type="submit" id="update" id="update" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script type="text/javascript">

      $(document).ready(function(){

        showAllUsers();

        function showAllUsers(){
          $.ajax({
            url: "controller/action.php",
            type: "POST",
            data: {
              action: "view"
            },
            success: function(response){
              // console.log(response);
              $("#showUser").html(response);
              $("table").DataTable({
                order: [0, 'desc']
              });
            }
          });
        }


        //insert records
        $("#insert").click(function(e){
          if($("#form-data")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
              url: "controller/action.php",
              type: "POST",
              data: $("#form-data").serialize()+"&action=insert",
              success: function(response){
                // console.log(response);
                Swal.fire({
                  title: "User Added Successfully",
                  type: "success",
                })
                $("#addModal").modal('hide');
                $("#form-data")[0].reset();
                showAllUsers();
              }
            })
          }
        });

      });
          

    </script>

  </body>
</html>