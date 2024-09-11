<html>
    <head>
        <title>User Profile</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                color: #333;
                margin: 0;
                padding: 0;
            }
    
            .container {
                width: 80%;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
    
            h1 {
                color: #4CAF50;
                margin-bottom: 20px;
            }
    
            p {
                font-size: 18px;
                line-height: 1.6;
                margin: 10px 0;
            }
    
            a {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 20px;
                text-decoration: none;
                color: #fff;
                background-color: #4CAF50;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }
    
            a:hover {
                background-color: #45a049;
            }
        </style>
    </head> 
    <body>
        {{-- <div class="container">
            <h1>Selamat Datang</h1>
            <p> Nomor ID  Anda : {{ $id }}</p>
            <p> Nama Anda      : {{ $name }}</p>
            <br>
            <a href="{{ route('home')}}">Kembali ke Home </a>
        </div> --}}
        <h1>Data User</h1>
        <table border="1" cellpadding="2", cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
            </tr>
            @foreach ($data as $d )
            <tr>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->username }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->level_id }}</td>
            </tr>            
            @endforeach
        </table>
    </body>
</html>