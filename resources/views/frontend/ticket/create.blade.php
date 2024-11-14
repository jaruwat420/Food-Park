@extends('admin.layouts.master')

@section('title', 'createTickets')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tickets</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        {{-- <h4>Card Header</h4> --}}
        <div class="card-header-action">
            <h4>Create Tickets</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.ticket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label>Priority</label>
                <select name="status" id="" class="form-control">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
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
