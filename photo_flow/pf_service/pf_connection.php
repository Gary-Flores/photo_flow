<?php
/* 
 * Contain the access to database.
 */

$connect = mysql_connect("localhost","root","") or die("Unable to Connect");
mysql_select_db("photo_flow") or die("Could not open the db");
@mysql_query("SET NAMES 'utf8'");
