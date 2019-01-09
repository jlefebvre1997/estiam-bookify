<?php
/**
 * Created by PhpStorm.
 * User: MUD0
 * Date: 08/01/2019
 * Time: 16:32
 */
namespace AppBundle\Fixtures;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture implements  ORMFixtureInterface
{
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

        foreach (Type::TYPES as $name) {
            $category = new Type();
            $category->setType($name);

            $manager->persist($category);
        }

        foreach ($authors as $author){
            $authorName = new Author();
            $authorName->setName($author);

            foreach ($books as $book){
                $bookName = new Book();
                $bookName->setTitle($book);
                $bookName->setDescription("description");
                $bookName->addAuthor($authorName);

                $authorName->addBook($bookName);

                $manager->persist($bookName);
            }

            $manager->persist($authorName);
        }

        $manager->flush();
    }
}
