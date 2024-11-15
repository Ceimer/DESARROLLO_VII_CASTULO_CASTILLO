<?php
session_start(); // Asegúrate de iniciar la sesión

require_once 'config.php'; // Asegúrate de que este archivo tenga la configuración para 'biblioteca_personal'

$clientID = '';
$clientSecret = '';
$redirectUri = '';

$authUrl = "";
$tokenUrl = "";
$userInfoUrl = "";

// Si no existe un código, redirigir al usuario a Google para autenticarse
if (!isset($_GET['code'])) {
    $params = [
        'client_id' => $clientID,
        'redirect_uri' => $redirectUri,
        'response_type' => 'code',
        'scope' => 'email profile'
    ];
    $authRequestUrl = $authUrl . '?' . http_build_query($params);
    header("Location: $authRequestUrl");
    exit();
} else {
    // Intercambiar el código por un token de acceso
    $code = $_GET['code'];
    $postData = [
        'code' => $code,
        'client_id' => $clientID,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error al obtener el token de acceso: ' . curl_error($ch);
        curl_close($ch);
        exit();
    }

    curl_close($ch);

    $tokenData = json_decode($response, true);

    if (isset($tokenData['access_token'])) {
        // Obtener los datos del usuario
        $accessToken = $tokenData['access_token'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $userInfoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $accessToken"]);
        $userInfo = curl_exec($ch);
        curl_close($ch);

        $userData = json_decode($userInfo, true);

        // Si el usuario tiene datos válidos
        if (!empty($userData['id']) && !empty($userData['email'])) {
            $googleId = $userData['id'];
            $email = $userData['email'];
            $name = $userData['name'] ?? '';

            // Conexión a la base de datos con PDO
            $pdo = new PDO('mysql:host=localhost;dbname=Parcial4', 'root', '');

            // Comprobar si el usuario ya existe en la base de datos
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE google_id = ?");
            $stmt->execute([$googleId]);
            $userId = $stmt->fetchColumn();

            if (!$userId) {
                // Si el usuario no existe, lo insertamos en la base de datos
                $stmt = $pdo->prepare("INSERT INTO usuarios (google_id, email, nombre) VALUES (?, ?, ?)");
                $stmt->execute([$googleId, $email, $name]);
                $userId = $pdo->lastInsertId();
            }

            // Guardar los datos del usuario en la sesión
            $_SESSION['user'] = [
                'id' => $userId,
                'google_id' => $googleId,
                'email' => $email,
                'name' => $name
            ];

            // Redirigir al dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error al obtener los datos del usuario.";
        }
    } else {
        echo "Error al obtener el token de acceso.";
    }
}
?>
