<form action="" method="post">
    <div class="form-container">

        <table class="form-table">

            <tr>
                <th>
                    <label for="name">Product name*</label>
                </th>
                <td>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($product->name) ?>" placeholder="Product Name" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="description">Product description</label>
                </th>
                <td>
                    <textarea name="description" id="description" cols="30" rows="7" placeholder="Description of your Product" class="input-filed"><?= htmlspecialchars($product->description) ?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="price">Product Selling Price*</label>
                </th>
                <td>
                    <input type="number" step="0.01" id="price" name="price" value="<?= htmlspecialchars($product->price) ?>" placeholder="Price in numbers only" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="cost">Cost of Product*</label>
                </th>
                <td>
                    <input type="number" step="0.01" id="cost" name="cost" value="<?= htmlspecialchars($product->cost) ?>" placeholder="Cost in numbers only" class="input-filed">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="max_discount">Maximum allowed Discount*</label>
                </th>
                <td>
                    <input type="number" step="0.01" id="max_discount" name="max_discount" value="<?= htmlspecialchars($product->max_discount) ?>" placeholder="Discount in numbers only" class="input-filed">
                </td>
            </tr>

        </table>

        <button type="submit" class="btn-sumbit">Submit</button>
    </div>
</form>