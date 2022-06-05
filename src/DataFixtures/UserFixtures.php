<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $mail = ["seznam.cz", "google.com", "volny.cz", "hot.com", "outlook.cz"];
        $cities = [
            [76000, "New York"],
            [27500, "PARIS"],
            [76380, "Lyon"],
            [76800, "Vienna"],
            [76530, "Prague"]
        ];
        $LastNames = ["Martin", "Dan", "Durand", "Duval", "Gossart", "Chemin", "Kowalski", "Richard", "Paulie", "Saint"];
        $FirstNames = [
            ["M", "Olivier"], ["M", "Thomas"], ["Mme", "Aurelie"], ["Mme", "Agnes"], ["M", "Antoine"],
            ["Mlle", "Anais"], ["M", "Armand"], ["Mme", "Florence"], ["M", "Gilles"], ["Mme", "Isabelle"]
        ];
        $streets = ["25 eve NY", "12 London", "32 saint maria", "13 next to the post", "11 avenue Singapour"];
        $date = new \DateTime(date('d-m-Y'));

        for ($i = 0; $i < 10; $i++) {
            $city = $cities[array_rand($cities, 1)];
            $user = new User();
            $firstname = $FirstNames[array_rand($FirstNames, 1)];
            $lastname = $LastNames[array_rand($LastNames, 1)];
            $user->setFirstname($firstname[1]);
            $user->setLastname($lastname);
            $user->setEmail($firstname[1] . $lastname . "@" . $mail[array_rand($mail, 1)]);
            $user->setCity($city[1]);
            $user->setCityCode($city[0]);
            $user->setAdress($streets[array_rand($streets, 1)]);
            $user->setPhone("+420111222333");

            // Hash password
            $password = $this->encoder->encodePassword($user, 'password1');

            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();
        }
    }
}
