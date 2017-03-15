<?php

include "connection.php";

class functions extends connection {

    protected function entities_to_tilde($string) {
        $search = array('&aacute;', '&Aacute;', '&eacute;', '&Eacute;', '&iacute;', '&Iacute;', '&oacute;', '&Oacute;', '&uacute;', '&Uacute;', '&ntilde;', '&Ntilde;', '&quot;');
        $replace = array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ñ', 'Ñ', '"');
        $string_replace = str_replace($search, $replace, $string);
        return $string_replace;
    }

    protected function executeQuery($link, $query, $params) {
        if ($link) {
            return sqlsrv_query($link, $query, $params);
        } else {
            $this->error = parent::getErrorSql();
            return false;
        }
    }

    protected function data($data, $microtime) {
        return array("resp" => true, "load" => round($microtime, 4), "datos" => $data);
    }

    protected function error() {
        return $this->error;
    }

    protected function getRows($result) {
        $rows = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    protected function getFields($result) {
        $fields = array();
        $j = 0;

        foreach (sqlsrv_field_metadata($result) as $fieldMetadata) {
            $fields[$j] = utf8_encode($fieldMetadata['Name']);
            $j +=1;
        }
        return $fields;
    }

    protected function multiQuery($result) {
        if ($result) {
            $informacion = array("campos" => null, "data" => null);
            $multidata = array();
            do {
                if (sqlsrv_num_fields($result)) {
                    $informacion["campos"] = $this->getFields($result);
                    $informacion["data"] = $this->getRows($result);
                    array_push($multidata, $informacion);
                }
            } while (sqlsrv_next_result($result));
            return $multidata;
        } else {
            $this->error = parent::getErrorSql();
            return false;
        }
    }

}
