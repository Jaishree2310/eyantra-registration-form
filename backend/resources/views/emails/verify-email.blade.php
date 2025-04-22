<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - e-Yantra</title>
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            line-height: 1.5;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #E31E24;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 30px 20px;
            background-color: #ffffff;
        }
        .button {
            display: inline-block;
            background-color: #E31E24;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666666;
        }
        .tagline {
            font-style: italic;
            color: #F7D154;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/e-yantra-logo.png') }}" alt="e-Yantra Logo">
            <div class="tagline">Engineering a better tomorrow</div>
        </div>
        
        <div class="content">
            <h2>Verify Your Email</h2>
            
            <p>Hello,</p>
            
            <p>Thank you for registering for the e-Yantra competition. Please verify your email address by clicking the button below:</p>
            
            <p style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
            </p>
            
            <p>Or copy and paste this URL into your browser:</p>
            <p style="word-break: break-all; font-size: 14px;">{{ $verificationUrl }}</p>
            
            <p>This link will expire in 24 hours. If you did not create an account, no further action is required.</p>
            
            <p>Best Regards,<br>The e-Yantra Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; 2025 e-Yantra. All rights reserved.</p>
            <p>e-Yantra is a robotics outreach program funded by the Ministry of Education and hosted at IIT Bombay.</p>
        </div>
    </div>
</body>
</html>