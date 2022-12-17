<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carne</title>
    <style>
        @media print {
    .noprint {
        display:none;
    }
}

body{
    background-color: #ffffff;
    margin-right: 0;
}

.table-boleto {
    font: 9px Arial;
    width: 666px;
}

.table-boleto td {
    border-left: 1px solid #000;
    border-top: 1px solid #000;
}

.table-boleto td:last-child {
    border-right: 1px solid #000;
}

.table-boleto .titulo {
    color: #000033;
}

.linha-pontilhada {
    color: #000033;
    font: 9px Arial;
    width: 100%;
    border-bottom: 1px dashed #000;
    text-align: right;
    margin-bottom: 10px;
}

.table-boleto .conteudo {
    font: bold 10px Arial;
    height: 11.5px;
}

.table-boleto .sacador {
    display: inline;
    margin-left: 5px;
}

.table-boleto td {
    padding: 1px 4px;
}

.table-boleto .noleftborder {
    border-left: none !important;
}

.table-boleto .notopborder {
    border-top: none !important;
}

.table-boleto .norightborder {
    border-right: none !important;
}

.table-boleto .noborder {
    border: none !important;
}

.table-boleto .bottomborder {
    border-bottom: 1px solid #000 !important;
}

.table-boleto .rtl {
    text-align: right;
}

.table-boleto .logobanco {
    display: inline-block;
    max-width: 150px;
}

.table-boleto .logocontainer {
    width: 257px;
    display: inline-block;
}

.table-boleto .logobanco img {
    margin-bottom: -5px;
    height: 27px;
}

.table-boleto .codbanco {
    font: bold 20px Arial;
    padding: 1px 5px;
    display: inline;
    border-left: 2px solid #000;
    border-right: 2px solid #000;
    width: 51px;
    margin-left: 25px;
}

.table-boleto .linha-digitavel {
    font: bold 14px Arial;
    display: inline-block;
    width: 406px;
    text-align: right;
}

.table-boleto .nopadding {
    padding: 0px !important;
}

.table-boleto .caixa-gray-bg {
    font-weight: bold;
    background: #ccc;
}

.info {
    font: 11px Arial;
}

.info-empresa {
    font: 11px Arial;
}

.header {
    font: bold 13px Arial;
    display: block;
    margin: 4px;
}

.barcode {
    height: 50px;
}

.barcode div {
    display: inline-block;
    height: 100%;
}

.barcode .black {
    border-color: #000;
    border-left-style: solid;
    width: 0px;
}

.barcode .white {
    background: #fff;
}

.barcode .thin.black {
    border-left-width: 1px;
}

.barcode .large.black {
    border-left-width: 3px;
}

.barcode .thin.white {
    width: 1px;
}

.barcode .large.white {
    width: 3px;
}

.float_left{
    float:left;
}

.center {
    text-align: center;
}

.conteudo.cpf_cnpj{
    float:right;
    width:24%;
}
    </style>
</head>
<body>
    @foreach($boletos as $boleto)
       
        @include('carne-item', $boleto)
        @if(($loop->index+1) % 3 == 0) 
            <div style="page-break-after: always"></div>
        @endif
    @endforeach
</html>