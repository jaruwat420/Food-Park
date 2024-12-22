@extends('admin.layouts.master')

@section('title', 'สถานที่')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>สถานที่</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">หน้าแรก</a></div>
            <div class="breadcrumb-item">สถานที่</div>
        </div>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>สถานที่ ทั้งหมด</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.location.create') }}" class="btn btn-primary">
                สร้างสถานที่ใหม่
            </a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    $(document).ready(function(){

    })
</script>
@endpush
