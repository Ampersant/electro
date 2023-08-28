<div class="modal-body">
    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <tr>
                 <td><a href="#"> <img style="max-width: 30%" src="img/product01.png" alt="<?= $item['name']; ?>"> </a></td>
                    <td><a href="#"><?= $item['name']; ?></a></td>
                    <td><?= $item['price']; ?></td>
                    <td><?= $item['qty'] ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="4" align="right">Products: <span id="modal-cart-qty"><?= $_SESSION['cart.qty'] ?></span>
                    <br> Sum: <?= $_SESSION['cart.sum'] ?> $.
                </td>
            </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>Корзина пуста...</p>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <?php if (!empty($_SESSION['cart'])): ?>
        <a class="primary-btn" href="http://localhost/electro/checkout.php" id="gen-order">Make an order</a>
        <a class="primary-btn" href="#" id="clear-cart">Clear the cart</a>
    <?php endif; ?>
    <a class="primary-btn" href="#" data-dismiss="modal">Close</a>

</div>
