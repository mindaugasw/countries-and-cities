$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// --- DELETE CONFIRMATION ---
function showConfirmDialog(message, link) {
    var r = confirm(message);
    if (r === true) {
        // window.location.replace(link);
        postRequest(link);
    }
    // TODO change to POST request

}

function postRequest(link)
{
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = link;
    document.body.appendChild(form);
    form.submit();
}