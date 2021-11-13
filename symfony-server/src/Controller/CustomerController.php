<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    // /**
    //  * @Route("/customer", name="customer")
    //  */
    // public function index(): Response
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/CustomerController.php',
    //     ]);
    // }
    public function indexAction(Request $request):Response
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        return $this->json($customers);
    }
    public function createAction(Request $request):Response
    {
        return $this->json('');
    }
}
