<?php
/**
 * Created by PhpStorm.
 * User: MUD0
 * Date: 08/01/2019
 * Time: 16:32
 */
namespace AppBundle\Fixtures;

use AppBundle\Entity\Annonce;
use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;

class AppFixtures extends Fixture implements  ORMFixtureInterface
{
    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $books = [
            'L\'Appel de Cthulhu',
            'Le Trône de fer',
            'Ça',
            'Harry Potter à l\'école des sorciers',
            'Berserk',
            'Le Silmarillion',
        ];

        $authors = [
           'J. R. R. Tolkien',
           'J. K. Rowling',
           'George R. R. Martin',
           'Stephen King',
           'Howard Phillips Lovecraft',
           'Kentarō Miura',
        ];

        $user = $this->userManager->createUser();
        $user->setUsername("coucou");
        $user->setPlainPassword("coucou");
        $user->setEmail('email@email.com');

        $this->userManager->updateUser($user);

        foreach (Type::TYPES as $name) {
            $category = new Type();
            $category->setType($name);

            $manager->persist($category);
        }

        foreach ($authors as $author) {
            $authorName = new Author();
            $authorName->setName($author);

            $annonce = new Annonce();
            $annonce->setUser($user);
            $annonce->setTitle('title');
            $annonce->setLibelle('libelle');
            $annonce->setDescription('description');
            $annonce->setPrice(10000);

            foreach ($books as $book){
                $bookName = new Book();
                $bookName->setTitle($book);
                $bookName->setDescription("description");
                $bookName->addAuthor($authorName);

                $authorName->addBook($bookName);

                $manager->persist($bookName);
            }

            $manager->persist($annonce);
            $manager->persist($authorName);
        }

        $manager->flush();
    }
}
