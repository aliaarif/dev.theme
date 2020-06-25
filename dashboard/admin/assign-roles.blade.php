@extends('layouts.user')

@section('content')
    <table>
        <thead>
        <th>First Name</th>
        <th>Last Name</th>
        <th>E-Mail</th>
        <th>Translator</th>
        <th>Operations</th>
        <th>Evaluator</th>
        <th>Proof Reader</th>
        <th>Quality Analyst</th>
        <th>Client</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($users as $user)


            <tr>
                <form action="{{ route('admin.assign') }}" method="post">
                    <td>{{ $user->profile->first_name }}</td>
                    <td>{{ $user->profile->last_name }}</td>
                    <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                    <td>

                    <p>
              <label>
                <input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin">
              </label>
            </p>
                
                <!-- <input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"> -->
                    
                    </td>
                    <td><input type="checkbox" {{ $user->hasRole('Translator') ? 'checked' : '' }} name="role_translator"></td>
                    <td><input type="checkbox" {{ $user->hasRole('Operations') ? 'checked' : '' }} name="role_operations"></td>
                    <td><input type="checkbox" {{ $user->hasRole('Proof Reader') ? 'checked' : '' }} name="role_proof_reader"></td>
                    <td><input type="checkbox" {{ $user->hasRole('Quality Analyst') ? 'checked' : '' }} name="role_quality_analyst"></td>
                    <td><input type="checkbox" {{ $user->hasRole('Client') ? 'checked' : '' }} name="role_client"></td>
                    {{ csrf_field() }}
                    <td><a class="btn btn-floating  waves-effect waves-light" type="submit">
                    <i class="material-icons">check_circle</i>
                    </a></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection