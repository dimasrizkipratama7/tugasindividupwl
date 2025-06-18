<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class OngkirController extends ResourceController
{
    public function getCost()
    {
        $destination = $this->request->getGet('destination');
        $weightKg    = $this->request->getGet('weight');
        $type        = $this->request->getGet('type');

        // Konversi berat ke gram (jika API butuh dalam gram)
        $weight = intval($weightKg) * 1000;

        // Simulasi dummy ongkir berdasarkan tipe pengiriman dan berat
        $baseCost = match ($type) {
            'express' => 15000,
            'cargo'   => 5000,
            default   => 10000 // reguler
        };

        // Dummy ongkir per kg
        $cost = $baseCost * intval($weightKg);

        // Dummy response
        $result = [[
            'service'     => strtoupper($type),
            'description' => "Pengiriman " . ucfirst($type),
            'etd'         => match ($type) {
                'express' => '1-2 hari',
                'cargo'   => '3-5 hari',
                default   => '2-3 hari'
            },
            'cost'        => $cost
        ]];

        return $this->response->setJSON($result);
    }
}
