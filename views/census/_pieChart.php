<?php 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
?>
<div id="pie" class="col-lg-12">
<?php 
echo Highcharts::widget([
        'options'=>[
            'chart'=> [
                'type'=> 'pie',
                'height'=>'550',
                'renderTo'=>'pie' //MUY IMPORTANTE PARA QUE EL GRÁFICO SE MUESTRE EN EL CONTENEDOR CORRECTO!//
            ],
            'title'=>[
                'text'=> 'Cantidades por especie'
            ],
            'credits'=>[
                'enabled'=>false
            ],
            'tooltip'=> [
                'formatter' => new JsExpression(
                                    'function(){ return "<b>"+this.point.name+"<br>Cantidad:"+ this.point.y;}'),
            ],   
            'series'=> [[
                'type'=> 'pie',
                'allowPointSelect'=> true,
                'keys'=> ['name', 'y', 'selected', 'sliced'],
                'data'=> $porcentages,
                'showInLegend'=> true
            ]]
        ]
    ]);

?>
</div>

<div class="col-lg-2 col-lg-offset-5">
    <div class="col-lg-12 form-center">
        <table class="table table-striped table-bordered table-hover table-condensed form-center">
            <thead>
            <tr>
                <th>Especie</th>
                <th>Cantidad</th>
            </tr>
            </thead>
            <tbody>
            <?php

                foreach ($species as $key => $value) {
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