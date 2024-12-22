@extends('frontend.layouts.master')

@section('title', 'แจ้งปัญหาเทคโนโลยีสารสนเทศ')
@section('css')
<style>
    .dropzone {
        border: 2px dashed #dee2e6;
        border-radius: 5px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dropzone:hover,
    .dropzone.dz-drag-hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .dropzone .dz-message {
        margin: 0;
    }

    .dropzone .dz-preview {
        margin: 10px;
    }

    .dz-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-preview {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .file-preview .file-info {
        display: flex;
        align-items: center;
    }

    .file-preview .file-icon {
        margin-right: 10px;
        font-size: 24px;
    }

    .file-preview .file-name {
        margin: 0;
    }

    .file-preview .file-size {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .file-preview .remove-file {
        color: #dc3545;
        cursor: pointer;
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::before {
        background-color: #007bff;
        border-color: #007bff;
    }

    .problem-card {
        height: 100%;
        transition: all 0.3s ease;
    }

    .problem-card label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 8px;
        transition: all 0.3s ease;
        height: 150px;
    }

    .problem-card label:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-check:checked+label {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    textarea.form-control {
        resize: none;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
        border-color: #86b7fe;
    }

    .card {
        border-radius: 15px;
    }

    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    input[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }

    /* เพิ่ม hover effect สำหรับ input group */
    .input-group:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* สไตล์สำหรับ icon ใน input group */
    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }

    .input-group .form-control {
        border-left: none;
    }

    /* เพิ่ม transition effect */
    .input-group,
    .input-group-text,
    .form-control {
        transition: all 0.3s ease;
    }

    .btn-outline-success-custom {
        background-color: white;
        border-color: #00BBA6;
    }

    /* Custom hover effect */
    .btn-outline-success-custom:hover {
        background-color: red;
        color: white;
    }

    /* Custom hover for icon */
    .btn-outline-success-custom:hover i {
        color: orange;
    }

    /* Or target specific class */
    .problem-card .btn-outline-success-custom:hover {
        background-color: #00BBA6;
        color: white;
    }

    .btn-outline-danger-custom {
        background-color: white;
        border-color: #F10DBA;
    }

    /* Custom hover effect */
    .btn-outline-danger-custom:hover {
        background-color: red;
        color: white;
    }

    /* Custom hover for icon */
    .btn-outline-danger-custom:hover i {
        color: orange;
    }

    /* Or target specific class */
    .problem-card .btn-outline-danger-custom:hover {
        background-color: #F10DBA;
        color: white;
    }

    .btn-outline-warning-custom {
        background-color: white;
        border-color: #edd63a;
    }

    /* Custom hover effect */
    .btn-outline-warning-custom:hover {
        background-color: red;
        color: white;
    }

    /* Custom hover for icon */
    .btn-outline-warning-custom:hover i {
        color: orange;
    }

    /* Or target specific class */
    .problem-card .btn-outline-warning-custom:hover {
        background-color: #edd63a;
        color: white;
    }

        .btn-check:checked + .btn-outline-success-custom {
            background-color: #00BBA6;
            color: white;
        }

        /* Danger Custom */
        .btn-check:checked + .btn-outline-danger-custom {
            background-color: #F10DBA;
            color: white;
        }

        /* Warning Custom */
        .btn-check:checked + .btn-outline-warning-custom {
            background-color: #edd63a;
            color: white;
        }
</style>

@endsection

@section('content')
<section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
    <div class="fp__breadcrumb_overlay">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>ระบบรับแจ้งปัญหาเทคโนโลยีสารสนเทศ</h1>
                <ul>
                    <li><a href="{{ route('home') }}">หน้าแรก</a></li>
                    <li><a href="#">แจ้งปัญหา</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="card shadow-sm p-4 mt-4">
        <h4 class="text-center mb-4">แจ้งปัญหาการใช้งาน</h4>
        <form id="problemForm" class="needs-validation" method="POST" action="{{ route('ticket.store') }}" novalidate>
            @csrf
            <!-- ส่วนเลือกประเภทปัญหา -->
            <div class="form-group mb-4">
                <label class="form-label fw-bold">ประเภทปัญหา<span class="text-danger">*</span></label>
                <div class="row g-3">
                    @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="problem-card">
                            <input type="radio" id="category_{{ $category->id }}" name="inputProblem"
                                value="{{ $category->id }}" class="btn-check" required>
                            <label class="btn btn-outline-{{ $category->color ?? 'primary' }}  p-3"
                                for="category_{{ $category->id }}">
                                <i class="fas fa-{{ $category->icon ?? 'laptop' }} fa-5x fs-4 mb-2 "></i>
                                <div>{{ $category->name }}</div>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- ส่วนเลือกหัวข้อปัญหา -->
            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="subject_id">
                    หัวข้อปัญหา<span class="text-danger">*</span>
                </label>
                <select class="form-select" id="subject_id" name="subject_id" required>
                    <option value="">กรุณาเลือกหัวข้อปัญหา</option>
                    @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="userName">
                    ผู้แจ้ง<span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" class="form-control" name="userName" id="userName"
                        value="{{ Auth::user()->name }}" readonly required>
                    <div class="invalid-feedback">กรุณาระบุชื่อผู้แจ้ง</div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="userEmail">
                    อีเมล<span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" class="form-control" name="userEmail" id="userEmail"
                        value="{{ Auth::user()->email }}" readonly required>
                    <div class="invalid-feedback">กรุณาระบุอีเมลให้ถูกต้อง</div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="location_id" class="form-label fw-bold">
                    สถานที่<span class="text-danger">*</span>
                </label>
                <select class="form-select" id="location_id" name="location_id" required>
                    <option value="">กรุณาเลือกสถานที่</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="department_id" class="form-label fw-bold">
                    แผนก<span class="text-danger">*</span>
                </label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">กรุณาเลือกแผนก</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- ส่วนรายละเอียดปัญหา -->
            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="inputDetail">
                    รายละเอียดปัญหา<span class="text-danger">*</span>
                    <small class="text-muted">(โปรดระบุปัญหาให้ชัดเจน)</small>
                </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                    <textarea class="form-control" id="inputDetail" name="inputDetail" rows="5"
                        placeholder="กรุณาระบุรายละเอียดปัญหา..." required></textarea>
                    <div class="invalid-feedback">กรุณาระบุรายละเอียดปัญหา</div>
                </div>
            </div>
            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="inputFile">
                    แนบไฟล์
                    <small class="text-muted">(หากมีไฟล์ประกอบโปรดแนบ)</small>
                </label>
                <div class="dropzone" id="fileUpload">
                    <div class="dz-message needsclick">
                        <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                        <h4>ลากไฟล์มาวางที่นี่หรือคลิกเพื่อเลือกไฟล์</h4>
                        <p class="text-muted">
                            (รองรับไฟล์ .jpg, .png, .pdf ขนาดไม่เกิน 5MB)
                        </p>
                    </div>
                </div>
                <div id="preview" class="mt-3"></div>
            </div>

            <!-- ปุ่มส่งข้อมูล -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5 py-2">
                    <i class="fas fa-paper-plane me-2"></i>ส่งข้อมูล
                </button>
                <button type="submit" class="btn btn-danger px-5 py-2 g-3">
                    ยกเลิก
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


    Dropzone.autoDiscover = false;

    $(document).ready(function() {
        const myDropzone = new Dropzone("#fileUpload", {
            url: "{{ route('upload.temp') }}",
            paramName: "file",
            maxFilesize: 5,
            maxFiles: 5,
            acceptedFiles: ".jpg,.jpeg,.png,.pdf",
            addRemoveLinks: true,
            dictDefaultMessage: "ลากไฟล์มาวางที่นี่หรือคลิกเพื่อเลือกไฟล์",
            dictRemoveFile: "ลบไฟล์",
            dictFileTooBig: "ไฟล์มีขนาดใหญ่เกินไป ขนาดสูงสุด: 5MB",
            dictInvalidFileType: "ไม่รองรับไฟล์ประเภทนี้",
            dictMaxFilesExceeded: "ไม่สามารถอัพโหลดไฟล์เพิ่มได้ (สูงสุด: 5 ไฟล์)",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function() {
                // เมื่ออัพโหลดสำเร็จ
                this.on("success", function(file, response) {
                    if(response.success) {
                        $('#problemForm').append(`
                            <input type="hidden" name="files[]" value="${response.path}">
                        `);
                    }
                });

                // เมื่อลบไฟล์
                this.on("removedfile", function(file) {
                    if (file.upload && file.upload.filename) {
                        $(`input[value="${file.upload.filename}"]`).remove();

                        $.ajax({
                            url: "{{ route('upload.remove') }}",
                            type: 'POST',
                            data: {
                                filename: file.upload.filename,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    }
                });

                this.on("error", function(file, errorMessage) {
                    if (typeof errorMessage === "string") {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: errorMessage,
                            confirmButtonText: 'ตกลง'
                        });
                        this.removeFile(file);
                    }
                });

                // เมื่อเพิ่มไฟล์
                this.on("addedfile", function(file) {
                    // ตรวจสอบขนาดไฟล์
                    if (file.size > (5 * 1024 * 1024)) {
                        this.removeFile(file);
                        Swal.fire({
                            icon: 'error',
                            title: 'ไฟล์มีขนาดใหญ่เกินไป',
                            text: 'กรุณาอัพโหลดไฟล์ขนาดไม่เกิน 5MB',
                            confirmButtonText: 'ตกลง'
                        });
                    }
                });
            }
        });

        // การส่งฟอร์ม
        $('#problemForm').on('submit', function(e) {
            e.preventDefault();

            if (this.checkValidity()) {
                let formData = new FormData(this);

                let email = $('#userEmail').val();
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'รูปแบบอีเมลไม่ถูกต้อง',
                        text: 'กรุณาตรวจสอบอีเมลอีกครั้ง',
                        confirmButtonText: 'ตกลง'
                    });
                    return;
                }

                let files = myDropzone.getAcceptedFiles();
                files.forEach(function(file, index) {
                    formData.append(`files[${index}]`, file);
                });

                Swal.fire({
                    title: 'กำลังบันทึกข้อมูล...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                                showConfirmButton: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect_url;
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: xhr.responseJSON.message || 'กรุณาลองใหม่อีกครั้ง',
                            confirmButtonText: 'ตกลง'
                        });
                    }
                });
            } else {
                $(this).addClass('was-validated');
            }
        });
    });
</script>
@endpush
