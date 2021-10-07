```php
<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test/', name: 'test',)]
    public function index(ProductRepository $productRepository): Response
    {
        $productRepository->findBy([], ['price' => 'DESC'], 10, 10);
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}

```
