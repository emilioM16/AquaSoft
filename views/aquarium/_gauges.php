
<?php 
use miloschuman\highcharts\Highcharts;
use app\models\conditions\EnviromentalConditions;


foreach ($condiciones as $nombre => $valor) {

    $suffix = EnviromentalConditions::getSuffix($nombre);

    $col = 'col-lg-6';
    $size = '70%';

    if($nombre=='temperatura'){
        $col = 'col-lg-12';
        $size = '50%';
    }
      
    echo  '<div class="'.$col.'">
        '.HighCharts::widget([
            'scripts' => [
            'highcharts-more',
            ],
            'options'=>[
                'chart'=> [
                    'type'=> 'gauge',
                    'plotBackgroundColor'=> null,
                    'plotBackgroundImage'=> null,
                    'plotBorderWidth'=> 0,
                    'plotShadow'=> false
                ],
        
            'title'=> [
                'text'=>strtoupper($nombre)
            ],
        
            'pane'=> [
                'center'=> ['50%', '30%'],
                'startAngle'=> -150,
                'endAngle'=> 150,
                'size'=>$size,
                'background'=> [[
                    'backgroundColor'=> [
                        'linearGradient'=> [ 'x1'=> 0, 'y1'=> 0, 'x2'=> 0, 'y2'=> 1 ],
                        'stops'=> [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    ],
                    'borderWidth'=> 0,
                    'outerRadius'=> '109%'
                ], [
                    'backgroundColor'=> [
                        'linearGradient'=> [ 'x1'=> 0, 'y1'=> 0, 'x2'=> 0, 'y2'=> 1 ],
                        'stops'=> [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    ],
                    'borderWidth'=> 1,
                    'outerRadius'=> '107%'
                ], [
                    // default background
                ], [
                    'backgroundColor'=> '#DDD',
                    'borderWidth'=> 0,
                    'outerRadius'=> '105%',
                    'innerRadius'=> '103%'
                ]]
            ],
        
            // the value axis
            'yAxis'=> [
                'min'=> 0,
                'max'=> 100,
        
                'minorTickInterval'=> 'auto',
                'minorTickWidth'=> 1,
                'minorTickLength'=> 10,
                'minorTickPosition'=> 'inside',
                'minorTickColor'=> '#666',
        
                'tickPixelInterval'=> 30,
                'tickWidth'=> 2,
                'tickPosition'=> 'inside',
                'tickLength'=> 10,
                'tickColor'=> '#666',
                'labels'=> [
                    'step'=> 2,
                    'rotation'=> 'auto'
                ],
                'title'=> [
                    'text'=> $suffix
                ],
                'plotBands'=> [[
                    'from'=> 0,
                    'to'=> 70,
                    'color'=> '#55BF3B' // green
                ], [
                    'from'=> 70,
                    'to'=> 80,
                    'color'=> '#DDDF0D' // yellow
                ], [
                    'from'=> 80,
                    'to'=> 100,
                    'color'=> '#DF5353' // red
                ]]
            ],
        
            'series'=> [[
                'name'=> 'Speed',
                'data'=> [(float)$valor],
                'tooltip'=> [
                    'valueSuffix'=> 'km/h'
                ]
            ]]
            ]
        ])
        .'</div>';
}
      ?>