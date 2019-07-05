<?php
include "connection.php";
include 'header.php';
if(!$user->is_logged_in()){
  header('Location: ./login.php');
}
extract($_SESSION);

$result = $db->query('SELECT * FROM patient ');
?>
<div id="main" class="sidebar-none">


  <div class="main-gradient"></div>
  <div class="wf-wrap">
    <div class="wf-container-main">
<h2>Patient List</h2>
<h4><?php echo "Hello! ".$info.', '.$name; ?></h4>


    <div id="content" class="content" role="main">


<form method="get" action="search.php?id=">
                <div class="input-group input-group-search">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <span class="oi oi-magnifying-glass"></span>
                    </span>
                  </div>

                    <input type="text" class="form-control" name="q" aria-label="Search" placeholder="Search"></div>
                  </form>
                  <center>
<table class="table table-responsive">
  <caption>List of Patients</caption>
<thead>
  <tr>

<th scope="col">SN</th>
<th scope="col">NAME</th>
<th scope="col">EMAIL</th>
<th scope="col">PHONE</th>
<th scope="col">SEX</th>
<th scope="col">ACTION</th>
</tr>
</thead>
<tbody>

<?php
for ($i = 1; $row = $result->fetchArray(); $i++) {?>

<tr>
<th scope="row"><?php echo $i; ?></td>
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
</center>

<?php include 'footer.php'; ?>
