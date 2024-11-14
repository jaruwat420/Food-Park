@extends('frontend.layouts.master')

@section('title', 'Chaixi Corporation')
@section('css')
<style>
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
                    <div class="col-md-4">
                        <div class="problem-card">
                            <input type="radio" id="computer" name="inputProblem" value="1" class="btn-check" required>
                            <label class="btn btn-outline-success w-100 h-100 p-3" for="computer">
                                <i class="fas fa-laptop fs-4 mb-2"></i>
                                <div>ด้านคอมพิวเตอร์และเครือข่าย</div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="problem-card">
                            <input type="radio" id="it" name="inputProblem" value="4" class="btn-check" required>
                            <label class="btn btn-outline-primary w-100 h-100 p-3" for="it">
                                <i class="fas fa-server fs-4 mb-2"></i>
                                <div>ด้านระบบสารสนเทศ</div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="problem-card">
                            <input type="radio" id="phone" name="inputProblem" value="3" class="btn-check" required>
                            <label class="btn btn-outline-warning w-100 h-100 p-3" for="phone">
                                <i class="fas fa-phone fs-4 mb-2"></i>
                                <div>ด้านระบบสื่อสารและอาคารสถานที่</div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="invalid-feedback">กรุณาเลือกประเภทปัญหา</div>
            </div>

            <!-- ส่วนเลือกหัวข้อปัญหา -->
            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="inputSubjectID">
                    หัวข้อปัญหา<span class="text-danger">*</span>
                </label>
                <select class="form-select" id="inputSubjectID" name="inputSubjectID" required>
                    <option value="">กรุณาเลือกหัวข้อปัญหา</option>
                    <option value="1">เครื่องคอมพิวเตอร์ไม่ทำงาน</option>
                    <option value="2">อินเตอร์เน็ตมีปัญหา</option>
                    <option value="3">ติดตั้งโปรแกรม</option>
                    <option value="4">ระบบใช้งานไม่ได้</option>
                    <option value="5">อื่นๆ</option>
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
                    <input type="text" class="form-control" id="userName" value="{{ $user->name ?? '' }}" readonly>
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
                    <input type="email" class="form-control" id="userEmail" value="{{ $user->email ?? '' }}" readonly>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="inputSubjectLocation">
                    สถานที่<span class="text-danger">*</span>
                </label>
                <select class="form-select" id="inputSubjectLocation" name="inputSubjectLocation" required>
                    <option value="">กรุณาเลือกสถานที่</option>
                    <option value="1">สำนักงานใหญ่</option>
                    <option value="2">โรงงานคลองหก</option>
                    <option value="3">สำนักงานพระรามเก้า</option>
                    <option value="4">ร้านอาหารในเครือ</option>
                    <option value="5">อื่นๆ</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label class="form-label fw-bold" for="inputSubjectDepartment">
                    แผนก<span class="text-danger">*</span>
                </label>
                <select class="form-select" id="inputSubjectDepartment" name="inputSubjectDepartment" required>
                    <option value="">กรุณาเลือกแผนก</option>
                    <option value="1">ฝ่ายการตลาด</option>
                    <option value="2">ฝ่ายบัญชี</option>
                    <option value="3">ฝ่ายไอที</option>
                    <option value="4">ฝ่ายขาย</option>
                    <option value="4">ฝ่ายบุคคล</option>
                    <option value="4">ฝ่ายพัฒนาธุรกิจ</option>
                    <option value="5">อื่นๆ</option>
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
<script>
   $(document).ready(function() {
    $('#problemForm').on('submit', function(event) {
        event.preventDefault();

        if (this.checkValidity()) {
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('tickets.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
