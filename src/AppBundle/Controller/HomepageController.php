<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 15. 12. 2016
 * Time: 22:54
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('homepage/index.html.twig');
    }

    
}