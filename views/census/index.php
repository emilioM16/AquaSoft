<?php

use yii\helpers\Html;
// use yii\bootstrap\Modal;
// use yii\helpers\Url;
// use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;

use app\models\aquarium\Aquarium;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaUsuario */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Censos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="census-index">
    <div class="row">
        <div id="form" class="col-lg-12">
            <div class="well col-lg-2 form-center">
                <div class="col-lg-12 form-center" style="width:auto">
                    <?php
                        //Select de especies//
                        echo '<label class="control-label">Acuario</label>';
                        echo Select2::widget([
                            'id'=>'selectCensusAquarium', 
                            'name' => 'selectCensusAquarium',
                            'data' => ArrayHelper::map($aquariums,'idAcuario','nombre'),
                            'options' => [
                                'placeholder' => 'Seleccione un acuario...',
                            ],
                        ]);
                    ?>
                </div>
                <div class="col-lg-12 form-center" align="center">
                    <?= Html::button(FA::icon("check")->size(FA::SIZE_LARGE).' Aceptar',['id'=>'acceptBtn','class'=>'btn btn-success','disabled'=>true])?>
                </div>
            </div>
        </div>

        <div id="chart" class="col-lg-12">
            <?php
                $data = [
                            [
                                'A01',
                                'A02',
                                'A04',
                                'A05'
                            ],
                            [
                                [
                                    'name'=>'Globo',
                                    'data'=>[3,0,5,10]
                                ],
                                [
                                    'name'=>'Payaso',
                                    'data'=>[33,4,51]
                                ],
                                [
                                    'name'=>'Carpín dorado',
                                    'data'=>[12,3,8,9]
                                ]
                            ]
                        ];

                
                echo Highcharts::widget([
                    'options'=>[
                        'chart'=> [
                            'type'=> 'column'
                        ],
                        'title'=> [
                            'text'=> 'Cantidad de ejemplares por acuario'
                        ],
                        'subtitle'=> [
                        ],
                        'xAxis'=> [
                            'categories'=> $data[0],
                            'crosshair'=> false
                        ],
                        'yAxis'=> [
                            'min'=> 0,
                            'title'=> [
                                'text'=> 'Cantidad'
                            ]
                        ],
                        'tooltip'=> [
                            'headerFormat'=> '<span style="font-size:10px">[point.key]</span><table>',
                            'pointFormat'=> '<tr><td style="color:[series.color];padding:0">[series.name]: </td>' +
                                '<td style="padding:0"><b>[point.y:.1f] mm</b></td></tr>',
                            'footerFormat'=> '</table>',
                            'shared'=> true,
                            'useHTML'=> true
                        ],
                        'plotOptions'=> [
                            'column'=> [
                                'pointPadding'=> 0.2,
                                'borderWidth'=> 0
                            ]
                        ],
                            'series'=>$data[1],
                        // 'series'=> [[
                        //     'name'=> 'Tokyo',
                        //     'data'=> [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
                    
                        // ], [
                        //     'name'=> 'New York',
                        //     'data'=> [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
                    
                        // ], [
                        //     'name'=>'London',
                        //     'data'=>[48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
                    
                        // ], [
                        //     'name'=>'Berlin',
                        //     'data'=> [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
                    
                        // ]]
                    ]
                ]);
            ?>
        </div>
    </div> 
</div>
    