<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

/**

 * Description of Router

 *

 * permet de parser une url

 * @param $url à parser

 * @return tableau contenant les paramètres

 */
class Router {

    static function parse($request) {





        //modification de l'url en cas de //

        if (strpos($request->url, '//') !== false) {



            $request->url = strtr($request->url, ['//' => '/']);



            header('Status: 301 Moved Permanently', false, 301);

            header('Location: ' . $request->url);
        }



        $request->url = trim($request->url, '/');



        $params = explode('/', $request->url);



        //conte le nombre de paramettre pour les url de sous dossier

        $taille = count($params);





        //url du style : /controller/action/param

        if ($taille >= 2) {



            if ($params[0] === trim(BASE_URL, '/')) {

                //url du style : /XXXXX/controller/action/param



                if (isset($params[1])) {

                    $controller = $params[1];
                }else{
                    return null;
                }



                if (isset($params[2])) {

                    $action = $params[2];
                } else {

                    return null;
                }



                if (isset($params[3])) {

                    $param = $params[3];
                } else {

                    $param = null;
                }
            } else {

                //url du style : /controller/action/param

                if (isset($params[0])) {

                    $controller = $params[0];
                }



                if (isset($params[1])) {

                    $action = $params[1];
                } else {

                    return null;
                }



                if (isset($params[2])) {

                    $param = $params[2];
                } else {

                    $param = null;
                }
            }
        }else{
            #$controller = "default";
            header("Location: " . BASE_URL . "/Default/index");
        }



        $request->controller = $controller;



        $request->action = isset($action) ? $action : 'index';



        $request->params = isset($param) ? $param : '';



        return true;
    }

}
