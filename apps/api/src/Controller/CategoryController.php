<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{
    private $repository, $em;
    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $this->repository = $categoryRepository;
        $this->em = $em;
    }

    #[Route('/admin/category/create', name: 'category_create')]
    public function create(Request $request): Response
    {
        $category = new Category;
        // Utiliser une instance du formaulaire de Category avec les valeur de $category 
        $form = $this->createForm(CategoryType::class, $category);



        // Formulaire à envoyer à la vue
        $formView = $form->createView();

        // Gérer la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Set slug
            $category->setSlug(strtolower($category->getLabel()));
            // persist to the DB 

            $this->em->persist($category);

            // Write into DB
            $this->em->flush();

            // Success Message

            // $this->addFlash("sucess", "Le bien a bien été $statue");

            return $this->redirectToRoute('home_index');
        }

        return $this->render(
            "category/create.html.twig",
            [
                'formView' => $formView
            ]
        );
    }

    #[Route('/admin/category/edit/{id}', name: 'category_edit')]
    public function edit(Category $category, Request $request, SluggerInterface $slugger)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setSlug(strtolower($slugger->slug($category->getLabel())));

            $this->em->flush();
            return $this->redirectToRoute('home_index', []);
        }

        return $this->render('category/edit.html.twig', [
            'formView' => $form->createView(),
            'category' => $category,
        ]);
    }
}
