<?php
/**
 * @param $class_name
 */
function my_autoloader($class_name) {
    switch ($class_name[0]) {
        case 'F':
            require ('Foundation/'.$class_name.'.php');
            break;
        case 'E':
            require ('Entity/'.$class_name.'.php');
            break;
        case 'V':
            require ('View/'.$class_name.'.php');
            break;
        case 'C':
            require ('Control/'.$class_name.'.php');
            break;
        default :
            if (file_exists( './inc/'. $class_name . '.php'))include_once ('/inc/'. $class_name . '.php');
            elseif (file_exists( './'. $class_name . '.php'))include_once ('/'. $class_name . '.php');
            elseif (file_exists( '../inc/css/'. $class_name . '.php'))include_once ('../inc/css/'. $class_name . '.php');
            break;
    }

}

spl_autoload_register("my_autoloader");