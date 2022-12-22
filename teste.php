<?php

$valor = '7050';

echo (float)preg_replace("/(.*)(\d{2})$/", "$1.$2", $valor);
