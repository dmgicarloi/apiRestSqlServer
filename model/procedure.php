<?php

include "functions.php";

class procedure extends functions {

    public function execSp($sp, $prepareparams, $params) {
        $microtimeStart = microtime(true);
        $param = is_array($params) ? $params : [""];
        $link = parent::connect();
        $query = "exec $sp $prepareparams";
        $result = parent::executeQuery($link, $query, $param);
        $data = parent::multiQuery($result);
        parent::disconnect($link);
        $microtimeEnd = microtime(true);
        $microtime = $microtimeEnd - $microtimeStart;
        return ($result) ? parent::data($data, $microtime) : parent::error();
    }

    public function prepareSp($POST) {
        unset($POST['url']);
        $sp = $POST["sp"];
        $params = array();
        $prepareparams = array();
        $object = (object) array();
        $i = 0;
        unset($POST['sp']);
        foreach ($POST as $key => $value) {
            $htmlentities = htmlentities($value);
            $params[$i] = parent::entities_to_tilde($htmlentities);
            $prepareparams[$i] = $key . '=?';
            $i += 1;
        }
        $setparams = implode(",", $prepareparams);
        $object->sp = $sp;
        $object->prepareparams = $setparams;
        $object->params = $params;
        return $object;
    }

    public function accessDenied() {
        header("content-type:application/json");
        echo json_encode(array("resp" => false, "error" => "Access Denied", "errno" => "Reason = >"));
    }

}
