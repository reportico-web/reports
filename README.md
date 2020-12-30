#Reportico Open Source PHP report Designer

Reportico PHP Reporting Tool. Runs against MySQL, PostgreSQL and other PDO enable databases - 
design reports, create report menus, configure criteria, graphs, grouping, drill-down, output in HTML, PDF, & CSV, expression handling, look and feel through CSS, data transformation.

## Features

- Interactive Report Designer
- Runs Against MySQL, PostreSQL, Informix, Oracle, SQL Server, SQLite
- Produce Criteria Entry Screens
- Output in HTML, PDF, CSV
- Graphs and Database Graphics
- Report Menu generation
- Groups to organize output with headers and trailers
- Expressions and Assignments to manupulate output data prior to reporting
- Inclusion of custom PHP code to allow complex manipulation of data prior to reporting
- Drilldown
- Create reports programatically using the builder framework module

## Install

Reportico is best installed via composer but zip and tarball downloads can also be downloaded

### Install From Zip / Tarball

Zip/Tarball installation bundles are available at

https://github.com/reportico-web/reports/releases

### Install Via Composer

To install the latest stable version use the following composer command under a web folder

composer create-project reportico-web/reports <optional-installation-folder>

This will create a reportico folder with the latest release and with your specified name.

To run your existing report projects against this release, you will need to generate new project and move the xml files in from the old projects. 

to get started see the quickstart guide :-
http://www.reportico.org/yii2/web/index.php/quickstart

or visit the Reportico Web Site
http://www.reportico.org

## Screenshots

![Criteria Page](/assets/images/reportico_prepare.png?raw=true "Criteria Page")


![Edit Query Page](/assets/images/reportico_sql.png?raw=true "Edit Query Page")


![Report Output Page](/assets/images/reportico_output.png?raw=true "Report Output Page")
