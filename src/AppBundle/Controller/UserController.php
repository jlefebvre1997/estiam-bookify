<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com>
 *
 * @Route("/me")
 */
class UserController extends Controller
{
    /**
     * @Template
     *
     * @Route("/annonces", name = "user_annonces")
     */
    public function annonces()
    {
        return [
            'annonces' => $this->getUser()->getAnnonces()
        ];
    }
}
