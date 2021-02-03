<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/market")
 */
class MarketController extends AbstractController
{
    /**
     * @Route("/", name="get_ids", methods={"GET"})
     */
    public function index(): Response
    {
        $response = new Response();
        $response->setContent(file_get_contents("../data/indices.json"));
        $response->headers->set('Content-Type', 'application/json');
        // Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/{id<\d+>}", name="market_id_content", methods={"GET"})
     */
    public function getContent(int $id): Response
    {
        $response = new Response();
        $fileName = $id . ".json"; //FileName
        $fileExists = file_exists("../data/" . $fileName);
        if (!$fileExists) {
            $errMsg = ['errMsg' => 'invalidUrl'];
            $response->setContent(json_encode($errMsg));
        } else {
            $content = file_get_contents("../data/" . $fileName);
            $response->setContent($content);
        }

        $response->headers->set('Content-Type', 'application/json');
        // Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
