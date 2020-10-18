
<!-- REQUIRED JS SCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type='text/javascript'></script>

<!-- BOOTSTRAP 3.3.2 JS -->
<script src="{{ asset('admin/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- ADMINLTE APP -->
<script src="{{ asset('admin/js/app.min.js') }}" type="text/javascript"></script>

<!-- DATATABLES -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('#dataTable').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "scrollX": true
        });
    });
</script>

<!-- PASSWORD CONFIRMATION VALIDATION -->
<script>
    function passConfirming() {
        var pass1 = document.getElementById("pass1").value;
        var pass2 = document.getElementById("pass2").value;
        if (pass1 != pass2) {
            document.getElementById("pass1").style.borderColor = "red";
            document.getElementById("pass2").style.borderColor = "red";
        }
        else {
            document.getElementById("pass1").style.borderColor = "green";
            document.getElementById("pass2").style.borderColor = "green";
        }
    }
</script>

<!-- PACE-->
<script type="text/javascript" src="{{asset('/plugins/pace/pace.js')}}"></script>
<script>
  $(document).ajaxStart(function() { Pace.restart(); });
</script>

@yield('page-script')
