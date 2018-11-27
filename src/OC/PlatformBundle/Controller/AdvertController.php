<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; // N'oubliez pas ce use
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        // Dans l'action indexAction() :
        return $this->render('@OCPlatform/Advert/index.html.twig', array(
            'listAdverts' => array()
        ));
    }
    
    public function viewAction($id)
    {
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
        
        return $this->render('@OCPlatform/Advert/view.html.twig', array(
            'advert' => $advert
        ));
    }
    
    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :
        
        $antispam = $this->container->get('oc_platform.antispam');
        $text = 'aaaaabbbbbb';
        if ($antispam->isSpam($text)) {
            throw new \Exception('Votre message a été détecté comme spam !');
        }
        
        
        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire
            
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            
            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }
        
        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('@OCPlatform/Advert/add.html.twig');
    }
    

    
    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id
        
        // Ici, on gérera la suppression de l'annonce en question
        
        return $this->render('@OCPlatform/Advert/delete.html.twig');
    }
    
    public function menuAction()
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );
        
        return $this->render('@OCPlatform/Advert/menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listAdverts' => $listAdverts
        ));
    }
    
    public function editAction($id, Request $request)
    {
        // ...
        
        $advert = array(
            'title'   => 'Recherche développpeur Symfony',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
        
        return $this->render('@OCPlatform/Advert/edit.html.twig', array(
            'advert' => $advert
        ));
    }
}