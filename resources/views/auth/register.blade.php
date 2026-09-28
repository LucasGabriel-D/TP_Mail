<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de Usuario</title>
	<style>
		body { font-family: sans-serif; margin: 40px; }
		.field { margin-bottom: 16px; }
		.error { color: #dc2626; font-size: 13px; }
		.success { color: #16a34a; font-weight: bold; }
	</style>
</head>
<body>
	<h2>Formulario de Registro</h2>

	@if (session('success'))
		<p class="success">{{ session('success') }}</p>
	@endif

	<form action="{{ url('/register') }}" method="POST">
		@csrf

		<div class="field">
			<label for="name">Nombre Completo:</label><br>
			<input id="name" type="text" name="name" value="{{ old('name') }}" required>
			@error('name')
				<br><span class="error">{{ $message }}</span>
			@enderror
		</div>

		<div class="field">
			<label for="email">Correo Electrónico:</label><br>
			<input id="email" type="email" name="email" value="{{ old('email') }}" required>
			@error('email')
				<br><span class="error">{{ $message }}</span>
			@enderror
		</div>

		<div class="field">
			<label for="password">Contraseña:</label><br>
			<input id="password" type="password" name="password" required>
			@error('password')
				<br><span class="error">{{ $message }}</span>
			@enderror
		</div>

		<div class="field">
			<label for="password_confirmation">Confirmar Contraseña:</label><br>
			<input id="password_confirmation" type="password" name="password_confirmation" required>
		</div>

		<button type="submit">Registrarse</button>
	</form>
</body>
</html>