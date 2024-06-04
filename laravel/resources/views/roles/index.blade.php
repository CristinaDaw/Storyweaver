@foreach($roles as $role)
    <div class="bg-purple-100 p-6 rounded-lg pb-8 shadow-lg pt-8 mb-4 mt-0">
        <h1 class="text-xl font-semibold mb-4 ml-4">Role #{{ $loop->iteration }}</h1>

        <p class="text-gray-600 ml-8">ID: {{ $role->id }}</p>
        <p class="text-gray-600 ml-8">Name: {{ $role->name }}</p>
    </div>
@endforeach

