<?php

$input = $modx->getOption('input', $scriptProperties, $modx->getChunk('tpl.textGenerator.input'));
$inputChunk = $modx->getOption('inputChunk', $scriptProperties, false);
$tpl = $modx->getOption('tpl', $scriptProperties, false);

$output = '';

if(!function_exists('textGenerator')) {
	function textGenerator($text) {
		static $result;
		if (preg_match("/^(.*)\{([^\{\}]+)\}(.*)$/isU", $text, $matches)) {
			$p = explode('|', $matches[2]);
			foreach ($p as $comb) textGenerator($matches[1] . $comb . $matches[3]);
		} else {
			$result[] = $text;
			return 0;
		}
		return array_values(array_unique($result));
	}
}

if ($inputChunk) {
	$input = $modx->getChunk($inputChunk); //получаем исходный текст для генерации из чанка	
}

if (!$input) {return '';}

$variation = textGenerator($input); // все сгенерированные варианты
$count = count($variation); // подсчет общего кол-ва
$output = $variation[rand(0, $count - 1)]; // выбираем случайный вариант

if ($tpl) {
	$output = $modx->getChunk($tpl, array('output' => $output));
}

return $output;
