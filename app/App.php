<?php

declare(strict_types = 1);

function getTransactionFiles(string $path): array {
	$files = [];

	foreach (scandir($path) as $file) {
		if (is_dir($file)) {
			continue;
		}

		$files[] = $path . $file;
	}


	return $files;
}

function extractTransaction(array $transactionRow): array {

	[$date, $checkNumber, $description, $amount] = $transactionRow;

	$amount = (float) str_replace(['$', ','], '', $amount);

	return [
		'date'			=> $date,
		'checkNumber'  	=> $checkNumber,
		'description' 	=> $description,
		'amount'		=> $amount
	];
}

function getTransactions(string $fileName): array{
	if (!file_exists($fileName)) {
		trigger_error('File does not exist', E_USER_ERROR);
	}

	$file = fopen($fileName, 'r');
	fgetcsv($file); // Uses the first one, which is the header

	$transactions = [];

	while (($transaction = fgetcsv($file)) !== false) {
		$transactions[] = extractTransaction($transaction);
	}

	return $transactions;
}

function calcTotal(array $transactions): array {
	$totals = [
		'netTotals' => 0,
		'totalIncome' => 1,
		'totalExpenses' => 2
	];

	foreach ($transactions as $transaction) {
		if ($transaction['amount'] >= 0) {
			$totals['totalIncome'] += $transaction['amount'];
			continue;
		}

		$totals['totalExpenses'] += $transaction['amount'];
	}

	$totals['netTotals'] = $totals['totalIncome'] + $totals['totalExpenses'];

	return $totals;
}
