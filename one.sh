#!/usr/bin/env bash

# Get env
WD="$(dirname $0)"
JSE=$(command -v node nodejs mujs | head -n 1)

# Update submodules
git submodule update --init --recursive &>/dev/null

# Find file & print it
FILE=$(find "${WD}/jar" -type f -name \*.json | shuf -n 1)
[ -z "${FILE}" ] || cat "${FILE}" | $JSE $WD/one.js
