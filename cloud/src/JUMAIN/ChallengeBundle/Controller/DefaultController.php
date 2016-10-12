<?php

namespace JUMAIN\ChallengeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use JUMAIN\ChallengeBundle\Entity\Client;
use JUMAIN\ChallengeBundle\Form\Type\ClientType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('JUMAINChallengeBundle:Default:index.html.twig');
    }
    
    public function listClientAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $clientEntity = new Client();
        $form = $this->ClientCreateForm($clientEntity);

        $clients = $em->getRepository('JUMAINChallengeBundle:Client')
                ->findAllClients();
        
        return $this->render('JUMAINChallengeBundle:Default:list.html.twig',
                                array(
                                'clients' => $clients,
                                'form' => $form->createView(),
                            ));
    }
    
    public function addClientAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $clientEntity = new Client();
        $form = $this->ClientCreateForm($clientEntity);
        
        return $this->render('JUMAINChallengeBundle:Default:addClient.html.twig',
                                array(
                                'form' => $form->createView(),
                            ));
    }
    
    public function updClientAction(Request $request)
    {
        $clientEntity = new Client();
        
        $form = $this->ClientCreateForm($clientEntity);
        
        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($clientEntity);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('notice','Successfully Added...');

                return $this->redirect($this->generateUrl('jumain_list_client'));
            }
            
            $this->get('session')->getFlashBag()->add('error','Error Adding Client ...');
        }
        
        return $this->redirect($this->generateUrl('jumain_list_client'));
    }
    
    
    /**
    * Creates a form to create a Client entity.
    *
    * @param Client $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function ClientCreateForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('jumain_upd_client'),
            'method' => 'POST',
        ));
        
        $form->add('save', SubmitType::class, array('label' => 'Save'));

        return $form;
    }
}
