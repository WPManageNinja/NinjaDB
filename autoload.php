<?php

spl_autoload_register(function ($class) {
    $prefix = 'NinjaDB\\';
    if (0 !== strpos($class, $prefix)) {
        return;
    }

    $file = __DIR__
        .DIRECTORY_SEPARATOR
        .'src'
        .DIRECTORY_SEPARATOR
        .str_replace('\\', DIRECTORY_SEPARATOR, substr($class, strlen($prefix)))
        .'.php';
    if (!is_readable($file)) {
        return;
    }

    require $file;
});
// make available ninjaDB as global scope
if(!function_exists('ninjaDB')) {
	function ninjaDB($table = false) {
		return new NinjaDB\BaseModel($table);
	}
}
