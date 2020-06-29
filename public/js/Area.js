/**
 * Various methods for country/city lists handling
 */
class Area
{
    static module = '-'; // 'countries' or 'cities'. Module is set by inline script on country/city list views.
    static country_id = '-'; // used for cities list. Set by inline script on city list view.

    static currentSortField = 'name';
    static currentSortAsc = true;
    static pageNum = -1;
    
    /**
     * Fetches data from the server and updates countries/cities list.
     * Takes into account filtering data, sorting, and pagination.
     */
    static UpdateList()
    {
        let wrapperEl = document.getElementById("areas-list-wrapper");
        wrapperEl.innerHTML = HtmlPrinter.Loading();

        let url = `./api.php?module=${Area.module}&action=list`;

        // Filtering
        let nameFilter = Utils.GetElement("#filterName").value;
        let dateFromFilter = Utils.GetElement("#filterDateFrom").value;
        let dateToFilter = Utils.GetElement("#filterDateTo").value;

        if (!Utils.IsEmptyOrWhitespace(nameFilter))
            url += `&name=${nameFilter}`;
        if (!Utils.IsEmptyOrWhitespace(dateFromFilter))
            url += `&dateFrom=${dateFromFilter}`;
        if (!Utils.IsEmptyOrWhitespace(dateToFilter))
            url += `&dateTo=${dateToFilter}`;

        // Sorting
        url += `&sort=${Area.currentSortField}&sortAsc=${Area.currentSortAsc}`;

        // Pagination
        if (Area.pageNum !== -1)
            url += `&page=${Area.pageNum}`;

        if (Area.module === 'cities')
            url += `&id=${Area.country_id}`;

        Utils.Ajax(url, "GET", function(response) {
            Utils.GetElement("#areas-list-wrapper").innerHTML = HtmlPrinter.AreasListTable(response.items, 
                Area.module === 'countries' ? true : false);
            Utils.GetElement("#pagination-wrapper").innerHTML = HtmlPrinter.Pagination(response.pages);
        });
    }

    /**
     * Resets page number and updates list (filters actually update every time in UpdateList method)
     */
    static UpdateFilters()
    {
        Area.pageNum = 1;
        Area.UpdateList();
    }

    /**
     * Updates sorting information ant then triggers list update.
     */
    static Sort(field)
    {
        if (field === Area.currentSortField)
        {
            Area.currentSortAsc = !Area.currentSortAsc;
        }
        else
        {
            Area.currentSortField = field;
            Area.currentSortAsc = true;
        }
        Area.pageNum = 1;

        Area.UpdateList();
    }

    /**
     * Loads new page
     */
    static Page(newPage)
    {
        Area.pageNum = newPage;
        Area.UpdateList();
    }

    /**
     * Clears all filters and updates list
     */
    static ClearFilters()
    {
        Utils.GetElement('#filterName').value = '';
        Utils.GetElement('#filterDateFrom').value = '';
        Utils.GetElement('#filterDateTo').value = '';
        Area.UpdateList();
    }
}