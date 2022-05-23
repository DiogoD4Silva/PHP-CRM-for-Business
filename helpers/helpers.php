<?php

function randomString($n)
{
	$generated_string = "";

	$domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

	$len = strlen($domain);

	for ($i = 0; $i < $n; $i++) {

		$index = rand(0, $len - 1);

		$generated_string = $generated_string . $domain[$index];
	}

	return $generated_string;
}

function getSecureRandomToken()
{
	$token = bin2hex(openssl_random_pseudo_bytes(16));
	return $token;
}

function clearAuthCookie()
{

	unset($_COOKIE['series_id']);
	unset($_COOKIE['remember_token']);
	setcookie('series_id', null, -1, '/');
	setcookie('remember_token', null, -1, '/');
}

function clean_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function paginationLinks($current_page, $total_pages, $base_url)
{

	if ($total_pages <= 1) {
		return false;
	}

	$html = '';

	if (!empty($_GET)) {

		unset($_GET['page']);

		$http_query = "?" . http_build_query($_GET);
	} else {
		$http_query = "?";
	}

	$html = '<ul class="pagination text-center">';

	if ($current_page == 1) {

		$html .= '<li class="disabled"><a>Primeiro</a></li>';
	} else {
		$html .= '<li><a href="' . $base_url . $http_query . '&page=1">Primeiro</a></li>';
	}

	if ($current_page > 5) {
		$i = $current_page - 4;
	} else {
		$i = 1;
	}

	for (; $i <= ($current_page + 4) && ($i <= $total_pages); $i++) {
		($current_page == $i) ? $li_class = ' class="active"' : $li_class = '';

		$link = $base_url . $http_query;

		$html = $html . '<li' . $li_class . '><a href="' . $link . '&page=' . $i . '">' . $i . '</a></li>';

		if ($i == $current_page + 4 && $i < $total_pages) {

			$html = $html . '<li class="disabled"><a>...</a></li>';
		}
	}

	if ($current_page == $total_pages) {
		$html .= '<li class="disabled"><a>Último</a></li>';
	} else {

		$html .= '<li><a href="' . $base_url . $http_query . '&page=' . $total_pages . '">Último</a></li>';
	}

	$html = $html . '</ul>';

	return $html;
}

function xss_clean($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
