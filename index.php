<?php
// Configuration
$vATRate = 0.15; // 15% VAT rate
$generalExpensesPercentage = 0.10; // 10% general expenses percentage
$profitMarginPercentage = 0.20; // 20% profit margin percentage

// Function to calculate selling price
function calculateSellingPrice($buyingPrice) {
  global $vATRate, $generalExpensesPercentage, $profitMarginPercentage;

  // Calculate VAT
  $vat = $buyingPrice * $vATRate;

  // Calculate general expenses
  $generalExpenses = $buyingPrice * $generalExpensesPercentage;

  // Calculate profit margin
  $profitMargin = $buyingPrice * $profitMarginPercentage;

  // Calculate selling price
  $sellingPrice = $buyingPrice + $vat + $generalExpenses + $profitMargin;

  return $sellingPrice;
}

// Function to display output
function displayOutput($buyingPrice, $sellingPrice, $vat, $generalExpenses, $profitMargin) {
  echo "<p>Buying Price: $". number_format($buyingPrice, 2). "</p>";
  echo "<p>VAT: $". number_format($vat, 2). "</p>";
  echo "<p>General Expenses: $". number_format($generalExpenses, 2). "</p>";
  echo "<p>Profit Margin: $". number_format($profitMargin, 2). "</p>";
  echo "<p>Selling Price: $". number_format($sellingPrice, 2). "</p>";
}

// Process form submission
if (isset($_POST['submit'])) {
  $buyingPrice = $_POST['buying_price'];

  // Calculate selling price
  $sellingPrice = calculateSellingPrice($buyingPrice);

  // Calculate VAT, general expenses, and profit margin
  $vat = $buyingPrice * $vATRate;
  $generalExpenses = $buyingPrice * $generalExpensesPercentage;
  $profitMargin = $buyingPrice * $profitMarginPercentage;

  // Display output
  displayOutput($buyingPrice, $sellingPrice, $vat, $generalExpenses, $profitMargin);
}

// Display form
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <label for="buying_price">Buying Price:</label>
  <input type="number" id="buying_price" name="buying_price" required>
  <button type="submit" name="submit">Calculate Selling Price</button>
</form>

<h2>Sample Products</h2>
<table border="1">
  <tr>
    <th>Product</th>
    <th>Buying Price</th>
    <th>VAT</th>
    <th>General Expenses</th>
    <th>Profit Margin</th>
    <th>Selling Price</th>
  </tr>
  <?php for ($i = 1; $i <= 10; $i++) {?>
  <tr>
    <td>Product <?php echo $i;?></td>
    <td>$<?php echo number_format(rand(10, 100), 2);?></td>
    <td>$<?php echo number_format(rand(1, 10), 2);?></td>
    <td>$<?php echo number_format(rand(1, 10), 2);?></td>
    <td>$<?php echo number_format(rand(1, 10), 2);?></td>
    <td>$<?php echo number_format(calculateSellingPrice(rand(10, 100)), 2);?></td>
  </tr>
  <?php }?>
</table>