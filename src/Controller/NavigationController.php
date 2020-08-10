<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NavigationController extends BaseController
{
    public function navigation()
    {
        return $this->render('_navigation.html.twig');
    }
}
