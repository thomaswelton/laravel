@extends('layouts.email')

@section('content')
	<table cellpadding="0" cellspacing="0" border="0" align="center">
		<tr>
			<td width="480" valign="top">
				Hey <?= $user->first_name ?>

				<br><br>
				A new user account has been created for you at <a href="{{ URL::to('/') }}">{{ URL::to('/') }}</a>
			</td>
		</tr>
		<tr height=25>
			<td></td>
		</tr>
		<tr>
			<td>
				<table cellpadding="5" cellspacing="5" border="0" align="left" width="100%">
					<tr>
						<td width=80>login:</td>
						<td>{{ $user->email }}</td>
					</tr>
					<tr>
						<td>password:</td>
						<td>{{ $password }}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr height=25>
			<td></td>
		</tr>
		<tr>
			<td><a href="{{ $loginLink }}" class="btn btn-primary">Login Now</a></td>
		</tr>
	</table>
@stop
