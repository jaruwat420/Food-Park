@extends('admin.layouts.master')

@section('title', 'createSlider')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Upate</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>Card Header</h4>
        <div class="card-header-action">
            <h4>Update Slider</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Image</label>

                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="image" id="image-upload">
                </div>
            </div>
            <div class="form-group">
                <label>Offer</label>
                <input type="text" name="offer" class="form-control" value="{{ $slider->offer }}">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
            </div>
            <div class="form-group">
                <label>Sub Title</label>
                <input type="text" name="sub_title" class="form-control" value="{{ $slider->sub_title }}">
            </div>
            <div class="form-group">
                <label>Short Description</label>
                <textarea type="text" name="short_description" class="form-control" value="{{ $slider->short_description }}"></textarea>
            </div>
            <div class="form-group">
                <label>Button Link</label>
                <input type="text" name="button_link" class="form-control" value="{{ $slider->button_link }}">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" >
                    <option @selected($slider->status === 1) value="1">Active</option>
                    <option @selected($slider->status === 0) value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function(){
        $('.image-preview').css({
            'background-image': 'url({{ asset($slider->image) }})',
            'background-size': 'cover',
            'background-position': 'center center'
        })
    })
</script>
@endpush
