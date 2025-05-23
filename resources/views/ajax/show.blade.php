<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Picture</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->age }}</td>
                    <td><img src="{{ asset('storage/' . $item->picture) }}" alt="Picture" width="100"></td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

<script>
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '{{ route('showajax') }}',
            success: function e(rsponse) {
                // console.log(response.data);
                var data = response.data;
                var tableBody = $('tbody');
                tableBody.empty(); // Clear existing rows

                $.each(data, function (index, item) {
                    var row = '<tr>' +
                        '<td>' + item.name + '</td>' +
                        '<td>' + item.email + '</td>' +
                        '<td>' + item.age + '</td>' +
                        '<td><img src="{{ asset('storage/') }}/' + item.picture + '" alt="Picture" width="100"></td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    });
</script>


</body>
</html>