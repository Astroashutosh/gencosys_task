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
                   
{{-- Form start --}}
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
            <div class="form-container">

                {{-- ✅ Success Message --}}
              
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            

                {{-- ✅ Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h3 class="title">Add Course</h3>

                <form class="form-horizontal" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="CourseName" name="courseName">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" placeholder="Thumbnail(Upload Image)" name="thumbnail">
                    </div>
                    <div class="form-group">
                       <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Course Brief"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Fees" name="fees">
                    </div>
                    <button class="btn signup">Save</button>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
{{-- Form end --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
