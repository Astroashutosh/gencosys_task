<!DOCTYPE html>
<html>
<head>
    <title>Ajax Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">

    <form id="ajaxForm" enctype="multipart/form-data">
        <input type="hidden" name="form_id" id="form_id">
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
        <div class="mb-3">
            <select class="form-select" name="city" id="city">
                <option selected disabled>City</option>
                <option value="Lucknow">Lucknow</option>
                <option value="Delhi">Delhi</option>
                <option value="Mumbai">Mumbai</option>
            </select>
        </div>
        <label class="form-check-label">Courses</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="courses[]" value="PHP">
            <label class="form-check-label">PHP</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="courses[]" value="JAVA">
            <label class="form-check-label">JAVA</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="Python" >
            <label class="form-check-label">Python</label>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
    </form>

    <hr>

    <h4>Submitted Records</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>City</th>
            <th>Courses</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ajaxforms as $form)
            <tr>
                <td>{{ $form->id }}</td>
                <td>
                    @if($form->image)
                        <img src="{{ asset('storage/'.$form->image) }}" width="60">
                    @endif
                </td>
                <td>{{ $form->city }}</td>
                <td>{{ $form->courses }}</td>
                <td>
                    <button class="btn btn-sm btn-info editBtn" data-id="{{ $form->id }}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $form->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    // CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Submit form
    $('#ajaxForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let id = $('#form_id').val();
        let url = id ? `/ajax/${id}` : '{{ route("ajax.store") }}';
        let method = id ? 'POST' : 'POST';

        if (id) formData.append('_method', 'PUT');

        $.ajax({
            url: url,
            method: method,
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                alert(id ? "Updated!" : "Saved!");
                location.reload();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Something went wrong!");
            }
        });
    });

    // Edit
    $('.editBtn').click(function () {
        let id = $(this).data('id');
        $.get(`/ajax/${id}`, function (data) {
            $('#form_id').val(data.id);
            $('#city').val(data.city);
            $('input[type="checkbox"]').prop('checked', false);
            let courses = data.courses.split(',');
            courses.forEach(course => {
                $(`input[name="courses[]"][value="${course}"]`).prop('checked', true);
            });
        });
    });

    // Delete
    $('.deleteBtn').click(function () {
        if (!confirm('Are you sure?')) return;
        let id = $(this).data('id');
        $.ajax({
            url: `/ajax/${id}`,
            type: 'POST',
            data: { _method: 'DELETE' },
            success: function () {
                alert("Deleted");
                location.reload();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Delete failed!");
            }
        });
    });
</script>
</body>
</html>
