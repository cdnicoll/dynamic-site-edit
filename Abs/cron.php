<?php

include("lib/Cron.php");

// Do a files backup
//fileBackup("myemail@sitebase.be"); 

// Create database backup from cdcol and sb_base databases
//databaseBackup(array("database1", "database2"), "myemail@sitebase.be");

// Rollback database
//databaseRollback(array("sb-base_20100218_2118.sql"));

// Rollback file
//fileRollback("image_20100218_2136.zip");