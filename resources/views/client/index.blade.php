@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="client-wrap col-xs-12">
			<header class="client-list-header">
				<h1>Clients</h1>
				<div id="create-client-button"></div>
			</header>

			<table class="client-list table table-striped">
				<thead>
					<th>Name</th>
					<th>Contact Name</th>
					<th>Address</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@foreach ($clients as $client)
						<tr>
							<td>{{ $client->name }}</td>
							<td>{{ $client->contact_name }}</td>
							<td>{{ $client->address }}</td>
							<td>{{ $client->phone }}</td>
							<td>{{ $client->email }}</td>
							<td></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection