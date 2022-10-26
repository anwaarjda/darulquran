<?php
/**
 * Name:    Hijri Date API
 * Author:  Shoaib Shams
 *          shoaibshamshere@gmail.com
 *
 * Created:  21-11-2021
 *
 * Version: 1.0
 *
 * Description:  This API is made for centralizing Hijri date system in Jamia Darululoom Karachi.
 *
 * Requirements: PHP7 or above
 *
 * @package    hijri-date-api
 * @author     Shoaib Shams
 * @link       http://git.jdu.pk/IT-Department/hijri-date-api
 */

/**
 * Class Hijri
 */

class Hijri {
    private $api_key 		= '0bafc537-fd64-4815-9766-f0726ef4fcae';
    private $url 	        = "http://erp.jdu.pk/Api/";
    private $error 	        = "";

    function __construct(){
        $this->check_config();
    }

    /*================================================
        checking api key and url
    ================================================*/
    private function check_config()
    {
        if (empty($this->api_key))
        {
            $this->error = "Please provide API key";
        }

        if (empty($this->url))
        {
            $this->error = "Please provide correct URL";
        }
    }

    /*================================================
        fetching Hijri date
    ================================================*/
    public function hijri($fields){
        if ($this->error) return $this->error;

        return $this->fetch('hijri',$fields);
    }


    /**
     * Fetching gregorian date by sending Hijri date
     *
     *
     * Hijri date format should be Y-m-d like 1442-12-29
     *
     * @param	array	$fields		keys =>date
     * @return	object
     */

    public function gregorian($fields){
        if ($this->error) return $this->error;

        return $this->fetch('gregorian',$fields);
    }

    /*================================================
        fetching Hijri month
    ================================================*/
    public function hijriMonth($fields){
        if ($this->error) return $this->error;

        return $this->fetch('hijriMonth',$fields);
    }

    /*================================================
        fetching Gregorian month
    ================================================*/
    public function gregorianMonth($fields){
        if ($this->error) return $this->error;

        return $this->fetch('gregorianMonth',$fields);
    }

    /*================================================
        fetching Hijri dates range
    ================================================*/
    public function hijriRange($fields){
        if ($this->error) return $this->error;

        return $this->fetch('hijriRange',$fields);
    }

    /*================================================
        fetching Gregorian dates range
    ================================================*/
    public function gregorianRange($fields){
        if ($this->error) return $this->error;

        return $this->fetch('gregorianRange',$fields);
    }

    public function fetch($method = null,$fields)
    {
        $this->error = null;
        $curl_handle = curl_init();
        $params = http_build_query($fields);
        $headers = array(
            'api-key: '.$this->api_key
        );
        curl_setopt($curl_handle, CURLOPT_URL, $this->url.$method.'?'.$params);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 5);

        $buffer = curl_exec($curl_handle);
        if (curl_errno($curl_handle)) {
            $this->error = curl_error($curl_handle);
        }
        curl_close($curl_handle);
        if(!empty($this->error))
        {
            return $this->error;
        }
        return json_decode($buffer,true);
    }

}
