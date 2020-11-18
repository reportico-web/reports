<?php
            require_once(__DIR__ .'/../vendor/autoload.php');
            require_once(__DIR__ .'/data_employees.php');
            \Reportico\Engine\Builder::build()
                ->properties([ "bootstrap_preloaded" => true])
            ->datasource()->array( $rows )
            ->title("Employee List")
			->execute();
?>
