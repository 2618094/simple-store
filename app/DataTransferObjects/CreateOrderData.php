<?php


namespace App\DataTransferObjects;


use Spatie\DataTransferObject\DataTransferObject;

class CreateOrderData extends DataTransferObject
{
    public string $shipping_id;
    public string $product_id;
    public string $client_name;
    public string $client_address;
}
