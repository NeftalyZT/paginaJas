<?php include 'includes/header.php'; ?>
<h1 class="text-center mb-5 text-warning">Reconocimiento de Billetes Falsos</h1>
<p class="lead text-center">¡Pon a prueba tu vista! Identifica las **5 medidas de seguridad clave** haciendo clic en la zona correcta del billete.</p>

<div id="juego-billetes" class="py-5 border rounded shadow-lg bg-light">
    <div class="container-fluid">
        <h3 class="mb-4 text-dark">Nivel 1: Inspecciona el billete S/ 100</h3>

        <div class="row">
            <div class="col-md-7 position-relative d-flex justify-content-center">
    
    <div id="billete-contenedor" class="position-relative p-3 border rounded shadow-sm bg-white">
        <img src="img/billete_100.jpg" alt="Billete a inspeccionar" class="img-fluid rounded" id="billete-img"> 
        
        </div>
    
</div>

            <div class="col-md-5">
                <div class="card shadow-sm border-warning h-100">
                    <div class="card-header bg-warning text-dark fw-bold">
                        Panel de Seguridad
                    </div>
                    <div class="card-body">
                        <h5>Progreso: <span id="progreso-display" class="badge bg-secondary">0/5</span> Medidas encontradas.</h5>
                        
                        <p class="mt-3">Instrucciones:</p>
                        <ul class="list-group mb-4">
                            <li class="list-group-item list-group-item-info">1. Haz clic en las zonas donde crees que se encuentran las medidas de seguridad.</li>
                            <li class="list-group-item list-group-item-info">2. Intenta encontrar la **Marca de Agua**, el **Hilo de Seguridad**, la **Tinta que Cambia de Color (óptica)**, y el **Registro Perfecto**.</li>
                        </ul>
                        
                        <div id="feedback-billetes" class="mt-4">
                            </div>
                        
                        <button class="btn btn-warning mt-4 w-100" id="btn-reiniciar-billetes" style="display: none;">Reiniciar Juego</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Se asegura de que la función iniciarJuegoBilletes se ejecute
    document.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('juego-billetes')) {
            iniciarJuegoBilletes();
        }
    }); 
</script>

<?php include 'includes/footer.php'; ?>