<br>
<div class="row" align="center">
<div class="col-lg-12 form-center">
    <h5 class="text-center"><b>Detalle de la incorporación de <?= $movements[0]->ejemplar->especie['nombre']?></b></h5>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>Especie</th>
            <th>Cantidad</th> 
        </tr>
        <?php
            if($movement['cantidad']>0){
                echo '<tr>
                <td>'.$movement->ejemplar->especie['nombre'].'</td> 
                <td>'.$movement['cantidad'].'</td>
                </tr>';
            }
        ?>
    </table>
</div>
</div>