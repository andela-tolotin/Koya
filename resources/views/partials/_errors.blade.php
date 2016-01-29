<script type="text/javascript">
    @if(Session::has('error'))
        swal({
        title:"{{Session::get('error')}}",
        type:'error'
        });
    @endif

    @if(Session::has('success'))
        swal({
        title: "{{Session::get('success')}}",
        type:'success'
        });
    @endif
</script>