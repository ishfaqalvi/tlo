<?php


use App\Models\Setting;
use App\Models\Indicator\ResultFramework;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function uploadFile($file, $path, $width, $height)
{
    $extension = $file->getClientOriginalExtension();
    $name = uniqid().".".$extension;
 
    $folder = 'upload/images/'.$path;
    $finalPath = $folder.'/'.$name;
    $file->move($folder, $name);

    Image::load($finalPath)->fit(Manipulations::FIT_CROP, $width, $height)->save(public_path($finalPath));
    return $finalPath;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function settings($key)
{
    return Setting::get($key);
}

/**
 * Get calculated result of data collections based on the indicator type.
 *
 * @param  \App\Models\Indicator  $indicator
 * @return array
 */
function getIndicatorActualVsTarget($indicator)
{
    $collectedValues = $indicator->dataCollections()->pluck('collected_value')->all();

    switch ($indicator->total_vs_actual_formula) {
        case 'Sum':
            $calculatedValue = array_sum($collectedValues);
            break;

        case 'Average':
            $calculatedValue = count($collectedValues) > 0 ? array_sum($collectedValues) / count($collectedValues) : 0;
            break;

        case 'Median':
            $calculatedValue = calculateMedian($collectedValues);
            break;

        default:
            $calculatedValue = 0;
    }

    $actual = $indicator->target;
    $percentage = $calculatedValue > 0 ? round(($calculatedValue * 100) / $actual,1) : 0;
    $stat = number_format($calculatedValue) . ' -/ ' . number_format($actual);
    $remaining = $actual - $calculatedValue;

    return [
        'stat'       => $stat, 
        'percentage' => $percentage,
        'target'     => $actual,
        'calculated' => $calculatedValue
    ];
}

/**
 * Get calculated result of data collections based on the indicator type.
 *
 * @param  \App\Models\Indicator  $indicator
 * @return array
 */
function calculateAggregatedTarget($indicator)
{
    $subData = array();
    foreach ($indicator->contributers as $row) {
        $collectedValues = $row->contributer->dataCollections()->pluck('collected_value')->all();
        switch ($row->contributer->total_vs_actual_formula) {
            case 'Sum':
                $calculatedValue = array_sum($collectedValues);
                break;

            case 'Average':
                $calculatedValue = count($collectedValues) > 0 ? array_sum($collectedValues) / count($collectedValues) : 0;
                break;

            case 'Median':
                $calculatedValue = calculateMedian($collectedValues);
                break;

            default:
                $calculatedValue = 0;
        }
        $subData[] = ['target' => $row->contributer->target, 'actual' => $calculatedValue];
    }

    $aggregatedTarget = $indicator->aggregation_formula == 'Multiplication' ? 1 : 0;
    $aggregatedActual = $indicator->aggregation_formula == 'Multiplication' ? 1 : 0;
    foreach ($subData as $index => $subRow) {
        switch ($indicator->aggregation_formula) {
            case 'Sum':
            case 'Average':
                $aggregatedTarget += $subRow['target'];
                $aggregatedActual += $subRow['actual'];
                break;

            case 'Subtraction':
                $aggregatedTarget -= $subRow['target'];
                $aggregatedActual -= $subRow['actual'];
                break;

            case 'Multiplication':
                $aggregatedTarget *= $subRow['target'];
                $aggregatedActual *= $subRow['actual'];
                break;

            case 'Division':
                if ($index == 0) {
                    $aggregatedTarget = $subRow['target'];
                    $aggregatedActual = $subRow['actual'];
                } else {
                    $aggregatedTarget /= $subRow['target'];
                    $aggregatedActual /= $subRow['actual'];
                }
                break;
        }
    }

    if ($indicator->aggregation_formula == 'Average' && count($subData) > 0) {
        $aggregatedTarget /= count($subData);
        $aggregatedActual /= count($subData);
    }

    $actual = $indicator->target;
    $percentage = $aggregatedActual > 0 ? round(($aggregatedActual * 100) / $actual, 1) : 0;
    $stat = number_format($aggregatedActual) . ' -/ ' . number_format($actual);

    return [
        'aggregated_target' => $aggregatedTarget,
        'aggregated_actual' => $aggregatedActual,
        'stat' => $stat,
        'percentage' => $percentage
    ];
}

/**
 * Helper function to calculate median.
 *
 * @param  array  $values
 * @return float
 */
function calculateMedian($values)
{
    sort($values);
    $count = count($values);
    $middleVal = floor(($count - 1) / 2);
    if ($count % 2) {
        $median = $values[$middleVal];
    } else {
        $median = ($values[$middleVal] + $values[$middleVal + 1]) / 2;
    }
    return $median;
}
