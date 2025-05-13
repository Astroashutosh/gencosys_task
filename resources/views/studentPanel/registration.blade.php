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
                    {{-- Registration form --}}


                    <div class="container">
                       
                    
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
                                <div class="form-container">
                                    <h3 class="title">Student Registration</h3>

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


<form class="form-horizontal" method="post" action="{{ route('stuRegistration.store') }}">
    @csrf
    <div class="form-group pe-2">
        <label for="firstname" style="text-align: left; display: block;">First Name*</label>

        <input class="form-control " type="text" name="firstName" id="firstname" required>
    </div>

    <!-- Remove or rename this second user name field if it's needed -->
    <div class="form-group">
        <label for="lastname">Last Name *</label>
        <input class="form-control" type="text" name="lastName" id="lastname" required>
    </div>

    <div class="form-group p-2">
        <label for="email">Email ID*</label>
        <input class="form-control " type="email" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="mobile">Mobile Number</label>
        <input class="form-control" type="tel" name="mobile" id="mobile" pattern="[0-9]{10}" maxlength="10">
    </div>

    <div class="form-group">
        <label for="course">Select Course*</label>
        <select name="course" class="form-control" id="course" required>
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->courseName }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn border border-outlined signin">Save</button>
</form>

           <style>
            .form-group label {
    text-align: left;
    display: block;
    
}
</style>                        
                                </div>
                            </div>
                            <div class="col-md-3"></div>

                        </div>
                    </div>

                    {{-- registration form end --}}
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</x-app-layout>
  