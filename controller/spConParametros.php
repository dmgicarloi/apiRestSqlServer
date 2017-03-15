<?php

include "../model/procedure.php";
$procedimientos = new procedure();
$preparesp = $procedimientos->prepareSp(array("sp"=>"sp_persona_con_parametros", "@id"=>"1"));
$result = $procedimientos->execSp($preparesp->sp, $preparesp->prepareparams, $preparesp->params);
header("Content-type:application/json");
echo json_encode($result);