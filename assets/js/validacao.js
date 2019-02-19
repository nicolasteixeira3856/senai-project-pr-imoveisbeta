/*Aqui começa o cadastro da pagina de login e cadastro ------------------------------------------------------------------------------------------------------------------------------*/
	/*Somente caracteres nada de numeros*/
	function Onlychars(e)
	{
		var tecla=new Number();
		if(window.event) {
		tecla = e.keyCode;
		}
		else if(e.which) {
		tecla = e.which;
		}
		else {
		return true;
		}
		if((tecla >= "48") && (tecla <= "57")){
		return false;
		}
	}
	/*Somente valores numericos*/
	function Onlynumbers(e)
	{
		var tecla=new Number();
		if(window.event) {
		tecla = e.keyCode;
		}
		else if(e.which) {
			tecla = e.which;
		}
		else {
			return true;
		}
			if((tecla >= "97") && (tecla <= "122")){
			return false;
		}
	}		
	function validanome(){
	//Validação do Nome e mostra a mensagem em vermelho
		nome = document.getElementById('nome');
		if (nome.value == ""){

			var div = document.getElementById('msgnome');
			div.style.color = 'red';
			nome.style.border="1px red solid";
			nome.style.color="#000";
			document.getElementById("msgnome").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Preencha o Nome!";
			
			return false;
		}
		
	}
	/*Validação do campo de email*/
	function validacaoEmail(field) {
		usuario = field.value.substring(0, field.value.indexOf("@"));
		dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
		
		if ((usuario.length >=1) &&
			(dominio.length >=3) && 
			(usuario.search("@")==-1) && 
			(dominio.search("@")==-1) &&
			(usuario.search(" ")==-1) && 
			(dominio.search(" ")==-1) &&
			(dominio.search(".")!=-1) &&      
			(dominio.indexOf(".") >=1)&& 
			(dominio.lastIndexOf(".") < dominio.length - 1)) {
	}else{
			var email = document.getElementById('email');
			var div = document.getElementById('msgemail');
			div.style.color = 'red';
			email.style.border="1px red solid";
			email.style.color="#000";
			document.getElementById("msgemail").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Preencha o Email!";
			
			return false;
	}
	}

		function validatelefone(){
	//Validação do Nome e mostra a mensagem em vermelho
		telefone = document.getElementById('telefone');
		if (telefone.value == ""){

			var div = document.getElementById('msgtelefone');
			div.style.color = 'red';
			telefone.style.border="1px red solid";
			telefone.style.color="#000";
			document.getElementById("msgtelefone").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Preencha o Telefone!";
			
			return false;
		}
				if (telefone.value.length < 13){

			var div = document.getElementById('msgtelefone');
			div.style.color = 'red';
			telefone.style.border="1px red solid";
			telefone.style.color="#000";
			document.getElementById("msgtelefone").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Preencha o Telefone corretamente!";
			
			return false;
				}
	}
	/*permite somente valores numéricos*/
	function valCPF(e,campo){
		var tecla=(window.event)?event.keyCode:e.which;
		if((tecla > 47 && tecla < 58)){
		mascara(campo, '###.###.###-##');
		return true;
		}
		else{
		if (tecla != 8) return false;
		else return true;
		}
	}

	/*permite somente valores numéricos*/
	function valTELEFONE(e,campo){
		var tecla=(window.event)?event.keyCode:e.which;
		if((tecla > 47 && tecla < 58)){
			mascara(campo, '(##)####-####');
			return true;
		}
		else{
			if (tecla != 8) return false;
				else return true;
		}
	}

	/*permite somente valores numericos*/
	function valCEP(e,campo){
		var tecla=(window.event)?event.keyCode:e.which;
		if((tecla > 47 && tecla < 58)){
		mascara(campo, '#####-###');
		return true;
		}
		else{
			if (tecla != 8) return false;
				else return true;
		}
	}

	/*cria a mascara*/
	function mascara(src, mask){
		var i = src.value.length;
		var saida = mask.substring(1,2);
		var texto = mask.substring(i);
		if (texto.substring(0,1) != saida)
		{
			src.value += texto.substring(0,1);
		}
	}

	/*consistencia se o valor do CPF e um valor valido seguindo os criterios da Receita Federal do territorio nacional*/
	function consistenciaCPF(campo) {
		d = document.cadastro;
		cpf = campo.replace(/\./g, '').replace(/\-/g, '');
		erro = new String;
		var nonNumbers = /\D/;

		var a = [];
		var b = new Number;
		var c = 11;
		//valida se o usuario nao está colocando um cpf errado e mostra a mensagem em vermelho
		if (cpf == "00000000000" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999"){
			var div = document.getElementById('msgcpf');
			div.style.color = 'red';					
			d.cpf.style.border="1px red solid";
			d.cpf.style.color="#000";
			document.getElementById("msgcpf").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Numero de CPF inválido!";
			
			return false;
		}
		for (i=0; i<11; i++){
			a[i] = cpf.charAt(i);
			if (i < 9) b += (a[i] * --c);
			}
			if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
			b = 0;
			c = 11;
			for (y=0; y<10; y++) b += (a[y] * c--); 
			if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
			if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10])){

			erro +="CPF Não encontrado!";
		}
		if (erro.length > 0){
			var div = document.getElementById('msgcpf');
			div.style.color = 'red';				
			d.cpf.style.border="1px red solid";
			d.cpf.style.color="#000";
			document.getElementById("msgcpf").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>CPF Não encontrado!!";
			
			return true;
		}
		if(d.cpf.value == ""){
			var div = document.getElementById('msgcpf');
			div.style.color = 'red';				
			d.cpf.style.border="1px red solid";
			d.cpf.style.color="#000";
			document.getElementById("msgcpf").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Prencha o campo CPF!";
			
			return true;
		}
		
		return false;
	}
	
	function verificalogin(){
			login = document.getElementById('login');
		if (login.value == ""){

			var div = document.getElementById('msglogin');
			div.style.color = 'red';
			login.style.border="1px red solid";
			login.style.color="#000";
			document.getElementById("msglogin").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Digite o Email para se logar!";
		
			return false;
		}
	}	
	function verificasenhalogin(){
			senhalogin = document.getElementById('senhalogin');
		if (senhalogin.value == ""){

			var div = document.getElementById('msgsenha1');
			div.style.color = 'red';
			senhalogin.style.border="1px red solid";
			senhalogin.style.color="#000";
			document.getElementById("msgsenha1").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Digite a Senha para se logar!";
			
			return false;
		}
	}
	function senha1(){
	//Validação da Senha  e mostra a mensagem em vermelho
	senha = document.getElementById('senha');
		if (senha.value == ""){

			var div = document.getElementById('msgsenha');
			div.style.color = 'red';
			senha.style.border="1px red solid";
			senha.style.color="#000";
			document.getElementById("msgsenha").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Digite uma senha!";
			
			return false;
		}
				if (senha.value.length > 10){

			var div = document.getElementById('msgsenha');
			div.style.color = 'red';
			senha.style.border="1px red solid";
			senha.style.color="#000";
			document.getElementById("msgsenha").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>A senha não pode passar de 10!";
			
			return false;
		}
						if (senha.value.length < 7){

			var div = document.getElementById('msgsenha');
			div.style.color = 'red';
			senha.style.border="1px red solid";
			senha.style.color="#000";
			document.getElementById("msgsenha").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>A senha deve ter no minimo 7 caracteres!";
			
			return false;
		}
	}
	
	function confirmasenha(){
		senha = document.getElementById('senha');
		senha2 = document.getElementById('senha2');
		
		if (senha2.value == ""){

			var div = document.getElementById('msgsenha2');
			div.style.color = 'red';
			senha2.style.border="1px red solid";
			senha2.style.color="#000";
			document.getElementById("msgsenha2").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Digite a Confirmação da senha!";
			return false;
		}
	
		if (senha2.value != senha.value){

			var div = document.getElementById('msgsenha2');
			div.style.color = 'red';
			senha2.style.border="1px red solid";
			senha2.style.color="#000";
			document.getElementById("msgsenha2").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>As Senhas devem ser iguais!";
						return false;
		}
	}
	

	/*Aqui termina o cadastro da pagina de login e cadastro ------------------------------------------------------------------------------------------------------------------------------*/
/*Aqui começa a pagina de contato e esqueci minha senha ------------------------------------------------------------------------------------------------------------------------------*/

		/*Validação do campo de email*/
	function validacaoEmailcontato(field) {
		usuario = field.value.substring(0, field.value.indexOf("@"));
		dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
		
		if ((usuario.length >=1) &&
			(dominio.length >=3) && 
			(usuario.search("@")==-1) && 
			(dominio.search("@")==-1) &&
			(usuario.search(" ")==-1) && 
			(dominio.search(" ")==-1) &&
			(dominio.search(".")!=-1) &&      
			(dominio.indexOf(".") >=1)&& 
			(dominio.lastIndexOf(".") < dominio.length - 1)) {
	}else{
			var email = document.getElementById('email');
			var div = document.getElementById('msgemail');
			div.style.color = 'red';
			email.style.border="1px red solid";
			email.style.color="#000";
			document.getElementById("msgemail").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Preencha o Email!";
			return false;
		}
	}
	/*Validação do campo de email*/
	function validacaoEmailesqSenha(field) {
		usuario = field.value.substring(0, field.value.indexOf("@"));
		dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
		
		if ((usuario.length >=1) &&
			(dominio.length >=3) && 
			(usuario.search("@")==-1) && 
			(dominio.search("@")==-1) &&
			(usuario.search(" ")==-1) && 
			(dominio.search(" ")==-1) &&
			(dominio.search(".")!=-1) &&      
			(dominio.indexOf(".") >=1)&& 
			(dominio.lastIndexOf(".") < dominio.length - 1)) {
	}else{
			var email = document.getElementById('email');
			var div = document.getElementById('msgemailesq');
			div.style.color = 'red';
			email.style.border="1px red solid";
			email.style.color="#000";
			document.getElementById("msgemailesq").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>Preencha o Email!";
			return false;
	}
	}
	

/*Aqui termina a pagina de contato e esqueci minha senha ------------------------------------------------------------------------------------------------------------------------------*/
/*Aqui começa o cadastro da pagina de corretor ------------------------------------------------------------------------------------------------------------------------------*/
function validacreci(){
	creci = document.getElementById('creci');
	if (creci.value == ""){
		var div = document.getElementById('msgcreci');
		div.style.color = 'red';				
		creci.style.border="1px red solid";
		creci.style.color="#000";
		document.getElementById("msgcreci").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>O campo Creci deve ser preenchido!";
		//return false;
	}
}
/*Aqui termina o cadastro da pagina de corretor ------------------------------------------------------------------------------------------------------------------------------*/
/* Começa as validacões dos imóveis====================================================================================================================================================================================================================================================================*/
function validafinalidade(){
	if (finalidade.selectedIndex === ""){
		var div = document.getElementById('msgfinalidade');
		div.style.color = 'red';				
		finalidade.style.border="1px red solid";
		finalidade.style.color="#000";
		document.getElementById("msgfinalidade").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>O campo Finalidade deve ser preenchido!";
		//return false;
	}
}
/* Começa as funções de limpar os campos====================================================================================================================================================================================================================================================================*/


	function limpamsgsenha(){ 
	//deixa o campo azul ao invez de vermelho e tira o erro
		var senha = document.getElementById('senha');
		document.getElementById("msgsenha").innerHTML = "";
		senha.style.border="1px darkblue solid";
		senha.style.color="#000";
	}
	
	function limpamsgnome(){ 
		//deixa o campo azul ao invez de vermelho e tira o erro
		var nome = document.getElementById('nome');
		document.getElementById("msgnome").innerHTML = "";
		nome.style.border="1px darkblue solid";
		nome.style.color="#000";
	}
	
	function limpamsgemail(){ 
		//deixa o campo azul ao invez de vermelho e tira o erro
		var email = document.getElementById('email');
		document.getElementById("msgemail").innerHTML = "";
		email.style.border="1px darkblue solid";
		email.style.color="#000";
	}
	
	function limpamsgtelefone(){ 
		//deixa o campo azul ao invez de vermelho e tira o erro
		var telefone = document.getElementById('telefone');
		document.getElementById("msgtelefone").innerHTML = "";
		telefone.style.border="1px darkblue solid";
		telefone.style.color="#000";
	}
	
	function limpamsgsenha2(){ 
		//deixa o campo azul ao invez de vermelho e tira o erro
		var senha2 = document.getElementById('senha2');
		document.getElementById("msgsenha2").innerHTML = "";
		senha2.style.border="1px darkblue solid";
		senha2.style.color="#000"; 
	}
	
	function limpamsgcpf(){ 
		//deixa o campo azul ao invez de vermelho e tira o erro
		var cpf = document.getElementById('cpf');
		document.getElementById("msgcpf").innerHTML = "";
		cpf.style.border="1px darkblue solid";
		cpf.style.color="#000";
	}
	
	function limpamsgcreci(){ 
	//deixa o campo azul ao invez de vermelho e tira o erro
	var creci = document.getElementById('creci');
	document.getElementById("msgcreci").innerHTML = "";
	creci.style.border="1px darkblue solid";
	creci.style.color="#000";
	}
	
	function limpamsgsenhalogin(){ 
	//deixa o campo azul ao invez de vermelho e tira o erro
	var senhalogin = document.getElementById('senhalogin');
	document.getElementById("msgsenha1").innerHTML = "";
	senhalogin.style.border="1px darkblue solid";
	senhalogin.style.color="#000";
	}	
	function limpamsglogin(){ 
	//deixa o campo azul ao invez de vermelho e tira o erro
	var login = document.getElementById('login');
	document.getElementById("msglogin").innerHTML = "";
	login.style.border="1px darkblue solid";
	login.style.color="#000";
	}	
	
	function limpamsgmensagem(){ 
	//deixa o campo azul ao invez de vermelho e tira o erro
	var mensagem = document.getElementById('mensagem');
	document.getElementById("msgmensagem").innerHTML = "";
	mensagem.style.border="1px darkblue solid";
	mensagem.style.color="#000";
	}	
	function limpamsgesqSenha(){ 
	//deixa o campo azul ao invez de vermelho e tira o erro
	var mensagem = document.getElementById('mensagem');
	document.getElementById("msgemailesq").innerHTML = "";
	mensagem.style.border="1px darkblue solid";
	mensagem.style.color="#000";
	}	
