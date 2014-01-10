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
// login.php
//
// This file is used to log participants into the system.                                      
// Sets session variables including:															  
// CONDITION - The Condition a participant is assigned to.									  
// start - The time the participant logs in and begins the task.                               
// Participant ID - An MD5 hash that is used as the ID of a participant.                       

include 'conf.php';

# Redirects a user if they're already logged in
if (isset($_SESSION['password']))
{
header("Location: vccs.php");
}

	# Processes Login
	if ($_POST['username'] != '' && $_POST['password'] != '' && $_POST['condition'] != '')
	{
	$usern = clean($_POST['username']);
	$passw= crypto($_POST["password"]);

	# Compares user credentials with the DB
	$db_check = mysql_query("SELECT * FROM users WHERE username='$usern' AND password='$passw'");
	
		# Logs in the user
		if ($user = mysql_fetch_array($db_check)) 
		{
			$_SESSION['CONDITION'] = clean($_POST['condition']); // The ID of the condition
			$_SESSION['password'] = md5($user['password']);
			$_SESSION['check_image_number'] = 1;
			$_SESSION['start'] = time(); 
				$random_digit = rand(100,999);
				$_SESSION['PID'] = md5(time().$random_digit); // The ID of the participant
		header("Location: vccs.php");
		}
			// If the supplied data doesn't match the database data
			else { echo "<div align=\"center\">Sorry, the credentials you supplied do not match those found in our database. Please try again. If you continue to experience problems, 	please contact your system administrator or project manager.</div>"; }
	} 
		// If the form is incomplete
		else if (isset($_POST['submit_check']) && ($_POST['username'] == '' || $_POST['password'] =='' || $_POST['condition'] == '')) 
		{ echo "<div align=\"center\">In order to login, please fill out the entire form.</div>"; }

// Login Screen		
echo "
<html>

<head>
	<title>".$PROJECT_TITLE." ".$USAGE." ".$BUILD_NO." Login</title>
</head>

<body> 
	<div align=\"center\">
	<h3>Login to ".$PROJECT_TITLE." ".$USAGE."</h3>
		<form method=\"post\" action=\"\">
			<table>
				<tr><td>Username:</td><td><input type=\"text\" name=\"username\" /></td></tr>
				<tr><td>Password:</td><td><input type=\"password\" name=\"password\" /></td></tr>
				<tr><td>Layout Engine:</td><td><input type=\"text\" name=\"condition\" size=\"2\" /></td></tr>
						<input type=\"hidden\" name=\"submit_check\" value=\"1\" />
				<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Login\" /></td></tr>
				<tr><td colspan=\"2\" align=\"center\"><input type=\"reset\" /></td></tr>
			</table>
		</form>
	</div>
</body>
</html>";
?>
