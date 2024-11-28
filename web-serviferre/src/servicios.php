<?php include('../includes/header.php'); ?>

<div class="container my-5">
    <!-- 1º Campo: Título -->
    <div class="container text-center">
        <h1 class="display-6 fw-bold" style="color: #2913B0;">Nuestros Servicios</h1> 
    </div>

    <!-- Carousel -->
    <div id="servicesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <?php
        // Ruta de las imágenes
        $carouselDir = '../img/carousel/';
        $validExtensions = ['png', 'jpg', 'jpeg'];

        // Analizamos la ruta y obtenemos las imágenes válidas
        $images = array_filter(scandir($carouselDir), function ($file) use ($carouselDir, $validExtensions) {
            $filePath = $carouselDir . $file;
            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            return is_file($filePath) && in_array($extension, $validExtensions);
        });

        // Convertimos a un array indexado por valores (por si scandir nos desordena índices)
        $images = array_values($images);

        // Verificamos si hay Imágenes Disponibles
        if (count($images) > 0):
        ?>

        <!-- Indicadores -->
        <div class="carousel-indicators">
            <?php foreach ($images as $index => $image): ?>
                <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="<?= $index; ?>"
                        class="<?= $index === 0 ? 'active' : ''; ?>"
                        aria-label="Slide <?= $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>

        <!-- Contenedor de Imágenes -->
        <div class="carousel-inner">
            <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                    <img src="<?= $carouselDir . $image; ?>" class="d-block w-100" alt="Imagen <?= $index + 1; ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Flechas Laterales del Carousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>

        <?php else: ?>
            <p>No hay imágenes para mostrar en el carousel.</p>
        <?php endif; ?>
    </div>

    <!-- Cards de Servicios -->
    <div class="container my-5 text-center">
        <h2 class="fw-bold mb-4" style="color: #2913B0;">¿Qué hacemos por ti?</h2>
        <p class="mb-5 text-muted">Descubre los servicios que ofrecemos para cubrir todas tus necesidades eléctricas y tecnológicas.</p>
        <div class="row gy-4">
            <!-- Servicio 1 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">⚡ Instalación en Viviendas</h3>
                        <p class="card-text text-muted">Realizamos instalaciones eléctricas completas en hogares, cuidando cada detalle para garantizar tu seguridad y comodidad.</p>
                    </div>
                </div>
            </div>
            <!-- Servicio 2 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">🌐 Redes de Datos</h3>
                        <p class="card-text text-muted">Conecta tu hogar o empresa con instalaciones profesionales en red para internet de alta velocidad.</p>
                    </div>
                </div>
            </div>
            <!-- Servicio 3 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">🎥 Cámaras de Seguridad</h3>
                        <p class="card-text text-muted">Instalamos cámaras de última generación para proteger lo que más te importa, con monitoreo en tiempo real.</p>
                    </div>
                </div>
            </div>
            <!-- Servicio 4 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">🔔 Alarmas y Volumétricos</h3>
                        <p class="card-text text-muted">Aumenta la seguridad con alarmas modernas y sistemas volumétricos para detectar intrusos de inmediato.</p>
                    </div>
                </div>
            </div>
            <!-- Servicio 5 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">📡 Antenas y Parabólicas</h3>
                        <p class="card-text text-muted">Instalamos antenas terrestres y parabólicas para garantizar la mejor señal en tu hogar o negocio.</p>
                    </div>
                </div>
            </div>
            <!-- Servicio 6 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">💡 Iluminación RGB</h3>
                        <p class="card-text text-muted">Transforma cualquier espacio con iluminación LED RGB personalizada para un toque moderno y colorido.</p>
                    </div>
                </div>
            </div>
            <!-- Servicio 7 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">🌞 Placas Solares</h3>
                        <p class="card-text text-muted">Aprovecha la energía del sol con nuestras soluciones de instalación de paneles solares para ahorrar y cuidar el planeta.</p>
                    </div>
                </div>
            </div>
            <!-- Servicio 8 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 card-custom-shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold" style="color: #2913B0;">❄️ Aires acondicionados</h3>
                        <p class="card-text text-muted">Mantén la temperatura perfecta con nuestros servicios de instalación y mantenimiento de aires acondicionados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
