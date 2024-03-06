@php
    $header = 'Edit Item';
    $route = route('admin.why-choose-us.update', $whyChooseUs->id);
    $submitText = 'Update';
    $item = $whyChooseUs;
    $method = "PUT";
@endphp

@include('admin.why-choose-us.build')
