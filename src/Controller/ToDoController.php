<?php
	namespace App\Controller;
	use App\Entity\Todo;
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
			// $todos = ['todo1', 'todo2', 'todo3'];
			$todos= $this->getDoctrine()->getRepository(Todo::class)->findAll();
			return $this->render('todo/index.html.twig', ['todos' => $todos]);    // IMPORTANT: render can pass vars to index.html.twig by an array! 
		}

		
	} 
?>