#!/usr/bin/env bash
cat "$(find jar -type f | grep -v bundle | shuf -n 1)"
