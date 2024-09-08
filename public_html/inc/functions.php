<?php
function connectionDB(){
    $host = 'localhost:3306';
    $dbName = 'code_pills';
    $user = 'root';
    $pass = '';
    $hostDB = 'mysql:host='.$host.';dbname='.$dbName.';';
    try{
        $connection = new PDO($hostDB,$user,$pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

function hash_pass($pass){
    return password_hash($pass, PASSWORD_DEFAULT);
}

function create_user($email,$pass){
    $email = secure_data($email);
    $pass = secure_data($pass);
    $pass = hash_pass($pass);
    $connection = connectionDB();
    $stmt = $connection->prepare('INSERT INTO listado_usuarios (email, password) VALUES (:email,:password)');
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$pass);
    $stmt->execute();
}

function check_email($email){
    $email = secure_data($email);
    $connection = connectionDB();
    $stmt = $connection->prepare('SELECT * FROM listado_usuarios WHERE email=:email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch();
    if(isset($result['email'])){
        return true;
    } else {
        return false;
    }
}

function get_pass_by_email($email){
    $email = secure_data($email);
    $connection = connectionDB();
    $stmt = $connection->prepare('SELECT * FROM listado_usuarios WHERE email=:email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['password'];
}

function auth_user($email, $password){
    $email = secure_data($email);
    $password = secure_data($password);
    if(check_email($email)){
        $passInDB = get_pass_by_email($email);
        $resultAuth = password_verify($password,$passInDB);
        return $resultAuth;
    }
}

function obtener_empleado_por_codigo($codigo_empleado){
    $connection = connectionDB();
    $stmt = $connection->prepare('SELECT * FROM empleados WHERE codigo_empleado=:codigo_empleado');
    $stmt->bindParam(':codigo_empleado', $codigo_empleado);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}

function registrar_horario($id_empleado, $fecha, $hora_entrada, $hora_salida, $total_horas_dia){
    $connection = connectionDB();
    $stmt = $connection->prepare('INSERT INTO horarios_trabajados (id_empleado, fecha, hora_entrada, hora_salida, total_horas_dia) VALUES (:id_empleado, :fecha, :hora_entrada, :hora_salida, :total_horas_dia)');
    $stmt->bindParam(':id_empleado', $id_empleado);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hora_entrada', $hora_entrada);
    $stmt->bindParam(':hora_salida', $hora_salida);
    $stmt->bindParam(':total_horas_dia', $total_horas_dia);
    $stmt->execute();
}
?>
