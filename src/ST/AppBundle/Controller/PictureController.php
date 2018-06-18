<?php

namespace ST\AppBundle\Controller;

use ST\AppBundle\Entity\Trick;
use ST\AppBundle\Form\PictureEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PictureController extends Controller
{

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    
    $picture = $em->getRepository('STAppBundle:Picture')->find($id);
    $slug = $picture->getTrick()->getSlug();

    if (null === $picture) {
      throw new NotFoundHttpException("L'image d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(PictureEditType::class, $picture);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $em->flush();

      $request->getSession()->getFlashBag()->add('message', 'L\'image a bien été modifiée');

      return $this->redirectToRoute('st_app_view', array('slug' => $slug));
    }

    return $this->render('STAppBundle:Trick:editPicture.html.twig', array(
         'picture' => $picture,
         'form' => $form->createView(),
    ));
  }

}
