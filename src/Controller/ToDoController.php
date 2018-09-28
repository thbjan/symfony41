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


	class ToDoController extends Controller{  


		/**
		* @Route("/", name="to_do_index")
		* @Method({"GET"})
		*/
		public function index() {
			$todos= $this->getDoctrine()->getRepository(Todo::class)->findAll();
			return $this->render('todo/index.html.twig', ['todos' => $todos]);    
		}

		

		/**
		* @Route("/todo/add", name="to_do_add")
		* Method({"GET", "POST"})
		*/
		public function add(Request $request) {
			$todo = new Todo();

			$form = $this->createFormBuilder($todo)
				->add('title', TextType::class, array(
					'label' => 'To-do title',
					'attr' => array('class' => 'form-control')
				))
				->add('task', TextareaType::class, array(
					'label' => 'To-do description',
					'required' => false,  
					'attr' => array('class' => 'form-control')
				))
				->add('save', SubmitType::class, array(
					'label' => 'Add to-do',
					'attr' => array('class' => 'btn btn-primary mt-3')
				))
				->getForm();

			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()) {
				$todo = $form->getData();

				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($todo);
				$entityManager->flush();

				return $this->redirectToRoute('to_do_index');
			}

			return $this->render('todo/add.html.twig', ['form' => $form->createView()] );

		}


		/**
		* @Route("/todo/edit/{id}", name="to_do_edit")
		* Method({"GET", "POST"})
		*/
		public function edit(Request $request, $id) {
			$todo = new Todo();
			$todo = $this->getDoctrine()->getRepository(todo::class)->find($id);

			$form = $this->createFormBuilder($todo)
				->add('title', TextType::class, array(
					'label' => 'To-do title',
					'attr' => array('class' => 'form-control')
				))
				->add('task', TextareaType::class, array(
					'label' => 'To-do description',
					'required' => false,  
					'attr' => array('class' => 'form-control')
				))
				->add('save', SubmitType::class, array(
					'label' => 'Save changes',
					'attr' => array('class' => 'btn btn-primary mt-3')
				))
				->getForm();

			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid()) {

				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->flush();

				return $this->redirectToRoute('to_do_index');
			}

			return $this->render('todo/edit.html.twig', array(
				'form' => $form->createView()
			));
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
		* @Route("/todo/complete/{id}", name="to_do_complete")
		* @Method({"POST"})
		*/
		public function complete(Request $request, $id) {

			// Code snippets and inspiration from:
			// https://symfony.com/doc/current/doctrine.html#updating-an-object

			$entityManager = $this->getDoctrine()->getManager();
		    $todo = $entityManager->getRepository(Todo::class)->find($id);

		    if (!$todo) {
		        throw $this->createNotFoundException(
		            'No todo for id '.$id
		        );
		    }

		    $todo->setTask('New product name!');
		    $entityManager->flush();

		    return $this->redirectToRoute('to_do_index', [
		        'id' => $todo->getId()
		    ]);

		    
		}


		/**
		* @Route("/todo/delete/{id}", name="to_do_delete")
		* @Method({"POST"})
		*/
		public function delete(Request $request, $id) {

			// Code snippets and inspiration from:
			// https://symfony.com/doc/current/doctrine.html#deleting-an-object

			$todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);
			// $todo = $entityManager->getRepository(Todo::class)->find($id);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($todo);
			$entityManager->flush();

			$response = new Response();
			$response->send();

		}
	} 
?>