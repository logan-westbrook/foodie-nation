@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Why Choose Us</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ $header }}</h4>
            </div>
            <div class="card-body">
                <form
                    method="POST"
                    action="{{ $route }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method($method ?? 'POST')
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        </br>
                        <button
                            id="icon"
                            name="icon"
                            class="btn btn-primary"
                            role="iconpicker"
                            data-icon="{{ $item->icon ?? '' }}"
                        ></button>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control"
                            value="{{ $item->title ?? '' }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="short-description">Short Description</label>
                        <textarea
                            id="short-description"
                            name="short_description"
                            class="form-control"
                        >{{ $item->short_description ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option
                                @selected(($item->status ?? 1) === 1)
                                value="1"
                            >
                                Active
                            </option>
                            <option
                                @selected(($item->status ?? 1) === 0)
                                value="0"
                            >
                                Inactive
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $submitText }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
