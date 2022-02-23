<?php

    require_once '../model/db.php';

    $db = new Database();

    if(isset($_POST['action']) && $_POST['action'] == "view"){
        $output = '';
        $data = $db->selectRecords();
        if($db->totalRowCount()>0){
            $output .= '<table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($data as $row){
                $output .= '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['firstname'].'</td>
                    <td>'.$row['lastname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>
                      <a class="btn btn-outline-success btn-sm infoBtn" href="#" role="button" id="'.$row['id'].'">Info</a>

                      <a class="btn btn-outline-primary btn-sm editBtn" href="#" id="'.$row['id'].'" role="button" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>

                      <a class="btn btn-outline-danger btn-sm delBtn" href="#" role="button" id="'.$row['id'].'">Del</a>
                    </td></tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        }
        else{
            echo '<h3 class="text-center mt-5">Sorry no data found</h3>';
        }
    }


    //Logic for inserting data into database
    if(isset($_POST['action']) && $_POST['action'] == "insert"){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $db->addUsers($firstname, $lastname, $email, $phone);
    }


    // Fetching user id
    if(isset($_POST['edit_id'])){

      $id = $_POST['edit_id'];

      $row = $db->getUserByID($id);
      echo json_encode($row);

    }


?>