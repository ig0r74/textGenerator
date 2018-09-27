<?php

if ($modx->event->name != 'OnDocFormSave') {return;}

if (!$modx->getOption('textgenerator_use_plugin')) {return;}

$field = $modx->getOption('textgenerator_plugin_field');
$inputChunk = $modx->getOption('textgenerator_plugin_input_chunk');

if ($resource->get($field) != '') {return;}

$result = $modx->runSnippet('textGenerator', array(
	'inputChunk' => $inputChunk,
	)
);

$resource->set($field, $result);
$resource->save();

return;