<?php

class Franchise extends Customer
{
    private int $type;

    /**
     * Franchise constructor.
     * @param int $cus_id
     * @param string $fullname
     * @param string $email
     * @param string $phone
     * @param string $address
     * @param string $date
     * @param int $status
     * @param int $type
     */
    public function __construct(int $cus_id, string $fullname, string $email, string $phone, string $address, int $status,string $date, int $type)
    {
        parent::__construct($cus_id,$fullname,$email,$phone,$address,$status,$date);
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }




}