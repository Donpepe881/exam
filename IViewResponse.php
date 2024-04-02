<?php

interface IViewResponse
{
    function ToStringFormat() : string;
    function GetMIMEType() : string;
}
