<form action="" method="post">
    <div class="form-container">

        <table class="form-table">

            <tr>
                <th>
                    <label for="name">Employee name*</label>
                </th>
                <td>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($emp->name) ?>" placeholder="Employee Name" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="email">Email Adress</label>
                </th>
                <td>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($emp->email) ?>" placeholder="Email Adress" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="phone_number">Phone number</label>
                </th>
                <td>
                    <input type="number" id="phone_number" name="phone_number" value="<?= htmlspecialchars($emp->phone_number) ?>" placeholder="Phone number" class="input-filed">
                </td>
            </tr>

            <tr>
                <th>
                    <label for="dep">Employee Department*</label>
                </th>
                <td>
                    <select name="dep" id="dep"  class="input-filed">
                        <option value="Administration" <?php if ($emp->dep == "Administration") {
                                                            echo "selected";
                                                        } ?>>Administration</option>
                        <option value="Sales" <?php if ($emp->dep == "Sales") {
                                                    echo "selected";
                                                } ?>>Sales</option>
                        <option value="Accounting" <?php if ($emp->dep == "Accounting") {
                                                        echo "selected";
                                                    } ?>>Accounting</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="salary">Employee's salary*</label>
                </th>
                <td>
                    <input type="number" id="salary" name="salary" value="<?= htmlspecialchars($emp->salary) ?>" placeholder="Salary in Numbers"  class="input-filed">
                </td>
            </tr>

        </table>

        <button type="submit" class="btn-sumbit">Submit</button>
    </div>

</form>