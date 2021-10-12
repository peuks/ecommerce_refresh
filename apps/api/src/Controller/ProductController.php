<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/{slug}', name: 'product_category')]
    public function category($slug, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->findOneBy([
            'slug' => $slug
            // Looking for an category using the slug from the URL
        ]);

        // Create an error if there is no category 
        $category ?? throw $this->createNotFoundException("La catégorie n'existe pas");


        return $this->render(
            'product/category.html.twig',
            [
                'slug' => $slug,
                'category' => $category,
            ]
        );
    }


    #[Route('/{category_slug}/{slug}', name: 'product_show')]
    public function show($slug, ProductRepository $productRepository)
    {
        // Looking for an category using the slug  from the URL as a params
        $product = $productRepository->findOneBy([
            'slug' => $slug
         ]);

        // Create an error if the product doesn't exist
        if (!$product) throw $this->createNotFoundException("Le produit n'existe pas");

        // the `render()` method returns a `Response` object with the
        // contents created by the template
        return $this->render("product/show.html.twig", [
            "product" => $product
        ]);
    }
}
