#!/bin/env python3

import os
import sys


sdir = os.path.dirname( os.path.realpath(__file__) )
wdir = os.path.normpath( os.path.join(sdir, '..', '..') )
cakedir = wdir + '/app'

symlinks = [
	(sdir + '/Controller/UserController.php', cakedir + '/Controller/UserController.php'),
	(sdir + '/js/user/register.js', cakedir + '/webroot/js/user/register.js'),
	(sdir + '/Model/User.php', cakedir + '/Model/User.php'),
	(sdir + '/View/Emails/html/recover_password.ctp', cakedir + '/View/Emails/html/recover_password.ctp'),
	(sdir + '/View/User/login.ctp', cakedir + '/View/User/login.ctp'),
	(sdir + '/View/User/recover.ctp', cakedir + '/View/User/recover.ctp'),
	(sdir + '/View/User/register.ctp', cakedir + '/View/User/register.ctp'),
	(sdir + '/View/User/set_new_password.ctp', cakedir + '/View/User/set_new_password.ctp')
]
print("Notice: taking this as docroot: " + cakedir)

for symlink in symlinks:
	ddir = os.path.dirname( symlink[1] )
	sfile = symlink[0]
	dsym = symlink[1]

	if not os.path.isdir( ddir ):
		print("Notice: directory not existant.. creating " + ddir)
		os.makedirs(ddir)

	if not os.path.isfile ( sfile ):
		print("Error: source file not existant.. aborting at "+ sfile)
		sys.exit()

	if os.path.islink ( dsym ):
		if os.path.realpath ( dsym ) != sfile:
			print("Notice: incorrect symlink.. correcting " + dsym)
			os.unlink ( dsym )

	os.symlink( sfile, dsym )
