<?php
/**
 * @param $class_name
 */
function myautoload($class_name) {
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
    }

}

spl_autoload_register("myautoload");