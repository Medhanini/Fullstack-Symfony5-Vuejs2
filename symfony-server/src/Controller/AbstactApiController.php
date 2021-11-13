<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstactApiController extends AbstractController
{
    protected function buildForm($name='',string $type,$data=null,array $options = [])
    {
        $options = array_merge($options,[
            'csrf_protection' => false
        ]);
        return $this->container->get('form.factory')->createNamed($name , $type , $data , $options);
    }
}
