<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .button {
            background-color: #7065f0;
            border: none;
            color: white !important;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 8px;">
        <h2 style="color: #1b2a47;">Account Verification</h2>
        <p>Dear {{ $user->name }},</p>
        <p>Thank you for registering at Orbosis Reality. Please click the button below to verify your account:</p>
        <p style="margin: 30px 0; text-align: center;">
            <a href="{{ route('verify-email', $user->verify_token) }}" class="button">Verify Account</a>
        </p>
        <p>Or copy and paste the link below into your browser:</p>
        <p><a href="{{ route('verify-email', $user->verify_token) }}">{{ route('verify-email', $user->verify_token) }}</a></p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777;">If you did not create an account, no further action is required.</p>
    </div>
</body>
</html>
