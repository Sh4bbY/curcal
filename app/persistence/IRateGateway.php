<?php

interface IRateGateway
{
    public function persist($from, $to, $rate);
    public function retrieve($id);
    public function retrieveAll();
}