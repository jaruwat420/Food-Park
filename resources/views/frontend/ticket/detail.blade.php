@extends('frontend.layouts.master')
@section('css')

<style>
    .status-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
        color: white;
    }

    .primary {
        background-color: #007bff;
    }

    .warning {
        background-color: #ffc107;
        color: #000;
    }

    .success {
        background-color: #28a745;
    }

    .danger {
        background-color: #dc3545;
    }

    .comment-item {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 10px;
        background: #fff;
    }

    .comment-header {
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }
</style>
@endsection
@section('content')
<section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
    <div class="fp__breadcrumb_overlay">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>รายละเอียดปัญหา</h1>
                <ul>
                    <li><a href="{{ route('ticket.index') }}">ติดตามการแจ้งปัญหา</a></li>
                    <li><a href="#">รายละเอียดปัญหา</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="card shadow-sm p-4 mt-2">
        <h4 class="text-center mb-4">รายละเอียด Ticket</h4>

        <div class="ticket-info">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>หมายเลข Ticket:</strong> {{ $ticket->ticket_id }}</p>
                    <p>
                        <strong>สถานะ:</strong>
                        <span class="status-badge {{ $ticket->status->color }}">
                            {{ $ticket->status->label }}
                        </span>
                    </p>
                    <p><strong>ผู้แจ้ง:</strong> {{ $ticket->user_name }}</p>
                    <p><strong>อีเมล:</strong> {{ $ticket->user_email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>แผนก:</strong> {{ $ticket->department->name }}</p>
                    <p><strong>สถานที่:</strong> {{ $ticket->location->name }}</p>
                    <p><strong>ความสำคัญ:</strong> {{ $ticket->priority }}</p>
                    <p><strong>วันที่แจ้ง:</strong> {{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="description mt-4">
                <h5>รายละเอียดปัญหา</h5>
                <div class="p-3 bg-light rounded">
                    {{ $ticket->description }}
                </div>
            </div>

            <div class="comments-section mt-4">
                <h5 class="mb-2">ความคิดเห็น</h5>
                <div id="commentsList" class="mb-3">
                    @foreach($ticket->comments as $comment)
                    <div class="comment-item mb-3">
                        <div class="comment-header">
                            <strong>{{ $comment->user->name ?? 'ผู้ใช้' }}</strong>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="comment-content p-2">
                            {{ $comment->content }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- ฟอร์มเพิ่มความคิดเห็น -->
                <form id="commentForm">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="3" placeholder="เพิ่มความคิดเห็น..."></textarea>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary "><i class="fa fa-paper-plane" aria-hidden="true"></i>
                            ส่งความคิดเห็น
                        </button>
                        <a href="{{ route('ticket.index') }}" class="btn btn-warning text-white"><i class="fa fa-undo" aria-hidden="true"></i>
                            ย้อนกลับ
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#commentForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('ticket_id', '{{ $ticket->id }}');

            $.ajax({
                url: "{{ route('tickets.comment.store') }}"
                , type: 'POST'
                , data: formData
                , processData: false
                , contentType: false
                , success: function(response) {
                    if (response.success) {
                        // รีเซ็ตฟอร์ม
                        $('#commentForm')[0].reset();

                        // เพิ่มความคิดเห็นใหม่ลงในรายการ
                        let newComment = `
                        <div class="comment-item mb-3 ">
                            <div class="comment-header ">
                                <strong>${response.comment.user_name}</strong>
                                <small class="text-muted">${response.comment.created_at}</small>
                            </div>
                            <div class="comment-content p-2">
                                ${response.comment.content}
                            </div>
                        </div>
                    `;
                        // $('#commentsList').prepend(newComment);
                        // relaod
                        window.location.reload();
                        // แสดงข้อความสำเร็จ
                        Swal.fire({
                            icon: 'success'
                            , title: 'สำเร็จ!'
                            , text: 'เพิ่มความคิดเห็นเรียบร้อยแล้ว'
                        });
                    }
                }
                , error: function(xhr) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'เกิดข้อผิดพลาด!'
                        , text: 'ไม่สามารถเพิ่มความคิดเห็นได้'
                    });
                }
            });
        });
    });

</script>
@endpush
