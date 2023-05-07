<!-- BEGIN: Processing Scripts -->
<script src="{{ asset('dist/scripts/selectOptionModifier.js') }}"></script>
<script src="{{ asset('dist/scripts/storeDataToSession.js') }}"></script>   
<script src="{{ asset('dist/scripts/processActivity.js') }}"></script>     

@yield('getMainValue')

<script>
    storeDataToSession();
</script>
<!-- END: Processing Scripts -->