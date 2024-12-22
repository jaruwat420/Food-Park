@extends('admin.layouts.master')

@section('title', 'ผู้ใช้งาน')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>ผู้ใช้งาน</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">ผู้ใช้งาน</div>
        </div>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>ผู้ใช้งาน :: ทั้งหมด</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                เพิ่มผู้ใช้งาน
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
