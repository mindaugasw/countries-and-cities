class Countries
{
    static currentSortField = 'name';
    static currentSortAsc = true;
    static pageNum = -1;
    
    static updateList()
    {
        let wrapperEl = document.getElementById("countries-list-wrapper");
        wrapperEl.innerHTML = HtmlPrinter.Loading();

        let url = "./api.php?module=countries&action=list";


        // Filtering
        let nameFilter = Utils.getElement("#filterName").value;
        let dateFromFilter = Utils.getElement("#filterDateFrom").value;
        let dateToFilter = Utils.getElement("#filterDateTo").value;

        if (!Utils.isEmptyOrWhitespace(nameFilter))
            url += `&name=${nameFilter}`;
        if (!Utils.isEmptyOrWhitespace(dateFromFilter))
            url += `&dateFrom=${dateFromFilter}`;
        if (!Utils.isEmptyOrWhitespace(dateToFilter))
            url += `&dateTo=${dateToFilter}`;

        // Sorting
        url += `&sort=${Countries.currentSortField}&sortAsc=${Countries.currentSortAsc}`;

        // Pagination
        if (Countries.pageNum !== -1)
            url += `&page=${Countries.pageNum}`;

        Utils.ajax(url, "GET", function(response) {
            Utils.getElement("#countries-list-wrapper").innerHTML = HtmlPrinter.CountriesListTable(response.items);
            Utils.getElement("#pagination-wrapper").innerHTML = HtmlPrinter.Pagination(response.pages);
        });
    }

    /**
     * Updates sorting information ant then triggers list update.
     */
    static sort(field)
    {
        if (field === Countries.currentSortField)
        {
            Countries.currentSortAsc = !Countries.currentSortAsc;
        }
        else
        {
            Countries.currentSortField = field;
            Countries.currentSortAsc = true;
        }
        Countries.pageNum = 1;

        Countries.updateList();
    }

    static page(newPage)
    {
        Countries.pageNum = newPage;
        Countries.updateList();
    }
}