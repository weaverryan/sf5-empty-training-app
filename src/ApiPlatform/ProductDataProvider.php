<?php

namespace App\ApiPlatform;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Model\Product;
use App\Repository\ProductRepository;

class ProductDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        return $this->productRepository->findAll();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Product::class;
    }

}
