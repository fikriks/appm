<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}">
</script>

<script src="{{ asset('assets/js/scripts.js') }}"></script>
@include('sweetalert::alert')

<!-- SweetAlert Confirm Delete -->
<script>
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Jika data dihapus maka data yang bersangkutan akan ikut terhapus juga.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let action = $(this).attr('data-action');
                let token = jQuery('meta[name="csrf-token"]').attr('content');
                $('body').html("<form class='form-inline remove-form' method='post' action='" +
                    action + "'></form>");
                $('body').find('.remove-form').append(
                    '<input name="_method" type="hidden" value="delete">');
                $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' +
                    token + '">');
                $('body').find('.remove-form').submit();
            }
        });
    });
</script>
@stack('scripts')
