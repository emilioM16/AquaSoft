<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\planning\Planning */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Planificacion nueva', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="planning-calendar">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $model->idPlanificacion ?><br>



<!-- arreglo de sesiones que trae la Planificacion
calendario -->


<!--
$JSEventClick = <<<EOF
    function(calEvent, jsEvent, view) {
    alert('Event: ' + calEvent.title);
    alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
    alert('View: ' + view.name);
    // change the border color just for fun
    $(this).css('border-color', 'red');
    }
EOF;


$JSCode = <<<EOF
    function(start, end) {
    var date = $('#calendar').fullCalendar('getDate');
    $('div.modal-header').html('<h4 class="text-center"> Registrar tarea para el ' + end.format('dddd D, MMMM YYYY')+'</h4>');
    $('#pModal').modal();
    }
EOF; -->




<div id="pCalendar" class="row">
<div class="col-lg-12">
    <div class="col-lg-6 form-center">
        <?= \yii2fullcalendar\yii2fullcalendar::widget([
            'id'=>'calendar',
            'defaultView'=>'month',
            'header'=>[
                'left'=>'',
                'center'=>'title',
                'right'=>'',
            ],
            'clientOptions'=>[
                'selectable' => true,
                'selectHelper' => true,
                'editable' => false,
                'fixedWeekCount'=>false,
                'showNonCurrentDates'=>false,
              //  'select' => new JsExpression($JSCode),
            //    'eventClick' => new JsExpression($JSEventClick),
                'defaultDate' => date('d-m-Y'),
                'firstDay'=>1,
            ],
            'options' => [
                'lang' => 'es',
            ],
            // 'events' => $events,
        ]);

        // Modal::begin([
        //     'id'=>'pModal',
        //     'size'=>'modal-md',
        //     'closeButton'=>[],
        //     'footer'=>
        //         Html::button(FA::icon('save')->size(FA::SIZE_LARGE).' Guardar', ['class' => 'btn btn-success']).
        //         Html::button(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar',['class' => 'btn btn-danger','data-dismiss'=>'modal'])
        //
        //     ]);
        //
        //   //  echo '<div class="contenidoModal">'.$this->render('_form').'</div>';
        //
        // Modal::end();

        ?>
        <div id="pButtons" class="form-group">
            <?= Html::button(FA::icon('save')->size(FA::SIZE_LARGE).' Guardar', ['class' => 'btn btn-success']) ?>
            <?= Html::a(FA::icon('remove')->size(FA::SIZE_LARGE).' Cancelar', ['index'] ,['class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>
</div>



</div>
