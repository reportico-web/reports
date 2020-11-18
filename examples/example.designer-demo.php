<?php

      require_once(__DIR__ .'/../vendor/autoload.php');
      // INCLUDE DB CONFIG
      $dbconfig = __DIR__."/config.php";
      include ($dbconfig);
      // INCLUDED DB CONFIG

      \Reportico\Engine\Builder::build()
          ->properties(["projects_folder" =>  __DIR__."/../projects"])
          ->accessLevel("demo")
          ->project("tutorials")
          ->menu();
?>
