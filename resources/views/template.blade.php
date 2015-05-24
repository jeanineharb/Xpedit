@extends('app') 

@section('content')

<div class="row">
	<div class="col-xs-6 col-md-4"></div>
		<div class="col-xs-6 col-md-4" style="text-align: center;">
			<h1> {{ $temp->templateName }} </h1>
		</div>
		<div class="col-xs-6 col-md-4" style="text-align: right;">
			<?php echo Form::open(['url' => 'action("EditorController@store")', 'id' => 'tempForm']); ?>

 			<button type="button" class="btn btn-default" onclick="discard()">Discard</button>

			<?php echo Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'save', 'formaction' => 'action("EditorController@store")']); 
				  echo Form::submit('Send', ['class' => 'btn btn-primary', 'id' => 'send', 'formaction' => 'action("EditorController@store")']); 
				  echo Form::close(); ?>
			<!-- <button type="button" class="btn btn-primary" id="save">Save</button> -->
		</div>
</div>

<?php
echo $temp->html;
echo $temp->css;
?>

<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/ckeditor/inlineEditorWithCustomButton.js') }}"></script>
<script src="{{ asset('/bootbox.min.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>

// var x = document.getElementsByTagName("field");
// var i;
// var att=[];
// for (i = 0; i < x.length; i++) {
// att[i]=x.item(i).attributes.getNamedItem("id").value;
// console.log(att[i]);

// var redirectUrl = "{{ url('/save') }}";
// var form = $('<form action="' + redirectUrl + '" method="post"' +
// '<input type="hidden" name="data" value="' + data + '"></input>' + 
// '<input type="hidden" name="_token" value="{{ csrf_token() }}"></input> </form>');
// $('body').append(form);
// $(form).submit

// $_token = "{{ csrf_token() }}";
// $.post( "{{ url('/save') }}", { data: $data,	_token: $_token });


$(document).ready(function() {
	$('#tempForm').submit(function(e){
		e.preventDefault();

		var $d = "";
		for (var i in CKEDITOR.instances){
			$d += CKEDITOR.instances[i].getData();
		}

		var $post = {};
		$post.html = $d;
		$post.css = '<?php echo str_replace("\n", "\\n", $temp->css);?>';
		$post._token = $('input[name=_token]').val();

		var $url = "{{ route('save.temp') }}"

		console.log($post);

		$.ajax({
			url: $url,
			data: $post,
			method: 'POST',
			success: function(response){
				window.location.href = response;
				// console.log(response);
			}
		});
	});
});


function discard(){
	bootbox.confirm("Are you sure you want to discard your changes?", function(result){
		if(result){
			top.location.href = "{{ url('/template') }}";
		}
		else{
			bootbox.hideAll();
		}
	}); 
}
</script>


@endsection