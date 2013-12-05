$(document).ready(function() {
	var spanishMessages = {
        errorTitle : 'Eror al enviar la información',
        requiredFields : 'Es necesario llenar todos los campos requeridos',
        badTime : 'No ha proporcionado el tiempo correcto',
        badEmail : 'No ha escrito correctamente el correo',
        badTelephone : 'No ha escrito correctamente el número telefónico',
        badSecurityAnswer : 'No ha dado una respuesta correcta para la pregunta de seguridad',
        badDate : 'No ha proporcionado una fecha correcta',
        tooLongStart : 'Ha dado una respuesta mas larga de ',
        tooLongEnd : ' caracteres',
        tooShortStart : 'Ha dado una respuesta mas corta de ',
        tooShortEnd : ' caracteres',
        badLength : 'Su respuesta debe ser entre ',
        notConfirmed : 'Los valores no pudieron ser confirmados',
        badDomain : 'Dominio incorrecto',
        badUrl : 'No ha proporcionado una URL correcta',
        badCustomVal : 'Ha dado una respuesta incorrecta',
        badInt : 'Solamente ingrese números',
        badSecurityNumber : 'Número de seguro social incorrecto',
        badUKVatAnswer : 'Incorrect UK VAT Number',
        badStrength : 'Su contraseña es un corta',
        badNumberOfSelectedOptionsStart : 'Tienes que escoger al menos ',
        badNumberOfSelectedOptionsEnd : ' respuestas',
        badAlphaNumeric : 'Solamente ingrese números y letras ',
        badAlphaNumericExtra: ' y ',
        wrongFileSize : 'El archivo que trata de subir es demasiado grande',
        wrongFileType : 'El archivo que trata de subir es del formato incorrecto'
    };

    $.validate({
        language: spanishMessages
	});
});