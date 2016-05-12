<?php
        session_start();
        $_SESSION['eRaiderDispatchURL'] = "https://www.depts.ttu.edu/comc/graduate/opportunities/index.php";
        $_SESSION['eRaiderDBUsername'] = "ESI_MCOM_GRADOPPERTUNITIES";
        $_SESSION['eRaiderDBpassword'] = "AvUzAs2rAlUqIlE";
        // $_SESSION['eRaiderFailureURL'] = "<Optional URL goes here in the event of an authentication failure>";
		require_once($_SERVER['DOCUMENT_ROOT'].'/_ttu-template/includes/eraider.php');
?>
