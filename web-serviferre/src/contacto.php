<?php include('../includes/header.php'); ?>

<!-- Hero Section -->
<div class="hero-section text-center py-5" style="color: #2913B0; background: linear-gradient(90deg, #f3f4f7, #f7f9fc);">
    <div class="container">
        <h1 class="display-4 fw-bold">¿Listo para Contactarnos?</h1>
        <p class="lead mt-3">Estamos aquí para responder tus dudas y ofrecerte soluciones a la medida de tus necesidades.</p>
        <a href="servicios.php" class="btn btn-primary btn-lg mt-4" style="background-color: #2913B0; border-color: #2913B0;">Explora Nuestros Servicios</a>
    </div>
</div>

<!-- Formulario de Contacto -->
<div class="container my-5">
    <h2 class="fw-bold text-center mb-4" style="color: #2913B0;">Envíanos tu Consulta</h2>
    <p class="text-muted text-center mb-5">Completa el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>

    <form method="POST" action="procesar_contacto.php" class="mx-auto" style="max-width: 600px;">
        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
        </div>

        <!-- Apellidos -->
        <div class="mb-3">
            <label for="apellidos" class="form-label fw-bold">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresa tus apellidos" required>
        </div>

        <!-- Correo Electrónico -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="tucorreo@ejemplo.com" required>
        </div>

        <!-- Mensaje -->
        <div class="mb-3">
            <label for="mensaje" class="form-label fw-bold">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe aquí tu mensaje o consulta..." required></textarea>
        </div>

        <!-- Botón de Enviar -->
        <button type="submit" class="btn btn-primary btn-lg w-100" style="background-color: #2913B0; border-color: #2913B0;">Enviar</button>
    </form>
</div>

<!-- Modal de Éxito -->
<?php if (isset($_GET['enviado']) && $_GET['enviado'] == 'true'): ?>
<div class="modal fade show" id="enviadoModal" tabindex="-1" aria-labelledby="enviadoModalLabel" aria-hidden="false" style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enviadoModalLabel">¡Enviado Correctamente!</h5>
            </div>
            <div class="modal-body">
                Tu mensaje ha sido enviado con éxito. Nos pondremos en contacto contigo lo antes posible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Llamado a la Acción -->
<div class="text-center py-5" style="background: linear-gradient(90deg, #2913B0, #2913B0); color: white;">
    <h2 class="fw-bold mb-4">¿Prefieres Hablar Directamente?</h2>
    <p class="lead mb-4">También puedes llamarnos al <strong>+34 123 456 789</strong> o enviarnos un correo a <strong>info@serviferre.com</strong>.</p>
    <a href="tel:+34123456789" class="btn btn-lg" style="background-color: white; color: #2913B0; border-color: #2913B0;">Llámanos Ahora</a>
</div>

<?php include('../includes/footer.php'); ?>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Asegurarse de que el modal se cierre automáticamente después de un par de segundos
    <?php if (isset($_GET['enviado']) && $_GET['enviado'] == 'true'): ?>
        setTimeout(function() {
            var modal = new bootstrap.Modal(document.getElementById('enviadoModal'));
            modal.hide(); // Esto cerrará el modal
        }, 5000); // Cerrar después de 5 segundos
    <?php endif; ?>
</script>
