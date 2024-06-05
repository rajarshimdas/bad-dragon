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
            
            /* Auto routing */
            $p = explode("-", $this->a);
            $this->parts = [
                ((isset($p[0]) ? $p[0] : 'x')),
                ((isset($p[1]) ? $p[1] : 'x')),
                ((isset($p[2]) ? $p[2] : 'x')),
            ];

            // Parse Module | Controller | Method for this request
            $this->autoroute();
        } else {

            // REQUEST URI (GET Requests)
            //$r = $_SERVER["REQUEST_URI"];
            # die($r);
            //$uri = explode("?", $r);
            $uri = $_SERVER["REQUEST_URI"];
            // die($uri);

            $this->a = $uri;
            $this->uri = $uri;


            /* Auto routing */
            $p = explode("/", $this->a);
            $this->parts = [
                ((isset($p[1]) ? $p[1] : 'x')),
                ((isset($p[2]) ? $p[2] : 'x')),
                ((isset($p[3]) ? $p[3] : 'x')),
            ];

            // Parse Module | Controller | Method for this request
            $this->autoroute();
        }

        // Read Routes defination
        require_once BD . '/Routes.php';

        // Find this route
        // todo
    }

    private function autoroute()
    {
        $parts = $this->parts;
        // var_dump($parts); die;

        if (isset($parts)) {

            if (count($parts) > 2) {
                $this->module       = ucfirst($parts[0]);
                $this->controller   = ucfirst($parts[1]);
                $this->method       = $parts[2];
            } else {
                header("Location:" . BASE_URL . "/home");
                die;
                //die("Incomplete routing info...");
            }
        } else {
            die("404 - Routing info missing...");
        }
    }
}
