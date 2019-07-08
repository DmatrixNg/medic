<?php
include "connection.php";
 include 'header.php'; ?>
 <div id="main" class="sidebar-none">


   <div class="main-gradient"></div>
   <div class="wf-wrap">
     <div class="wf-container-main">
       <div id="content" class="content" role="main">


<h2>Search Drugs</h2>
	 <div class="form-group">
	 						<div class="form-label-group">
	 							<input type="search"class="form-control" onkeyup="patient(this.value)" name="id"/>

	 							</div>
	 						</div>

	 						<div id='view'>
								<div class="spinner-border" role="status">
  <span class="sr-only">Loading...</span>
</div>
	 						</div>

	<script>
	function patient(str) {
	    if (str == "") {
	        document.getElementById("#view").innerHTML = "";
	        return;
	    } else {
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("view").innerHTML = xmlhttp.responseText;
	            }
	        };
	xmlhttp.open("GET","listdrug.php?id="+str, true);
	xmlhttp.send();

	    }
	}
	</script>
<?php


include 'footer.php'; ?>
