<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Document</title>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

</script>
    <script>
    	$(document).ready(function(){
    		$('#authors, #books').on('change', function () {
            let id = $(this).val(),
                type = $(this).data('type');
    			$.ajax({
					url: '/test',
					method: 'post',
					dataType: 'json',
					data: {
						"_token": "{{ csrf_token() }}",
						'id': id,
						'type': type
					},
				success: function(response) {
					console.log(typeof response);
					let table = $('<table>');
                    $.each(response, function (key, value) {
                        table.append($(
                            '<tr>' +
                                '<td>' + value + '</td>' +
                            '</tr>'
                        ));
                    });
                    $('#result').html(table);
			    }
			});
			})
    	})
	</script>
<body>
	<h2>Выберите автора</h2>
	<select data-type='authors' id='authors'>
		@foreach ($data as $item)
  			<option value = {{ $item['id'] }}> {{ $item['full_name'] }} </option>
		@endforeach
	</select>
	<h2>Выберите книгу</h2>
	<select data-type='books' id='books'>
		@foreach ($list as $elem)
			<option value = {{ $elem['id'] }}> {{ $elem['name'] }} </option>
		@endforeach
	</select><br>
	<h3>Результат</h3>
<div id='result'>
</div>
	<h3>Книги без авторов</h3>
	<table>
		@foreach ($page as $string)
			<td><tr> {{ $string }} </tr></td><br>
		@endforeach

</body>
</html>