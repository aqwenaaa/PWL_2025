<!-- View pada resources/views/hello.blade.php -->
<html>
    <head>
        <title>Greeting Page</title>
    </head>
<body>
    <h1>Hello, {{ $name }}</h1> <!-- {$name }} → Blade Syntax yang akan digantikan dengan nilai dari variabel name yang dikirim dari controller atau route.-->
    <h1>You are {{$occupation}}</h1>
</body>
</html>