<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    {{-- table start --}}
                    <table class="table" id="myTable">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Course</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($registrations as $registration)
                          <tr>
                              <td>{{ $registration->firstName }} {{ $registration->lastName }}</td>
                              <td>{{ $registration->email }}</td>
                              <td>{{ $registration->mobile ?? 'N/A' }}</td>
                              <td>{{ $registration->courses?->courseName ?? 'N/A' }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                  
                    {{-- end table --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
