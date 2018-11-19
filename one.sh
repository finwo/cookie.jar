#!/usr/bin/env bash
WD=$(dirname $0)

JSE=$(command -v node mujs | head -n 1)
git submodule update --init --recursive
FILE=$(find $WD/jar -type f -name *.json | shuf -n 1)

echo $FILE
cat "${FILE}" | $JSE $WD/one.js
