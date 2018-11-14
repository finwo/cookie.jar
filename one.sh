#!/usr/bin/env bash
WD=$(dirname $0)
cat "$(find $WD/jar -type f | grep -v bundle | shuf -n 1)"
