<!DOCTYPE html>
<html lang="en" className="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Request</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div className="container">
        <div className="row">
            <div class="col-md-12 text-center py-5" style="background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; margin: 20px 0;">
                <h1 style="color: #333; font-weight: bold; margin-bottom: 20px;">Get in Touch</h1>
                <p style="color: #555; font-size: 16px;">Someone with the email <strong>{{ $client_email }}</strong> wants to contact you.</p>
                <p style="color: #555; font-size: 16px; margin-top: 10px;">Here is the message:</p>
                <blockquote style="background-color: #fff; border-left: 5px solid #007bff; padding: 15px; margin: 20px 0; color: #444;">
                    <p>{{ $client_message }}</p>
                </blockquote>
                <p style="color: #555; font-size: 16px; margin-top: 10px;">Please contact them if you are interested.</p>
            </div>
        </div>
    </div>
</body>
</html>
