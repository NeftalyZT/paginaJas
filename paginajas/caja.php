<?php include 'includes/header.php'; ?>
<h1 class="text-center mb-5 text-success">💰 Gestión y Arqueo de Caja</h1>
<p class="lead text-center">Practica tus habilidades de conteo y cuadre para evitar faltantes y sobrantes. ¡Debes igualar el "Efectivo Esperado"!</p>

<div id="juego-caja" class="py-5 border rounded shadow-lg bg-light">
    <div class="container-fluid">
        <h3 class="mb-4 text-dark">Arqueo de Caja N° 1</h3>

        <div class="row mb-5 justify-content-center">
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Efectivo Inicial (Fondo Fijo)</h5>
                        <p class="card-text fs-2" id="fondo-fijo-display">S/ 500.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total de Ventas (Según Sistema)</h5>
                        <p class="card-text fs-2" id="ventas-sistema-display">S/ 0.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Efectivo Esperado (Cuadre Ideal)</h5>
                        <p class="card-text fs-2" id="esperado-display">S/ 0.00</p>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mb-3 text-start text-dark">Ingresa tu Conteo Físico Actual:</h4>
        <form id="form-arqueo">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Denominación</th>
                        <th>Cantidad (unds.)</th>
                        <th>Subtotal (S/.)</th>
                    </tr>
                </thead>
                <tbody id="tabla-conteo">
                    
                    <tr><td>Billetes de S/ 200</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="200" id="c200"></td><td class="subtotal" id="s200">S/ 0.00</td></tr>
                    <tr><td>Billetes de S/ 100</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="100" id="c100"></td><td class="subtotal" id="s100">S/ 0.00</td></tr>
                    <tr><td>Billetes de S/ 50</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="50" id="c50"></td><td class="subtotal" id="s50">S/ 0.00</td></tr>
                    <tr><td>Billetes de S/ 20</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="20" id="c20"></td><td class="subtotal" id="s20">S/ 0.00</td></tr>
                    <tr><td>Billetes de S/ 10</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="10" id="c10"></td><td class="subtotal" id="s10">S/ 0.00</td></tr>
                    
                    <tr><td>Monedas de S/ 5</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="5" id="c5"></td><td class="subtotal" id="s5">S/ 0.00</td></tr>
                    <tr><td>Monedas de S/ 2</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="2" id="c2"></td><td class="subtotal" id="s2">S/ 0.00</td></tr>
                    <tr><td>Monedas de S/ 1</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="1" id="c1"></td><td class="subtotal" id="s1">S/ 0.00</td></tr>
                    <tr><td>Monedas de S/ 0.50</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="0.5" id="c050"></td><td class="subtotal" id="s050">S/ 0.00</td></tr>
                    <tr><td>Monedas de S/ 0.20</td><td><input type="number" min="0" value="0" class="form-control count-input" data-valor="0.2" id="c020"></td><td class="subtotal" id="s020">S/ 0.00</td></tr>
                </tbody>
                <tfoot>
                    <tr class="table-secondary fs-5">
                        <td colspan="2" class="text-end fw-bold">Total Efectivo Contado (Físico):</td>
                        <td id="total-contado-display" class="fw-bold">S/ 0.00</td>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-primary" id="btn-calcular">Calcular Conteo</button>
                <button type="button" class="btn btn-success" id="btn-verificar" disabled>Verificar Arqueo</button>
                <button type="button" class="btn btn-warning" id="btn-reiniciar">Reiniciar</button>
            </div>
        </form>

        <div id="resultado-arqueo" class="mt-5 p-4 rounded text-center shadow" style="display: none;">
            </div>

    </div>
</div>

<script>
    // Al incluir este script aquí, nos aseguramos que la función iniciarJuegoCaja 
    // se llama inmediatamente después de que el HTML de la caja esté listo.
    document.addEventListener('DOMContentLoaded', () => {
        // La lógica principal de llamada ya está en scripts.js
        if (document.getElementById('juego-caja')) {
            iniciarJuegoCaja();
        }
    }); 
</script>

<?php include 'includes/footer.php'; ?>