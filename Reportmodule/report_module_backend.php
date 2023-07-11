    <?php
        $conn = mysqli_connect("localhost", "root", "") or die ("Unable to Connect". mysqli_error($conn));
        mysqli_select_db($conn, 'itisdev');

	
	if (@$_GET['date1'] != null && @$_GET['date2']!=null)  {
	  // collect value of input field	
	  $date1 = $_GET['date1'];
	  $date2 = $_GET['date2'];
	  date_default_timezone_set('Asia/Manila');
	  $timestamp = date("Y-m-d h:i:sa");
			$sql = "
				SELECT 	i.ingredientID, i.ingredientName, SUM(oi.quantity) AS stock_out
				FROM 	ingredient	i  		JOIN recipe 		r					ON r.ingredientID=i.ingredientID
											JOIN dish			d					ON d.dishID=r.dishID
											JOIN order_item		oi					ON oi.dishID=d.dishID
											JOIN orders			o					ON o.orderID=oi.orderID

				WHERE 	 DATE(o.createdAt) >= '$date1' 
				AND 	 DATE(o.createdAt) <= '$date2'
				GROUP BY i.ingredientID
				ORDER BY i.ingredientName;";

			$sql2 = "
				SELECT 		re.ingredientID,i.ingredientName, SUM(re.quantity) as stock_in
				FROM 		ingredient i			JOIN	replenish re		ON re.ingredientID=i.ingredientID
				WHERE 		DATE(re.boughtDate) 	>= '$date1' 	
				AND 		DATE(re.boughtDate) 	<= '$date2' 
				GROUP BY 	re.ingredientID
				ORDER BY 	i.ingredientName;";

			$sql3 =  "
				SELECT 		e.ingredientID,i.ingredientName, SUM(e.quantity) as expired
				FROM 		ingredient i			JOIN	expired e		ON e.ingredientID=i.ingredientID
				WHERE 		DATE(e.expiredDate) 	>= '$date1' 	
				AND 		DATE(e.expiredDate) 	<= '$date2' 
				GROUP BY 	e.ingredientID
				ORDER BY 	i.ingredientName;";

			$records = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$stockResult = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
			$expiredResult = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

			$stock_in = [];
			while($stockResults = mysqli_fetch_array($stockResult))
			{
				$id = $stockResults['ingredientID'];
				$ingredientName = $stockResults['ingredientName'];
				$stockIn = $stockResults['stock_in'];

				$stocks = array(
					'ingredientID' => $id,
					'ingredientName' => $ingredientName,
					'stock_in' => $stockIn
					 );
					
				array_push($stock_in, $stocks);	 	 
			}

			$expired_array = [];
			while($expiredResults = mysqli_fetch_array($expiredResult))
			{
				$id = $expiredResults['ingredientID'];
				$ingredientName = $expiredResults['ingredientName'];
				$expired_qty = $expiredResults['expired'];

				$expired = array(
					'ingredientID' => $id,
					'ingredientName' => $ingredientName,
					'expired_qty' => $expired_qty
					 );
					
				array_push($expired_array, $expired);	 	 
			}
			?>
			<div class="reportlabels">
			<h3>Stock Report</h3>
    		<h3>Report Created <?php echo "$timestamp"; ?></h3>
    		<h3>Report for <?php echo "$date1";?> to <?php echo "$date2"; ?></h3>
			</div>
    		<table class="reporttable">
    		<th>Ingredient</th>
    		<th>Stock In</th>
    		<th>Stock Out</th>

			<?php
			$in_counter = 0;
			$in = 0;
			$out_counter = 0;
			$out = 0;
			 while($results = mysqli_fetch_array($records))
			{
				$ingredientName = $results['ingredientName'];
			?>
			<tr onclick="window.location.href='detailed_report.php?results=<?php echo $ingredientName; ?>&date1=<?php echo $date1; ?>&date2=<?php echo $date2; ?>';">
			<td ><?php echo "$ingredientName"; ?></td>

			<?php
				foreach ($stock_in as $stockIn) {
					if($stockIn['ingredientName'] == $ingredientName){
						$in_counter++;
						$in = $stockIn['stock_in'];
					}
	
				}
				if($in_counter == 0){
					$in = 0;
					echo"<td>".$in."</td>";

				}
				else{
					echo"<td>".$in."</td>";
					$in_counter = 0;
				}

				foreach ($expired_array as $exp) {
					if($exp['ingredientName'] == $ingredientName){
						$out_counter++;
						$out = $exp['expired_qty'];
					}
				}
				if($out_counter == 0){
					$out = 0;
					echo"<td>".$results['stock_out']."</td>";

				}
				else{
					$out += $results['stock_out'];
					echo"<td>".$out."</td>";
					$out_counter = 0;
					$out = 0;
				}
				?>

		<?php } ?>
		<?php
    		echo '</table>';
			?>
			<div class="reportlabels">
			<h3>*END OF REPORT*</h3>
			</div>
			<?php
		}
	elseif($_SERVER["REQUEST_METHOD"] == "POST"){
			  // collect value of input field	
			  $date1 = $_POST['date1'];
			  $date2 = $_POST['date2'];
			  date_default_timezone_set('Asia/Manila');
			  $timestamp = date("Y-m-d h:i:sa");
					$sql = "
						SELECT 	i.ingredientID, i.ingredientName, SUM(oi.quantity) AS stock_out
						FROM 	ingredient	i  		JOIN recipe 		r					ON r.ingredientID=i.ingredientID
													JOIN dish			d					ON d.dishID=r.dishID
													JOIN order_item		oi					ON oi.dishID=d.dishID
													JOIN orders			o					ON o.orderID=oi.orderID
		
						WHERE 	 DATE(o.createdAt) >= '$date1' 
						AND 	 DATE(o.createdAt) <= '$date2'
						GROUP BY i.ingredientID
						ORDER BY i.ingredientName;";
		
					$sql2 = "
						SELECT 		re.ingredientID,i.ingredientName, SUM(re.quantity) as stock_in
						FROM 		ingredient i			JOIN	replenish re		ON re.ingredientID=i.ingredientID
						WHERE 		DATE(re.boughtDate) 	>= '$date1' 	
						AND 		DATE(re.boughtDate) 	<= '$date2' 
						GROUP BY 	re.ingredientID
						ORDER BY 	i.ingredientName;";
		
					$sql3 =  "
						SELECT 		e.ingredientID,i.ingredientName, SUM(e.quantity) as expired
						FROM 		ingredient i			JOIN	expired e		ON e.ingredientID=i.ingredientID
						WHERE 		DATE(e.expiredDate) 	>= '$date1' 	
						AND 		DATE(e.expiredDate) 	<= '$date2' 
						GROUP BY 	e.ingredientID
						ORDER BY 	i.ingredientName;";
		
					$records = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					$stockResult = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
					$expiredResult = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
		
					$stock_in = [];
					while($stockResults = mysqli_fetch_array($stockResult))
					{
						$id = $stockResults['ingredientID'];
						$ingredientName = $stockResults['ingredientName'];
						$stockIn = $stockResults['stock_in'];
		
						$stocks = array(
							'ingredientID' => $id,
							'ingredientName' => $ingredientName,
							'stock_in' => $stockIn
							 );
							
						array_push($stock_in, $stocks);	 	 
					}
		
					$expired_array = [];
					while($expiredResults = mysqli_fetch_array($expiredResult))
					{
						$id = $expiredResults['ingredientID'];
						$ingredientName = $expiredResults['ingredientName'];
						$expired_qty = $expiredResults['expired'];
		
						$expired = array(
							'ingredientID' => $id,
							'ingredientName' => $ingredientName,
							'expired_qty' => $expired_qty
							 );
							
						array_push($expired_array, $expired);	 	 
					}
					?>
					<div class="reportlabels">
					<h3>Stock Report</h3>
					<h3>Report Created <?php echo "$timestamp"; ?></h3>
					<h3>Report for <?php echo "$date1";?> to <?php echo "$date2"; ?></h3>
					</div>
					<table class="reporttable">
					<th>Ingredient</th>
					<th>Stock In</th>
					<th>Stock Out</th>
		
					<?php
					$in_counter = 0;
					$in = 0;
					$out_counter = 0;
					$out = 0;
					 while($results = mysqli_fetch_array($records))
					{
						$ingredientName = $results['ingredientName'];
					?>
					<tr onclick="window.location.href='detailed_report.php?results=<?php echo $ingredientName; ?>&date1=<?php echo $date1; ?>&date2=<?php echo $date2; ?>';">
					<td ><?php echo "$ingredientName"; ?></td>
		
					<?php
						foreach ($stock_in as $stockIn) {
							if($stockIn['ingredientName'] == $ingredientName){
								$in_counter++;
								$in = $stockIn['stock_in'];
							}
			
						}
						if($in_counter == 0){
							$in = 0;
							echo"<td>".$in."</td>";
		
						}
						else{
							echo"<td>".$in."</td>";
							$in_counter = 0;
						}
		
						foreach ($expired_array as $exp) {
							if($exp['ingredientName'] == $ingredientName){
								$out_counter++;
								$out = $exp['expired_qty'];
							}
						}
						if($out_counter == 0){
							$out = 0;
							echo"<td>".$results['stock_out']."</td>";
		
						}
						else{
							$out += $results['stock_out'];
							echo"<td>".$out."</td>";
							$out_counter = 0;
							$out = 0;
						}
						?>
		
				<?php } ?>
				<?php
					echo '</table>';
					?>
					<div class="reportlabels">
					<h3>*END OF REPORT*</h3>
					</div>
					<?php
	} 

		mysqli_close($conn);
		?>
    </body>
</html>