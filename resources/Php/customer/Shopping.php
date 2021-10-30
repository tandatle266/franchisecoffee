<?php
class Shopping extends Customer
{
    private ?array $array;

    public function __construct(int $cus_id, string $fullname, string $email, string $phone, string $address, int $status,string $date)
    {
        parent::__construct($cus_id,$fullname,$email,$phone,$address,$status,$date);

    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * @param array $array
     */
    public function setArray(array $array): void
    {
        $this->array = $array;
    }

}

