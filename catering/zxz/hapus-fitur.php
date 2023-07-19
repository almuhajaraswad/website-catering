<?php 
require 'functions.php';

function hapus_fitur($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM fitur WHERE id = $id");

	return mysqli_affected_rows($conn);
}

$id = $_GET["id"];
if (hapus_fitur($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'fitur.php';
		</script>
	";
    } else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'fitur.php';
		</script>
	";
	}
 ?>