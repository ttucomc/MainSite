<?php
	require('/comc/graduate/opportunities/includes.php');
	require('/comc/graduate/opportunities/access.php');

	$isAdmin = false;

	if(!in_array($_SESSION['eRaiderUsername'], $usersAllowed)) {
		echo 'Not authorized.';
		exit;
	}

	if(in_array($_SESSION['eRaiderUsername'], $usersAllowed)) {

		$isAdmin = true;

		exit;
	}
?>
