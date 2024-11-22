<?php include('../includes/header.php'); ?>
<div class="container my-5">
    <h1>Tecnologías y Herramientas</h1>
    <div id="techCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/tecnologia1.jpg" class="d-block w-100" alt="Tecnología 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Herramientas de precisión</h5>
                    <p>Destornilladores, multímetros y más.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../images/tecnologia2.jpg" class="d-block w-100" alt="Tecnología 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Instalaciones avanzadas</h5>
                    <p>Redes de cableado y cámaras de seguridad.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#techCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#techCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<?php include('../includes/footer.php'); ?>
