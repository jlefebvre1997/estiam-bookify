<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Annonce;
use AppBundle\Form\AnnonceType;
use AppBundle\Form\SearchType;
use AppBundle\Model\Search;
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
     * @Route("/search", name = "annonce_search")
     *
     * @param Request $request
     *
     * @return array|string
     */
    public function search(Request $request)
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Search $search */
            $search = $form->getData();

            return $this->render('@App/annonce/results.html.twig', [
                'results' => $this->getDoctrine()->getRepository(Annonce::class)->search($search)
            ]);
        }

        return $this->render('@App/annonce/search.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Template
     *
     * @param Request $request
     *
     * @Route("/create-annonce", name="annonce_form")
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Exception
     */
    public function form(Request $request){
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
