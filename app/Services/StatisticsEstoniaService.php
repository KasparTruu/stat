<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class StatisticsEstoniaService
{
    protected $baseUrl = 'https://andmed.stat.ee/api/v1/et/stat/';

    public function getRV021Data($params = [])
    {
        $response = Http::get($this->baseUrl . 'RV021', $params);

        \Log::info('API Response:', ['status' => $response->status(), 'body' => $response->body()]);
        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function getAllPopulationData()
    {
        $params = [
            'lang' => 'et',
        ];

        $data = $this->getRV021Data($params);

        if (!$data) {
            return null;
        }

        // Process and structure the data
        $processedData = [];
        foreach ($data['data'] as $item) {
            $processedData[] = [
                'year' => $item['Aasta'],
                'population' => $item['Rahvaarv'],
                'gender' => $item['Sugu'],
                'county' => $item['Maakond'],
            ];
        }

        return $processedData;
    }

    public function getPaginatedPopulationData($perPage = 15)
    {
        $allData = $this->getAllPopulationData();
        
        if (!$allData) {
            return null;
        }

        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;

        $items = array_slice($allData, $offset, $perPage);

        return new LengthAwarePaginator(
            $items,
            count($allData),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}