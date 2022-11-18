<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('form').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            width: 100,
            backdrop: '#4e4e4e7d',
            allowOutsideClick: false,
        })
        Swal.showLoading();
        this.closest('form').submit();
    })
</script>
