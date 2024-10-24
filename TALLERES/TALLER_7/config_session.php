<?php
// Configuración de la sesión con opciones de seguridad
session_start([
    'cookie_lifetime' => 86400, // 1 día de duración de la sesión
    'cookie_secure' => true,    // Requiere HTTPS para la cookie de sesión
    'cookie_httponly' => true,  // No accesible vía JavaScript
    'use_strict_mode' => true   // Previene ataques de fijación de sesiones
]);
?>
