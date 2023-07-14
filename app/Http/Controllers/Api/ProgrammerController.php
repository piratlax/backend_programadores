<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Programmer;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProgrammerController extends Controller
{
    use ApiResponder;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $programmers = Programmer::paginate(10);
        return $this->success(
            "Programmers",
            $programmers->toArray(),
        );
    }
}
