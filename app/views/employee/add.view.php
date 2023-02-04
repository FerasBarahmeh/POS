<style>
    * {
        margin: 0;
        padding: 0;
        border: 0;
        outline: none;
        line-height: 1.3;
        font-size: 1em;
    }
    .wrapper {
        /*overflow: hidden;*/
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    /*.wrapper div.emp-form {*/
    /*    float: left;*/
    /*}*/
    /*.wrapper div.employees {*/
    /*    float: right;*/
    /*}*/
    form.add-employee {
        width: 500px;
        margin: 20px 50px 0 20px;
    }
    form.add-employee fieldset {
        padding: 10px;
        background-color: #1f1f1f1f;

        border: solid 1px #ececec;
    }
    form.add-employee fieldset legend {
        background-color: #abaaaa;
        padding: 5px;
        font: 1rem;
        color: rgb(87, 85, 85);
    }
    form.add-employee table {
        width: 100%;
    }
    form.add-employee label {
        font-size: .85em;
        color: #666666;
    }
    form.add-employee table tr td input[type="text"],
    form.add-employee table tr td input[type="number"]{
        width: 97%;
        padding: 2%;
    }
    form.add-employee table tr td input[type="submit"] {
        color: #e4e4e4;
        padding: 3px 6px;
        background-color: rgb(12, 173, 12);
        margin-top: 3px;
        border-radius: 3px;
    }
    form.add-employee table tr td input[type="submit"]:hover {
        cursor: pointer;
    }
    form.add-employee table tr td {
        padding: 3px 0px;
    }

    form.add-employee .massage {
        color: white;
        background-color: rgb(127, 226, 127);
        padding: 3px;
    }

    div.wrapper .employees table {
        width: 600px;
        margin: 20px 20px 0 0;
        border-collapse: collapse;
    }
    div.wrapper .employees table thead th  {
        text-align: left;
        background-color: #e4e4e4;
        font-weight: bold;
        font-size: 0.9em;
        font-family: bold;
        padding: 5px;
        border-right: solid 2px #929292;
        border-bottom: solid 2px #989898;
        color: #666;
    }
    div.wrapper .employees table thead th:last-child {
        border-right: none;
    }

    div.wrapper .employees table tbody td  {
        text-align: left;
        background-color: #fffafa;
        font-weight: bold;
        font-size: 0.9em;
        font-family: bold;
        padding: 5px;
        border: 1px solid #FFFF;
        color: #666;
    }
    div.wrapper .employees table tbody tr:nth-child(2n) td {
        background-color: #f1f1f1;
    }

</style>

<div class="wrapper">
    <div class="emp-form">
        <form method="POST" class="add-employee" enctype="application/x-www-form-urlencoded">
            <fieldset>
                <legend>Employee Information's</legend>
                <?php
                if (isset($massage)) {
                    ?> <p class="massage"><?= $massage; ?></p> <?php
                }
                ?>

                <table>
                    <tr>
                        <td>
                            <label for="name">Employee Name</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" name="name" id="name" placeholder="Write Name Employee Here" maxlength="50" required>
                        </td>
                    </tr>



                    <!-- Age -->
                    <tr>
                        <td>
                            <label for="age">Employee Age</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="number" name="age" id="age" min="18" max="100" required>
                        </td>
                    </tr>

                    <!-- Address -->
                    <tr>
                        <td>
                            <label for="address">Employee Address</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" name="address" id="address" placeholder="Write Address" required>
                        </td>
                    </tr>

                    <!-- Salary -->
                    <tr>
                        <td>
                            <label for="salary">Employee Salary</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="number" step="0.01" name="salary" id="salary" min="100" max="9000" required>
                        </td>
                    </tr>

                    <!-- Tax -->
                    <tr>
                        <td>
                            <label for="tax">Employee Tax</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="number" step="0.01" name="tax" id="tax" min="0" max="5" required>
                        </td>
                    </tr>

                    <!-- Save Button -->
                    <tr>
                        <td>
                            <input type="submit" name="add-employee"  value="save">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
</div>