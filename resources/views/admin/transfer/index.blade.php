@extends('admin.layouts.master')

@section('title', 'ถ่ายโอนข้อมูล')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>ถ่ายโอนข้อมูล</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>ถ่ายโอนข้อมูล</h4>
        <div class="card-header-action">
            <button href="#" class="btn btn-warning" onclick="transferData();">
                ถ่ายโอนข้อมูล
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="">
                    <div class="form-group">
                        <label>นำเข้าข้อมูล</label>
                        <input type="file" class="form-control">
                    </div>
                    <button class="btn btn-success">นำเข้าข้อมูล</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
    <script>
        $(document).ready(function (){

        });
    </script>
@endpush
