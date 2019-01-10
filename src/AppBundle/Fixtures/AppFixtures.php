<?php

namespace AppBundle\Fixtures;

use AppBundle\Entity\Annonce;
use AppBundle\Entity\Type;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;

/**
 * @author Maxence Vaast
 */
class AppFixtures extends Fixture implements  ORMFixtureInterface
{
    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("coucou");
        $user->setPlainPassword("coucou");
        $user->setEmail('email@email.com');
        $user->setRoles(['ROLE_USER']);

        $this->userManager->updateUser($user);

        for ($i = 0; $i < 5; $i++) {
            $annonce = new Annonce();
            $annonce->setPrice(10000);
            $annonce->setDescription('Description');
            $annonce->setLibelle('Libellé');
            $annonce->setTitle('Title');
            $annonce->setUser($user);
            $annonce->setAuthor('Author');
            $annonce->setCity('City');
            $annonce->setCreatedAt(new \DateTime('now'));
            $annonce->setType(Type::TYPES[0]);

            $manager->persist($annonce);

            $user->addAnnonce($annonce);
        }

        $this->userManager->updateUser($user);

        $manager->flush();
    }
}
