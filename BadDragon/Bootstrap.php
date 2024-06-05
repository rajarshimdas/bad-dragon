<?php /* BadDragon 
+-------------------------------------------------------+
| Rajarshi Das						                    |
+-------------------------------------------------------+
| Created On:   29-Jan-2024                             |
| Updated On:                                           |
+-------------------------------------------------------+
*/

require_once W3APP . "/env.php";

// Fetch BadDragon config
// require_once BD . "/Config.php";

// Autoload
if (!defined('BADDRAGON')) {
    require_once BD . '/Autoload.php';
}
//die("Autoload");

// Invoke BadDragon
use BadDragon\Controller;
use BadDragon\Router;
//die("Bd");

$dragon = new Controller;
// die("Cn");
$route = new Router;
var_dump($route);
die;

// Common Functions
require_once BD . "/Common.php";

// Request controllers
$cn = $dragon->fire($route);

// Load Controllers
for ($i = 0; $i < count($cn); $i++) {
    # echo "Loaded: ".$cn[$i]."<br>";
    require_once $cn[$i];
}
