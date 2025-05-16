<?php
    function preco_convertido(float $preco)
{
    return "R$: " . number_format($preco, 2, ",");
}

