<?php 
use miloschuman\highcharts\Highcharts;
use yii\helpers\Json;
yii::error(\yii\helpers\VarDumper::dumpAsString($porcentajes));
?>

<div class="row">
    <div class="col-lg-12" align="center">
      <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
          <tr>
              <th>Especie</th>
              <th>Cantidad</th>
          </tr>
          </thead>
          <tbody>
          <?php

              foreach ($especies as $key => $value) {
                  echo '<tr>
                          <td>'.$value['nombre'].'</td>
                          <td>'.$value['cantidad'].'</td>
                      </tr>';
              } 
          ?>
          </tbody>
      </table>
    </div>
</div> 
        
    <?php
     echo '<div class="row">
          <div id="pieChart" class="col-lg-12" align="center">
          '.HighCharts::widget([
                'scripts' => [
                  'highcharts-3d',
                ],
                'options' => [
                'chart' => [
                    'type' => 'pie',
                    'options3d'=> [
                      'enabled'=> true,
                      'alpha'=>45,
                      'beta'=>0
                    ],
                ],
                'title' => [
                    'text' => 'Ocupación'
                    ],
                'tooltip' => [
                  'pointFormat'=>'{series.name}: <b>{point.percentage:.1f}%</b>'
                ],
                'plotOptions'=>[
                  'pie' => [
                    // 'innerSize'=>100,
                    'depth'=>35,
                    'allowPointSelect' =>  true,
                    'cursor'=> 'pointer',
                    'dataLabels'=>[
                        'enabled'=> true,
                        'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                    ]
                  ]
                      ],
                'series' => [
                    [
                      'type'=>'pie',
                      'name' => 'Especies', 
                      'colorByPoint'=>true,
                      'data' => $porcentajes
                    ],
                  ]
                ]
              ]).'
          </div>
        </div>';

?>