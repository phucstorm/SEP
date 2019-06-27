<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    
<div class="visible-print text-center">
     {!! QrCode::size(250)->generate($total); !!}
</div>
    
</body>
</html>