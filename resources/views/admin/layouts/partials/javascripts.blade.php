<!-- General JS Scripts -->
<script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
<script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/stisla.js') }}"></script>

{{-- Toastr --}}
<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
{{-- Preview Img --}}
<script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
{{-- Sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- DataTable --}}
<script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
<!-- Template JS File -->
<script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom.js') }}"></script>

<script>
    toastr.options.progressBar = true;

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
    @endif
</script>
<script>
    $.uploadPreview({
    input_field: "#image-upload",   // Default: .image-upload
    preview_box: "#image-preview",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false,                // Default: false
    success_callback: null          // Default: null
    });

    // Set csrf
    //     $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // console.log($.ajaxSetup().headers);

    $(document).ready(function () {
        $('body').on('click', '.delete-item',  function(e){
            e.preventDefault()
            let url = $(this).attr('href')

            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                // ajax
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {_token: "{{ csrf_token() }}"},
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success(response.message)

                            // reload DataTable
                            // $('#slider-table').DataTable().draw();
                            window.location.reload();

                        }else if (response.status === 'error'){
                            toastr.error(response.message)
                        }
                    }
                });
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
                });
            }
        });
        })
    })


</script>
@stack('scripts')
