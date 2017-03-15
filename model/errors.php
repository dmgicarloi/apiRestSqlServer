<?php

class errors {

    protected $error = array("resp" => true, "errno" => 0, "error" => 0);

    protected function setError() {
        $this->error['error'] = sqlsrv_errors()[0]['message'];
    }

    protected function setErrorNo() {
        $this->error['errno'] = sqlsrv_errors()[0]['code'];
    }

    protected function setResponse() {
        $this->error['resp'] = false;
    }

    protected function getError() {
        return $this->error["error"];
    }

    protected function getErrorNo() {
        return $this->error["errno"];
    }

    protected function getResponse() {
        return $this->error["resp"];
    }

    protected function getErrorSql() {
        $this->setError();
        $this->setErrorNo();
        $this->setResponse();
        return $this->error;
    }

}
