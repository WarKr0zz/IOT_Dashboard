<?php
require_once("./api.php");


try{
    if(!empty($_GET['demande'])){
        $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
        switch($url[0]){
            case "DeviceId" :
                if(empty($url[1])){
                    getDeviceId();
                } else {
                    getInformationByDeviceId($url[1]);
                }
            break;

            case "NewDevice" : 
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                    } else {
                        if(empty($url[3])){
                            throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 3");
                        } else {
                            
                                InsertNewMesure($url[1],$url[2],$url[3]);
                            
                        }
                    }
                }
            break;

            case "Signin" :
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                    } else {
                        Signin($url[1],$url[2]);
                    }

                }
            break;

            case "Login" : 
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                    } else {
                        TryLogin($url[1],$url[2]);
                    }

                }
            break;

            case "Latest" :
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                    } else{
                        LatestInfoFromDevice($url[1],$url[2]);
                    }
                }

            
        }
    } else {
        throw new Exception ("Probleme de récupération de données.");
    }
} catch(Exception $e){
    $erreur = [
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}