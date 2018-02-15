
@extends('messaging.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/messaging/style.css') }}">
@endsection

@section('content')
    <div id="threads">
    	@include('messaging.threads')
    	@include('messaging.message-box')
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script type="text/javascript" src="{{asset('js/unickMessenger.js')}}"></script>
<script type="text/javascript">
	$('#threads').unickMessenging({
		fetch_user_messages_url:"{{route('json_return_user_messages')}}",
		fetch_chatables_url:"{{route('json_return_chatable_users')}}",
		auth_id:{{\Auth::user()->id}}
	});
</script>
@endsection
