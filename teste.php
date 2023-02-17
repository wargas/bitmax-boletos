<?php

$valor = '70501';

echo (float)preg_replace("/(.*)(\d{2})$/", "$1.$2", $valor);
