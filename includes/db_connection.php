<?php

	// Database Constants
	defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
	// defined('DB_USER')   ? null : define("DB_USER", "vedis");
	defined('DB_USER')   ? null : define("DB_USER", "root");
	// defined('DB_PASS')   ? null : define("DB_PASS", "dis04ve05");
	defined('DB_PASS')   ? null : define("DB_PASS", "");
	defined('DB_NAME')   ? null : define("DB_NAME", "taskmaster");

    // 1. Create a database connection
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // Test if connection succeeded
    if(mysqli_connect_errno()) {
         die("Database connection failed: " . 
                mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>