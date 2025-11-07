<?php
include 'includes/header.php';

// --- INICIO DE DATOS: ARRAYS PHP SIMULANDO BASE DE DATOS ---
$casos_laft = [
    [
        'titulo' => 'CASO PRÁCTICO N° 3: COMPRA DE NEGOCIO “PANTALLA” (Lavado de Activos)',
        'escenario' => '“Carlos” estuvo varios años viviendo en otro país, regresó hace 6 meses y no registra trabajo actual. De un día para otro compra una tienda de abarrotes por S/. 150,000 al contado. Carlos declara que el dinero es “ahorro personal”. Luego, en su tienda casi no vende, pero deposita a su cuenta bancaria entre S/. 8,000 y S/. 12,000 en efectivo todos los meses. No existe registro comercial, facturas ni proveedores grandes. La policía identificó que su hermano pertenece a una organización de tráfico de drogas.',
        'preguntas' => [
            ['id' => 'p3_1', 'texto' => '1. ¿Qué parte indica el uso del negocio para lavado de activos?', 'respuesta_clave' => 'El negocio se usa como fachada para justificar depósitos de dinero ilícito (Estrategia de Colocación/Tipología de Negocios Pantalla).'],
            ['id' => 'p3_2', 'texto' => '2. ¿Qué señales de alerta observas en el comportamiento financiero de Carlos?', 'respuesta_clave' => 'Discrepancia entre su perfil (sin empleo) y la riqueza (compra de contado). Depósitos frecuentes y montos consistentes sin justificación comercial.'],
            ['id' => 'p3_3', 'texto' => '3. ¿Debería la entidad reportar esta operación? ¿Por qué?', 'respuesta_clave' => 'Sí, debe emitir un Reporte de Operación Sospechosa (ROS) inmediatamente debido a las múltiples señales de alerta, el perfil del cliente y el vínculo con el tráfico de drogas.'],
        ]
    ],
    [
        'titulo' => 'CASO PRÁCTICO N° 4: ENVÍO DE REMESAS FRECUENTES (Trata de Personas)',
        'escenario' => '“Lucía”, 22 años, estudiante, sin empleo formal. Recibe S/. 1,500 - S/. 2,000 semanalmente desde tres distintas personas en Chile. Al recibir el dinero, lo transfiere inmediatamente a dos cuentas bancarias en otra ciudad. Al preguntarle, dice que “ayuda a amigos”. La policía detectó que en Chile se investiga una red de trata de personas que envía dinero al país de origen.',
        'preguntas' => [
            ['id' => 'p4_1', 'texto' => '1. ¿Qué tipo de delito podría estar relacionado con estos movimientos?', 'respuesta_clave' => 'Trata de personas, cuyo dinero se lava y se usa para financiar reclutadores.'],
            ['id' => 'p4_2', 'texto' => '2. ¿Lucía podría estar involucrada o solo sería testaferro/mula financiera?', 'respuesta_clave' => 'Mula financiera (intermediaria) debido a su perfil sin empleo y el patrón de transferencia inmediata del dinero de terceros.'],
            ['id' => 'p4_3', 'texto' => '3. ¿Qué acción debe tomar la entidad financiera?', 'respuesta_clave' => 'Emitir un Reporte de Operación Sospechosa (ROS) por el patrón inusual de transferencias (múltiples remitentes, reenvío inmediato, y la falta de justificación económica).'],
        ]
    ],
    [
        'titulo' => 'CASO PRÁCTICO N° 5: DONACIONES SOSPECHOSAS (Financiamiento del Terrorismo)',
        'escenario' => 'Se crea una ONG llamada “Ayuda para Todos”. Recibe donaciones en efectivo de pequeños comercios. El dinero se retira en efectivo y se entrega a miembros de un grupo radical investigado por promover actos violentos. El líder de la organización viaja constantemente a zonas fronterizas sin justificación clara.',
        'preguntas' => [
            ['id' => 'p5_1', 'texto' => '1. ¿Qué delito podría estar financiando esta organización?', 'respuesta_clave' => 'Financiamiento del Terrorismo (FT).'],
            ['id' => 'p5_2', 'texto' => '2. ¿Por qué el uso de una ONG facilita el movimiento del dinero?', 'respuesta_clave' => 'Las ONG/OSFL ofrecen una fachada de legitimidad (programas sociales) para recibir y mover fondos con menos sospecha, especialmente en la fase de Movilización/Colecta.'],
            ['id' => 'p5_3', 'texto' => '3. ¿Qué controles deberían reforzar los bancos para evitar este tipo de financiamiento?', 'respuesta_clave' => 'Monitoreo estricto de las transacciones de OSFL, verificando la coherencia entre sus actividades declaradas y los retiros/transferencias inusuales (especialmente a zonas de riesgo).'],
        ]
    ],
];
// Codificar los datos para que JavaScript los pueda usar
$casos_json = json_encode($casos_laft);
// --- FIN DE DATOS ---
?>

<h1 class="text-center mb-5 text-danger">Casos Prácticos: Lavado de Activos y FT </h1>
<p class="text-center lead">Analiza el escenario, responde a las preguntas y compara tu análisis con las respuestas clave.</p>

<div id="casos-container">
    <?php foreach ($casos_laft as $index => $caso): ?>
        <div class="card mb-4 shadow-lg caso-card" data-caso-id="<?php echo $index; ?>">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0"><?php echo $caso['titulo']; ?></h4>
            </div>
            <div class="card-body">
                <p class="fw-bold">Escenario:</p>
                <div class="alert alert-light border-start border-danger border-5 p-3"><?php echo $caso['escenario']; ?></div>
                
                <p class="fw-bold mt-4">Analiza y Responde:</p>
                <form id="form-caso-<?php echo $index; ?>" class="caso-form">
                    <?php foreach ($caso['preguntas'] as $p_index => $pregunta): ?>
                        <div class="mb-3">
                            <label for="<?php echo $pregunta['id']; ?>" class="form-label fw-bold">
                                <?php echo $pregunta['texto']; ?>
                            </label>
                            <textarea class="form-control" id="<?php echo $pregunta['id']; ?>" name="<?php echo $pregunta['id']; ?>" rows="2" placeholder="Escribe tu análisis, indicando la señal de alerta o la acción a tomar..."></textarea>
                        </div>
                    <?php endforeach; ?>
                    <button type="button" class="btn btn-danger btn-evaluar" data-caso-index="<?php echo $index; ?>">Evaluar mi Análisis</button>
                </form>

                <div id="feedback-<?php echo $index; ?>" class="mt-4 feedback-area" style="display: none;">
                    <h5 class="text-info">Resultados y Puntos Clave:</h5>
                    <ul class="list-group">
                        </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    const casosData = <?php echo $casos_json; ?>;
</script>

<?php include 'includes/footer.php'; ?>