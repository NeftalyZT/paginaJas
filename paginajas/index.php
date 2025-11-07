<?php include 'includes/header.php'; ?>

<h1 class="text-center mb-4 text-primary">Plataforma Dinámica de Aprendizaje Financiero</h1>
<p class="lead text-center mb-5">¡Bienvenido! Sumérgete en nuestros módulos interactivos para dominar la gestión de caja, la prevención de fraudes y la lucha contra el Lavado de Activos y el Financiamiento del Terrorismo (LA/FT).</p>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card h-100 shadow-sm border-success">
            <div class="card-body text-center">
                <h5 class="card-title text-success">Gestión de Caja</h5>
                <p class="card-text">Mejora tus habilidades en cuadre, arqueo y manejo de efectivo de manera eficiente.</p>
                <a href="caja.php" class="btn btn-success mt-2">¡Jugar Ahora!</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100 shadow-sm border-warning">
            <div class="card-body text-center">
                <h5 class="card-title text-warning">Reconocimiento de Billetes Falsos </h5>
                <p class="card-text">Aprende a identificar las señales de seguridad y distingue el dinero auténtico del falso.</p>
                <a href="billetes.php" class="btn btn-warning mt-2">¡Empezar!</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100 shadow-sm border-danger">
            <div class="card-body text-center">
                <h5 class="card-title text-danger">Casos Prácticos</h5>
                <p class="card-text">Analiza escenarios reales de Lavado de Activos y Financiamiento del Terrorismo. </p>
                <a href="casos.php" class="btn btn-danger mt-2">¡Resolver Casos!</a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>