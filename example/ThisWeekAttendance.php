<?php

namespace Ri\EmsModule\Chart;

use Anomaly\ChartWidgetExtension\ChartBuilder;
use Carbon\Carbon;
use Ri\EmsModule\EmployeeAttendance\EmployeeAttendanceModel;

/**
 * To register this chart, add the following line
 * in your service provider when module is installed
 * 
 * <code>
 *    app()->make(ChartProvider::class)->register(DailyAttendance::class);
 * </code>
 */
class ThisWeekAttendance extends ChartBuilder
{
	protected $title = 'Daily Attendance';

	protected $type = 'line';

	public function prepare()
	{
		$data = [];

		$startOfWeek = Carbon::now()->startOfWeek();

		$i = 0;
		for($day = $startOfWeek; $day <= Carbon::now()->endOfWeek(); $day->addDay()){
			$data[$i]['date'] = $day->format('d/m/Y');
			$data[$i]['amount'] = 0;
			$data[$i]['present'] = 0;

			$attendances = EmployeeAttendanceModel::where('date', $day)->get();

			foreach ($attendances as &$attendance) {
				if($attendance->type == 1){
					$duration = ($attendance->duration == 1) ? 1 : 0.5;
					$data[$i]['present'] += $duration;

					if($duration == 1){
						$data[$i]['amount'] += $attendance->full_day_pay;
					}
					else {
						$data[$i]['amount'] += $attendance->half_day_pay;
					}
				}
			}

			$i++;
		}

		$this->options['data'] = $data;
		$this->options['xkey'] = 'date';
		$this->options['ykeys'] = ['amount', 'present'];
		$this->options['labels'] = ['Salary', 'Presentees'];
	}
}