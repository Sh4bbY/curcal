<?php

interface IPersistenceGateway
{
    public function persist($code, $sign);
    public function retrieve($id);
    public function retrieveAll();
}