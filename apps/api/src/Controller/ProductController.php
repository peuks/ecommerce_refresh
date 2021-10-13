<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController

{
    protected $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

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
        $product ?? throw $this->createNotFoundException("Le produit n'existe pas");

        // the `render()` method returns a `Response` object with the
        // contents created by the template
        return $this->render("product/show.html.twig", [
            "product" => $product
        ]);
    }

    #[Route("/admin/product/create", name: "product_create")]
    public function add(SluggerInterface $slugger, Request $request): Response
    {
        $product = new Product;

        // Create a form with  ProductType form object
        $form = $this->createForm(ProductType::class, $product);
        // Création du formulaire en se basant sur notre object Product

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product->setSlug(strtolower($slugger->slug($product->getLabel())));
            // Update the slug in case the name has changed

            $this->manager->persist($product);
            $this->manager->flush();

            return $this->redirectToRoute(
                'product_show',
                [
                    'category_slug' => $product->getCategory()->getSlug(),
                    'slug' => $product->getSlug(),
                ]
            );
        }


        return $this->render('product/addEdit.html.twig', [
            'form' => $form->createView(),
            'add_edit' => true, // Set template for creation ( title and buttons )
        ]);
    }

    #[Route("/admin/product/edit/{id}", name: "product_edit")]
    public function edit(Product $product, SluggerInterface $slugger, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setSlug(strtolower($slugger->slug($product->getLabel())));

            $this->manager->flush();
            return $this->redirectToRoute('product.show', [
                'category_slug' => $product->getCategory()->getSlug(),
                'slug' => $product->getSlug(),
            ]);
        }

        return $this->render('product/addEdit.html.twig', [
            'form' => $form->createView(),
            'add_edit' => false,

        ]);
    }
}
