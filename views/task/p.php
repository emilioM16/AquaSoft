<?php

// print_r($supplies);
    foreach ($supplies as $key => $supply) {
               echo $supply->idInsumo.' '.$supply->quantity;
            }
?>