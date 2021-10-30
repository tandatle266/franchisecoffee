<?php


class Customer
{
    protected int $cus_id;
    protected string $fullname;
    protected string $email;
    protected string $phone;
    protected ?string $address; //null or string type cuz feedback customer dont have address
    protected int $status;
    protected string $date;

    /**
     * Customer constructor.
     * @param int $cus_id
     * @param string $fullname
     * @param string $email
     * @param string $phone
     * @param string $address
     * @param string $dateTime
     * @param int $status
     */
    public function __construct(int $cus_id, string $fullname, string $email, string $phone, string $address, int $status, string $dateTime)
    {
        $this->cus_id = $cus_id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->status = $status;
        $this->date = $dateTime;
    }


    /**
     * @return int
     */
    public function getCusId(): int
    {
        return $this->cus_id;
    }

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }


}