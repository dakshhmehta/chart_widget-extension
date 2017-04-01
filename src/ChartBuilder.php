<?php

namespace Ri\ChartWidgetExtension;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;

class ChartBuilder
{
	protected $title = null;

	protected $type = null;

	protected $options = [];

	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}

	public function setOptions($options)
	{
		$this->options = $options;

		return $this;
	}

	public function setOption($key, $value)
	{
		$this->options[$key] = $value;

		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getOptions()
	{
		return $this->options;
	}

	public function build(WidgetInterface $widget)
	{
		$this->options['element'] = md5($widget->id);

		$this->prepare();

		if($this->type == 'line'){
			if( !isset($this->options['data']) or 
				!isset($this->options['xkey']) or 
				!isset($this->options['ykeys']) or
				!isset($this->options['labels'])
			){
				$widget->addData('error', 'Missing one of the required parameter to render this chart.');

				return false;
			}

			$widget->addData('options', $this->options);
		}
	}
}