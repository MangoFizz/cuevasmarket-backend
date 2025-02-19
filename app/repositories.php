<?php

declare(strict_types=1);

use App\Domain\Product\ProductRepository;
use App\Domain\ProductStock\ProductStockRepository;
use App\Domain\Store\StoreBranchRepository;
use App\Domain\User\UserRepository;
use App\Domain\PaymentMethod\PaymentMethodRepository;
use App\Domain\ShippingAddress\ShippingAddressRepository;
use App\Domain\Order\OrderRepository;
use App\Domain\OrderItems\OrderItemsRepository;
use App\Infrastructure\Persistence\PaymentMethod\DoctrinePaymentMethodRepository;
use App\Infrastructure\Persistence\Product\DoctrineProductRepository;
use App\Infrastructure\Persistence\ProductStock\DoctrineProductStockRepository;
use App\Infrastructure\Persistence\Store\DoctrineStoreBranchRepository;
use App\Infrastructure\Persistence\User\DoctrineUserRepository;
use App\Infrastructure\Persistence\ShippingAddress\DoctrineShippingAddressRepository;
use App\Infrastructure\Persistence\Order\DoctrineOrderRepository;
use App\Infrastructure\Persistence\OrderItems\DoctrineOrderItemsRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(DoctrineUserRepository::class),
        ProductRepository::class => \DI\autowire(DoctrineProductRepository::class),
        StoreBranchRepository::class => \DI\autowire(DoctrineStoreBranchRepository::class),
        PaymentMethodRepository::class => \DI\autowire(DoctrinePaymentMethodRepository::class),
        ShippingAddressRepository::class => \DI\autowire(DoctrineShippingAddressRepository::class),
        OrderRepository::class => \DI\autowire(DoctrineOrderRepository::class),
        OrderItemsRepository::class => \DI\autowire(DoctrineOrderItemsRepository::class),
        ProductStockRepository::class => \DI\autowire(DoctrineProductStockRepository::class),
    ]);
};
