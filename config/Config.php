<?php

namespace Config;

class Config
{
    public const PROJECT_PATH          = __DIR__ . '../../';
    public const VIEWS_PATH            = self::PROJECT_PATH . '/app/Core/Views/';
    public const VIEW_OPENING_PATTERN  = '{{';
    public const VIEW_CLOSING_PATTERN  = '}}';
    public const TITLE_PATTERN         = 'self::VIEW_OPENING_PATTERN' . 'titulo'  . self::VIEW_CLOSING_PATTERN;
    public const HEADER_PATTERN        = self::VIEW_OPENING_PATTERN . 'header'  . self::VIEW_CLOSING_PATTERN;
    public const CONTENT_PATTERN       = self::VIEW_OPENING_PATTERN . 'content' . self::VIEW_CLOSING_PATTERN;
    public const FOOTER_PATTERN        = self::VIEW_OPENING_PATTERN . 'footer'  . self::VIEW_CLOSING_PATTERN;
    public const DB_CONFIG_PATH        = self::PROJECT_PATH . '/config/Database/dbconfig.ini';
    public const GOOGLE_CREDENTIALS    = __DIR__ . '/Client/credentials.json';
    public const MAX_PROFILE_PICTURES  = 13;

}