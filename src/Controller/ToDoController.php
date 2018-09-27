<?php
	namespace App\Controller;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
  	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

  	// class ToDoController {  
	class ToDoController extends Controller{  
		/**
		* @Route("/", name="to_do_index")
		* @Method({"GET"})
		*/
		public function index() {
			// return new Response('<html><body><h1>TEST</h1></body></html>');
			return $this->render('todo/index.html.twig');

		}
	} 
?>