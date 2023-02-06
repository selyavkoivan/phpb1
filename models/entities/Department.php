<?php

namespace entities;

class Department
{
    private string $xmlId;
    private ?string $parentXmlId;
    private string $nameDepartment;

    public function setData($csvLine): void
    {
        $this->xmlId = $csvLine[0];
        $this->parentXmlId = $csvLine[1];
        $this->nameDepartment = $csvLine[2];
    }

    public function getXmlId(): string
    {
        return $this->xmlId;
    }

    public function setXmlId(string $xmlId): void
    {
        $this->xmlId = $xmlId;
    }

    public function getParentXmlId(): ?string
    {
        return $this->parentXmlId;
    }

    public function setParentXmlId(?string $parentXmlId): void
    {
        $this->parentXmlId = $parentXmlId;
    }

    public function getNameDepartment(): string
    {
        return $this->nameDepartment;
    }

    public function setNameDepartment(string $nameDepartment): void
    {
        $this->nameDepartment = $nameDepartment;
    }
}