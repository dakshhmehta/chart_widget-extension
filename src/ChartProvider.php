<?php

namespace Ri\ChartWidgetExtension;

use Illuminate\Foundation\Bus\DispatchesJobs;

class ChartProvider
{
	use DispatchesJobs;

	protected static $charts = [];

	public function register($provider)
	{
		static::$charts[] = $provider;
	}

	public function getRegisteredCharts()
	{
		return static::$charts;
	}
}