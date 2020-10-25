<?php
/*
 * File:        start.php
 *
 * Reportico runner script
 *
 * @link http://www.reportico.org/
 * @copyright 2010-2014 Peter Deed
 * @author Peter Deed <info@reportico.org>
 * @package Reportico
 * @version $Id: run.php,v 1.25 2014/05/17 15:12:31 peter Exp $
 */
require_once(__DIR__ .'/vendor/autoload.php');

// set error reporting level
error_reporting(E_ALL);

// Turn on logging ot browser console
//Reportico\Engine\ReporticoLog::activeDebugMode();
    
// Set the timezone according to system defaults
date_default_timezone_set(@date_default_timezone_get());

// Reserver 100Mb for running
ini_set("memory_limit","100M");

// Allow a good time for long reports to run. Set to 0 to allow unlimited time
ini_set("max_execution_time","90");

// Only turn on output buffering if necessary, normally leave this commented
//ob_start();
    
// Instantiate Reportico
$reportico = new Reportico\Engine\Reportico();

// Force reset of session handling, so you always start from scratch
$reportico->clear_reportico_session = true;

// In design mode, allow sql debugging
//$reportico->allow_debug = true;

// Specify any URL parameters that should be added into any links generated in Reportico.
// Useful when embedding in another application or frameworks where requests need to be channelled
// back though themselves
//$reportico->forward_url_get_parameters = "";

// Reportico Ajax mode. If set to true will run all reportico requests from buttons and links
// through AJAX, meaning reportico will refresh in its own window and not refresh the whole page
//$reportico->reportico_ajax_mode = "standalone";

/*
** Initial execution states .. allows you to start user and limit user to specfic
** report menus, reports or report output
** The default behaviour is to show the Administration page on initial startup
*/

// Start user in specific project
//$reportico->initial_project = "<project>";          

// If starting user in specific project then project passweord is required if one exists
// and you dont want user to have to type it in
//$reportico->initial_project_password = "<project password>";

// Specify a report to start user in specify the xml report file in the specified project folder
//$reportico->initial_report = "reportfile.xml";

// Specify whether user is started in administration page, project menu, report criteria entry, 
// report output or report design mode, use respectively ( "ADMIN", "MENU", "PREPARE", "EXECUTE", "MAINTAIN")
// default is "ADMIN"
//$reportico->initial_execute_mode = "ADMIN";

// Specify the class responsible for authenticating access to Reportico
//$reportico->authenticator = "\Reportico\Engine\StandaloneAuthenticator";

// Specify a role to go straight in with ( roles are specified in the relevant Authenticator class )
//$reportico->initial_role = "design-fiddle";

// When only executing a report, indicates what format it should be showed in .. HTML(the default), PDF or CSV
//$reportico->initial_output_format = "HTML";

// When initial mode is report criteria entry or execution, these set the flags for whether report detail, group hears, columns headers
// etc are to be show. For example you might only want to run a report and show the graphs, by default all show except criteria
//$reportico->initial_show_detail = "show";
//$reportico->initial_show_graph = "show";
//$reportico->initial_show_group_headers = "show";
//$reportico->initial_show_group_trailers = "show";
//$reportico->initial_show_column_headers = "show";
//$reportico->initial_show_criteria = "show";

// Set source SQL to generate report from, without requirement for report , requires an initial_project to be defined for connection details
//$reportico->initial_sql = "SELECT column1 AS columntitle1, column2 AS columntitle2 FROM table";

// Set Report Title  when running reort from an SQL statement above
// $reportico->setAttribute("ReportTitle", "Report Title");

// Specify access mode to limit what user can do, one of :-
// FULL - the default, allows user to log in under admin/design mode and design reports
// ALLPROJECTS - allows entry to admin page to select project  but no ability to logon in admin/designer mode
// ONEPROJECT - allows entry to a single project and no access to the admin page
// ONEREPORT - limits user to single report, crtieria entry and report execution ( requires initial project/report )
// REPORTOUTPUT - executes a report and allows to "Return" button to crtieria entry ( requires initial project/report )
//$reportico->access_mode = "<MODE>";
$reportico->access_mode = "ALLPROJECTS";

//
// Default initial execute mode to single report output if REPORTOUTPUT mode specified
if ( $reportico->access_mode == "REPORTOUTPUT" )
    $reportico->initial_execute_mode = "EXECUTE";

// Generate report definition from SQL  and set some column / report attributes
// Also the full report definition can be built up programmatically
// which requires further doicumentation
//$reportico->importSQL("SELECT column1 AS columntitle1, column2 AS columntitle2 FROM table");
//$reportico->get_column("column1")->setAttribute("column_display","hide");
//$reportico->get_column("column1")->setAttribute("column_title","Custom Title");
//$reportico->setAttribute("ReportTitle","New Report Title");

// Provide an existing connection to Reportico, at the moment to use this there still needs to be project
// in existence, but the connection specified here will override the 
// this allows you build create temporary tables and perform other actions prior to reporting
// $reportico->external_connection = false;
// try 
// {
            // $reportico->external_connection = new PDO("mysql:host=localhost; dbname=dbname", "username", "password" );
// }
// catch ( PDOException $ex )
// {
            // $reportico->external_connection = false;
            // // Handle Error
// }

// Specify alternate path to projects folder, templates_c folder
$reportico->projects_folder = __DIR__."/projects";
$reportico->admin_projects_folder = __DIR__."/projects";
//$reportico->compiled_templates_folder = "templates_c";
    
// For setting report criteria parameters.. use the criteria name as the key and the criteria value
// $reportico->initial_execution_parameters = array();
// $reportico->initial_execution_parameters["lookupcriteria"] = "value1,value2";
// $reportico->initial_execution_parameters["datecriteria"] = "2014-07-01";
// $reportico->initial_execution_parameters["datecriteria2"] = "TODAY";
// $reportico->initial_execution_parameters["daterangecriteria1"] = "2014-01-01-2014-02-01";
// $reportico->initial_execution_parameters["daterangecriteria2"] = "FIRSTOFMONTH-LASTOFMONTH";

// The session namespace to use. Only relevant when showing more than one report in a single page. Specify a name
// to store all session variables for this instance and then when running another report instance later in the script 
// use another name
//$reportico->session_namespace = "reportico";

// Current user - when embedding reportico, you may wish to run queries by user. In this case
// set the current user here. Then you can use the construct {FRAMEWORK_USER} within your queries
//$reportico->external_user = "<CURRENT USER>";

// Indicates whether report output should include a refresh button
//$reportico->show_refresh_button = false;

// Set to true if you are embedding in another report
//$reportico->embedded_report = false;

// Specify an alternative AJAX runner from the stanfdard run.php
$reportico->reportico_ajax_script_url = dirname($_SERVER["SCRIPT_NAME"])."/run.php";

// If you want to connect to a reporting database whose connection information is available in the calling
// script, then you should configure your project connection type to "framework" using the configure project link
//and then you can pass your connection info here
//define('SW_FRAMEWORK_DB_DRIVER','pdo_mysql');
//define('SW_FRAMEWORK_DB_USER', '<USER>');
//define('SW_FRAMEWORK_DB_PASSWORD','PASSWORD');
//define('SW_FRAMEWORK_DB_HOST', '127.0.0.1'); // Use ip:port to specifiy a non standard port
//define('SW_FRAMEWORK_DB_DATABASE', '<DATABASENAME>');

// For passing external user parameters, can be referenced in SQL with {USER_PARAM,parameter_name}
// and can be referenced in custom SQL with $this->user_parameters
//$reportico->user_parameters["your_parameter_name"] = "your parameter value";

// To pass an array to be used as a criteria selection list use the "values" option
// Define for the example below a criteria of type Custom List and set the List Values to {USER_PARAM,mylist}
// Then use the criteria in the main SQL like table.column in ( {mylist} )
//$reportico->user_parameters["mylist"] = [ "values" => [ "a" => "b", "c" => "d"] ];

// To pass a function which can generate a criteria selection list
// Define an anonymous function to return a keyed array ( the value is the lookup display and the key is the 
// value passed into the main query, in the example below define a criteria of type Custom List and set the List Values to {USER_PARAM,myfunction}
//$reportico->user_parameters["myfunction"] = [ "function" => "myfunc" ];
//$reportico->user_functions = [ "myfunc" => function() { return [ "a" => "b", "c" => "d"]; } ];

// Jquery already included?
//$reportico->jquery_preloaded = false;

// Bootstrap Features
// Set bootstrap_styles to false for reportico classic styles, or "3" for bootstrap 3 look and feel and 2 for bootstrap 2
// If you are embedding reportico and you have already loaded bootstrap then set bootstrap_preloaded equals true so reportico
// doestnt load it again.
//$reportico->bootstrap_styles = "3";
//$reportico->bootstrap_preloaded = false;

// In bootstrap enable pages, the bootstrap modal is by default used for the quick edit buttons
// but they can be ignored and reportico's own modal invoked by setting this to true
//$reportico->force_reportico_mini_maintains = false;

// Engine to use for charts .. 
// HTML reports can use javascript charting, PDF reports must use PCHART
//$reportico->charting_engine = "PCHART";
//$reportico->charting_engine_html = "NVD3";

// Whether to turn on dynamic grids to provide searchable/sortable reports
// $reportico->dynamic_grids = true;
// $reportico->dynamic_grids_sortable = true;
// $reportico->dynamic_grids_searchable = true;
// $reportico->dynamic_grids_paging = false;
// $reportico->dynamic_grids_page_size = 10;

// Show or hide various report elements
//$reportico->output_template_parameters["show_hide_navigation_menu"] = "show";
//$reportico->output_template_parameters["show_hide_dropdown_menu"] = "show";
//$reportico->output_template_parameters["show_hide_report_output_title"] = "show";
//$reportico->output_template_parameters["show_hide_prepare_section_boxes"] = "hide";
//$reportico->output_template_parameters["show_hide_prepare_pdf_button"] = "show";
//$reportico->output_template_parameters["show_hide_prepare_html_button"] = "show";
//$reportico->output_template_parameters["show_hide_prepare_print_html_button"] = "show";
//$reportico->output_template_parameters["show_hide_prepare_csv_button"] = "show";
//$reportico->output_template_parameters["show_hide_prepare_page_style"] = "show";
$reportico->output_template_parameters["show_hide_prepare_go_buttons"] = "show";
//$reportico->output_template_parameters["show_hide_prepare_reset_buttons"] = "hide";

// Set a theme
// ======================
// Use the specified folder under the themes folder to identify which templates, stylesheets and js to use for the instance
//$reportico->theme = "default";
$reportico->theme = "bootstrap4";
//$reportico->url_path_to_templates = "themes";

// Set this to true to allow changes to edits to theme templates to be reflected immediately, otherwise
// you will need to clear out the themes/cache folder to register any changes
//$reportico->disableThemeCaching = true;


// Label for criteria section if required
// $reportico->criteria_block_label = "Report Criteria:";

// Static Menu definition
// ======================
// identifies the items that will show in the middle of the project menu page.
// If not set will use the project level menu definitions in project/projectname/menu.php
// To have no static menu ( for example if you just want to use a drop down then set to empty array )
// To define a static menu, follow the example here.
// report can be a valid report file ( without the xml suffix ).
// If title is left as AUTO then the title will be taken form the report definition
// Use title of BLANKLINE to separate items and LINE to draw a horizontal line separator

//$reportico->static_menu = array (
        //array ( "report" => "an_xml_reportfile1", "title" => "<AUTO>" ),
        //array ( "report" => "another_reportfile", "title" => "<AUTO>" ),
        //array ( "report" => "", "title" => "BLANKLINE" ),
        //array ( "report" => "anotherfreportfile", "title" => "Custom Title" ),
        //array ( "report" => "", "title" => "BLANKLINE" ),
        //array ( "report" => "andanother", "title" => "Another Custom Title" ),
//);

// To auto generate a static menu from all the xml report files in the project use
//$reportico->static_menu = array ( array ( "report" => ".*\.xml", "title" => "<AUTO>" ) );
    
// To hide the static report menu
//$reportico->static_menu = array ();

// Required PDF Engine set -- to phantomjs, chromium or tcpdf
//$reportico->pdf_engine = "tcpdf";
$reportico->pdf_engine = "chromium";

// Path to Phantom js executable relative to root
//$reportico->pdf_phantomjs_path = "bin/phantomjs";

// How CSV, PDF out is delivered to the browser
// either as
// "DOWNLOAD_SAME_WINDOW" - downloaded as attachment from within the current browser window ( default )
// "INLINE" - shown inside a new  browser window making use of any existing browser PDF plugin (if not will download)
// "DOWNLOAD_NEW_WINDOW" - downloaded as attachment from winthin the current browser window
//$reportico->pdf_delivery_mode = "DOWNLOAD_SAME_WINDOW";

// Dropdown Menu definition
// ========================
// Menu items for the drop down menu
// Enter definition for the the dropdown menu options across the top of the page
// Each array element represents a dropdown menu across the page and sub array items for each drop down
// You must specifiy a project folder for each project entry and the reportfile definitions must point to a valid xml report file
// within the specified project
//$reportico->dropdown_menu = array(
//                array ( 
//                    "project" => "projectname",
//                    "title" => "dropdown menu 1 title",
//                    "items" => array (
//                        array ( "reportfile" => "report" ),
//                        array ( "reportfile" => "anotherreport" ),
//                        )
//                    ),
//                array ( 
//                    "project" => "projectname",
//                    "title" => "dropdown menu 2 title",
//                    "items" => array (
//                        array ( "reportfile" => "report" ),
//                        array ( "reportfile" => "anotherreport" ),
//                        )
//                    ),
//            );


// Setup SESSION
Reportico\Engine\ReporticoSession::setUpReporticoSession($reportico->session_namespace);

// Run the report
$reportico->execute();

//ob_end_flush();

?>
