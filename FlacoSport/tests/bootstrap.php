<?php
// En un archivo central o bootstrap
require_once 'includes/session.php';  // Incluir una vez al inicio
require_once 'includes/sql.php';  // Verifica que la ruta es correcta


// tests/bootstrap.php

// Cargar el autoloading de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Aquí puedes añadir otras configuraciones globales necesarias para las pruebas

// Por ejemplo, se puede establecer una conexión de base de datos para las pruebas
// O inicializar mocks o dobles de prueba
