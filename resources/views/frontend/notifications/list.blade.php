<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($writing as $data)
            <tr>
                <td>Admin Approved {{ $data->topic }} Writing Opportunity</td>
            </tr>
            @endforeach
            @foreach($speaking as $data)
            <tr>
                <td>Admin Approved {{ $data->topic }} Speaking Opportunity</td>
            </tr>
            @endforeach

        </tbody>
    </table>



</body>

</html>