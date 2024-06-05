<?php /*
+-------------------------------------------------------+
| Rajarshi Das						                    |
+-------------------------------------------------------+
| Created On:   29-Jan-2024                             |
| Updated On:                                           |
+-------------------------------------------------------+
*/

namespace BadDragon;

use BadDragon\Controller;

class Router extends Controller
{
    public $a;
    public $uri;
    public $module;
    public $controller;
    public $method;
    public $parts;

    public function __construct()
    {
        if (isset($_POST["a"])) {

            // POST Method
            $this->a = $_POST["a"];

            // Parse Module | Controller | Method for this request
            $this->autoroute('-');
        } else {

            // REQUEST URI (GET Requests)
            //$r = $_SERVER["REQUEST_URI"];
            # die($r);
            //$uri = explode("?", $r);
            $uri = $_SERVER["REQUEST_URI"];
            // die($uri);

            $this->a = $uri;

            // Parse Module | Controller | Method for this request
            $this->autoroute('/');
        }

        // Read Routes defination
        require_once BD . '/Routes.php';

        // Find this route
        // todo
    }

    private function autoroute($delimiter)
    {

        /* Auto routing */
        $parts = explode($delimiter, $this->a);
        $this->parts = $parts;
        // var_dump($parts); die;

        if (isset($parts)) {

            if (count($parts) > 3) {
                $this->module       = ucfirst($parts[1]);
                $this->controller   = ucfirst($parts[2]);
                $this->method       = $parts[3];
            } else {
                header("Location:" . BASE_URL . "studio/home.cgi");
                die;
                //die("Incomplete routing info...");
            }
        } else {
            die("404 - Routing info missing...");
        }
    }
}
