<?php 
use miloschuman\highcharts\Highcharts;


echo '<div class="row">
          <div class="col-lg-12" align="center">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Especie</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Payaso</td>
                  <td>30</td>
                </tr>
                <tr>
                  <td>Carpín dorado</td>
                  <td>23</td>
                </tr>
                <tr>
                  <td>Pez beta</td>
                  <td>3</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div> 
        
        <div class="row">
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
                    'innerSize'=>100,
                    'depth'=>45,
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
                      'name' => 'Especies', 
                      'colorByPoint'=>true,
                      'data' => [
                        ['name'=>'Payaso','y'=> 53.57],
                        ['name'=>'Carpín dorado','y'=>41.07],
                        ['name'=>'Pez beta','y'=>5.35]
                      ]
                    ],
                  ]
                ]
              ]).'
          </div>
        </div>';

?>