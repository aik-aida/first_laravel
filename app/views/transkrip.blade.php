<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>repikTA</title>
</head>
<body>
  
  <p> {{ $data->status }} </p>
  <p> {{ $data->nrp }} </p>
  <p> {{ $data->nama }} </p>
  <p> {{ $data->ipk }} </p>
  <p> {{ $data->totalsks }} </p>
  <p> {{ $data->tanggal }} </p>
  <br/>
  <p> ---MK PERSIAPAN--- </p>
  <table style="width:100%">
  @foreach($data->mkpersiapan as $dt)
    <tr>
      <td>{{ $dt->kode }}</td>
      <td>{{ $dt->nama }}</td>
      <td>{{ $dt->sks }}</td>
      <td>{{ $dt->catatan }}</td>
      <td>{{ $dt->nilai }}</td>
    </tr>
  @endforeach
  </table>
  <br/>
  <p> ---MK SARJANA--- </p>
  <table style="width:100%">
  @foreach($data->mksarjana as $dt)
    <tr>
      <td>{{ $dt->kode }}</td>
      <td>{{ $dt->nama }}</td>
      <td>{{ $dt->sks }}</td>
      <td>{{ $dt->catatan }}</td>
      <td>{{ $dt->nilai }}</td>
    </tr>
  @endforeach
  </table>

  <p> -AIDA- </p>
</body>
</html>