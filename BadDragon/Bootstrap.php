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
require_once BD . "/Config.php";

// Common Functions
require_once BD . "/Common.php";

// Autoload
if (!defined('BADDRAGON')) {
    require_once BD . '/Autoload.php';
}

// Invoke BadDragon
use BadDragon\Controller;
use BadDragon\Router;
//die("Bd");

$dragon = new Controller;
$route = new Router;
// var_dump($route); die;

// Request controllers
$cn = $dragon->fire($route);

// Load Controllers
for ($i = 0; $i < count($cn); $i++) {
    # echo "Loaded: ".$cn[$i]."<br>";
    require_once $cn[$i];
}
