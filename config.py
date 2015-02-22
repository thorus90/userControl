#!/bin/env python3

symlinks = [
	(sdir + '/Config/general.ini.default', cakedir + '/Config/general.ini.default'),
	(sdir + '/Controller/UsersController.php', cakedir + '/Controller/UsersController.php'),
	(sdir + '/js/user/register.js', cakedir + '/webroot/js/user/register.js'),
	(sdir + '/Model/User.php', cakedir + '/Model/User.php'),
	(sdir + '/View/Emails/html/recover_password.ctp', cakedir + '/View/Emails/html/recover_password.ctp'),
	(sdir + '/View/Elements/messages.ctp', cakedir + '/View/Elements/messages.ctp'),
	(sdir + '/View/Users/login.ctp', cakedir + '/View/Users/login.ctp'),
	(sdir + '/View/Users/recover.ctp', cakedir + '/View/Users/recover.ctp'),
	(sdir + '/View/Users/register.ctp', cakedir + '/View/Users/register.ctp'),
	(sdir + '/View/Users/set_new_password.ctp', cakedir + '/View/Users/set_new_password.ctp')
]
