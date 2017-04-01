<?php namespace Ri\ChartWidgetExtension;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;

class ChartWidgetExtension extends WidgetExtension
{

    /**
     * This extension provides...
     *
     * This should contain the dot namespace
     * of the addon this extension is for followed
     * by the purpose.variation of the extension.
     *
     * For example anomaly.module.store::gateway.stripe
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.dashboard::widget.chart';

    public function load(WidgetInterface $widget){
        $this->dispatch(new RenderChart($widget));
    }
}
