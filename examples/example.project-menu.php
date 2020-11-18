<?php

      require_once(__DIR__ .'/../vendor/autoload.php');
      // INCLUDE DB CONFIG
      $dbconfig = __DIR__."/config.php";
      include ($dbconfig);
      // INCLUDED DB CONFIG

      \Reportico\Engine\Builder::build()
          ->properties([ "bootstrap_preloaded" => true])
          ->properties([ "jquery_preloaded" => false])
          ->properties([ "embedded_report" => true])
          ->properties(["projects_folder" =>  __DIR__."/../projects"])
          ->project     ("tutorials")
          ->menu();
?>
