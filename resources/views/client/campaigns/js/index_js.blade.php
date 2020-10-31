<script>
    function redirector(page = 0, perpage = 0) {
        var queryString = $( "#search_form" ).find(':not(input[name=_token])').serialize();
        var url = "{{route('campaigns.index')}}" + '?' + queryString;
        console.log("{{route('campaigns.index')}}" + '?' + queryString);
        if(page != 0) {
            url += '&page=' + page;
        }

        if(perpage != 0) {
            url += '&perpage=' + perpage;
        }
        window.location = url;
    };

    jQuery(document).ready(function () {
        $("#search_platform").selectpicker()

        $('#search_form').on('submit' ,function(e) {
            e.preventDefault();
            var urlParams = new URLSearchParams(window.location.search);
            var page = urlParams.get('page');
            var perpage = urlParams.get('perpage');
            redirector(page || 0, perpage || 0);        
        });     
    }); 
</script>