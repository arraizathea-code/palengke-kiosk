<?php
include("db.php");

$sql = "SELECT * FROM products ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("❌ Query Error: " . mysqli_error($conn));
}

$imageMap = [
    'apple'             => 'images/apple.png',
    'avocado'           => 'images/avocado.png',
    'banana'            => 'images/banana.png',
    'bittermelon'       => 'images/bittermelon.png',
    'brocolli'          => 'images/brocolli.png',
    'cabbage'           => 'images/cabbage.png',
    'carrot'            => 'images/carrot.png',
    'cashew'            => 'images/cashew.png',
    'cauliflower'       => 'images/cauliflower.png',
    'chili'             => 'images/chili.png',
    'coconut'           => 'images/coconut.png',
    'corn'              => 'images/corn.png',
    'cucumber'          => 'images/cucumber.png',
    'durian'            => 'images/durian.png',
    'eggplant'          => 'images/eggplant.png',
    'garlic'            => 'images/garlic.png',
    'ginger'            => 'images/ginger.png',
    'grapes'            => 'images/grapes.png',
    'guava'             => 'images/guava.png',
    'horseradish'       => 'images/horseradish.png',
    'hyacinthbeans'     => 'images/hyacinthbeans.png',
    'jackfruit'         => 'images/jackfruit.png',
    'longbeans'         => 'images/longbeans.png',
    'melon'             => 'images/melon.png',
    'mungbeans'         => 'images/mungbeans.png'
];
$defaultImg = 'images/mushroom.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palengke Kiosk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #fefbf6; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; color: white !important; }
        .product-card { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); background: white; transition: transform 0.3s ease; }
        .product-card:hover { transform: translateY(-5px); }
        .product-img { height: 160px; object-fit: contain; width: 100%; padding: 15px; }
        .price-tag { font-size: 1.4rem; font-weight: 700; color: #2d5016; }
        .btn-order { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; }
        .btn-order:hover { background: linear-gradient(135deg, #d97706 0%, #b45309 100%); }
        footer { background-color: #2d5016; color: white; padding: 20px; margin-top: 60px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">🛒 Palengke Kiosk</a>
        <span class="text-white ms-auto">Fresh & Affordable!</span>
    </div>
</nav>

<div class="container">
    <div class="text-center mb-5">
        <h2 class="display-6">🍊 Our Products</h2>
        <p class="text-muted">Fresh produce directly from the farm</p>
    </div>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="row g-4">
            <?php while ($row = mysqli_fetch_assoc($result)): 
                $imgPath = isset($imageMap[$row['Image']]) ? $imageMap[$row['Image']] : $defaultImg;
            ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card h-100">
                        <img src="<?php echo $imgPath; ?>" alt="<?php echo $row['Fruits']; ?>" class="product-img">
                        <div class="p-3 text-center">
                            <h5 class="mb-2"><?php echo $row['Fruits']; ?></h5>
                            <p class="text-muted small mb-2">Available: <?php echo $row['Qty']; ?></p>
                            <p class="price-tag mb-3">₱<?php echo number_format($row['price'], 2); ?></p>
                            <button class="btn btn-order text-white w-100">Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <p class="text-muted fs-5">No products found.</p>
        </div>
    <?php endif; ?>
</div>

<footer class="text-center">
    <p class="mb-0">© 2026 Palengke Kiosk — Fresh Produce Market</p>
</footer>

<?php mysqli_close($conn); ?>
</body>
</html>
