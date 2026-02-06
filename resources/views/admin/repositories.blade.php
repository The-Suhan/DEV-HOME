@extends('layouts.app')

@section('home-section')
    <div class="container-sm my-4">
        <h2 class="text-danger mb-5"><i class="bi bi-shield-shaded"></i> ADMIN MANAGEMENT</h2>
        <div class="table-responsive bg-dark p-3 rounded">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Owner</th>
                        <th>date</th>
                        <th>Process</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repos as $repo)
                        <tr>
                            <td>{{ $repo->title }}</td>
                            <td>{{ $repo->user->username }}</td>
                            <td>{{ $repo->created_at->format('d.m.Y') }}</td>
                            <td>
                                <form action="{{ route('admin.repo.delete', $repo->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection