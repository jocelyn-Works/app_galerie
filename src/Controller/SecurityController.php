<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use App\Service\UploaderPicture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class SecurityController extends AbstractController
{

    #[Route('/signup', name: 'signup')]
    public function signup(Request $request,
    UserPasswordHasherInterface $passwordHasher,
    // UploaderPostPicture $uploaderPostPicture,
    EntityManagerInterface $em
    ): Response
    {     
        // Inscription d'un nouveaux utilisateur 
        
        $user = new User();
        // création du formulaire
        $userForm = $this->createForm(UserType::class, $user);
        
        $userForm->remove('picture');
        $userForm->remove('picture');
        $userForm->remove('instagram');
        $userForm->remove('aPropos');
        $userForm->remove('telephone');

        $userForm->handleRequest($request);
        
        if ($userForm->isSubmitted() && $userForm->isValid()) { 

            // $user->setPicture("build/images/default_profiles.png"); 

            // hashage du mot de passe
            $hash = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hash);

            // Enregistrement dans la Base de Données
            $em->persist($user); 
            $em->flush();

            
        }
        return $this->render('security/signup.html.twig', [   
            'form' => $userForm->createView()  // Appele du formulaire
        ]); 
    }
    
    #[Route(path: '/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
