<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>
        Ciao amministratore,<br>
        è stato creato un nuovo progetto. <br>
        Nome progetto : {{ $project->name }} <br>
        Link progetto: <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">project link</a> <br>
        Buona giornata!
    </p>
</body>
</html>