<?php

      require_once(__DIR__ .'/../vendor/autoload.php');
      // INCLUDE DB CONFIG
      $dbconfig = __DIR__."/config.php";
      include ($dbconfig);
      // INCLUDED DB CONFIG

      \Reportico\Engine\Builder::build()
          ->properties([ "bootstrap_preloaded" => true])
          ->properties(["admin_projects_folder" =>  __DIR__."/../projects"])
          ->properties(["projects_folder" =>  __DIR__."/../projects"])
          ->datasource()->database("mysql:host=$examples_host; dbname=$examples_database")->user($examples_user)->password("$examples_password")
          ->project("tutorials")
          ->title     ("Employee List")
          ->description     ("Produces a list of our employees")
          ->sql       ("
			    SELECT EmployeeID employee_id, LastName last_name, FirstName first_name, date(BirthDate) birth_date, Country as country
                FROM northwind_employees
                WHERE 1 = 1
                ORDER BY Country, LastName
			    ")

          ->expression("country")
              ->set("{country}")
              ->drilldownToUrl("example.drilldown-sub-report.php")->where(["country" => "country"])
              //->drilldownToReport("tutorials", "stock")->where(["country" => "country"])
		  ->execute();
?>
