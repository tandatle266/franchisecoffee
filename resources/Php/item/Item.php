<?php


class Item
{
protected int $item_id;
protected string $name;
protected float $price;
protected string $type;
protected string $image;

    /**
     * Item constructor.
     * @param int $item_id
     * @param string $name
     * @param float $price
     * @param string $type
     * @param string $image
     */
    public function __construct(int $item_id, string $name, float $price, string $type, string $image)
    {
        $this->item_id = $item_id;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getItemId(): int
    {
        return $this->item_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getImage(): string
    {
        return $this->image;
//       return "../resource/Php/fileService/uploads/item/$this->img";
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }


}