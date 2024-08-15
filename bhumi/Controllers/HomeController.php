<?php

namespace EcommerceGroup10\Cakery\Controllers;

use EcommerceGroup10\Cakery\Helpers\ViewHelper;
use EcommerceGroup10\Cakery\Models\Cake;

class HomeController
{
    private $cake;
    private $pexelsApiKey = '';
    private $imageUrl;

    public function __construct()
    {
        $this->cake = new Cake();
    }

    public function index()
    {
        $this->imageUrl = $this->fetchPexelsImageUrl();
        return ViewHelper::renderView("home", ['imageUrl' => $this->imageUrl]);
    }

    public function getCakes()
    {
        $cakes = $this->cake->getAllCakes();
        return ViewHelper::renderView("cake", ['cakes' => $cakes]);
    }

    public function cakeDetails($id)
    {
        $cake = $this->cake->getCakeById($id);
        return ViewHelper::renderView("cake-details", ['cake' => $cake]);
    }

    public function fetchImage()
    {
        $imageUrl = $this->fetchPexelsImageUrl();
        if ($imageUrl) {
            echo json_encode(['status' => 'success', 'imageUrl' => $imageUrl]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to fetch image']);
        }
    }

    private function fetchPexelsImageUrl()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pexels.com/v1/search?query=cake&per_page=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Authorization: $this->pexelsApiKey"
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            curl_close($curl);
            return null;
        }

        $data = json_decode($response, true);
        curl_close($curl);

        if (isset($data['photos']) && count($data['photos']) > 0) {
            return $data['photos'][0]['src']['original'];
        } else {
            return null;
        }
    }
}
