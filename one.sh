#!/usr/bin/env bash
cat "$(find jar -type f | shuf -n 1)"
