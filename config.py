#!/bin/env python3

symlinks = [
	(sdir + '/config/general.ini.default', cakedir + '/config/general.ini.default'),
	(sdir + '/Controller/UsersController.php', appdir + '/Controller/UsersController.php'),
	(sdir + '/js/user/register.js', cakedir + '/webroot/js/user/register.js'),
	(sdir + '/Model/Entity/User.php', appdir + '/Model/Entity/User.php'),
	(sdir + '/Model/Table/UsersTable.php', appdir + '/Model/Table/UsersTable.php'),
	(sdir + '/Template/Email/html/recover_password.ctp', appdir + '/Template/Email/html/recover_password.ctp'),
	(sdir + '/Template/Element/messages.ctp', appdir + '/Template/Element/messages.ctp'),
	(sdir + '/Template/Users/edit.ctp', appdir + '/Template/Users/edit.ctp'),
	(sdir + '/Template/Users/login.ctp', appdir + '/Template/Users/login.ctp'),
	(sdir + '/Template/Users/recover.ctp', appdir + '/Template/Users/recover.ctp'),
	(sdir + '/Template/Users/register.ctp', appdir + '/Template/Users/register.ctp'),
	(sdir + '/Template/Users/set_new_password.ctp', appdir + '/Template/Users/set_new_password.ctp')
]

lines_in_files = [
        ("Router::connect('/reset/*', [ 'controller'=>'Users','action'=>'setNewPassword' ] );" , cakedir + '/config/routes.php'),
        ("use Cake\Core\Configure\Engine\IniConfig;", cakedir + '/config/bootstrap.php'),
        ("Configure::config('ini', new IniConfig());", cakedir + '/config/bootstrap.php'),
        ("Configure::load('general', 'ini');", cakedir + '/config/bootstrap.php')
]
