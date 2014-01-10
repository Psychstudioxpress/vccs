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
// conf.php
//
// The Following are the only php variables you need to edit to configure the VCCS script.			   
// This file is loadeed into vccs.php, login.php, and vccs_collection.php.   
$PROJECT_TITLE = "CCU"; // The Title of the Project using check verification                            
$USAGE = "Check Correction System";  // What the application is doing, leave default if unsure         
$BUILD_NO = "Demonstration Prototype"; // Version number of the script, leave default                  
$SERVER = "localhost"; // Location of the MySQL database, leave default if unsure                   
$MYSQL_USER = ""; // MySQL username                                                                
$MYSQL_PASSWORD = ""; // MySQL password                                                                
$MYSQL_DB = "vccs"; // The name of the database storing the check verification data           		   
$BREAK = TRUE; // If you want breaks set to TRUE, if you don't set to FALSE					     	   
$NUM_BEFORE_BREAK = 15; // Number of checks participant should complete before break				   

session_start();

# Make a MySQL Connection
mysql_connect("$SERVER", "$MYSQL_USER", "$MYSQL_PASSWORD") or die(mysql_error());
$database = mysql_select_db("$MYSQL_DB");

# Clean Input Function
function clean($input) 
{
$whattostrp = array("'", ")", "(", "*",">","<");
$input = str_replace($whattostrp, "", "$input");
$input=stripslashes($input);
$input=strip_tags($input);
$input=mysql_real_escape_string($input);
return $input;
}

# Encryption Function
function crypto($input)
{
$salt[0] =  "aBdsajASD243Hasd";
$salt[1] = "aazcdkfs";
$crypt[0] = crc32($input);
$crypt[1] = crypt($input, $salt[0]);
$crypt[2] = md5($input);
$crypt = implode($salt[1], $crypt);
return sha1($input.$crypt);
} 
