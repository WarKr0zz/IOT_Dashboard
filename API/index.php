<?php
require_once("./api.php");
require("phpMQTT.php");
if (substr($_SERVER['HTTP_USER_AGENT'], 0, 7) !== 'Mozilla') {
try{
    if(!empty($_GET['demande'])){
        $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
        switch($url[0]){
            case "DeviceId" :
                if(empty($url[1])){
                    $Devices= getDeviceId();

                    //var_dump($Devices); 
                    //echo '<pre>'; var_dump($Devices); echo '</pre>';

                    foreach ($Devices as $Device){               
                        foreach ($Device as $data)
                        { 

                            echo $data.",";
                        }
                    echo "</br>";
                }
                } else {
                    $Info=getInformationByDeviceId($url[1]);
                    foreach ($Info[0] as $data)
                                { 
                                    echo $data.",";
                                }
                }
            break;

            case "Signup" :
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                    } else {
                        if(empty($url[3])){
                            throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 3");
                        } else {
                        Signup($url[1],$url[2],$url[3]);
                        }
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
}
?>

<html>
    <head>
    <title> JavaScript MQTT</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>

     <script>  
       var mqtt;
        var reconnextTimeout = 2000;
        var host ="128.128.0.58";
        var port =2306;

        function onConnect(){
            console.log("Connected to mqtt server");
            mqtt.subscribe("test");
            message = new Paho.MQTT.Message("Connected");
            message.destinationName= "Verification_connect";
            mqtt.send(message);
        }

        function MQTTconnect() {
            console.log("connecting to "+host + "" +port);
            mqtt = new Paho.MQTT.Client(host,port,"clientjs");
            var options ={
                timeout: 3,
                onSuccess:onConnect,
                onFailure:onFailure,                
            };
            mqtt.onMessageArrived = onMessageArrived
            mqtt.connect(options);
        }
        function onFailure(message) {
            console.log("conneciton fail");
            setTimeout(MQTTconnect, reconnectTimeout);
        }
        function onMessageArrived(msg){
            out_msg=msg.payloadString+"<br>";
            console.log(out_msg);
            var div = document.getElementById("message");
            div.innerHTML = out_msg;
        }
        
       
</script>
    </head>
    <body>
    <h1></h1>
    <div id="message"></div>

    <div id="WebScrapping"> <?php 

            if (substr($_SERVER['HTTP_USER_AGENT'], 0, 7) === 'Mozilla') {

            try{


            if(!empty($_GET['demande'])){
                $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
                switch($url[0]){
                    case "DeviceId" :
                        if(empty($url[1])){
                            $Devices= getDeviceId();

                            //var_dump($Devices); 
                            //echo '<pre>'; var_dump($Devices); echo '</pre>';

                            foreach ($Devices as $Device){               
                                foreach ($Device as $data)
                                { 

                                    echo $data.",";
                                }
                            echo "</br>";
                        }
                            //echo $Device[0]["Id"];
                        } else {
                            $Info=getInformationByDeviceId($url[1]);
                            foreach ($Info[0] as $data)
                                { 

                                    echo $data.",";
                                }
                                echo "</br>";
                                $IDD = $Info[0]["Id"];
                                $Etat =  $Info[0]["Etat"];
                                $TMP =  $Info[0]["Temperature"];
                                $DATE = $Info[0]["Date"];
                                echo ("le device est le numéro $IDD, son dernier etat etait $Etat, à $DATE sa température etait de $TMP ");

                        }
                    break;

                    case "Signup" :
                        if(empty($url[1])){
                            throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                        } else {
                            if(empty($url[2])){
                                throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                            } else {
                                if(empty($url[3])){
                                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 3");
                                } else {
                                Signup($url[1],$url[2],$url[3]);
                                }
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
    }
?> </div>

    <script>
        //MQTTconnect();
    </script>
    </body>


</html>

