<?php
      require_once(__DIR__ .'/../vendor/autoload.php');
      // INCLUDE DB CONFIG
      $dbconfig = __DIR__."/config.php";
      include ($dbconfig);
      // INCLUDED DB CONFIG


      \Reportico\Engine\Builder::build()
          ->properties(["url_path_to_assets" => "../assets"])
          ->properties(["url_path_to_templates" => "../themes"])
          ->datasource()->database("mysql:host=localhost; dbname=reportico")->user($examples_user)->password($examples_password)
          ->title     ("Product Stock")
          ->description     ("Produces a list of our products")
          ->sql       ("
              SELECT  ProductID id, ProductName product, UnitsInStock in_stock, UnitsOnOrder on_order, companyname company, country, categoryname category
              FROM northwind_products 
              join northwind_suppliers on northwind_products.supplierid = northwind_suppliers.supplierid
              join northwind_categories on northwind_products.categoryid = northwind_categories.categoryid
              WHERE 1 = 1  
              ORDER BY categoryname
                 ")
          ->column("id")->columnwidthpdf("1cm")
          ->column("product")->columnwidthpdf("6cm")
          ->column("company")->columnwidthpdf("6cm")
          ->group("category")
              //->header("category")
              ->throwPageBefore()
              ->customHeader( "Stock Levels for category: {category}", "height: 10; margin: 25px 0 0 0; text-align: center; border-style: solid; border-color: #00f; border-width: 2px"  )
              ->customTrailer( "Custom Trailer - End of Group {category} ", "height: 10; margin: 25px 0 0 0; text-align: center; border-style: solid; border-color: #00f; border-width: 2px"  )
          ->page()
            //->paginate()
            //->pagetitledisplay("Off")
            ->orientation("landscape")
            ->topMargin(1)
            //->leftMargin(5)
            ->bottomMargin(5)
            //->rightMargin(5)
            ->header("{REPORT_TITLE}", "border-width: 0px 0px 1px 0px; margin: 25px 0px 0px 0px; border-color: #000000; font-size: 18; border-style: solid;padding:0px 0px 0px 0px; background-color: #000; color: #fff; width: 20cm; margin-left: 6cm;margin-bottom: 70px;text-align:center")
            ->header( "", "height: 50; margin: 5px 0 0 0; background-image:".__DIR__."/../assets/images/reportico100.png"  )
            ->footer( 'Page: {PAGE} of {PAGETOTAL}', 'border-width: 1 0 0 0; top: 0px; font-size: 8pt; margin: 2px 0px 0px 0px; font-style: italic; margin-top: 30px;'  )
            ->footer( 'Time: date(\'Y-m-d H:i:s\')', 'font-size: 8pt; text-align: right; font-style: italic; margin-top: 30px;'  )
            ->pdfengine("tcpdf")
            ->pdfDownloadMethod("inline")
            ->to( "PDF" )
          ->execute();
?>
