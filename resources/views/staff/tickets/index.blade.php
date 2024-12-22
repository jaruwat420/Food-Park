@extends('staff.layouts.master')

@section('title', 'การแจ้งปัญหา')

@section('css')
<style>

    .description-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #tickets-table .description-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .truncate-text {
        display: inline-block;
        max-width: 100%;
    }

    #tickets-table {
        width: 100% !important;
    }

    #tickets-table td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .dataTables_wrapper {
        overflow-x: auto;
        margin-bottom: 20px;
    }

    #tickets-table .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    @media screen and (max-width: 768px) {
        #tickets-table td {
            max-width: none;
        }

        .dataTables_wrapper {
            margin: 0 -15px;
            padding: 0 15px;
        }
    }

    .attachments-list {
        max-height: 200px;
        overflow-y: auto;
    }

    .attachments-list .list-group-item {
        border-radius: 4px;
        margin-bottom: 5px;
    }

    .attachments-list .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .attachments-list i {
        color: #6c757d;
    }

    .attachments-list a {
        color: #0d6efd;
    }

    .attachments-list a:hover {
        text-decoration: underline !important;
    }

    .status_new {
        animation: blink 1s linear infinite;
    }

    @keyframes blink {
    50% {
        opacity: 0;
    }
}
</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tickets</h1>
    </div>
</section>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], true) !!}
            </div>
        </div>
    </div>
</div>

<!-- Edit Ticket Modal -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="modal fade" id="editTicketModal" tabindex="-1" role="dialog"
                aria-labelledby="editTicketModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTicketModal">แก้ไข Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="editTicketForm">
                                @csrf
                                <input type="hidden" name="ticket_id" id="form_ticket_id">

                                <div class="form-group">
                                    <label for="ticket_number" class="form-label">หมายเลข
                                        Ticket</label>
                                    <input type="text" class="form-control" id="ticket_number" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label>สถานะ</label>
                                    <select class="form-control" name="status_id" id="status_id" required>
                                        <option value="">เลือกสถานะ</option>
                                        <option value="new">ใหม่</option>
                                        <option value="in_progress">กำลังดำเนินการ</option>
                                        <option value="completed">เสร็จสิ้น</option>
                                        <option value="cancelled">ยกเลิก</option>
                                    </select>
                                </div>

                                {{-- <div class="form-group">
                                    <label>ความสำคัญ</label>
                                    <select class="form-control" name="priority" id="priority" required>
                                        <option value="">เลือกระดับความสำคัญ</option>
                                        <option value="low">ต่ำ</option>
                                        <option value="medium">ปานกลาง</option>
                                        <option value="high">สูง</option>
                                    </select>
                                </div> --}}

                                <div class="form-group">
                                    <label>ผู้ดูแล</label>
                                    <select class="form-control" name="assigned_to" id="assigned_to">
                                        <option value="">เลือกผู้ดูแล</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>เพิ่ม Comment</label>
                                    <textarea class="form-control" id="comment_textarea" rows="3" value=""></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal View --}}
            <div class="modal fade" id="viewTicketModal" tabindex="-1" role="dialog"
                aria-labelledby="viewTicketModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewTicketModalLabel">รายละเอียด Tickets</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="viewTicketForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <label for="ticket_number_problem" class="form-label">หมายเลข
                                                    Ticket</label>
                                                <input type="text" class="form-control" id="ticket_number_problem"
                                                    value="" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status_problem" class="form-label">สถานะ</label>
                                                <input type="text" class="form-control" id="status_problem" value=""
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="priority_problem" class="form-label">ความสำคัญ</label>
                                                <input type="text" class="form-control" id="priority_problem" value=""
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="category_problem" class="form-label">ประเภท</label>
                                                <input type="text" class="form-control" id="category_problem" value=""
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="location_problem" class="form-label">สถานที่</label>
                                                <input type="text" class="form-control" id="location_problem" value=""
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="name_problem" class="form-label">ชื่อผู้แจ้ง</label>
                                                <input type="text" class="form-control" id="name_problem" value=""
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="email_problem" class="form-label">อีเมลล์</label>
                                                <input type="text" class="form-control" id="email_problem" value=""
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">ไฟล์แนบ</label>
                                                <div class="attachments-list" id="attachments_container">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="comment_display" class="form-label">Comment</label>
                                                <div class="" id="comment_display">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            // Button Edit
            $(document).on('click', '.edit-btn', function() {
                let ticketId = $(this).data('id');

                $.ajax({
                    url: `tickets/${ticketId}/edit`,
                    method: 'GET',
                    success: function(response) {
                        $('#editTicketForm').attr('action', `/staff/tickets/${ticketId}`);
                        $('#editTicketForm').data('ticket-id', ticketId);
                        $('#form_ticket_id').val(ticketId);
                        $('#ticket_number').val(response.ticket.ticket_id);

                        // เติมข้อมูล staff
                        let staffSelect = $('#assigned_to');
                            staffSelect.empty();
                            staffSelect.append('<option value="">เลือกผู้ดูแล</option>');

                            response.staffs.forEach(function(staff) {
                                let selected = (staff.id === response.ticket.assigned_to) ? 'selected' : '';
                                staffSelect.append(`
                                    <option value="${staff.id}" ${selected}>
                                        ${staff.name}
                                    </option>
                                `);
                        });

                        let statusSelect = $('#status_id');
                        statusSelect.empty();
                        statusSelect.append('<option value="">เลือกสถานะ</option>');

                        let currentStatus = response.status.find(s => s.id === response.ticket.status_id);

                        response.status.forEach(function(status) {
                            let selected = (status.name === currentStatus?.name) ?
                                'selected' : '';
                            statusSelect.append(`
                            <option value="${status.name}" ${selected}>
                                ${status.label}
                            </option>
                        `);
                        });

                        // เติมข้อมูล priority
                        let prioritySelect = $('#priority');
                        prioritySelect.empty();
                        prioritySelect.append('<option value="">เลือกระดับความสำคัญ</option>');

                        response.priorities.forEach(function(priority) {
                            let selected = (priority.value === response.ticket
                                .priority) ? 'selected' : '';
                            prioritySelect.append(`
                            <option value="${priority.value}" ${selected}>
                                ${priority.label}
                            </option>
                        `);
                        });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'ไม่สามารถโหลดข้อมูลได้'
                        });
                    }
                });
            });

            // ฟังก์ชันดึงค่าจาก select
            function getSelectedValues() {
                return {
                    assigned_to: $('#assigned_to').val(),
                    status_id: $('#status_id').val(),
                    priority: $('#priority').val()
                };
            }

            // ฟังก์ชันเช็คค่าที่เปลี่ยนแปลง
            function hasChanges(originalValues, currentValues) {
                return originalValues.assigned_to !== currentValues.assigned_to ||
                    originalValues.status_id !== currentValues.status_id ||
                    originalValues.priority !== currentValues.priority;
            }

            // ฟังก์ชันกำหนดสี priority
            function getPriorityBadgeClass(priority) {
                switch (priority) {
                    case 'low':
                        return 'text-success';
                    case 'medium':
                        return 'text-warning';
                    case 'high':
                        return 'text-danger';
                    default:
                        return '';
                }
            }

            // เพิ่ม event listener สำหรับการเปลี่ยนแปลง priority
            $('#priority').on('change', function() {
                $(this).removeClass('text-success text-warning text-danger')
                    .addClass(getPriorityBadgeClass($(this).val()));
            });
        });

        // Update
        $('#editTicketForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let ticketId = $('#form_ticket_id').val();
            let ticket_comment = $('#comment_textarea').val();

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('_method', 'PUT');
            formData.append('ticket_id', ticketId);
            formData.append('ticket_comment', ticket_comment);

            $.ajax({
                url: "{{ route('staff.tickets.update', '') }}/" + ticketId,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'บันทึกข้อมูลเรียบร้อยแล้ว'
                        }).then(() => {
                            $('#editTicketModal').modal('hide');
                            $('#tickets-table').DataTable().ajax.reload();
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด!',
                        text: xhr.responseJSON?.message ||
                            'ไม่สามารถบันทึกข้อมูลได้'
                    });
                }
            });
        });

        $(document).on('click', '.view-ticket', function() {
    let ticketId = $(this).data('id');

    $.ajax({
        url: `tickets/${ticketId}/view`,
        type: 'GET',
        success: function(response) {
            if(response.success) {
                //console.log(response.ticket.comments);

                // Fill form fields
                $('#ticket_number_problem').val(response.ticket.ticket_id);
                $('#status_problem').val(response.ticket.status.label);
                $('#priority_problem').val(response.ticket.priority);
                $('#category_problem').val(response.ticket.category.name);
                $('#location_problem').val(response.ticket.location.name);
                $('#name_problem').val(response.ticket.user_name);
                $('#email_problem').val(response.ticket.user_email);

                // Handle attachments
                let attachmentsHtml = '';
                if (response.ticket.attachments && response.ticket.attachments.length > 0) {
                    attachmentsHtml = '<div class="list-group">';
                    response.ticket.attachments.forEach(function(attachment) {
                        attachmentsHtml += `
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-paperclip me-2"></i>
                                    <a href="/storage/${attachment.file_path}"
                                        target="_blank"
                                        class="text-decoration-none">
                                        ${attachment.file_name}
                                    </a>
                                </div>
                            </div>
                        `;
                    });
                    attachmentsHtml += '</div>';
                } else {
                    attachmentsHtml = '<p class="text-muted">ไม่มีไฟล์แนบ</p>';
                }
                $('#attachments_container').html(attachmentsHtml);

                // Handle comments
                let commentsHtml = '';
                if (response.ticket.comments && response.ticket.comments.length > 0) {
                    commentsHtml = '<div class="list-group">';
                    response.ticket.comments.forEach(function(comment) {
                        commentsHtml += `
                            <div class="list-group-item">
                                <div class="comment-content">
                                    <p class="mb-1">${comment.content}</p>
                                    <small class="text-muted">
                                        ${comment.created_at} - ${comment.user_name || 'ผู้ใช้งาน'}
                                    </small>
                                </div>
                            </div>
                        `;
                    });
                    commentsHtml += '</div>';
                } else {
                    commentsHtml = '<p class="text-muted">ไม่มีความคิดเห็น</p>';
                }
                $('#comment_display').html(commentsHtml);

                // Show modal
                $('#viewTicketModal').modal('show');
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด!',
                text: 'ไม่สามารถโหลดข้อมูลได้'
            });
        }
    });
});

</script>
@endpush
