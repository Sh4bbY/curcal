<?php

require_once 'IRateGateway.php';
require_once 'Database.php';

class RateDatabase  implements IRateGateway
{
    public function persist($from, $to, $rate)
    {
        if($from == $to)
        {
            throw new Exception('Rates need to have different currencies');
        }

        if(!is_numeric($rate))
        {
            throw new Exception('Rate has to be a numeric value');
        }

        $prepareQuery  = "INSERT INTO exchange_rate (id_currency_from, id_currency_to, rate) VALUES ('".$from."','".$to."','".$rate."')";
        DB::PDO()->query($prepareQuery);
    }

    public function retrieve($id)
    {
        if(!is_numeric($id))
        {
            throw new Exception('Parameter $id has to be a numeric value');
        }

        $prepareQuery  = "SELECT * FROM ex_rates WHERE id='".$id."'";

        $stmt = DB::PDO()->prepare($prepareQuery);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row === false)
        {
            return NULL;
        }

        return ExchangeRate::createByArray($row);
    }

    public function retrieveAll()
    {
        $prepareQuery  = "SELECT * FROM ex_rates ORDER BY id DESC";

        $stmt = DB::PDO()->prepare($prepareQuery);
        $stmt->execute();

        $results = array();
        foreach($stmt as $row)
        {
            $results[] = ExchangeRate::createByArray($row);
        }

        return $results;
    }
}