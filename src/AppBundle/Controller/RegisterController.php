<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
        /**
 * @Route("/register", name="user_registration")
 */
    public function registerAction(Request $request)
    {
        // build the form
        $user = new User();

        //var_dump($request["user"]["username"]);exit;
        $form = $this->createForm(UserType::class, $user);

        // handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, '123456');
            $user->setPassword($password);

            $user->setRoles(["ROLE_ADMIN"]);

            // save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render(
            'register/register.html.twig',
            array('form' => $form->createView())
        );
    }

}