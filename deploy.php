<?php

date_default_timezone_set('Europe/Stockholm');

include_once 'config/deployer_common.php';

server( 'test', 'elseif.se' )
    ->env('deploy_path','/home/forge/aretediagram')
    ->user('forge')
    ->env('branch', 'master')
    ->stage('test')
    ->identityFile();

set('repository', 'git@github.com/ekandreas/aretediagram.git');

set('env', 'production');
set('keep_releases', 10);
set('shared_dirs', []);
set('writable_dirs', []);
set('shared_files', []);
set('env_vars', '/usr/bin/env');

task('deploy:restart', function () {
    run("sudo service apache2 reload");
})->desc('Restarting apache2 and other stuff after deploy');

task( 'deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'cleanup',
    'deploy:restart',
    'success'
] )->desc( 'Deploy your project, eg "dep deploy production"' );

