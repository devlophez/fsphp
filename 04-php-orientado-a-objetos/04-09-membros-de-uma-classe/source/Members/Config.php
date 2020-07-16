<?php


namespace Source\Members;


class Config
{
    public const COMPANY = "CredVip";
    protected const DOMAIN = "credvip.com";
    private const SECTOR = "business";

    public static $company;
    public static $domain;
    public static $sector;

    public static function setConfig($company, $domain, $sector)
    {
        self::$company = $company;
        self::$domain = $domain;
        self::$sector = $sector;
    }
}