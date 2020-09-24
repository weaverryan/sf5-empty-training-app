<?php

namespace App\Controller;

use App\Model\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use PDO;

class ProductController extends AbstractController
{
    /**
     * @Route("/products")
     */
    public function list(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/api/products", methods={"GET"})
     */
    public function getCollection(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return $this->json($products);

        //return new JsonResponse($products);
    }
}
