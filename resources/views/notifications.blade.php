<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Push Notifications</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="notifications" class="notifications-container">
    <!-- Render existing notifications -->
    @foreach ($notifications as $notification)
        <div class="notification">
            {{ $notification->data['message'] ?? 'No message available' }}
        </div>
    @endforeach
</div>

<script src="{{ mix('js/app.js') }}"></script>
<script>
    const userId = {{ Auth::id() }};
</script>
</body>
</html>
