<?php

function GeneralJson($code,$desc)
{
    return GeneralResult::create($code,$desc)->toJson();
}

function GeneralJsonResult($code,$desc,$result)
{
    return GeneralResult::create($code,$desc,$result)->toJson();
}


function GeneralSuccessJsonResult($result)
{
    return GeneralResult::createresult(constant('CODE_SUCCESS'),constant('DESC_SUCCESS'),$result)->toJson();
}

class GeneralResult {
    protected $errorcode = 0;
    protected $errordesc;
    protected $result;
    
    static function create($code,$desc) {
        $result = new GeneralResult($code,$desc);
        return $result;  
    }
    
    static function createresult($code,$desc,$result) {
        $result = new GeneralResult($code,$desc,$result);
        return $result;  
    }
    
    function __construct($code = null, $desc = null,$result = null) {
        $this->errorcode = $code;
        $this->errordesc = $desc;
        $this->result = $result; 
    }
    
    function toJson()
    {
        //echo $errorcode . $errordesc;
        return json_encode(array
        ( 
        	'errorcode' => $this->errorcode, 
        	'errordesc' => $this->errordesc,
        	'data' => $this->result == null ? array() : $this->result, 
        ));
    }
    
    
}