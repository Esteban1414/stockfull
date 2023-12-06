<?php
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $account = $_POST["account"];
    $password = $_POST["password"];

    try {
        $conne->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user = $conne->prepare("SELECT * FROM User WHERE account = ?");
        $user->execute([$account]);

        if ($user->rowCount() > 0) {
            $row = $user->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $row["password"];
            if ($password = $hashedPassword) {
                $_SESSION["user"] = $row["id"];
                $role_id = $row["role_id"];
                echo json_encode(["success" => true, "role_id" => $role_id]);
            } else {
                // Contraseña incorrecta, enviar respuesta JSON de error
                echo json_encode(["success" => false, "message" => "Incorrect password"]);
            }
        } else {
            // Usuario no encontrado, enviar respuesta JSON de error
            echo json_encode(["success" => false, "message" => "User not found"]);
        }
    } catch (PDOException $e) {
        // Error en la conexión o consulta, enviar respuesta JSON de error
        echo json_encode(["success" => false, "message" => "Database error"]);
    }
} else {
    // Si no es una solicitud POST, enviar respuesta JSON de error
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
