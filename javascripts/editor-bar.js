//


function _insertAtCaret(element, text) {
    var caretPos = element[0].selectionStart,
        currentValue = element.val();

    element.val(currentValue.substring(0, caretPos) + text + currentValue.substring(caretPos));
return false;
}

$('#btn').on('click', function () {
    _insertAtCaret($('#txt'), "sum test");
});
$('#wiki').on('click', function () {
    _insertAtCaret($('#txt'), "[[ { ** wiki )]}");
});
