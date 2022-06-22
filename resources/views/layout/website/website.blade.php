<!DOCTYPE html>
<html lang="en">
{{-- head --}}
@include('layout.website.include.head')
@php
$prefix = Request::route()->getPrefix();
@endphp

<body>

    <!-- ======= Header ======= -->
    @include('layout.website.include.header')
    
    @if($prefix!='/account')
    @include('layout.website.include.navbar')
    @endif
    <!-- End Header -->


    <main>

        @yield('content')

        @include('layout.website.include.footer')


    </main>

    {{-- script --}}
    @include('layout.website.include.script')



    @yield('scripts')

</body>

</html>