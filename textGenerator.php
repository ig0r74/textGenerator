<?php

$field = 'description';

/* Сначала проверяем на всякий случай, нужное ли нам событие произошло */
if ($modx->event->name != "OnDocFormSave") {return;}

if ($resource->get('$field') != "") {return;}

function textGenerator($text)
   {
   static $result;
   if (preg_match("/^(.*)\{([^\{\}]+)\}(.*)$/isU", $text, $matches))
      {
      $p = explode('|', $matches[2]);
      foreach ($p as $comb)
         textGenerator($matches[1].$comb.$matches[3]);
      }
   else
      {
      $result[] = $text;
      return 0;
      }
   return array_values(array_unique($result));
   }

$string = $modx->getChunk('textGenerator'); //получаем исходный текст для генерации из чанка textGenerator
$variation = textGenerator($string); // все сгенерированные варианты
$count = count($variation); // подсчет общего кол-ва
$result = $variation[rand(0, $count - 1)]; // выбираем случайный вариант

$resource->set($field, $result); // Устанавливаем новые значения в поле "Описание" [[*description]]
$resource->save(); // и сохраняем объект
return;
