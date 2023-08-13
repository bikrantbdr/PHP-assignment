<?php  
$insert = false;
$update = false;
$delete = false;

// Connect to the Database
require 'partials/_dbconnect.php';

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  // echo $sno;
  $sql = "DELETE FROM `employee` WHERE `employee`.`sn` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $name = $_POST["nameEdit"];
    $salary = $_POST["salaryEdit"];
    $dob = $_POST["dobEdit"];
    $company = $_POST["companyEdit"];

  // Sql query to be executed
  $sql = "UPDATE `employee` SET `name` = '$name', `salary` = '$salary', `dob` = '$dob', `company` = '$company' WHERE `employee`.`sn` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $name = $_POST["name"];
    $salary = $_POST["salary"];
    $dob = $_POST["dob"];
    $company = $_POST["company"];

  // Sql query to be executed
  $sql = "INSERT INTO `employee` (`sn`, `name`, `salary`, `dob`, `company`) VALUES (NULL, '$name', '$salary', '$dob', '$company')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ";
  } 
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  <title>Employee Dasboard</title>

</head>

<body>
  <?php
        require 'partials/_nav.php';
        // require 'partials/_dbconnect.php';
    ?>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/webtech/employee.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="name">employee Name</label>
              <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="salary">salary</label>
              <input class="form-control" type="int" id="salaryEdit" name="salaryEdit"></input>
            </div> 
            <div class="form-group">
              <label for="dob">date of birth</label>
              <input class="form-control" type="date" id="dobEdit" name="dobEdit"></input>
            </div> 
            <div class="form-group">
              <label for="company">Company</label>
              <input class="form-control" type="text" id="companyEdit" name="companyEdit"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

    <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your company has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your company has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your company has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

  <div class="container my-4">
    <h2>Add employee</h2>
    <form action="/webtech/employee.php" method="POST">
      <div class="form-group">
        <label for="name">Employee name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="salary"> Salary</label>
        <input type="int" class="form-control" id="salary" name="salary" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="dob">DOB</label>
        <input type="date" class="form-control" id="dob" name="dob" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="company">Company Name</label>
        <input type="text" class="form-control" id="company" name="company" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Create new employee</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sn</th>
          <th scope="col">employee name</th>
          <th scope="col">salary</th>
          <th scope="col">dob</th>
          <th scope="col">company name</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `employee`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['name'] . "</td>
            <td>". $row['salary'] . "</td>
            <td>". $row['dob'] . "</td>
            <td>". $row['company'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sn'].">Edit</button> 
            <button class='delete btn btn-sm btn-primary' id=d".$row['sn'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        salary = tr.getElementsByTagName("td")[1].innerText;
        dob = tr.getElementsByTagName("td")[2].innerText;
        company = tr.getElementsByTagName("td")[3].innerText;
        console.log(name, salary, dob, company);
        nameEdit.value = name;
        salaryEdit.value = salary;
        dobEdit.value = dob;
        companyEdit.value = company;
        // snoEdit.value = tr.getElementsByTagName("th")[0].innerText;
        // console.log(tr.getElementsByTagName("th")[0].innerText)
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit delete");
        tr = e.target.parentNode.parentNode;
        // console.log(tr.getElementsByTagName("th")[0].innerText)
        // sno = tr.getElementsByTagName("th")[0].innerText;
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/webtech/employee.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>
 