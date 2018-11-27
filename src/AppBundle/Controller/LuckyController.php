<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number"),
	 * requirements={"url" = ".*\/$"}
     */
    public function numberAction()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));
    }
	
	 /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     */
    public function listAction($page = 1)
    {
       $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky page: '.$page.'</body></html>'
        );
    }
    
}
