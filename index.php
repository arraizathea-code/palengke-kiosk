<?php
include("db.php");
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
        .navbar { background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; color: white !important; }
        .product-card { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); background: white; }
        .product-img { height: 160px; object-fit: cover; width: 100%; background-color: #f8f9fa; }
        .price-tag { font-size: 1.2rem; font-weight: 700; color: #2d5016; }
        .btn-order { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; font-weight: 600; }
        .btn-order:hover { background: linear-gradient(135deg, #d97706 0%, #b45309 100%); }
        footer { background-color: #2d5016; color: white; padding: 20px 0; margin-top: 60px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">🛒 Palengke Kiosk</a>
        <span class="navbar-text text-white">Fresh & Affordable!</span>
    </div>
</nav>

<div class="container">
    <div class="text-center mb-5">
        <h1 class="text-success">🥭 Our Products</h1>
        <p class="text-muted">Fresh produce directly from the farm</p>
    </div>

    <div class="row g-4">
    <?php
    $sql = "SELECT * FROM products ORDER BY Fruit";
    $result = mysqli_query($conn, $sql);

    // All your images — using .png
    $imageMap = [
        'Apple' => 'images/apple.png',
        'Avocado' => 'images/avocado.png',
        'Banana' => 'images/banana.png',
        'Bitter Melon' => 'images/bittermelon.png',
        'Brocolli' => 'images/brocolli.png',
        'Cabbage' => 'images/cabbage.png',
        'Carrot' => 'images/carrots.png',
        'Cashew' => 'images/cashew.png',
        'Cauliflower' => 'images/cauliflower.png',
        'Chili Pepper' => 'images/chili.png',
        'Coconut' => 'images/coconut.png',
        'Corn' => 'images/corn.png',
        'Cucumber' => 'images/cucumber.png',
        'Durian' => 'images/durian.png',
        'Eggplant' => 'images/eggplant.png',
        'Garlic' => 'images/garlic.png',
        'Ginger' => 'images/ginger.png',
        'Grapes' => 'images/grapes.png',
        'Guava' => 'images/guava.png',
        'Horseradish' => 'images/horseradish.png',
        'Hyacinth Beans' => 'images/hyacinthbeans.png',
        'Jackfruit' => 'images/jackfruit.png',
        'Long Beans' => 'images/longbeans.png',
        'Melon' => 'images/melon.png',
        'Mung Beans' => 'images/mungbeans.png',
        'Mushroom' => 'images/mushroom.png',
        'Onion' => 'images/onion.png',
        'Orange' => 'images/orange.png',
        'Papaya' => 'images/papaya.png',
        'Peanut' => 'images/peanut.png',
        'Pepper' => 'images/pepper.png',
        'Pineapple' => 'images/pineapple.png',
        'Pomelo' => 'images/pomelo.png',
        'Potato' => 'images/potato.png',
        'Pumpkin' => 'images/pumpkin.png',
        'Squash' => 'images/squash.png',
        'Strawberry' => 'images/strawberry.png',
        'Sweet Potato' => 'images/sweetpotato.png',
        'Tamarind' => 'images/tamarind.png',
        'Tomato' => 'images/tomato.png',
        'Turnip' => 'images/turnip.png',
        'Watermelon' => 'images/watermelon.png'
    ];
    $defaultImg = 'https://images.unsplash.com/photo-1543549790-8b5f0a29a916?w=400&h=300&fit=crop';

    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['Fruit'];
        $img = isset($imageMap[$name]) ? $imageMap[$name] : $defaultImg;
    ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card h-100">
                <img src="<?php echo $img ?>" alt="<?php echo $name ?>" class="product-img">
                <div class="p-3 text-center">
                    <h5 class="mb-1"><?php echo $name ?></h5>
                    <p class="text-muted small mb-2"><?php echo $row['Qty'] ?> <?php echo $row['Units'] ?> available</p>
                    <p class="price-tag mb-3">₱<?php echo number_format($row['Price'], 2) ?></p>
                    <button class="btn btn-order w-100 text-white" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['id'] ?>">🛒 Order Now</button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal<?php echo $row['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background: #2d5016;">
                        <h5 class="modal-title">Order <?php echo $name ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="insert-order.php" method="get">
                            <input type="hidden" name="product_name" value="<?php echo $name ?>">
                            <input type="hidden" name="Price" value="<?php echo $row['Price'] ?>">
                            <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input type="text" name="User" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="Contact" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="Qty" class="form-control" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">✅ Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

<footer>
    <div class="container text-center">
        <p class="mb-1">🛒 Palengke Kiosk — Fresh Fruits & Vegetables</p>
        <p class="small mb-0">© <?php echo date("Y") ?> Palengke Kiosk. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
