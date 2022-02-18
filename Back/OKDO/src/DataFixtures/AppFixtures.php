<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Age;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Profiles;
use App\Entity\Event;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;
    private $connection;
    


    public function __construct(UserPasswordHasherInterface $hasher, Connection $connection)
    {
        // each time we called hasher on our load, it will hash the password
        $this->hasher = $hasher;
        // get connection to Database (DBAL ~= PDO)
        // execut requests manually in SQL
        $this->connection = $connection;
        
    }

    
    /**
     * Allows to truncate tables and reset AI to 1
     */
    private function truncate()
    {
        // We use SQL 
        // Disablation FK constraint checking
        $this->connection->executeQuery('SET foreign_key_checks = 0');
        // We truncate
        $this->connection->executeQuery('TRUNCATE TABLE user');
        $this->connection->executeQuery('TRUNCATE TABLE product');
        $this->connection->executeQuery('TRUNCATE TABLE category');
        $this->connection->executeQuery('TRUNCATE TABLE profiles');
        $this->connection->executeQuery('TRUNCATE TABLE event');
        $this->connection->executeQuery('TRUNCATE TABLE age');
        $this->connection->executeQuery('TRUNCATE TABLE genre');
    }
    public function load(ObjectManager $manager): void
    {

        // TRUNCATE
        $this->truncate();
        
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');
                


           // User 


       // here we create our custom fixtures admin for our user
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        // we call our dependance hasher for admin fixture
        $password = $this->hasher->hashPassword($admin, 'admin');
        $admin->setPassword($password);
        $admin->setFirstname('William');
        $admin->setLastname('Schmitt');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $admin->setCreatedAt(new \datetime('now'));
    // persist before push
        $manager->persist($admin);

        $managerUser = new User();
        $managerUser->setEmail('manager@manager.com');
        $managerUser->setRoles(['ROLE_MANAGER']);
        $password = $this->hasher->hashPassword($managerUser, 'manager');
        $managerUser->setPassword($password);
        $managerUser->setFirstname('Ladislas');
        $managerUser->setLastname('Marchand');
        $managerUser->setCreatedAt(new \datetime('now'));
        // $manager = Manager Doctrine
        $manager->persist($managerUser);

        // user 
        $user = new User();
        $user->setEmail('user@user.com');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user, 'user');
        $user->setPassword($password);
        $user->setFirstname('JC');
        $user->setLastname('Guinez');
        $user->setCreatedAt(new \datetime('now'));
        
        $manager->persist($user);

        //user 1 
        $user1 = new User();
        $user1->setEmail('francois@lefrancais.com');
        $user1->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user1, 'francois');
        $user1->setPassword($password);
        $user1->setFirstname('Francois');
        $user1->setLastname('Lefrancais');
        $user1->setCreatedAt(new \datetime('now'));
        

        $manager->persist($user1);


        // category fixtures

        // category 1
        $category1 = new Category();
        $category1->setLabel('Geek');
        $category1->setValue('Geek');
        $category1->setcreatedAt(new \datetime('now'));

        $manager->persist($category1);
       
        //category 2
        $category2 = new Category();
        $category2->setLabel('Sport et Bien-être');
        $category2->setValue('Sport et Bien-être');
        $category2->setcreatedAt(new \datetime('now'));

        $manager->persist($category2);

        // category 3
        $category3 = new Category();
        $category3->setLabel('Food & Drink Lovers');
        $category3->setValue('Food & Drink Lovers');
        $category3->setcreatedAt(new \datetime('now'));

        $manager->persist($category3);

        // category 4
        $category4 = new Category();
        $category4->setLabel('Voyages');
        $category4->setValue('Voyages');
        $category4->setcreatedAt(new \datetime('now'));

        $manager->persist($category4);

        // category 5
        $category5 = new Category();
        $category5->setLabel('Musique');
        $category5->setValue('Musique');
        $category5->setcreatedAt(new \datetime('now'));

        $manager->persist($category5);

        // category 6
        $category6 = new Category();
        $category6->setLabel('Bijoux');
        $category6->setValue('Bijoux');
        $category6->setcreatedAt(new \datetime('now'));

        $manager->persist($category6);

        // category 7
        $category7 = new Category();
        $category7->setLabel('Décoration');
        $category7->setValue('Décoration');
        $category7->setcreatedAt(new \datetime('now'));
        

        $manager->persist($category7);

        // genres fixtures

        //genre 1
        $genre1 = new Genre;
        $genre1->setLabel('Homme');
        $genre1->setValue('Homme');
        
        $manager->persist($genre1);

        //genre 2
        $genre2 = new Genre;
        $genre2->setLabel('Femme');
        $genre2->setValue('Femme');

        $manager->persist($genre2);

        //genre 3 
        $genre3 = new Genre;
        $genre3->setLabel('Mixte');
        $genre3->setValue('Mixte');

        $manager->persist($genre3);

        // Age fixtures

        $age1 = new Age();
        $age1->setLabel('Enfant');
        $age1->setValue('Enfant');
        $manager->persist($age1);

        $age2 = new Age();
        $age2->setLabel('Adolescent');
        $age2->setValue('Adolescent');
        $manager->persist($age2);

        $age3 = new Age();
        $age3->setLabel('Adulte');
        $age3->setValue('Adulte');
        $manager->persist($age3);

        $age4 = new Age();
        $age4->setLabel('Senior');
        $age4->setValue('Senior');
        $manager->persist($age4);


        //Events

        $event1 = new Event();
        $event1->setLabel('Anniversaire');
        $event1->setValue('Anniversaire');
        $event1->setNumber('1');
        $manager->persist($event1);

        $event2 = new Event();
        $event2->setLabel('Mariage');
        $event2->setValue('Mariage');
        $event2->setNumber('2');
        $manager->persist($event2);

        $event3 = new Event();
        $event3->setLabel('Naissance');
        $event3->setValue('Naissance');
        $event3->setNumber('3');
        $manager->persist($event3);

        $event4 = new Event();
        $event4->setLabel('Plaisir d\'offrir');
        $event4->setValue('Plaisir d\'offrir');
        $event4->setNumber('4');
        $manager->persist($event4);

        $event5 = new Event();
        $event5->setLabel('Saint Valentin');
        $event5->setValue('Saint Valentin');
        $event5->setNumber('5');
        $manager->persist($event5);


        // Products


        // product 1
        $product = new Product();
        $product->setName('Mug overflow');
        $product->setPrice('13');
        $product->setDescription($faker->text());   
        $product->setPicture('https://wp.oclock.io/wp-content/uploads/2016/10/DSC_0250-800x550.jpg');
        $product->setShoppingLink('https://www.oclock.io');
        $product->addAge($age2);
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setStatus(1);
        $product->setGenre($genre1);
        $product->addCategory($category1);
        $product->addEvent($event1);

        $manager->persist($product);

        // product 2 
        $product = new Product();
        $product->setName('PC portable');
        $product->setPrice('400');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2014/09/24/14/29/macbook-459196_960_720.jpg');
        $product->setShoppingLink('https://www.monpcmarchepas.fr');
        $product->addAge($age2);
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setGenre($genre1);
        $product->setCreatedAt(new \datetime('now'));
        $product->setStatus(1);
        $product->addCategory($category1);
        $product->addEvent($event1);

        $manager->persist($product);

        // product 3
        $product = new Product();
        $product->setName('Figurine');
        $product->setPrice('10');
        $product->setDescription($faker->text());  
        $product->setPicture('https://images.unsplash.com/photo-1514302240736-b1fee5985889?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Z2Vla3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60');
        $product->setShoppingLink('https://www.mabellefigurine.fr');
        $product->addAge($age2);
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setGenre($genre1);
        $product->setCreatedAt(new \datetime('now'));
        $product->setStatus(1);
        $product->addCategory($category1);
        $product->addEvent($event1);

        $manager->persist($product);

        // product 4
        $product = new Product();
        $product->setName('casque micro');
        $product->setPrice('20');
        $product->setDescription($faker->text());  
        $product->addAge($age3); 
        $product->setPicture('https://images.pexels.com/photos/7682341/pexels-photo-7682341.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');
        $product->setShoppingLink('https://www.monmicromarchepas.fr');
        $product->addAge($age2);
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setGenre($genre1);
        $product->setCreatedAt(new \datetime('now'));
        $product->setStatus(1);
        $product->addCategory($category1);
        $product->addEvent($event1);

        $manager->persist($product);

        // product 5
        $product = new Product();
        $product->setName('casque VR');
        $product->setPrice('800');
        $product->setDescription($faker->text()); 
        $product->setPicture('https://images.pexels.com/photos/3761267/pexels-photo-3761267.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        $product->setShoppingLink('https://www.vendunreinpouruncasqueVR.com');
        $product->addAge($age2);
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setGenre($genre1);
        $product->setCreatedAt(new \datetime('now'));
        $product->setStatus(1);
        $product->addCategory($category1);
        $product->addEvent($event1);

        $manager->persist($product);

        // product 6
        $product = new Product();
        $product->setName('Bouteille Coeur');
        $product->setPrice('30');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2016/03/27/13/53/bottle-1282705_960_720.jpg');
        $product->setShoppingLink('https://www.unebouteillealamer.net');
        $product->addAge($age3);
        $product->addAge($age4);
        $product->addEvent($event4);
        $product->addEvent($event5);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre2);
        $product->setStatus(1);
        $product->addCategory($category3);
        $product->addCategory($category7);

        $manager->persist($product);

        // product 7
        $product = new Product();
        $product->setName('Chocolat / Macarons');
        $product->setPrice('20');
        $product->setDescription($faker->text());   
        $product->setPicture('https://previews.123rf.com/images/starkovphoto/starkovphoto1602/starkovphoto160200025/52658110-la-bo%C3%AEte-de-macarons-en-forme-de-coeur-avec-des-fleurs-et-du-ruban-sur-une-table-en-bois-cadeau-cr%C3%A9a.jpg');
        $product->setShoppingLink('https://www.lesbonschoco.fr');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now')) ;
        $product->setGenre($genre3);
        $product->setStatus(1);
        $product->addCategory($category2);
        $product->addAge($age3);
        $product->addAge($age4);
        $product->addEvent($event4);
        $product->addEvent($event5);

        $manager->persist($product);

        //product 8
        $product = new Product();
        $product->setName('Montre Femme');
        $product->setPrice('100');
        $product->setDescription($faker->text());
        $product->addAge($age3);   
        $product->setPicture('https://images.pexels.com/photos/9981093/pexels-photo-9981093.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260');
        $product->setShoppingLink('https://www.ocaro.fr');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre2);
        $product->setStatus(1);
        $product->addAge($age3);
        $product->addAge($age4);
        $product->addEvent($event1);
        $product->addEvent($event4);
        $product->addEvent($event5);
        $product->addCategory($category6);

        $manager->persist($product);

        // product 9
        $product = new Product();
        $product->setName('Bague en coeur');
        $product->setPrice('100');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2014/12/31/14/11/wedding-ring-584974_960_720.jpg');
        $product->setShoppingLink('https://www.clear.com');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre2);
        $product->setStatus(1);
        $product->addCategory($category6);
        $product->addAge($age3);
        $product->addAge($age4);
        $product->addEvent($event1);
        $product->addEvent($event4);
        $product->addEvent($event5);

        $manager->persist($product);

        //product 10
        $product = new Product();
        $product->setName('Voyage aux Maldives');
        $product->setPrice('800');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2018/03/12/20/07/maldives-3220702_960_720.jpg');
        $product->setShoppingLink('https://www.voyagevoyage.com');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre2);
        $product->setStatus(1);
        $product->addCategory($category4);
        $product->addAge($age3);
        $product->addEvent($event5);

        $manager->persist($product);

        //product 11
        $product = new Product();
        $product->setName('Séjour au ski');
        $product->setPrice('400');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2017/02/15/11/15/wintry-2068298_960_720.jpg');
        $product->setShoppingLink('https://www.voyageauski.com');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre2);
        $product->setStatus(1);
        $product->addCategory($category4);
        $product->addAge($age3);
        $product->addEvent($event5);

        $manager->persist($product);


        //product 12
        $product = new Product();
        $product->setName('Collier');
        $product->setPrice('50');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2017/08/02/01/34/pocket-watch-2569573_960_720.jpg');
        $product->setShoppingLink('https://www.creatordebijoux.com');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre2);
        $product->setStatus(1);
        $product->addCategory($category6);
        $product->addAge($age2);
        $product->addAge($age3);
        $product->addAge($age4);
        $product->addEvent($event1);
        $product->addEvent($event4);
        $product->addEvent($event5);

        $manager->persist($product);

        // product 13
        $product = new Product();
        $product->setName('Magnifique tenue de marche athlétique');
        $product->setPrice('150');
        $product->setDescription($faker->text());   
        $product->setPicture('https://www.programme-tv.net/imgre/fit/https.3A.2F.2Fprd2-tel-epg-img.2Es3-eu-west-1.2Eamazonaws.2Ecom.2Fprogram.2F44691aba5c165697.2Ejpg/630x355/quality/80/malcolm.jpg');
        $product->setShoppingLink('http://www.haladustyle.com');
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre1);
        $product->addAge($age2);
        $product->addAge($age3);
        $product->addEvent($event1);     
        $product->setStatus(1);
        $product->addCategory($category2);

        $manager->persist($product);

        // product 14
        $product = new Product();
        $product->setName('Tenue de basket');
        $product->setPrice('60');
        $product->setDescription($faker->text());   
        $product->setPicture('https://images.pexels.com/photos/7005769/pexels-photo-7005769.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        $product->setShoppingLink('https://www.grosport.fr');
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre1);
        $product->addAge($age2);
        $product->addAge($age3);
        $product->addEvent($event1);     
        $product->setStatus(1);
        $product->addCategory($category2);

        $manager->persist($product);

        // product 15
        $product = new Product();
        $product->setName('Bracelet Tracker Requin');
        $product->setPrice('300');
        $product->setDescription($faker->text());   
        $product->setPicture('https://media.istockphoto.com/photos/handmade-shark-figurine-bracelet-with-aquamarine-stone-beads-picture-id1043383476?k=20&m=1043383476&s=612x612&w=0&h=cvb8bltLig4fO03V0TlpCnF3C1WsUFsvgHoZ56IsdiQ=');
        $product->setShoppingLink('https://www.arnaquetonpote.fr');
        $product->addAge($age2);
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setGenre($genre1);
        $product->setGenre($genre2);
        $product->setCreatedAt(new \datetime('now'));
        $product->setStatus(1);
        $product->addCategory($category6);
        $product->addEvent($event5);

        $manager->persist($product);
        
         // product 16
         $product = new Product();
         $product->setName('Montre connectée');
         $product->setPrice('400');
         $product->setDescription($faker->text()); 
         $product->setPicture('https://cdn.pixabay.com/photo/2019/11/05/16/32/hour-4603921_960_720.jpg');
         $product->setShoppingLink('https://www.montrecc.com');
         $product->addAge($age2);
         $product->addAge($age3);
         //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
         $product->setGenre($genre1);
         $product->setCreatedAt(new \datetime('now'));
         $product->setStatus(1);
         $product->addCategory($category1);
         $product->addEvent($event1);
 
         $manager->persist($product);

          // product 14
        $product = new Product();
        $product->setName('Maillot de foot');
        $product->setPrice('80');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2020/08/02/09/05/jersey-5457103_960_720.jpg');
        $product->setShoppingLink('https://www.grosport.fr');
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre1);
        $product->addAge($age2);
        $product->addAge($age3);
        $product->addEvent($event1);     
        $product->setStatus(1);
        $product->addCategory($category2);

        $manager->persist($product);

        // product 14
        $product = new Product();
        $product->setName('Chaussure de sport');
        $product->setPrice('50');
        $product->setDescription($faker->text());   
        $product->setPicture('https://cdn.pixabay.com/photo/2018/09/22/18/00/shoes-3695750_960_720.jpg');
        $product->setShoppingLink('https://www.intrasport.fr');
        $product->addAge($age3);
        //get the createdAtValue, he get the actual time/hour and put it on setcreatedAt.
        $product->setCreatedAt(new \datetime('now'));
        $product->setGenre($genre1);
        $product->addAge($age2);
        $product->addAge($age3);
        $product->addEvent($event1) ;     
        $product->setStatus(1);
        $product->addCategory($category2);

        $manager->persist($product);

        // Profiles fixtures

        $profiles = new Profiles;
        $profiles->setName('Anniversaire de Max');
        $profiles->setCreatedAt(new \datetime('now'));
        $profiles->setUser($user);
        $profiles->addAge($age3);
        $profiles->setGenre($genre1);
        $profiles->setEvent($event1);
        $profiles->addCategory($category1);
        $profiles->addCategory($category2);
        $profiles->addCategory($category3);
        $profiles->addCategory($category4);
        $profiles->addCategory($category5);
        $profiles->addCategory($category6);
        $profiles->addCategory($category7);


        $manager->persist($profiles);

        $profiles = new Profiles;
        $profiles->setName('Saint-Valentin avec Martine');
        $profiles->setCreatedAt(new \datetime('now'));
        $profiles->setUser($user1);
        $profiles->addAge($age4);
        $profiles->setGenre($genre2);
        $profiles->setEvent($event5);
        $profiles->addCategory($category2);
        $profiles->addCategory($category3);
        $profiles->addCategory($category6);

        $manager->persist($profiles);


        // insert on BDD
        $manager->flush();

    }


}
