<?php

abstract class View
{

    private static IViewResponse $response;

    public static function getResponse(): IViewResponse
    {
        return self::$response;
    }

    public static function setResponse(IViewResponse $response): void
    {
        self::$response = $response;
    }

    public static function RenderAndPrint(): void
    {

        header("Content-type: " . self::$response->GetMIMEType());
        print (self::$response->ToStringFormat());
    }
}