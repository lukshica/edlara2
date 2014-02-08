<?php

return array(
    'process'       => 'நிறுவல் செயல்முறை',
    'hide-password' => 'தரவுத்தள கடவுச்சொல் பாதுகாப்புக்காக‌ மறைத்துவைக்கப்பட்டுள்ளது.',
    'verify'        => 'பின்வரும் கட்டமைப்பு உங்கள் :filename அடிப்படையில் சரியானது என்று உறுதி செய்து கொள்ளவும் .',
    'solution'      => 'தீர்வு',

    'status'     => array(
        'still' => 'இப்பொழுதும் இயங்கக்கூடியது',
        'work'  => 'இயங்கக்கூடியது',
        'not'   => 'இயங்கக்கூடியது அல்ல‌',
    ),

    'connection' => array(
        'status'  => 'இணைப்பு நிலை',
        'success' => 'வெற்றி',
        'fail'    => 'தோல்வி',
    ),

    'auth'     => array(
        'title'       => 'அங்கீகார அமைப்பு',
        'driver'      => 'Driver',
        'model'       => 'மாதிரி',
        'requirement' => array(
            'driver'     => 'Orchestra Platform require Auth using the Eloquent Driver',
            'instanceof' => 'Model name should be an instance of :class',
        ),
    ),

    'database' => array(
        'title'    => 'Database Setting',
        'host'     => 'Host',
        'name'     => 'Database Name',
        'password' => 'Password',
        'username' => 'Username',
        'type'     => 'Database Type',
    ),

    'steps'    => array(
        'requirement' => 'Check Requirements',
        'account'     => 'Create Administrator',
        'application' => 'Application Information',
        'done'        => 'Done',
    ),

    'system'   => array(
        'title'       => 'System Requirement',
        'description' => 'Please ensure the following requirement is profilled before installing Orchestra Platform.',
        'requirement' => 'Requirement',
        'status'      => 'Status',

        'writableStorage' => array(
            'name' => "Writable to :path",
            'solution' => "Change the directory permission to 0777, however it might cause a security issue if this folder is accessible from the web.",
        ),
        'writableAsset' => array(
            'name'     => "Writable to :path",
            'solution' => "Change the directory permission to 0777. Once installation is completed, please revert the permission to 0755.",
        ),
    ),

    'user' => array(
        'created'   => 'User created, you can now login to the administation page',
        'duplicate' => 'Unable to install when there already user registered.',
    ),
);
