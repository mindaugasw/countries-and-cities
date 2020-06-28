class HtmlPrinter
{
    static CountriesListTable(countries)
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
            ['phone_code', 'Phone code'],
            ['added_at', 'Added at'],
        ];

        headersList.forEach(h => {
            html += `<th><a href="javascript:Countries.sort('${h[0]}')" data-field-name="${h[0]}" class="sort-th">${h[1]}`;
            
            if (h[0] === Countries.currentSortField)
                html += Countries.currentSortAsc ? ' ▲' : ' ▼';
            
            html += `</a></th>`;
        });
        html += `<th>Actions</th>`
        html += `</tr></thead><tbody>`;

        countries.forEach(c => { // c for country
            html += 
        `<tr>
            <td>${c.id}</td>
            <td><a href="${c.viewLink}">${c.name}</a></td>
            <td>${c.areaNice}</td>
            <td>${c.populationNice}</td>
            <td>+${c.phone_code}</td>
            <td>${c.added_at}</td>
            <td>
                <a href="${c.viewLink}">View</a> |
                <a href="${c.editLink}">Edit</a> |
                <a href="${c.deleteLink}">Delete</a>
            </td>
        </tr>`
        });

        html += `</tbody></table><div id="pagination-wrapper"></div>`;
        return html;
    }

    static Pagination(pages)
    {
        let html =
`<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">`

        pages.forEach(p => {
            html += `<li class="page-item ${p.active ? 'active' : ''}">
                <a class="page-link" href="javascript:Countries.page(${p.number})">${p.name}</a></li>`;
        });
        
        html += `</ul></nav>`;

        return html;
    }

    static Loading()
    {
        return `<div class="loading-wrapper"><img src="public/imgs/loading.gif"></div>`;
    }
}