<div>
    <h2>Cities in <?php echo $country->name ?></h2>

    <!-- TODO link is currently full page width -->
    <a href="<?php echo Router::Link("cities", "new", $country->id) ?>"><h5>Add new city</h5></a>
    
    <h5>Filter cities list</h5>

    <?php include Router::View('common/filters') ?>
    
    <div id="areas-list-wrapper">
        <div class="loading-wrapper">
            <img src="<?php echo Router::Img('loading.gif'); ?>">
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Area.module = 'cities';
            Area.country_id = <?php echo $country->id ?>;
        });
        document.addEventListener("DOMContentLoaded", Area.UpdateList);
    </script>
</div>