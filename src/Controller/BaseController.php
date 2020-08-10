<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    public static $title;
    
    public function SetTitle($title)
    {
        self::$title = $title;
    }
}
