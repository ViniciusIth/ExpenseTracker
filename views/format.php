<?php 

declare(strict_types = 1);

function formatDoller(float $value): string {
	$isNegative = $value < 0;

	return ($isNegative ? '-' : '') . '$' . number_format(abs($value), 2);
}

function formatColour(float $value): string {
	$isNegative = $value < 0;
	
	return 'class = "' . ($isNegative ? 'negative' : 'positive') . '"';
}