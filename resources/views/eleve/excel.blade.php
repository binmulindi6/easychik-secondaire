@extends('layouts.admin')

@section('content')

    <div class="flex flex-col gap-2  justify-center items-center w-full p-5 bg-white rounded-xl">
        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        <form action="{{route('import.excel.post')}}" method="post" enctype="multipart/form-data">
            @csrf
    
            <x-input type="file" name="excel_file"></x-input>
            <x-button>Post</x-button>
        </form>
    </div>

@endsection