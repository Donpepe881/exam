<?php

class JSONResponse implements IViewResponse
{

    private array $data;

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {

        $this->data = $data;
    }

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function ToStringFormat(): string
    {
        return json_encode($this->data);
    }

    public function GetMIMEType(): string
    {
        return "application/json";
    }
}