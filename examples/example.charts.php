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
          ->description     ("Produces a list and charts of stock levels")
          ->sql       ("
              SELECT  ProductID id, ProductName product, UnitsInStock in_stock, ReorderLevel reorder_level, companyname Company, country, categoryname category
              FROM northwind_products 
              join northwind_suppliers on northwind_products.supplierid = northwind_suppliers.supplierid
              join northwind_categories on northwind_products.categoryid = northwind_categories.categoryid
              WHERE 1 = 1  
              ORDER BY categoryname
                ")
          ->group("category")
              ->header("category")
              ->throwPageBefore()
          ->chart("category")
              ->title("Stock Levels")
              ->plot("in_stock")->plotType("bar")->legend("In stock")
              ->plot("reorder_level")->plotType("line")->legend("Reorder Level")
              ->xlabels("product")
              ->xtitle("Levels")
              ->ytitle("Products")
          ->prepare();
?>
