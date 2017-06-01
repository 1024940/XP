<?php
/**
*   Usage:
*   $session = Session::getInstance();
*   $session->user = <object>;
*
*   Based on: 
*   http://php.net/manual/en/function.session-start.php comment from linblow@hotmail.fr
*/
final class Session
{
    private function __construct() { }
   
    /**
    *    Returns THE instance of 'Session'.
    *    @return    object
    **/
    public static function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        session_start();
        return $instance;
    }
   
    /**
    *    Stores datas in the session.
    *    Example: $session->foo = 'bar';
    *   
    *    @param    name     Name of the datas.
    *    @param    value    Your datas.
    *    @return   void
    **/
    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }
   
    /**
    *    Gets datas from the session.
    *    Example: echo $session->foo;
    *   
    *    @param    name     Name of the datas to get.
    *    @return   mixed    Datas stored in session.
    **/
    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
   
    /**
    *    Checks if session variable is set.
    *    Example: isset($session->foo);
    *   
    *    @param    name     Name of the datas to get.
    *    @return   boolean  true if set.
    **/
    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }
   
    /**
    *    Removes value from the session.
    *    Example: unset($session->foo);
    *   
    *    @param    name     Name of the datas to get.
    *    @return   void
    **/
    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }

    public function __clone() {
        throw new Exception("Clonen van de sessie is niet toegestaan");
    }
}
//
// Instantiate once to create the session
//
$session = Session::getInstance();