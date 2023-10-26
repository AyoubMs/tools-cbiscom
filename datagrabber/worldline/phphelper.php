<?php

session_start();

//if(!isset($_SESSION["token"]) || empty($_SESSION["token"])) {
//    $_SESSION["token"] = "abcdefghijkl";
//}



$conn;
$errorMsg;
$successMsg;
$candidatAll;
$message;

$token;
$date;
$tokenvalide = false;

// $getConnection = function (
//     $servername = "localhost",
//     $username = "root",
//     $password = ""
// ) use (&$conn, &$errorMsg) {
//     if (!$conn)
//         try {
//             $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
//             // set the PDO error mode to exception
//             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             // echo "Connected successfully";
//         } catch (PDOException $e) {
//             $errorMsg = "Connection failed: " . $e->getMessage();
//             return;
//         }
//     return $conn;
// };

// $createTokenTable = function () use ($getConnection) {
//     // $query = `create table candidat `;
//     $sql = "CREATE TABLE IF NOT EXISTS `tokens` (" .
//         "`Id_tokens` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY," .
//         "`token` varchar(250)," .
//         "`date_ajout` DATETIME DEFAULT CURRENT_TIMESTAMP" .
//         ");";

//     $getConnection()->exec($sql);
// };

// $addCandidat = function ($nom, $prenom, $photo) use ($getConnection) {
//     // $query = `create table candidat `;
//     $sql = "insert into candidat (nom, prenom, photo) values ('{$nom}', '{$prenom}', '{$photo}')";

//     $getConnection()->exec($sql);
// };

$checkToken = function ($token) {
    // $query = `create table candidat `;
    $tokens = file('tokens', FILE_IGNORE_NEW_LINES);
    // $tokens = array(
    //     "XzsMjMkPs4jNXsPCbmQ2S5Jn",
    //     "nnqM5ZsYQKnxLuq7ea5hzdQm",
    //     "ZncjrwyvzxKk3LbBhhmRcgWU",
    //     "5B4JpSkxyhUZYcaV6dkW4KPE",
    //     "cabssefLGVrAGXDcX6Bx5bZ6",
    //     "jYxe88a92ySR7QfxzMmEqdU2"
    // );
    // print_r($tokens);

    $tokenIndex = array_search($token, $tokens);
    // echo "checkToken";

    if ((!isset($tokenIndex) || empty($tokenIndex))) {
        // echo " empty($tokenIndex) ";
        if (strval($tokenIndex) != '0') {
            // echo " empty($tokenIndex) ";
            $tokenIndex = -1;
        }
    }
    // echo $tokenIndex;
    return $tokenIndex;
};

$getRequest = function ($exec) use (&$token, &$date, &$message, $checkToken) {
    if (!isset($_GET['token']) && !isset($_GET['date']))
        return;

    $token = "";
    $date = "";

    $token = $_GET['token'];
    $date = $_GET['date'];

    if ($checkToken($token) > 0) {
        // $handle = curl_init();

        // $url = "https://worldline.slyo.me/data/?action=remoteData&source=reporting&exec={$exec}&output=csv&@reportingDate=d,{$date}";

        // // Set the url
        // curl_setopt($handle, CURLOPT_URL, $url);
        // // Set the result output to be a string.
        // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        // $message = curl_exec($handle);

        // curl_close($handle);


        $url = "https://worldline.slyo.me/data/?action=remoteData&source=reporting&exec={$exec}&output=csv&@reportingDate=d,{$date}";

        $homepage = file_get_contents($url);

        $message = $homepage;
    } else {
        $message = "<style>
            div {
                margin: 50px auto auto auto;
            }

            body {
                display: grid;
            }
        </style>
        <div>
            Erreur: Le token est invalide
        </div>";
    }
};


$getRequestToken = function () use (&$token, &$tokenvalide, $checkToken) {
    // echo $checkToken($token);

    if (!isset($_POST['token'])) {
        if (!isset($_SESSION["token"]) || empty($_SESSION["token"])) {
            $_SESSION["token"] = "3LbBhhmRcgWUZncjrwyvzxKk";
        } else {
            $token = $_SESSION["token"];
        }
    } else {
        $_SESSION["token"] = $_POST["token"];

        $token = $_POST["token"];
    }

    if ($checkToken($token) >= 0) {
        $tokenvalide = true;
    }
};

$ipRestrection = function () {
    $thisIp = $_SERVER['REMOTE_ADDR'];
    // $pieces = explode("", $thisIp);
    // echo $thisIp;

    if ($thisIp != '196.206.228.238'  && $thisIp != '62.251.255.14' && $thisIp != '41.137.41.170' && $thisIp != '196.92.1.151' && $thisIp != '41.137.41.234') {
        echo "adresse IP restreinte";
        die;
    }
};
