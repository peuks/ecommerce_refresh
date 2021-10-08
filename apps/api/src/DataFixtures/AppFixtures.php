<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Purchase;
use App\Entity\PurchaseItem;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    protected $slugger, $encoder;

    public function __construct(
        SluggerInterface $slugger,
        // UserPasswordEncoderInterface $encoder
    ) {
        $this->slugger = $slugger;
        // $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \WW\Faker\Provider\Picture($faker));

        // Création d'un admin
        // $admin = new User();
        // $admin->setEmail("admin@admin.com")
        //     ->setFullName("Admin")
        //     ->setRoles(['ROLE_ADMIN'])
        //     ->setPassword($this->encoder->encodePassword($admin, 'password'));

        // // Persist Admin
        // $manager->persist($admin);

        // $users = [];
        // // Création des utilisateurs
        // for ($i = 0; $i < 10; $i++) {
        //     $user = new User;
        //     $user->setEmail("user$i@gmail.com")
        //         ->setFullName($faker->name())
        //         ->setPassword($this->encoder->encodePassword($user, 'password'));
        //     $users[] = $user;
        //     // persis User
        //     $manager->persist($user);
        // }


        // Créer n catégories en attribuant un nom et un slug.
        // Chaque catégorie a un nombre aléatoire de produits associé a la catégorie avec son propre slug.
        // On utilise faker pour la génération de la data
        for ($c = 0; $c < 3; $c++) {

            // // Création de la catégorie en définissant un nom et un slug
            // $category = new Category;
            // $category->setName($faker->department)
            //     ->setSlug(strtolower($this->slugger->slug($category->getName())));

            // // Près enrengistrement 

            // $manager->persist($category);

            $products = [];

            for ($i = 0; $i < mt_rand(15, 20); $i++) {
                // Création du produit
                $product = new Product();

                // Définition du nom , prix, slug du produit , une description ainsi qu'une image.
                $product->setLabel($faker->productname())
                    ->setPrice($faker->price(4000, 20000))
                    ->setSlug($this->slugger->slug(strtolower($product->getLabel())))
                    // ->setCategory($category)->setShortDescription($faker->paragraph())
                    ->setMainPicture($faker->pictureUrl(250, 200, true));

                $products[] = $product;
                // Près enrengistrement 
                $manager->persist($product);
            }
        }

        // for ($i = 0; $i < mt_rand(20, 40); $i++) {
        //     $purchase = new Purchase;
        //     $purchase->setFullName($faker->name())
        //         ->setAddress($faker->streetAddress)
        //         ->setPostalCode($faker->postcode)
        //         ->setCity($faker->city)
        //         ->setTotal(mt_rand(20000, 50000))
        //         ->setPurchasedAt($faker->dateTimeBetween('-6 months'))
        //         ->setUser($faker->randomElement($users));

        //     $selectedProducts = $faker->randomElements($products, mt_rand(3, 5));

        //     foreach ($selectedProducts as $product) {
        //         $purchaseItem = new PurchaseItem;

        //         $purchaseItem->setProduct($product)
        //             ->setQuantity(mt_rand(1, 3))
        //             ->setProductName($product->getName())
        //             ->setProductPrice($product->getPrice())
        //             ->setTotal($purchaseItem->getQuantity() * $purchaseItem->getQuantity())
        //             ->setPurchase($purchase);
        //         $manager->persist($purchaseItem);
        //     }

        //     if ($faker->boolean(90)) {
        //         $purchase->setStatus(Purchase::STATUS_PAID);
        //     }
        //     $manager->persist($purchase);
        // }
        // Enrengistrement dans la base de données de des catégories et des produits
        $manager->flush();
    }
}
