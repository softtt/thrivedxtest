<?php

namespace App\Http\Controllers;

use App\Services\SortingService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class MainController extends BaseController
{
    public function index(): View
    {
        return view('welcome');
    }

    public function sort(Request $request): View
    {
        $input = $request->get('input');

        if (empty($input)) {
            return view('welcome', ['error' => 'input is empty but i need a string']);
        }

        $sortingService = new SortingService($input);
        $sorted = $sortingService->sort();

        return view('welcome', ['sorted' => $sorted, 'input' => $input]);
    }
}
