
$(document).ready(function() {
    $('#intTipoId').on('change', function() {
        var selectedType = $(this).val();
        if (selectedType == 1) {
            $('#strDb, #strUser, #strPassword, #field-bd, #field-user, #field-password').hide();
            $('#strHost, #field-host').show();
        } else if (selectedType == 2) {
            $('#strDb, #field-bd').hide();
            $('#strHost, #strUser, #strPassword, #field-host, #field-user, #field-password').show();
        } else if (selectedType == 3) {
            $('#strHost, #strDb, #strUser, #strPassword, #field-host, #field-bd, #field-user, #field-password').show();
        }
    }).trigger('change');
});