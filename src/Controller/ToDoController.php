<?php
	namespace App\Controller;
	use App\Entity\Todo;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
  	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;

	use Symfony\Component\HttpFoundation\Request;

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

			// dump($todos, $this);  // Debug tool from the debug toolbar, which does not work...

		}

		/**
		* @Route("/todo/{id}", name="to_do_show")
		* @Method({"GET"})
		*/
		public function show($id) {
			$todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);
			return $this->render('todo/show.html.twig', ['todo' => $todo]); 
		}

		/**
		* @Route("/todo/add", name="to_do_add")
		* Method({"GET", "POST"})
		*/
		public function add(Request $request) {
			$todo = new Todo();
			
		}

		
	} 
?>