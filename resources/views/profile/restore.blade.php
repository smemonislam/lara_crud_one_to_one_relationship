@extends('layouts.app')

@section('title', 'Restore Profile')

@section('content')
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>All Restore <b>Post</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ route('profile.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Profile</span></a>
						<a href="{{ route('profile.index') }}" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Back</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">				
				<thead>
					<tr>
						<th>SL</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
						<th>User Email</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>Age</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($trashed as $row)
					<tr>
						<td>{{ $loop->iteration}}</td>
						<td>{{ $row->fname }}</td>
						<td>{{ $row->lname }}</td>
						<td>{{ $row->user?->username }} </td>
						<td>{{ $row->user?->email }}</td>
						<td>{{ $row->address }}</td>
						<td>{{ $row->phone }}</td>
						<td>{{ $row->age }}</td>
						<td>
                            <form action="{{ route('profile.delete', $row->id) }}" method="POST" class="d-flex">
                                <a href="{{ route('profile.restore', $row->id) }}" class="edit"><span class="material-icons">restore_from_trash</span></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
                            </form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $trashed->onEachSide(5)->links() }}
		</div>
	</div>        
</div>
@push('script')
	@if(session()->has('message'))
		<script>
			Swal.fire({
				title: 'Are you sure?',
				text: "{{ session('message') }}",
				icon: "{{ session('type') }}",
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Deleted!',
						'Your file has been deleted.',
						'success'
					)
				}
			})
		</script>
	@endif
@endpush

@endsection