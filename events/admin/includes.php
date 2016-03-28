<?php
        session_start();
        $_SESSION['eRaiderDispatchURL'] = "http://www.depts.ttu.edu/comc/events/admin/index.php";
        $_SESSION['eRaiderDBUsername'] = "ESI_MCOM_COMCEVENTS";
        $_SESSION['eRaiderDBpassword'] = "OtUhE4IjOpIzOvU";
        // $_SESSION['eRaiderFailureURL'] = "<Optional URL goes here in the event of an authentication failure>";
		require_once($_SERVER['DOCUMENT_ROOT'].'/_ttu-template/includes/eraider.php');
?>
