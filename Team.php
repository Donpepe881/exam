<?php

class Team implements IHTTPPOST, IHTTPGET
{

    public function POST(): void
    {

        $input = file_get_contents("php://input");
        $json = json_decode($input, true);
        if (is_array($json)) {

            if (isset($json["csapatnev"]) && isset($json["edzo"]) && isset($json["kapitany"]) && trim($json["csapatnev"]) != "" && trim($json["edzo"]) != "" && trim($json["kapitany"]) != "") {

                if (Model::AddTeam(htmlspecialchars(trim($json["csapatnev"])), htmlspecialchars(trim($json["edzo"])), htmlspecialchars(trim($json["kapitany"])))) {

                    View::setResponse(new JSONResponse(array("result" => "Success!")));
                } else {
                    View::setResponse(new JSONResponse(array("error" => "Beszúrási hiba!")));
                }
            } else {
                View::setResponse(new JSONResponse(array("error" => "Hiányos adatok!")));
            }
        } else {
            View::setResponse(new JSONResponse(array("error" => "Nem értelmezhető bemenet!")));
        }
    }


    public function GET(): void
    {

        $data = Model::GetTeams();
        if (count($data) > 0) {
            View::setResponse(new JSONResponse($data));
        } else {
            View::setResponse(new JSONResponse(array("error" => "Nem található csapat!")));
        }
    }

}