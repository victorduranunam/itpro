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
        enviarBtn.parentNode.insertBefore(errorDiv, enviarBtn);
    }

    // Inputs y archivos
    const foto = document.getElementById('foto');
    const nombre = document.getElementById('nombre');
    const apellidoPaterno = document.getElementById('apellido_paterno');
    const apellidoMaterno = document.getElementById('apellido_materno');
    const rfc = form.querySelector('input[name="rfc"]');
    const email = document.getElementById('email');
    const numeroCuenta = document.getElementById('numero_cuenta');
    const telefono = document.getElementById('telefono');
    const celular = document.getElementById('celular');
    const promedio = document.getElementById('promedio_registro');
    const acuerdo = document.getElementById('acuerdo');
    const historial = document.getElementById('historial');

    // Regex RFC actualizado: acepta 10 o 13 caracteres
    const rfcRegex = /^([A-ZÑ&]{3,4})(\d{2})(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])([A-Z\d]{0,3})$/i;

    function validarCampos() {
        const errores = [];

        // FOTO
        if (!foto.files.length) {
            errores.push("Debes subir una fotografía.");
        } else {
            const fileFoto = foto.files[0];
            const maxFoto = 2 * 1024 * 1024; // 2MB
            const allowedImg = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
            const allowedExt = ["jpg","jpeg","png","gif"];
            const fileExt = fileFoto.name.split('.').pop().toLowerCase();
            if (!allowedImg.includes(fileFoto.type) || !allowedExt.includes(fileExt)) {
                errores.push("La foto debe ser JPG, JPEG, PNG o GIF.");
            }
            if (fileFoto.size > maxFoto) {
                errores.push("La foto no debe superar los 2 MB.");
            }
        }

        // HISTORIAL
        if (!historial.files.length) {
            errores.push("Debes subir tu historial académico.");
        } else {
            const fileHist = historial.files[0];
            const maxHist = 2 * 1024 * 1024; // 2MB
            const allowedHist = ["application/pdf"];
            const fileExtHist = fileHist.name.split('.').pop().toLowerCase();
            if (!allowedHist.includes(fileHist.type) || fileExtHist !== "pdf") {
                errores.push("El historial debe ser un archivo PDF.");
            }
            if (fileHist.size > maxHist) {
                errores.push("El historial no debe superar los 2 MB.");
            }
        }

        // Campos de texto obligatorios
        if (!nombre.value.trim()) errores.push("El campo Nombre es obligatorio.");
        if (!apellidoPaterno.value.trim()) errores.push("El Apellido Paterno es obligatorio.");

        // RFC
        const rfcValue = rfc.value.trim();
        if (!rfcValue) {
            errores.push("El RFC es obligatorio.");
        } else if (!rfcRegex.test(rfcValue)) {
            errores.push("El RFC tiene formato inválido. Debe ser de 10 o 13 caracteres según corresponda.");
        }

        // Email
        const emailValue = email.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailValue) errores.push("El Correo electrónico es obligatorio.");
        else if (!emailRegex.test(emailValue)) errores.push("El Correo electrónico tiene formato inválido.");

        // Número de cuenta
        const cuentaValue = numeroCuenta.value.trim();
        if (!cuentaValue) errores.push("El Número de cuenta es obligatorio.");
        else if (!/^\d{9}$/.test(cuentaValue)) errores.push("El Número de cuenta debe tener 9 dígitos.");

        // Teléfono y celular opcionales
        const telValue = telefono.value.trim();
        if (telValue && !/^\d{10,}$/.test(telValue)) errores.push("El Teléfono debe tener al menos 10 dígitos.");

        const celValue = celular.value.trim();
        if (celValue && !/^\d{10,}$/.test(celValue)) errores.push("El Celular debe tener al menos 10 dígitos.");

        // Promedio
        const promedioValue = parseFloat(promedio.value.trim());
        if (isNaN(promedioValue)) errores.push("El Promedio debe ser un número.");
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
