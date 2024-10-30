
function fnToogleSeeKey( numDiv ){

    $('#GridView'+numDiv).toggle('slow', function() {
        $('#GridViewExport'+numDiv).toggle('slow');
        if($(this).is(':hidden')) {
            $('#BtnGridView'+numDiv).html(' Ver + ');
        }
        else {
            $('#BtnGridView'+numDiv).html(' Ver - ');
        }
    });
}
