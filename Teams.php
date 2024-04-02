<?php

class Teams implements IHTTPGET, IHTTPPUT
{

    public function GET(): void
    {

        if (isset($_GET["id"]) && filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {

            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            $data = Model::GetTeam($id);
            if (count($data) == 1) {
                View::setResponse(new JSONResponse($data[0]));
            } else {
                View::setResponse(new JSONResponse(array("error" => "A megadott csapat nem található!")));
            }
        } else {
            View::setResponse(new JSONResponse(array("error" => "Nem megfelelő, vagy hiányos azonosító!")));
        }
    }


    public function PUT(): void
    {

        if (isset($_GET["id"]) && filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            $input = file_get_contents("php://input");
            $json = json_decode($input, true);
            if (is_array($json)) {

                if (isset($json["csapatnev"]) && isset($json["edzo"]) && isset($json["kapitany"]) && trim($json["csapatnev"]) != "" && trim($json["edzo"]) != "" && trim($json["kapitany"]) != "") {

                    if (Model::ModifyTeam($id, htmlspecialchars(trim($json["csapatnev"])), htmlspecialchars(trim($json["edzo"])), htmlspecialchars(trim($json["kapitany"])))) {
                        View::setResponse(new JSONResponse(array("result" => "Success!")));
                    } else {
                        View::setResponse(new JSONResponse(array("error" => "Módosítási hiba!")));
                    }
                } else {
                    View::setResponse(new JSONResponse(array("error" => "Hiányos adatok!")));
                }
            } else {
                View::setResponse(new JSONResponse(array("error" => "Nem értelmezhető bemenet!")));
            }
        } else {
            View::setResponse(new JSONResponse(array("error" => "Nem megfelelő, vagy hiányos azonosító!")));
        }
    }



}