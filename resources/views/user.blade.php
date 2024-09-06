<html>
    <head>
        <title>User Profile</title>
    </head>
    <body>
        <h1>Selamat Datang</h1>
        <p> Nomor ID  Anda : {{ $id }}</p>
        <p> Nama Anda      : {{ $name }}</p>
        <br>
        <a href="{{ route('home')}}">Kembali ke Home </a>
    </body>
</html>