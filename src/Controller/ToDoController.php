<?php
	namespace App\Controller;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
  	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	class ToDoController {
		/**
		* @Route("/", name="to_do_index")
		* @Method({"GET"})
		*/
		public function index() {
			return new Response('<html><body><h1>TEST</h1></body></html>');
		}
	} 
?>