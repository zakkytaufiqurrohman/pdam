<html>

<head>
</head>

<body>
    <form method="post" action={{ route('search') }}>
        @csrf
        <input type="text" name='key'/>
        <button name=submit>kirim</button>
    </form>
</body>
</html>