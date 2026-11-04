
<?php

declare(strict_types=1);

function requiredEnv(string $name): string
{
    $value = getenv($name);

    if ($value === false || $value === '') {
        fwrite(STDERR, "Missing environment variable: {$name}\n");
        exit(1);
    }

    return $value;
}

$baseUrl = rtrim(requiredEnv('BASE_URL'), '/');

$settings = [
    'BASE_URL' => $baseUrl,
    'LANGUAGE' => getenv('LANGUAGE') ?: 'english',
    'DEBUG_MODE' => filter_var(
        getenv('DEBUG_MODE') ?: 'true',
        FILTER_VALIDATE_BOOLEAN
    ),
    'DB_HOST' => requiredEnv('DB_HOST'),
    'DB_NAME' => requiredEnv('DB_NAME'),
    'DB_USERNAME' => requiredEnv('DB_USERNAME'),
    'DB_PASSWORD' => requiredEnv('DB_PASSWORD'),
];

$config = "<?php\n\nclass Config\n{\n";

foreach ($settings as $key => $value) {
    $config .= '    public const ' . $key . ' = '
        . var_export($value, true) . ";\n";
}

$config .= "}\n";

$file = '/var/www/html/config.php';

if (file_put_contents($file, $config, LOCK_EX) === false) {
    fwrite(STDERR, "Could not write config.php\n");
    exit(1);
}

echo "config.php generated successfully.\n";
