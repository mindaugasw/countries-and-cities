<div class="input-group">

    <input type='text' class='form-control' id="filterName" placeholder="Filter by name"
    data-toggle="tooltip" data-placement="bottom" title="Filter areas by their name">

    <input type='date' class='form-control' id="filterDateFrom"
    data-toggle="tooltip" data-placement="bottom" title="Show only areas added on or after this date">

    <input type='date' class='form-control' id="filterDateTo"
    data-toggle="tooltip" data-placement="bottom" title="Show only areas added on or before this date">

    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" onclick="Area.UpdateFilters()">Filter</button>
    </div>

    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" onclick="Area.ClearFilters()"
        data-toggle="tooltip" data-placement="bottom" title="Clear filters">X</button>
    </div>
</div>
<br>