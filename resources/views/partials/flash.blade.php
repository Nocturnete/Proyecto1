@if ($message = Session::get('success'))
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-emerald-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <b class="capitalize">CORRECTO:</b>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{ $message }}</b>
        </span>
    </div>
@endif 

@if ($message = Session::get('error'))
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <b class="capitalize">ERROR:</b>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{ $message }}</b> 
        </span>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-orange-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <b class="Capitalize">¡CUIDADO!</b>
        </span>    
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{ $message }}</b>
        </span>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-indigo-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <b class="Capitalize">INFO:</b>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">{{ $message }}</b>
        </span>
    </div>
@endif

@if ($errors->any())
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-purple-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <b class="Capitalize">CUALQUIER:</b>
        </span>
        @foreach ($errors->all() as $error)
            <span class="inline-block align-middle mr-8">
                <b class="capitalize">{{ $message }}</b>
            </span>
        @endforeach
    </div>
@endif
