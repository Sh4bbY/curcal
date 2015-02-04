<?php

require_once 'ICurrencyGateway.php';
require_once 'Database.php';

class CurrencyDatabase  implements IPersistenceGateway
{
    public function persist($code, $sign)
    {
        $prepareQuery  = "INSERT INTO currency (code, sign) VALUES ('".$code."','".$sign."')";
        DB::PDO()->query($prepareQuery);
    }

    public function retrieve($id)
    {
        if(!is_numeric($id))
        {
            throw new Exception('Parameter $id has to be a numeric value');
        }

        $prepareQuery  = "SELECT * FROM currency WHERE currency_id='".$id."'";

        $stmt = DB::PDO()->prepare($prepareQuery);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row === false)
        {
            return NULL;
        }

        return new Currency($row['currency_id'], $row['code'], $row['sign']);
    }

    public function retrieveAll()
    {
        $prepareQuery  = "SELECT * FROM currency ORDER BY currency_id ASC";

        $stmt = DB::PDO()->prepare($prepareQuery);
        $stmt->execute();

        $results = array();
        foreach($stmt as $row)
        {
            $results[] = new Currency($row['currency_id'], $row['code'], $row['sign']);
        }

        return $results;
    }
}