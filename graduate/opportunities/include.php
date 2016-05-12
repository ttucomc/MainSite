<?php
	require('/comc/graduate/opportunities/includes.php');
	require('/comc/graduate/opportunities/group2.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group2)) {
		echo 'Not authorized.';
		exit;
	}
?>
