<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Annonce;
use AppBundle\Form\AnnonceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com> && Maxence Vast <mvast@agencedps.com>
 *
 * @Route("/annonces")
 */
class AnnonceController extends Controller
{
    /**
     * @Template
     *
     * @param Annonce $annonce
     *
     * @Route("/view/{id}", name = "annonce_view")
     *
     * @return array
     */
    public function view(Annonce $annonce)
    {
        return ['annonce' => $annonce];
    }

    /**
     * @Template
     *
     * @param Request $request
     *
     * @Route("/create-annonce", name="annonce_form")
     *
     * @return array
     */
    public function form(Request $request){
        $annonce = new Annonce();

        $form = $this->createForm(AnnonceType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $annonce = $form->getData();
            $annonce->setCreatedAt(new \DateTime());
            $annonce->setUser($this->getUser());
            $this->getUser()->addAnnonce($annonce);
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('user_annonces');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
