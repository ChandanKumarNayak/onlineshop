// Filter search
$('#Search').on('keyup', function (e) {
    var value = $(this).val();
    var spacesAndDashes = /\s|-/g;
    value = value.replace(spacesAndDashes, "");
    var patt = new RegExp(value, "i");
    var sw = 0;
    var counter = 0;
    $('#Data tbody').find('tr').each(function () {
        counter++;
        if (!($(this).find('td').text().replace(spacesAndDashes, "").search(patt) >= 0)) {
            $(this).not('#header').hide();
            sw++;
        } else if (($(this).find('td').text().replace(spacesAndDashes, "").search(patt) >= 0)) {
            $(this).show();
        }
    });
})
