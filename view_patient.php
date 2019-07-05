<?php
include "connection.php";
include 'header.php';
if(!$user->is_logged_in()){
  header('Location: ./login.php');
}
extract($_SESSION);
$id = $_GET['id'];
$result = $db->query('SELECT * FROM patient WHERE id = '.$id.'');
?>
<div id="main" class="sidebar-none">


  <div class="main-gradient"></div>
  <div class="wf-wrap">
    <div class="wf-container-main">
<h2>Patient #<?php echo $id; ?></h2>
<h4><?php echo "Hello! ".$info.', '.$name; ?></h4>


    <div id="content" class="content" role="main">


<table class="table table-responsive">
  <thead>
  <tr>
<th scope="col">PICTURE</th>
<th scope="col">NAME</th>
<th scope="col">DATE OF BIRTH</th>
<th scope="col">SEX</th>
<th scope="col">EMAIL</th>
<th scope="col">PHONE</th>
<th scope="col">ADDRESS</th>
</tr>
</thead>
<tbody>

<?php
for ($i = 1; $row = $result->fetchArray(); $i++) {?>

<tr>
<td><img src="<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['name']; ?>"></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['date_of_birth']; ?></td>
<td><?php if ( $row['sex']==1) {
  echo "Male";
}elseif ($row['sex']==2) {
  echo "female";
} else {
  echo "Not specified";
};?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['address']; ?></td>
</tr>
<?php }
 ?>
</tbody>
</table>

<hr>
<h2>Drug Prescription</h2>
<?php
$result = $db->query('SELECT * FROM prescription WHERE patient_id = '.$id.'');
$row = $result->fetchArray();
if (!empty($row['id'])) {?>

<table class="table table-hover table-bordered table-dark">
  <tr>
    <td>CC</td>
    <td><?php echo $row['cc']; ?></td>
  </tr>
  <tr>
    <td>OE</td>
    <td><?php echo $row['oe']; ?></td>
  </tr>
  <tr>
    <td>PD</td>
    <td><?php echo $row['pd']; ?></td>
  </tr>
  <tr>
    <td>DD</td>
    <td><?php echo $row['dd']; ?></td>
  </tr>
  <tr>
    <td>LAB WORK</td>
    <td><?php echo $row['lab_workup']; ?></td>
  </tr>
  <tr>
    <td>ADVICE</td>
    <td><?php echo $row['advice']; ?></td>

  </tr>
  <tr>
    <td>DATE</td>
    <td><?php echo $row['date']; ?></td>
  </tr>
  <tr>
    <td>NEXT VISIT</td>
    <td><?php echo $row['next_visit']; ?></td>
  </tr>
</table>
<?php }else {
  echo "NO PRESCRIPTION FOR THIS PATIENT";
}?>
<hr>
<h2>Drug List</h2>
<?php
if (isset($row['id'])) {

$result = $db->query('SELECT * FROM prescription_drug WHERE prescription_id = '.$row['id'].'');
if (!is_null($result->fetchArray())) {?>

<table class="table table-hover table-bordered table-dark">
  <thead>
    <tr>
      <th>DRUG TYPE</th>
      <th>DRUG DOSE</th>
      <th>DRUG DURATION</th>
      <th>DRUG STRENGTH</th>
      <th>DRUG ADVICE</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetchArray()) {?>
    <tr>
      <td><?php echo $row['drug_type']; ?></td>
      <td><?php echo $row['drug_dose']; ?></td>
      <td><?php echo $row['drug_duration']; ?></td>
      <td><?php echo $row['drug_strength']; ?></td>
      <td><?php echo $row['drug_advice']; ?></td>
    </tr>
  <?php  } ?>
  </tbody>
</table>
<?php }else {
  echo "NO PRESCRIBED DRUG FOR THIS PATIENT";
}
}else {
  echo "NO PRESCRIBED DRUG FOR THIS PATIENT";
}
?>
<!-- !Footer -->
<?php include 'footer.php'; ?>
