@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Sliders</h4>
            </div>
            <div class="card-body">
                <form
                    method="POST"
                    action="{{  route('admin.slider.store') }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="offer">Offer</label>
                        <input id="offer" name="offer" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control"
                        >
                    </div>
                    <div class="form-group">
                        <label for="sub-title">Sub Title</label>
                        <input
                            type="text"
                            id="sub-title"
                            name="sub_title"
                            class="form-control"
                        >
                    </div>
                    <div class="form-group">
                        <label for="short-description">Short Description</label>
                        <textarea
                            id="short-description"
                            name="short_description"
                            class="form-control"
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="button-link">Button Link</label>
                        <input
                            type="text"
                            id="button-link"
                            name="button_link"
                            class="form-control"
                        >
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select
                            id="status"
                            name="status"
                            class="form-control"
                        >
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
