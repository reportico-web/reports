<?php
      require_once(__DIR__ .'/../vendor/autoload.php');
      // INCLUDE DB CONFIG
      $dbconfig = __DIR__."/config.php";
      include ($dbconfig);
      // INCLUDED DB CONFIG

      \Reportico\Engine\Builder::build()
          ->properties([ "bootstrap_preloaded" => true])
          ->datasource()->database("mysql:host=$examples_host; dbname=$examples_database")->user($examples_user)->password("$examples_password")
          ->title     ("Product Stock")
          ->description     ("Produces a list of our products")
          ->sql       ("
              SELECT  ProductID id, ProductName product, UnitsInStock in_stock, UnitsOnOrder on_order, companyname Company, country, categoryname category
              FROM northwind_products 
              join northwind_suppliers on northwind_products.supplierid = northwind_suppliers.supplierid
              join northwind_categories on northwind_products.categoryid = northwind_categories.categoryid
              WHERE 1 = 1  
              ORDER BY categoryname
                ")
          ->group("category")
              ->header("category")
              ->throwPageBefore()
          ->to( "CSV" )
          ->execute();
?>
