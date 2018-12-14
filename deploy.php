<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'pinpoint');

// Project repository
set('repository', 'git@github.com:risha700/pinpoint.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('138.197.109.152')
->user('root')
->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/pinpoint');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

