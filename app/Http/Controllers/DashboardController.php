<?php

namespace App\Http\Controllers;

use App\Services\StatisticsEstoniaService;

class DashboardController extends Controller
{
    protected $statisticsService;

    public function __construct(StatisticsEstoniaService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index()
    {
        $populationData = $this->statisticsService->getPaginatedPopulationData(20);
        return view('dashboard', compact('populationData'));
    }
}