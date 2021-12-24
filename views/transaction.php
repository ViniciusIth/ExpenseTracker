<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styles/transaction.css">
	<title>Expense Tracker</title>
</head>
<body>
<table>
	<thead>
		<tr>
			<th>Date</th>
			<th>Check #</th>
			<th>Description</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($transactions)): ?>
			<?php foreach($transactions as $transaction): ?>
				<?php $isPositive = $transaction['amount'] > 0 ?>
			<tr>
				<td><?= $transaction['date'] ?></td>
				<td><?= $transaction['checkNumber'] ?></td>
				<td><?= $transaction['description'] ?></td>
				<td <?= formatColour($transaction['amount']); ?> ><?= formatDoller($transaction['amount']) ?></td>
			</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="3">Total Income:</th>
			<td <?= formatColour($total['totalIncome']); ?> ><?= formatDoller($total['totalIncome'] ?? 0) ?></td>
		</tr>
		<tr>
			<th colspan="3">Total Expense:</th>
			<td <?= formatColour($total['totalExpenses']); ?> ><?= formatDoller($total['totalExpenses'] ?? 0) ?></td>
		</tr>
		<tr>
			<th colspan="3">Net Total:</th>
			<td <?= formatColour($total['netTotals']); ?> ><?= formatDoller($total['netTotals'] ?? 0) ?></td>
		</tr>
	</tfoot>
</table>
</body>
</html>