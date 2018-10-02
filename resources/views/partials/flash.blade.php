@if(session()->has('flash_message'))

    <script type="application/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            window.Swal({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                type: "{{ session('flash_message.level') }}",
                title: "{{ session('flash_message.title' )}}",
                text: "{{ session('flash_message.message' )}}",
                showCloseButton: true,

            })

        })


    </script>


@endif


@if(session()->has('flash_message_overlay'))

    <script type="application/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            window.Swal({
                title: "{{ session('flash_message_overlay.title' )}}",
                type: "{{ session('flash_message_overlay.level')}}",
                text: "{{ session('flash_message_overlay.message' )}}",
                confirmButtonText:"{{ session('flash_message_overlay.btnText' )}}",
            })

        })

    </script>

@endif



