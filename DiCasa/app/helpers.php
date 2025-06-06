<?php   

    //arquivos auxiliares de lógica de negócio devem ficar aqui

    //funcao que converte valor em decimal para um texto em real
   function precoConvertidoEmReais($valor): string
    {
        // o (float) garante que converta o valor em float, mesmo que não seja (ex: decimal)
        return "R$: " . number_format((float)$valor, 2, ",",".");
    }