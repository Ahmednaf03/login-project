<?php
session_start() ;

function validator($username, $email, $password, $curr){
    $error = "" ;
        if($username!==$curr["username"]){
          $error = "username not found" ;
        }elseif($email!==$curr["email"]){
            $error = "email not found" ;
        }elseif($password!==$curr["password"]){
            $error = "incorrect password" ;
        }
        return $error ;
}
?>