<?php

// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products1 WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>


<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">
    <div>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">
            &dollar;<?=$product['price']?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['desc']?>
        </div>

    
        
    </div>
</div>

<?=template_footer()?>
<link href="1b-comments.css" rel="stylesheet">
        <script src="1c-comments.js"></script>
 
<input type="hidden" id="pid" value="999"/>
 <h1>Comments</h1>
<div id="cwrap"></div>
 
<!-- (D) ADD NEW COMMENT -->
<form id="cadd" onsubmit="return comments.add(this)">
  <h1>Comment here!</h1>
  <input type="text" id="cname" placeholder="Name" required/>
  <input type="text" id="mail" placeholder="Mail" required/>
  <textarea id="cmsg" placeholder="Message" required></textarea>
  <input type="submit" value="Post!"/>
</form>