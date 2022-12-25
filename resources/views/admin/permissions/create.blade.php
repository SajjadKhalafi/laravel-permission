<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="flex justify-end p-2">
                    <a href="{{ route('admin.permission.index') }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Permission index</a>
                </div>
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.permission.store') }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Role Name </label>
                            <div class="mt-1">
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name')
                                <span class="py-2 px-3 text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <div class="mt-1">
                                <button type="submit" class="py-2 px-3 bg-green-500 hover:bg-green-700 rounded-md">Create</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
