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
				<div class="col-sm-6" style="">
					<div class="">
					  	<div class="form-box">
							<div class="form-top">
								<div class="form-top-left">
									<h1>Cadastrar imóvel.</h1>
									<p>Preencha todos os campos abaixo para cadastrar o imóvel.</p>
								</div>
								<div class="form-top-right">
									<i class="fa fa-pencil"></i>
								</div>
							</div>
							<div class="form-bottom">
								<form role="form" name="cadastro" action="" method="post" class="registration-form">
									<div class="form-group">
										<input type="text" name="titulo" placeholder="*Título do imóvel..." class="form-first-name form-control" id="form-first-name" required autofocus>
									</div>
									<div class="form-group">
										<textarea rows="10" cols="50" class="form-first-name form-control" placeholder="*Descrição do imóvel..." style="resize: none;" required></textarea>
									</div>
									<div class="form-group">
										<input type="number" name="nquartos" placeholder="*Nº de quartos..." class="form-first-name form-control" id="form-first-name" required>
									</div>
									<div class="form-group">
										<input type="number" name="nvagas" placeholder="*Nº de vagas..." class="form-first-name form-control" id="form-first-name" required>
									</div>
									<div class="form-group">
										<input type="number" name="aream" placeholder="*Area M2..." class="form-first-name form-control" id="form-first-name" required>
									</div>
									<div id="estado">
										<select class="form-selected" name="estado" required>
											<option value="estado">*Negociação</option> 
											<option value="1">Venda</option> 
											<option value="2">Aluguel</option> 
										</select> 
									</div> <br>
									<div id="estado">
										<select class="form-selected" name="estado" required>
											<option value="estado">*Finalidade...</option> 
											<option value="1">Residencial</option> 
											<option value="2">Comercial</option> 
											<option value="3">Industrial</option> 
										</select> 
									</div> <br>
									<div id="estado">
										<select class="form-selected" name="estado" required>
											<option value="estado">*Tipo...</option> 
											<option value="1">Casa</option> 
											<option value="2">Apartamento</option> 
											<option value="3">Sobrado</option> 
											<option value="4">Kitinete</option> 
											<option value="5">Flat</option> 
											<option value="6">Ponto comercial</option> 
											<option value="7">Loja</option> 
											<option value="8">Barracão</option> 
											<option value="9">Terreno</option> 
										</select> 
									</div> <br>
									<!-- Local -->
									<div id="estado">
										<select class="form-selected" name="estado" required>
											<option value="estado">*Região...</option> 
											<option value="1">Norte</option> 
											<option value="2">Sul</option> 
											<option value="3">Leste</option> 
											<option value="4">Oeste</option> 
										</select> 
									</div> <br>
									<div class="form-group">
										<input type="number" name="valor" placeholder="*Valor..." class="form-first-name form-control" id="form-first-name" required>
									</div> <br>
								</form>
								<button type="submit" class="btn" id="button" style="width:100%;">Efetuar cadastro</button>
							</div> <br><br>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-top-left">
						<h1>Dacueba.</h1>
						<p>Dacueba.</p>
						
						<!-- 	<div id="estado">
									<select class="form-selected" name="estado" required>
										<option value="estado">*Selecione o estado...</option> 
										<option value="1">Acre</option> 
										<option value="2">Alagoas</option> 
									</select> 
								</div> 
						--> 
						
					</div>
				</div>
			</div> 
		</div>
	</body>
</html> 