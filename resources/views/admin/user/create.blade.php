@extends('admin.layouts.master')

@section('title', 'แก้ไขผู้ใช้งาน')

@section('css')
<style>

</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>ใช้งาน</h1>
    </div>
</section>
<div class="card card-primary">
    <div class="card-header">
        <h4>สร้างผู้ใช้งาน</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>ชื่อผู้ใช้งาน</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label>อีเมล</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label>รหัสผ่าน</label>
                <input type="text" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>ยินยันรหัสผ่าน</label>
                <input type="text" name="password_confirmation" class="form-control">
            </div>
            <div class="form-group">
                <label>ระดับสิทธิ์</label>
                <select name="role" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>

</script>
@endpush
