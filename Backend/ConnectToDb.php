<?php
include_once ('env.php');
function ConnectToDb(){
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_NAME');

    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    return $pdo;
}

// function GetURL() {
//     if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
//     $url = "https://";   
//     else  
//     $url = "http://";   
//     // Append the host(domain name, ip) to the URL.   
//     $url.= $_SERVER['HTTP_HOST'];   

//     // Append the requested resource location to the URL   
//     $url.= $_SERVER['REQUEST_URI'];   

//     return $url;  
// } 

// function GetBaseURL() {
//     $url = GetURL();
//     $url = strtok($url, '?');
//     return $url;
// }

// function GetSort() {
//     $url = GetURL();
//     $url = parse_url($url, PHP_URL_QUERY);
//     parse_str($url, $query);
//     if(isset($query['sort'])) {
//         return $query['sort'];
//     }
//     else {
//         return 'Id';
//     }
    
// }

// function valid_donnees($donnees) {
//     $donnees = trim($donnees); // supprime les espaces inutiles
//     $donnees = stripslashes($donnees); // supprime les antislahes pour éviter le hack
//     $donnees = htmlspecialchars($donnees); // transforme < et > en &lt et &gt par exemple
//     $donnees = escapeshellcmd($donnees); // supprime les caractères qui peuvent avoir une signification dans une ligne de commande du shell
//     return $donnees;
// }
?>