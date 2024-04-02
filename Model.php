<?php

abstract class Model
{

    private static PDO $pdo;

    public static function Connect(): void
    {
        global $conf;
        try {
            self::$pdo = new PDO("mysql:host={$conf["DBHost"]};dbname={$conf["DBName"]};port={$conf["DBPort"]}", $conf["DBUser"], $conf["DBPass"]);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            throw new DBException("Az adatbázis kapcsolódás sikertelen!", $ex);
        }
    }

    public static function AddTeam(string $csapatnev, string $edzo, string $kapitany): bool
    {
        try {
            $prep = self::$pdo->prepare("INSERT INTO `team` VALUES (NULL, :csapatnev, :edzo, :kapitany)");
            $prep->bindParam(":csapatnev", $csapatnev, PDO::PARAM_STR);
            $prep->bindParam(":edzo", $edzo, PDO::PARAM_STR);
            $prep->bindParam(":kapitany", $kapitany, PDO::PARAM_STR);
            return $prep->execute();
        } catch (Exception $ex) {
            throw new DBException("Sikertelen felhasználó felvitel!", $ex);
        }
    }

    public static function GetTeams(): array
    {

        try {
            $prep = self::$pdo->query("SELECT * FROM `team`");
            $userinfo = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $userinfo;
        } catch (Exception $ex) {
            throw new DBException("Sikertelen csapat lekérdezés!", $ex);
        }
    }

    public static function GetTeam($id): array
    {
        try {
            $prep = self::$pdo->prepare("SELECT * FROM `team` WHERE `id` = :id");
            $prep->bindParam(":id", $id, PDO::PARAM_INT);
            $prep->execute();
            $userInfo = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $userInfo;
        } catch (Exception $ex) {
            throw new DBException("Sikertelen csapat lekérdezés!", $ex);
        }
    }


    public static function ModifyTeam(int $id, string $csapatnev, string $edzo, string $kapitany): bool
    {
        try {
            $prep = self::$pdo->prepare("UPDATE `team` SET `csapatnev` = :csapatnev, `edzo` = :edzo, `kapitany` = :kapitany WHERE `id` = :id");
            $prep->bindParam(":csapatnev", $csapatnev, PDO::PARAM_STR);
            $prep->bindParam(":edzo", $edzo, PDO::PARAM_STR);
            $prep->bindParam(":kapitany", $kapitany, PDO::PARAM_STR);
            $prep->bindParam(":id", $id, PDO::PARAM_INT);
            return $prep->execute();
        } catch (Exception $ex) {
            throw new DBException("Sikertelen csapat módosítás!", $ex);
        }
    }



    public static function AddResult(string $selectteam, string $eredmeny, string $datum, int $gol, string $ido, string $lovo): bool
    {
        try {
            $prep = self::$pdo->prepare("INSERT INTO `result` VALUES (NULL, :selectteam, :eredmeny, :datum, :gol, :ido, :lovo)");
            $prep->bindParam(":selectteam", $selectteam, PDO::PARAM_STR);
            $prep->bindParam(":eredmeny", $eredmeny, PDO::PARAM_STR);
            $prep->bindParam(":datum", $datum, PDO::PARAM_STR);
            $prep->bindParam(":gol", $gol, PDO::PARAM_INT);
            $prep->bindParam(":ido", $ido, PDO::PARAM_STR);
            $prep->bindParam(":lovo", $lovo, PDO::PARAM_STR);
            return $prep->execute();
        } catch (Exception $ex) {
            throw new DBException("Sikertelen felhasználó felvitel!", $ex);
        }
    }



    public static function GetResults(): array
    {

        try {
            $prep = self::$pdo->query("SELECT * FROM `result`");
            $userinfo = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $userinfo;
        } catch (Exception $ex) {
            throw new DBException("Sikertelen eredmény lekérdezés!", $ex);
        }
    }


    public static function GetDetails($id): array
    {
        try {
            $prep = self::$pdo->prepare("SELECT * FROM `result` WHERE `id` = :id");
            $prep->bindParam(":id", $id, PDO::PARAM_INT);
            $prep->execute();
            $userInfo = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $userInfo;
        } catch (Exception $ex) {
            throw new DBException("Sikertelen mecss lekérdezés!", $ex);
        }
    }


}