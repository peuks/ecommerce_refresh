<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * 'homepage' is the name of the rout path "/" 
     * @Route("/",name="home.index")
     */
    public function homeapge(ProductRepository $productRepository)
    {
        // findBy() returns an array of objects with the given conditions.
        // There is no criteria, no order but we do want 3 products
        $products = $productRepository->findBy([], [], 3);

        // the `render()` method returns a `Response` object with the
        // contents created by the template
        return $this->render(
            // Template tu use
            "home/index.html.twig",
            // All params that are sended to the template ( the array of products' objects )
            [
                'products' => $products
            ]
        );
    }
}
