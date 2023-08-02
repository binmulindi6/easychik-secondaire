@if (isset($back))
<a href="" onclick="javascript:history.go(-1)" class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
    <i class="fa fa-solid fa-arrow-left"></i>
</a>
    
@else
<a href="{{ $link }}" class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
    <i class="fa fa-solid fa-arrow-left"></i>
</a>
@endif
