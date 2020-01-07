<?php
namespace Expectancy;

defined('ABSPATH') or die(__('You shall not pass!', 'my-plugin-text'));

class Utils {
    /**
     * List of locale codes and corresponding languages. This is the same list WordPress uses.
     */
    const LANGUAGES = [
        // 'ar' => 'العربية',
        // 'ary' => 'العربية المغربية',
        // 'az' => 'Azərbaycan dili',
        // 'azb' => 'گؤنئی آذربایجان',
        // 'bg-BG' => 'Български',
        // 'bn-BD' => 'বাংলা',
        // 'bs-BA' => 'Bosanski',
        // 'ca' => 'Català',
        // 'ceb' => 'Cebuano',
        // 'cs-CZ' => 'Čeština&lrm;',
        // 'cy' => 'Cymraeg',
        // 'da-DK' => 'Dansk',
        'de-DE' => 'Deutsch',
        // 'de-CH-informal' => 'Deutsch (Schweiz, Du)',
        // 'de-CH' => 'Deutsch (Schweiz)',
        // 'de-DE-formal' => 'Deutsch (Sie)',
        // 'el' => 'Ελληνικά',
        'en-US' => 'English',
        // 'en-CA' => 'English (Canada)',
        // 'en-NZ' => 'English (New Zealand)',
        // 'en-GB' => 'English (UK)',
        // 'en-ZA' => 'English (South Africa)',
        // 'en-AU' => 'English (Australia)',
        // 'eo' => 'Esperanto',
        'es-ES' => 'Español',
        // 'es-MX' => 'Español de México',
        // 'es-CL' => 'Español de Chile',
        // 'es-VE' => 'Español de Venezuela',
        // 'es-PE' => 'Español de Perú',
        // 'es-CO' => 'Español de Colombia',
        // 'es-GT' => 'Español de Guatemala',
        // 'es-AR' => 'Español de Argentina',
        // 'et' => 'Eesti',
        // 'eu' => 'Euskara',
        // 'fa-IR' => 'فارسی',
        // 'fi' => 'Suomi',
        // 'fr-CA' => 'Français du Canada',
        'fr-FR' => 'Français',
        // 'fr-BE' => 'Français de Belgique',
        // 'gd' => 'Gàidhlig',
        // 'gl-ES' => 'Galego',
        // 'haz' => 'هزاره گی',
        // 'he-IL' => 'עִבְרִית',
        // 'hi-IN' => 'हिन्दी',
        // 'hr' => 'Hrvatski',
        // 'hu-HU' => 'Magyar',
        // 'hy' => 'Հայերեն',
        // 'id-ID' => 'Bahasa Indonesia',
        // 'is-IS' => 'Íslenska',
        'it-IT' => 'Italiano',
        'ja' => '日本語',
        // 'ka-GE' => 'ქართული',
        'ko-KR' => '한국어',
        // 'lt-LT' => 'Lietuvių kalba',
        // 'mk-MK' => 'Македонски јазик',
        // 'mr' => 'मराठी',
        // 'ms-MY' => 'Bahasa Melayu',
        // 'my-MM' => 'ဗမာစာ',
        // 'nb-NO' => 'Norsk bokmål',
        // 'nl-NL' => 'Nederlands',
        // 'nl-NL-formal' => 'Nederlands (Formeel)',
        // 'nn-NO' => 'Norsk nynorsk',
        // 'oci' => 'Occitan',
        'pl-PL' => 'Polski',
        // 'ps' => 'پښتو',
        'pt-BR' => 'Português do Brasil',
        'pt-PT' => 'Português',
        // 'ro-RO' => 'Română',
        'ru-RU' => 'Русский',
        // 'sk-SK' => 'Slovenčina',
        // 'sl-SI' => 'Slovenščina',
        // 'sq' => 'Shqip',
        // 'sr-RS' => 'Српски језик',
        // 'sv-SE' => 'Svenska',
        'th' => 'ไทย',
        // 'tl' => 'Tagalog',
        // 'tr-TR' => 'Türkçe',
        // 'ug-CN' => 'Uyƣurqə',
        // 'uk' => 'Українська',
        // 'vi' => 'Tiếng Việt',
        'zh-CN' => '简体中文',
        'zh-TW' => '繁體中文',
    ];

    /**
     * Verifies a nonce passed in an AJAX call.
     *
     * @param string $nonce
     */
    public static function verify_nonce($nonce) {
        if (!check_ajax_referer($nonce, 'nonce')) {
            wp_send_json_error([
                'message' => __('Verification failed. Reload the page and try again.', 'my-plugin-text'),
            ]);
        }
    }

    /**
     * Returns a list of user IDs that are assigned the role(s) sent as a param array.
     *
     * @param array $roles
     *
     * @return array
     */
    public static function get_user_ids_by_roles($roles) {
        $args = [
            'role__in' => $roles,
            'fields' => ['ID'],
        ];
        $users = get_users($args);

        $ids = array_map(function ($user) {
            return $user->ID;
        }, $users);

        return $ids;
    }

    /**
     * Lookup users assigned to a WP role.
     *
     * @param string $role WP Role to be looked up
     *
     * @return array returns an array of user names
     */
    public static function get_users_names_by_role($role) {
        $args = [
            'role' => $role,
            'orderby' => 'display_name',
            'order' => 'ASC',
        ];

        add_filter('user_search_columns', function ($search_columns) {
            if (!in_array('display_name', $search_columns)) {
                $search_columns[] = 'display_name';
            }

            return $search_columns;
        });

        return get_users($args);
    }

    /**
     * Update the name of a WP role.
     *
     * @param string $role     Slug of the WP role to be updated
     * @param string $new_name The new name for this role
     */
    public static function update_wp_role_name($role, $new_name) {
        $roles = get_option('wp_user_roles');
        $roles[$role]['name'] = trim($new_name);
        update_option('wp_user_roles', $roles);
    }

    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int).
     *
     * @param int $length How many characters do we want?
     *
     * @throws \Exception
     *
     * @return string
     */
    public static function random_str($length) {
        $str = '';
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new \Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            try {
                $str .= $keyspace[random_int(0, $max)];
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        }

        return $str;
    }
}
