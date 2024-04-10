<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;

$router = new Router();

// Home
$router->get('/', [DashboardController::class, 'index']);


// Admin

    // Peliculas
$router->get('/admin-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', [AdminController::class, 'index']);
$router->post('/admin-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', [AdminController::class, 'index']);

$router->get('/admin-editar-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', [AdminController::class, 'editar']);
$router->post('/admin-editar-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', [AdminController::class, 'editar']);

$router->get('/admin-tabla-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', [AdminController::class, 'tabla']);

$router->post('/admin/info/eliminar-1a4f6c7e8b9d2a5f1c8e0b6d4a9f3c2', [AdminController::class, 'eliminar']);


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);


$router->comprobarRutas();