<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
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
        if (!$category) throw $this->createNotFoundException("OHLALALA");


        return $this->render(
            'product/category.html.twig',
            [
                'slug' => $slug,
                'category' => $category,
            ]
        );
    }
}
