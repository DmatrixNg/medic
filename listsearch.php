<?php
include "connection.php";
$id =$_GET['id'];
$q = $id;
$sql = "SELECT * FROM patient WHERE name like '%$q%' ";
$result = $db->query($sql);?>
<table class="table table-responsive">
  <caption>List of Patients</caption>
<thead>
  <tr>

<th scope="col">NAME</th>
<th scope="col">EMAIL</th>
<th scope="col">PHONE</th>
<th scope="col">SEX</th>
<th scope="col">ACTION</th>
</tr>
</thead>
<tbody>
<?php
while ($row = $result->fetchArray()){?>
  <tr>
  <td><?php echo $row['name']; ?></td>
  <td><?php echo $row['email']; ?></td>
  <td><?php echo $row['phone']; ?></td>
  <td><?php if ( $row['sex']==1) {
    echo "Male";
  }elseif ($row['sex']==2) {
    echo "female";
  } else {
    echo "Not specified";
  };?></td>
  <td><a href="view_patient.php?id=<?php echo $row['id']; ?>">View</a></td>
  </tr>
  <?php }
   ?>
  </tbody>
  </table>
