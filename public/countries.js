
function loadList()
{
    ajax("./api.php?module=countries&action=list", "GET", function(response) {

        document.getElementById("countries-list-wrapper").innerHTML = HtmlPrinter.CountriesTable(response);
    });
    
}

function ajax(url, method, callback)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback(JSON.parse(this.responseText));
    }};
    
    xhttp.open(method, url, true);
    xhttp.send();
}