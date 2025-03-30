<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Contact Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        h2 {
            color: #4CAF50;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Request</h2>

        <div>
            <label for="name">Name:</label>
            <p>{{ $name }}</p>

            <label for="phone">Phone:</label>
            <p>{{ $phone }}</p>

            <label for="email">Email:</label>
            <p>{{ $email }}</p>

            <label for="message">Message:</label>
            <p>{{ $pesan }}</p>
        </div>

        <div class="footer">
            <p>This is an automated notification. Please do not reply to this email.</p>
            <p>&copy; 2024 FIONA. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
