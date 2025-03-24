<?php
require_once __DIR__ . '/includes/process.php';
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="./style.css">
	<style type="text/css">
	@font-face{font-family:Poppins;font-style:normal;font-weight:400;font-display:fallback;src:url('./fonts/poppins/poppins-regular.woff2') format('woff2');font-stretch:normal;}
	@font-face{font-family:Poppins;font-style:normal;font-weight:700;font-display:fallback;src:url('./fonts/poppins/poppins-bold.woff2') format('woff2');font-stretch:normal;}
	</style>
	<title>Empresas | Motorista PX</title>
	<meta name="description" content="Tenha o custo somente quando tem a demanda. Contrate seu Motorista PX em apenas 3 cliques!"/>
</head>
<body>
	<div class="container">
	<header>
		<h1>Tenha os melhores motoristas em <strong>3 cliques<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path></svg></strong></h1>
		<p>Com <strong>mais de 1235 Empresas</strong> utilizando nossa plataforma, a PX facilita o dia a dia da contratação de <strong>motoristas qualificados</strong> para a sua demanda, <strong>zerando custos extras</strong> e simplificando seus encargos.</p>
	</header>
	<div class="card">
		<nav>
		<a class="btn" href="#form">Quero Motoristas</a>
		<span>ou</span>
		<a class="btn btn-accent" href="https://cadastro.motoristapx.com.br/tour/motorista?utm_source=driver_site&utm_medium=Referral&utm_campaign=new_registration_flow">Quero Dirigir</a>
		</nav>
		<form id="form" action="/" method="POST">
		<div class="required">
			<label for="name">Seu nome <span>Obrigatório</span></label>
			<input type="text" name="name" id="name" placeholder="Nome e sobrenome" required autocomplete="name">
		</div>
		<div class="required">
			<label for="email">Seu Melhor Email <span>Obrigatório</span></label>
			<input type="email" name="email" id="email" placeholder="Email corporativo" required autocomplete="email">
		</div>
		<div class="required">
			<label for="phone">Telefone (com DDD) <span>Obrigatório</span></label>
			<input type="tel" name="phone" id="phone" placeholder="Telefone (com DDD)" required  minlength="11" maxlength="15" pattern="\(?\d{2}\)?\s?\d{4,5}-?\d{4}" autocomplete="tel-national" data-mask="phone-br">
		</div>
		<div class="required">
			<label for="company">Empresa <span>Obrigatório</span></label>
			<input type="text" name="company" id="company" placeholder="Nome da Empresa" required autocomplete="organization">
		</div>
		<div class="required">
			<label for="job">Informe seu Cargo <span>Obrigatório</span></label>
			<select name="job" id="job" required>
			<option value="Motorista">Motorista</option>
			<option value="Gestor de Frota">Gestor de Frota</option>
			<option value="RH">RH</option>
			<option value="Diretor de Logística">Diretor de Logística</option>
			<option value="Proprietário">Proprietário</option>
			</select>
		</div>
		<div class="required">
			<label for="trucks">Quantidade de caminhões <span>Obrigatório</span></label>
			<select name="trucks" id="trucks" required>
			<option value="De 1 a 10">De 1 a 10</option>
			<option value="De 11 a 25">De 11 a 25</option>
			<option value="De 26 a 50">De 26 a 50</option>
			<option value="De 51 a 100">De 51 a 100</option>
			<option value="Acima de 100">Acima de 100</option>
			</select>
		</div>
		<div class="state required">
			<label for="state">UF <span>Obrigatório</span></label>
			<select name="state" id="state" required>
			<option></option>
			<option value="AC">AC</option>
			<option value="AL">AL</option>
			<option value="AP">AP</option>
			<option value="AM">AM</option>
			<option value="BA">BA</option>
			<option value="CE">CE</option>
			<option value="DF">DF</option>
			<option value="ES">ES</option>
			<option value="GO">GO</option>
			<option value="MA">MA</option>
			<option value="MT">MT</option>
			<option value="MS">MS</option>
			<option value="MG">MG</option>
			<option value="PA">PA</option>
			<option value="PB">PB</option>
			<option value="PR">PR</option>
			<option value="PE">PE</option>
			<option value="PI">PI</option>
			<option value="RJ">RJ</option>
			<option value="RN">RN</option>
			<option value="RS">RS</option>
			<option value="RO">RO</option>
			<option value="RR">RR</option>
			<option value="SC">SC</option>
			<option value="SP">SP</option>
			<option value="SE">SE</option>
			<option value="TO">TO</option>
			</select>
		</div>
		<div class="city required">
			<label for="city">Cidade <span>Obrigatório</span></label>
			<input type="text" name="city" id="city" required>
			</select>
		</div>

		<?php renderCsrfField(); ?>

		<?php renderRecaptcha(); ?>

		<button class="btn btn-accent" type="submit">Agendar Demonstração</button>
		<p>Ao submeter o formulário acima você aceita receber nossas comunicações via email.</p>
		</form>
	</div>
	</div>
	<script src="./scripts.js"></script>
</body>
</html>
