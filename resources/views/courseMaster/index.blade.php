<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                {{ __('Add Course') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-center mb-6 text-3xl font-bold text-gray-700">Course List</h3>

                    {{-- Responsive Table --}}
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300 shadow-md rounded-lg bg-white">
                            <thead class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-dark text-md uppercase tracking-wide">
                                <tr>
                                    <th class="px-4 py-3 text-center">Course Name</th>
                                    <th class="px-4 py-3 text-center">Thumbnail</th>
                                    <th class="px-4 py-3 text-center">Description</th>
                                    <th class="px-4 py-3 text-center">Fees</th>
                                    <th class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center text-gray-700">
                                @foreach($courses as $course)
                                    <tr class="hover:bg-gray-100 transition-colors duration-300">
                                        <td class="px-4 py-3 font-semibold">{{ $course->courseName }}</td>

                                        <td class="px-4 py-3">
                                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->courseName }}"
                                                class="w-20 h-20 object-cover rounded-md border border-gray-300 mx-auto">
                                        </td>

                                        <td class="px-4 py-3 max-w-xs break-words">{{ $course->description }}</td>

                                        <td class="px-4 py-3 text-green-600 font-bold">₹{{ number_format($course->fees) }}</td>

                                        <td class="px-4 py-3 space-x-2">
                                            <a href="{{ route('courses.edit', $course->id) }}"
                                               class="inline-block px-4 py-2 bg-blue-500 text-secondary rounded hover:bg-blue-600 transition transform hover:scale-105">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-500 text-danger rounded hover:bg-red-600 transition transform hover:scale-105">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
