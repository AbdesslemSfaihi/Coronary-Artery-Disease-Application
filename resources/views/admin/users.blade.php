@extends('layouts.app') {{-- Or your layout file --}}

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-800">Users</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add User
        </a>
    </div>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 border">ID</th>
                <th class="py-2 border">Name</th>
                <th class="py-2 border">Email</th>
                <th class="py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="py-2 border px-4">{{ $user->id }}</td>
                <td class="py-2 border px-4">{{ $user->name }}</td>
                <td class="py-2 border px-4">{{ $user->email }}</td>
                <td class="py-2 border px-4">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection