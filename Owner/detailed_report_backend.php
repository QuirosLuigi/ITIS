<?php
	include "connect.php";
	$ingredientName = $_GET['results'];
	$date1 = $_GET['date1'];
	$date2 = $_GET['date2'];

	date_default_timezone_set('Asia/Manila');
	$timestamp = date("Y-m-d h:i:sa");

	// RETRIEVE STOCKIN records in replenish table
	$replenishRecords = mysqli_query($DBConnect, "	SELECT 		SUM(re.quantity) as stock_in, DATE(re.boughtDate) as date
													FROM 		ingredient i			JOIN	replenish re		ON re.ingredientID=i.ingredientID
													WHERE 		DATE(re.boughtDate) 	>= '$date1' 	
													AND 		DATE(re.boughtDate) 	<= '$date2' 
													AND         i.ingredientName='$ingredientName'
													GROUP BY 	DATE(re.boughtDate)
													ORDER BY	DATE(re.boughtDate) DESC;");

	$replenishes = [];	
	while ($replenish = mysqli_fetch_array($replenishRecords)) $replenishes[] = ['stock_in' => $replenish['stock_in'], 'date' => $replenish['date']];

	// RETRIEVE STOCKOUT records in orders and order_item table
	$orderRecords = mysqli_query($DBConnect, "	SELECT 		SUM(oi.quantity * r.quantity) as stock_out, DATE(o.createdAt) as date
												FROM 		ingredient i	JOIN recipe 		r	ON r.ingredientID=i.ingredientID
																			JOIN dish			d	ON d.dishID=r.dishID
																			JOIN order_item		oi	ON oi.dishID=d.dishID
																			JOIN orders			o	ON o.orderID=oi.orderID
																			JOIN unit			u	ON u.unitID=i.unitID
												WHERE   	DATE(o.createdAt) >= '$date1' 
												AND     	DATE(o.createdAt) <= '$date2'
												AND    		i.ingredientName='$ingredientName'
												GROUP BY	DATE(o.createdAt)
												ORDER BY	DATE(o.createdAt) DESC;");

	$orders = [];
	while ($order = mysqli_fetch_array($orderRecords)) $orders[] = ['stock_out' => $order['stock_out'], 'date' => $order['date']];
	
	// RETRIEVE STOCKOUT records in expired table
	$expiredRecords = mysqli_query($DBConnect, "	SELECT 		SUM(e.quantity) as expired, DATE(e.expiredDate) as date
													FROM 		ingredient i			JOIN	expired e		ON e.ingredientID=i.ingredientID
													WHERE 		DATE(e.expiredDate) 	>= '$date1' 	
													AND 		DATE(e.expiredDate) 	<= '$date2' 
													AND         i.ingredientName='$ingredientName'
													GROUP BY 	DATE(e.expiredDate)
													ORDER BY	DATE(e.expiredDate) DESC;");

	$expireds = [];
	while ($expired = mysqli_fetch_array($expiredRecords)) $expireds[] = ['stock_out' => $expired['expired'], 'date' => $expired['date']];

	// RETRIEVE disparity records
	$disparityRecords = mysqli_query($DBConnect, "	SELECT 		d.sQuantity as system_quantity, d.mQuantity as manual_quantity, DATE(d.createdAt) as date
													FROM 		ingredient i			JOIN	disparity d		ON d.ingredientID=i.ingredientID
													WHERE 		DATE(d.createdAt) 	>= '$date1' 	
													AND 		DATE(d.createdAt) 	<= '$date2'
													AND         i.ingredientName='$ingredientName'
													GROUP BY 	DATE(d.createdAt)
													ORDER BY	DATE(d.createdAt) DESC;");

	// SEPARATE disparity records into STOCKIN and STOCKOUT
	$dStockIn = [];
	$dStockOut = [];
	while ($disparity = mysqli_fetch_array($expiredRecords)) {
		if ($disparity['manual_quantity'] > $disparity['system_quantity'])
			$dStockIn[] = ['stock_in' => $disparity['manual_quantity'], 'date' => $disparity['date']];
		else if ($disparity['manual_quantity'] < $disparity['system_quantity']) 
			$dStockOut[] = ['stock_out' => $disparity['system_quantity'], 'date' => $disparity['date']];
	}

	// ADD all records of STOCKOUT based on DATE
	$stockout = [];
	foreach (array_merge($orders, $expireds, $dStockOut) as $item) {
		$date = $item['date'];
		if (!isset($stockout[$date])) {
			$stockout[$date] = ['date' => $date, 'stock_out' => 0];
		}
		$stockout[$date]['stock_out'] += $item['stock_out'];
	}
	$stockout = array_values($stockout);
	
	// ADD all records of STOCKIN based on DATE
	$stockin = [];
	foreach (array_merge($replenishes, $dStockIn) as $item) {
		$date = $item['date'];
		if (!isset($stockin[$date])) {
			$stockin[$date] = ['date' => $date, 'stock_in' => 0];
		}
		$stockin[$date]['stock_in'] += $item['stock_in'];
	}
	$stockin = array_values($stockin);

	// MERGE both STOCKIN and STOCKOUT based on DATE
	$stocks = [];
	foreach ($stockin as $stock) {
		$date = $stock['date'];
		$stocks[$date]['date'] = $date;
		$stocks[$date]['stock_in'] = $stock['stock_in'];
		$stocks[$date]['stock_out'] = 0;
	}
	
	foreach ($stockout as $stock) {
		$date = $stock['date'];
		if (!isset($stocks[$date])) {
			$stocks[$date]['date'] = $date;
			$stocks[$date]['stock_in'] = 0;
		}
		$stocks[$date]['stock_out'] = $stock['stock_out'];
	}
	$stocks = array_values($stocks);
?>
	<div class="reportlabels">
		<div class="backb"><a href="generatereports.php?date1=<?php echo $date1; ?>&date2=<?php echo $date2; ?>" class="sbt_btn">Back</a></div>
		<h3><?php echo $ingredientName ?> Stock Report</h3>
		<h3>Report Created <?php echo "$timestamp"; ?></h3>
		<h3>Detailed report for <?php echo "$ingredientName";?> from <?php echo "$date1";?> to <?php echo "$date2"; ?></h3>
	</div>
	<table class="reporttable">
		<th>Stock In</th>
		<th>Stock Out</th>
		<th>Date</th>
		<?php foreach ($stocks as $stock) {
			echo "<tr>";
			echo	"<td>" . $stock['stock_in']		. "</td>";
			echo	"<td>" . $stock['stock_out']	. "</td>";
			echo	"<td>" . $stock['date']			. "</td>";
			echo "</tr>";
		} ?>
		
	</table>
	<div class="reportlabels"><h3>*END OF REPORT*</h3></div>
</body>