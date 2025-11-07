document.addEventListener('DOMContentLoaded', () => {
    // 1. Lógica para los Casos LA/FT (casos.php)
    document.querySelectorAll('.btn-evaluar').forEach(button => {
        button.addEventListener('click', function() {
            const casoIndex = this.getAttribute('data-caso-index');
            evaluarCaso(parseInt(casoIndex));
        });
    });

    // 2. Lógica para el Juego de Billetes Falsos (billetes.php)
    if (document.getElementById('juego-billetes')) {
        iniciarJuegoBilletes();
    }
    
    // 3. Lógica para el Juego de Gestión de Caja (caja.php)
    // Llama a la función principal si el elemento existe en el DOM
    if (document.getElementById('juego-caja')) {
        iniciarJuegoCaja();
    }
});

// ----------------------------------------------------------------------
// FUNCIÓN 1: CASOS LA/FT (casos.php) - Mantenida de tu código
// ----------------------------------------------------------------------

function evaluarCaso(casoIndex) {
    // Asegúrate de que la variable casosData (definida en casos.php) esté accesible
    if (typeof casosData === 'undefined' || !casosData[casoIndex]) {
        console.error('Datos del caso no encontrados.');
        return;
    }

    const caso = casosData[casoIndex];
    const feedbackArea = document.getElementById(`feedback-${casoIndex}`);
    const feedbackList = feedbackArea.querySelector('ul');

    // Limpiar feedback previo
    feedbackList.innerHTML = '';
    
    // Recorrer las preguntas para mostrar el resultado
    caso.preguntas.forEach(pregunta => {
        const userInput = document.getElementById(pregunta.id).value.trim();
        const clave = pregunta.respuesta_clave;
        
        let feedbackHTML = `<li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">${pregunta.texto}</div>`;
        
        if (userInput.length > 5) { // Suponemos que si escribió algo (más de 5 caracteres), lo intentó
            feedbackHTML += `<span class="badge bg-success me-2">Tu Respuesta Analizada:</span> ${userInput.substring(0, 100)}...<br>`;
        } else {
            // Si no respondió, se le indica que debe hacerlo
            feedbackHTML += `<span class="badge bg-warning me-2">No respondiste.</span>`;
        }
        
        // La respuesta clave (la que se debe aprender) siempre se muestra
        feedbackHTML += `<span class="badge bg-info mt-2">Respuesta Clave:</span> ${clave}`;
        feedbackHTML += `</div></li>`;

        feedbackList.innerHTML += feedbackHTML;
    });

    // Mostrar el área de feedback con una animación simple
    feedbackArea.style.display = 'block';
    feedbackArea.scrollIntoView({ behavior: 'smooth' });
}


// ----------------------------------------------------------------------
// FUNCIÓN 2: GESTIÓN Y ARQUEO DE CAJA (caja.php) - CÓDIGO AÑADIDO
// ----------------------------------------------------------------------

function iniciarJuegoCaja() {
    // Configuración del Escenario
    const FONDO_FIJO = 500.00;
    // Generar una venta aleatoria entre S/ 1,500 y S/ 3,000 para el desafío.
    // Usamos Math.round para números más "reales" sin tantos decimales.
    const VENTAS_SISTEMA = (Math.round((Math.random() * 1500 + 1500) * 100) / 100).toFixed(2); 
    const ESPERADO = (parseFloat(FONDO_FIJO) + parseFloat(VENTAS_SISTEMA)).toFixed(2);

    const inputs = document.querySelectorAll('.count-input');
    const btnCalcular = document.getElementById('btn-calcular');
    const btnVerificar = document.getElementById('btn-verificar');
    const btnReiniciar = document.getElementById('btn-reiniciar');
    const resultadoDiv = document.getElementById('resultado-arqueo');
    
    let totalContado = 0;

    // 1. Mostrar valores iniciales del escenario
    document.getElementById('ventas-sistema-display').textContent = `S/ ${VENTAS_SISTEMA}`;
    document.getElementById('esperado-display').textContent = `S/ ${ESPERADO}`;

    // 2. Función de cálculo de subtotales
    const calcularTotales = () => {
        totalContado = 0;
        inputs.forEach(input => {
            // Asegura que el valor sea un número entero no negativo
            const cantidad = Math.max(0, parseInt(input.value) || 0);
            input.value = cantidad; // Fuerza el valor en el input a ser válido
            
            // Usamos parseFloat para manejar denominaciones con decimales (0.5, 0.2)
            const valor = parseFloat(input.getAttribute('data-valor'));
            // Usamos redondeo para evitar problemas de precisión en JS
            const subtotal = (Math.round((cantidad * valor) * 100) / 100).toFixed(2);
            
            // Actualizar el subtotal en la tabla
            document.getElementById(`s${input.id.substring(1)}`).textContent = `S/ ${subtotal}`;
            
            totalContado += parseFloat(subtotal);
        });
        
        // Mostrar el total contado y habilitar la verificación
        document.getElementById('total-contado-display').textContent = `S/ ${totalContado.toFixed(2)}`;
        btnVerificar.disabled = totalContado === 0; // Deshabilitar si no hay conteo
    };

    // 3. Función de verificación del arqueo
    const verificarArqueo = () => {
        // Redondeamos la diferencia a 2 decimales para la comparación
        const diferencia = (Math.round((totalContado - parseFloat(ESPERADO)) * 100) / 100).toFixed(2);
        
        resultadoDiv.style.display = 'block';
        resultadoDiv.innerHTML = `<h4>Resultado de tu Arqueo</h4>`;
        
        // Limpiar clases de alerta
        resultadoDiv.classList.remove('alert-success', 'alert-danger', 'alert-warning');
        
        if (diferencia == 0) { // Cuadre Perfecto
            resultadoDiv.classList.add('alert-success');
            resultadoDiv.innerHTML += `<p class="fs-4">✅ ¡CAJA CUADRADA! Diferencia: S/ ${diferencia}. ¡Excelente gestión!</p>`;
        } else if (diferencia > 0) { // Sobrante
            resultadoDiv.classList.add('alert-warning');
            resultadoDiv.innerHTML += `<p class="fs-4">⚠️ ¡SOBRANTE de S/ ${diferencia}! Revisa tu conteo y tus registros.</p>`;
        } else { // Faltante
            resultadoDiv.classList.add('alert-danger');
            resultadoDiv.innerHTML += `<p class="fs-4">❌ ¡FALTANTE de S/ ${Math.abs(diferencia).toFixed(2)}! Revisa urgentemente.</p>`;
        }
        
        // Desactivar botones de acción después de la verificación
        btnCalcular.disabled = true;
        btnVerificar.disabled = true;
        
        // Scroll al resultado
        resultadoDiv.scrollIntoView({ behavior: 'smooth' });
    };

    // 4. Función de reinicio
    const reiniciarJuego = () => {
        // Reiniciar todos los inputs a cero
        inputs.forEach(input => input.value = '0');
        
        resultadoDiv.style.display = 'none';
        resultadoDiv.className = 'mt-5 p-4 rounded text-center shadow'; // Limpiar clases
        
        btnCalcular.disabled = false;
        btnVerificar.disabled = true;
        
        // Reiniciar escenario (se llama a sí misma para generar nuevos valores de VENTAS_SISTEMA)
        iniciarJuegoCaja(); 
    };

    // 5. Asignar Event Listeners
    // Calcular automáticamente al cambiar el input
    inputs.forEach(input => input.addEventListener('input', calcularTotales));
    
    // Botón de cálculo manual (opcional, pero útil)
    btnCalcular.addEventListener('click', calcularTotales); 
    
    // Botón de verificación
    btnVerificar.addEventListener('click', verificarArqueo);
    
    // Botón de reinicio
    btnReiniciar.addEventListener('click', reiniciarJuego);

    // Primera ejecución para mostrar el escenario y valores iniciales (cero)
    calcularTotales(); 
}


// ----------------------------------------------------------------------
// FUNCIÓN 3: BILLETES FALSOS (billetes.php) - CÓDIGO COMPLETO
// ----------------------------------------------------------------------

// Datos del juego: Posiciones de las 5 medidas de seguridad (ejemplo)
const medidasDeSeguridad = [
    { id: 1, nombre: "Marca de Agua", top: '20%', left: '10%', encontrado: false, explicacion: "El diseño de la Marca de Agua es visible al trasluz y tiene diferentes tonalidades." },
    { id: 2, nombre: "Hilo de Seguridad (Ventana)", top: '40%', left: '80%', encontrado: false, explicacion: "El hilo es segmentado y debe verse como una línea continua al trasluz, y tiene movimiento." },
    { id: 3, nombre: "Tinta que Cambia de Color (Óptica)", top: '75%', left: '60%', encontrado: false, explicacion: "Al inclinar el billete, el color de la tinta debe cambiar (ej. de verde a azul)." },
    { id: 4, nombre: "Registro Perfecto (Anverso/Reverso)", top: '25%', left: '45%', encontrado: false, explicacion: "Los elementos impresos en el anverso y reverso se complementan perfectamente al verlos a contraluz." },
    { id: 5, nombre: "Microimpresiones y Relieve", top: '85%', left: '15%', encontrado: false, explicacion: "El retrato y algunas zonas tienen relieve perceptible al tacto (microimpresiones legibles con lupa)." },
];

let medidasEncontradas = 0;
const totalMedidas = medidasDeSeguridad.length;
let billeteContenedor;
let progresoDisplay;
let feedbackArea;
let btnReiniciar;

/**
 * Función para inicializar y gestionar la lógica del Juego de Billetes Falsos.
 */
function iniciarJuegoBilletes() {
    billeteContenedor = document.getElementById('billete-contenedor');
    progresoDisplay = document.getElementById('progreso-display');
    feedbackArea = document.getElementById('feedback-billetes');
    btnReiniciar = document.getElementById('btn-reiniciar-billetes');

    // Limpiar y resetear el estado
    medidasEncontradas = 0;
    progresoDisplay.textContent = `${medidasEncontradas}/${totalMedidas}`;
    feedbackArea.innerHTML = '';
    btnReiniciar.style.display = 'none';

    // Resetear el estado de cada medida
    medidasDeSeguridad.forEach(medida => medida.encontrado = false);

    // Generar y posicionar los botones clickeables
    renderMedidas();

    // Evento para reiniciar
    btnReiniciar.addEventListener('click', iniciarJuegoBilletes);
}

/**
 * Renderiza los botones interactivos sobre la imagen del billete.
 */
function renderMedidas() {
    // Eliminar botones anteriores para el reinicio
    billeteContenedor.querySelectorAll('.medida-btn').forEach(btn => btn.remove());

    medidasDeSeguridad.forEach(medida => {
        const button = document.createElement('button');
        button.className = 'medida-btn btn btn-sm btn-info position-absolute rounded-circle p-2 shadow';
        button.style.top = medida.top;
        button.style.left = medida.left;
        button.style.transform = 'translate(-50%, -50%)'; // Centrar el botón en el punto
        button.title = `Clic para verificar: ${medida.nombre}`;
        button.innerHTML = '🔍'; // Ícono de lupa o punto
        button.dataset.id = medida.id;

        // Si ya fue encontrado, cambiar estilo y deshabilitar
        if (medida.encontrado) {
            button.classList.replace('btn-info', 'btn-success');
            button.innerHTML = '✅';
            button.disabled = true;
        }

        // Asignar el evento click
        button.addEventListener('click', verificarMedida);

        billeteContenedor.appendChild(button);
    });
}

/**
 * Función que se ejecuta al hacer clic en un punto de seguridad.
 * @param {Event} event - El evento de click.
 */
function verificarMedida(event) {
    const btn = event.currentTarget;
    const medidaId = parseInt(btn.dataset.id);
    const medida = medidasDeSeguridad.find(m => m.id === medidaId);

    if (medida && !medida.encontrado) {
        medida.encontrado = true;
        medidasEncontradas++;
        
        // Actualizar el botón
        btn.classList.replace('btn-info', 'btn-success');
        btn.innerHTML = '✅';
        btn.disabled = true;

        // Mostrar feedback
        const nuevoFeedbackHTML = `
        <div class="alert alert-success alert-sm shadow" role="alert" style="margin-bottom: 5px;">
            <strong>✅ ¡Correcto! ${medida.nombre} encontrada.</strong> <br> ${medida.explicacion}
        </div>
    `;
        
        // Actualizar progreso
        progresoDisplay.textContent = `${medidasEncontradas}/${totalMedidas}`;

        // Revisar si el juego terminó
        if (medidasEncontradas === totalMedidas) {
            finalizarJuego();
        }
    }
}

/**
 * Muestra el mensaje final y habilita el reinicio.
 */
function finalizarJuego() {
    feedbackArea.innerHTML = `
        <div class="alert alert-warning text-center fs-5 shadow">
            <strong>¡FELICIDADES! 🎉</strong> Has identificado las ${totalMedidas} medidas de seguridad. ¡Estás listo para evitar fraudes!
        </div>
    ` + feedbackArea.innerHTML;
    
    // Deshabilitar botones restantes (aunque deberían estar todos en verde)
    billeteContenedor.querySelectorAll('.medida-btn').forEach(btn => btn.disabled = true);
    
    btnReiniciar.style.display = 'block';
}