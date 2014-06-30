#!/bin/env python3

import os

sdir = os.path.dirname( os.path.realpath(__file__) )
wdir = os.path.normpath( os.path.join(sdir, '..', '..') )
print("Notice: taking this as docroot: " + wdir)