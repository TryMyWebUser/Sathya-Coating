<?php

// This is class file autoloaded
spl_autoload_register(function ($class) {
    require_once $class . ".class.php";
});

// Prevent browser caching
<<<<<<< HEAD
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
=======
// header("Cache-Control: no-cache, must-revalidate");
// header("Pragma: no-cache");
>>>>>>> developer

?>