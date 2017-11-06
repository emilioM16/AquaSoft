<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaUsuario */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Censo';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="census-index">

    <h1 align="center"><?= Html::encode($this->title) ?></h1>
    <hr>

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
                    
                    <?php
                    if(Yii::$app->user->can('accederReporte')){
                        echo Html::a(FA::icon("file-text-o")->size(FA::SIZE_LARGE)." Generar reporte",
                            Url::toRoute([
                                    'reportico/mode/execute',
                                    'project' => 'AquaSoft', 
                                    'project_password' => 'aquasoft',  // Only necessary for password protected projects
                                    'new_reportico_window' => 1,
                                    'report' => 'Censo.xml',
                                    'reportico_ajax_request'=>1,
                                    'printable_html' => 1,
                                    // 'reportico_bootstrap_preloaded'=>1
                                ]),
                                [
                                    'id'=>'censusReportBtn',
                                    "target" => "_blank",
                                    'class'=>'btn  btn-primary',
                                    'style'=>'margin-top:5%'
                                ]
                            );
                        }
                    ?>
                </div>
            </div>
        </div>

        <div id="chart" class="col-lg-12">

        </div>
    </div> 
</div>
    