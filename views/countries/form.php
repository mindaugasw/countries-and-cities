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
            echo "<h2>Add new country</h2>";
        else
            echo "<h2>Edit country</h2>";
        ?>

        <table class="table table-form">
            <tbody>

                <!-- ID -->
                <?php
                if ($action === 'edit')
                {
                    echo
                        '<tr>
                            <th>
                                <label for="inputId">ID</label>
                            </th>
                            <td>
                                <input type="text" name="id" id="inputId" class="form-control" required disabled
                                value="'.$country['id'].'">
                            </td>
                        </tr>';
                }
                ?>

                <!-- NAME -->
                <tr>
                    <th>
                        <label for="inputName">Name</label>
                    </th>
                    <td>
                        <input type="text" name="name" id="inputName" class="form-control"
                        required <?php if ($infoExists) echo "value='{$country['name']}'" ?> >
                    </td>
                </tr>

                <!-- AREA -->
                <tr>
                    <th>
                        <label for="inputArea">Area</label>
                    </th>
                    <td>
                        <input type="number" name="area" id="inputArea" class="form-control"
                        required min=0 step=1 placeholder="100" <?php if ($infoExists) echo "value='{$country['area']}'" ?>>
                    </td>
                </tr>

                <!-- POPULATION -->
                <tr>
                    <th>
                        <label for="inputPopulation">Population</label>
                    </th>
                    <td>
                        <input type="number" name="population" id="inputPopulation" class="form-control"
                        required min=0 step=1 placeholder="100" <?php if ($infoExists) echo "value='{$country['population']}'" ?>>
                    </td>
                </tr>

                <!-- PHONE CODE -->
                <tr>
                    <th>
                        <label for="inputPhoneCode">Phone code</label>
                    </th>
                    <td>
                        <input type="number" name="phoneCode" id="inputPhoneCode" class="form-control"
                        required placeholder="370" <?php if ($infoExists) echo "value='{$country['phoneCode']}'" ?>>
                    </td>
                </tr>

                <!-- SUBMIT -->
                <tr>
                    <th>
                        <a href="<?php echo Router::Link("countries", "list") ?>">Go back</a>
                    </th>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>
                </tr>
            </tbody>
        </table>



    </form>

</div>