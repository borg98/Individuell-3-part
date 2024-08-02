<?php
require_once 'Models/ServerRequest.php';
require_once 'Models/ExportFunction.php';

$sr = new ServerRequests();
$export = new ExportFunction();
$products = $sr->getProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['postType']) {
        case 'addProduct':
            $sr->addProduct();
            break;
        case 'deleteProduct':
            $sr->deleteProduct();
            break;
        case 'updateProduct':
            $sr->updateProduct();
            break;
        case 'exportCSV':
            $export->csv($products);
            break;
        case 'exportXML':
            $export->xml($products);
            break;

    }



}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Products</title>
</head>

<body>
    <section class="product-section">
        <h1>Products</h1>
        <table class="table">
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
            </tr>
            <?php
            foreach ($products as $product) {
                ?>
                <tr>
                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $product->price; ?></td>
                    <td><img src="<?php echo $product->img ?>" alt="<? echo $product->name ?>"></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </section>
    <section class="form-section">
        <form method="POST" class="form">
            <h3>Add Product</h3>
            <input hidden type="text" name="postType" value="addProduct">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name">
            <label for="price">Product Price</label>
            <input type="text" name="price" id="price">
            <label for="img">Product Img</label>
            <input type="text" name="imgUrl" id="img">
            <button type="submit">Add Product</button>
        </form>
        <form method="POST" class="form">
            <h3>Delete Product</h3>
            <input hidden type="text" name="postType" value="deleteProduct">
            <label for="id">Product ID</label>
            <input type="text" name="id" id="id">
            <button type="submit">Delete Product</button>
        </form>
        <form method="POST" class="form">
            <h3>Update Product</h3>
            <input hidden type="text" name="postType" value="updateProduct">
            <label for="id">Product ID</label>
            <input type="text" name="id" id="id">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name">
            <label for="price">Product Price</label>
            <input type="text" name="price" id="price">
            <label for="img">Product Img</label>
            <input type="text" name="imgUrl" id="img">
            <button type="submit">Update Product</button>
        </form>
    </section>
    <div class="export-container">

        <form method="POST" class="form">
            <input hidden type="text" name="postType" value="exportCSV">
            <button type="submit">Export CSV</button>
        </form>
        <form method="POST" class="form">
            <input hidden type="text" name="postType" value="exportXML">
            <button type="submit">Export XML</button>
        </form>
    </div>
</body>

</html>