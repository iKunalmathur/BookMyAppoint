<!DOCTYPE html>
<html style="scroll-behavior: smooth;">

<head>
    {{-- head --}}
   @include('layouts.head')
</head>

<body style="background-color: #ffffff;">
    {{-- header --}}
    @include('layouts.header')
    {{-- main-content --}}
    @section('main-content')

    @show
    {{-- footer --}}
    @include('layouts.footer')
    {{-- bottom --}}
    @include('layouts.bottom')
</body>

</html>