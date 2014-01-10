<?php
// PsychStudioXpress provides tools to behavioral and social science researchers.
// Copyright (C) 2013 William Kelly Hudgins
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

// vCCS
// Version 1.0
// generateDatabase.php
// This file allows users to initialize the database and create
// their initial user. 
// NOTE: It is recommended that this file is deleted after use

include 'conf.php';

if (isset($_POST['submit']))
{
	$username = clean($_POST['username']);
	$password = crypto($_POST['password']);
	$name = clean($_POST['name']);
	mysql_query("SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO'")or die(mysql_error());
	mysql_query("create database vccs")or die(mysql_error());
	mysql_select_db("vccs");
	mysql_query("CREATE TABLE IF NOT EXISTS `correct_checks` (
  `image_number` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `payor` varchar(255) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `routing` int(11) NOT NULL,
  `account_num` int(11) NOT NULL,
  `check_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysql_query("INSERT INTO `correct_checks` (`image_number`, `date`, `payor`, `payee`, `amount`, `routing`, `account_num`, `check_num`) VALUES
(1, '3/11/2012', 'Mandy Cook', 'Leslie Harris', 305.55, 307644704, 5282247, 4635),
(2, '3/19/2012', 'Max Clark', 'Johanna Montgomery', 599.91, 673534475, 6024875, 5882),
(3, '3/2/2012', 'Nicholas Saunders', 'Tina Garner', 316.9, 375510096, 8372739, 1902),
(4, '3/12/2012', 'Katrina Henry', 'Leticia Webb', 909.74, 986897598, 2683234, 4208),
(5, '3/9/2012', 'Bessie Pearson', 'Deanna Bennett', 13.65, 248587047, 7938436, 4197),
(6, '3/10/2012', 'Wanda Lynch', 'Phillip Mendoza', 490.82, 923317673, 4910569, 4874),
(7, '3/24/2012', 'Ernestine Fowler', 'Julia Ward', 84.97, 317350396, 3710576, 3559),
(8, '3/6/2012', 'Ruby Horton', 'Edgar Blair', 724.87, 788476260, 3761424, 3407),
(9, '3/3/2012', 'Erin Guerrero', 'Joe Cook', 287.52, 272952119, 3602626, 2678),
(10, '3/8/2012', 'Rudolph Young', 'Orlando Rios', 461.11, 257924854, 7638852, 8453),
(11, '3/30/2012', 'Susie Armstrong', 'Darlene Lambert', 525.05, 621099043, 6554192, 9526),
(12, '3/12/2012', 'Lydia Howard', 'Rachael Walker', 149.92, 578450252, 2254837, 1861),
(13, '3/9/2012', 'Jenny Myers', 'Walter Barber', 763.08, 153038459, 7954509, 1369),
(14, '3/8/2012', 'Carl Black', 'Helen Brooks', 648.28, 158750796, 7260196, 9307),
(15, '3/9/2012', 'Maryann Woods', 'Violet Mills', 373.24, 287581592, 8557873, 3412),
(16, '3/30/2012', 'Glen Curry', 'Lori Barnett', 812.1, 723651473, 5250942, 6357),
(17, '3/16/2012', 'Antonio Fitzgerald', 'Norman Jones', 618.24, 807448658, 8906959, 4917),
(18, '3/31/2012', 'Edith Holt', 'Lee Burgess', 491.4, 223968511, 2547711, 2098),
(19, '3/22/2012', 'Ervin Patterson', 'Willie Graham', 247.69, 352919574, 9315000, 5526),
(20, '3/16/2012', 'Milton Francis', 'Alma Knight', 499.96, 659888528, 1545287, 7675),
(21, '3/18/2012', 'Jim Romero', 'Emmett Berry', 830.52, 390457717, 5502831, 7852),
(22, '3/12/2012', 'Clinton Reynold', 'Wilma Martin', 471.33, 195787710, 5982591, 6490),
(23, '3/19/2012', 'Walter Briggs', 'Gretchen Thorton', 872.86, 451303214, 4589077, 9177),
(24, '3/5/2012', 'Justin Benson', 'Homer Holt', 447.39, 974495530, 5546998, 6404),
(25, '3/19/2012', 'Philip Daniel', 'Gwen Conner', 856.21, 296222021, 3971076, 1201)");

mysql_query("CREATE TABLE IF NOT EXISTS `unverified_checks` (
  `image_number` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `payor` varchar(255) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `routing` int(11) NOT NULL,
  `account_num` int(11) NOT NULL,
  `check_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysql_query("INSERT INTO `unverified_checks` (`image_number`, `date`, `payor`, `payee`, `amount`, `routing`, `account_num`, `check_num`) VALUES
(1, '3/11/2012', 'Mandy oCok', 'Leslie Harris', 305.55, 307644704, 5822247, 4635),
(2, '9/19/02102', 'Max Clark', 'Johanna Montgomery', 5199.9, 673534475, 6024875, 5882),
(3, '9/1/2021', 'Nicholas Saunders', 'Tina Garner', 316.9, 375510096, 8372739, 1902),
(4, '3/12/2012', 'Katrina Henry', 'Leticia Webb', 909.74, 986897598, 2638234, 4280),
(5, '3/9/2012', 'Bessie Pearson', 'Deanna Bennett', 31.65, 248578047, 7938436, 7941),
(6, '3/10/2012', 'Wanad yLnch', 'Phillip Mendoza', 490.82, 923317673, 4910569, 4874),
(7, '3/24/2012', 'Ernestine Fowler', 'Julia Ward', 84.97, 1337106359, 3710576, 9553),
(8, '3/6/2012', 'Ruby Horton', 'Edgar Blair', 0.28774, 788476260, 3761442, 3407),
(9, '3/3/2012', 'Erin Guerrero', 'Joe Cooko', 287.52, 272952119, 3602626, 2678),
(10, '3/8/2012', 'Rudolph Young', 'Orlando Rios', 461.11, 257924854, 7638852, 8453),
(11, '7/44/1220', 'Susie Armstrong', 'Darlene Lambert', 525.05, 621099043, 6559142, 9562),
(12, '3/12/2012', 'Lydia Howard', 'Rachael Walker', 149.92, 578450252, 2254837, 1861),
(13, '3/9/2012', 'Jenny Myers', 'Walter Barber', 76.308, 153038459, 7954509, 1369),
(14, '2/33/2012', 'Carl Black', 'Helen Brooks', 648.28, 158570796, 7260196, 9307),
(15, '3/9/2012', 'Maryann Woods', 'Violet Mills', 37.432, 287581592, 8358775, 3412),
(16, '5/52/2102', 'Glen Curry', 'Lori Barnett', 812.1, 723651473, 5250942, 6456),
(17, '3/16/2012', 'Antonio Fitzgerald', 'Norman Jnoes', 618.24, 87448658, 8960599, 4917),
(18, '3/11/2012', 'Edith Holt', 'Lee Burgess', 491.4, 223968511, 2547711, 2098),
(19, '3/22/2012', 'Ervin Patterson', 'Willi eGraham', 247.69, 352919574, 9315000, 5526),
(20, '3/16/2012', 'cMlnrniioFts a', 'Alma Knight', 499.69, 659888528, 1545287, 7675),
(21, '3/81/2021', 'Jim Romero', 'Emmett Berry', 830.52, 390457717, 5502831, 7852),
(22, '3/12/2012', 'Clinton Reynold', 'Wilma Martin', 471.33, 195787710, 5982591, 6490),
(23, '3/19/2012', 'Walter Briggs', 'Gretchen Thorton', 2867.8, 451303214, 4589077, 9177),
(24, '8/9/0212', 'Justin Benson', 'Home rHolt', 447.39, 974495530, 55496998, 6404),
(25, '3/19/2012', 'Philip Daniel', 'Gwen Conner', 856.21, 296222021, 3971076, 1201)");

mysql_query("CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4");

mysql_query("CREATE TABLE IF NOT EXISTS `verified_checks` (
  `condition` int(11) NOT NULL,
  `participant_ID` varchar(255) NOT NULL,
  `image_number` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `payor` varchar(255) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `routing` int(11) NOT NULL,
  `account_num` int(11) NOT NULL,
  `check_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


mysql_query("INSERT INTO `users` (`username`, `password`, `name`) VALUES ('$username', '$password', '$name')")or die(mysql_error());

echo "
		<head>
			<title>vCCS Installation Assistant</title>
		</head>
		
		<body>
			<center>
				<h3>vCCS Installation Assistant</h3>
				<h4>Database Generator</h4>
			</center>
			
			<p>Congradulations, vCCS is now ready to use with the default
				check set.</p>
		</body>
	</html>";

}

else
{
echo "<html>
		<head>
			<title>vCSS Installation Assistant</title>
		</head>
		
		<body>
			<center>
				<h3>vCCS Installation Assistant</h3>
				<h4>Database Generator</h4>
			</center>
			
			<p>Please specify a vCCS user account.</p>
			<form name=\"userCreation\" method=\"post\">
				<table>
					<tr>
						<td>Username:</td><td><input type=\"text\" name=\"username\" /></td>
					</tr>
					<tr>
						<td>Password:</td><td><input type=\"password\" name=\"password\" /></td>
					</tr>
					<tr>
						<td>Name:</td><td><input type=\"text\" name=\"name\" /></td>
					</tr>
					<tr>
						<td colspan=\"2\"><input type=\"submit\" name=\"submit\" value=\"Generate Database\" />
				</table>
			</form>
		</body>
	</html>";
}
