<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>repikTA</title>
</head>
<body>
  
  <h1>Upload Trankskrip Anda</h1>
  {{ Form::open(array('url'=>'proses','files'=>true)) }}
  
  {{ Form::label('file','File',array('id'=>'','class'=>'')) }}
  {{ Form::file('file','',array('id'=>'','class'=>'')) }}
  <br/><br/>
  <!-- submit buttons -->
  {{ Form::submit('Baca Transkrip') }}
  
  <p> -AIDA- </p>
</body>
</html>