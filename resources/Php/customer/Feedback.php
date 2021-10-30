<?php


class Feedback extends Customer
{
        private string $research;
        private string $content;
        public function __construct(int $cus_id, string $fullname, string $email, string $phone, string $address, int $status, string $date, int $research, string $content)
        {
            //address will be empty string
            parent::__construct($cus_id, $fullname, $email, $phone, $address, $status,$date);
            $this->research = $research;
            $this->content = $content;
        }

    /**
     * @return int|string
     */
    public function getResearch()
    {
        return $this->research;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

}