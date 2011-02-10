<?php

/**
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\TeraWurflBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Default controller
 */
class DefaultController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $response = new Response('testcontent');
        return $response;
    }

}
