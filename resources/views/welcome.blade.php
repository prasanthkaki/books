<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>

<div class="container" id="customers">
    @if(isset($details))
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Author Name</th>
                <th>Book Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $user)
            <tr>
                <td>{{$user->author_name}}</td>
                <td>{{$user->book_name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
<br>
</html>