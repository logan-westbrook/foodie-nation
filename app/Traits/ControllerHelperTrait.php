<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;
use Throwable;

trait ControllerHelperTrait
{
    protected static function redirectSuccess(
        string $message,
        string $route
    ): RedirectResponse {
        toastr()->success($message);

        return to_route($route);
    }
}

