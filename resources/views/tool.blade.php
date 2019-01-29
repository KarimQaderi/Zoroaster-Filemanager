@extends('Zoroaster::layout')

@section('content')

    <h1 class="resourceName">مدیریت فایل</h1>

    @include('Zoroaster-filemanager::Filemanager')

    <script>
        filemanger('/');
    </script>

@endsection