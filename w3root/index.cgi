<?php /* Front Controller
+-------------------------------------------------------+
| Rajarshi Das						                    |
+-------------------------------------------------------+
| Created On:   29-Jan-2024                             |
| Updated On:                                           |
+-------------------------------------------------------+
*/

// Bootstrap
require_once $_SERVER["DOCUMENT_ROOT"] . '/paths.cgi';

// Invoke BadDragon
require_once BD.'/Bootstrap.php';

// Clean up
if (isset($mysqli)) $mysqli->close();

// All done. Die in peace...
die();
