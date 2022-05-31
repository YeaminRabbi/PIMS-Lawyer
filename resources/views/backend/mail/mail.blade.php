<!DOCTYPE html>
<html>
<head>
    <title>Paperart.digital</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    
    <p>Site: {{ $details['data']['site'] }}</p>
    <h2>OPT</h2>
    <h2 style="color:blue;">{{ $details['opt'] }}</h2>
    <p>This opt will expire in {{ $details['duration'] }}</p>
    <p>Regards from</p>
    <p>PaperArt.digital</p>
</body>
</html>