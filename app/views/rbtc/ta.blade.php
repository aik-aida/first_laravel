<!DOCTYPE html>
<html>
<head>
    <title>TA</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('rbtc') }}">RBTC</a>
    </div>
</nav>

<h1>TA TA TA</h1>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nrp</td>
            <td>Nama</td>
            <td>Tahun</td>
            <td>Judul</td>
            <td>Abstraksi</td>
        </tr>
    </thead>
    <tbody>
    {{ count($data) }}
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->nrp }}</td>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->tahun }}</td>
            <td>{{ $value->judul }}</td>
            <td>{{ $value->abstraksi }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>