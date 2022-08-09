<!DOCTYPE html>
<html lang="en">
{{-- head --}}

@include('layout.website.include.head')


<body>

    <!-- ======= Header ======= -->
    @include('layout.website.include.header')
    
   
    @include('layout.website.include.navbar')
    
    <!-- End Header -->


    <main>

        @yield('content')
        
    </main>
    @include('layout.website.include.footer')


    {{-- script --}}
    @include('layout.website.include.script')


    
    @yield('scripts')

</body>

</html>