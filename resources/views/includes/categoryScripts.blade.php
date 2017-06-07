<!-- Categories Scripts -->
<link rel="stylesheet" href="{{ url('css/jquery-ui.css') }}">
<script src="{{ url('js/jquery-ui.js') }}"></script>
<script>
    $( function() {
        $( "#accordion" ).accordion({
            collapsible: true,
            active: false,
            heightStyle: "content"
        });
        $( "#button-ui" ).click(function(event){
            event.stopPropagation(); // this is
            event.preventDefault(); // the magic
            log("clicked!");
        });
    } );
</script>