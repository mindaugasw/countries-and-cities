<div>
    <?php 
        $action = $_GET['action'];
        if ($action !== 'new' && $action !== 'edit')
        {
            ToastMessages::Add('danger', 'Unknown action!');
            Router::Redirect();
        }
    ?>

    <form method="POST" action="">

        <?php
        if ($action === 'new')
            echo "<h2>Add new city</h2>";
        else
            echo "<h2>Edit city</h2>";
        ?>

        <table class="table table-form">
            <tbody>

                <!-- ID -->
                <?php
                if ($action === 'edit')
                {
                    echo
                        '<tr>
                            <th><label for="inputId">ID</label></th>
                            <td>
                                <input type="text" name="id" id="inputId" class="form-control"
                                required readonly value="'.$city->id.'">
                            </td>
                        </tr>';
                }
                ?>

                <!-- COUNTRY -->
                <tr>
                    <th><label for="inputCountry_id">Country</label></th>
                    <td>
                        <select class="custom-select" name="country_id">
                        <?php 
                            foreach ($countries as $country)
                            {
                                echo "<option ".
                                    ($country->id == $country_id ? 'selected' : '').
                                    " value=\"$country->id\">$country->name</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>

                <!-- NAME -->
                <tr>
                    <th><label for="inputName">Name</label></th>
                    <td>
                        <input type="text" name="name" id="inputName" class="form-control"
                        required <?php if ($infoExists) echo "value='{$city->name}'" ?> >
                    </td>
                </tr>

                <!-- AREA -->
                <tr>
                    <th><label for="inputArea">Area</label></th>
                    <td>
                        <input type="number" name="area" id="inputArea" class="form-control"
                        required min=0 step=1 placeholder="100" <?php if ($infoExists) echo "value='{$city->area}'" ?>>
                    </td>
                </tr>

                <!-- POPULATION -->
                <tr>
                    <th><label for="inputPopulation">Population</label></th>
                    <td>
                        <input type="number" name="population" id="inputPopulation" class="form-control"
                        required min=0 step=1 placeholder="100" <?php if ($infoExists) echo "value='{$city->population}'" ?>>
                    </td>
                </tr>

                <!-- PHONE CODE -->
                <tr>
                    <th><label for="inputZip_code">ZIP code</label></th>
                    <td>
                        <input type="number" name="zip_code" id="inputZip_code" class="form-control"
                        required placeholder="12345" <?php if ($infoExists) echo "value='{$city->zip_code}'" ?>>
                    </td>
                </tr>

                <!-- SUBMIT -->
                <tr>
                    <th>
                        <a href="<?php echo Router::Link("countries", "details", $country_id) ?>">Go back</a>
                    </th>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </form>
</div>