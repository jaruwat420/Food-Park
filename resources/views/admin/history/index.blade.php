@extends('admin.layouts.master')

@section('title', 'ประวัติการใช้งาน')

@section('css')
<style>
    .text-truncate {
        max-width: 150px;  /* หรือขนาดที่คุณต้องการ */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>ประวัติการใช้งาน</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>All History</h4>
        <div class="card-header-action">
            {{-- <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
                Create new
            </a> --}}
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
