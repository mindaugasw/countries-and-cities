/**
 * Class for storing long HTML snippets
 */
class HtmlPrinter
{
    /**
     * Generates HTML for countries/cities list table
     * 
     * @param {*} areas Countries or Cities array
     * @param {boolean} countriesData Should be true if countries data passed. False otherwise (cities data passed).
     */
    static AreasListTable(areas, countriesData)
    {
        let html =
`<span style="font-style: italic; color: #888888">Click on table headers to sort items</span>
<table class="table table-striped table-hover table-sm table-list">
    <thead>
        <tr>`

        let headersList = // Format: ['real_field_name', 'nice text for printing']
        [
            ['id', 'ID'],
            ['name', 'Name'],
            ['area', 'Area'],
            ['population', 'Population'],
            countriesData ? ['phone_code', 'Phone code'] : ['zip_code', 'ZIP code'],
            ['added_at', 'Added at'],
        ];

        headersList.forEach(h => {
            html += `<th><a href="javascript:Area.Sort('${h[0]}')" data-field-name="${h[0]}" class="sort-th">${h[1]}`;
            
            if (h[0] === Area.currentSortField)
                html += Area.currentSortAsc ? ' ▲' : ' ▼';
            
            html += `</a></th>`;
        });
        html += `<th>Actions</th>`
        html += `</tr></thead><tbody>`;

        areas.forEach(c => {
            html += 
        `<tr>
            <td>${c.id}</td>
            <td><a href="${c.viewLink}">${c.name}</a></td>
            <td>${c.areaNice}</td>
            <td>${c.populationNice}</td>
            <td>${countriesData ? '+'+c.phone_code : c.zip_code}</td>
            <td>${c.added_at}</td>
            <td>
                <a href="${c.viewLink}">View</a> |
                <a href="${c.editLink}">Edit</a> |
                <a href="javascript:Utils.AreaDeleteConfirm('${c.deleteLink}', '${c.name}')">Delete</a>
            </td>
        </tr>`
        });

        html += `</tbody></table><div id="pagination-wrapper"></div>`;
        return html;
    }

    /**
     * Generates HTML for pagination links
     * @param {*} pages Page objects array
     */
    static Pagination(pages)
    {
        let html =
`<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">`

        pages.forEach(p => {
            html += `<li class="page-item ${p.active ? 'active' : ''}">
                <a class="page-link" href="javascript:Area.Page(${p.number})">${p.name}</a></li>`;
        });
        
        html += `</ul></nav>`;

        return html;
    }

    /**
     * Generates HTML for loading icon
     */
    static Loading()
    {
        return `<div class="loading-wrapper"><img src="public/imgs/loading.gif"></div>`;
    }

    /**
     * Generate HTML for toast message
     * 
     * @param {string} type Message flavor (color), one of the following: primary, secondary, success,
     *                      danger, warning, info, light, dark.
     * @param {string} message Message text
     */
    static ToastMessage(type, message)
    {
        let html = 
`<div class='alert alert-${type} alert-dismissible fade show' role='alert'>
    <div>${message}</div>
    <div>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
</div>`;
        return html;
    }
}
                  