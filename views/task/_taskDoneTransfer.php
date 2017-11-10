<br>
<div class="row" align="center">
<div class="col-lg-12 form-center">
    <h5 class="text-center"><b>Detalle de la transferencia de "<?= $movements[0]->ejemplar->especie['nombre']?>"</b></h5>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>Destino</th>
            <th>Cantidad</th> 
        </tr>
        <?php
            foreach ($movements as $key => $movement) {
                if($movement['cantidad']>0){
                    echo '<tr>
                    <td>'.$movement->ejemplar->acuario['nombre'].'</td> 
                    <td>'.$movement['cantidad'].'</td>
                    </tr>';
                }
            }
        ?>
    </table>
</div>
</div>