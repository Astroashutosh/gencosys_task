<!DOCTYPE html>
<html>
<head>
    <title>Search Student</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Search by Roll Number</h2>
    <form method="POST" action="/search">
        @csrf
        <input type="text" name="roll_no" placeholder="Enter Roll Number" required>
        <button type="submit">Search</button>
    </form>

    @if(isset($contact))
        @if($contact)
            <h3>Student Details:</h3>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Details</th>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td>{{ $contact->name }} {{ $contact->fname }}</td>
                </tr>
                <tr>
                    <td>Roll Number</td>
                    <td>{{ $contact->roll_no }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $contact->mobile }}</td>
                </tr>
           <tr>
            <td>Edit</td>
            <td><a href="{{ route('contact.edit', $contact->id) }}">Edit</a></td>

           </tr>
            </table>
        @else
            <p style="color:red;">No record found for this Roll Number.</p>
        @endif
    @endif
</body>
</html>
