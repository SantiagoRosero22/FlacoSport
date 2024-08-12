<?php
// Asegúrate de iniciar la sesión solo una vez
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Comprobar que la clase no está definida antes de declararla
if (!class_exists('Session')) {
    class Session {

        public $msg = [];  // Inicializar para evitar errores
        private $user_is_logged_in = false;

        public function __construct() {
            $this->flash_msg();
            $this->userLoginSetup();
        }

        public function isUserLoggedIn() {
            return $this->user_is_logged_in;
        }

        public function login($user_id) {
            $_SESSION['user_id'] = $user_id;
        }

        private function userLoginSetup() {
            $this->user_is_logged_in = isset($_SESSION['user_id']);
        }

        public function logout() {
            unset($_SESSION['user_id']);
        }

        public function msg($type = '', $msg = '') {
          if (!empty($msg)) {
              if (strlen(trim($type)) === 1) {
                  $type = str_replace(
                      ['d', 'i', 'w', 's'],
                      ['danger', 'info', 'warning', 'success'],
                      $type
                  );
              }
              $_SESSION['msg'][$type] = $msg;
          } else {
              return $this->msg;
          }
      }
      
      

        private function flash_msg() {
            if (isset($_SESSION['msg'])) {
                $this->msg = $_SESSION['msg'];
                unset($_SESSION['msg']);
            } else {
                $this->msg = [];
            }
        }
    }
}

// Crear una instancia de la clase `Session`
$session = new Session();
$msg = $session->msg();
