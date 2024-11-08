@extends('admin.layouts.master')
@section('title', 'ถ่ายโอนข้อมูล')
@section('css')
<style>
    .card {
        border-radius: 10px;
        transition: all 0.3s;
    }

    .card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn {
        border-radius: 5px;
    }

    /* เพิ่ม style สำหรับ loading indicator */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
    }

    .loading-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1><i class="fas fa-exchange-alt mr-2"></i>นำเข้าข้อมูล</h1>
    </div>
</section>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">กำลังประมวลผล...</span>
        </div>
        <p class="mt-2">กำลังนำเข้าข้อมูล กรุณารอสักครู่...</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4><i class="fas fa-file-import mr-2"></i>นำเข้าข้อมูล</h4>
                <div class="card-header-action">
                    <button class="btn btn-danger" id="truncateBtn">
                        <i class="fas fa-trash-alt mr-1"></i> ลบข้อมูลทั้งหมด
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">นำเข้าไฟล์ Excel</h5>
                                <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data"
                                    id="importForm">
                                    @csrf
                                    <div class="form-group">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <div class="custom-file">
                                            <input type="file" name="excel_file"
                                                class="custom-file-input @error('excel_file') is-invalid @enderror"
                                                id="customFile" accept=".xlsx,.xls,.csv">
                                            <label class="custom-file-label" for="customFile">เลือกไฟล์</label>
                                        </div>

                                        <div id="fileInfo" class="mt-2 small text-muted"></div>
                                    </div>

                                    <button class="btn btn-success btn-block" type="submit" id="submitBtn">
                                        <i class="fas fa-file-upload mr-1"></i>
                                        <span id="submitText">นำเข้าข้อมูล</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">รูปแบบการนำเข้า</h5>
                                <button class="btn btn-info btn-block" id="downloadFile" type="button">
                                    <i class="fas fa-download mr-1"></i> ดาวน์โหลดไฟล์ตัวอย่าง
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('import_result'))
                <div class="alert alert-{{ session('import_result.success') ? 'success' : 'danger' }} mt-3">
                    <h5 class="alert-heading">{{ session('import_result.message') }}</h5>
                    @if(session('import_result.success'))
                    <p class="mb-0">
                        วันที่และเวลาที่นำเข้า: {{ session('import_result.imported_at') }}
                    </p>
                    @endif
                </div>
                @endif

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">จำนวนนำเข้าได้</h5>
                                    <div>
                                        <span class="h3" id="total_import_success">
                                            {{ session('import_result.total_import_success', 0) }}
                                        </span>
                                        <span>รายการ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">จำนวนนำเข้าไม่ได้</h5>
                                    <div>
                                        <span class="h3" id="total_import_fail">
                                            {{ session('import_result.total_import_fail', 0) }}
                                        </span>
                                        <span>รายการ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-table mr-2"></i>รายการข้อมูลทั้งหมด</h4>
            </div>
            <div class="card-body">
                {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    $(document).ready(function() {
    // จัดการการแสดงชื่อไฟล์และการตรวจสอบ
    $("#customFile").on("change", function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileName = file.name;
            const fileExt = fileName.split('.').pop().toLowerCase();

            // ตรวจสอบนามสกุลไฟล์
            if (!['xlsx', 'xls', 'csv'].includes(fileExt)) {
                alert('กรุณาเลือกไฟล์ Excel (.xlsx, .xls) หรือ CSV เท่านั้น');
                this.value = '';
                return;
            }

            // แสดงชื่อไฟล์และขนาด
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            $("#fileInfo").html(`ชื่อไฟล์: ${fileName}<br>ขนาด: ${fileSize} MB`);
        }
    });

    // จัดการการ submit form
    $("#importForm").on("submit", function() {
        const file = $("#customFile")[0].files[0];
        if (!file) {
            alert('กรุณาเลือกไฟล์ก่อนนำเข้าข้อมูล');
            return false;
        }

        $("#submitBtn").prop('disabled', true);
        $("#submitText").text('กำลังนำเข้าข้อมูล...');
        $("#loadingOverlay").show();
    });

    // ดาวน์โหลดไฟล์ตัวอย่าง
    $("#downloadFile").on("click", function() {
        window.location.href = "{{ route('download.sample') }}";
    });

    // จัดการการลบข้อมูลทั้งหมด
    $("#truncateBtn").on("click", function() {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "การลบข้อมูลทั้งหมดไม่สามารถย้อนกลับได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบทั้งหมด!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#loadingOverlay").show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('truncate.table') }}",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#loadingOverlay").hide();
                        if (response.status === "SUCCESS") {
                            Swal.fire(
                                'สำเร็จ!',
                                'ลบข้อมูลทั้งหมดเรียบร้อยแล้ว',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'ผิดพลาด!',
                                response.message || 'เกิดข้อผิดพลาดในการลบข้อมูล',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        $("#loadingOverlay").hide();
                        Swal.fire(
                            'ผิดพลาด!',
                            'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
@endpush
