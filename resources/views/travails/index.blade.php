@extends('layouts.admin')
@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        @if (isset($search))
            <x-nav-travails :search="$search" :pagename="$page_name"></x-nav-travails>
        @else
            <x-nav-travails :pagename="$page_name"></x-nav-travails>
        @endif
    </div>
@endsection
