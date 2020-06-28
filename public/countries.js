class Countries
{
    static currentSortField = 'name';
    static currentSortAsc = true;

    static updateList()
    {
        let wrapperEl = document.getElementById("countries-list-wrapper");
        wrapperEl.innerHTML = `<img src="public/imgs/loading.gif">`;

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


        Utils.ajax(url, "GET", function(response) {
            document.getElementById("countries-list-wrapper").innerHTML = HtmlPrinter.CountriesListTable(response);
        });
    }

    static sort(field)
    {
        if (field === this.currentSortField)
        {
            this.currentSortAsc = !this.currentSortAsc;
        }
        else
        {
            this.currentSortField = field;
            this.currentSortAsc = true;
        }

        this.updateList();
        // alert(this.currentSortField + ' ' + this.currentSortAsc);
    }
}