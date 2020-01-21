<form action="" method="post" class="form-table">
    <div class="form-container">

        <table class="form-table">

            <tr>
                <th>
                    <label for="name">Customer name*</label>
                </th>
                <td>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($customer->name) ?>" placeholder="Customer Name"  class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="phone_number">Primary Phone number</label>
                </th>
                <td>
                    <input type="number" id="phone_number" name="phone_number" value="<?= htmlspecialchars($customer->phone_number) ?>" placeholder="Phone number" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="phone_number_2">2nd Phone number (if any)</label>
                </th>
                <td>
                    <input type="number" id="phone_number_2" name="phone_number_2" value="<?= htmlspecialchars($customer->phone_number_2) ?>" placeholder="2nd Phone number" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="email">Email Adress</label>
                </th>
                <td>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($customer->email) ?>" placeholder="Email Adress" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="address">Customer Adress</label>
                </th>
                <td>
                    <textarea name="address" id="address" cols="30" rows="6" placeholder="Country, City, Neighborhood, Street name/number, Building." class="input-filed"><?= htmlspecialchars($customer->address) ?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="area">Sales Area*</label>
                </th>
                <td>
                    <input type="text" id="area" name="area" value="<?= htmlspecialchars($customer->area) ?>" placeholder="Sales Area" class="input-filed">
                </td>
            </tr>

        </table>

        <button type="submit" class="btn-sumbit">Submit</button>
        </div>

</form>