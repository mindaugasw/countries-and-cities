<div class="input-group">

    <input type='text' class='form-control' id="filterName" placeholder="Filter by name"
    data-toggle="tooltip" data-placement="bottom" title="Filter countries by their name">

    <input type='date' class='form-control' id="filterDateFrom"
    data-toggle="tooltip" data-placement="bottom" title="Show only countries added on or after this date">

    <input type='date' class='form-control' id="filterDateTo"
    data-toggle="tooltip" data-placement="bottom" title="Show only countries added on or before this date">

    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="loadList()">Filter</button>
  </div>
</div>
<br>