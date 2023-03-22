<?php 
@session_start();
if(@$_SESSION['id'] == ""){
	echo "<script>window.location='/lenny/logout.php'</script>";
	exit();
}
 ?>