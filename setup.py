#!/bin/env python3

import os
import sys


sdir = os.path.dirname( os.path.realpath(__file__) )
wdir = os.path.relpath( os.path.join(sdir, '..', '..') )
cakedir = wdir + '/app'

execfile("config.py")
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
        else:
            continue
    os.symlink( os.path.relpath(sfile, os.path.realpath(dsym)), dsym )
