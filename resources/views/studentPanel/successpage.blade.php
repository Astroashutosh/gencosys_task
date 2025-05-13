<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-8 text-center">
                
                <!-- Optional flash message -->
                @if(session('success'))
                    <div class="alert alert-success text-green-600 font-bold mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Thank You Message -->
                <h1 class="text-2xl font-semibold text-green-700 mb-3">🎉 Thank You for Registering!</h1>
                <p class="text-gray-700 mb-6">
                    Your enrollment has been successfully submitted. You will receive a confirmation email shortly with all the course details.
                    We’re excited to have you on board!
                </p>

                <!-- Image -->
                <img src="https://www.icegif.com/wp-content/uploads/2023/08/icegif-727.gif" alt="Enrollment Success" class="mx-auto w-60 md:w-80">

                <!-- Optional navigation or action -->
                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

