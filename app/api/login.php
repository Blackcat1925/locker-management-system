<?php
    require_once(APP. '/config/config.php');
    require_once(APP. '/config/database.php');

    $db = new DB();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postBody = file_get_contents("php://input");
        $postBody = json_decode($postBody, true);
        $accountId = $postBody['accId'];
        $password = $postBody['password'];
        $isAccount = $db->query('SELECT * FROM `accounts` a where a.id='.$accountId)[0];
        if($isAccount) {
            $customerId = $isAccount['customerId'];
            // $password = $db->query();
            // print_r(MD5(123456));
            print_r('SELECT * FROM customers c where c.id='.$customerId.' AND c.password="'.MD5(number_format($password)).'"'); 
            die;
            if(true) {
                $response = array (
                    "status" => "success",
                    "message" => "User loged in successfully",
                    "code" => 200
                );
                echo json_encode($response);
                session_start();
                $_SESSION['accId']= $accId;
                http_response_code(200);
            } else {
                $response = array (
                    "status" => "error",
                    "message" => "Invalid Password",
                    "code" => 200
                );
                echo json_encode($response);
                http_response_code(200);
            }
        } else {
            $response = array (
                "status" => "error",
                "message" => "Invalid Account No",
                "code" => 200
            );
            echo json_encode($response);
            http_response_code(200);
        }
    } else {
        $response = array (
            "status" => "error",
            "message" => "Invalid Method type",
            "code" => 200
        );
        echo json_encode($response);
        http_response_code(405);
    }

?>