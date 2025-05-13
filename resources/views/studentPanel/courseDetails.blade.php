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
             {{-- Card start  --}}
             <style>
                .custom-card {
                    max-width: 400px;
                    width: 100%;
                    border-radius: 1rem;
                    overflow: hidden;
                    box-shadow: 0 0 15px rgba(0, 123, 255, 0.15);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }
            
                .custom-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 0 25px rgba(0, 123, 255, 0.25);
                }
            
                .custom-card img {
                    width: 100%;
                    height: 300px; /* Full image visible */
                    transition: transform 0.3s ease;
                }
            
                .custom-card:hover img {
                    transform: scale(1.01);
                }
            
                .custom-card .btn {
                    transition: all 0.3s ease;
                    font-size: 14px;
                    padding: 8px 14px;
                }
            
                .custom-card .btn-primary:hover {
                    background-color: #0056b3;
                    box-shadow: 0 0 8px #007bff;
                }
            
                .custom-card .btn-outline-secondary:hover {
                    background-color: #6c757d;
                    color: white;
                    box-shadow: 0 0 8px #6c757d;
                }
            </style>
            
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="card custom-card">
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->courseName }}">
            
                            <div class="card-body bg-white p-4">
                                <h5 class="card-title text-primary fw-bold mb-3">{{ $course->courseName }}</h5>
                                <p class="card-text text-muted mb-4">{{ $course->description }}</p>
                                <p class="card-text text-success fw-bold mb-4">Fees: {{ $course->fees }}</p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('confirm') }}" class="btn btn-primary w-50 me-2">Buy Now</a>
                                    <a href="{{ route('stuRegistration.edit', $detail->id) }}" class="btn btn-outline-secondary w-50">Change Course</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
             {{-- end card --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
