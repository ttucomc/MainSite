<?php

$startat = 7;  // first story to display, should be $feedsize from newsfeed.php + 1

$display = $_REQUEST["cat"]; // which stories are we displaying? use newsfeed.php?cat=alumni for alumni stories
$check = 0;
$viewed = 0;
$atstory = 0;
$lastdate = "none";
$sql = "SELECT * FROM newsblurb ORDER BY date DESC, headline ASC"; // this controls what order you will see stories displayed.

include('mcdb.php');
$sql_result = mssql_query($sql) or die("Couldn't execute query.");
if (!$sql_result) {
   	echo "<p>Error retrieving news stories!</p>";
	} else {
	while ($row = mssql_fetch_array($sql_result)) {
		$check = 0;
		$ID = $row["ID"];
		$cat1 = $row["cat1"];
		$cat2 = $row["cat2"];
		$cat3 = $row["cat3"];
		$cat4 = $row["cat4"];
		$cat5 = $row["cat5"];
		$date = $row["date"];
		$month = ltrim(substr($date,5,2),'0');
		$day = ltrim(substr($date,8,2),'0');
		$date = $month.'/'.$day.'/'.substr($date, 2, 2);
		$headline = $row["headline"];
		$blurb = $row["blurb"];
		$thumbnail = $row["thumbnail"];

		if ($display == $cat1) {
			$check = 1;
		} elseif ($display == $cat2) {
			$check = 1;
		} elseif ($display == $cat3) {
			$check = 1;
		} elseif ($display == $cat4) {
			$check = 1;
		} elseif ($display == $cat5) {
			$check = 1;
		}

		if ($check == 1) {
		$atstory += 1;
			if ($atstory >= $startat) {
			if ($lastdate != $date) {
				if ($viewed == 0) {
					echo "<div id=\"newsfeed\">";
				} else {
					echo "</ul>";
				}
				echo "<p><strong>".$date."</strong></p><ul>";
			}
			if (strlen($thumbnail) > 4) {
   				echo "<img src=\"/comc/images/news/".$thumbnail."\" alt=\"".$thumbnail."\" style=\"float:left; margin-right:25px;height:70px;\">";
			}
			if (strlen($headline) < 2) {
				echo "<li>".$blurb."</li>";
			} else {
				echo "<li><b>".$headline."</b> - ".$blurb."</li>";
			}
			if (strlen($thumbnail) > 4) {
   				echo "<br style=\"clear:both;\" /><br style=\"margin-top:5px;line-height:11px;\" />";
			}
				$viewed += 1;
				$lastdate = $date;
			}
		}
	}
}

if ($viewed == 0) {
	echo "<div id=\"newsfeed\"><ul><li>No stories to display.</li></ul></div>";
} else {
	echo "</ul></div>";
}
?>
