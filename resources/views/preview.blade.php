<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $filename.'pdf' }}</title>
</head>
<style>
body {
    margin: 0;
    padding: 0;
}
</style>
<body>
    <div class="absolute top-0 bottom-0 right-0 left-0">
        <object data="/books/{{ $filename.'.pdf' }}" type="application/pdf" style="width: 100%; height:100%;">
            <embed src="/books/{{ $filename.'.pdf' }}" type="application/pdf" style="width: 100%; height:100%;"/>
        </object>
    </div>
    {{-- <iframe src="/books/{{ $filename.'.pdf' }}" frameborder="0"></iframe> --}}
</body>
</html>