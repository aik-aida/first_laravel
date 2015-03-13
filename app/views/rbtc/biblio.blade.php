<!DOCTYPE html>
<html>
<head>
    <title>biblio</title>
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
            <td>Jenis</td>
            <td>Tahun</td>
            <td>Judul</td>
            <td>Catatan</td>
        </tr>
    </thead>
    <tbody>
    {{ count($data) }}
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->biblio_id }}</td>
            <td>{{ $value->gmd_id }}</td>
            <td>{{ $value->publish_year }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->notes }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>