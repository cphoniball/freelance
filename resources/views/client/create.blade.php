@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="client-list col-xs-12">
			<header class="client-list-header">
				<h1>Create a new client</h1>
			</header>

			@if (isset($status) && $status === 'created')
				<div class="alert alert-success">Client created!</div>
			@endif

			<form action="{{ route('client.store') }}" method="post">

				<input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

				{!! csrf_field() !!}

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" placeholder="Client's name" required>
				</div>

				<div class="form-group">
					<label for="name">Contact Name</label>
					<input type="text" class="form-control" name="contact_name" placeholder="Client contact name">
				</div>

				<div class="form-group">
					<label for="name">Description</label>
					<textarea name="description" placeholder="Describe this client" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="address">Address</label>
					<textarea name="address" placeholder="Client's complete address" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="tel" name="phone" class="form-control">
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" class="form-control">
				</div>


				<div class="form-group">
					<button type="submit" class="btn btn-primary">Create Client</button>
				</div>
			</form>

		</div>
	</div>
</div>
@endsection