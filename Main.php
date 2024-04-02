<?php

class Main implements IHTTPGET
{


    public function GET(): void
    {

        $data = Model::GetResults();
        if (count($data) > 0) {
            View::setResponse(new JSONResponse($data));
        } else {
            View::setResponse(new JSONResponse(array("error" => "Nem található eredmény!")));
        }
    }

}