@extends('admin.layouts.master')

@section('title', 'createSlider')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create</h1>
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
        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Image</label>

                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="image" id="image-upload">
                </div>
            </div>
            <div class="form-group">
                <label>Offer</label>
                <input type="text" name="offer" class="form-control">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Sub Title</label>
                <input type="text" name="sub_title" class="form-control">
            </div>
            <div class="form-group">
                <label>Short Description</label>
                <textarea type="text" name="short_description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Button Link</label>
                <input type="text" name="button_link" class="form-control">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="" class="form-control">
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush
