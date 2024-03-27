<?php

namespace App\Http\Controllers\Admin\Webapp;

use App\Http\Controllers\Controller;
use App\Services\CsvService;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    protected $service;

    public function __construct(CsvService $service)
    {
        $this->service = $service;
    }

    public function CompaniesExport()
    {
        return $this->service->companiesExport();
    }
}
