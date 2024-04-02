<?php

class Result implements IHTTPPOST
{

    public function POST(): void
    {

        $input = file_get_contents("php://input");
        $json = json_decode($input, true);
        if (is_array($json)) {

            if (isset($json["selectteam"]) && isset($json["eredmeny"]) && isset($json["datum"]) && isset($json["gol"]) && isset($json["ido"]) && isset($json["lovo"])) {

                if (Model::AddResult(htmlspecialchars(trim($json["selectteam"])), htmlspecialchars(trim($json["eredmeny"])), $json["datum"], intval($json["gol"]), $json["ido"], htmlspecialchars(trim($json["lovo"])))) {

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

}