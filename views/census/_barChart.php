<?php   
use yii\web\JsExpression;
use miloschuman\highcharts\Highcharts;
?>

<div id="bar" class="col-lg-12 form-center">
<?php
                // echo Highcharts=>=>widget([
                //     'options'=>[
                //         'chart'=> [
                //             'type'=> 'column',
                //             'renderTo'=>'chart' //MUY IMPORTANTE PARA QUE EL GRÁFICO SE MUESTRE EN EL CONTENEDOR CORRECTO!//
                //         ],
                //         'title'=> [
                //             'text'=> 'Cantidad de ejemplares por acuario'
                //         ],
                //         'subtitle'=> [
                //         ],
                //         'xAxis'=> [
                //             'categories'=> $data[0],
                //             'crosshair'=> false
                //         ],
                //         'credits'=>[
                //             'enabled'=>false
                //         ],
                //         'yAxis'=> [
                //             'min'=> 0,
                //             'title'=> [
                //                 'text'=> 'Cantidad'
                //             ]
                //         ],
                //         'tooltip'=> [
                //             'headerFormat'=> '<span style="font-size=>10px">[point.key]</span><table>',
                //             'pointFormat'=> '<tr><td style="color=>[series.color];padding=>0">[series.name]=> </td>' +
                //                 '<td style="padding=>0"><b>[point.y=>.1f] mm</b></td></tr>',
                //             'footerFormat'=> '</table>',
                //             'shared'=> true,
                //             'useHTML'=> true
                //         ],
                //         'plotOptions'=> [
                //             'column'=> [
                //                 'pointPadding'=> 0.2,
                //                 'borderWidth'=> 0
                //             ]
                //         ],
                //             'series'=>$data[1],
                //     ]
                // ]);


    echo Highcharts::widget([
            'options'=>[
                'chart'=> [
                    'type'=> 'column',
                    'renderTo' => 'bar'
                ],
                'title'=> [
                    'text'=> 'Cantidad de ejemplares por acuario'
                ],
                'xAxis'=> [
                    'categories'=> $data[0],
                ],
                'credits'=>[
                    'enabled'=>false
                ],
                'yAxis'=> [
                    'min'=> 0,
                    'title'=> [
                        'text'=> 'Cantidad'
                    ],
                    'stackLabels'=> [
                        'enabled'=> true,
                        'style'=> [
                            'fontWeight'=> 'bold',
                            'color'=> ('Highcharts.theme' && 'Highcharts.theme.textColor') || 'gray'
                        ]
                    ]
                ],
                'legend'=> [
                    'align'=> 'right',
                    'x'=> -30,
                    'verticalAlign'=> 'top',
                    'y'=> 25,
                    'floating'=> true,
                    'backgroundColor'=> ('Highcharts.theme' && 'Highcharts.theme.background2') || 'white',
                    'borderColor'=> '#CCC',
                    'borderWidth'=> 1,
                    'shadow'=> false
                ],
                'tooltip'=> [
                    'formatter' => new JsExpression(
                                        'function(){ return "<b>"+this.series.name+":"+ this.point.y+"</b><br>Total: "+this.point.stackTotal; }'),
                    'headerFormat'=> new JsExpression('function(){return point.x;}'),
                    'pointFormat'=> new JsExpression('function(){return series.name;}'),
                ],
                'plotOptions'=> [
                    'column'=> [
                        'stacking'=> 'normal',
                        'dataLabels'=> [
                            'enabled'=> true,
                            'color'=> ('Highcharts.theme' && 'Highcharts.theme.dataLabelsColor') || 'white'
                        ]
                    ]
                ],
                'series'=> $data[1],
            ]
        ]);
        ?>
</div>
                
        <div id="pie" class="col-lg-12">
        <?php 
        echo Highcharts::widget([
                'options'=>[
                    'chart'=> [
                        'type'=> 'pie',
                        'renderTo'=>'pie' //MUY IMPORTANTE PARA QUE EL GRÁFICO SE MUESTRE EN EL CONTENEDOR CORRECTO!//
                    ],
                    'title'=>[
                        'text'=> 'Cantidades por especie'
                    ],
                    'credits'=>[
                        'enabled'=>false
                    ],     
                    'series'=> [[
                        'type'=> 'pie',
                        'allowPointSelect'=> true,
                        'keys'=> ['name', 'y', 'selected', 'sliced'],
                        'data'=> $data[2],
                        'showInLegend'=> true
                    ]]
                ]
            ]);
        
        ?>
        </div>
