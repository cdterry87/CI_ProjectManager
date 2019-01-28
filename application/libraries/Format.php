<?php defined('BASEPATH') or exit('No direct script access allowed');

class Format
{

    /* --------------------------------------------------------------------------------
     * Format dates as YYYY-MM-DDTHH:MM:SS.
     * -------------------------------------------------------------------------------- */
    public function calendar_date($date)
    {
        if (strlen($date)==8) {
            return substr($date, 0, 4)."-".substr($date, 4, 2)."-".substr($date, 6, 2);
        }
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Format dates as MM/DD/YYYY.
     * -------------------------------------------------------------------------------- */
    public function date($date)
    {
        if (strlen($date)==8) {
            return substr($date, 4, 2)."/".substr($date, 6, 2)."/".substr($date, 0, 4);
        }
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Format times as MM:HH or MM:HH:SS.
     * -------------------------------------------------------------------------------- */
    public function time($time)
    {
        switch (strlen($time)==4) {
            case 4:
                return substr($time, 0, 2).":".substr($time, 2, 2);
                break;
            case 6:
                return substr($time, 0, 2).":".substr($time, 2, 2).":".substr($time, 4, 2);
                break;
        }
            
        return false;
    }
    
    /* --------------------------------------------------------------------------------
     * Format phones as (###) ### - #### or ### - ####.
     * -------------------------------------------------------------------------------- */
    public function phone($phone)
    {
        switch (strlen($phone)) {
            case 10:
                return "(".substr($phone, 0, 3).") ".substr($phone, 3, 3)." - ".substr($phone, 6, 4);
                break;
            case 7:
                return substr($phone, 0, 3)." - ".substr($phone, 3, 4);
                break;
        }
        return "N/A";
    }
    
    /* --------------------------------------------------------------------------------
     * Format phones as (###) ### - #### or ### - ####.
     * -------------------------------------------------------------------------------- */
    public function shorten($string, $length = 50, $front_only = false)
    {
        if ($front_only) {
            if (strlen($string) > ($length)) {
                $string = substr($string, 0, $length) . '...';
            }
        } else {
            if (strlen($string) > ($length + 12)) {
                $string = substr($string, 0, $length) . '...' . substr($string, -9);
            }
        }
        
        return $string;
    }
}
