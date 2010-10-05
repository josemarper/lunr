<?php

/**
 * Date/Time related functions
 * @author M2Mobi, Heinz Wiesinger
 */
class M2DateTime
{

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Destructor
     */
    public function __destruct()
    {

    }

    /**
     * Return today's date (YYYY-MM-DD)
     * @return String Today's date
     */
    public static function today()
    {
        return date('Y-m-d');
    }

    /**
     * Return tomorrow's date (YYYY-MM-DD)
     * @return String Tomorrow's date
     */
    public static function tomorrow()
    {
        return date('Y-m-d', strtotime("+1 day"));
    }

    /**
     * Return the current time (HH:MM:SS)
     * @return String current time
     */
    public static function now()
    {
        return strftime("%H:%M:%S", time());
    }

    /**
     * Returns a MySQL compatible date definition
     * @param Integer $timestamp PHP-like Unix Timestamp
     * @return String $date Date as a string
     */
    public static function get_date($timestamp)
    {
        return date('Y-m-d', $timestamp);
    }

    /**
     * Returns a MySQL compatible time definition
     * @param Integer $timestamp PHP-like Unix Timestamp
     * @return String $time Time as a string
     */
    public static function get_time($timestamp)
    {
        return strftime("%H:%M:%S", $timestamp);
    }

    /**
     * Checks whether a given input string is a valid time definition
     * @param String $string Input String
     * @return Boolean $return True if it is valid, False otherwise
     */
    public static function is_time($string)
    {
        // accepts HHHH:MM:SS, e.g. 23:59:30 or 12:30 or 120:17
        if ( ! preg_match("/^(\-)?[0-9]{1,4}:[0-9]{1,2}(:[0-9]{1,2})?$/", $string) )
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}

?>