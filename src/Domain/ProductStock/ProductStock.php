<?php

declare(strict_types=1);

namespace App\Domain\ProductStock;

use App\Domain\Product\Product;
use App\Domain\Store\StoreBranch;
use Doctrine\ORM\Mapping as ORM;

use JsonSerializable;

#[ORM\Entity]
#[ORM\Table(name: 'product_stock')]
class ProductStock implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product $product;

    #[ORM\ManyToOne(targetEntity: StoreBranch::class)]
    #[ORM\JoinColumn(name: 'store_branch_id', referencedColumnName: 'id')]
    private StoreBranch $storeBranch;

    #[ORM\Column(type: 'integer')]
    private int $stock;

    public function __construct(Product $product, StoreBranch $storeBranch, int $stock)
    {
        $this->product = $product;
        $this->storeBranch = $storeBranch;
        $this->stock = $stock;
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'product' => $this->product,
            'stock' => $this->stock
        ];
    }

    public function getStoreBranch(): StoreBranch
    {
        return $this->storeBranch;
    }
}
