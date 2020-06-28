
function loadList()
{
    let wrapperEl = document.getElementById("countries-list-wrapper");
    wrapperEl.innerHTML = `<img src="public/imgs/loading.gif">`;

    let url = "./api.php?module=countries&action=list";


    // Filtering
    let nameFilter = Utils.getById("filterName").value;
    let dateFromFilter = Utils.getById("filterDateFrom").value;
    let dateToFilter = Utils.getById("filterDateTo").value;

    if (!Utils.isEmptyOrWhitespace(nameFilter))
        url += `&name=${nameFilter}`;
    if (!Utils.isEmptyOrWhitespace(dateFromFilter))
        url += `&dateFrom=${dateFromFilter}`;
    if (!Utils.isEmptyOrWhitespace(dateToFilter))
        url += `&dateTo=${dateToFilter}`;

    // Sorting


    // Pagination


    Utils.ajax(url, "GET", function(response) {

        document.getElementById("countries-list-wrapper").innerHTML = HtmlPrinter.CountriesListTable(response);
    });
    
}

