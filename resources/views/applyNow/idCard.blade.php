<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Confirmation</title>
    <style>
        .id-card {
            border: 2px solid #333;
            padding: 10px;
            width: 300px;
            font-family: Arial, sans-serif;
        }
        .id-card img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h2>Application Confirmation</h2>
    <p>Dear {{ $contact->name }},</p>
    <p>Thank you for applying. Your Roll Number is <strong>{{ $contact->roll_no }}</strong>.</p>

    <div class="id-card">
        <h3>ID Card</h3>
        <p><strong>Roll Number:</strong> {{ $contact->roll_no }}</p>
        <p><strong>Full Name:</strong> {{ $contact->name }}</p>
        <p><strong>Date of Birth:</strong> {{ $contact->dob }}</p>
        <p><strong>Mobile:</strong> {{ $contact->mobile }}</p>
        <p>
            <strong>Photo:</strong><br>
            <img src="{{ asset('storage/' . $contact->image) }}" alt="Photo">
        </p>
    </div>
</body>
</html>
