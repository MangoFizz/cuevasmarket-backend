<?php

declare(strict_types=1);

namespace App\Domain\PaymentMethod;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\User\User;

use JsonSerializable;

#[ORM\Entity]
#[ORM\Table(name: 'payment_method')]
class PaymentMethod implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private int $userId;

    #[ORM\Column(type: 'string')]
    private string $cardNumber;

    #[ORM\Column(type: 'string')]
    private string $holderName;

    #[ORM\Column(type: 'string')]
    private string $expirationDate;

    #[ORM\Column(type: 'string')]
    private string $securityCode;

    public function __construct(
        int $userId,
        string $cardNumber,
        string $holderName,
        string $expirationDate,
        string $securityCode
    ) {
        $this->userId = $userId;
        $this->cardNumber = $cardNumber;
        $this->holderName = $holderName;
        $this->expirationDate = $expirationDate;
        $this->securityCode = $securityCode;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getHolderName(): string
    {
        return $this->holderName;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    public function getSecurityCode(): string
    {
        return $this->securityCode;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    public function setHolderName(string $holderName): void
    {
        $this->holderName = $holderName;
    }

    public function setExpirationDate(string $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    public function setSecurityCode(string $securityCode): void
    {
        $this->securityCode = $securityCode;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'card_number' => $this->cardNumber,
            'holder_name' => $this->holderName,
            'expiration_date' => $this->expirationDate,
            'security_code' => $this->securityCode,
        ];
    }

    public function update(
        string $cardNumber,
        string $holderName,
        string $expirationDate,
        string $securityCode
    ): void {
        $this->cardNumber = $cardNumber;
        $this->holderName = $holderName;
        $this->expirationDate = $expirationDate;
        $this->securityCode = $securityCode;
    }

    public function delete(): void
    {
        $this->cardNumber = '';
        $this->holderName = '';
        $this->expirationDate = '';
        $this->securityCode = '';
    }
}
