<?php
class InfoUser
{
    private int $id;
    private string $idcard;
    private string $email;
    private string $phone;
    private string $type;
    private bool $status;
    private string $date;
    private string $user_name;
    private string $fullname;

    /**
     * InfoUser constructor.
     * @param int $id
     * @param string $fullname
     * @param string $idcard
     * @param string $email
     * @param string $phone
     * @param string $type
     * @param bool $status
     * @param string $user_name
     */
    public function __construct(int $id, string $fullname, string $idcard, string $email, string $phone, string $type, bool $status, string $date, string $user_name)
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone=$phone;
        $this->date = $date;
        $this->idcard = $idcard;
        $this->type = $type;
        $this->status=$status;
        $this->user_name = $user_name;

    }

    /**
     * @return string
     */
    public function getIdcard(): string
    {
        return $this->idcard;
    }

    /**
     * @param string $idcard
     */
    public function setIdcard(string $idcard): void
    {
        $this->idcard = $idcard;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     */
    public function setUserName(string $user_name): void
    {
        $this->user_name = $user_name;
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

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
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
    public function getId(): int
    {
        return $this->id;
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



}