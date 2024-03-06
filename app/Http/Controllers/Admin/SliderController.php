<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\SliderDataTable;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Admin\Slider\SliderCreateRequest;
use App\Http\Requests\Admin\Slider\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class SliderController extends AbstractController
{
    protected const string ROUTE = 'admin.slider.index';

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

        return $this->redirectSuccess(
            'A new slider was successfully created!!!',
            self::ROUTE
        );
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

        return $this->redirectSuccess(
            'Slider has been successfully update!!!',
            self::ROUTE
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        return $this->delete($id);
    }

    protected static function deleteEntity(string $id): void
    {
        Slider::findOrFail($id)->deleteSlider();
    }
}
