<?php

class Details implements IHTTPGET
{

    public function GET(): void
    {

        if (isset($_GET["id"]) && filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {

            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            $data = Model::GetDetails($id);
            if (count($data) == 1) {
                View::setResponse(new JSONResponse($data[0]));
            } else {
                View::setResponse(new JSONResponse(array("error" => "A megadott mecss nem található!")));
            }
        } else {
            View::setResponse(new JSONResponse(array("error" => "Nem megfelelő, vagy hiányos azonosító!")));
        }
    }
}