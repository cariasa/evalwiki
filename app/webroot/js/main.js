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
        wrongFileType : 'El archivo que trata de subir es del formato incorrecto',
        badStartDate : 'La fecha de inicio debe de ser anterior a la fecha final'
    };

    $.formUtils.addValidator({
      name : 'end_date',
      validatorFunction : function(value, $el, config, language, $form) {
        var endDate = value.split("-");
        var startDate = $('#StartDate').val().split("-");

        if (new Date(startDate[0], startDate[1] - 1, startDate[2]) < new Date(endDate[0], endDate[1] - 1, endDate[2])) {
            return true;
        }

        return false;
      },
      errorMessage : 'La fecha de inicio debe de ser anterior a la fecha final',
      errorMessageKey: 'badStartDate'
    });

    $.formUtils.addValidator({
      name : 'sum_percent',
      validatorFunction : function(value, $el, config, language, $form) {
        consonsole.log($('#contentW').val() + $('#presentationW').val());
      },
      errorMessage : 'Los porcentajes deben sumar 100%',
      errorMessageKey: 'badSumPercent'
    });

    $.validate({
        language: spanishMessages,
        decimalSeparator: '.'
    });

    $('.calendar').datepicker().on('changeDate', function(ev) {
        $('.calendar').trigger('blur');
    });

    $('.confirmation').on('click', function() {
        return confirm('¿Está seguro?');
    });

    $('#PeriodSemester').on('change', function(e) {
        if ($(this).val() == 1) {
            $('#PeriodPeriod').empty();
            $('#PeriodPeriod').html('<option value="1">Primer Periodo</option><option value="2">Segundo Periodo</option>');
        } else {
            $('#PeriodPeriod').empty();
            $('#PeriodPeriod').html('<option value="4">Tercer Periodo</option><option value="5">Cuarto Periodo</option>');
        }
    });

    $('#consistency-algorihtm').on('change', function(e) {
        if ($(this).val() == 1) {
            $('#max-participation').attr('disabled','disabled');
        } else {
            $('#max-participation').removeAttr('disabled');
        }
    });

    $('.dates-or-range').on('change', function(e) {
        if ($(this).val() == 'periods') {
            $('#period-selector').removeAttr('disabled');
            $('.dates-rage').attr('disabled','disabled');
        } else {
            $('#period-selector').attr('disabled','disabled');
            $('.dates-rage').removeAttr('disabled');
        }
    });
    $('.dates-or-range').trigger('change');
});