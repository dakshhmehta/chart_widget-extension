<?php

namespace Anomaly\ChartWidgetExtension;

use Anomaly\ChartWidgetExtension\ChartProvider;

class RegisteredChartsOptions
{
	public function handle($fieldType, ChartProvider $charts)
	{
		$options = [];

		foreach ($charts->getRegisteredCharts() as $chartBuilder) {
			$chart = app()->make($chartBuilder);

			$options[$chartBuilder] = $chart->getTitle();
		}

		$fieldType->setOptions($options);
	}
}