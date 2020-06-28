class HtmlPrinter
{
    static CountriesListTable(countries)
    {
        let html =
`<table class="table table-striped table-hover table-list">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Area</th>
            <th>Population</th>
            <th>Phone code</th>
            <th>Added at</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>`;

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

        html += `</tbody></table>`;
        return html;
    }


}