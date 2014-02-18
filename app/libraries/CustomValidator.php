<?php

class CustomValidator extends Illuminate\Validation\Validator {

    public function validateStrBetween($attribute, $value, $parameters)
    {
        $min = $parameters[0];
        $max = $parameters[1];
        $len = strlen($value);
        if($len >= $min && $len <= $max)
        {
        	return $value;
        }else{ return false;}
    }
    public function validateStrLen($attribute, $value, $parameters)
    {
        $cmp = $parameters[0];
        $len = strlen($value);
        if($len == $cmp)
        {
        	return $value;
        }else{ return false;}
    }
    public function validateTld($attribute, $value, $parameters)
    {
        return preg_match("/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/", $value);
    }
    public function validateNotExists($attribute,$value,$parameters)
    {
        $table = $parameters[0];
        $field = $parameters[1];
        $result = DB::table($table)->where($field,$value)->count();
        if($result > 0){ return false; }else{return $value;}
    }
    

}