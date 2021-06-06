<?php
namespace Src\Dominio\Entities;

class Order
{
    private $id;

    // User client
    public $user_id;
    public $client;

    public $total = 0;

    // User creater
    public $creater_id;
    public $creater;

    public $created_at;
    public $updated_at;

    // Order Detail
    public $detail = [];
}