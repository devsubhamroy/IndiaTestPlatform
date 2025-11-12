
@include('student.layouts.sidebar')
@include('student.layouts.navbar')

@section('content')
    <div class="content-wrapper">
        @yield('main-content')
    </div>
@endsection

@include('student.layouts.footer')
