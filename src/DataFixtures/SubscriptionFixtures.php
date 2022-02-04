<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sub = new Subscription();
        $sub->setLabel('Offre standart');
        $sub->setPrice(1000); //10€
        $sub->setCapacity(60);
        $sub->setCreatedAt(new \DateTime());

        $manager->persist($sub);

        $sub = new Subscription();
        $sub->setLabel('Offre premium');
        $sub->setPrice(2000); //20€
        $sub->setCapacity(150);
        $sub->setCreatedAt(new \DateTime());

        $manager->persist($sub);

        $sub = new Subscription();
        $sub->setLabel('Offre mini');
        $sub->setPrice(500); //5€
        $sub->setCapacity(20);
        $sub->setCreatedAt(new \DateTime());

        $manager->persist($sub);

        $manager->flush();
    }
}
