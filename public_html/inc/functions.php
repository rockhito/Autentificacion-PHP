<?php

    function connectionDB(){
        $host = 'localhost:8889';
        $user = 'test';
        $password = 'test';
        $dbName = 'code_pills';
        $host = 'mysql:host='.$host.';dbname='.$dbName.';';

        try{
            $connection = new PDO($host,$user,$password);

            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $connection;
        } catch(PDOException $e){

            die('ERROR: '.$e->getMessage());

        }
    }

    function secure_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function hash_password($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function create_user($email, $password){
        $email = secure_data($email);
        $password = secure_data($password);
        $password = hash_password($password);

        $connection = connectionDB();

        $stmt = $connection->prepare('INSERT INTO listado_usuarios(email, password)
            VALUES(:email,:password)');

        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);

        $stmt->execute();
    }

    function check_email_exists($email){
        $email = secure_data($email);

        $connection = connectionDB();

        $stmt = $connection->prepare('SELECT * FROM listado_usuarios WHERE email=:email');
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        $result = $stmt->fetch();

        if(isset($result['email'])){
            return true;
        } else {
            return false;
        }
    }

    function get_password_by_email($email){
        $email = secure_data($email);

        $connection = connectionDB();

        $stmt = $connection->prepare('SELECT * FROM listado_usuarios WHERE email=:email');
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        $result = $stmt->fetch();

        if(isset($result['password'])){
            return $result['password'];
        }
    }

    function auth($email, $password){
        if(check_email_exists($email)){
            $password = secure_data($password);
            $passwordInDB = get_password_by_email($email);

            if(isset($password) && isset($passwordInDB)){
                $result = password_verify($password,$passwordInDB);
                return $result;
            } else {
                return false;
            }
        }
    }


?>