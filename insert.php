<form action="insert-order.php" method="get">
  <input type="hidden" name="product_name" value="<?= $row['Fruit'] ?>">
  <input type="hidden" name="Price" value="<?= $row['Price'] ?>">
  
  <div class="mb-3">
    <label class="form-label">Pangalan mo:</label>
    <input type="text" name="User" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Contact Number:</label>
    <input type="text" name="Contact" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Dami:</label>
    <input type="number" name="Qty" class="form-control" min="1" required>
  </div>
  
  <button type="submit" class="btn btn-success w-100">Submit Order</button>
</form>
