<?php
	require('/comc/events/admin/includes.php');
	require('/comc/events/admin/group2.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group2)) {
		echo 'Not authorized.';
		exit;
	}
?>
