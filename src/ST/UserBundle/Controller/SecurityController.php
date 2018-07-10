<?php

namespace ST\UserBundle\Controller;

use ST\UserBundle\Entity\User;
use ST\UserBundle\Form\UserType;
use ST\UserBundle\Form\ForgotPasswordType;
use ST\UserBundle\Form\ResetPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('st_app_home');
        }

        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('STUserBundle:Security:login.html.twig', array(
          'last_username' => $authenticationUtils->getLastUsername(),
          'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setValidationToken(md5(time()*rand(542, 792)));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('message', 'Votre compte a bien été enregistré, un mail de confirmation a été envoyé sur votre adresse mail, veuillez cliquer sur le lien proposé.');

            $message = (new \Swift_Message('Confirmation d\'inscription sur le site SnowTricks'))
              ->setFrom('noreply@snowtricks-hassandoumali.com')
              ->setTo($user->getEmail())
              ->setBody(
                  $this->renderView('STUserBundle:Security:registerValidation.html.twig', array(
                      'name' => $user->getUsername(),
                      'token' => $user->getValidationToken()
                  )),
                  'text/html'
              );

            $this->get('mailer')->send($message);

            return $this->redirectToRoute('st_app_home');
        }

        return $this->render('STUserBundle:Security:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function registerValidationAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('STUserBundle:User')->findOneBy(array('validationToken' => $token));

        if($user) {

          $user->setValidationToken(null);
          $user->setIsActive(true);
          $em->flush();

          $request->getSession()->getFlashBag()->add('message', 'Bonjour, votre compte est désormais actif, vous pouvez vous connecter à votre espace.');
        } else {

          $request->getSession()->getFlashBag()->add('message', 'Oups ! Vous venez de cliquer sur un lien qui n\'existe pas.');
        }

        return $this->redirectToRoute('st_app_home');
    }
    
    public function forgotPasswordAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();

         $form = $this->get('form.factory')->create(ForgotPasswordType::class);
        
         if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            
            $user = $form->getData();
            $user = $em->getRepository('STUserBundle:User')->findOneBy(array('username' => $user->getUsername()));

             if($user) {

                  $user->setValidationToken(md5(time()*rand(542, 792)));
                  $em->flush();

                  $request->getSession()->getFlashBag()->add('message', 'Un mail de validation a été envoyé sur adresse email, veuillez cliquer sur le lien proposé afin de pouvoir modifier votre ancien mot de passe.');

                  $message = (new \Swift_Message('Modification du mot de passe sur le site SnowTricks'))
                    ->setFrom('noreply@snowtricks-hassandoumali.com')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView('STUserBundle:Security:forgotPasswordValidation.html.twig', array(
                            'name' => $user->getUsername(),
                            'token' => $user->getValidationToken()
                        )),
                        'text/html'
                    );

                  $this->get('mailer')->send($message);
             } else {

                  $request->getSession()->getFlashBag()->add('message', 'Nom d\'utilisateur invalide.');
                  return $this->redirectToRoute('forgot_password');
             }

             return $this->redirectToRoute('st_app_home');
         }
         return $this->render('STUserBundle:Security:forgotPassword.html.twig', array(
              'form' => $form->createView(),
          ));
    }

    public function resetPasswordAction(Request $request, $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();

        if($user = $em->getRepository('STUserBundle:User')->findOneBy(array('validationToken' => $token))) {

            $form = $this->get('form.factory')->create(ResetPasswordType::class, $user);

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

              $user->setValidationToken(null);
              $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
              $user->setPassword($password);
              $em->flush();

              $request->getSession()->getFlashBag()->add('message', 'Bonjour '. $user->getUsername(). ', Votre mot de passe a été changé avec succès, vous pouvez désormais vous connecter.');

              return $this->redirectToRoute('st_app_home');

            }
              $request->getSession()->getFlashBag()->add('message', 'Oups ! Une erreur s\'est produite, merci de renouveller votre demande.');
        }

        return $this->render('STUserBundle:Security:resetPassword.html.twig', array(
              'user' => $user,
              'form' =>$form->createView(),
        ));
    }

    public function profileAction()
    {
      return $this->render('STUserBundle:Security:profile.html.twig');

    }
}
