<?php

return [
	'chart_handler' => [
		'type' => 'anomaly.field_type.select',
		'required' => true,
		'config' => [
			'mode' => 'search',
			'options' => [],
			'handler' => 'Anomaly\ChartWidgetExtension\RegisteredChartsOptions',
		],
	],
];