@extends('frontend.layouts.master')
@section('title', 'ติดตามสถานะการแจ้งปัญหา')

@section('css')
<!-- CSS ที่มีอยู่เดิม -->
<style>
    .ticket-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .ticket-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }

    .status-new {
        background-color: #007bff;
        color: white;
    }

    .status-in-progress {
        background-color: #ffc107;
        color: black;
    }

    .status-completed {
        background-color: #28a745;
        color: white;
    }

    .status-cancelled {
        background-color: #dc3545;
        color: white;
    }

    .status-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
        color: white;
        display: inline-block;
    }

    /* สีสำหรับแต่ละสถานะ */
    .status-new {
        box-shadow: 0 2px 5px rgba(13, 110, 253, 0.2);
    }

    .status-in-progress {
        box-shadow: 0 2px 5px rgba(255, 193, 7, 0.2);
    }

    .status-completed {
        box-shadow: 0 2px 5px rgba(40, 167, 69, 0.2);
    }

    .status-cancelled {
        box-shadow: 0 2px 5px rgba(220, 53, 69, 0.2);
    }

</style>
@endsection

@section('content')
<section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
    <div class="fp__breadcrumb_overlay">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>ติดตามการแจ้งปัญหาเทคโนโลยีสารสนเทศ</h1>
                <ul>
                    <li><a href="{{ route('ticket.index') }}">แจ้งปัญหา</a></li>
                    <li><a href="#">ติดตามการแจ้งปัญหา</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="container ">
    <div class="card shadow-sm p-4 mt-4 mb-3">
        <h4 class="text-center mb-4">ติดตามสถานะการแจ้งปัญหา</h4>
        <div id="ticketStatusContainer" class="mt-4">
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">กำลังโหลด...</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Load function
        ajax_load_data();



    });
    $('.ticket-car').click(function (e) {
            alert(123123131);

        });
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'new':
                return 'status-new';
            case 'in_progress':
                return 'status-in-progress';
            case 'completed':
                return 'status-completed';
            case 'cancelled':
                return 'status-cancelled';
            default:
                return 'status-new';
        }
    }

    function getStatusName(status) {
        switch (status) {
            case 'primary':
                return 'status-new bg-primary';
            case 'warning':
                return 'status-in-progress bg-warning';
            case 'success':
                return 'status-completed bg-success';
            case 'danger':
                return 'status-cancelled bg-danger';
            default:
                return 'status-new bg-primary';
        }
    }

    function formatDate(dateString) {
        const options = {
            year: 'numeric'
            , month: 'long'
            , day: 'numeric'
            , hour: '2-digit'
            , minute: '2-digit'
        };
        return new Date(dateString).toLocaleDateString('th-TH', options);
    }

    // แก้ไข JavaScript ในส่วนแสดงข้อมูล
    function ajax_load_data() {
        $.ajax({
            url: "{{ route('tickets.user') }}"
            , type: 'GET'
            , success: function(response) {
                let container = $('#ticketStatusContainer');
                container.empty();

                if (response.length > 0) {
                    //console.log(response)
                    response.forEach(function(ticket) {
                        container.append(`<div class="ticket-card">
                        <div class="row">
                            <div class="col-md-10">
                                <h5 class="mb-2">
                                    <span class="ticket-id">${ticket.ticket_id}</span> -
                                    ${ticket.category.name}
                                </h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-calendar-alt mx-2"></i> ${formatDate(ticket.created_at)}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-user mx-2"></i> ${ticket.user_name}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-envelope-square mx-2"></i> ${ticket.user_email}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-building mx-2"></i> ${ticket.location.name}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-sitemap mx-2"></i> ${ticket.department.name}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-folder mx-2"></i> ${ticket.category.name}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-eye mx-2"></i> ${ticket.description}
                                </p>
                            </div>
                            <div class="col-md-2 text-md-center">
                                <span class="status-badge ${getStatusName(ticket.status.color)}">
                                    ${ticket.status.label}
                                </span>
                                </br>
                                <a href="/tickets/${ticket.id}/detail" class="btn btn-warning btn-sm mt-2">
                                    <i class="fas fa-eye "></i> ดูรายละเอียด
                                </a>
                            </div>
                        </div>
                    </div>
                `);
                    });
                } else {
                    container.append(`
                <div class="text-center">
                    <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                    <h5>ไม่พบข้อมูลการแจ้งปัญหา</h5>
                    <p>คุณยังไม่มีการแจ้งปัญหาในระบบ</p>
                </div>
            `);
                }
            }
            , error: function() {
                $('#ticketStatusContainer').html(`
            <div class="text-center text-danger">
                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                <h5>เกิดข้อผิดพลาด</h5>
                <p>ไม่สามารถดึงข้อมูลได้ กรุณาลองใหม่อีกครั้ง</p>
            </div>
        `);
            }
        });
    }
</script>
@endpush
