<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param  int  $id
     * @param  UserService  $service
     * @return RedirectResponse
     */
    public function info(int $id, UserService $service):RedirectResponse
    {
        $data = $service->info($id);

        toastr()->info("$data", [
            'allowHtml'         => true,
        ]);

        return back();
    }
}
