<?php

namespace App\Http\Controllers;

use App\Services\DummyJsonService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    protected $dummyJsonService;

    public function __construct(DummyJsonService $dummyJsonService)
    {
        $this->dummyJsonService = $dummyJsonService;
    }

    public function import()
    {
        // Использование $this->dummyJsonService для импорта данных
    }
}
