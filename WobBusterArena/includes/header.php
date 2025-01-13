<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Establecer idioma predeterminado si no se ha definido
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'es'; // idioma por defecto español
}

// Cambiar idioma cuando se hace clic en el botón
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Cargar los textos según el idioma seleccionado
$lang = $_SESSION['lang'];
$texts = [
    'es' => [
        'login' => 'Iniciar sesión',
        'logout' => 'Cerrar sesión',
        'username' => 'Nombre de Usuario',
        'password' => 'Contraseña',
        'login_modal_title' => 'Iniciar Sesión',
        'login_button' => 'Iniciar sesión',
    ],
    'en' => [
        'login' => 'Log in',
        'logout' => 'Log out',
        'username' => 'Username',
        'password' => 'Password',
        'login_modal_title' => 'Log In',
        'login_button' => 'Log In',
    ]
];
?>

<header style="background: linear-gradient(to right, #000000, #000000); padding: 15px;">
    <div class="container-fluid" style="color: white; border-radius: 15px;">
        <div class="row align-items-center">
            <!-- Imagen -->
            <div class="col-6 d-flex align-items-center">
                <!-- Logo -->
                <img src="./img/logo_app.png" alt="Logo App" style="width: 350px; height: auto; margin-left: 15px;">
            </div>

            <!-- Sesión -->
            <div class="col-6 text-end">
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <a href="logout.php" class="btn" 
                            style="background-color: #444444; 
                                border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 150px; 
                                border-radius: 15px; 
                                border-width: 2px;"><?= $texts[$lang]['logout'] ?></a>
                <?php else: ?>
                    <!-- Login Modal -->
                    <button class="btn" 
                            style="background-color: #444444; 
                                border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 150px; 
                                border-radius: 15px; 
                                border-width: 2px;" 
                            data-bs-toggle="modal" 
                            data-bs-target="#loginModal"><?= $texts[$lang]['login'] ?></button>
                <?php endif; ?>

                <!-- Botón de cambio de idioma -->
                <a href="?lang=es" class="btn" 
                   style="background-color: #444444; 
                          border-color: #FFFFFF; 
                          color: #FFFFFF; 
                          width: 100px; 
                          border-radius: 15px; 
                          border-width: 2px;">ES</a>
                <a href="?lang=en" class="btn" 
                   style="background-color: #444444; 
                          border-color: #FFFFFF; 
                          color: #FFFFFF; 
                          width: 100px; 
                          border-radius: 15px; 
                          border-width: 2px;">EN</a>
            </div>
        </div>
    </div>
</header>

<!-- Modal Iniciar Sesión -->
<?php if (!isset($_SESSION['id_usuario'])): ?>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel"><?= $texts[$lang]['login_modal_title'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label"><?= $texts[$lang]['username'] ?></label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><?= $texts[$lang]['password'] ?></label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn" 
                            style="background-color: #333333; 
                                border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 150px; 
                                border-radius: 15px; 
                                border-width: 2px;" 
                            data-bs-toggle="modal" 
                            data-bs-target="#loginModal"><?= $texts[$lang]['login_button'] ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
