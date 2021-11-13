<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse; 
use App\Entity\Customer;
use App\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractApiController

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
    public function indexAction(Request $request):JsonResponse
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        $formatted = [];
        foreach ($customers as $customer) {
            $formatted[] = [
            'id' => $customer->getId(),
            'email' => $customer->getEmail(),
            'PhoneNumber' => $customer->getPhoneNumber(),
            ];
        }

        return new JsonResponse($formatted);
    }
    public function createAction(Request $request):JsonResponse
    {
        $form = $this->buildForm(CustomerType::class);
        $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid()){
            print'Form is not valid';
            exit;
        }
        /** @var Customer $customer */
        $customer = $form->getData();
        $this->getDoctrine()->getManager()->persist($customer);
        $this->getDoctrine()->getManager()->flush();
        $formatted = [];
            $formatted[] = [
            'id' => $customer->getId(),
            'email' => $customer->getEmail(),
            'PhoneNumber' => $customer->getPhoneNumber(),
            ];

        return new JsonResponse($formatted);
    }
}
