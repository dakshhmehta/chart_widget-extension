<?php

namespace Anomaly\ChartWidgetExtension;

use Anomaly\ConfigurationModule\Configuration\ConfigurationRepository;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;

class RenderChart
{
	private $widget;
	private $chart;

	function __construct(WidgetInterface $widget)
	{
		$this->widget = $widget;
	}

	public function handle(ConfigurationRepository $config)
	{
		$handler = $config->value('anomaly.extension.chart_widget::chart_handler', $this->widget->getId());

		$this->chart = app()->make($handler);
		$this->chart->build($this->widget);
	}
}