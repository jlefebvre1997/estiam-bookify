<?php

namespace AppBundle\Fixtures;

use AppBundle\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com>
 */
class TypeFixtures extends Fixture implements ORMFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (Type::TYPES as $name) {
            $category = new Type();
            $category->setType($name);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
