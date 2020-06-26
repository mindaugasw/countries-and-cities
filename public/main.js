// --- DELETE CONFIRMATION ---
function showConfirmDialog(message, link) {
    var r = confirm(message);
    if (r === true) {
        window.location.replace(link);
    }
    // TODO change to POST request

}