<?php

/**
 * Classe utilizzata per il controllo dell'esecuzione delle richieste effettuate al server.
 * @package Controller
 */

require_once 'StartSmarty.php';

class CFrontController
{
    public function run($path){
        $resource = explode('/',$path);

        array_shift($resource);
        array_shift($resource);
        error_reporting(E_ERROR | E_PARSE);



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
                        if ($num == 0){
                            try{
                            $controller::$function();
                            }catch (ArgumentCountError){
                                return header("Location: /lunova/Errore/BadRequest");
                            }catch (TypeError ){
                                return header("Location: /lunova/Errore/redirect");
                            }
                        }
                        else if ($num == 1){
                            try{
                            $controller::$function($param[0]);
                            }catch (ArgumentCountError){
                                return header("Location: /lunova/Errore/BadRequest");
                            }
                            catch (TypeError ){
                                return header("Location: /lunova/Errore/redirect");
                            }
                        }
                        else if ($num == 2){
                            try {
                                $controller::$function($param[0], $param[1]);
                            }catch (ArgumentCountError){
                                return header("Location: /lunova/Errore/BadRequest");
                            }catch (TypeError ){
                                return header("Location: /lunova/Errore/redirect");
                            }
                        }
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