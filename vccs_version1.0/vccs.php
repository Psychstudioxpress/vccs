<?php
// PsychStudioXpress provides tools to behavioral and social science researchers.
// Copyright (C) 2012 William Kelly Hudgins
// This program is free software: you can redistribute it and/or modify it
// under the terms of the GNU General Public License as published by
// the Free Software Foundation, version 3.
//
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
// or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
// more details.
//
// You should have received a copy of the GNU General Public License along with
// this program. If not, see <http://www.gnu.org/licenses>.
//
// If you have questions, please email wkhudgins@psychstudioxpress.net

// PsychStudioXpress
// vCCS, Version 1.0
// vccs.php
//
// This file contains the actual check correction simulation.                                  
// Sets the following session variable:													      
// end - The time the participant finishes the task.                             			  

include "conf.php";
	
function store_check($date, $payee, $payor, $amount, $routing_num, $account_num, $check_num)
{		
	$verify_check = mysql_query("INSERT INTO `verified_checks` (`condition`, `participant_ID`, `image_number`, `date`, `payor`, `payee`, `amount`, `routing`, `account_num`,
		`check_num`) VALUES ('$_SESSION[CONDITION]', '$_SESSION[PID]', '$_SESSION[check_image_number]', '$date', '$payor', '$payee', '$amount', '$routing_num', '$account_num', 
		'$check_num')") or die(mysql_error());
}

# Logs users out, only used manually.
if ($_GET['action'] == 'logout')
{
session_destroy();
unset($_SESSION['CONDITION']);
unset($_SESSION['check_image_number']);
unset($_SESSION['password']);
}

	# Redirects non-logged in users
	if (!isset($_SESSION['password']))
	{
	header("Location: login.php");
	}

# Determine total number of unverified checks
$count_checks = mysql_query("SELECT * FROM unverified_checks")or die(mysql_error());
$count_checks = mysql_num_rows($count_checks);

# HTML Header
echo "<html>
		<head>
			<title>".$PROJECT_TITLE." ".$USAGE." ".$VERSION."</title>
		</head>";

# If checks are still left to be verified		
if ($_SESSION['check_image_number'] <= $count_checks)
{
$get_checks = mysql_query("SELECT * FROM unverified_checks WHERE image_number = '$_SESSION[check_image_number]'")or die(mysql_error());
$check = mysql_fetch_array($get_checks);

echo "<body>
		<form method=\"post\" action=\"\">
			<table>
				<tr><th>Check Image No. ".$_SESSION['check_image_number']."</th></tr>
				
				<tr><td>Date:</td><td>
				<input type=\"text\" name=\"date\" value=\"".$check['date']."\" /></td></tr>
				
				<tr><td>Payor:</td><td>
				<input type=\"text\" name=\"payor\" value=\"".$check['payor']."\" /></td></tr>
				
				<tr><td>Payee:</td><td>
				<input type=\"text\" name=\"payee\" value=\"".$check['payee']."\" /></td></tr>
				
				<tr><td>Amount:</td><td>
				<input type=\"text\" name=\"amount\" value=\"".$check['amount']."\" /></td></tr>
				
				<tr><td>Rounting #:</td><td>
				<input type=\"text\" name=\"routing_num\" value=\"".$check['routing']."\" /></td></tr>
				
				<tr><td>Account #:</td><td>
				<input type=\"text\" name=\"account_num\" value=\"".$check['account_num']."\" /></td></tr>
				
				<tr><td>Check #:</td><td>
				<input type=\"text\" name=\"check_num\" value=\"".$check['check_num']."\" /></td></tr>
				
				<input type=\"hidden\" name=\"submit_check\" value=\"1\" />
				<tr>
				<td><input type=\"submit\" value=\"Verify Checks\" onClick=\"verify_checks\" /></td>
				<td><input type=\"reset\" value=\"Clear\" /></td>
				</tr>
			</table>
		</form>
</body>";

	if (isset($_POST['submit_check']))
	{
		if (!$BREAK || $_SESSION['check_image_number'] > $NUM_BEFORE_BREAK)
		{
			$date = clean($_POST['date']);
			$payor = clean($_POST['payor']);
			$payee = clean($_POST['payee']);
			$amount = clean($_POST['amount']);
			$routing_num = clean($_POST['routing_num']);
			$account_num = clean($_POST['account_num']);
			$check_num = clean($_POST['check_num']);
			store_check($date, $payee, $payor, $amount, $routing_num, $account_num, $check_num);
			$_SESSION['check_image_number'] += 1;
			header("Location: vccs.php");
		}
		
		else if ($BREAK && $_SESSION['check_image_number'] < $NUM_BEFORE_BREAK)
		{
			$_SESSION['check_image_number'] += 1;
			header("Location: vccs.php");	
		}

		else if ($BREAK && $_SESSION['check_image_number'] == $NUM_BEFORE_BREAK)
		{
			$_SESSION['check_image_number'] += 1;
			echo "<hr /><center>Please tell your experimenter it is time for your break.<br />
						When finished with break, <a href=\"vccs.php\">click here.</a>
						</center><hr />";
		}
	}
}

# If all checks have been verified
else if ($_SESSION['check_image_number'] > $count_checks)
{
$_SESSION['end'] = time();
header("Location: collection.php");
}
