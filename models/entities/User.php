<?php

namespace entities;

class User
{

    public function __construct($csvLine) {
        $this->xmlId = $csvLine[0];
        $this->lastName = $csvLine[1];
        $this->name = $csvLine[2];
        $this->secondName = $csvLine[3];
        $this->department = $csvLine[4];
        $this->workPosition = $csvLine[5];
        $this->email = $csvLine[6];
        $this->mobilePhone = $csvLine[7];
        $this->phone = $csvLine[8];
        $this->login = $csvLine[9];
        $this->password = $csvLine[10];
    }

    private string $xmlId;
    private string $lastName;
    private string $name;
    private string $secondName;
    private string $department;
    private string $workPosition;
    private string $email;
    private ?string $mobilePhone;
    private ?string $phone;
    private string $login;
    private string $password;

    /**
     * @return string
     */
    public function getXmlId(): string
    {
        return $this->xmlId;
    }

    /**
     * @param string $xmlId
     */
    public function setXmlId(string $xmlId): void
    {
        $this->xmlId = $xmlId;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
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
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->secondName;
    }

    /**
     * @param string $secondName
     */
    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @param string $department
     */
    public function setDepartment(string $department): void
    {
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function getWorkPosition(): string
    {
        return $this->workPosition;
    }

    /**
     * @param string $workPosition
     */
    public function setWorkPosition(string $workPosition): void
    {
        $this->workPosition = $workPosition;
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
     * @return string|null
     */
    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @param string|null $mobilePhone
     */
    public function setMobilePhone(?string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}