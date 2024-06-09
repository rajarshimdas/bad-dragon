<?php /*
+-------------------------------------------------------+
| System Common Functions                               |
+-------------------------------------------------------+
*/

// use BadDragon\Router;

function view($route, $page)
{
    // var_dump($route);

    $p = W3APP . "/View/" . $route->module . "/" . $route->controller . "/" . $page . ".php";
    // echo $p;

    if (file_exists($p)) {
        require_once $p;
    } elseif (ENV == "dev") {
        die("View not found: " . $p);
    } else {
        show404("Page not found");
        return false;
    }

    return true;
}

function show404($m)
{

    die($m);
}

function alpha_numeric_dash_slash($str)
{
    return (bool) preg_match('/^[a-z0-9-//]+$/i', $str);
}

function bdGo2uri(string $uri): bool
{
    header("Location:?$uri");
    die;

    return true;
}
