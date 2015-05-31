#!/bin/env python3

import os
import sys
import json
import simplejson
import subprocess

sdir = os.path.dirname( os.path.realpath(__file__) )
wdir = os.path.relpath( os.path.join(sdir, '..', '..') )
cakedir = wdir
appdir = wdir  + '/src'
with open(cakedir + '/composer.json') as f:
    composerjson = simplejson.load(f)

execfile("config.py")
print("Notice: taking this as docroot: " + os.path.realpath ( cakedir ))

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
        if os.path.realpath ( dsym ) != os.path.realpath ( sfile ):
            print("Notice: incorrect symlink.. correcting " + sfile)
            os.unlink ( dsym )
        else:
            continue
    os.symlink( os.path.relpath(sfile, os.path.realpath(os.path.dirname(dsym))), dsym )

with open(cakedir + '/composer.json', 'w') as data_file:
    data_file.write(simplejson.dumps(composerjson, indent=4, sort_keys=True))

command = ['/usr/bin/php', os.path.realpath(cakedir) + '/composer.phar','-d=' + os.path.realpath(cakedir), 'update']
subprocess.call(command)

for confline in lines_in_files:
    line = confline[0]
    dfile = confline[1]
    found = False
    with open(dfile) as search:
        for tmpline in search:
            tmpline = tmpline.rstrip()
            if line == tmpline:
                found = True
    if not found:
        with open(dfile, "a") as wfile:
            wfile.write(line + '\n')
            print("Added " + line + " to " + dfile)
