<?php


namespace Source\App;


class Trigger
{
    private const TRIGGER = "trigger";

    public const ACCEPT = "accept";
    public const WARNING = "warning";
    public const ERROR = "error";

    private static $message;
    private static $errorType;
    private static $error;

    public static function show($message, $errorType = null)
    {
        self::setError($message, $errorType);
        echo self::$error;
    }

    public static function push($message, $errorType = null)
    {
        self::setError($message, $errorType);
        return self::$error;
    }
    
    private static function setError($message, $errortype)
    {

        $reflection = new \ReflectionClass(__CLASS__);
        $errortypes = $reflection->getConstants();

        self::$message = $message;
        self::$errorType = (!empty($errortype) || in_array($errortype, $errortypes) ? " {$errortype}" : "");
        self::$error = "<p class='" . self::TRIGGER . self::$errorType . "'>".self::$message."</p>";

    }
}