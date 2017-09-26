<?php

namespace MoviesBundle\Controller;

use MoviesBundle\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminReviewMoviesController extends Controller
{
    public function deleteReviewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('MoviesBundle:Review');
        $review = $repo->find($id);

        $em->remove($review);
        $this->addFlash("success", "la critique ".$review->getTitre()." a bien été supprimé");
        $em->flush();
        return $this->redirectToRoute("Review");
    }
    public function listeAction()
    {
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Review');
        $review = $repo->findUpAllReview();
        return $this->render('MoviesBundle:adminReview:liste.html.twig',[
            "reviews" => $review
        ]);
    }
    public function editReviewAction($id, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('MoviesBundle:Review');
        $review = $repo->find($id);

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            $this->addFlash("success", "la critique ".$review->getTitre()." a bien été modifiée");
            return $this->redirectToRoute("Review");

        }

        return $this->render('@Movies/adminReview/editReview.twig', [
            "form" => $form->createView(),
            "review" => $review
        ]);

    }
}
