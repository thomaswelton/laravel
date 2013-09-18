@extends('layouts.email')

@section('content')
	<table cellpadding="0" cellspacing="0" border="0" align="center">
		<tr>
			<td width="600" valign="top">
				<p>Your reset code is {{ $code }}</p>
				<p>Use the <a href="{{ URL::to('password/reset') }}">reset form</a> to choose a new password</p>
			</td>
		</tr>
	</table>
@stop
