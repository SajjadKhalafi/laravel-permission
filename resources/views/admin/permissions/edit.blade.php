<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="flex justify-end p-2">
                    <a href="{{ route('admin.permission.index') }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Permission index</a>
                </div>
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.permission.update' , $permission->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Permission Name </label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ $permission->name }}"
                                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name')
                                <span class="py-2 px-3 text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <div class="mt-1">
                                <button type="submit" class="py-2 px-3 bg-green-500 hover:bg-green-700 rounded-md">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-6 p-2 bg-slate-100">
                    <h2 class="text-2xl font-semibold">Roles</h2>
                    <div class="flex space-x-2 mt-4 p-2">
                        @if($permission->roles)
                            @foreach($permission->roles as $permission_role)
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST" action="{{ route('admin.permissions.roles.remove', [$permission->id , $permission_role->id]) }}" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{ $permission_role->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="max-w-xl mt-6">
                        <form action="{{ route('admin.permissions.roles' , $permission->id) }}" method="POST">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="role"
                                       class="block text-sm font-medium text-gray-700">Permission</label>
                                <select id="role" name="role" autocomplete="role-name"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                            <span class="py-2 px-3 text-red-500">{{ $message }}</span>
                            @enderror
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                        class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
