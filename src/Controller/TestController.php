<?php

namespace App\Controller;

use App\Repository\AdminUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AdminUser;

class TestController extends AbstractController
{
    #[Route('/test')]
    public function index(UserPasswordHasherInterface $passwordHasher , AdminUserRepository $adminUserRepository): Response
    {
        $user = new AdminUser();
        $plaintextPassword = 'mhm36Ek6NU2E';

        $user->setUsername('MarieDo');
        $user->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        var_dump($user);

//        $adminUserRepository->save($user, true);

        return new Response('testController here 2');
    }

}