<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<link rel="StyleSheet" href="../../assets/css/bootstrap.css">
		<link rel="StyleSheet" href="../../assets/css/style.css">
		<link rel="StyleSheet" href="../../assets/css/form-cdst-elements.css">
		<script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/cdst.js"></script>
	</head>
	<body> 
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="">
						<div class="form-box">
							<div class="form-top">
								<div class="form-top-left">
									<h1>Cadastrar corretor</h1>
									<p>Preencha todos os campos abaixo para cadastrar um corretor.</p>
								</div>
								<div class="form-top-right">
									<i class="fa fa-pencil"></i>
								</div>
							</div>
							<div class="form-bottom">
								<form role="form" name="cadastro" action="" method="POST" class="registration-form">
									<div class="form-group">
										<label class="sr-only" for="form-first-name">Nome</label>
										<input type="text" name="nome" id="nome" placeholder="*Nome completo..." class="form-first-name form-control" id="form-first-name" pattern="[a-z\A-Z\s]+$" title="Somente Letras." required autofocus>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-first-name">Nome do usuário</label>
										<input type="text" name="login" id="login" placeholder="*Nome do usuário..." class="form-first-name form-control" id="form-first-name" required>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-email">Email</label>
										<input type="text" name="email" id="email" placeholder="*Email..." class="form-email form-control" id="form-email" required>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-first-name">Senha</label>
										<input type="password" name="senha" id="senha" placeholder="*Senha..." class="form-first-name form-control" id="form-first-name" title="Senha com no máximo 10 caracteres e no mínimo 7 caracteres alfanuméricos" pattern="[a-zA-Z0-9 ]+.{6,10}" maxlength="10" onclick="return Senha();" required></textarea>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-first-name">CSenha</label>
										<input type="password" name="senha2" id="senha2" placeholder="*Confirmar Senha..." class="form-first-name form-control" id="form-first-name" title="Senha com no máximo 10 caracteres e no mínimo 7 caracteres alfanuméricos" pattern="[a-zA-Z0-9 ]+.{6,10}" maxlength="10" onclick="return Senha();" required></textarea>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-first-name">CPF</label>
										<input type="text" name="CPF" placeholder="*CPF..." class="form-first-name form-control" id="form-first-name" onkeypress="return valCPF(event,this);return false;" onblur="if(consistenciaCPF(this.value)) this.select();" maxlength="14"  title="###.###.###-##" required>
									</div>
									<div id="estado">
										<select class="form-selected" name="estado" required>
											<option value="estado" disabled selected hidden>*Selecione o munícipio onde o corretor atuará...</option> 
											<option value="1">Adrianópolis</option> 
											<option value="2">Agudos do Sul</option> 
											<option value="3">Almirante Tamandaré</option> 
											<option value="4">Araucária</option> 
											<option value="5">Balsa Nova</option> 
											<option value="6">Bocaiuva do Sul</option> 
											<option value="7">Campina Grande do Sul</option> 
											<option value="8">Campo do Tenente</option> 
											<option value="9">Campo Largo</option> 
											<option value="10">Campo Magro</option> 
											<option value="11">Cerro Azul</option> 
											<option value="12">Colombo</option> 
											<option value="13">Contenda</option> 
											<option value="14">Curitiba</option> 
											<option value="15">Doutor Ulysses</option> 
											<option value="16">Fazenda Rio Grande</option> 
											<option value="17">Itaperuçu</option> 
											<option value="18">Lapa</option> 
											<option value="19">Mandirituba</option> 
											<option value="20">Piên</option> 
											<option value="21">Pinhais</option> 
											<option value="22">Piraquara</option> 
											<option value="23">Quatro Barras</option> 
											<option value="24">Quitandinha</option> 
											<option value="25">Rio Branco do Sul</option> 
											<option value="26">Rio Negro</option> 
											<option value="27">São José dos Pinhais</option> 
											<option value="28">Tijucas do Sul</option> 
											<option value="29">Tunas do Paraná</option> 
										</select>
									</div> <br>
									<div class="form-group">
										<input type="number" name="creci" placeholder="*Creci do corretor..." class="form-first-name form-control" id="form-first-name" required>
									</div>
									<br>
									<button type="submit" class="btn" id="button" onclick="return validaForm(); " value="CONFIRMAR" style="width:65%;">Cadastrar corretor</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<h1> Dacueba </h1>
					<h5> Dacueba </h5>
				</div>
			</div>
		</div>
	</body>
</html>