<?php /*
+-------------------------------------------------------+
| System Common Functions                               |
+-------------------------------------------------------+
*/
function show404($m){
    
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

