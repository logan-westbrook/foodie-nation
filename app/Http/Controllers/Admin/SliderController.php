<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slider\SliderCreateRequest;
use App\Http\Requests\Admin\Slider\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request): RedirectResponse
    {
        Slider::createNewSliderFromRequest($request);

        return $this->redirectSuccess('A new slider was successfully created!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $slider = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id): RedirectResponse
    {
        /** @var Slider $slider */
        Slider::findOrFail($id)->updateSliderFromRequest($request);

        return $this->redirectSuccess('Slider has been successfully update!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Slider::findOrFail($id)->deleteSlider();
            $message = 'Your slider was successfully deleted!!!';
            $status = 200;
        } catch (Throwable $t) {
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

    protected function redirectSuccess(string $message): RedirectResponse
    {
        toastr()->success($message);

        return to_route('admin.slider.index');
    }
}
