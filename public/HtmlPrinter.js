class HtmlPrinter
{
    static CountriesListTable(countries)
    {
        let html =
`<span style="font-style: italic; color: #888888">Click on table headers to sort items</span>
<table class="table table-striped table-hover table-list">
    <thead>
        <tr>`

        let headersList = // ['field name', 'nice text for printing']
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


            // <th><a href="javascript:Countries.sort('id')" class="sort-th">ID</a></th>
            // <th><a href="javascript:Countries.sort('name')" class="sort-th">Name</a></th>
            // <th><a href="javascript:Countries.sort('area')" class="sort-th">Area</a></th>
            // <th><a href="javascript:Countries.sort('population')" class="sort-th">Population</a></th>
            // <th><a href="javascript:Countries.sort('phone_code')" class="sort-th">Phone code</a></th>
            // <th><a href="javascript:Countries.sort('added_at')">Added at</a></th>
            // <th>Actions</th>

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

        // Add sorting indicator (triangle)
        // let headerElements = Utils.getElement('.sort-th');
        // headerElements.forEach(el => {
        //     if (el.getElement('data-field-name') === Countries.currentSortField)
        //     {
        //         el.innerHTML += Countries.currentSortAsc ? ' ▲' : ' ▼';
        //     }
        // });

        html += `</tbody></table>`;
        return html;
    }


}