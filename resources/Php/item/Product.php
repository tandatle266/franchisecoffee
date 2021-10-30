<?php

include __DIR__."/../item/Item.php";
class Product extends Item
{


    private int $quantity;

    public function __construct(int $item_id, string $name, float $price, string $type, string $image, int $quantity){
        parent::__construct( $item_id,  $name,  $price,  $type, $image);
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

}