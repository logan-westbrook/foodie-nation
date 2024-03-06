<?php

namespace App\Http\Controllers;

use App\Traits\ControllerHelperTrait;
use Illuminate\Http\Response;
use Throwable;

abstract class AbstractController extends Controller
{
    use ControllerHelperTrait;

    abstract protected static function deleteEntity(string $id): void;

    protected function delete(string $id): Response
    {
        try {
            $this->deleteEntity($id);
            $message = 'Your slider was successfully deleted!!!';
            $status = 200;
        } catch (Throwable $t) {
            error_log($t->getMessage());
            $message = 'An Error Occurred during deletion. Please try again';
            $status = 500;
            $content = [ 'error' => $t->getMessage() ];
        } finally {
            $content = array_merge(
                $content ?? [],
                [ 'status' => $status, 'message' => $message ]
            );

            return response($content, $status);
        }
    }
}
