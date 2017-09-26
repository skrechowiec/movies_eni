<?php

namespace NantesBundle\Controller;

use MoviesBundle\Entity\User;
use MoviesBundle\Form\MdPType;
use MoviesBundle\Form\ProfilEditType;
use MoviesBundle\Form\ProfilType;
use MoviesBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        // get the login error if there is one
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('MoviesBundle:User:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    public function registerAction(Request $request)
    {
        $connectedUser = $this->getUser();
        if ($connectedUser) {
            $this->addFlash('warning', 'Vous êtes déjà inscrit');
            return $this->redirectToRoute('movies_homepage');
        }
        $user = new User();
        $user->setRegistrationDate(new \DateTime());
        $formUser = $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);
        if ($formUser->isSubmitted() && $formUser->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "vous ètes enregistrés");
            return $this->redirectToRoute("movies_homepage");
        }

        return $this->render('MoviesBundle:User:register.html.twig', [
            "form" => $formUser->createView()
        ]);
    }

    public function deleteAction($id)
    {
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('MoviesBundle:User');
            $user = $repo->find($id);

            if ($user === $this->getUser()) {
                $this->get('security.token_storage')->setToken(null);
                $em->remove($user);
                $em->flush();
                $this->addFlash("success", "vous avez bien été supprimé");
                return $this->redirectToRoute("movies_homepage");
            }

        }
    }

    public function MdPEditAction($id, Request $request)
    {
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('moviesBundle:User');
            $user = $repo->find($id);

            $connectedUser = $this->getUser();
            if ($connectedUser) {
                if ($user === $this->getUser()) {
                    $formUser = $this->createForm(MdPType::class, $user);

                    $formUser->handleRequest($request);
                    if ($formUser->isSubmitted() && $formUser->isValid()) {
                        $encoder = $this->container->get('security.password_encoder');
                        $encoded = $encoder->encodePassword($user, $user->getPassword());
                        $user->setPassword($encoded);

                        $em = $this->getDoctrine()->getManager();

                        $em->persist($user);
                        $em->flush();

                        $this->addFlash("success", "vous avez bien changé de MdP");
                        return $this->redirectToRoute("movies_homepage");
                    }
                }

                return $this->render('MoviesBundle:User:MdP_edit.html.twig', [
                    "form" => $formUser->createView()
                ]);
            }
        }
    }

    public function ProfilEditAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('MoviesBundle:User');
        $user = $repo->find($id);

        $connectedUser = $this->getUser();
        if ($connectedUser) {
            if ($user === $this->getUser()) {
                $formUser = $this->createForm(ProfilType::class, $user);
                $formUser->handleRequest($request);
                if ($formUser->isSubmitted() && $formUser->isValid()) {
                    $em = $this->getDoctrine()->getManager();

                    $em->persist($user);
                    $em->flush();

                    $this->addFlash("success", "Les données ont été modifiées");
                    return $this->redirectToRoute("movies_homepage");
                }

                return $this->render('moviesBundle:User:ProfilEdit.html.twig', [
                    "form" => $formUser->createView()
                ]);
            }
        }
    }
}