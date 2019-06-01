<?php 
	$connect = mysqli_connect("localhost", "root", "") or die("<center>Ocorreu um erro ao estabelecer conexão com nossos servidores! Por favor, tente mais tarde.</center>");
	$select_db = mysqli_select_db($connect, "validades") or die("<center>Ocorreu um erro ao estabelecer conexão com nosso Banco de Dados! Por favor, tente mais tarde.</center>");

	$nome_produto = "nome_produto";
	$validade = "validade";
	$produtos = "produtos";
	$excluidos = "excluidos";
?>