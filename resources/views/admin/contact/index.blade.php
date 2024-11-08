@extends('admin.layouts.master')

@section('title', 'ปัญหาการใช้งาน')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>การแแจ้งปัญหาการใช้งาน</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>ทั้งหมด</h4>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
