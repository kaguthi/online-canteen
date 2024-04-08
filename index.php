<?php 
session_start();
include "config/database.php";
include "utils.php";
include "header.php";
?>
<script>
  count_item();
	function count_item(){
		$.ajax({
			url : "functions/updatecart.php",
			method : "POST",
			data : {count_item:1},
			success : function(data){
				$("#badge").html(data);
			}
		})
	}
</script>
<?php
include "home.php";
?>