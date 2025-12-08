<?php
namespace App\Dto\Requests;

use Symfony\Component\Validator\Constraints as Assert;
class register
{
    #[Assert\NotBlank(message: 'Name is required')]
    private string $name;

    #[Assert\NotBlank(message: 'Firstname is required')]
    private string $firstname;

    #[Assert\NotBlank(message: 'Password is required')]
    private string $password;

    #[Assert\NotBlank(message: 'Email is required')]
    #[Assert\Email(message:'Type Email is required')]
    private string $email;

    #[Assert\NotBlank(message: 'Phone is required')]
    private string $phone;

    #[Assert\NotBlank(message: 'Address is required')]
    private string $address;
    
    #[Assert\NotBlank(message: 'TypeAccount is required')]
    private string $typeAccount;

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;    
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
    public function getTypeAccount(): string
    {
        return $this->typeAccount;
    }
    public function setTypeAccount(string $typeAccount): void
    {
        $this->typeAccount = $typeAccount;
    }



  
}