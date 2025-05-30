<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}<br />
                Your Roll Number: <strong>{{ session('roll_no') }}</strong>
            </div>
        @endif

        <h1>Edit Contact</h1>

        <form action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $contact->name) }}" />
            </div>

            <div class="mb-3">
                <label>Father Name</label>
                <input type="text" name="fname" class="form-control" value="{{ old('fname', $contact->fname) }}" />
            </div>

            <div class="mb-3">
                <label>DOB</label>
                <input type="date" name="dob" class="form-control" value="{{ old('dob', $contact->dob) }}" />
            </div>

            <div class="mb-3">
                <label>Mobile Number</label>
                <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $contact->mobile) }}" />
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}" />
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $contact->address) }}" />
            </div>

            <div class="mb-3">
                <label>Current Photo:</label><br />
                @if($contact->image)
                    <img src="{{ asset('storage/' . $contact->image) }}" alt="Current Photo" width="150" />
                @else
                    <p>No image uploaded</p>
                @endif
            </div>

            <div class="mb-3">
                <label>Change Photo</label>
                <input type="file" name="image" class="form-control" />
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
