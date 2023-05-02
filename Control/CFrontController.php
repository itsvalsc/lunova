<?php

/**
 *
 */

require_once 'StartSmarty.php';

class CFrontController
{
    public function run($path){
        $resource = explode('/',$path);

        array_shift($resource);
        array_shift($resource);


        if($resource[0] != ''){
            $controller = "C" . $resource[0];
            $dir = 'Control';
            $element = scandir($dir);

            if(in_array($controller . ".php", $element)){
                if(isset($resource[1])){
                    $function = $resource[1];
                    if(method_exists($controller,$function)){
                        $param = array();
                        for ($i = 2; $i<count($resource);$i++){
                            array_push($param,$resource[$i]);
                        }
                        $num = count($param);
                        if ($num == 0) $controller::$function();
                        else if ($num == 1) $controller::$function($param[0]);
                        else if ($num == 2) $controller::$function($param[0], $param[1]);
                    }
                    else{
                        return header("Location: /lunova");
                    }
                }
            }else{
                return header("Location: /lunova");
            }

        }else{
            $controller = "CRicercaDisco";
            $function = "index";
            $controller::$function();
        }

    }
}