document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registroPrebes');
    const enviarBtn = document.getElementById('enviar');

    // Crear div de errores dinámicamente si no existe
    let errorDiv = document.getElementById('erroresForm');
    if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.id = 'erroresForm';
        errorDiv.className = 'alert alert-danger';
        errorDiv.style.display = 'none';
        enviarBtn.parentNode.insertBefore(errorDiv, enviarBtn); // sobre el botón
    }

    // Inputs y archivos
    const foto = document.getElementById('foto');
    const nombre = document.getElementById('nombre');
    const apellidoPaterno = document.getElementById('apellido_paterno');
    const rfc = form.querySelector('input[name="rfc"]');
    const email = document.getElementById('email');
    const numeroCuenta = document.getElementById('numero_cuenta');
    const telefono = document.getElementById('telefono');
    const celular = document.getElementById('celular');
    const promedio = document.getElementById('promedio_registro');
    const acuerdo = document.getElementById('acuerdo');
    const historial = document.getElementById('historial');

    function validarCampos() {
        const errores = [];

        // Archivos
        if (!foto.files.length) errores.push("Debes subir una fotograf&iacute;a.");
        if (!historial.files.length) errores.push("Debes subir tu historial acad&eacute;mico.");

        // Campos de texto
        if (!nombre.value.trim()) errores.push("El campo Nombre es obligatorio.");
        if (!apellidoPaterno.value.trim()) errores.push("El Apellido Paterno es obligatorio.");

        // RFC
        const rfcValue = rfc.value.trim();
        if (!rfcValue) errores.push("El RFC es obligatorio.");
        else if (rfcValue.length < 10 || rfcValue.length > 13) errores.push("El RFC debe tener entre 10 y 13 caracteres.");

        // Email
        const emailValue = email.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailValue) errores.push("El Correo electr&oacute;nico es obligatorio.");
        else if (!emailRegex.test(emailValue)) errores.push("El Correo electr&oacute;nico tiene formato inv&aacute;lido.");

        // Número de cuenta
        const cuentaValue = numeroCuenta.value.trim();
        if (!cuentaValue) errores.push("El N&uacute;mero de cuenta es obligatorio.");
        else if (!/^\d{9}$/.test(cuentaValue)) errores.push("El N&uacute;mero de cuenta debe tener 9 d&iacute;gitos.");

        // Teléfono y celular (opcional)
        const telValue = telefono.value.trim();
        if (telValue && !/^\d{10,}$/.test(telValue)) errores.push("El Tel&eacute;fono debe tener al menos 10 d&iacute;gitos.");

        const celValue = celular.value.trim();
        if (celValue && !/^\d{10,}$/.test(celValue)) errores.push("El Celular debe tener al menos 10 d&iacute;gitos.");

        // Promedio
        const promedioValue = parseFloat(promedio.value.trim());
        if (isNaN(promedioValue)) errores.push("El Promedio debe ser un n&uacute;mero.");
        else if (promedioValue < 0 || promedioValue > 10) errores.push("El Promedio debe estar entre 0 y 10.");

        // Acuerdo
        if (!acuerdo.checked) errores.push("Debes aceptar el Aviso de Privacidad.");

        return errores;
    }


form.addEventListener('submit', function (e) {
    e.preventDefault(); // evitar envío antes de validar

    const errores = validarCampos();

    if (errores.length > 0) {
        errorDiv.innerHTML = "<ul><li>" + errores.join("</li><li>") + "</li></ul>";
        errorDiv.style.display = 'block';
        errorDiv.scrollIntoView({ behavior: "smooth", block: "center" });
    } else {
        errorDiv.style.display = 'none';
        form.submit(); // envía los archivos y los datos correctamente
    }
});


});
