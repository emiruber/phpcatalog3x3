<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products1 ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>


<div class="recentlyadded content-wrapper">
    <h2>Products</h2>
    <div class="products">
        <h1>Click products to see them</h1>
    </div>
</div>

<?=template_footer()?>
